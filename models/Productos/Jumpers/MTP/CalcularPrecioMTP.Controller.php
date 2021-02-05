<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("CalcularPrecioMPO")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Jumpers/MTP/CalcularPrecioMTP.Model.php';
}

  /**
   * 
   */
  class CalcularPrecioMTPController{
    
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
          $CalcularPrecioMTPModel = new CalcularPrecioMTP(); 
          $CalcularPrecioMTPModel->SetParameters($this->Connection, $this->Tool);
          $CalcularPrecioMTPModel->SetLongitud($_POST['Longitud']);
          $CalcularPrecioMTPModel->SetFibra($_POST['Fibra']);
          $CalcularPrecioMTPModel->SetCantidadFibras($_POST['CantidadFibras']);
          $CalcularPrecioMTPModel->SetSubcategoriaN1Code($_POST['SubcategoriaN1Code']);
					$CalcularPrecioMTPModel->SetClienteId(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
          return $CalcularPrecioMTPModel->Calcular();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
