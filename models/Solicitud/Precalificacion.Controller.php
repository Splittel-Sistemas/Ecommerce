<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Precalificacion")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Solicitud/Precalificacion.Model.php';
}if (!class_exists("Precalificacion_")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Solicitud/Precalificacion_.Model.php';
}if (!class_exists("Email")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/Email.php';
}if (!class_exists("TemplatePrecalificacion")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Email/Precalificacion.php';
}if (!class_exists('File')) {
  include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Files/File.Model.php';
}

  /**
   * 
   */
  class PrecalificacionController{
    
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
          $PrecalificacionModel = new Precalificacion(); 
          $PrecalificacionModel->SetParameters($this->Connection, $this->Tool);
          $PrecalificacionModel->GetBy($this->filter, $this->order);
          return $PrecalificacionModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetBy_(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $PrecalificacionModel = new Precalificacion(); 
          $PrecalificacionModel->SetParameters($this->Connection, $this->Tool);
          $PrecalificacionModel->GetBy_($this->filter, $this->order);
          return $PrecalificacionModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetChecks(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $PrecalificacionModel = new Precalificacion_(); 
          $PrecalificacionModel->SetParameters($this->Connection, $this->Tool);
          $Result = $PrecalificacionModel->Get($this->filter, $this->order);
          return $this->Tool->Message_return(false, "", $Result, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Create(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          //print_r($_POST['Terminos']);
          $PrecalificacionModel = new Precalificacion(); 
          $PrecalificacionModel->SetParameters($this->Connection, $this->Tool);
          $PrecalificacionModel->SetTerminos($_POST['Terminos'] ? 1 : 0);
          $PrecalificacionModel->SetNombreFacturacion($_POST['data']['NombreFacturacion']);
          //$PrecalificacionModel->SetRFC($this->Tool->validRFC_($_POST['data']['RFC'], 'RFC', true));
          $PrecalificacionModel->SetRFC($_POST['data']['RFC']);
          $PrecalificacionModel->SetNombreComercial($_POST['data']['NombreComercial']);
          $PrecalificacionModel->SetDireccionFacturacion($_POST['data']['DireccionFacturacion']);
         // $PrecalificacionModel->SetCodigoPostal($this->Tool->validCodigoPostal_($_POST['data']['CodigoPostal'], 'Código Postal', true));
          $PrecalificacionModel->SetCorreo($this->Tool->validEmail_($_POST['data']['Correo'], 'Correo', true));
         /*
          $PrecalificacionModel->SetContacto($_POST['data']['Contacto']);
          $PrecalificacionModel->SetTelefonoOficina($_POST['data']['TelefonoOficina']);
          $PrecalificacionModel->SetTelefonoMovil($_POST['data']['TelefonoMovil']);
          $PrecalificacionModel->SetPaginaWeb($_POST['data']['PaginaWeb']);
          $PrecalificacionModel->SetDireccionOficina($_POST['data']['DireccionOficina']);
          $PrecalificacionModel->SetGiroEmpresa($_POST['data']['GiroEmpresa']);
          $PrecalificacionModel->SetPresencia($_POST['data']['Presencia']);
          $PrecalificacionModel->SetNumeroEmpleados($_POST['data']['NumeroEmpleados']);
					$PrecalificacionModel->SetExperienciaMercado($_POST['data']['ExperienciaMercado']);
					$PrecalificacionModel->SetProyectos($_POST['data']['Proyectos']);
					$PrecalificacionModel->SetSituacionFiscalKey($_SESSION['Ecommerce-FileKey']);
          */
					$ResultPrecalificacion = $PrecalificacionModel->Add();

					if(!$ResultPrecalificacion['error']){
						$Precalificacion_Model = new Precalificacion_(); 
						$Precalificacion_Model->SetParameters($this->Connection, $this->Tool);
						$Precalificacion_Model->SetPrecalificacionKey($ResultPrecalificacion['keyy']);
            /*
						foreach ($_POST['IntegraSoluciones'] as $key => $Soluciones) {
							$Precalificacion_Model->SetCheck(filter_var($Soluciones['value'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0 );
							$Precalificacion_Model->SetSubdefinicionesKey($Soluciones['key']);
							$ResultPrecalificacion_ = $Precalificacion_Model->Add();
						}

						foreach ($_POST['Productos'] as $key => $Productos) {
							$Precalificacion_Model->SetCheck(filter_var($Productos['value'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0 );
							$Precalificacion_Model->SetSubdefinicionesKey($Productos['key']);
							$ResultPrecalificacion_ = $Precalificacion_Model->Add();
						}

						foreach ($_POST['TipoClientes'] as $key => $TipoClientes) {
							$Precalificacion_Model->SetCheck(filter_var($TipoClientes['value'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0 );
							$Precalificacion_Model->SetSubdefinicionesKey($TipoClientes['key']);
							$ResultPrecalificacion_ = $Precalificacion_Model->Add();
            }
            */
            $Email = new Email();
            $TemplatePrecalificacion = new TemplatePrecalificacion();
            $TemplatePrecalificacion->SetKey($ResultPrecalificacion['keyy']); 
            $Email->MailerSubject = utf8_decode("Solicitud Precalificación");
            $Email->MailerBody = $TemplatePrecalificacion->body();
            $Email->MailerListTo = ['marketing.directo@splittel.com'];
            //$Email->MailerListTo = ['aaron.cuevas@splittel.com'];
            $Email->EmailSendEmail();
            unset($Email);
            unset($TemplatePrecalificacion);
            unset($_SESSION['Ecommerce-FileKey']);

					}
          return $ResultPrecalificacion;
        }else{
          throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    /**
     * Envió de datos para configuración inicial plugin file-input
     *
     * @param [object] data 
     *
    */
    public function UploadFile(){
			try {
				if (!$this->Connection->conexion()->connect_error) {
					$this->File_ = $_FILES['situacion-fiscal'];
          $this->Ubicacion  = '../../public/archivos/situacionfiscal/'.$this->File_['name'];
          $this->NombreTemporal = $this->File_['tmp_name'];
          $img = explode('/', $this->File_['type'])[0];
          $ext1 = pathinfo($_FILES['situacion-fiscal']['name'], PATHINFO_EXTENSION);

          if (($ext1)!='pdf' && ($ext1)!='PDF') {
            throw new Exception('La extension del archivo debe ser en formato PDF');
          }
          if($img == 'image'){
            $this->Tipo = 'image';
          }else if($img == 'pdf'){
            $this->Tipo = 'pdf';
          }else{
            return ['error' => 'pdf o imagen'];
          }

					$File = new File();
					$File->SetParameters($this->Connection, $this->Tool);
					$File->SetKey(0);
					$File->SetNombre($this->File_['name']);
					$File->SetUrl($this->Ubicacion);
					$File->SetTipo($this->Tipo);
          $File->SetRelacion($_POST['Relacion']);
          $ResultFile = $File->Add();

          if(!$ResultFile['error']){
            $_SESSION['Ecommerce-FileKey'] = $ResultFile['keyy'];
            $this->Tool->createFolder('../../../public/archivos');
            $this->Tool->createFolder('../../../public/archivos/situacionfiscal');
            
            if (move_uploaded_file($this->NombreTemporal, $this->Ubicacion)) {
              $data[] = [
                'key' => $this->Ubicacion, // some unique key to identify the file
                'caption' => $this->File_['name'], // 
                'downloadUrl' => $this->Ubicacion, // the url to download the file
                'extra' => ['FILE_UBI' => $this->Ubicacion,'Action' => 'deleteFileExpEmployer'],
                'type' => $this->Tipo,
              ];
              if (!empty($data)) {
                $response =  $this->initialPreviewPlugin($data);
                return $response;
              }
            }
          }
				}else{
					throw new Exception("No se pueden obtener los datos maestros! por favor contactanos ");
				}
			} catch (Exception $e) {
				throw $e;
			}
    }
    /**
     * Envió de datos para configuración inicial plugin file-input
     *
     * @param [object] data 
     *
    */
    public function initialPreviewPlugin($data){
      foreach ($data as $key => $data_file) {
        $preview[] = $data_file['downloadUrl'];
        $config[] = $data_file;
      }
      return ['initialPreview' => $preview, 'initialPreviewConfig' => $config, 'initialPreviewAsData' => true];
    }

  }
