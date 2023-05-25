<?php
class SolucionesTop
{
  public $SolucionestopKey;
  public $Nombre;
  public $Ruta;

  public $Banner1;
  public $Texto1;
  public $Banner2;
  public $Icono1_img;
  public $Icono2_img;
  public $Icono3_img;
  public $Icono4_img;
  public $Icono5_img;
  public $Banner3;
  public $App1;
  public $App1_img;
  public $App2;
  public $App2_img;
  public $App3;
  public $App3_img;
  public $App4;
  public $App4_img;
  public $Texto2;
  public $Whatslink;
  public $J1_img;
  public $J2_img;
  public $J3_img;
  public $J4_img;
  public $Texto3;
  public $Activo;
  public $j1_link;
  public $j2_link;
  public $j3_link;
  public $j4_link;
  public $bannerlink;



  protected $Connection;
  protected $Tool;

  public function SetParameters($conn, $Tool)
  {
    $this->Connection = $conn;
    $this->Tool = $Tool;
  }
  private function StartObjects()
  {
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }

  public function GetBy($filter, $order)
  {
    try {
      $SQLSTATEMENT = "SELECT * FROM menu_solucionestop " . $filter . " " . $order;
      // echo $SQLSTATEMENT;
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = false;

      while ($row = $result->fetch_object()) {
        $this->SolucionestopKey  =   $row->id;
        $this->Nombre  =   $row->nombre;
        $this->Ruta  =   $row->ruta;
        $this->Banner1  =$row->banner1;
        $this->Texto1  =$row->texto1;
        $this->Banner2  =$row->banner2;
        $this->Icono1_img  =$row->icono1_img;
        $this->Icono2_img  =$row->icono2_img;
        $this->Icono3_img  =$row->icono3_img;
        $this->Icono4_img  =$row->icono4_img;
        $this->Icono5_img  =$row->icono5_img;
        $this->Banner3  =$row->banner3;
        $this->App1  =$row->app1;
        $this->App1_img  =$row->app1_img;
        $this->App2  =$row->app2;
        $this->App2_img  =$row->app2_img;
        $this->App3  =$row->app3;
        $this->App3_img  =$row->app3_img;
        $this->App4  =$row->app4;
        $this->App4_img  =$row->app4_img;
        $this->Texto2  =$row->texto2;
        $this->Whatslink  =$row->whatslink;
        $this->J1_img  =$row->j1_img;
        $this->J2_img  =$row->j2_img;
        $this->J3_img  =$row->j3_img;
        $this->J4_img  =$row->j4_img;
        $this->Texto3  =$row->texto3;
        $this->Activo  =$row->activo;
        $this->j1_link  =$row->j1_link;
        $this->j2_link  =$row->j2_link;
        $this->j3_link  =$row->j3_link;
        $this->j4_link  =$row->j4_link;
        $this->bannerlink  =$row->bannerlink;

        $data = true;
      }
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function Get($filter, $order)
  {
    try {
      $SQLSTATEMENT = "SELECT * FROM menu_solucionestop " . $filter . " " . $order;
      // echo $SQLSTATEMENT;
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = [];

      while ($row = $result->fetch_object()) {
        $SolucionesTop = new SolucionesTop();
        $SolucionesTop->SolucionestopKey  =   $row->id;
        $SolucionesTop->Nombre  =   $row->nombre;
        $SolucionesTop->Ruta  =   $row->ruta;
        $SolucionesTop->Banner1  =$row->banner1;
        $SolucionesTop->Texto1  =$row->texto1;
        $SolucionesTop->Banner2  =$row->banner2;
        $SolucionesTop->Icono1_img  =$row->icono1_img;
        $SolucionesTop->Icono2_img  =$row->icono2_img;
        $SolucionesTop->Icono3_img  =$row->icono3_img;
        $SolucionesTop->Icono4_img  =$row->icono4_img;
        $SolucionesTop->Icono5_img  =$row->icono5_img;
        $SolucionesTop->Banner3  =$row->banner3;
        $SolucionesTop->App1  =$row->app1;
        $SolucionesTop->App1_img  =$row->app1_img;
        $SolucionesTop->App2  =$row->app2;
        $SolucionesTop->App2_img  =$row->app2_img;
        $SolucionesTop->App3  =$row->app3;
        $SolucionesTop->App3_img  =$row->app3_img;
        $SolucionesTop->App4  =$row->app4;
        $SolucionesTop->App4_img  =$row->app4_img;
        $SolucionesTop->Texto2  =$row->texto2;
        $SolucionesTop->Whatslink  =$row->whatslink;
        $SolucionesTop->J1_img  =$row->j1_img;
        $SolucionesTop->J2_img  =$row->j2_img;
        $SolucionesTop->J3_img  =$row->j3_img;
        $SolucionesTop->J4_img  =$row->j4_img;
        $SolucionesTop->Texto3  =$row->texto3;
        $SolucionesTop->Activo  =$row->activo;
        $SolucionesTop->j1_link  =$row->j1_link;
        $SolucionesTop->j2_link  =$row->j2_link;
        $SolucionesTop->j3_link  =$row->j3_link;
        $SolucionesTop->j4_link  =$row->j4_link;
        $SolucionesTop->bannerlink  =$row->bannerlink;

        $data[] = $SolucionesTop;
      }
      unset($SolucionesTop);
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }
}
