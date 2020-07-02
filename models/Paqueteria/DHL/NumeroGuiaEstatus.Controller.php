<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists('Pedido_')) {
  include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Pedido.Model.php';
}if (!class_exists('PedidoController')) {
  include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Pedido.Controller.php';
}if (!class_exists("CheckPointDHLController")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Paqueteria/DHL/CheckPointDHL.Controller.php';
}
  /**
   * 
   */
  class NumeroGuiaEstatusController{
    
    protected $Connection;
    protected $Tool;

    protected $NumeroGuia;
    protected $Url;
    protected $Site;
    protected $Password;

    public $PedidoKey;

    public function __construct(){
      $this->Connection = new Connection();
      $this->Tool = new Functions_tools();
      $this->Site = 'DHLFIBREMEX';
      $this->Password = 'NRDCj2bgcH';
      $this->Url = "https://xmlpi-ea.dhl.com/XMLShippingServlet";
    }

    public function GetPedidosEstatusPaqueteriaDHL(){
      try{
        if(!$this->Connection->conexion()->connect_error){
          $PedidoController = new PedidoController();
          $PedidoController->filter = "WHERE estatus = 'P' AND (numero_guia_estatus <> 'OK' OR  numero_guia_estatus IS NULL) AND nombre_paqueteria = 'DHL' ";
          $PedidoController->order = "";
          $ResultPedido = $PedidoController->get();

          $Pedido_ = new Pedido_();
          $Pedido_->SetParameters($this->Connection, $this->Tool);

          $FechaRecibido = '';
          $Recibio = '';
          foreach ($ResultPedido->records as $key => $Pedido) {
            if(!empty($Pedido->Numeroguia)){
              $this->NumeroGuia = $Pedido->Numeroguia;
              $Result = $this->GetSeguimientoPedidoNumeroGuia();
              if(isset($Result->AWBInfo->ShipmentInfo->ShipmentEvent->ServiceEvent->EventCode)){
                foreach ($Result->AWBInfo->ShipmentInfo->ShipmentEvent as $key => $DHL) {
                  $Estatus = $DHL->ServiceEvent->EventCode;
                  if(!empty($DHL->Signatory)){
                    $FechaRecibido = $DHL->Date.'T'.$DHL->Time;
                    $Recibio = $DHL->Signatory;
                  }
                }
                $Pedido_->SetKey($Pedido->Key);
                $Pedido_->SetNumeroguia($this->NumeroGuia);
                $Pedido_->SetNumeroGuiaEstatus($Estatus);
                $Pedido_->SetFechaRecibido($FechaRecibido);
                $Pedido_->SetRecibio($Recibio);
                $Pedido_->PedidoActualizarEstatusNumeroGuia();
              }
            }
          }
          unset($PedidoController);
          unset($ResultPedido);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetPedidoEstatusPaqueteriaDHL(){
      try{
        if(!$this->Connection->conexion()->connect_error){
          $PedidoController = new PedidoController();
          $PedidoController->filter = "WHERE id = ".$this->PedidoKey." ";
          $PedidoController->order = "";
          $Pedido = $PedidoController->getBy();

          $CheckPointDHLController = new CheckPointDHLController();
          $items = [];
          $items_ = [];
          $Evento = '';

          if(!empty($Pedido->Numeroguia)){
            $this->NumeroGuia = $Pedido->Numeroguia;
            $Result = $this->GetSeguimientoPedidoNumeroGuia();
            // print_r($Result);
            if(isset($Result->AWBInfo->ShipmentInfo->ShipmentEvent->ServiceEvent->EventCode)){
              foreach ($Result->AWBInfo->ShipmentInfo->ShipmentEvent as $key => $Evento) {
                $CheckPointDHLController->filter = "WHERE t32_f001 = '".$Evento->ServiceEvent->EventCode."' ";
                $CheckPointDHLController->order = "";
                $ResultCheckPointDHL = $CheckPointDHLController->getBy();
                $Evento->ServiceEvent->Description = $ResultCheckPointDHL->GetDescripcion();
                $items[] = $Evento;
              }
              $UltimoEvento[] = $Evento;
            }
          }
          $items_['Pedido'] = $Pedido;
          $items_['Evento'] = $items;
          $items_['UltimoEvento'] = $Evento;
          // print_r($items_);
          return $this->Tool->Message_return(false, "", $items_, false);
          unset($PedidoController);
          unset($ResultPedido);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function SeguimientoPedidoNumeroGuiaXML(){
      try {
        $time = time();
        $tiempo =  date("Y-m-dTH:i:sP", $time);
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <req:KnownTrackingRequest xmlns:req="http://www.dhl.com" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dhl.com TrackingRequestKnown.xsd">
        <Request>
            <ServiceHeader>
                <MessageTime>'.$tiempo.'</MessageTime>
                <SiteID>'.$this->Site.'</SiteID>
                <Password>'.$this->Password.'</Password>
            </ServiceHeader>
        </Request>
        <LanguageCode>es</LanguageCode>
        <AWBNumber>'.$this->NumeroGuia.'</AWBNumber>
        <LevelOfDetails>ALL_CHECK_POINTS</LevelOfDetails>
        </req:KnownTrackingRequest>';
        return $xml;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetSeguimientoPedidoNumeroGuia(){
      $prexml = $this->SeguimientoPedidoNumeroGuiaXML();
      //Iniciamos una sesion cURL
      $soap_do = curl_init();
      //Indicamos a donde deseamos enviar nuestro post
      curl_setopt($soap_do, CURLOPT_URL,$this->Url);
      //Indicamos lo que queremos enviar en nuestro post, en este caso un xml
      curl_setopt($soap_do, CURLOPT_POSTFIELDS,$prexml);
      //Añadimos una opción más para poder almacenar la respuesta en una variable
      curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 300);
      curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, 1);
      //Ejecutamos el curl y almacenamos la respuesta en una variable
      $Respuesta = curl_exec($soap_do);
      // Cerrar conexión cURL
      curl_close($soap_do);
      $Obj = simplexml_load_string($Respuesta);
      return $Obj;
    }
  }

  // $NumeroGuiaEstatusController = new NumeroGuiaEstatusController();
  // $NumeroGuiaEstatusController->PedidoKey = 1251;
  // $Result = $NumeroGuiaEstatusController->GetPedidoEstatusPaqueteriaDHL();