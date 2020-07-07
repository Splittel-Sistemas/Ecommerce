<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Puntos")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Puntos/Puntos.Model.php';
}
  /**
   * 
   */
  class PuntosController{
    
    protected $Connection;
    protected $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->Connection = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function Get(){
      try {
        if(!$this->Connection->conexion()->connect_error){
          $PuntosModel = new Puntos();
          $PuntosModel->SetParameters($this->Connection, $this->Tool);
          $Result = $PuntosModel->Get($this->filter, $this->order);
          unset($PuntosModel);
          return $this->Tool->Message_return(false, "", $Result, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetPuntos(){
      try {
        if(!$this->Connection->conexion()->connect_error){
          $PuntosModel = new Puntos();
          $PuntosModel->SetParameters($this->Connection, $this->Tool);
          $Result = $PuntosModel->GetPedidosPuntos($this->filter, $this->order);
          foreach ($Result as $key => $Pedido) {
            $PuntosModel->SetPedidoKey($Pedido->id);
            $PuntosModel->SetTotal($Pedido->totalPuntosbyPedido);
            $Result = $PuntosModel->Create();
          }
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    
  }