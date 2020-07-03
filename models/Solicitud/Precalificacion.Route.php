<?php 

  /**
   * 
   */
  @session_start();
  if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists('PrecalificacionController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Solicitud/Precalificacion.Controller.php';
  }

  class PrecalificacionRoute{
    
    private $Tool;

    public function __construct(){
      $this->Tool = new Functions_tools();
    }

    public function controller(){
      try {
        $Action = $this->Tool->validate_isset_post("Action");
        switch ($Action) {
          case 'file':
            $PrecalificacionController = new PrecalificacionController();
						$Result = $PrecalificacionController->UploadFile();
						echo json_encode($Result, JSON_UNESCAPED_UNICODE);
            break;
          case 'create':
            $PrecalificacionController = new PrecalificacionController();
						$Result = $PrecalificacionController->Create();
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
  if ($_POST['ActionPrecalificacion']) { 
    $PrecalificacionRoute = new PrecalificacionRoute();
    $PrecalificacionRoute->controller();
    unset($PrecalificacionRoute);
  }
