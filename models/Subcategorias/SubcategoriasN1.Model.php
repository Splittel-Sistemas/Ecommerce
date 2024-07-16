<?php
class SubcategoriasN1{
    public $Key;
    public $CategoriasKey;
    public $SubcategoriasKey;
    public $Codigo;
    public $Descripcion;
    public $CableCodigo;
    public $NivelConfigurable;
    public $Activo;
    public $Configuracion;
    public $Descuento;

    protected $Connection;
    protected $Tool;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function GetKey(){
      return $this->Key;
    }public function GetCategoriasKey(){
      return $this->CategoriasKey;
    }public function GetSubcategoriasKey(){
      return $this->SubcategoriasKey;
    }public function GetCodigo(){
      return $this->Codigo;
    }public function GetDescripcion(){
      return $this->Descripcion;
    }public function GetCableCodigo(){
      return $this->CableCodigo;
    }public function GetNivelConfigurable(){
      return $this->NivelConfigurable;
    }public function GetActivo(){
      return $this->Activo;
    }public function GetConfiguracion(){
      return $this->Configuracion;
    }public function GetDescuento(){
      return $this->Descuento;
    }

    public function GetBy($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_subcategorias_n1 ".$filter." ".$order;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->Key               =   $row->id;
          $this->CategoriasKey     =   $row->id_categoria;
          $this->SubcategoriasKey  =   $row->id_subcategoria;
          $this->Codigo            =   $row->codigo;
          $this->Descripcion       =   $row->desc_subcategoria;
          $this->FolderName        =   $row->folder_name;
          $this->CableCodigo       =   $row->cable_codigo;
          $this->NivelConfigurable =   $row->nivel_configurable;
          $this->Activo            =   $row->activo;
          $this->Configuracion     =   $row->configuracion;
          $remates = $this->CategoriasKey == "A8" ? true : false;
          $this->Descuento         =   $this->Tool->CalcularDescuento($row->descuento, $remates);
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_subcategorias_n1 ".$filter." ".$order;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];
        if($result){
        while ($row = $result->fetch_object()) {
          $SubcategoriasN1 = new SubcategoriasN1();
          $SubcategoriasN1->Key               =   $row->id;
          $SubcategoriasN1->CategoriasKey     =   $row->id_categoria;
          $SubcategoriasN1->SubcategoriasKey  =   $row->id_subcategoria;
          $SubcategoriasN1->Codigo            =   $row->codigo;
          $SubcategoriasN1->Descripcion       =   $row->desc_subcategoria;
          $SubcategoriasN1->FolderName        =   $row->folder_name;
          $SubcategoriasN1->CableCodigo       =   $row->cable_codigo;
          $SubcategoriasN1->NivelConfigurable =   $row->nivel_configurable;
          $SubcategoriasN1->Activo            =   $row->activo;
          $SubcategoriasN1->Configuracion     =   $row->configuracion;
          $remates = $SubcategoriasN1->CategoriasKey == "A8" ? true : false;
          $SubcategoriasN1->Descuento         =   $this->Tool->CalcularDescuento($row->descuento, $remates);
          $data[] = $SubcategoriasN1;
        }
      }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
}

?>