<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Mensaje")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Solicitud/Consultecnico/Mensaje.Model.php';
}if (!class_exists("Email")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/Email.php';
}if (!class_exists("TemplateConsultecnico")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Email/Consultecnico.php';
}
if (!class_exists('PreguntaCController')) {
  include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Solicitud/Consultecnico/Pregunta.Controller.php';
}
if (!class_exists("CategoriaController")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Categorias/Categoria.Controller.php';
}

  /**
   * 
   */
  class MensajeController{
    
    protected $Connection;
    protected $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->Connection = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function GetBy(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $MensajeModel = new Mensaje(); 
          $MensajeModel->SetParameters($this->Connection, $this->Tool);
          $MensajeModel->GetBy($this->filter, $this->order);
          return $MensajeModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Get(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $MensajeModel = new Mensaje(); 
          $MensajeModel->SetParameters($this->Connection, $this->Tool);
          $Result = $MensajeModel->Get($this->filter, $this->order);
          unset($MensajeModel);
          return $this->Tool->Message_return(false, "", $Result, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Create(){
			try {
				if (!$this->Connection->conexion()->connect_error) {
					$MensajeModel = new Mensaje(); 
					$MensajeModel->SetParameters($this->Connection, $this->Tool);
					$MensajeModel->SetMensaje($this->Tool->Clear_data_for_sql($_POST['Mensaje']));
					$MensajeModel->SetEstatus("CLIENTE");
					$MensajeModel->SetPreguntaKey($_POST['PreguntaKey']);
          
          $ResultPreguntaC = $MensajeModel -> Add();
          if(!$ResultPreguntaC['error']){

          $PreguntaCController = new PreguntaCController();
          $PreguntaCController->filter = "WHERE t41_pk01 = '".$_POST['PreguntaKey']."'";
          $ResultPregunta = $PreguntaCController->Get();

          $CategoriaController = new CategoriaController();
          $CategoriaController->filter = " WHERE id_codigo = '".$ResultPregunta->records[0]->Categoria."'";
          $CategoriaController->order = "";
          $ResultCategorias = $CategoriaController->ListarCategoriasConsultecnico();
          
            $data = [
              "Pregunta" => $ResultPregunta->records[0]->Titulo,
              "Categoria" => $ResultCategorias->records[0]->Descripcion,
              "Comentario" => $_POST['Mensaje']
            ];
            
            $Email = new Email();
            $TemplateConsultecnico = new TemplateConsultecnico();
            $Email->MailerSubject = "Consultecnico";
            //$Email->MailerListTo = ["aaron.cuevas@splittel.com"];
            $Email->MailerListTo = ["rodrigo.ramirez@splittel.com", "irving.ramirez@splittel.com"];
            $Email->MailerBody = $TemplateConsultecnico->body($data);
            $Email->EmailSendEmail();
            unset($Email);
            unset($TemplateConsultecnico);
          }

					return $ResultPreguntaC;

        
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

  }
