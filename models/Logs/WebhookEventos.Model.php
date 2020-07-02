<?php 


	/**
	 * 
	 */
	class WebhookEventos{

		public $Key;
		public $Evento;
		public $Categoria;
		public $Descripcion;
		
		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
		}

		public function SetKey($Key){
			$this->Key = $Key;
		}public function SetEvento($Evento){
			$this->Evento = $Evento;
		}public function SetCategoria($Categoria){
			$this->Categoria = $Categoria;
		}public function SetDescripcion($Descripcion){
			$this->Descripcion = $Descripcion;
		}

		public function GetKey(){
			return $this->Key;
		}public function GetEvento(){
			return $this->Evento;
		}public function GetCategoria(){
			return $this->Categoria;
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
		public function getAll(){
			try {
				$SQLSTATEMENT = "SELECT * FROM t13_open_pay_webhook_tipos";
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = [];
				while ($row = $result->fetch_object()) {
					$WebhookEventos = new WebhookEventos();
					$WebhookEventos->Key	 				= $row->t13_pk01;
					$WebhookEventos->Evento	 			= $row->t13_f001;
					$WebhookEventos->Categoria	 	= $row->t13_f002;
					$WebhookEventos->Descripcion	= $row->t13_f003;
					$data[] = $WebhookEventos;
				}
				return $data;
			} catch (Exception $e) {
				throw $e;
			 }
		}

		public function get($filter, $order){
			try {
				$SQLSTATEMENT = "SELECT * FROM t13_open_pay_webhook_tipos ".$filter." ".$order;
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = false;
				while ($row = $result->fetch_object()) {
					$this->Key	 				= $row->t13_pk01;
					$this->Evento	 			= $row->t13_f001;
					$this->Categoria	 	= $row->t13_f002;
					$this->Descripcion	= $row->t13_f003;
					$data = true;
				}
				return $data;
			} catch (Exception $e) {
				throw $e;
			 }
		}
	}