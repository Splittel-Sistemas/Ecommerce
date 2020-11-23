<?php 

  class CalcularPrecioCableServicio{
    protected $Connection;
    protected $Tool;

    public $Longitud;
    public $NumeroHilos;
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
        $result = $this->Connection->Exec_store_procedure_json("CALL PrecioCableServicio(
          ".$this->Longitud.",
          '".$this->NumeroHilos."',
          '".$this->SubcategoriaN1Code."',
					'".$this->ClienteId."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
  