<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("EnTransito")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/EnTransito/EnTransito.Model.php';
}

  /**
   * 
   */
  class EnTransitoController{
    
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
          $EnTransitoModel = new EnTransito(); 
          $EnTransitoModel->SetParameters($this->conn, $this->Tool);
          $items = $EnTransitoModel->Get($this->filter, "");
          unset($EnTransitoModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }



  }
