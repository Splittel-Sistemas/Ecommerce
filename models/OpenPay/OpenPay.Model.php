<?php
		include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Librerias/OpenPay/Openpay.php';
		class OpenPay_{
			protected $OpenPayy;
			protected $TokenId;
			protected $DeviceSessionId;
			protected $Id;
			protected $PublicKey;
			protected $PrivateKey;
			protected $Url;
			protected $SandboxMode;
			protected $ProductionMode;
			protected $Connection;
			protected $Tool;
			
			public function SetParameters($conn, $Tool){
				$this->Connection = $conn;
				$this->Tool = $Tool;
			}
			public function GetId(){
				return $this->Id;
			}
			public function GetPublicKey(){
				return $this->PublicKey;
			}
			public function GetPrivateKey(){
				return $this->PrivateKey;
			}
			public function GetUrl(){
				return $this->Url;
			}
			public function GetSandboxMode(){
				return $this->SandboxMode;
			}
			public function GetProductionMode(){
				return $this->ProductionMode;
			}
			public function SetTokenId($TokenId){
				$this->TokenId = $TokenId;
			}
			public function SetDeviceSessionId($DeviceSessionId){
				$this->DeviceSessionId = $DeviceSessionId;
			}
			public function SetId($Id){
				$this->Id = $Id;
			}
			public function SetPublicKey($PublicKey){
				$this->PublicKey = $PublicKey;
			}
			public function SetPrivateKey($PrivateKey){
				if(!is_numeric($PrivateKey)){
						throw new Exception('$PrivateKey debería de ser int');
				}
				$this->PrivateKey = $PrivateKey;
			}
			public function SetUrl($Url){
				if(!is_numeric($Url)){
						throw new Exception('$Url debería de ser int');
				}
				$this->Url = $Url;
			}
			public function SetProductionMode($ProductionMode){
				if(is_null($ProductionMode)){
						throw new Exception('$ProductionMode debería de diferente de null');
				}
				$this->ProductionMode = $ProductionMode;
			}
			protected function StartObjects(){
				$this->conn = new Connection();
				$this->Tool = new Functions_tools();
			}
			public function GetkeyById($id){
				try {
					$SQLSTATEMENT = "SELECT * FROM t10_keys_librerias WHERE t10_pk01 = '$id'";
					$result = $this->Connection->QueryReturn($SQLSTATEMENT);
					$fila = mysql_fetch_row($resultado);
					return $fila[2];
				} catch (Exception $e) {
					throw $e;
				}
			}
			public function GetKeys(){
				try {
					if (!$this->Connection->conexion()->connect_error) {
							$SQLSTATEMENT = "SELECT * FROM t04_open_pay_keys WHERE t04_pk01 = 1 ";
							$result = $this->Connection->QueryReturn($SQLSTATEMENT);
						$data = false;
							while($row = $result->fetch_object()){
							$this->Id              	= $row->t04_f001;
							$this->PrivateKey      	= $row->t04_f002;
							$this->PublicKey       	= $row->t04_f003;
							$this->SandboxMode     	= $row->t04_f004;
							$this->ProductionMode  	= $row->t04_f005;
							$this->Url  			= $row->t04_f006;
							$data = true;
						}
						return $data;
					}else{
						throw new Exception("No se encontraron datos maestros!");
					}
				} catch (Exception $e) {
					throw $e;
				}
			}
			public function GetCharge($idCharge)
			{
				if(is_null($this->Id)){
					throw new Exception('$Id is null');
				}
				if(is_null($this->PublicKey)){
					throw new Exception('$PublicKey is null');
				}
				$this->OpenPayy = Openpay::getInstance($this->Id, $this->PublicKey);
				Openpay::setProductionMode($this->ProductionMode);
				$charge = $this->OpenPayy->charges->get($idCharge);
				return $charge;
			}
			public function CreateChargeCard($Cliente,$Pedido){
				if(is_null($this->Id)){
					throw new Exception('$Id is null');
				}
				if(is_null($this->PublicKey)){
					throw new Exception('$PublicKey is null');
				}
				try {
					$this->OpenPayy = Openpay::getInstance($this->Id, $this->PublicKey);
					Openpay::setProductionMode($this->ProductionMode);
					$Customer = array(
						'name'          => $Cliente->GetNombre(),
						'last_name'     => $Cliente->GetApellidos(),
						'phone_number'  => $Cliente->GetTelefono(),
						'email'         => $Cliente->GetEmail()
					);

					if($_POST['monedaPago'] == 'USD'){
						$valor= round($Pedido->GetTotal(),2);
					}else{
						$valor= round($Pedido->GetTotalMXN(),2);
					}
					$Amount = strval($valor);

					$chargeData = array(
						'method'            => 'card',
						'source_id'         => $this->TokenId,//token tarjeta
						'amount'            => $Amount,
						"currency"          => $_POST['monedaPago'] == 'USD' ? $_POST['monedaPago'] : 'MXN',
						'description'       => "Pago con tarjeta",
						'order_id'			=> $Pedido->GetKey(),
						'device_session_id' => $this->DeviceSessionId,// sessionDev []
						'customer'          => $Customer
					);

					return $this->Charge = $this->OpenPayy->charges->create($chargeData);

				} catch (OpenpayApiTransactionError $e) {
					throw $e;
				} catch (OpenpayApiRequestError $e) {
					throw $e;
				} catch (OpenpayApiConnectionError $e) {
					throw $e;
				} catch (OpenpayApiAuthError $e) {
					throw $e;
				} catch (OpenpayApiError $e) {
					throw $e;
				} catch (Exception $e) {
					throw $e;
				}
			}
			public function CreateCharge3DSecure($Cliente, $Pedido){
				if(is_null($this->Id)){
					throw new Exception('$Id is null');
				}
				if(is_null($this->PublicKey)){
					throw new Exception('$PublicKey is null');
				}
				try {
					$this->OpenPayy = Openpay::getInstance($this->Id, $this->PublicKey);
					Openpay::setProductionMode($this->ProductionMode);
					$Customer = array(
						'name'          => $Cliente->GetNombre(),
						'last_name'     => $Cliente->GetApellidos(),
						'phone_number'  => $Cliente->GetTelefono(),
						'email'         => $Cliente->GetEmail()
					);

					$valor= round($Pedido->GetTotalMXN(),2);
					$Amount = strval($valor);

					$chargeData = array(
						"method" => "card",
						"amount" => $Amount,
						"description" => "Pedido Número ".$Pedido->GetKey(),
						"order_id" => $Pedido->GetKey(),
						'source_id' => $this->TokenId,//token tarjeta
						"redirect_url" => "https://fibremex.co/fibra-optica/views/Pedido/3DSecure/index.php?Key=".$Pedido->GetKey(),
						"use_3d_secure" => "true",
						'device_session_id' => $this->DeviceSessionId,// sessionDev []
						'customer' => $Customer
					);
					return $this->Charge = $this->OpenPayy->charges->create($chargeData);
				} catch (OpenpayApiTransactionError $e) {
					throw $e;
				} catch (OpenpayApiRequestError $e) {
					throw $e;
				} catch (OpenpayApiConnectionError $e) {
					throw $e;
				} catch (OpenpayApiAuthError $e) {
					throw $e;
				} catch (OpenpayApiError $e) {
					throw $e;
				} catch (Exception $e) {
					throw $e;
				}
			}
			public function CreateChargeBank($Cliente,$Pedido){
				if(is_null($this->Id)){
					throw new Exception('$Id is null');
				}
				if(is_null($this->PublicKey)){
					throw new Exception('$PublicKey is null');
				}
				try {
					$this->OpenPayy = Openpay::getInstance($this->Id, $this->PublicKey);
					Openpay::setProductionMode($this->ProductionMode);
					$Customer = array(
						'name'          => $Cliente->GetNombre(),
						'last_name'     => $Cliente->GetApellidos(),
						'phone_number'  => $Cliente->GetTelefono(),
						'email'         => $Cliente->GetEmail()
					);

					$valor= round($Pedido->GetTotalMXN(),2);
					$Amount = strval($valor);
					# formato requerido api 
					$due_date = explode(' ', $Pedido->GetFechaMas10Dias());
					$due_date = $due_date[0].'T'.$due_date[1];

					$chargeData = array(
						'method'            => 'bank_account',
						'amount'            => $Amount,
						'description'       => "Pedido Número ".$Pedido->GetKey(),
						'order_id'			=> $Pedido->GetKey(),
						'due_date'			=> $due_date,
						'customer'          => $Customer
					);

					return $this->Charge = $this->OpenPayy->charges->create($chargeData);

				} catch (OpenpayApiTransactionError $e) {
					throw $e;
				} catch (OpenpayApiRequestError $e) {
					throw $e;
				} catch (OpenpayApiConnectionError $e) {
					throw $e;
				} catch (OpenpayApiAuthError $e) {
					throw $e;
				} catch (OpenpayApiError $e) {
					throw $e;
				} catch (Exception $e) {
					throw $e;
				}
			}
		}
