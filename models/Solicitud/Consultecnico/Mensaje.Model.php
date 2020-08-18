<?php
  class Mensaje{

    protected $Connection;
    protected $Tool;

    public $Key;
    public $Mensaje;
    public $Estatus;
    public $PreguntaKey;

    public function SetMensaje($Mensaje){
      $this->Mensaje = $Mensaje;
    }public function SetEstatus($Estatus){
      $this->Estatus = $Estatus;
    }public function SetPreguntaKey($PreguntaKey){
      $this->PreguntaKey = $PreguntaKey;
    }
    
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
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
        $SQLSTATEMENT = "SELECT * FROM t42_consultecnico_respuestas ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->Key          =   $row->t42_pk01;
          $this->Mensaje      =   $row->t42_f001;
          $this->Estatus      =   $row->t42_f002;
          $this->PreguntaKey  =   $row->t41_pk01;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    /**
     * Listar Pedido 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM t42_consultecnico_respuestas ".$filter." ".$order;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        // echo $SQLSTATEMENT;
        $data = [];

        while ($row = $result->fetch_object()) {
          $Mensaje = new Mensaje();
          $Mensaje->Key          =   $row->t42_pk01;
          $Mensaje->Mensaje      =   $row->t42_f001;
          $Mensaje->Estatus      =   $row->t42_f002;
          $Mensaje->PreguntaKey  =   $row->t41_pk01;
          $data[] = $Mensaje;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Add(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL SolicitudConsultecnicoMensajeCrear(
          '".$this->Mensaje."',
          '".$this->Estatus."',
          '".$this->PreguntaKey."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
  
  }