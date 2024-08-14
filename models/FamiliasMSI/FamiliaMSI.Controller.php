<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("FamiliasMSI")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/FamiliasMSI/FamiliaMSI.Model.php';
}

  /**
   * 
   */
  class FamiliasMSIController{
    
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
          $FamiliasMSIModel = new FamiliasMSI(); 
          $FamiliasMSIModel->SetParameters($this->conn, $this->Tool);
          $items = $FamiliasMSIModel->Get($this->filter, "");
          unset($FamiliasMSIModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function getMontoMinimo(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $FamiliasMSIModel = new FamiliasMSI(); 
          $FamiliasMSIModel->SetParameters($this->conn, $this->Tool);
          $items = $FamiliasMSIModel->GetMontoMinimo($this->filter, "");
          unset($FamiliasMSIModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function getSegmentos(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $FamiliasMSIModel = new FamiliasMSI(); 
          $FamiliasMSIModel->SetParameters($this->conn, $this->Tool);
          $items = $FamiliasMSIModel->GetSegmentos($this->filter, "");
          unset($FamiliasMSIModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }




  }
