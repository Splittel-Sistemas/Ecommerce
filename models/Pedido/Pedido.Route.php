<?php

@session_start();
if (!class_exists("Seguridad")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Seguridad/Seguridad.Controller.php';
}if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
}if (!class_exists('PedidoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Pedido.Controller.php';
}
class PedidoRoute{
    protected $Tool;

    public function __construct(){
        $this->Tool = new Functions_tools();
    }
    public function Controller(){
        try {
            $Action = $this->Tool->validate_isset_post('Action');
            switch ($Action) {
                case 'pagoCredito':
                    $PedidoController = new PedidoController();
                    $Result = $PedidoController->pagoCredito();
                    echo json_encode($Result, JSON_UNESCAPED_UNICODE);
                break;
                case 'cuentaCotizacion':
                    $PedidoController = new PedidoController();
                    $Result = $PedidoController->CuentaCotizacion();
                    echo json_encode($Result, JSON_UNESCAPED_UNICODE);
                break;
                case 'solicitarCostoEnvio':
                    $PedidoController = new PedidoController();
                    $Result = $PedidoController->CostoEnvio();
                    echo json_encode($Result, JSON_UNESCAPED_UNICODE);
                break;
                case 'lineaCredito':
                    $PedidoController = new PedidoController();
                    $Result = $PedidoController->LineaCredito();
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
  if ($SeguridadController->decryptData() && $_POST['ActionPedido']) { 
    $PedidoRoute = new PedidoRoute();
    $PedidoRoute->Controller();
    unset($PedidoRoute);
  }
  unset($SeguridadController);    