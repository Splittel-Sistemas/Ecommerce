<?php 

	@session_start();
	if (!class_exists("Connection")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
	}if (!class_exists("Functions_tools")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
	}if (!class_exists("Email")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/Email.php';
	}if (!class_exists("TemplateWebhook")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Email/Webhook.php';
	}if (!class_exists("TemplateWebhookPagoBanco")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Email/WebhookPagoBanco.php';
	}if (!class_exists("Webhook")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Logs/Webhook.Model.php';
	}if (!class_exists("WebhookEventos")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Logs/WebhookEventos.Model.php';
	}if (!class_exists('Pedido_')) {
		include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Model.php';
	}

	/**
	 * 
	 */
	class WebhookController{
		
		private $Connection;
		private $Tool;
		public $filter;
		public $order;

		public function __construct(){
			$this->Connection = new Connection();
			$this->Tool = new Functions_tools();
		}

		public function GetBy()
		{
			try {
				if (!$this->Connection->conexion()->connect_error) {
					$WebhookModel = new Webhook();
					$WebhookModel->SetParameters($this->Connection, $this->Tool);
					$Exist = $WebhookModel->get($this->filter, $this->order);
					return $Exist;
				}else{
					throw new Exception("No hay datos maestros por favor contacta con tu ejecutivo!", 1);
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

		public function webhook(){
			try {
				if (!$this->Connection->conexion()->connect_error) {
				// 	$response = $this->Tool->Clear_data_for_sql('{
				// 		"type": "charge.succeeded",
				// 		"event_date": "2021-01-13T11:35:35-06:00",
				// 		"transaction": {
				// 			 "id": "trk2rgxr8i1nuyduimkm",
				// 			 "authorization": "801585",
				// 			 "operation_type": "in",
				// 			 "transaction_type": "charge",
				// 			 "card": {
				// 				  "type": "debit",
				// 				  "brand": "visa",
				// 				  "address": null,
				// 				  "card_number": "411111XXXXXX1111",
				// 				  "holder_name": "Jesus",
				// 				  "expiration_year": "24",
				// 				  "expiration_month": "03",
				// 				  "allows_charges": true,
				// 				  "allows_payouts": true,
				// 				  "bank_name": "Banamex",
				// 				  "bank_code": "002"
				// 			 },
				// 			 "status": "completed",
				// 			 "conciliated": false,
				// 			 "creation_date": "2021-01-13T11:35:20-06:00",
				// 			 "operation_date": "2021-01-13T11:35:32-06:00",
				// 			 "description": "Pedido Número 1582",
				// 			 "error_message": null,
				// 			 "order_id": "1582",
				// 			 "payment_method": {
				// 				  "type": "redirect",
				// 				  "url": "https://sandbox-api.openpay.mx/v1/mf698cdcjeijmamx0sgv/charges/trk2rgxr8i1nuyduimkm/redirect/"
				// 			 },
				// 			 "currency": "MXN",
				// 			 "amount": 572.1,
				// 			 "customer": {
				// 				  "name": "Aaron",
				// 				  "last_name": "Cuevas Rosas",
				// 				  "email": "aaron.cuevas@splittel.com",
				// 				  "phone_number": "4421917076",
				// 				  "address": null,
				// 				  "creation_date": "2021-01-13T11:35:20-06:00",
				// 				  "external_id": null,
				// 				  "clabe": null
				// 			 },
				// 			 "fee": {
				// 				  "amount": 19.09,
				// 				  "tax": 3.0544,
				// 				  "currency": "MXN"
				// 			 },
				// 			 "method": "card"
				// 		}
				//    }');
					$response = $this->Tool->Clear_data_for_sql(file_get_contents('php://input'));
					$Objresponse = json_decode($response);

					$WebhookEventosModel = new WebhookEventos();
					$WebhookEventosModel->SetParameters($this->Connection, $this->Tool);
					$ExistWebhookEventosModel = $WebhookEventosModel->get("WHERE t13_f001 = '".$Objresponse->type."' ", "");
					$WebhookEventosModel->GetDescripcion();

					if ($ExistWebhookEventosModel) {
						$pedidoKey = $Objresponse->transaction->order_id;
						$data = [
							"Descripcion" => $WebhookEventosModel->GetDescripcion(),
							"Pedido" => $pedidoKey,
							"Fecha" => $Objresponse->event_date,
							"Message" => "transferencia pendiente",
							"Monto" => $Objresponse->transaction->amount.' '.$Objresponse->transaction->currency
						];

						$WebhookModel = new Webhook();
						$WebhookModel->SetParameters($this->Connection, $this->Tool);
						$WebhookModel->SetTitulo($Objresponse->type);
						$WebhookModel->SetPedidoKey($pedidoKey);
						$WebhookModel->SetPedidoTipo($Objresponse->transaction->method == 'bank_account' ? 0 : 1);
						$WebhookModel->SetEstatus($Objresponse->transaction->status); 
						$WebhookModel->SetData($response);
						$WebhookModel->SetMetodo($Objresponse->transaction->method);
						$ResultWebhookModel = $WebhookModel->create();

						if (!$ResultWebhookModel['error']) {
							if($Objresponse->transaction->method == 'bank_account' && $Objresponse->transaction->status == "completed"){
								# Pedido
								$PedidoModel = new Pedido_();
								$PedidoModel->SetParameters($this->Connection,  $this->Tool);
								$PedidoExiste = $PedidoModel->GetBy("where id = '".$pedidoKey."' ");
								# guardar información relevante al pedido
								$PedidoModel->SetEstatus('P');
								$ResultPedido = $PedidoModel->Update();
							}
							
							if($Objresponse->transaction->method == 'bank_account' && $Objresponse->transaction->status == "in_progress"){
								$Email = new Email(true);
								$TemplateEmailWebhook = new TemplateWebhookPagoBanco();
							}else{
								$Email = new Email();
								$TemplateEmailWebhook = new TemplateWebhook();
							}

							$Email->MailerSubject = "Webhook";
							$Email->MailerBody = $TemplateEmailWebhook->body($data);
							$Email->EmailSendEmail();
							unset($Email);
							unset($TemplateEmailWebhook);
						}
						return $ResultWebhookModel;
					}
				}
			} catch (Exception $e) {
				print_r($e);
			}
		}

		public function version(){
			$aux = json_decode(file_get_contents('php://input'));
			$file = fopen("../../views/Test/user.txt", "w"); // Abrir
			foreach($aux as $final) {
					fwrite($file, $final.PHP_EOL);
			}
			fclose($file); // Cerrar*/
		}
	}