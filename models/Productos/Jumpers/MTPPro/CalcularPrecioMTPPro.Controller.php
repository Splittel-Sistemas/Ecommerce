<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("CalcularPrecioMPO")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Jumpers/MTPPro/CalcularPrecioMTPPro.Model.php';
}

  /**
   * 
   */
  class CalcularPrecioMTPProController{
    
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
          $CalcularPrecioMTPProModel = new CalcularPrecioMTPPro(); 
          $CalcularPrecioMTPProModel->SetParameters($this->Connection, $this->Tool);
          $CalcularPrecioMTPProModel->SetLongitud($_POST['Longitud']);
          $CalcularPrecioMTPProModel->SetFibra($_POST['Fibra']);
          $CalcularPrecioMTPProModel->SetCantidadFibras($_POST['CantidadFibras']);
          $CalcularPrecioMTPProModel->SetSubcategoriaN1Code($_POST['SubcategoriaN1Code']);
					$CalcularPrecioMTPProModel->SetClienteId(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
          return $CalcularPrecioMTPProModel->Calcular();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
