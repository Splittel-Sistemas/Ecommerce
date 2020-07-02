<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists('PedidoController')) {
  include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Pedido.Controller.php';
}
  /**
   * 
   */
  class NumeroGuiaEstatus_Controller{
    
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
    }

    public function GetPedidosEstatusPaqueteriaPaqueteExpress(){
      try{
        if(!$this->Connection->conexion()->connect_error){
          $PedidoController = new PedidoController();
          $PedidoController->filter = "WHERE estatus = 'P' AND (numero_guia_estatus <> 'OK' OR  numero_guia_estatus IS NULL) AND nombre_paqueteria = 'PAQEXPRESS' ";
          $PedidoController->order = "";
          $ResultPedido = $PedidoController->get();

          $Pedido_ = new Pedido_();
          $Pedido_->SetParameters($this->Connection, $this->Tool);

          foreach ($ResultPedido->records as $key => $Pedido) {
            if(!empty($Pedido->Numeroguia)){
              $this->NumeroGuia = $Pedido->Numeroguia;
              $Result = $this->GetSeguimientoPedidoNumeroGuia();

              if(count($Result) > 0){
                $FechaRecibido = "";
                $Recibio = "";
                $Estatus = "";
                foreach ($Result as $key => $PaqExpress) {
                  if($PaqExpress->eventoId == 'Bdl' || $PaqExpress->eventoId == 'Eni' || $PaqExpress->eventoId == 'Hdc'){
                    $Estatus = 'OK';
                    $Recibio = $PaqExpress->status;
                    $paragraph = $PaqExpress->fecha;
                    $Palabras = explode(" ", $paragraph);
                    $Meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                    $Meses_ingles = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                    foreach ($Palabras as $key => $Palabra) {
                        if(array_search($Palabra, $Meses)){
                          $c = array_search($Palabra, $Meses);
                          $fecha = $Palabras[1].' '.$Meses_ingles[$c].' '.$Palabras[5];
                        }
                    }
                    $date = DateTime::createFromFormat('d F Y', $fecha);
                    $FechaRecibido =  $date->format('d-m-Y').'T'.$PaqExpress->hora.':00';
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

    public function GetPedidoEstatusPaqueteriaPaqueteExpress(){
      try{
        if(!$this->Connection->conexion()->connect_error){
          $PedidoController = new PedidoController();
          $PedidoController->filter = "WHERE id = ".$this->PedidoKey." ";
          $PedidoController->order = "";
          $Pedido = $PedidoController->getBy();
          $items_ = [];
          $items = [];

          if(!empty($Pedido->Numeroguia)){
            $this->NumeroGuia = $Pedido->Numeroguia;
            $Result = $this->GetSeguimientoPedidoNumeroGuia();
            if(count($Result) > 0){
              foreach ($Result as $key => $Evento) {
                $items[] = $Evento;
              }
            }
          }
          $items_['Evento'] = $items;
          $items_['Pedido'] = $Pedido;
          $items_['UltimoEvento'] = $Evento;
          
          unset($PedidoController);
          return $this->Tool->Message_return(false, "", $items_, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }


    public function GetSeguimientoPedidoNumeroGuia(){
    $url = "https://cc.paquetexpress.com.mx/ptxws/rest/api/v1/guia/historico/".$this->NumeroGuia."/@1@2@3@4@5";
    $soap_do = curl_init();
      //Indicamos a donde deseamos enviar nuestro post
      curl_setopt($soap_do, CURLOPT_URL,$url);
      //Añadimos una opción más para poder almacenar la respuesta en una variable
      curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 300);
      curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, 1);
      // curl_setopt($soap_do, CURLOPT_NOBODY, true);
      //Ejecutamos el curl y almacenamos la respuesta en una variable
      $Respuesta = curl_exec($soap_do);
      $Respuesta = str_replace('Resultado(', '', $Respuesta); 
      $Respuesta = str_replace(')', '', $Respuesta); 
       // Cerrar conexión cURL
       curl_close($soap_do);
       $Respuesta = json_decode(utf8_encode($Respuesta));
      return $Respuesta;
    }
  }