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
if (!class_exists("TemplateFicreceError")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Templates/Email/FicreceError.php';
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
        $SolicitudCModel->SetPlazo($_POST['Plazo']);
        $SolicitudCModel->SetObservaciones($this->Tool->Clear_data_for_sql($_POST['Observaciones']));
        $SolicitudCModel->SetPERSONA($_POST['PERSONA']);
        $SolicitudCModel->SetLugar($_POST['LuNaci']);
        $SolicitudCModel->SetNacionalidad($_POST['Nacionalidad']);
        $SolicitudCModel->SetEjecutivo($_POST['ejecutivo']);

    
        if ($_POST['PERSONA'] == 'MORAL') {
          if (isset($_FILES['file']['name'])) {
            $ext1 = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $name1 =  ('1-' . $_POST['Rfc'] . '.pdf');
            #$file_nname = $_FILES['file']['name'];
            $SolicitudCModel->SetDoc1($name1);
          } else {
            $SolicitudCModel->SetDoc1("");
          }

          if (isset($_FILES['file2']['name'])) {
            $ext2 = pathinfo($_FILES['file2']['name'], PATHINFO_EXTENSION);
            $name2 =  ('2-' . $_POST['Rfc'] . '.pdf');
            # $file_nname2 = $_FILES['file2']['name'];
            $SolicitudCModel->SetDoc2($name2);
          } else {
            $SolicitudCModel->SetDoc2("");
          }
        }
      

        if (isset($_FILES['file3']['name'])) {
          $ext3 = pathinfo($_FILES['file3']['name'], PATHINFO_EXTENSION);
          $name3 =  ('3-' . $_POST['Rfc'] . '.pdf');

          $SolicitudCModel->SetDoc3($name3);
        } else {
          $SolicitudCModel->SetDoc3("");
        }



        if (isset($_FILES['file4']['name'])) {
          $ext4 = pathinfo($_FILES['file4']['name'], PATHINFO_EXTENSION);
          $name4 =  ('4-' . $_POST['Rfc'] . '.pdf');
          $SolicitudCModel->SetDoc4($name4);
        } else {
          $SolicitudCModel->SetDoc4("");
        }



        if (isset($_FILES['file5']['name'])) {
          $ext5 = pathinfo($_FILES['file5']['name'], PATHINFO_EXTENSION);
          $name5 =  ('5-' . $_POST['Rfc'] . '.pdf');
          $SolicitudCModel->SetDoc5($name5);
        } else {
          $SolicitudCModel->SetDoc5("");
        }


        if (isset($_FILES['file6']['name'])) {
          $ext6 = pathinfo($_FILES['file6']['name'], PATHINFO_EXTENSION);
          $name6 =  ('6-' . $_POST['Rfc'] . '.pdf');
          $SolicitudCModel->SetDoc6($name6);
        } else {
          $SolicitudCModel->SetDoc6("");
        }




        if (isset($_FILES['file7']['name'])) {
          $ext7 = pathinfo($_FILES['file7']['name'], PATHINFO_EXTENSION);
          $name7 =  ('7-' . $_POST['Rfc'] . '.pdf');
          $SolicitudCModel->SetDoc7($name7);
        } else {
          $SolicitudCModel->SetDoc7("");
        }



        if (isset($_FILES['file8']['name'])) {
          $ext8 = pathinfo($_FILES['file8']['name'], PATHINFO_EXTENSION);
          $name8 =  ('8-' . $_POST['Rfc'] . '.pdf');
          $SolicitudCModel->SetDoc8($name8);
        } else {
          $SolicitudCModel->SetDoc8("");
        }




        if (isset($_FILES['file9']['name'])) {
          $ext9 = pathinfo($_FILES['file9']['name'], PATHINFO_EXTENSION);
          $name9 =  ('9-' . $_POST['Rfc'] . '.pdf');
          $SolicitudCModel->SetDoc9($name9);
        } else {
          $SolicitudCModel->SetDoc9("");
        }




        $ResultSolicitud = $SolicitudCModel->Add();

        if (!$ResultSolicitud['error']) {
          $path = '../../../public/images/img_spl/ficrece/Archivos/' . $_POST['Rfc'] . '/';
          if (!file_exists($path)) {
            mkdir('../../../public/images/img_spl/ficrece/Archivos/' . $_POST['Rfc'] . '/', 0777, true);
          }

          if (isset($_FILES['file']['tmp_name'])) {
            move_uploaded_file($_FILES['file']['tmp_name'], '../../../public/images/img_spl/ficrece/Archivos/' . $_POST['Rfc'] . '/' . $name1);

            move_uploaded_file($_FILES['file2']['tmp_name'], '../../../public/images/img_spl/ficrece/Archivos/' . $_POST['Rfc'] . '/' . $name2);
          }
          move_uploaded_file($_FILES['file3']['tmp_name'], '../../../public/images/img_spl/ficrece/Archivos/' . $_POST['Rfc'] . '/' .  $name3);

          move_uploaded_file($_FILES['file4']['tmp_name'], '../../../public/images/img_spl/ficrece/Archivos/' . $_POST['Rfc'] . '/' .  $name4);

          move_uploaded_file($_FILES['file5']['tmp_name'], '../../../public/images/img_spl/ficrece/Archivos/' . $_POST['Rfc'] . '/' .  $name5);

          move_uploaded_file($_FILES['file6']['tmp_name'], '../../../public/images/img_spl/ficrece/Archivos/' . $_POST['Rfc'] . '/' .  $name6);

          move_uploaded_file($_FILES['file7']['tmp_name'], '../../../public/images/img_spl/ficrece/Archivos/' . $_POST['Rfc'] . '/' .  $name7);

          move_uploaded_file($_FILES['file8']['tmp_name'], '../../../public/images/img_spl/ficrece/Archivos/' . $_POST['Rfc'] . '/' .  $name8);

          move_uploaded_file($_FILES['file9']['tmp_name'], '../../../public/images/img_spl/ficrece/Archivos/' . $_POST['Rfc'] . '/' .  $name9);
          $data = [
            "NombreSolicitud" => $_POST['NombreSolicitud'],
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



          ];
          $Email = new Email();
          $TemplateFicrece = new TemplateFicrece();
          $Email->MailerSubject = "SOLICITUD FICRECE";
          $Email->MailerListTo = ["christian.morales@fibremex.com.mx", $_POST['ejecutivo']];
          $Email->MailerListBCC = ["ramon.olea@splittel.com", "aaron.cuevas@splittel.com"];

          $Email->MailerBody = $TemplateFicrece->body($data);
          $Email->EmailSendEmail();
          unset($Email);
          unset($TemplateFicrece);
        }

        return $ResultSolicitud;
      }
    } catch (Exception $e) {
      $data = [
        "NombreSolicitud" => $_POST['NombreSolicitud'],
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



      ];
      $Email = new Email();
      $TemplateFicreceError = new TemplateFicreceError();
      $Email->MailerSubject = "SOLICITUD FICRECE ERROR";
      $Email->MailerListTo = ["ramon.olea@splittel.com"];
      $Email->MailerListBCC = ["ramon.olea@splittel.com", "aaron.cuevas@splittel.com"];

      $Email->MailerBody = $TemplateFicreceError->body($e, $data);
      $Email->EmailSendEmail();
      unset($Email);
      unset($TemplateFicreceError);
      throw $e;
    }
  }
}
