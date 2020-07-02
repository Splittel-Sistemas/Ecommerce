<?php
  class Subcategorias_{
    public $Key;
    public $SubcategoriasKey;
    public $Descripcion;
    public $FamiliaKey;
    public $Subnivel;
    public $Activo;
    public $DescripcionLarga;

    protected $Connection;
    protected $Tool;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function GetKey(){
      return $this->Key;
    }public function GetSubcategoriasKey(){
      return $this->SubcategoriasKey;
    }public function GetDescripcion(){
      return $this->Descripcion;
    }public function GetFamiliaKey(){
      return $this->FamiliaKey;
    }public function GetSubnivel(){
      return $this->Subnivel;
    }public function GetActivo(){
      return $this->Activo;
    }public function GetDescripcionLarga(){
      return $this->DescripcionLarga;
    }

    public function GetBy($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_subcategorias ".$filter." ".$order;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->Key               =   $row->id;
          $this->SubcategoriasKey  =   $row->id_subcategoria;
          $this->Descripcion       =   $row->desc_subcategoria;
          $this->FamiliaKey        =   $row->id_familia;
          $this->Subnivel          =   $row->subnivel;
          $this->Activo            =   $row->activo;
          $this->DescripcionLarga  =   $row->descripcion;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_subcategorias ".$filter." ".$order;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
            $Subcategorias = new Subcategorias_();
            $Subcategorias->Key               =   $row->id;
            $Subcategorias->SubcategoriasKey  =   $row->id_subcategoria;
            $Subcategorias->Descripcion       =   $row->desc_subcategoria;
            $Subcategorias->FamiliaKey        =   $row->id_familia;
            $Subcategorias->Subnivel          =   $row->subnivel;
            $Subcategorias->Activo            =   $row->activo;
            $Subcategorias->DescripcionLarga  =   $row->descripcion;
            $data[] = $Subcategorias;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
  }