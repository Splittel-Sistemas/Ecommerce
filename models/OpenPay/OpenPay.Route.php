<?php
    @session_start();
    if (!class_exists("Seguridad")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Seguridad/Seguridad.Controller.php';
    }if (!class_exists('Connection')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Connection.php';
    }if (!class_exists('Functions_tools')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Functions_tools.php';
    }if (!class_exists('OpenPayController')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/OpenPay/OpenPay.Controller.php';
    }
    class OpenPayRoute{
        private $Tool;

        public function __construct(){
            $this->Tool = new Functions_tools();
        }
        public function Controller(){
            try {
                $Action = $this->Tool->validate_isset_post('Action');
                switch ($Action) {
                    case 'Pago3DSecure':
                        $OpenPayController = new OpenPayController();
                        $Result = $OpenPayController->Pago3DSecure();
                        echo json_encode($Result, JSON_UNESCAPED_UNICODE);
                    break;
                    case 'PagoTarjeta':
                        $OpenPayController = new OpenPayController();
                        $Result = $OpenPayController->PagoTarjeta();
                        echo json_encode($Result, JSON_UNESCAPED_UNICODE);
                    break;
                    case 'PagoBanco':
                        $OpenPayController = new OpenPayController();
                        $Result = $OpenPayController->PagoBanco();
                        echo json_encode($Result, JSON_UNESCAPED_UNICODE);
                    break;
                    case 'ComprobarTransaccion3DSecure':
                        $OpenPayController = new OpenPayController();
                        $Result = $OpenPayController->ComprobarPago3DSecure($_SESSION["Ecommerce-OpenPay-3DSecure-Id"]);
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
    if ($SeguridadController->decryptData() && $_POST['ActionOpenPay']) { 
      $DetalleController = new OpenPayRoute();
      $DetalleController->Controller();
      unset($DetalleController);
    }
    unset($SeguridadController);

?>