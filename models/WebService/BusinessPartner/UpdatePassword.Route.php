<?php
    @session_start();
    if (!class_exists('Functions_tools')) {
        include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
    }if (!class_exists('UpdatePasswordController')) {
        include $_SERVER['DOCUMENT_ROOT'].'/store/models/Webservice/BusinessPartner/UpdatePassword.Controller.php';
    }
    class UpdatePasswordRoute{
        private $Tool;

        public function __construct(){
            $this->Tool = new Functions_tools();
        }
        public function Controller(){
            try {
                $Action = $this->Tool->validate_isset_post('Action');
                switch ($Action) {
                    case 'update':
                        $UpdatePasswordController = new UpdatePasswordController();
                        $UpdatePasswordController->CardCode = $this->Tool->validate_isset_post('CardCode');
                        $UpdatePasswordController->Password = $this->Tool->validate_isset_post('PasswordB2b');
                        $Result = $UpdatePasswordController->update();
                        if ($Result->ErrorCode == 0) {
                            $_SESSION['Ecommerce-CardCode'] = $UpdatePasswordController->CardCode;
                            $_SESSION['Ecommerce-Password'] = $UpdatePasswordController->Password;
                        }
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
    $Tool = new Functions_tools();
    # Comprobación Autorización Ajax    
    if (/*isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && */isset($_POST['ActionUpdatePasswordRoute'])) { 
        $UpdatePasswordRoute = new UpdatePasswordRoute();
        $UpdatePasswordRoute->Controller();
        unset($UpdatePasswordRoute);
    }
    unset($Tool);

?>