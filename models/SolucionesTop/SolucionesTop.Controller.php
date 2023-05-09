<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}
if (!class_exists("SolucionesTop")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/SolucionesTop/SolucionTop.Model.php';

}
  /**
   * 
   */
  class SolucionesTopController{
    
    private $conn;
    private $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function Get(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $SolucionesTopModel = new SolucionesTop(); 
          $SolucionesTopModel->SetParameters($this->conn, $this->Tool);
          $items = $SolucionesTopModel->Get($this->filter, $this->order);
          unset($SolucionesTopModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetBy(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $SolucionesTopModel = new SolucionesTop(); 
          $SolucionesTopModel->SetParameters($this->conn, $this->Tool);
          $SolucionesTopModel->GetBy($this->filter, $this->order);
          return $SolucionesTopModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Relacionados(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $SolucionesTopModel = new SolucionesTop(); 
          $SolucionesTopModel->SetParameters($this->conn, $this->Tool);
          $items = $SolucionesTopModel->Relacionados($this->filter, $this->order);
          unset($SolucionesTopModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
