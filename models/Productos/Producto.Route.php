<?php
@session_start();
if (!class_exists("Seguridad")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Seguridad/Seguridad.Controller.php';
}if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists('ProductoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Productos/Producto.Controller.php';
}

class ProductoRoute{
    private $Tool;

    public function __construct(){
        $this->Tool = new Functions_tools();
    }

    public function Controller(){
        try {
            $Action = $this->Tool->validate_isset_post('Action');
            switch ($Action) {
                case 'get':
                    $ProductoController = new ProductoController();
                    $ProductoController->filter = "WHERE codigo = '".$_POST['Codigo']."' ";
                    $ProductoController->order = "";
                    $Result = $ProductoController->GetProductosFijosConfigurables();
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
  if ($SeguridadController->decryptData() && $_POST['ActionProducto']) { 
    $ProductoRoute = new ProductoRoute();
    $ProductoRoute->Controller();
    unset($ProductoRoute);
  }
  unset($SeguridadController); 