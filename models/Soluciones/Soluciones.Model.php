<?php
class Soluciones_{
    public $SolucionesKey;
    public $Descripcion;
    public $Img;
    public $Titulo;
    public $Subtitulo;
    public $Texto;
    public $Subtitulo_1;
    public $Comillas;
    public $Titulo_2;
    public $Subtitulo_2;
    public $Img_2;
    public $Texto_2;
    public $Img_3;
    public $Texto_3;
    public $Img_4;
    public $Texto_4;
    public $Img_5;
    public $Img_6;
    public $Subtitulo_3;
    public $Subtitulo_4;
    public $Subtitulo_5;
    public $Subtitulo_6;
    public $Img_7;
    public $Texto_alt;
    public $Img_alt;
    public $Video;
    public $Img_formulario;
    public $To_formulario;


    public $CasosKey;
    public $Activo;
    public $Fecha;

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
        $SQLSTATEMENT = "SELECT * FROM menu_soluciones ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->SolucionesKey  =   $row->id;
          $this->Descripcion    =   $row->desc_solucion;
          $this->Img            =   $row->img;
          $this->Titulo         =   $row->titulo;
          $this->Subtitulo      =   $row->subtitulo;
          $this->Texto          =   $row->texto;
          $this->Subtitulo_1    =   $row->subtitulo1;
          $this->Comillas       =   $row->comillas;
          $this->Texto_alt      =   $row->texto_alt;
          $this->Img_alt        =   $row->img_alt;
          $this->Subtitulo_2    =   $row->subtitulo2;
          $this->Texto_2        =   $row->texto2;
          $this->Img_2          =   $row->img2;
          $this->Subtitulo_3    =   $row->subtitulo3;
          $this->Texto_3        =   $row->texto3;
          $this->Img_3          =   $row->img3;
          $this->Subtitulo_4    =   $row->subtitulo4;
          $this->Texto_4        =   $row->texto4;
          $this->Img_4          =   $row->img4;
          $this->Img_5          =   $row->img5;
          $this->Subtitulo_5    =   $row->subtitulo5;
          $this->Img_6          =   $row->img6;
          $this->Subtitulo_6    =   $row->subtitulo6;
          $this->Img_7          =   $row->img7;
          $this->Video          =   $row->video;
          $this->Img_formulario =   $row->img_formulario;
          $this->To_formulario  =   $row->to_formulario;
          $this->CasosKey       =   $row->id_casos;
          $this->Activo         =   $row->activo;
          $this->Fecha          =   $row->fecha;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_soluciones ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
          $Soluciones = new Soluciones_();
          $Soluciones->SolucionesKey  =   $row->id;
          $Soluciones->Descripcion    =   $row->desc_solucion;
          $Soluciones->Img            =   $row->img;
          $Soluciones->Titulo         =   $row->titulo;
          $Soluciones->Subtitulo      =   $row->subtitulo;
          $Soluciones->Texto          =   $row->texto;
          $Soluciones->Subtitulo_1    =   $row->subtitulo1;
          $Soluciones->Comillas       =   $row->comillas;
          $Soluciones->Texto_alt      =   $row->texto_alt;
          $Soluciones->Img_alt        =   $row->img_alt;
          $Soluciones->Subtitulo_2    =   $row->subtitulo2;
          $Soluciones->Texto_2        =   $row->texto2;
          $Soluciones->Img_2          =   $row->img2;
          $Soluciones->Subtitulo_3    =   $row->subtitulo3;
          $Soluciones->Texto_3        =   $row->texto3;
          $Soluciones->Img_3          =   $row->img3;
          $Soluciones->Subtitulo_4    =   $row->subtitulo4;
          $Soluciones->Texto_4        =   $row->texto4;
          $Soluciones->Img_4          =   $row->img4;
          $Soluciones->Img_5          =   $row->img5;
          $Soluciones->Subtitulo_5    =   $row->subtitulo5;
          $Soluciones->Img_6          =   $row->img6;
          $Soluciones->Subtitulo_6    =   $row->subtitulo6;
          $Soluciones->Img_7          =   $row->img7;
          $Soluciones->Video          =   $row->video;
          $Soluciones->Img_formulario =   $row->img_formulario;
          $Soluciones->To_formulario  =   $row->to_formulario;
          $Soluciones->CasosKey       =   $row->id_casos;
          $Soluciones->Activo         =   $row->activo;
          $Soluciones->Fecha          =   $row->fecha;
          $data[] = $Soluciones;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Relacionados($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM productos_relacionados_soluciones ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
          $Obj = new stdClass();
          $Obj->Key     =  $row->id_solucion;
          $Obj->Codigo  =  $row->codigo;
          $Obj->Tipo    =  $row->tipo;
          $data[] = $Obj;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
}