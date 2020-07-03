<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("PCDefiniciones")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Configurables/Definiciones.Model.php';
}

  /**
   * 
   */
  class PCDefinicionesController{
    
    protected $Connection;
    protected $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->Connection = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function GetBy(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $PCDefinicionesModel = new PCDefiniciones(); 
          $PCDefinicionesModel->SetParameters($this->Connection, $this->Tool);
          $PCDefinicionesModel->GetBy($this->filter, $this->order);
          return $PCDefinicionesModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
		}
		
  }
