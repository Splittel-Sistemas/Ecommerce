<?php 

  class CalcularPrecioMPO{
    protected $Connection;
    protected $Tool;

    public $Longitud;
    public $Fibra;
    public $CantidadFibras;
    
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetLongitud($Longitud){
      $this->Longitud  = $Longitud;
    }public function SetFibra($Fibra){
      $this->Fibra  = $Fibra;
    }public function SetCantidadFibras($CantidadFibras){
      $this->CantidadFibras  = $CantidadFibras;
    }
     /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
    */
    public function Calcular(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PrecioJumperMPO(
          ".$this->Longitud.",
          '".$this->Fibra."',
          '".$this->CantidadFibras."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
  