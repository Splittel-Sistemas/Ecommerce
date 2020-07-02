<?php
	class PCSubdefiniciones_{

		protected $Connection;
		protected $Tool;

		public $Key;
		public $Abreviatura;
		public $Descripcion;
		public $Option_1;
		public $Activo;
		public $SubdefincionKey;

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
				$SQLSTATEMENT = "SELECT * FROM t29_subdefiniciones_configurables_ ".$filter." ".$order;
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = array(); 
				while ($row = $result->fetch_object()) {
					$PCSubdefiniciones_ = new PCSubdefiniciones_();
					$PCSubdefiniciones_->Key         	    = $row->t29_pk01;
					$PCSubdefiniciones_->Abreviatura   		= $row->t29_f001;
					$PCSubdefiniciones_->Descripcion  	  = $row->t29_f002;
					$PCSubdefiniciones_->Option_1  			  = $row->t29_f003;
					$PCSubdefiniciones_->Activo           = $row->t29_f004;
					$PCSubdefiniciones_->SubdefincionKey  = $row->t28_pk01;
					$data[] = $PCSubdefiniciones_;
				}
				return $data;
			} catch (Exception $e) {
				throw $e;
			}
		}

	}