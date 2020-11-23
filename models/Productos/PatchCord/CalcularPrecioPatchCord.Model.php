<?php 

  class CalcularPrecioPatchCord{
    protected $Connection;
    protected $Tool;

    public $Longitud;
    public $Categoria;
    public $SubcategoriaN1Code;
		public $ClienteId;
    
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetLongitud($Longitud){
      $this->Longitud  = $Longitud;
    }public function SetCategoria($Categoria){
      $this->Categoria  = $Categoria;
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
        $result = $this->Connection->Exec_store_procedure_json("CALL PrecioPatchCord(
          ".$this->Longitud.",
          '".$this->Categoria."',
          '".$this->SubcategoriaN1Code."',
					'".$this->ClienteId."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
  