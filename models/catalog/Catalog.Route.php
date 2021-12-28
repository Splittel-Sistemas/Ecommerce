<?php 

  @session_start();
  if (!class_exists("Seguridad")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Seguridad/Seguridad.Controller.php';
  }if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists('CatalogController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/catalog/Catalog.Controller.php';
  }

  class CatalogRoute{

    private $Tool;

    public function __construct(){
      $this->Tool = new Functions_tools();
    }

    public function Controller(){
      try{
        $Action = $this->Tool->validate_isset_post('Action');
        switch ($Action) {
          case 'get':
              $catalogController = new CatalogController();
              $result = $catalogController->Get();
              echo json_encode($result, JSON_UNESCAPED_UNICODE);
            break;
          default:
            throw new Exception('No se encuentra la opción solicitada');
            break;
        }
      }catch(Exception $e){
        echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
      }
    }
  }

  $SeguridadController = new SeguridadController();
  # Comprobación Autorización Ajax    
  if ($SeguridadController->decryptData() && $_POST['ActionCatalog']) { 
    $CatalogRoute = new CatalogRoute();
    $CatalogRoute->Controller();
    unset($CatalogRoute);
  }
  unset($SeguridadController);