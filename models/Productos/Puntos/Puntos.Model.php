<?php
  
  class Puntos{
    
    protected $Connection;
    protected $Tool;

    public $Key;
    public $PedidoKey;
    public $Total;
    public $Tipo;

    public function SetParameters($Connection, $Tool){
      $this->Connection = $Connection;
      $this->Tool = $Tool;
    }

    public function SetPedidoKey($PedidoKey){
      $this->PedidoKey = $PedidoKey;
    }public function SetTotal($Total){
      $this->Total = $Total;
    }public function SetTipo($Tipo){
      $this->Tipo = $Tipo;
    }

    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM t40_punto_a_punto ".$filter." ".$order." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];
        while($row = $result->fetch_object()){
          $Obj = new Puntos();
          $Obj->Key         = $row->t40_pk01;
          $Obj->Total       = $row->t40_f001;
          $Obj->Tipo        = $row->t40_f002;
          $Obj->PedidoKey   = $row->pedidokey;
          $data[] = $Obj;
        }
        return $data;
      } catch (Exeption $e) {
        throw $e;
      }
    }

    public function GetPedidosPuntos(){
      try {
        $SQLSTATEMENT = "SELECT
          id, 
          id_cliente,
            estatus,
            SUM(Subtotal) AS totalSubtotal,
            TRUNCATE((SUM(Subtotal) / 100 ),0) AS totalPuntosbyPedido
        FROM cotizacion_encabezado
        WHERE estatus = 'P'
        GROUP BY id ";

        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];
        while($row = $result->fetch_object()){
          $data[] = $row;
        }
        return $data;
      } catch (Exeption $e) {
        throw $e;
      }
    }

    public function Create(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PuntosByPedidoCreate(
          '".$this->PedidoKey."',
          '".$this->Total."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }


  }
  