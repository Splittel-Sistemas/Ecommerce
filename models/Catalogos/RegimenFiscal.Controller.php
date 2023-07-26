<?php 
  if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Connection.php';
  }if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists('RegimenFiscal')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Catalogos/RegimenFiscal.Model.php';
  }

  /**
   * 
   */
  class RegimenFiscalController{
    
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
          $RegimenFiscalModel = new RegimenFiscal();
          $RegimenFiscalModel->SetParameters($this->conn, $this->Tool);
          $items = $RegimenFiscalModel->Get();
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