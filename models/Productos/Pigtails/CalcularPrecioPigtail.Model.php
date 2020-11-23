<?php 

  class CalcularPrecioPigtail{
    protected $Connection;
    protected $Tool;

    public $Longitud;
    public $NumeroHilos;
    public $Conector;
    public $Fibra;
    public $Diametro;
    public $Pulido;
    public $Codigo;
    public $SubcategoriaN1Code;
		public $ClienteId;
    
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetLongitud($Longitud){
      $this->Longitud  = $Longitud;
    }public function SetNumeroHilos($NumeroHilos){
      $this->NumeroHilos  = $NumeroHilos;
    }public function SetConector($Conector){
      $this->Conector  = $Conector;
    }public function SetFibra($Fibra){
      $this->Fibra  = $Fibra;
    }public function SetDiametro($Diametro){
      $this->Diametro  = $Diametro;
    }public function SetPulido($Pulido){
      $this->Pulido  = $Pulido;
    }public function SetCodigo($Codigo){
			$this->Codigo  = $Codigo;
		}public function SetSubcategoriaN1Code($SubcategoriaN1Code){
			$this->SubcategoriaN1Code  = $SubcategoriaN1Code;
		}public function SetClienteId($ClienteId){
			$this->ClienteId  = $ClienteId;
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
        $result = $this->Connection->Exec_store_procedure_json("CALL PrecioPigtail(
          ".$this->Longitud.",
          '".$this->NumeroHilos."',
          '".$this->Conector."',
          '".$this->Fibra."',
          '".$this->Diametro."',
          '".$this->Pulido."',
          '".$this->Codigo."',
          '".$this->SubcategoriaN1Code."',
					'".$this->ClienteId."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
  