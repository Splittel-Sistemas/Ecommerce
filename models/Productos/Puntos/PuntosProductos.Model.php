<?php
  
  class PuntosProductos{
    
    protected $Connection;
    protected $Tool;

    public $Key;
    public $Codigo;
    public $Descripcion;
    public $Precio;
    public $Puntos;
    public $Almacen;
    public $CFDI;
    public $Activo;

    public function SetParameters($Connection, $Tool){
      $this->Connection = $Connection;
      $this->Tool = $Tool;
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
          $Obj->Precio      = $row->precio;
          $Obj->Puntos      = $row->puntos;
          $Obj->Almacen     = $row->almacen;
          $Obj->CFDI        = $row->uso_cfdi;
          $Obj->Activo      = $row->activo;
          $data[] = $Obj;
        }
        return $data;
      } catch (Exeption $e) {
        throw $e;
      }
    }


  }
  