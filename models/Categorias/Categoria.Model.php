<?php
  if (!class_exists("PreguntaC")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Solicitud/Consultecnico/Pregunta.Model.php';
  }

  class Categoria{
    public $CategoriaKey;
    public $CodigoKey;
    public $Descripcion;
    public $Img;
    public $Activo;
    public $Menu1;
    public $Menu2;
    public $DescripcionLarga;

    protected $Connection;
    protected $Tool;

    private function StartObjects(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }
    
    public function SetParameters($conn, $Tool){
        $this->Connection = $conn;
        $this->Tool = $Tool;
    }
    
    public function GetCategoriaKey(){
      return $this->CategoriaKey;
    }public function GetCodigoKey(){
      return $this->CodigoKey;
    }public function GetDescripcion(){
      return $this->Descripcion;
    }public function GetImg(){
      return $this->Img;
    }public function GetActivo(){
      return $this->Activo;
    }public function GetMenu1(){
      return $this->Menu1;
    }public function GetMenu2(){
      return $this->Menu2;
    }public function GetDescripcionLarga(){
      return $this->DescripcionLarga;
    }

    public function GetBy($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_categorias ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
            $this->CategoriaKey     =   $row->id;
            $this->CodigoKey        =   $row->id_codigo;
            $this->Descripcion      =   $row->desc_familia;
            $this->Img              =   $row->id_imagen;
            $this->Activo           =   $row->activo;
            $this->Menu1            =   $row->menu1;
            $this->Menu2            =   $row->menu2;
            $this->DescripcionLarga =   $row->descripcion;
            $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_categorias ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
            $Categoria = new Categoria();
            $Categoria->CategoriaKey     =   $row->id;
            $Categoria->CodigoKey        =   $row->id_codigo;
            $Categoria->Descripcion      =   $row->desc_familia;
            $Categoria->Img              =   $row->id_imagen;
            $Categoria->Activo           =   $row->activo;
            $Categoria->Menu1            =   $row->menu1;
            $Categoria->Menu2            =   $row->menu2;
            $Categoria->DescripcionLarga =   $row->descripcion;
            $data[] = $Categoria;
        }
        unset($Categoria);
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function ListarConsultecnico($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_categorias ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];
        $Pregunta = new PreguntaC();
        $Pregunta->SetParameters($this->Connection, $this->Tool);

        while ($row = $result->fetch_object()) {
            $Categoria = new Categoria();
            $Categoria->CodigoKey        =   $row->id_codigo;
            $Categoria->Descripcion      =   $row->desc_familia;
            $Categoria->Pregunta         =   $Pregunta->Get_("WHERE t41_f004 ='".$Categoria->CodigoKey."' AND t41_f006 = 1 GROUP BY t41_f004");
            $data[] = $Categoria;
        }
        unset($Categoria);
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Estructura($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_categorias ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->CategoriaKey              =  $row->id_categoria;
          $this->CategoriaCodigoKey        =  $row->id_codigo;
          $this->CategoriaDescripcion      =  $row->desc_familia;
          $this->CategoriaImg              =  $row->id_imagen;
          $this->CategoriaActivo           =  $row->activo;
          $this->CategoriaFolderName       =  str_replace(' ', '', $row->folder_name_categoria);
          $this->SubcategoriaDescripcion   =  $row->t1_desc_subcategoria;
          $this->SubcategoriaFolderName    =  str_replace(' ', '', $row->folder_name_subcategoria);
          $this->SubcategoriaSubnivel      =  $row->subnivel;
          $this->SubcategoriaN1Key         =  $row->t2_id_subcategoria;
          $this->SubcategoriaN1Codigo      =  $row->cable_codigo;
          $this->SubcategoriaN1Descripcion =  $row->t2_desc_subcategoria;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
  }