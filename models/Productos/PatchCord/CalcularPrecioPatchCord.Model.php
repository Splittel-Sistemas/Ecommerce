<?php 

  class CalcularPrecioPatchCord{
    protected $Connection;
    protected $Tool;

    public $Longitud;
    public $Categoria;
    
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetLongitud($Longitud){
      $this->Longitud  = $Longitud;
    }public function SetCategoria($Categoria){
      $this->Categoria  = $Categoria;
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
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
  