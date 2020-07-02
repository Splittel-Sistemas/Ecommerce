<?php
	@session_start();
	if (!class_exists("Seguridad")) {
		include $_SERVER["DOCUMENT_ROOT"].'/store/models/Seguridad/Seguridad.Controller.php';
	}if (!class_exists('Functions_tools')) {
		include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
	}if (!class_exists('CalcularPrecioController')) {
		include $_SERVER['DOCUMENT_ROOT'].'/store/models/Productos/Jumpers/CalcularPrecio.Controller.php';
	}
	
	class CalcularPrecioRoute{
		private $Tool;

		public function __construct(){
			$this->Tool = new Functions_tools();
		}

		public function Controller(){
			try {
				$Action = $this->Tool->validate_isset_post('Action');
				switch ($Action) {
					case 'calcular':
                        $CalcularPrecioController = new CalcularPrecioController();
                        $Result = $CalcularPrecioController->Calcular();
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
	if ($SeguridadController->decryptData() && $_POST['ActionCalcularPrecio']) { 
		$CalcularPrecioRoute = new CalcularPrecioRoute();
		$CalcularPrecioRoute->Controller();
		unset($CalcularPrecioRoute);
	}
	unset($SeguridadController); 