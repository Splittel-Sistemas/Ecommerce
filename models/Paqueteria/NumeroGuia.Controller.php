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
}if (!class_exists('GetOrderInprocesIDController')) {
  include $_SERVER['DOCUMENT_ROOT'].'/store/models/WebService/Document/GetOrderInprocesID.Controller.php';
}
  /**
   * 
   */
  class NumeroGuiaController{
    
    protected $Connection;
    protected $Tool;

    private $NumeroGuia;

    public function __construct(){
      $this->Connection = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function GetNumeroGuiaPaqueteria(){
      try{
        if(!$this->Connection->conexion()->connect_error){
          $PedidoController = new PedidoController();
          $PedidoController->filter = "WHERE estatus = 'P' AND numero_guia = '' AND (numero_guia_estatus <> 'OK' OR  numero_guia_estatus IS NULL) ";
          $PedidoController->order = "";
          $ResultPedido = $PedidoController->get();

          $GetOrderInprocesIDController = new GetOrderInprocesIDController();
          $Pedido_ = new Pedido_();
          $Pedido_->SetParameters($this->Connection, $this->Tool);
          foreach ($ResultPedido->records as $key => $Pedido) {
            $GetOrderInprocesIDController->PedidoKey = $Pedido->Key;
            $GetOrderInprocesIDController->ClienteKey = $Pedido->ClienteKey;
            $ResultGetOrderInprocesID = $GetOrderInprocesIDController->get();
            $ResultGetOrderInprocesID = $ResultGetOrderInprocesID->GetOrderInprocesIDResult;
            if($ResultGetOrderInprocesID->ErrorCode == 0){
              $ResultReordGetOrderInprocesID = $ResultGetOrderInprocesID->Record;
              $Pedido_->SetKey($Pedido->Key);
              $Pedido_->SetNumeroguia($ResultReordGetOrderInprocesID->TrackNo);
              if($ResultReordGetOrderInprocesID->Paqueteria == 9
              || $ResultReordGetOrderInprocesID->Paqueteria == 10
              || $ResultReordGetOrderInprocesID->Paqueteria == 11
              || $ResultReordGetOrderInprocesID->Paqueteria == 12
              || $ResultReordGetOrderInprocesID->Paqueteria == 13){ // DHL
                $Pedido_->SetNombrePaqueteria('DHL');
              }else if($ResultReordGetOrderInprocesID->Paqueteria == 14
                    || $ResultReordGetOrderInprocesID->Paqueteria == 15
                    || $ResultReordGetOrderInprocesID->Paqueteria == 16){ // PAQUETE EXPRESS
                $Pedido_->SetNombrePaqueteria('PAQEXPRESS');
              }
              $Pedido_->PedidoAgregarNumeroGuia();
            }
          }
          
          unset($Pedido_);
          unset($PedidoController);
          unset($ResultPedido);
          unset($GetOrderInprocesIDController);
          unset($ResultGetOrderInprocesID);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
  }