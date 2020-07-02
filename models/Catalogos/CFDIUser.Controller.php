<?php 
  if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Connection.php';
  }if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
  }if (!class_exists('CFDIUser')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Catalogos/CFDIUser.Model.php';
  }

  /**
   * 
   */
  class CFDIUserController{
    
    protected $conn;
    protected $Tool;

    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function get(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $CFDIUserModel = new CFDIUser();
          $CFDIUserModel->SetParameters($this->conn, $this->Tool);
          $items = $CFDIUserModel->Get();
          return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $items, false);
        }else{
          throw new Exception("");
        }
      } catch (Exception $e) {
       throw $e; 
      }
    }
  }

 ?>