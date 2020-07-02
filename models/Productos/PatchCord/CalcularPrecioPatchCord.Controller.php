<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists("CalcularPrecioPatchCord")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Productos/PatchCord/CalcularPrecioPatchCord.Model.php';
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
          return $CalcularPrecioPatchCordModel->Calcular();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
