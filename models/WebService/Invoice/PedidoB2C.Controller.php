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
  }if (!class_exists('PedidoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
  }if (!class_exists('DetalleController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Detalle.Controller.php';
  }if (!class_exists("PedidoB2C")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/Invoice/PedidoB2C.Model.php';
  }if (!class_exists('DatosEnvio')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cuenta/B2C/DatosEnvio.Model.php';
  }if (!class_exists('DatosFacturacion')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cuenta/B2C/DatosFacturacion.Model.php';
  }if (!class_exists('Invoice')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/B2C/Invoice.Model.php';
  }if (!class_exists("Log_")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Logs/Log.Model.php';
  }

  /**
   * 
   */
  class PedidoB2CController{
    protected $conn;
    protected $Tool;
    
    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
      $this->PedidoB2C = new PedidoB2C();
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
          $ResultPedidoController = $PedidoController->ListPedidoB2C();
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
            # conexión Soap
            $WebServiceSOAP = new WebService(
              "http://".$ContactoModel->GetWebservice()."/WS_Ecommerce.asmx?WSDL", 
              $ClienteModel->GetCardCode(), 
              $ClienteModel->GetPasswordB2b(), 
              $ClienteModel->GetSociedad(), 
              "http://fibremex.com.mx/"
            );
            # Información necesaria para envió xml consumo de web service Ecommerce
            $this->PedidoB2C->SetContacto(empty($ClienteModel->GetNombre()) ? '--' : $ClienteModel->GetNombre());
            $this->PedidoB2C->SetTelefono(empty($ClienteModel->GetTelefono()) ? '--' : $ClienteModel->GetTelefono());
            $this->PedidoB2C->SetEmail(empty($ClienteModel->GetEmail()) ? '--' : $ClienteModel->GetEmail());

            if(!filter_var($this->Pedido->RequiereFactura, FILTER_VALIDATE_BOOLEAN)){
              $BillToInformaction = $this->ShipToInformaction();
              $this->PedidoB2C->SetCardName('Venta Mostrador');
              $this->PedidoB2C->SetPartnerRFC('XAXX010101000');
            }else{
              $BillToInformaction = $this->BillToInformaction();
            }
            
            $this->PedidoB2C->SetPedidoKey($this->Pedido->Key);
            $this->PedidoB2C->SetCardCode($ClienteModel->GetCardCode());
            $this->PedidoB2C->SetRequiereInvoice($this->Pedido->RequiereFactura);
            $this->PedidoB2C->SetShipToInformaction($this->ShipToInformaction());
            $this->PedidoB2C->SetBillToInformaction($BillToInformaction);
            $this->PedidoB2C->SetCFDIUser($this->Pedido->CFDIUser);
            $this->PedidoB2C->SetRegimenFiscal($this->Pedido->RegimenFiscal);
            $this->PedidoB2C->SetTransferReference($this->Pedido->OpenPayTransaccionKey);
            $this->PedidoB2C->SetPaymentMethod($this->Pedido->MetodoPago);
            $this->PedidoB2C->SetDocCurrency($this->Pedido->MonedaPago);
            $this->PedidoB2C->SetDocRate($this->Pedido->TipoCambio); 
            $this->PedidoB2C->SetShipReferences($this->Pedido->Paqueteria);
            $this->PedidoB2C->SetTransportationCode($this->Pedido->TransportationCode);
            $this->PedidoB2C->SetNumAtCard($this->Pedido->Referencia);
            $this->PedidoB2C->SetEmail_ItemsStockBad($this->Tool->validate_sin_stock($this->Pedido->Intentos));
            $this->PedidoB2C->SetTipoPago($this->Pedido->TipoPago);
            
            $ResultPedidoB2CModel = $this->PedidoB2C->createPedidoB2C($WebServiceSOAP, $this->ArticulosPedido());
            $ResultPedidoB2C = $ResultPedidoB2CModel->CreatePedidoB2CResult;

            $InvoiceModel = new Invoice();
            $InvoiceModel->SetParameters($this->conn, $this->Tool);
            $InvoiceModel->SetPedidoKey($this->Pedido->Key);
            $InvoiceModel->SetEstatus($ResultPedidoB2C->ErrorCode);
            $InvoiceModel->SetIntentos($this->Pedido->Intentos + 1);

            switch ($ResultPedidoB2C->ErrorCode) {
              case 0: # Se genero exitosamente la factura y el pago o ya existe el pago con el numero de cotización actual
                $ResultPedidoB2C_ = $ResultPedidoB2C->Diccionary->Diccionary;
                $InvoiceModel->SetOfertaVenta($ResultPedidoB2C_[0]->Value);
                $InvoiceModel->SetInvoice($ResultPedidoB2C_[1]->Value);
                $InvoiceModel->SetPago($ResultPedidoB2C_[2]->Value);
                break;
              case 700: # Se genero solo la factura
                $InvoiceModel->SetOfertaVenta($ResultPedidoB2C_[0]->Value);
                $InvoiceModel->SetInvoice($ResultPedidoB2C_[1]->Value);
                break;
              default:
                
                break;
            }

            $ResultInvoiceModel = $InvoiceModel->create();

            if (!$ResultInvoiceModel['error']) {
              # creación Log referente al pedido 
              $LogModel = new Log_();
              $LogModel->SetParameters($this->conn, $this->Tool);
              $LogModel->SetTitle("Pedido");
              $LogModel->SetErrorCode($ResultPedidoB2C->ErrorCode);
              $LogModel->SetNumeroPedido($this->Pedido->Key);
              $LogModel->SetTypePedido("B2C");
              $LogModel->SetErrorDescription($this->Tool->Clear_data_for_sql($ResultPedidoB2C->ErrorDescription));
              $LogModel->SetSendData(json_encode($this->PedidoB2C->GetEstructuraPedidoB2C(), JSON_UNESCAPED_UNICODE));
              $LogModel->SetResultWService(json_encode($ResultPedidoB2CModel, JSON_UNESCAPED_UNICODE));
              $LogModel->create();
              return $ResultInvoiceModel;
            }else{
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
     * Datos de envio
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function ShipToInformaction(){
      $DatosEnvioModel = new DatosEnvio();
      $DatosEnvioModel->GetBy("WHERE id = '".$this->Pedido->DatosEnvioKey."' ");

      $DatosEnvio = [
        "Street"    => $DatosEnvioModel->GetCalle(), 
        "StreetNo"  => $DatosEnvioModel->GetNumeroExterior(), 
        "Block"     => $DatosEnvioModel->GetColonia(), 
        "County"    => $DatosEnvioModel->GetDelegacion(), 
        "ZipCode"   => $DatosEnvioModel->GetCodigoPostal(), 
        "State"     => $DatosEnvioModel->GetEstado(), 
        "City"      => $DatosEnvioModel->GetMunicipio(), 
        "Adress"    => "Datos envio", 
        "Default"   =>  true,
        "ContactPerson" => [
          "Name"              => $this->PedidoB2C->GetContacto(),
          "Telphone"          => $this->PedidoB2C->GetTelefono(),
          "Email"             => $this->PedidoB2C->GetEmail(),
        ],
      ]; 
      return $DatosEnvio;
    }
    /**
     * Datos de facturación
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function BillToInformaction(){
      $DatosFacturacionModel = new DatosFacturacion();
      $DatosFacturacionModel->GetBy("WHERE id = '".$this->Pedido->DatosFacturacionKey."' ");
      $this->PedidoB2C->SetPartnerRFC($DatosFacturacionModel->GetRFC());
      $this->PedidoB2C->SetCardName($DatosFacturacionModel->GetRazonSocial());

      $DatosFacturacion = [
        "Street"    => $DatosFacturacionModel->GetCalle(), 
        "StreetNo"  => $DatosFacturacionModel->GetNumeroExterior(), 
        "Block"     => $DatosFacturacionModel->GetColonia(), 
        "County"    => $DatosFacturacionModel->GetDelegacion(), 
        "ZipCode"   => $DatosFacturacionModel->GetCodigoPostal(), 
        "State"     => $DatosFacturacionModel->GetEstado(), 
        "City"      => $DatosFacturacionModel->GetCiudad(), 
        "Adress"    => "Datos facturación", 
        "Default"   =>  true,
        "ContactPerson" => [
          "Name"              => $this->PedidoB2C->GetContacto(),
          "Telphone"          => $this->PedidoB2C->GetTelefono(),
          "Email"             => $this->PedidoB2C->GetEmail(),
        ],
      ]; 
      return $DatosFacturacion;
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