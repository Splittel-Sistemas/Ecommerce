<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("CalcularPrecioMPOBreakOut")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Jumpers/MTPProBreakOut/CalcularPrecioMTPProBreakOut.Model.php';
}

  /**
   * 
   */
  class CalcularPrecioMTPProBreakOutController{
    
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
          $CalcularPrecioMTPProBreakOutModel = new CalcularPrecioMTPProBreakOut(); 
          $CalcularPrecioMTPProBreakOutModel->SetParameters($this->Connection, $this->Tool);
          $CalcularPrecioMTPProBreakOutModel->SetLongitud($_POST['Longitud']);
          $CalcularPrecioMTPProBreakOutModel->SetFibra($_POST['Fibra']);
          $CalcularPrecioMTPProBreakOutModel->SetNumeroHilos($_POST['NumeroHilos']);
          $CalcularPrecioMTPProBreakOutModel->SetSubcategoriaN1Code($_POST['SubcategoriaN1Code']);
					$CalcularPrecioMTPProBreakOutModel->SetClienteId(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
          return $CalcularPrecioMTPProBreakOutModel->Calcular();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
