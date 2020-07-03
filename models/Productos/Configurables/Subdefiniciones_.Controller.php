<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("PCSubdefiniciones_")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Configurables/Subdefiniciones_.Model.php';
}

  /**
   * 
   */
  class PCSubdefiniciones_Controller{
    
    protected $Connection;
    protected $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->Connection = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function Get(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $PCSubdefiniciones_Model = new PCSubdefiniciones_(); 
          $PCSubdefiniciones_Model->SetParameters($this->Connection, $this->Tool);
          $Result = $PCSubdefiniciones_Model->Get($this->filter, $this->order);
          return $this->Tool->Message_return(false, "", $Result, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
		}
		
  }
