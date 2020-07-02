<?php 

	class PrecioCable{
		protected $Connection;
		protected $Tool;

		public $Key;
		public $Precio;
		public $TipoJumperKey;
		public $TipoJumper;
		public $DescripcionTipoJumper;
		public $TipoFibraKey;
		public $TipoFibra;
		public $DescripcionTipoFibra;
		public $CubiertaKey;
		public $Cubierta;
		public $DescripcionCubierta;
		
		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
		}

		public function GetKey(){
			return $this->Key;
		}public function GetPrecio(){
			return $this->Precio;
		}public function GetTipoJumperKey(){
			return $this->TipoJumperKey;
		}public function GetTipoJumper(){
			return $this->TipoJumper;
		}public function GetDescripcionTipoJumper(){
			return $this->DescripcionTipoJumper;
		}public function GetTipoFibraKey(){
			return $this->TipoFibraKey;
		}public function GetTipoFibra(){
			return $this->TipoFibra;
		}public function GetDescripcionTipoFibra(){
			return $this->DescripcionTipoFibra;
		}public function GetCubiertaKey(){
			return $this->CubiertaKey;
		}public function GetCubierta(){
			return $this->Cubierta;
		}public function GetDescripcionCubierta(){
			return $this->DescripcionCubierta;
		}


		public function SetKey($Key){
			$this->Key = $Key; 
		}public function SetPrecio($Precio){
			$this->Precio = $Precio; 
		}public function SetTipoJumperKey($TipoJumperKey){
			$this->TipoJumperKey = $TipoJumperKey; 
		}public function SetTipoJumper($TipoJumper){
			$this->TipoJumper = $TipoJumper; 
		}public function SetDescripcionTipoJumper($DescripcionTipoJumper){
			$this->DescripcionTipoJumper = $DescripcionTipoJumper; 
		}public function SetTipoFibraKey($TipoFibraKey){
			$this->TipoFibraKey = $TipoFibraKey; 
		}public function SetTipoFibra($TipoFibra){
			$this->TipoFibra = $TipoFibra; 
		}public function SetDescripcionTipoFibra($DescripcionTipoFibra){
			$this->DescripcionTipoFibra = $DescripcionTipoFibra; 
		}public function SetCubiertaKey($CubiertaKey){
			$this->CubiertaKey = $CubiertaKey; 
		}public function SetCubierta($Cubierta){
			$this->Cubierta = $Cubierta; 
		}public function SetDescripcionCubierta($DescripcionCubierta){
			$this->DescripcionCubierta = $DescripcionCubierta; 
		}

		 /**
		 * Description
		 *
		 * @param string $a Foo
		 *
		 * @return int $b Bar
		*/
		public function Get($filter, $order){
			try {
				$SQLSTATEMENT = "SELECT * FROM listar_jumper_precio_cable ".$filter." ".$order;
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = [];

				while ($row = $result->fetch_object()) {
					$PrecioCable = new PrecioCable();
					$PrecioCable->Key     								=   $row->keyy;
					$PrecioCable->Precio       						=   $row->precio_cable;
					$PrecioCable->TipoJumperKey        		=   $row->t91_pk01;
					$PrecioCable->TipoJumper           		=   $row->tipojumper;
					$PrecioCable->DescripcionTipoJumper   =   $row->descripciontipojumper;
					$PrecioCable->TipoFibraKey          	=   $row->t91_pk01_;
					$PrecioCable->TipoFibra 							=   $row->tipofibra;
					$PrecioCable->DescripcionTipoFibra		=   $row->descripciontipofibra;
					$PrecioCable->CubiertaKey      				=   $row->t91_pk01__;
					$PrecioCable->Cubierta								=   $row->tipocubierta;
					$PrecioCable->DescripcionCubierta			=   $row->descripciontipocubierta;
					$data[] = $PrecioCable;
				}
				return $data;
			} catch (Exception $e) {
				throw $e;
			}
		}

		public function GetBy($filter, $order){
			try {
				$SQLSTATEMENT = "SELECT * FROM listar_jumper_precio_cable ".$filter." ".$order;
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = false;

				while ($row = $result->fetch_object()) {
					$this->Key     								=   $row->keyy;
					$this->Precio       					=   $row->precio_cable;
					$this->TipoJumperKey        	=   $row->t91_pk01;
					$this->TipoJumper           	=   $row->tipojumper;
					$this->DescripcionTipoJumper  =   $row->descripciontipojumper;
					$this->TipoFibraKey          	=   $row->t91_pk01_;
					$this->TipoFibra 							=   $row->tipofibra;
					$this->DescripcionTipoFibra		=   $row->descripciontipofibra;
					$this->CubiertaKey      			=   $row->t91_pk01__;
					$this->Cubierta								=   $row->tipocubierta;
					$this->DescripcionCubierta		=   $row->descripciontipocubierta;
					$data = true;
				}
				return $data;
			} catch (Exception $e) {
				throw $e;
			}
		}

		public function Add(){
			try {
				$result = $this->Connection->Exec_store_procedure_json("CALL PrecioCableCrear(
					".$this->Key.",
					".$this->Precio.",
					".$this->TipoJumperKey.",
					".$this->TipoFibraKey.",
					".$this->CubiertaKey.",
				@Result);", "@Result");
				return $result;
			} catch (Exception $e) {
				throw $e;
			}
		}

	}
	