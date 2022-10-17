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
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Email/Email.php';
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

     /*    print_r($_POST);
        exit;
 */
        
        $SolicitudCModel->SetRazonSocial($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetRfc($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetDomicilioFiscal($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetNombreSolicitud($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetDepartamento($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetTitulo($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetTelefono($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetCorreo($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetCorreEjecutivo($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetNummeroInt($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetCalle($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetColonia($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetCuidad($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetCP($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetEstado($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetNombreComercial($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetWeb($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetvaloresCheck($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetDoc1($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));

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





        $ResultSolicitud = $SolicitudCModel->Add();

        if (!$ResultSolicitud['error']) {

          $data = [
          /*   "NombreSolicitud" => $_POST['NombreSolicitud'],
            "MontoCredito" => $_POST['MontoCredito'],
            "Correo" => $_POST['Correo'],
            "Plazo" => $_POST['Plazo'],
            "Rfc" => $_POST['Rfc'],
            "RazonSocial" => $_POST['RazonSocial'],
            "FormaPago" => $_POST['FormaPago'],
            "Telefono" => $_POST['Telefono'],
            "Curp" => $_POST['Curp'],
            "Observaciones" => $_POST['Observaciones'],
            "PERSONA" => $_POST['PERSONA']
 */


          ];
          $Email = new Email();
          $TemplateFicrece = new TemplateFicrece();
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
