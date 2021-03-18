<?php
  class UnionSubmenu_{
    public $Key;
    public $SubcategoriaKey;
   

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
    }

    public function GetBy($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM u_menu_subcategorias ".$filter." ".$order;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->Key               =   $row->id_menu;
          $this->SubcategoriaKey   =   $row->id_subcategorias;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
   
    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM u_menu_subcategorias ".$filter." ".$order;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
       
        $data = [];

        while ($row = $result->fetch_object()) {
            $UnionSubmenu = new UnionSubmenu_();
            $UnionSubmenu->Key               =   $row->id_menu;
            $UnionSubmenu->SubcategoriaKey   =   $row->id_subcategorias;
            
            //$Subcategorias->DescripcionLarga  =   $row->descripcion;
            $data[] = $UnionSubmenu;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

  

  }