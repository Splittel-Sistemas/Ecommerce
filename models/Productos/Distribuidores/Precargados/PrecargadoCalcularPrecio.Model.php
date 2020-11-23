<?php 

	class PrecargadoCalcularPrecio{
		protected $Connection;
		protected $Tool;

		public $Conector;
		public $Distribuidor;
		public $Capacidad;
		public $Acoplador;
		public $Color;
		public $Puertos;
		public $NumeroAcopladores;
		public $SubcategoriaN1Code;
		public $ClienteId;
		
		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
		}

		public function SetDistribuidor($Distribuidor){
			$this->Distribuidor  = $Distribuidor;
		}public function SetCapacidad($Capacidad){
			$this->Capacidad  = $Capacidad;
		}public function SetAcoplador($Acoplador){
			$this->Acoplador  = $Acoplador;
		}public function SetColor($Color){
			$this->Color  = $Color;
		}public function SetPuertos($Puertos){
			$this->Puertos  = $Puertos;
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
				$result = $this->Connection->Exec_store_procedure_json("CALL PrecioDistribuidoresPrecargados(
					'".$this->Distribuidor."',
					'".$this->Capacidad."',
					'".$this->Acoplador."',
					'".$this->Color."',
					'".$this->Puertos."',
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
	