<?php 

  /**
   * 
   */
  @session_start();
  if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists('MensajeController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Solicitud/Consultecnico/Mensaje.Controller.php';
  }

  class MensajeRoute{
    
    private $Tool;

    public function __construct(){
      $this->Tool = new Functions_tools();
    }

    public function controller(){
      try {
        $Action = $this->Tool->validate_isset_post("Action");
        switch ($Action) {
          case 'create':
            $MensajeController = new MensajeController();
						$Result = $MensajeController->Create();
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
  if ($_POST['ActionMensaje']) { 
    $MensajeRoute = new MensajeRoute();
    $MensajeRoute->controller();
    unset($MensajeRoute);
  }
