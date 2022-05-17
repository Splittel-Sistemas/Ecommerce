<?php
class Soluciones_{
    public $SolucionesKey;
    public $Titulo;
    public $Subtitulo;
    public $Img_1;
    public $Link_1;
    public $Img_2;
    public $Link_2;
    public $Img_3;
    public $Link_3;
    public $Titulo1;
    public $Texto;
    public $Link_4;


    public $Activo;

    protected $Connection;
    protected $Tool;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }
    private function StartObjects(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function GetBy($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_soluciones_ ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->SolucionesKey  =   $row->id;
          $this->Titulo         =   $row->titulo;
          $this->Subtitulo      =   $row->subtitulo;
          $this->Texto          =   $row->texto;
          $this->Img_1         =   $row->imagen1;
          $this->Link_1        =   $row->link1;
          $this->Img_2         =   $row->imagen2;
          $this->Link_2        =   $row->link2;
          $this->Img_3         =   $row->imagen3;
          $this->Link_3        =   $row->link3;
          $this->Activo         =   $row->activo;
          $this->Titulo1        =   $row->titulo1;
          $this->Link_4        =   $row->link4;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_soluciones_ ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
          $Soluciones = new Soluciones_();
          $Soluciones->SolucionesKey  =   $row->id;
          $Soluciones->SolucionesKey  =   $row->id;
          $Soluciones->Titulo         =   $row->titulo;
          $Soluciones->Subtitulo      =   $row->subtitulo;
          $Soluciones->Texto          =   $row->texto;
          $Soluciones->Img_1        =   $row->imagen1;
          $Soluciones->Link_1       =   $row->link1;
          $Soluciones->Img_2        =   $row->imagen2;
          $Soluciones->Link_2       =   $row->link2;
          $Soluciones->Img_3        =   $row->imagen3;
          $Soluciones->Link_3       =   $row->link3;
          $Soluciones->Activo         =   $row->activo;
          $Soluciones->Titulo1         =   $row->titulo1;
          $Soluciones->Link_4       =   $row->link4;
          $data[] = $Soluciones;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

   
}