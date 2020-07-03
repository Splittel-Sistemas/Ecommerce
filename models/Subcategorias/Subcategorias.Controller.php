<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Subcategorias")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Subcategorias/Subcategorias.Model.php';
}

  /**
   * 
   */
  class SubcategoriasController{
    
    protected $conn;
    protected $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function getBy(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $SubcategoriasModel = new Subcategorias_(); 
          $SubcategoriasModel->SetParameters($this->conn, $this->Tool);
          $SubcategoriasModel->GetBy($this->filter, $this->order);
          return $SubcategoriasModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function get(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $SubcategoriasModel = new Subcategorias_(); 
          $SubcategoriasModel->SetParameters($this->conn, $this->Tool);
          $items = $SubcategoriasModel->Get($this->filter, $this->order);
          unset($SubcategoriasModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
