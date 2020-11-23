<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("CalcularPrecioPigtail")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Pigtails/CalcularPrecioPigtail.Model.php';
}

  /**
   * 
   */
  class CalcularPrecioPigtailController{
    
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
          $CalcularPrecioPigtailModel = new CalcularPrecioPigtail(); 
          $CalcularPrecioPigtailModel->SetParameters($this->Connection, $this->Tool);
          $CalcularPrecioPigtailModel->SetLongitud($_POST['Longitud']);
          $CalcularPrecioPigtailModel->SetNumeroHilos($_POST['NumeroHilos']);
          $CalcularPrecioPigtailModel->SetConector($_POST['Conector']);
          $CalcularPrecioPigtailModel->SetFibra($_POST['Fibra']);
          $CalcularPrecioPigtailModel->SetDiametro($_POST['Diametro']);
          $CalcularPrecioPigtailModel->SetPulido($_POST['Pulido']);
          $CalcularPrecioPigtailModel->SetCodigo($_POST['Codigo']);
          $CalcularPrecioPigtailModel->SetSubcategoriaN1Code($_POST['SubcategoriaN1Code']);
					$CalcularPrecioPigtailModel->SetClienteId(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
          return $CalcularPrecioPigtailModel->Calcular();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
