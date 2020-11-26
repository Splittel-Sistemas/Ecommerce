<?php 

	class CalcularPrecio{
		protected $Connection;
		protected $Tool;

		public $Longitud;
		public $Tipo;
		public $Conector_1;
		public $Conector_2;
		public $Fibra;
		public $Pulido_1;
		public $Pulido_2;
		public $Cubierta;
		public $NumeroHilos;
		public $Uso;
		public $SubcategoriaN1Code;
		public $ClienteId;
		
		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
		}

		/*
		$CalcularPrecioModel->SetParameters($this->Connection, $this->Tool);
					$CalcularPrecioModel->SetCableId($_POST['CablesPreconId']);
					$CalcularPrecioModel->SetNumeroHilos($_POST['CablesPreconNumeroHilos']);
					$CalcularPrecioModel->SetLongitud($_POST['CablesPreconLongitud']);
					$CalcularPrecioModel->SetFibra($_POST['CablesPreconTipoFibra']);
					$CalcularPrecioModel->SetConector_1($_POST['Aux_ConectorLadoA']);
					$CalcularPrecioModel->SetConector_2($_POST['Aux_ConectorLadoB']);
					$CalcularPrecioModel->SetCubierta($_POST['Cubierta']);
					$CalcularPrecioModel->SetUso($_POST['Uso']);
					$CalcularPrecioModel->SetCodigo($_POST['Codigo']);
					$CalcularPrecioModel->SetSubcategoriaN1Code($_POST['SubcategoriaN1Code']);
					$CalcularPrecioModel->SetClienteId(i
		*/
		public function SetCableId($CableId){
			$this->CableId  = $CableId;
		}public function SetNumeroHilos($NumeroHilos){
			$this->NumeroHilos  = $NumeroHilos;
		}public function SetLongitud($Longitud){
			$this->Longitud  = $Longitud;
		}public function SetFibra($Fibra){
			$this->Fibra  = $Fibra;
		}public function SetConector_1($Conector_1){
			$this->Conector_1  = $Conector_1;
		}public function SetConector_2($Conector_2){
			$this->Conector_2  = $Conector_2;
		}public function SetCubierta($Cubierta){
			$this->Cubierta  = $Cubierta;
		}public function SetUso($Uso){
			$this->Uso  = $Uso;
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
				$result = $this->Connection->Exec_store_procedure_json("CALL PrecioCablesPreconectorizados(
					".$this->CableId.",
					'".$this->NumeroHilos."',
					".$this->Longitud.",
					'".$this->Fibra."',
					'".$this->Conector_1."',
					'".$this->Conector_2."',
					'".$this->Cubierta."',
					'".$this->Uso."',
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
	