<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("CalcularPrecioCableServicio")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/CableServicio/CalcularPrecioCableServicio.Model.php';
}

  /**
   * 
   */
  class CalcularPrecioCableServicioController{
    
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
          $CalcularPrecioCableServicioModel = new CalcularPrecioCableServicio(); 
          $CalcularPrecioCableServicioModel->SetParameters($this->Connection, $this->Tool);
          $CalcularPrecioCableServicioModel->SetLongitud($_POST['Longitud']);
          $CalcularPrecioCableServicioModel->SetNumeroHilos($_POST['NumeroHilos']);
          $CalcularPrecioCableServicioModel->SetSubcategoriaN1Code($_POST['SubcategoriaN1Code']);
					$CalcularPrecioCableServicioModel->SetClienteId(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
          return $CalcularPrecioCableServicioModel->Calcular();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
