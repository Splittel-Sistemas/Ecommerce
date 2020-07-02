<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists("SubcategoriasN1")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Subcategorias/SubcategoriasN1.Model.php';
}

  /**
   * 
   */
  class SubcategoriasN1Controller{
    
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
          $SubcategoriasN1Model = new SubcategoriasN1(); 
          $SubcategoriasN1Model->SetParameters($this->conn, $this->Tool);
          $SubcategoriasN1Model->GetBy($this->filter, $this->order);
          return $SubcategoriasN1Model;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function get(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $SubcategoriasN1Model = new SubcategoriasN1(); 
          $SubcategoriasN1Model->SetParameters($this->conn, $this->Tool);
          $items = $SubcategoriasN1Model->Get($this->filter, $this->order);
          unset($SubcategoriasN1Model);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
