<?php

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Tools/Connection.php';
}
if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Tools/Functions_tools.php';
}
if (!class_exists("SolicitudC")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Solicitud/Ficrece/Alta.Model.php';
}
if (!class_exists("Email")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Email/Emailadd.php';
}
if (!class_exists("TemplateFicrece")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Templates/Email/Alta.php';
}

/**
 * 
 */
class SolicitudCController
{

  protected $Connection;
  protected $Tool;

  public $filter;
  public $order;

  public function __construct()
  {
    $this->Connection = new Connection();
    $this->Tool = new Functions_tools();
  }

  public function Get()
  {
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

  public function GetBy()
  {
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


  public function Alta()
  {
    try {
      if (!$this->Connection->conexion()->connect_error) {
        $SolicitudCModel = new SolicitudC();

        $SolicitudCModel->SetParameters($this->Connection, $this->Tool);

        /*  print_r($_POST);
        exit; */


        $SolicitudCModel->SetRazonSocial($_POST['RazonSocial']);
        $SolicitudCModel->SetRfc($_POST['Rfc']);
        $SolicitudCModel->SetDomicilioFiscal($_POST['DomicilioFiscal']);
        $SolicitudCModel->SetNombreSolicitud($_POST['NombreSolicitud']);
        $SolicitudCModel->SetDepartamento($_POST['Departamento']);
        $SolicitudCModel->SetTitulo($_POST['Titulo']);
        $SolicitudCModel->SetTelefono($_POST['Telefono']);
        $SolicitudCModel->SetCorreo($_POST['Correo']);
        $SolicitudCModel->SetCorreEjecutivo($_POST['CorreEjecutivo']);
        $SolicitudCModel->SetNummeroInt($_POST['NummeroInt']);
        $SolicitudCModel->SetCalle($_POST['Calle']);
        $SolicitudCModel->SetColonia($_POST['Colonia']);
        $SolicitudCModel->SetCuidad($_POST['Cuidad']);
        $SolicitudCModel->SetCP($_POST['CP']);
        $SolicitudCModel->SetEstado($_POST['Estado']);
        $SolicitudCModel->SetNombreComercial($_POST['NombreComercial']);
        $SolicitudCModel->SetWeb($_POST['Web']);
        $SolicitudCModel->SetvaloresCheck($_POST['valoresCheck']);


        /* $ext = end(explode(".", $_FILES['file']['name']));	  */
        /*       $name1 = (hash('sha256', $_FILES['file']['name']) . '.' . $ext); */

        /*  print_r($_POST['PERSONA']);
        exit; */

        if (!mkdir('../../../public/images/img_spl/ficrece/Altas/' . $_POST['Rfc'] . '/', 0777, true)) {

          /*  die('Fallo al crear las carpetas...'); */
        }

        $ext1 = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $name1 =  ('1-' . $_POST['Rfc'] . '.' . $ext1);
        move_uploaded_file($_FILES['file']['tmp_name'], '../../../public/images/img_spl/ficrece/Altas/' . $_POST['Rfc'] . '/' . $name1);
        #$file_nname = $_FILES['file']['name'];
        $SolicitudCModel->SetDoc1($name1);


        $uploadDir = '../../../public/images/img_spl/ficrece/Altas/' . $_POST['Rfc'] . '/';

        // Check whether submitted data is not empty 
        // File path config 
        $fileName =  iconv("UTF-8", "ISO-8859-1", basename($_FILES["file"]["name"]));
        $targetFilePath = $uploadDir . $fileName;

        $ResultSolicitud = $SolicitudCModel->Add();

        if (!$ResultSolicitud['error']) {

          $data = [
            "NombreSolicitud" => $_POST['NombreSolicitud'],
            "Telefono" => $_POST['Telefono'],
            "Correo" => $_POST['Correo'],
            "Rfc" => $_POST['Rfc'],
            "RazonSocial" => $_POST['RazonSocial'],
            "CorreEjecutivo" => $_POST['CorreEjecutivo'],
            "Ciudad" => $_POST['Cuidad'],
            "Estado" => $_POST['Estado']
          ];
          $Email = new Email();
          $TemplateFicrece = new TemplateFicrece();

          $Email->AddAttachment($targetFilePath);

          $Email->MailerSubject = "ALTA CLIENTE";
          /*  $Email->MailerListTo = ["christian.morales@fibremex.com.mx", "lorena.sanchez@fibremex.com.mx","ramon.olea@splittel.com", "aaron.cuevas@splittel.com"]; */
          $Email->MailerListTo = ["ramon.olea@splittel.com"];

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
