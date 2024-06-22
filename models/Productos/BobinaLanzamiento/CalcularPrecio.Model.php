<?php 

	class CalcularPrecio{
		protected $Connection;
		protected $Tool;

		public $Longitud;
		public $Conector_1;
		public $Conector_2;
		public $Fibra;
		
		public $SubcategoriaN1Code;
		public $ClienteId;
		public $BreakOut;
		
		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
		}
		public function SetLongitud($Longitud){
			$this->Longitud  = $Longitud;
		}public function SetFibra($Fibra){
			$this->Fibra  = $Fibra;
		}public function SetConector_1($Conector_1){
			$this->Conector_1  = $Conector_1;
		}public function SetConector_2($Conector_2){
			$this->Conector_2  = $Conector_2;
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
				$result = $this->Connection->Exec_store_procedure_json("CALL PrecioBobinaLanzamiento(
					".$this->Longitud.",
					'".$this->Fibra."',
					'".$this->Conector_1."',
					'".$this->Conector_2."',
					'".$this->SubcategoriaN1Code."',
					'".$this->ClienteId."',
				@Result);", "@Result");
				return $result;
			} catch (Exception $e) {
				throw $e;
			}
		}

	}
	