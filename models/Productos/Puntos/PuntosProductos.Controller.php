<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("PuntosProductos")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Puntos/PuntosProductos.Model.php';
}
  /**
   * 
   */
  class PuntosProductosController{
    
    protected $Connection;
    protected $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->Connection = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function GetBy(){
      try {
        if(!$this->Connection->conexion()->connect_error){
          $PuntosProductosModel = new PuntosProductos();
          $PuntosProductosModel->SetParameters($this->Connection, $this->Tool);
          $Result = $PuntosProductosModel->GetBy($this->filter);
          return $PuntosProductosModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Get(){
      try {
        if(!$this->Connection->conexion()->connect_error){
          $PuntosProductosModel = new PuntosProductos();
          $PuntosProductosModel->SetParameters($this->Connection, $this->Tool);
          $Result = $PuntosProductosModel->Get($this->filter, $this->order);
          unset($PuntosProductosModel);
          return $this->Tool->Message_return(false, "", $Result, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    
  }