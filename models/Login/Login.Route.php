<?php 

  /**
   * 
   */
  @session_start();
  if (!class_exists("Seguridad")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Seguridad/Seguridad.Controller.php';
  }if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists('LoginController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Login/Login.Controller.php';
  }

  class LoginRoute{
    
    private $Tool;

    public function __construct(){
      $this->Tool = new Functions_tools();
    }

    public function controller(){
      try {
        $Action = $this->Tool->validate_isset_post("Action");
        switch ($Action) {
          case 'login':
            $LoginController = new LoginController();
            $LoginController->Correo = $this->Tool->validEmail("Email", "Correo", true);
            $LoginController->Password = $this->Tool->validDataString("Password", "Password", true);
            $LoginController->Ip = $_POST['Ip'];
            $Result = $LoginController->validateLogin();
            echo json_encode($Result, JSON_UNESCAPED_UNICODE);
            break;
          case 'recovery':
            $LoginController = new LoginController();
            $LoginController->Correo = $this->Tool->validEmail("Email", "Correo", true);
            $Result = $LoginController->sendPasswordTemp();
            echo json_encode($Result, JSON_UNESCAPED_UNICODE);
            break;
          case 'activate':
            $LoginController = new LoginController();
            $LoginController->Correo = $this->Tool->validEmail("Email", "Correo", true);
            $LoginController->Password = $this->Tool->validDataString("Temp", "Temp", true);
            $Result = $LoginController->activatePasswordTemp();
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

  $SeguridadController = new SeguridadController();
  # Comprobación Autorización Ajax    
  if ($SeguridadController->decryptData() && $_POST['ActionLogin']) { 
    $LoginRoute = new LoginRoute();
    $LoginRoute->controller();
    unset($LoginRoute);
  }
  unset($SeguridadController);