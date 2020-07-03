<?php
@session_start();
if (!class_exists("Seguridad")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Seguridad/Seguridad.Controller.php';
}if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists('SubcategoriasN1Controller')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Subcategorias/SubcategoriasN1.Controller.php';
}

class SubcategoriasN1Route{
    private $Tool;

    public function __construct(){
        $this->Tool = new Functions_tools();
    }

    public function Controller(){
        try {
            $Action = $this->Tool->validate_isset_post('Action');
            switch ($Action) {
                case 'get':
                    $SubcategoriasN1Controller = new SubcategoriasN1Controller();
                    $SubcategoriasN1Controller->filter = "WHERE codigo = '".$_POST['Codigo']."' ";
                    $SubcategoriasN1Controller->order = "";
                    $Result = $SubcategoriasN1Controller->get();
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
  if ($SeguridadController->decryptData() && $_POST['ActionSubcategoriasN1']) { 
    $SubcategoriasN1Route = new SubcategoriasN1Route();
    $SubcategoriasN1Route->Controller();
    unset($SubcategoriasN1Route);
  }
  unset($SeguridadController); 