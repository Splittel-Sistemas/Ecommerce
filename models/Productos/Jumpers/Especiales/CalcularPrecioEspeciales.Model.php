<?php 

  class CalcularPrecioEspeciales{
    protected $Connection;
    protected $Tool;

    public $Longitud;
    public $TipoJumper;
    public $Conector_1;
    public $Conector_2;
    public $Fibra;
    public $Pulido_1;
    public $Pulido_2;
    public $Cubierta;
    public $NumeroHilos;
    public $Bota_1;
    public $Bota_2;
    
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetLongitud($Longitud){
      $this->Longitud  = $Longitud;
    }public function SetTipoJumper($TipoJumper){
      $this->TipoJumper  = $TipoJumper;
    }public function SetConector_1($Conector_1){
      $this->Conector_1  = $Conector_1;
    }public function SetConector_2($Conector_2){
      $this->Conector_2  = $Conector_2;
    }public function SetPulido_1($Pulido_1){
      $this->Pulido_1 = $Pulido_1;
    }public function SetPulido_2($Pulido_2){
      $this->Pulido_2 = $Pulido_2;
    }public function SetFibra($Fibra){
      $this->Fibra  = $Fibra;
    }public function SetCubierta($Cubierta){
      $this->Cubierta  = $Cubierta;
    }public function SetNumeroHilos($NumeroHilos){
      $this->NumeroHilos  = $NumeroHilos;
    }public function SetBota_1($Bota_1){
      $this->Bota_1  = $Bota_1;
    }public function SetBota_2($Bota_2){
      $this->Bota_2  = $Bota_2;
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
        $result = $this->Connection->Exec_store_procedure_json("CALL PrecioJumpersEspeciales(
          ".$this->Longitud.",
          '".$this->TipoJumper."',
          '".$this->Conector_1."',
          '".$this->Conector_2."',
          '".$this->Fibra."',
          '".$this->Pulido_1."',
          '".$this->Pulido_2."',
          '".$this->Cubierta."',
          '".$this->NumeroHilos."',
          '".$this->Bota_1."',
          '".$this->Bota_2."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
  