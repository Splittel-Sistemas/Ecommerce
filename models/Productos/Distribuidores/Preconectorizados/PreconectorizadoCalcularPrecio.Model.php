<?php 

	class PreconectorizadoCalcularPrecio{
		protected $Connection;
		protected $Tool;

		public $Conector;
		public $Distribuidor;
		public $Capacidad;
		public $Acoplador;
		public $TipoFibra;
		public $Puerto;
		public $NumeroAcopladores;
		public $SubcategoriaN1Code;
		public $ClienteId;
		
		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
		}

		public function SetConector($Conector){
			$this->Conector  = $Conector;
		}public function SetDistribuidor($Distribuidor){
			$this->Distribuidor  = $Distribuidor;
		}public function SetCapacidad($Capacidad){
			$this->Capacidad  = $Capacidad;
		}public function SetAcoplador($Acoplador){
			$this->Acoplador  = $Acoplador;
		}public function SetTipoFibra($TipoFibra){
			$this->TipoFibra  = $TipoFibra;
		}public function SetPuerto($Puerto){
			$this->Puerto  = $Puerto;
		}public function SetNumeroAcopladores($NumeroAcopladores){
			$this->NumeroAcopladores  = $NumeroAcopladores;
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
				$result = $this->Connection->Exec_store_procedure_json("CALL PrecioDistribuidoresPreconectorizados(
					'".$this->Conector."',
					'".$this->Distribuidor."',
					'".$this->Capacidad."',
					'".$this->Acoplador."',
					'".$this->TipoFibra."',
					'".$this->Puerto."',
					'".$this->NumeroAcopladores."',
					'".$this->SubcategoriaN1Code."',
					'".$this->ClienteId."',
				@Result);", "@Result");
				return $result;
			} catch (Exception $e) {
				throw $e;
			}
		}

	}
	