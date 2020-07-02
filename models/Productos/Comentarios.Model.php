<?php
  class Comentarios{

    protected $Connection;
    protected $Tool;
    
    public $Key;
    public $Titulo;
    public $Descripcion;
    public $Estrellas;
    public $Activo;
    public $ClienteKey;
    public $ProductoKey;
    public $CategoriaKey;
    public $Usuario;
    
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetKey($Key){
      $this->Key = $Key;
    }public function SetTitulo($Titulo){
      $this->Titulo = $Titulo;
    }public function SetDescripcion($Descripcion){
      $this->Descripcion = $Descripcion;
    }public function SetEstrellas($Estrellas){
      $this->Estrellas = $Estrellas;
    }public function SetClienteKey($ClienteKey){
      $this->ClienteKey = $ClienteKey;
    }public function SetProductoKey($ProductoKey){
      $this->ProductoKey = $ProductoKey;
    }public function SetCategoriaKey($CategoriaKey){
      $this->CategoriaKey = $CategoriaKey;
    }
    
    /**
     * Listar Comentarios 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function GetByComentarios($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT 
          t01.t01_f003,
          COUNT(*) AS TotalComentarios,
          ROUND(SUM(t01.t01_f003)/COUNT(*),2) AS Promedio,
        IF(IdCliente = 0, 'Anonimo', CONCAT(t02.nombre,' ', t02.apellidos)) AS Usuario
        FROM t01_comentarios_producto AS t01
        LEFT JOIN login_cliente AS t02
        ON t01.IdCliente = t02.id_cliente ".$filter." ".$order;

        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->Estrellas         =   $row->t01_f003;
          $this->TotalComentarios  =   $row->TotalComentarios;
          $this->Promedio          =   $row->Promedio;
          $this->Usuario           =   $row->Usuario;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
    /**
     * Listar Comentarios 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function ListarComentarios($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT 
          t01.t01_f003,
          COUNT(*) AS TotalComentarios,
          ROUND(SUM(t01.t01_f003)/COUNT(*),2) AS Promedio,
        IF(IdCliente = 0, 'Anonimo', CONCAT(t02.nombre,' ', t02.apellidos)) AS Usuario
        FROM t01_comentarios_producto AS t01
        LEFT JOIN login_cliente AS t02
        ON t01.IdCliente = t02.id_cliente ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
          $Obj = new stdClass();
          $Obj->Estrellas         =   $row->t01_f003;
          $Obj->TotalComentarios  =   $row->TotalComentarios;
          $Obj->Promedio          =   $row->Promedio;
          $Obj->Usuario           =   $row->Usuario;
          $data[] = $Obj;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
    /**
     * Listar Comentarios 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_comentarios ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
          $Obj = new stdClass();
          $Obj->Key           =   $row->t01_pk01;
          $Obj->Titulo        =   $row->t01_f001;
          $Obj->Descripcion   =   $row->t01_f002;
          $Obj->Estrellas     =   $row->t01_f003;
          $Obj->Activo        =   $row->t01_f004;
          $Obj->ClienteKey    =   $row->IdCliente;
          $Obj->ProductoKey   =   $row->IdProducto;
          $Obj->CategoriaKey  =   $row->IdCategoria;
          $Obj->Usuario       =   $row->Usuario;
          $data[] = $Obj;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Add(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL ProductoAgregarComentario(
          '".$this->Key."',
          '".$this->Titulo."',
          '".$this->Descripcion."',
          '".$this->Estrellas."',
          '".$this->ClienteKey."',
          '".$this->ProductoKey."',
          '".$this->CategoriaKey."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
  
  }