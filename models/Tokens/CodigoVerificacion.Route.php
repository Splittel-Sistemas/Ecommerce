<?php

@session_start();
if (!class_exists("Seguridad")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Seguridad/Seguridad.Controller.php';
}if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
}if (!class_exists('CodigoVerificacionController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tokens/CodigoVerificacion.Controller.php';
}
class CodigoVerificacionRoute{
    protected $Tool;

    public function __construct(){
        $this->Tool = new Functions_tools();
    }
    public function Controller(){
        try {
            $Action = $this->Tool->validate_isset_post('Action');
            switch ($Action) {
                case 'generar':
                    $CodigoVerificacionController = new CodigoVerificacionController();
                    $Result = $CodigoVerificacionController->CodigoVerificacion();
                    echo json_encode($Result, JSON_UNESCAPED_UNICODE);
                break;
                case 'verificar':
                    $CodigoVerificacionController = new CodigoVerificacionController();
                    $Result = $CodigoVerificacionController->VerificarCodigo();
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
  if ($SeguridadController->decryptData() && $_POST['ActionCodigoVerificacion']) { 
    $CodigoVerificacionRoute = new CodigoVerificacionRoute();
    $CodigoVerificacionRoute->Controller();
    unset($CodigoVerificacionRoute);
  }
  unset($SeguridadController);    