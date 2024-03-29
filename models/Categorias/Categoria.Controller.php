<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Categoria")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Categorias/Categoria.Model.php';
}

  /**
   * 
   */
  class CategoriaController{
    
    private $conn;
    private $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function get(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $CategoriaModel = new Categoria(); 
          $CategoriaModel->SetParameters($this->conn, $this->Tool);
          $items = $CategoriaModel->Get($this->filter, " ORDER BY orden ASC");
          unset($CategoriaModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function getBy(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $CategoriaModel = new Categoria(); 
          $CategoriaModel->SetParameters($this->conn, $this->Tool);
          $CategoriaModel->GetBy($this->filter, " ORDER BY orden ASC");
          return $CategoriaModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function ListarCategoriasConsultecnico(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $CategoriaModel = new Categoria(); 
          $CategoriaModel->SetParameters($this->conn, $this->Tool);
          $items =  $CategoriaModel->ListarConsultecnico($this->filter, " ORDER BY orden ASC");
          unset($CategoriaModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function estructura(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $CategoriaModel = new Categoria(); 
          $CategoriaModel->SetParameters($this->conn, $this->Tool);
          $CategoriaModel->Estructura($this->filter, $this->order);
          return $CategoriaModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
