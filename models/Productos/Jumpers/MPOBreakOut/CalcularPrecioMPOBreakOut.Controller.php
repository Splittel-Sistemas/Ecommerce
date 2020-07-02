<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists("CalcularPrecioMPOBreakOut")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Productos/Jumpers/MPOBreakOut/CalcularPrecioMPOBreakOut.Model.php';
}

  /**
   * 
   */
  class CalcularPrecioMPOBreakOutController{
    
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
          $CalcularPrecioMPOBreakOutModel = new CalcularPrecioMPOBreakOut(); 
          $CalcularPrecioMPOBreakOutModel->SetParameters($this->Connection, $this->Tool);
          $CalcularPrecioMPOBreakOutModel->SetLongitud($_POST['Longitud']);
          $CalcularPrecioMPOBreakOutModel->SetFibra($_POST['Fibra']);
          $CalcularPrecioMPOBreakOutModel->SetNumeroHilos($_POST['NumeroHilos']);
          return $CalcularPrecioMPOBreakOutModel->Calcular();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
