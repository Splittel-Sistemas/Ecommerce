<?php

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Tools/Connection.php';
}
if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Tools/Functions_tools.php';
}
if (!class_exists("SolicitudC")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Solicitud/Ficrece/Solicitud.Model.php';
}
if (!class_exists("Email")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Email/Email.php';
}
if (!class_exists("TemplateFicrece")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Templates/Email/Ficrece.php';
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

  public function Create()
  {
    try {
      if (!$this->Connection->conexion()->connect_error) {
        $SolicitudCModel = new SolicitudC();
        $SolicitudCModel->SetParameters($this->Connection, $this->Tool);
        $SolicitudCModel->SetNombreSolicitud($this->Tool->Clear_data_for_sql($_POST['NombreSolicitud']));
        $SolicitudCModel->SetCorreo($this->Tool->Clear_data_for_sql($_POST['Correo']));
        $SolicitudCModel->SetRazonSocial($this->Tool->Clear_data_for_sql($_POST['RazonSocial']));
        $SolicitudCModel->SetDomicilioFiscal($this->Tool->Clear_data_for_sql($_POST['DomicilioFiscal']));
        $SolicitudCModel->SetColonia($this->Tool->Clear_data_for_sql($_POST['Colonia']));
        $SolicitudCModel->SetCiudad($this->Tool->Clear_data_for_sql($_POST['Ciudad']));
        $SolicitudCModel->SetCp($this->Tool->Clear_data_for_sql($_POST['Cp']));
        $SolicitudCModel->SetFax($this->Tool->Clear_data_for_sql($_POST['Fax']));
        $SolicitudCModel->SetRfc($this->Tool->Clear_data_for_sql($_POST['Rfc']));
        $SolicitudCModel->SetFechaConstitucion($_POST['FechaConstitucion']);
        $SolicitudCModel->SetCurp($this->Tool->Clear_data_for_sql($_POST['Curp']));
        $SolicitudCModel->SetTelefono($this->Tool->Clear_data_for_sql($_POST['Telefono']));
        $SolicitudCModel->SetGiro($this->Tool->Clear_data_for_sql($_POST['Giro']));
        $SolicitudCModel->SetFechaAlta($_POST['FechaAlta']);
        $SolicitudCModel->SetJefeDepto($this->Tool->Clear_data_for_sql($_POST['JefeDepto']));
        $SolicitudCModel->SetBeneficiario($this->Tool->Clear_data_for_sql($_POST['Beneficiario']));
        $SolicitudCModel->SetFormaPago($this->Tool->Clear_data_for_sql($_POST['FormaPago']));
        $SolicitudCModel->SetNombre1($this->Tool->Clear_data_for_sql($_POST['Nombre1']));
        $SolicitudCModel->SetDomicilio1($this->Tool->Clear_data_for_sql($_POST['Domicilio1']));
        $SolicitudCModel->SetCiudad1($this->Tool->Clear_data_for_sql($_POST['Ciudad1']));
        $SolicitudCModel->SetTelefono1($this->Tool->Clear_data_for_sql($_POST['Telefono1']));
        $SolicitudCModel->SetNombre2($this->Tool->Clear_data_for_sql($_POST['Nombre2']));
        $SolicitudCModel->SetDomicilio2($this->Tool->Clear_data_for_sql($_POST['Domicilio2']));
        $SolicitudCModel->SetCiudad2($this->Tool->Clear_data_for_sql($_POST['Ciudad2']));
        $SolicitudCModel->SetTelefono2($this->Tool->Clear_data_for_sql($_POST['Telefono2']));
        $SolicitudCModel->SetNombre3($this->Tool->Clear_data_for_sql($_POST['Nombre3']));
        $SolicitudCModel->SetDomicilio3($this->Tool->Clear_data_for_sql($_POST['Domicilio3']));
        $SolicitudCModel->SetCiudad3($this->Tool->Clear_data_for_sql($_POST['Ciudad3']));
        $SolicitudCModel->SetTelefono3($this->Tool->Clear_data_for_sql($_POST['Telefono3']));
        $SolicitudCModel->SetMontoCredito($this->Tool->Clear_data_for_sql($_POST['MontoCredito']));
        $SolicitudCModel->SetPlazo($this->Tool->Clear_data_for_sql($_POST['Plazo']));
        $SolicitudCModel->SetObservaciones($this->Tool->Clear_data_for_sql($_POST['Observaciones']));

        $ResultSolicitud = $SolicitudCModel->Add();
      /*   print_r($_FILES['file']);
        exit; */
        if (!$ResultSolicitud['error']) {

          $data = [
            "NombreSolicitud" => $_FILES['file']['name'],
            "RazonSocial" => $_POST['RazonSocial'],
            "DomicilioFiscal" => $_POST['DomicilioFiscal'],
            "Observaciones" => $_POST['Observaciones']


          ];

          $Email = new Email();
          $TemplateFicrece = new TemplateFicrece();
          $Email->MailerSubject = "SOLICITUD FICRECE";
          $path='';
          $name=$_FILES['file']['name'];
          $encoding= 'base64';
          $type='';

          $disposition= 'attachment';

          $Email->AddAttachment($path, $name  , $encoding , $type, $disposition );
          $Email->MailerListTo = [/* "christian.morales@fibremex.com.mx", "lorena.sanchez@fibremex.com.mx", */"ramon.olea@splittel.com"/* , "aaron.cuevas@splittel.com" */];
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
