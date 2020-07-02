<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists("PCSubdefiniciones")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Productos/Configurables/Subdefiniciones.Model.php';
}

  /**
   * 
   */
  class PCSubdefinicionesController{
    
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
          $PCSubdefinicionesModel = new PCSubdefiniciones(); 
          $PCSubdefinicionesModel->SetParameters($this->Connection, $this->Tool);
          $Result = $PCSubdefinicionesModel->Get($this->filter, $this->order);
          return $this->Tool->Message_return(false, "", $Result, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
		}
		
  }
