<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("CalcularPrecioMPOBreakOut")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Jumpers/MTPBreakOut/CalcularPrecioMTPBreakOut.Model.php';
}

  /**
   * 
   */
  class CalcularPrecioMTPBreakOutController{
    
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
          $CalcularPrecioMTPBreakOutModel = new CalcularPrecioMTPBreakOut(); 
          $CalcularPrecioMTPBreakOutModel->SetParameters($this->Connection, $this->Tool);
          $CalcularPrecioMTPBreakOutModel->SetLongitud($_POST['Longitud']);
          $CalcularPrecioMTPBreakOutModel->SetFibra($_POST['Fibra']);
          $CalcularPrecioMTPBreakOutModel->SetNumeroHilos($_POST['NumeroHilos']);
          $CalcularPrecioMTPBreakOutModel->SetSubcategoriaN1Code($_POST['SubcategoriaN1Code']);
					$CalcularPrecioMTPBreakOutModel->SetClienteId(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
          return $CalcularPrecioMTPBreakOutModel->Calcular();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
