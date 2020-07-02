<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists("Producto")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Productos/Producto.Model.php';
}

  /**
   * 
   */
  class ProductoController{
    
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
          $ProductoModel = new Producto(); 
          $ProductoModel->SetParameters($this->conn, $this->Tool);
          $items = $ProductoModel->Get($this->filter, $this->order);
          unset($ProductoModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function GetBy(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ProductoModel = new Producto(); 
          $ProductoModel->SetParameters($this->conn, $this->Tool);
          $items = $ProductoModel->GetBy($this->filter);
          return $ProductoModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function GetProductosFijos(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ProductoModel = new Producto(); 
          $ProductoModel->SetParameters($this->conn, $this->Tool);
          $items = $ProductoModel->ListProductosFijos("WHERE codigo_configurable = '' AND producto_activo = 'si' ", $this->order);
          unset($ProductoModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function GetProductosFijos_(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ProductoModel = new Producto(); 
          $ProductoModel->SetParameters($this->conn, $this->Tool);
          $items = $ProductoModel->ListProductosFijos($this->filter, $this->order);
          unset($ProductoModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function GetByProductosFijos(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ProductoModel = new Producto(); 
          $ProductoModel->SetParameters($this->conn, $this->Tool);
          $ProductoModel->ListByProductosFijos($this->filter, $this->order);
          return $ProductoModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function GetProductosFijosConfigurables(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ProductoModel = new Producto(); 
          $ProductoModel->SetParameters($this->conn, $this->Tool);
          $items = $ProductoModel->ListProductosFijos($this->filter, $this->order);
          unset($ProductoModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetByProductosFijosConfigurables(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ProductoModel = new Producto(); 
          $ProductoModel->SetParameters($this->conn, $this->Tool);
          $ProductoModel->ListByProductosFijos($this->filter, $this->order);
          return $ProductoModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetProductosMasVendidos(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ProductoModel = new Producto(); 
          $ProductoModel->SetParameters($this->conn, $this->Tool);
          $items = $ProductoModel->ListProductosMasVendidos($this->filter, $this->order);
          unset($ProductoModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetProductosMejorValorados(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ProductoModel = new Producto(); 
          $ProductoModel->SetParameters($this->conn, $this->Tool);
          $items = $ProductoModel->ListProductosMejorValorados($this->filter, $this->order);
          unset($ProductoModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }