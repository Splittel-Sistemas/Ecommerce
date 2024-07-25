<?php
class FamiliasMSI
{
  public $CategoriaKey;
  public $CodigoKey;
  public $Activo;


  protected $Connection;
  protected $Tool;

  private function StartObjects()
  {
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }

  public function SetParameters($conn, $Tool)
  {
    $this->Connection = $conn;
    $this->Tool = $Tool;
  }

  public function GetCategoriaKey()
  {
    return $this->CategoriaKey;
  }
  public function GetCodigoKey()
  {
    return $this->CodigoKey;
  }
  public function GetActivo()
  {
    return $this->Activo;
  }
  
  public function Get($filter, $order)
  {
    try {
      $SQLSTATEMENT = "SELECT * FROM t56_familias_msi " . $filter . " " . $order;
      // echo $SQLSTATEMENT;
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = [];
      if($row = $result->fetch_object()){
      while ($row = $result->fetch_object()) {
        $Categoria = new FamiliasMSI();
        $Categoria->CategoriaKey     =   $row->id;
        $Categoria->CodigoKey        =   $row->familia;
        $Categoria->Activo           =   $row->activo;
        $data[] = $Categoria;
      }
    }
      unset($Categoria);
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }

}
