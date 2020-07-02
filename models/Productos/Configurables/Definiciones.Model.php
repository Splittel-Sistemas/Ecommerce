<?php
	class PCDefiniciones{

		protected $Connection;
		protected $Tool;

		public $Key;
		public $Nombre;
		public $Descripcion;

		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
		}

		public function GetKey(){
			return $this->Key;
		}public function GetNombre(){
			return $this->Nombre;
		}public function GetDescripcion(){
			return $this->Descripcion;
		}

		/**
		 * Description
		 *
		 * @param string $a Foo
		 *
		 * @return int $b Bar
		 */
		public function GetBy($filter, $order){
			try {
				$SQLSTATEMENT = "SELECT * FROM t27_definiciones_configurables ".$filter." ".$order;
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = false; 
				while ($row = $result->fetch_object()) {
					$this->Key         	= $row->t27_pk01;
					$this->Nombre   	= $row->t27_f001;
					$this->Descripcion  = $row->t27_f002;
					$data[] = true;
				}
				return $data;
			} catch (Exception $e) {
				throw $e;
			}
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
				$SQLSTATEMENT = "SELECT * FROM t27_definiciones_configurables ".$filter." ".$order;
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = array(); 
				while ($row = $result->fetch_object()) {
					$PCDefiniciones = new PCDefiniciones();
					$PCDefiniciones->Key         	= $row->t27_pk01;
					$PCDefiniciones->Nombre   		= $row->t27_f001;
					$PCDefiniciones->Descripcion  	= $row->t27_f002;
					$data[] = $PCDefiniciones;
				}
				return $data;
			} catch (Exception $e) {
				throw $e;
			}
		}

	}