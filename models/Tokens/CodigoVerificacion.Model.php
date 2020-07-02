<?php

  class CodigoVerificacion{

    protected $Connection;
    protected $Tool;

    public $Key;
    public $Codigo;
    public $Estatus;
    public $PedidoKey;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetKey($Key){
      $this->Key = $Key;
    }public function SetCodigo($Codigo){
      $this->Codigo = $Codigo;
    }public function SetEstatus($Estatus){
      $this->Estatus = $Estatus;
    }public function SetPedidoKey($PedidoKey){
      $this->PedidoKey = $PedidoKey;
    }

    public function GetKey(){
      return $this->Key;
    }public function GetCodigo(){
      return $this->Codigo;
    }public function GetEstatus(){
      return $this->Estatus;
    }public function GetPedidoKey(){
      return $this->PedidoKey;
    }

    /**
     * Listar Pedido 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function GetBy($filter){
      try {
        $SQLSTATEMENT = "SELECT * FROM t37_codigo_verificacion ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->Key                  =   $row->t37_pk01;
          $this->Codigo               =   $row->t37_f001;
          $this->Estatus   =   $row->t37_f002;
          $this->PedidoKey            =   $row->pedidokey;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
    
    public function create(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoB2BCrearCodigoVerificacion(
          '".$this->Codigo."',
          '".$this->PedidoKey."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function update(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoB2BCrearCodigoVerificacion(
          '".$this->Codigo."',
          '".$this->PedidoKey."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
  