<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("PreguntaC")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Solicitud/Consultecnico/Pregunta.Model.php';
}if (!class_exists("Email")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/Email.php';
}if (!class_exists("TemplateConsultecnico")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Email/Consultecnico.php';
}

  /**
   * 
   */
  class PreguntaCController{
    
    protected $Connection;
    protected $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->Connection = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function Get(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $PreguntaCModel = new PreguntaC(); 
          $PreguntaCModel->SetParameters($this->Connection, $this->Tool);
          $items = $PreguntaCModel->Get($this->filter, $this->order);
          unset($PreguntaCModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetBy(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $PreguntaCModel = new PreguntaC(); 
          $PreguntaCModel->SetParameters($this->Connection, $this->Tool);
          $PreguntaCModel->GetBy($this->filter, $this->order);
          return $PreguntaCModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Create(){
			try {
				if (!$this->Connection->conexion()->connect_error) {
					$PreguntaCModel = new PreguntaC(); 
					$PreguntaCModel->SetParameters($this->Connection, $this->Tool);
					$PreguntaCModel->SetNombre($this->Tool->Clear_data_for_sql($_POST['Nombre']));
					$PreguntaCModel->SetCorreo($this->Tool->Clear_data_for_sql($_POST['Correo']));
					$PreguntaCModel->SetTitulo($this->Tool->Clear_data_for_sql($_POST['Titulo']));
					$PreguntaCModel->SetCategoria($_POST['Categoria']);
          $PreguntaCModel->SetPregunta($this->Tool->Clear_data_for_sql($_POST['Pregunta']));
          $ResultPregunta = $PreguntaCModel->Add();

          if(!$ResultPregunta['error']){
            $data = [
              "Pregunta" => $_POST['Pregunta'],
              "Categoria" => $_POST['CategoriaDescripcion']
            ];
            
            $Email = new Email();
            $TemplateConsultecnico = new TemplateConsultecnico();
            $Email->MailerSubject = "Consultecnico";
            $Email->MailerListTo[] = "rodrigo.ramirez@splittel.com";
            $Email->MailerBody = $TemplateConsultecnico->body($data);
            $Email->EmailSendEmail();
            unset($Email);
            unset($TemplateConsultecnico);
          }

					return $ResultPregunta;
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

  }
