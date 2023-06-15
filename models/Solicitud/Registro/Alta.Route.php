<?php 

  @session_start();
  if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists('SolicitudRegistroController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Solicitud/Registro/Alta.Controller.php';
  }

  class SolicitudRRoute{
    
    private $Tool;

    public function __construct(){
      $this->Tool = new Functions_tools();
    }
    
    public function controller(){
      try {
       /*  print_r($_POST['CorreEjecutivo']);
        exit; */
        $Action = isset($_POST["Action"]);
          switch ($Action) {
          case "create":
            $SolicitudRegistroController = new SolicitudRegistroController();
						$Result = $SolicitudRegistroController->Alta();
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
  if (isset($_POST['ActionSolicitud'])) { 
    $SolicitudRRoute = new SolicitudRRoute();
    $SolicitudRRoute->controller();
    unset($SolicitudRRoute);
  }
