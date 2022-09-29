<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("SolicitudC")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Solicitud/Ficrece/Solicitud.Model.php';
}if (!class_exists("Email")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/Email.php';
}if (!class_exists("TemplateFicrece")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Email/Ficrece.php';
}

  /**
   * 
   */
  class SolicitudCController{
    
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
          $SolicitudCModel = new SolicitudC(); 
          $SolicitudCModel->SetParameters($this->Connection, $this->Tool);
          $items = $SolicitudCModel->Get($this->filter, $this->order);
          unset($SolicitudCModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetBy(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $SolicitudCModel = new SolicitudC(); 
          $SolicitudCModel->SetParameters($this->Connection, $this->Tool);
          $SolicitudCModel->GetBy($this->filter, $this->order);
          return $SolicitudCModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Create(){
			try {
				if (!$this->Connection->conexion()->connect_error) {
					$SolicitudCModel = new SolicitudC(); 
					$SolicitudCModel->SetParameters($this->Connection, $this->Tool);
					$SolicitudCModel->SetNombre($this->Tool->Clear_data_for_sql($_POST['Nombre']));
					$SolicitudCModel->SetCorreo($this->Tool->Clear_data_for_sql($_POST['Correo']));
					$SolicitudCModel->SetMonto($this->Tool->Clear_data_for_sql($_POST['Monto']));
          $SolicitudCModel->SetFecha($_POST['Fecha']);
       
          $ResultSolicitud = $SolicitudCModel->Add();

          if(!$ResultSolicitud['error']){
            $data = [
              "Correo" => $_POST['Correo'],
              "Monto" => $_POST['Monto'],
              "Nombre" => $_POST['Nombre'],
              "Fecha" => $_POST['Fecha']


            ];
            
            $Email = new Email();
            $TemplateFicrece = new TemplateFicrece();
            $Email->MailerSubject = "SOLICITUD FICRECE";
            $Email->MailerListTo = [/* "christian.morales@fibremex.com.mx", "lorena.sanchez@fibremex.com.mx", */ "ramon.olea@splittel.com"/* , "aaron.cuevas@splittel.com" */];
            $Email->MailerBody = $TemplateFicrece->body($data);
            $Email->EmailSendEmail();
            unset($Email);
            unset($TemplateFicrece);
          }

					return $ResultSolicitud;
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

  }
