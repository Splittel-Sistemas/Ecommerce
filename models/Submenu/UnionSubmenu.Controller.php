<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Submenu")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Submenu/UnionSubmenu.Model.php';
}

  /**
   * 
   */
  class UnionSubmenuController{
    
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
          $UnionSubmenuModel = new UnionSubmenu_(); 
          $UnionSubmenuModel->SetParameters($this->conn, $this->Tool);
          $UnionSubmenuModel->GetBy($this->filter, $this->order);
          return $UnionSubmenuModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function get(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $UnionSubmenuModel = new UnionSubmenu_(); 
          $UnionSubmenuModel->SetParameters($this->conn, $this->Tool);
          $items = $UnionSubmenuModel->Get($this->filter, $this->order);
          unset($UnionSubmenuModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    

  }
