<?php
  
  class PuntosCanjeados{
    
    protected $Connection;
    protected $Tool;

    public $Key;
    public $ClienteKey;
    public $ProductoPuntosKey;

    public function SetParameters($Connection, $Tool){
      $this->Connection = $Connection;
      $this->Tool = $Tool;
    }

    public function SetPedidoKey($PedidoKey){
      $this->PedidoKey = $PedidoKey;
    }public function SetClienteKey($ClienteKey){
      $this->ClienteKey = $ClienteKey;
    }public function SetProductoPuntosKey($ProductoPuntosKey){
      $this->ProductoPuntosKey = $ProductoPuntosKey;
    }

    public function Create(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PuntosCanjeadosAgregar(
          '".$this->ClienteKey."',
          '".$this->ProductoPuntosKey."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
  