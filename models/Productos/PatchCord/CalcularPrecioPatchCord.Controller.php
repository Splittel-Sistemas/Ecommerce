<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("CalcularPrecioPatchCord")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/PatchCord/CalcularPrecioPatchCord.Model.php';
}

  /**
   * 
   */
  class CalcularPrecioPatchCordController{
    
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
          $CalcularPrecioPatchCordModel = new CalcularPrecioPatchCord(); 
          $CalcularPrecioPatchCordModel->SetParameters($this->Connection, $this->Tool);
          $CalcularPrecioPatchCordModel->SetLongitud($_POST['Longitud']);
          $CalcularPrecioPatchCordModel->SetCategoria($_POST['Categoria']);
          $CalcularPrecioPatchCordModel->SetSubcategoriaN1Code($_POST['SubcategoriaN1Code']);
					$CalcularPrecioPatchCordModel->SetClienteId(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
          return $CalcularPrecioPatchCordModel->Calcular();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
