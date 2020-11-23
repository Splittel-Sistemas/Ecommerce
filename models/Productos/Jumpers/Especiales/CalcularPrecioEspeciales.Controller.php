<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("CalcularPrecioEspeciales")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Jumpers/Especiales/CalcularPrecioEspeciales.Model.php';
}

  /**
   * 
   */
  class CalcularPrecioEspecialesController{
    
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
          $CalcularPrecioEspecialesModel = new CalcularPrecioEspeciales(); 
          $CalcularPrecioEspecialesModel->SetParameters($this->Connection, $this->Tool);
          $CalcularPrecioEspecialesModel->SetLongitud($_POST['Longitud']);
          $CalcularPrecioEspecialesModel->SetTipoJumper($_POST['TipoJumper']);
          $CalcularPrecioEspecialesModel->SetConector_1($_POST['Conector_1']);
          $CalcularPrecioEspecialesModel->SetConector_2($_POST['Conector_2']);
          $CalcularPrecioEspecialesModel->SetFibra($_POST['Fibra']);
          $CalcularPrecioEspecialesModel->SetPulido_1($_POST['Pulido_1']);
          $CalcularPrecioEspecialesModel->SetPulido_2($_POST['Pulido_2']);
          $CalcularPrecioEspecialesModel->SetCubierta($_POST['Cubierta']);
          $CalcularPrecioEspecialesModel->SetNumeroHilos($_POST['NumeroHilos']);
          $CalcularPrecioEspecialesModel->SetBota_1($_POST['Bota_1']);
          $CalcularPrecioEspecialesModel->SetBota_2($_POST['Bota_2']);
          $CalcularPrecioEspecialesModel->SetSubcategoriaN1Code($_POST['SubcategoriaN1Code']);
					$CalcularPrecioEspecialesModel->SetClienteId(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
          return $CalcularPrecioEspecialesModel->Calcular();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
