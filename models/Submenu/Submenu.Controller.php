<?php 

@session_start();
if (!class_exists("Submenu")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Submenu/Submenu.Model.php';
}

  /**
   * 
   */
  class SubmenuController{
    
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
          $SubmenuModel = new Submenu_(); 
          $SubmenuModel->SetParameters($this->conn, $this->Tool);
          $SubmenuModel->GetBy($this->filter, $this->order);
          return $SubmenuModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function get(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $SubmenuModel = new Submenu_(); 
          $SubmenuModel->SetParameters($this->conn, $this->Tool);
          $items = $SubmenuModel->Get($this->filter, $this->order);
          unset($SubmenuModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    

  }
