<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("CalcularPrecioMPO")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Jumpers/MPO/CalcularPrecioMPO.Model.php';
}

  /**
   * 
   */
  class CalcularPrecioMPOController{
    
    protected $Connection;
    protected $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->Connection = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function Calcular(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $CalcularPrecioMPOModel = new CalcularPrecioMPO(); 
          $CalcularPrecioMPOModel->SetParameters($this->Connection, $this->Tool);
          $CalcularPrecioMPOModel->SetLongitud($_POST['Longitud']);
          $CalcularPrecioMPOModel->SetFibra($_POST['Fibra']);
          $CalcularPrecioMPOModel->SetCantidadFibras($_POST['CantidadFibras']);
          return $CalcularPrecioMPOModel->Calcular();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
