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

		public function __construct(){
			$this->conn = new Connection();
			$this->Tool = new Functions_tools();
		}

		public function webhook(){
			try {
				if (!$this->conn->conexion()->connect_error) {
					/*$response = $this->Tool->Clear_data_for_sql('{"type":"charge.succeeded","event_date":"2020-02-18T15:59:11-06:00","transaction":{"id":"trrvezy5yh85cojdeosr","authorization":"801585","operation_type":"in","method":"card","transaction_type":"charge","card":{"type":"debit","brand":"visa","address":null,"card_number":"411111XXXXXX1111","holder_name":"AaronCR","expiration_year":"22","expiration_month":"04","allows_charges":true,"allows_payouts":true,"bank_name":"Banamex","bank_code":"002"},"status":"completed","conciliated":false,"creation_date":"2020-02-18T15:59:08-06:00","operation_date":"2020-02-18T15:59:09-06:00","description":"1012","error_message":null,"order_id":null,"currency":"MXN","amount":915.54,"customer":{"name":"Aaron","last_name":"Cuevas Rosas","email":"aaron.cuevas@splittel.com","phone_number":"4421917076","address":null,"creation_date":"2020-02-18T15:59:07-06:00","external_id":null,"clabe":null},"fee":{"amount":29.05,"tax":4.6480,"currency":"MXN"}}}');*/
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
							"Fecha" => $Objresponse->event_date
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
							$Email = new Email();
							$TemplateWebhook = new TemplateWebhook();
							$Email->MailerSubject = "Webhook";
							$Email->MailerBody = $TemplateWebhook->body($data);
							$Email->EmailSendEmail();
							unset($Email);
							unset($TemplateWebhook);
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