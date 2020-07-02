<?php
@session_start();
if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
}if (!class_exists('ProductoConfigurableController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Productos/ProductoConfigurable.Controller.php';
}

class ProductoConfigurableRoute{
    private $Tool;

    public function __construct(){
        $this->Tool = new Functions_tools();
    }

    public function Controller(){
        try {
            $Action = $this->Tool->validate_isset_post('Action');
            switch ($Action) {
                case 'create':
                    $ProductoConfigurableController = new ProductoConfigurableController();
                    $Result = $ProductoConfigurableController->AgregarNombreProductoConfigurable();
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

    $ProductoConfigurableRoute = new ProductoConfigurableRoute();
    $ProductoConfigurableRoute->Controller();