<?php
  class Submenu_{
    public $Key;
    public $CategoriaKey;
    public $Descripcion;
    public $FamiliaKey;
    public $Subnivel;
    public $Activo;
    public $DescripcionLarga;
    public $Imagen;

    protected $Connection;
    protected $Tool;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function GetKey(){
      return $this->Key;
    }public function GetSubcategoriasKey(){
      return $this->CategoriasKey;
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
    }public function GetImagen(){
      return $this->Imagen;
    }

    public function GetBy($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_principal ".$filter." ".$order;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->Key               =   $row->id;
          $this->FamiliaKey        =   $row->id_categoria;
          $this->CategoriasKey     =   $row->id_principal;
          $this->Descripcion       =   $row->descripcion;
          $this->nivel             =   $row->nivel;
          $this->DescripcionLarga  =   $row->descripcion_seo;
          $this->Activo            =   $row->activo;
          $this->Imagen            =   $row->imagen;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
   
    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_principal ".$filter." ".$order;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];
        if($result){
        while ($row = $result->fetch_object()) {
            $Submenu = new Submenu_();
            $Submenu->Key               =   $row->id;
            $Submenu->FamiliaKey        =   $row->id_categoria;
            $Submenu->CategoriasKey     =   $row->id_principal;
            $Submenu->Descripcion       =   $row->descripcion;
            $Submenu->nivel             =   $row->nivel;
            
            $Submenu->Activo            =   $row->activo;
            $Submenu->DescripcionLarga  =   $row->descripcion_seo;
            $Submenu->Imagen  =   $row->imagen;
            $data[] = $Submenu;
        }
      }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetByConfigurableCode($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_principal
                            WHERE id IN (SELECT id_menu FROM u_menu_subcategorias 
                              WHERE id_subcategorias IN (SELECT id_subcategoria FROM menu_subcategorias_n1 ".$filter." )) ".$order." LIMIT 1 ";
        //print_r($SQLSTATEMENT);
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
            $Submenu = new Submenu_();
            $Submenu->Key               =   $row->id;
            $Submenu->FamiliaKey        =   $row->id_categoria;
            $Submenu->CategoriasKey     =   $row->id_principal;
            $Submenu->Descripcion       =   $row->descripcion;
            $Submenu->nivel             =   $row->nivel;
            $Submenu->Activo            =   $row->activo;
            $data[] = $Submenu;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function getByFixedCode($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_principal
                          WHERE id IN (SELECT id_menu FROM u_menu_subcategorias 
                            WHERE id_subcategorias IN (SELECT subcategoria FROM catalogo_productos ".$filter.") ) ".$order." LIMIT 1 ";
        
        //print_r($SQLSTATEMENT);
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
            $Submenu = new Submenu_();
            $Submenu->Key               =   $row->id;
            $Submenu->FamiliaKey        =   $row->id_categoria;
            $Submenu->CategoriasKey     =   $row->id_principal;
            $Submenu->Descripcion       =   $row->descripcion;
            $Submenu->nivel             =   $row->nivel;
            $Submenu->Activo            =   $row->activo;
            $data[] = $Submenu;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

  

  }