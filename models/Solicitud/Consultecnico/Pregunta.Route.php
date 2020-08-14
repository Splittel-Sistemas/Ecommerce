<?php 

  /**
   * 
   */
  @session_start();
  if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists('PreguntaCController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Solicitud/Consultecnico/Pregunta.Controller.php';
  }

  class PreguntaCRoute{
    
    private $Tool;

    public function __construct(){
      $this->Tool = new Functions_tools();
    }

    public function controller(){
      try {
        $Action = $this->Tool->validate_isset_post("Action");
        switch ($Action) {
          case 'create':
            $PreguntaCController = new PreguntaCController();
						$Result = $PreguntaCController->Create();
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
  if ($_POST['ActionPregunta']) { 
    $PreguntaCRoute = new PreguntaCRoute();
    $PreguntaCRoute->controller();
    unset($PreguntaCRoute);
  }
