<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists("PCDefinicionesController")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Productos/Configurables/Definiciones.Controller.php';
}if (!class_exists("PCSubdefinicionesController")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Productos/Configurables/Subdefiniciones.Controller.php';
}if (!class_exists("PCSubdefiniciones_Controller")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Productos/Configurables/Subdefiniciones_.Controller.php';
}

  /**
   * 
   */
  class EstructuraController{

    public function Estructura(){
      try {
        $PCDefinicionesController = new PCDefinicionesController();
        $PCDefinicionesController->filter = "WHERE t27_pk01 = 1 ";
        $PCDefinicionesController->order = "";
        $ResultPCDefiniciones = $PCDefinicionesController->GetBy();

        $Producto[$ResultPCDefiniciones->GetNombre()]['descripcion'] = $ResultPCDefiniciones->GetDescripcion();
        
        $PCSubdefinicionesController = new PCSubdefinicionesController();
        $PCSubdefinicionesController->filter = "WHERE t27_pk01 = 1 ";
        $PCSubdefinicionesController->order = "";
        $ResultPCSubdefiniciones = $PCSubdefinicionesController->Get();
        
        $PCSubdefiniciones_Controller = new PCSubdefiniciones_Controller();

        foreach ($ResultPCSubdefiniciones->records as $key => $Subdefinciones) {
          $componentes[$Subdefinciones->Nombre] = [
            'Key' => $Subdefinciones->Key,
            'Nombre' => $Subdefinciones->Nombre,
            'Descripcion' => $Subdefinciones->Descripcion,
            'Activo' => $Subdefinciones->Activo,
            'DefincionKey' => $Subdefinciones->DefincionKey,
          ];

          $PCSubdefiniciones_Controller->filter = "WHERE t28_pk01 = ".$Subdefinciones->Key." ";
          $PCSubdefiniciones_Controller->order = "";
          $ResultPCSubdefiniciones_ = $PCSubdefiniciones_Controller->Get();

          if($ResultPCSubdefiniciones_->count == 1){
            $Subdefinciones_ = $ResultPCSubdefiniciones_->records[0];
            $items = [
              'Key' => $Subdefinciones_->Key,
              'Abreviatura' => $Subdefinciones_->Abreviatura,
              'Descripcion' => $Subdefinciones_->Descripcion,
              'Option_1' => $Subdefinciones_->Option_1,
              'Activo' => $Subdefinciones_->Activo,
            ];
          }else{
            foreach ($ResultPCSubdefiniciones_->records as $key_ => $Subdefinciones_) {
              $items[] = [
                'Key' => $Subdefinciones_->Key,
                'Abreviatura' => $Subdefinciones_->Abreviatura,
                'Descripcion' => $Subdefinciones_->Descripcion,
                'Option_1' => $Subdefinciones_->Option_1,
                'Activo' => $Subdefinciones_->Activo,
              ];
            }
          }

          $componentes[$Subdefinciones->Nombre]['items'] = $items;
          $items = [];

        }
        $Producto[$ResultPCDefiniciones->GetNombre()]['componentes'] = $componentes;
        // print_r($Producto);
        return $Producto;
      } catch (Exception $e) {
        throw $e;
      }
		}

    public function Estructura_(){
      try {
        $PCDefinicionesController = new PCDefinicionesController();
        $PCDefinicionesController->filter = "WHERE t27_pk01 = 1 ";
        $PCDefinicionesController->order = "";
        $ResultPCDefiniciones = $PCDefinicionesController->GetBy();

        $Producto[$ResultPCDefiniciones->GetNombre()]['descripcion'] = $ResultPCDefiniciones->GetDescripcion();
        
        $PCSubdefinicionesController = new PCSubdefinicionesController();
        $PCSubdefinicionesController->filter = "WHERE t27_pk01 = 1 ";
        $PCSubdefinicionesController->order = "";
        $ResultPCSubdefiniciones = $PCSubdefinicionesController->Get();
        
        $PCSubdefiniciones_Controller = new PCSubdefiniciones_Controller();

        foreach ($ResultPCSubdefiniciones->records as $key => $Subdefinciones) {
          

          $PCSubdefiniciones_Controller->filter = "WHERE t28_pk01 = ".$Subdefinciones->Key." ";
          $PCSubdefiniciones_Controller->order = "";
          $ResultPCSubdefiniciones_ = $PCSubdefiniciones_Controller->Get();

          if($ResultPCSubdefiniciones_->count == 1){
            $Subdefinciones_ = $ResultPCSubdefiniciones_->records[0];
            $x = 'info';
            $items = [
              'Key' => $Subdefinciones_->Key,
              'Abreviatura' => $Subdefinciones_->Abreviatura,
              'Descripcion' => $Subdefinciones_->Descripcion,
              'Option_1' => $Subdefinciones_->Option_1,
              'Activo' => $Subdefinciones_->Activo,
            ];
          }else{
            foreach ($ResultPCSubdefiniciones_->records as $key_ => $Subdefinciones_) {
              $x = 'select';
              $items[] = [
                'Key' => $Subdefinciones_->Key,
                'Abreviatura' => $Subdefinciones_->Abreviatura,
                'Descripcion' => $Subdefinciones_->Descripcion,
                'Option_1' => $Subdefinciones_->Option_1,
                'Activo' => $Subdefinciones_->Activo,
              ];
            }
          }

          $componentes[$x][$key] = [
            'Key' => $Subdefinciones->Key,
            'Nombre' => $Subdefinciones->Nombre,
            'Descripcion' => $Subdefinciones->Descripcion,
            'Activo' => $Subdefinciones->Activo,
            'DefincionKey' => $Subdefinciones->DefincionKey,
          ];

          $componentes[$x][$key]['items'] = $items;
          $y++;
          $items = [];

        }
        $Producto[$ResultPCDefiniciones->GetNombre()]['componentes'] = $componentes;
        // print_r($Producto);
        return $Producto;
      } catch (Exception $e) {
        throw $e;
      }
		}
  }

  // $EstructuraController = new EstructuraController();
  // $ResultEstructura = $EstructuraController->Estructura();