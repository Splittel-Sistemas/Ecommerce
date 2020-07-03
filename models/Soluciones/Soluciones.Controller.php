<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Soluciones")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Soluciones/Soluciones.Model.php';
}

  /**
   * 
   */
  class SolucionesController{
    
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
          $SolucionesModel = new Soluciones_(); 
          $SolucionesModel->SetParameters($this->conn, $this->Tool);
          $items = $SolucionesModel->Get($this->filter, $this->order);
          unset($SolucionesModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetBy(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $SolucionesModel = new Soluciones_(); 
          $SolucionesModel->SetParameters($this->conn, $this->Tool);
          $SolucionesModel->GetBy($this->filter, $this->order);
          return $SolucionesModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Relacionados(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $SolucionesModel = new Soluciones_(); 
          $SolucionesModel->SetParameters($this->conn, $this->Tool);
          $items = $SolucionesModel->Relacionados($this->filter, $this->order);
          unset($SolucionesModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
