<?php 

  @session_start();
  if (!class_exists("Connection")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
  }if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists("WebService")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/WebServiceSOAP.php';
  }if (!class_exists("Contacto_")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Contacto/Contacto.Model.php';
  }if (!class_exists("Cliente")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Cliente/Cliente.Model.php';
  }if (!class_exists("PedidoB2BTransferencia")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/Sales/PedidoB2BTransferencia.Model.php';
  }if (!class_exists('PedidoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
  }if (!class_exists('DetalleController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Detalle.Controller.php';
  }if (!class_exists("SalesQuatation_")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Pedido/B2B/SalesQuatation.Model.php';
  }if (!class_exists("Log_")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Logs/Log.Model.php';
  }

  /**
   * 
   */
  class PedidoB2BTransferenciaController{
    protected $conn;
    protected $Tool;
    
    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function create(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $PedidoController = new PedidoController();
          $ResultPedidoController = $PedidoController->ListPedidoB2B();
          foreach ($ResultPedidoController->records as $key => $row) {
            $this->Pedido = $row;
            $this->generar();
            unset($PedidoController);
            unset($ResultPedidoController);
          }
        }else{
          throw new Exception("No hay datos maestros! por favor contacta con tu ejecutivo");
        }
      }catch (Exception $e){
        echo $e;
      }
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function generar(){
      try {
        # Obtención información relevante al cliente
        $ClienteModel = new Cliente(); 
        $ClienteModel->SetParameters($this->conn, $this->Tool);
        $ClienteExiste = $ClienteModel->GetBy("WHERE id_cliente = '".$this->Pedido->ClienteKey."' ");
        # comprobación si hay información cliente
        if ($ClienteExiste) {
          $ContactoModel = new Contacto_();
          $ContactoModel->SetParameters($this->conn, $this->Tool);
          $ContactoExiste = $ContactoModel->GetBy();
          if ($ContactoExiste) {
            # conección Soap
            $WebServiceSOAP = new WebService(
              "http://".$ContactoModel->GetWebservice()."/WS_Ecommerce.asmx?WSDL", 
              $ClienteModel->GetCardCode(), 
              $ClienteModel->GetPasswordB2b(), 
              $ClienteModel->GetSociedad(), 
              "http://fibremex.com.mx/"
            );
            # Información necesaria para envió xml consumo de web service Ecommerce
            $PedidoB2BModel = new PedidoB2BTransferencia();
            $PedidoB2BModel->SetPedidoKey($this->Pedido->Key); 
            $PedidoB2BModel->SetCardCode($ClienteModel->GetCardCode()); 
            $PedidoB2BModel->SetCFDIUser($this->Pedido->CFDIUser); 
            $PedidoB2BModel->SetTransportationCode($this->Pedido->TransportationCode);
            $PedidoB2BModel->SetTransferReference($this->Pedido->OpenPayTransaccionKey); 
            $PedidoB2BModel->SetPaymentMethod($this->Pedido->MetodoPago); 
            $PedidoB2BModel->SetDocCurrency($this->Pedido->MonedaPago); 
            $PedidoB2BModel->SetShipToCode($this->Pedido->DatosEnvioKey); 
            $PedidoB2BModel->SetPayToCode($this->Pedido->DatosFacturacionKey); 
            $PedidoB2BModel->SetDocRate($this->Pedido->TipoCambio); 
            $PedidoB2BModel->SetShipReferences($this->Pedido->Paqueteria); 
            $PedidoB2BModel->SetNumAtCard($this->Pedido->Referencia); 
            $PedidoB2BModel->SetContacto($this->Pedido->ContactoNombre); 
            $PedidoB2BModel->SetTelefono($this->Pedido->ContactoTelefono); 
            $PedidoB2BModel->SetEmail($this->Pedido->ContactoCorreo); 
            $PedidoB2BModel->SetEmail_ItemsStockBad($this->Tool->validate_sin_stock($this->Pedido->Intentos)); 
            $PedidoB2BModel->SetTipoPago($this->Pedido->TipoPago);

            $ResultPedidoB2BModel = $PedidoB2BModel->createPedidoB2BWithOutCredit($WebServiceSOAP, $this->ArticulosPedido());
            $ResultPedidoB2B = $ResultPedidoB2BModel->CreatePedidoB2B_withoutCreditResult;
            # guardado de estatus pedido B2B
            $SalesQuatation = new SalesQuatation_();
            $SalesQuatation->SetParameters($this->conn, $this->Tool);
            $SalesQuatation->SetEstatus($ResultPedidoB2B->ErrorCode);
            $SalesQuatation->SetPedidoKey($this->Pedido->Key);
            $SalesQuatation->SetIntentos($this->Pedido->Intentos + 1);

            # si crearon los documentossatisfactoriamente en sap
            if ($ResultPedidoB2B->ErrorCode == 0) {
              $ResultPedidoB2B_ = $ResultPedidoB2B->Diccionary->Diccionary;
              $SalesQuatation->SetOfertaVenta($ResultPedidoB2B_[0]->Value);
              if (count( $ResultPedidoB2B_) == 2) {
                $SalesQuatation->SetOrdenVentaBorrador($ResultPedidoB2B_[1]->Value);
              }else{
                $SalesQuatation->SetOrdenVenta($ResultPedidoB2B_[1]->Value);
                $SalesQuatation->SetPickingList($ResultPedidoB2B_[2]->Value);
              }
              $SalesQuatation->SetPago($ResultPedidoB2B_[3]->Value);
            }

            $ResultSalesQuatation = $SalesQuatation->update();

            if (!$ResultSalesQuatation['error']) {
               # creación Log referente al pedido 
               $LogModel = new Log_();
               $LogModel->SetParameters($this->conn, $this->Tool);
               $LogModel->SetTitle("Pedido");
               $LogModel->SetErrorCode($ResultPedidoB2B->ErrorCode);
               $LogModel->SetNumeroPedido($this->Pedido->Key);
               $LogModel->SetTypePedido("B2B");
               $LogModel->SetErrorDescription($this->Tool->Clear_data_for_sql($ResultPedidoB2B->ErrorDescription));
               $LogModel->SetSendData(json_encode($PedidoB2BModel->GetEstructuraPedidoB2B(), JSON_UNESCAPED_UNICODE));
               $LogModel->SetResultWService(json_encode($ResultPedidoB2BModel, JSON_UNESCAPED_UNICODE));
               $LogModel->create();
               
              unset($WebServiceSOAP);
              unset($ContactoModel);
              unset($ContactoExiste);
              unset($ClienteModel);
              unset($ClienteExiste);
              unset($ResultPedidoB2B);
              return $ResultPedidoB2BModel;
            }else{
              unset($WebServiceSOAP);
              unset($ContactoModel);
              unset($ContactoExiste);
              unset($ClienteModel);
              unset($ClienteExiste);
              unset($ResultPedidoB2BModel);
              unset($ResultPedidoB2B);
              throw new Exception("No se pudo guardar la información acerca estatus pedido B2B");
            }
          }else{
            unset($ContactoModel);
            unset($ContactoExiste);
            unset($ClienteModel);
            unset($ClienteExiste);
            throw new Exception("No se encuentra información acerca del contacto!");
          }
        }else{
          unset($ClienteModel);
          unset($ClienteExiste);
          throw new Exception("No se encuentra información acerca del cliente!");
        }
      }catch (Exception $e){
        echo $e->getMessage();
      }
    }
     /**
     *  Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
    */
    public function ArticulosPedido(){
      try {
        $DetalleController = new DetalleController();
        $ResultDetalleController = $DetalleController->GetDetallePedido_("WHERE pedidokey = '".$this->Pedido->Key."' AND detalle_activo = 'si' ");
        $items = [];

        $TaxCode = 'B216';
        $WarehouseCode = 'CEDIS';
        $UnitsOfMeasurment = 6;
        $NCMCode = 20427;

        foreach ($ResultDetalleController->records as $Info) {
          $items[] = [
            "ItemCode"          => $Info->DetalleCodigo,
            "Quantity"          => $Info->DetalleCantidad,
            "UnitPrice"         => $Info->PedidoMonedaPago == "USD" ? $Info->DetallePrecioUnidad : $Info->DetallePrecioUnidadMXN,
            "Description"       => !empty($Info->DetalleCodigoConfigurable) ? $Info->ProductoConfigurableNombre : $Info->ProductoDescripcion,
            "DiscountPercent"   => $Info->DetalleDescuento,
            "TaxCode"           => $TaxCode,
            "WarehouseCode"     => $Info->ProductoWarehouseCode,
            "UnitsOfMeasurment" => $UnitsOfMeasurment,
            "Currency"          => $Info->PedidoMonedaPago,
            "NCMCode"           => $NCMCode
          ];
        }
        unset($DetalleController);
        unset($ResultDetalleController);
        return $items;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }