<?php
	@session_start();
	if (!class_exists("Seguridad")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Seguridad/Seguridad.Controller.php';
	}if (!class_exists('Functions_tools')) {
		include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Functions_tools.php';
	}if (!class_exists('PrecioCableController')) {
		include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Productos/Jumpers/PrecioCable.Controller.php';
	}
	
	class PrecioCableRoute{
		private $Tool;

		public function __construct(){
			$this->Tool = new Functions_tools();
		}

		public function Controller(){
			try {
				$Action = $this->Tool->validate_isset_post('Action');
				switch ($Action) {
					case 'create':
							$PrecioCableController = new PrecioCableController();
							$Result = $PrecioCableController->Create();
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
	$SeguridadController = new SeguridadController();
	# Comprobación Autorización Ajax    
	if ($SeguridadController->decryptData() && $_POST['ActionPrecioCable']) { 
		$PrecioCableRoute = new PrecioCableRoute();
		$PrecioCableRoute->Controller();
		unset($PrecioCableRoute);
	}
	unset($SeguridadController); 