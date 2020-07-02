<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists("CheckPointDHL")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Paqueteria/DHL/CheckPointDHL.Model.php';
}

  /**
   * 
   */
  class CheckPointDHLController{
    
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
          $CheckPointDHLModel = new CheckPointDHL(); 
          $CheckPointDHLModel->SetParameters($this->conn, $this->Tool);
          $CheckPointDHLModel->GetBy($this->filter, $this->order);
          return $CheckPointDHLModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function get(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $CheckPointDHLModel = new CheckPointDHL(); 
          $CheckPointDHLModel->SetParameters($this->conn, $this->Tool);
          $items = $CheckPointDHLModel->Get($this->filter, $this->order);
          unset($CheckPointDHLModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
