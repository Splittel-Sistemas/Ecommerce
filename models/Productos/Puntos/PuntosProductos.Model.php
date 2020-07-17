<?php
  
  class PuntosProductos{
    
    protected $Connection;
    protected $Tool;

    public $Key;
    public $Codigo;
    public $Descripcion;
    public $NombreImg;
    public $Precio;
    public $Puntos;
    public $Almacen;
    public $CFDI;
    public $Activo;
    public $ExisteSap;

    public function SetParameters($Connection, $Tool){
      $this->Connection = $Connection;
      $this->Tool = $Tool;
    }

    public function GetBy($filter){
      try {
        $SQLSTATEMENT = "SELECT * FROM catalogo_productos_puntos ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;
        while($row = $result->fetch_object()){
          $this->Key         = $row->id;
          $this->Codigo      = $row->codigo;
          $this->Descripcion = $row->desc_producto;
          $this->NombreImg   = $row->nombre_imagen;
          $this->Precio      = $row->precio;
          $this->Puntos      = $row->puntos;
          $this->Almacen     = $row->almacen;
          $this->Activo      = $row->activo;
          $this->ExisteSap   = $row->existe_sap;
          $data = true;
        }
        return $data;
      } catch (Exeption $e) {
        throw $e;
      }
    }

    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM catalogo_productos_puntos ".$filter." ".$order." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];
        while($row = $result->fetch_object()){
          $Obj = new PuntosProductos();
          $Obj->Key         = $row->id;
          $Obj->Codigo      = $row->codigo;
          $Obj->Descripcion = $row->desc_producto;
          $Obj->NombreImg   = $row->nombre_imagen;
          $Obj->Precio      = $row->precio;
          $Obj->Puntos      = $row->puntos;
          $Obj->Almacen     = $row->almacen;
          $Obj->Activo      = $row->activo;
          $Obj->ExisteSap   = $row->existe_sap;
          $data[] = $Obj;
        }
        return $data;
      } catch (Exeption $e) {
        throw $e;
      }
    }


  }
  