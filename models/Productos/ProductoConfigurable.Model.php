<?php

	class ProductoConfigurable{
		public $Key;
		public $Codigo;
		public $CodigoConfigurable;
		public $Descripcion;

		protected $Connection;
    protected $Tool;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
		}
		
		public function SetCodigo($Codigo){
			$this->Codigo = $Codigo;
		}
		public function SetCodigoConfigurable($CodigoConfigurable){
			$this->CodigoConfigurable = $CodigoConfigurable;
		}
		public function SetDescripcion($Descripcion){
			$this->Descripcion = $Descripcion;
		}

		public function Add(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL ProductoConfigurableNombreCrear(
          '".$this->Codigo."',
          '".$this->CodigoConfigurable."',
          '".$this->Descripcion."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
	}
	