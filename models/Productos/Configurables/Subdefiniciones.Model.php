<?php
	class PCSubdefiniciones{

		protected $Connection;
		protected $Tool;

		public $Key;
		public $Nombre;
		public $Descripcion;
		public $Activo;
		public $DefincionKey;

		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
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
				$SQLSTATEMENT = "SELECT * FROM t28_subdefiniciones_configurables ".$filter." ".$order;
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = array(); 
				while ($row = $result->fetch_object()) {
					$PCSubdefiniciones = new PCSubdefiniciones();
					$PCSubdefiniciones->Key         	= $row->t28_pk01;
					$PCSubdefiniciones->Nombre   			= $row->t28_f001;
					$PCSubdefiniciones->Descripcion  	= $row->t28_f002;
					$PCSubdefiniciones->Activo  			= $row->t28_f003;
					$PCSubdefiniciones->DefincionKey  = $row->t27_pk01;
					$data[] = $PCSubdefiniciones;
				}
				return $data;
			} catch (Exception $e) {
				throw $e;
			}
		}

	}