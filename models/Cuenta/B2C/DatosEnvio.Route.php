<?php 
  @session_start();
  if (!class_exists("Seguridad")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Seguridad/Seguridad.Controller.php';
  }if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists('DatosEnvioController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cuenta/B2C/DatosEnvio.Controller.php';
  }

  class DatosEnvioRoute{
    protected $Tool;

    public function __construct(){
      $this->Tool = new Functions_tools();
    }

    public function controller(){
      try {
        $Action = $this->Tool->validate_isset_post('Action');
        switch ($Action) {
          case 'create':
              $DatosEnvioController = new DatosEnvioController();
              $Result = $DatosEnvioController->create();
              echo json_encode($Result, JSON_UNESCAPED_UNICODE);
            break;
          default:
            throw new Exception("No se encuentra opción solicitada, por favor contactanos");
            break;
        }
      } catch (Exception $e) {
        echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
      }
    }
  }

  $SeguridadController = new SeguridadController();
  # Comprobación Autorización Ajax    
  if ($SeguridadController->decryptData() && $_POST['ActionDatosEnvio']) { 
    $DatosEnvioRoute = new DatosEnvioRoute();
    $DatosEnvioRoute->Controller();
    unset($DatosEnvioRoute);
  }
  unset($SeguridadController);