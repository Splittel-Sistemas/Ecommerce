<?php 

  /**
   * 
   */
  @session_start();
  if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists('SolicitudCController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Solicitud/Ficrece/Solicitud.Controller.php';
  }

  class SolicitudCRoute{
    
    private $Tool;

    public function __construct(){
      $this->Tool = new Functions_tools();
    }

    public function controller(){
      try {
        $Action = $this->Tool->validate_isset_post("Action");
        switch ($Action) {
          case 'create':
            $SolicitudCController = new SolicitudCController();
						$Result = $SolicitudCController->Create();
						echo json_encode($Result, JSON_UNESCAPED_UNICODE);
            break;
          default:
            throw new Exception("No se encontro la opción solicitada, por favor contactanos.....");
            break;
        }
      } catch (Exception $e) {
        echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
      }
    }
  }

  # Comprobación Autorización Ajax    
  if ($_POST['ActionSolicitud']) { 
    $SolicitudCRoute = new SolicitudCRoute();
    $SolicitudCRoute->controller();
    unset($SolicitudCRoute);
  }
