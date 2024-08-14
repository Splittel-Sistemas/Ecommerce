<?php
class FamiliasMSI
{
  public $CategoriaKey;
  public $CodigoKey;
  public $Activo;
  public $Monto;
  public $MontoKey;

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
  public function GetMontoKey()
  {
    return $this->MontoKey;
  }
  public function GetCategoriaKey()
  {
    return $this->CategoriaKey;
  }
  public function GetSegmentoKey()
  {
    return $this->SegmentoKey;
  }
  public function GetCodigoKey()
  {
    return $this->CodigoKey;
  }
  public function GetActivo()
  {
    return $this->Activo;
  }
  public function GetMonto()
  {
    return $this->Monto;
  }
  
  public function Get($filter, $order)
  {
    try {
      $SQLSTATEMENT = "SELECT * FROM t56_familias_msi " . $filter . " " . $order;
      // echo $SQLSTATEMENT;
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = [];
   
      while ($row = $result->fetch_object()) {
        $Categoria = new FamiliasMSI();
        $Categoria->CategoriaKey     =   $row->id;
        $Categoria->CodigoKey        =   $row->familia;
        $Categoria->Activo           =   $row->activo;
        $data[] = $Categoria;
      }
    
      unset($Categoria);
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function GetMontoMinimo($filter, $order)
  {
    try {
      $SQLSTATEMENT = "SELECT * FROM t58_minimo_msi " . $filter . " " . $order;
       //echo $SQLSTATEMENT;
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = [];
 
      while ($row = $result->fetch_object()) {
        $Categoria = new FamiliasMSI();
        $Categoria->MontoKey     =   $row->id;
        $Categoria->Monto        =   $row->monto;
        $data[] = $Categoria;
      }
    
      unset($Categoria);
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function GetSegmentos($filter, $order)
  {
    try {
      $SQLSTATEMENT = "SELECT * FROM t59_segmentos_msi " . $filter . " " . $order;
      // echo $SQLSTATEMENT;
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = [];
    
      while ($row = $result->fetch_object()) {
        $Categoria = new FamiliasMSI();
        $Categoria->SegmentoKey     =   $row->id;
        $Categoria->Segmento        =   $row->segmento;
        $Categoria->Activo           =   $row->activo;
        $data[] = $Categoria;
      }
  
      unset($Categoria);
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }

}
