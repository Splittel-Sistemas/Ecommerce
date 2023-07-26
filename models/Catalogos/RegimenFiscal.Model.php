<?php 

  /**
   * 
   */
  class RegimenFiscal{

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
        $SQLSTATEMENT = "SELECT * FROM t53_regimen_fiscal where activo = 'si' ";
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $data = array(); 
        while ($row = $result->fetch_object()) {
          $RegimenFiscal = new RegimenFiscal();
          $RegimenFiscal->Key          = $row->id;
          $RegimenFiscal->Clave        = $row->id_regimen;
          $RegimenFiscal->Descripcion  = $row->descripcion;
          $data[] = $RegimenFiscal;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }