<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Consultecnico")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Solicitud/Consultecnico/Consultecnico.Model.php';
}

  /**
   * 
   */
  class ConsultecnicosController{
    
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
          $ConsultecnicoModel = new Consultecnico(); 
          $ConsultecnicoModel->SetParameters($this->Connection, $this->Tool);
          $items = $ConsultecnicoModel->Get($this->filter);
          unset($ConsultecnicoModel);
          return $this->Tool->Message_return(false, "", $items, false);
          
        }
      } catch (Exception $e) {
        throw $e;
      }
    }


  }