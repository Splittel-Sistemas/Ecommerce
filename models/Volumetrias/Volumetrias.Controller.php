<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Volumetrias")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Volumetrias/Volumetrias.Model.php';
}

  /**
   * 
   */
  class VolumetriasController{
    
    protected $conn;
    protected $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function Get(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $VolumetriaModel = new Volumetria(); 
          $VolumetriaModel->SetParameters($this->conn, $this->Tool);
          $items = $VolumetriaModel->Get($this->filter, $this->order);
          unset($VolumetriaModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
   

  }