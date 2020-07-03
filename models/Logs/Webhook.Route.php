<?php
	@session_start();
	if(empty($_SERVER['DOCUMENT_ROOT'])){
		$_SERVER['DOCUMENT_ROOT'] = "/home/fibremex/public_html";
	}if (!class_exists('Functions_tools')) {
		include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
	}if (!class_exists('WebhookController')) {
		include $_SERVER['DOCUMENT_ROOT'].'/store/models/Logs/Webhook.Controller.php';
	}
	class WebhookRoute{
		private $Tool;
		public $Action;

		public function __construct(){
				$this->Tool = new Functions_tools();
		}
		public function Controller(){
			try {
				switch ($this->Action) {
					case 'webhook':
						$WebhookController = new WebhookController();
						$Result = $WebhookController->webhook();
						echo json_encode($Result, JSON_UNESCAPED_UNICODE);
					break;
					case 'version':
							$WebhookController = new WebhookController();
							$Result = $WebhookController->version();
							echo json_encode($Result, JSON_UNESCAPED_UNICODE);
					break;
					default:
							throw new Exception("No se encontro la opción solicitada, por favor contactanos");
					break;
				}
			} catch (Exception $e) {
				echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
			}
		}
	}

	$WebhookRoute = new WebhookRoute();
	$WebhookRoute->Action = "version";
	$WebhookRoute->Controller();