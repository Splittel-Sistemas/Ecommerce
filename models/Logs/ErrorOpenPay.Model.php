<?php 
	class ErrorOpenPay{
		public $Key;
		public $ErrorCode;
		public $ErrorCodeHttp;
		public $Description;
		public $DataResponse;
		public $PedidoKey;
		public $DescriptionGenerica;
		
		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
		}

		public function SetKey($Key){
			$this->Key = $Key;
		}public function SetErrorCode($ErrorCode){
			$this->ErrorCode = $ErrorCode;
		}public function SetErrorCodeHttp($ErrorCodeHttp){
			$this->ErrorCodeHttp = $ErrorCodeHttp;
		}public function SetDescription($Description){
			$this->Description = $Description;
		}public function SetDataResponse($DataResponse){
			$this->DataResponse = $DataResponse;
		}public function SetPedidoKey($PedidoKey){
			$this->PedidoKey = $PedidoKey;
		}public function SetDescriptionGenerica($DescriptionGenerica){
			return $this->DescriptionGenerica;
		}

		public function GetKey(){
			return $this->Key;
		}public function GetErrorCode(){
			return $this->ErrorCode;
		}public function GetErrorCodeHttp(){
			return $this->ErrorCodeHttp;
		}public function GetDescription(){
			return $this->Description;
		}public function GetDataResponse(){
			return $this->DataResponse;
		}public function GetPedidoKey(){
			return $this->PedidoKey;
		}public function GetDescriptionGenerica(){
			return $this->DescriptionGenerica;
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
				$SQLSTATEMENT = "SELECT * FROM t16_open_pay_errores_log";
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = [];
				while ($row = $result->fetch_object()) {
					$ErrorOpenPay = new ErrorOpenPay();
					$ErrorOpenPay->Key	 			= $row->t16_pk01;
					$ErrorOpenPay->ErrorCode	 	= $row->t16_f001;
					$ErrorOpenPay->ErrorCodeHttp	= $row->t16_f002;
					$ErrorOpenPay->Description		= $row->t16_f003;
					$ErrorOpenPay->DataResponse		= $row->t16_f004;
					$ErrorOpenPay->PedidoKey		= $row->t16_f005;
					$data[] = $ErrorOpenPay;
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
		public function getByOpenPayErrores($filter, $order){
			try {
				$SQLSTATEMENT = "SELECT * FROM t15_open_pay_errores ".$filter." ".$order;
				// echo $SQLSTATEMENT;
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = false;
				while ($row = $result->fetch_object()) {
					$this->Key	 			= $row->t15_pk01;
					$this->ErrorCode	 	= $row->t15_f001;
					$this->ErrorCodeHttp	= $row->t15_f002;
					$this->Description		= $row->t15_f004;
					$this->DescriptionGenerica		= $row->t15_f003;
					$data = true;
				}
				return $data;
			} catch (Exception $e) {
				throw $e;
			 }
		}
		public function getBy($filter, $order){
			try {
				$SQLSTATEMENT = "SELECT * FROM list_log_open_pay_error ".$filter." ".$order;
				// echo $SQLSTATEMENT;
				$result = $this->Connection->QueryReturn($SQLSTATEMENT);
				$data = false;
				while ($row = $result->fetch_object()) {
					$this->Key	 			= $row->t16_pk01;
					$this->ErrorCode	 	= $row->t16_f001;
					$this->ErrorCodeHttp	= $row->t16_f002;
					$this->Description		= $row->t15_f004;
					$this->DataResponse		= $row->t16_f004;
					$this->PedidoKey		= $row->t16_f005;
					$data = true;
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
		public function create(){
			try {
				$result = $this->Connection->Exec_store_procedure_json("CALL LogOpenPayError(
					".$this->ErrorCode.",
					".$this->ErrorCodeHttp.",
					'".$this->Description."',
					'".$this->DataResponse."',
					".$this->PedidoKey.",
					@Result);", "@Result");
				return $result;
			} catch (Exception $e) {
				throw $e;
			 }
		}
	}