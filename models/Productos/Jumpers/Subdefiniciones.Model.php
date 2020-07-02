<?php 

	class Subdefiniciones{
		protected $Connection;
		protected $Tool;

		public $Key;
		public $Descripcion;
		public $DescripcionLarga;
		public $DefincionesKey;
		
		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
		}
		
		public function GetKey(){
			return $this->Key;
		}public function GetDescripcion(){
			return $this->Descripcion;
		}public function GetDescripcionLarga(){
			return $this->DescripcionLarga;
		}public function GetDefincionesKey(){
			return $this->DefincionesKey;
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
				$SQLSTATEMENT = "SELECT * FROM t91_subdefiniciones ".$filter." ".$order;
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = [];

				while ($row = $result->fetch_object()) {
					$Subdefiniciones = new Subdefiniciones();
					$Subdefiniciones->Key     					=   $row->t91_pk01;
					$Subdefiniciones->Descripcion      =   $row->t91_f001;
					$Subdefiniciones->DescripcionLarga	=   $row->t91_f002;
					$Subdefiniciones->DefincionesKey   =   $row->t90_pk01;
					$data[] = $Subdefiniciones;
				}
				return $data;
			} catch (Exception $e) {
				throw $e;
			}
		}

		public function GetBy($filter, $order){
			try {
				$SQLSTATEMENT = "SELECT * FROM t91_subdefiniciones ".$filter." ".$order;
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = false;

				while ($row = $result->fetch_object()) {
					$this->Key     					=   $row->t91_pk01;
					$this->Descripcion     	=   $row->t91_f001;
					$this->DescripcionLarga =   $row->t91_f002;
					$this->DefincionesKey   =   $row->t90_pk01;
					$data = true;
				}
				return $data;
			} catch (Exception $e) {
				throw $e;
			}
		}

	}
	