<?php 

class CheckPointDHL{
  public $Key;
  public $CheckPointKey;
  public $Descripcion;

  protected $Connection;
  protected $Tool;

  public function SetParameters($conn, $Tool){
    $this->Connection = $conn;
    $this->Tool = $Tool;
  }

  public function GetKey(){
    return $this->Key;
  }public function GetCheckPointKey(){
    return $this->CheckPointKey;
  }public function GetDescripcion(){
    return $this->Descripcion;
  }

  public function GetBy($filter, $order){
    try {
      $SQLSTATEMENT = "SELECT * FROM t32_checkpoint_dhl ".$filter." ".$order;
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = false;

      while ($row = $result->fetch_object()) {
        $this->Key            =   $row->t32_pk01;
        $this->CheckPointKey  =   $row->t32_f001;
        $this->Descripcion    =   $row->t32_f002;
        $data = true;
      }
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function Get($filter, $order){
    try {
      $SQLSTATEMENT = "SELECT * FROM t32_checkpoint_dhl ".$filter." ".$order;
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = [];

      while ($row = $result->fetch_object()) {
        $CheckPointDHL = new CheckPointDHL();
        $CheckPointDHL->Key            =   $row->t32_pk01;
        $CheckPointDHL->CheckPointKey  =   $row->t32_f001;
        $CheckPointDHL->Descripcion    =   $row->t32_f002;
        $data[] = $CheckPointDHL;
      }
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }
}