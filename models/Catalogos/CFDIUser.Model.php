<?php 

  /**
   * 
   */
  class CFDIUser{

    public $Key;
    public $Clave;
    public $Descripcion;

    public function SetParameters($conn, $Tool){
      $this->conn = $conn;
      $this->Tool = $Tool;
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function Get(){
      try {
        $SQLSTATEMENT = "SELECT * FROM t08_comprobantes_CFDI where t08_f003 = 'si' ";
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $data = array(); 
        while ($row = $result->fetch_object()) {
          $CFDIUser = new CFDIUser();
          $CFDIUser->Key          = $row->t08_pk01;
          $CFDIUser->Clave        = $row->t08_f001;
          $CFDIUser->Descripcion  = $row->t08_f002;
          $data[] = $CFDIUser;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }