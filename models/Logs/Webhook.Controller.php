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
	}

	/**
	 * 
	 */
	class WebhookController{
		
		private $conn;
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
				if (!$this->conn->conexion()->connect_error) {
					// $response = $this->Tool->Clear_data_for_sql('{"type":"charge.created","event_date":"2020-07-23T11:17:24-05:00","transaction":{"id":"trligaa09ginwowwon5q","authorization":null,"operation_type":"in","transaction_type":"charge","status":"in_progress","conciliated":false,"creation_date":"2020-07-23T11:17:24-05:00","operation_date":"2020-07-23T11:17:24-05:00","description":"Pedido Número 2396","error_message":null,"order_id":"2396","due_date":"2020-08-02T23:59:59-05:00","amount":6607.66,"customer":{"name":"RAUL VALENTIN","last_name":"JARAMILLO ARRIAGA","email":"dmgnetconta@gmail.com","phone_number":null,"address":null,"creation_date":"2020-07-23T11:17:24-05:00","external_id":null,"clabe":null},"payment_method":{"type":"bank_transfer","bank":"BBVA Bancomer","clabe":"012914002014222862","agreement":"1422286","name":"42681716192450496262"},"currency":"MXN","method":"bank_account"}}');
					$response = $this->Tool->Clear_data_for_sql(file_get_contents('php://input'));
					$Objresponse = json_decode($response);

					$WebhookEventosModel = new WebhookEventos();
					$WebhookEventosModel->SetParameters($this->conn, $this->Tool);
					$ExistWebhookEventosModel = $WebhookEventosModel->get("WHERE t13_f001 = '".$Objresponse->type."' ", "");
					$WebhookEventosModel->GetDescripcion();

					if ($ExistWebhookEventosModel) {
						$data = [
							"Descripcion" => $WebhookEventosModel->GetDescripcion(),
							"Pedido" => $Objresponse->transaction->order_id,
							"Fecha" => $Objresponse->event_date,
							"Message" => "transferencia pendiente",
							"Monto" => $Objresponse->transaction->amount.' '.$Objresponse->transaction->currency
						];

						$WebhookModel = new Webhook();
						$WebhookModel->SetParameters($this->conn, $this->Tool);
						$WebhookModel->SetTitulo($Objresponse->type);
						$WebhookModel->SetPedidoKey($Objresponse->transaction->order_id);
						$WebhookModel->SetPedidoTipo($Objresponse->transaction->method == 'bank_account' ? 0 : 1);
						$WebhookModel->SetEstatus($Objresponse->transaction->status); 
						$WebhookModel->SetData($response);
						$WebhookModel->SetMetodo($Objresponse->transaction->method);
						$ResultWebhookModel = $WebhookModel->create();

						if (!$ResultWebhookModel['error']) {
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
			$file = fopen("user.txt", "w"); // Abrir
			foreach($aux as $final) {
					fwrite($file, $final.PHP_EOL);
			}
			fclose($file); // Cerrar*/
		}
	}

	// $WebhookController = new WebhookController();
	// $WebhookController->webhook();