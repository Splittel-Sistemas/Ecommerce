<?php 

/**
 * 
 */
@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists("Email")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Email/Email.php';
}if (!class_exists("EmailTest")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Email/EmailTest.php';
}if (!class_exists("Captcha")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Captcha/Captcha.php';
}

class CatalogoCursos{
  protected $conn;
  protected $Tool;
  protected $Correo = ["marketing.directo@splittel.com"];
  
  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }
  /**
   * Obtención de información relevante catalogo cursos
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function get($filter, $order, $return_json){
    try {
      $items = [];
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM menu_cursos ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        while ($row = $result->fetch_object()) {
          $items[] = $row;
        }
        return $this->Tool->Message_return(false, "", $items, $return_json);
    
      }
    } catch (Exception $e) {
      throw $e;
    }
  }
  /**
   * Guardado de información relevante al Email a enviar de acuerdo si es un curso o boletín
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function sendEmail($return_json){
    try {
      if (!$this->conn->conexion()->connect_error) {

        $ObjCaptcha = new Captcha();
        $retorno = $ObjCaptcha->getCaptcha($_POST['recaptcha_response']);
        if($retorno->success == true && $retorno->score > 0.5){

        $result = $this->conn->Exec_store_procedure_json("CALL CursosAndBoletin(
          '".$this->Descripcion."',
          '".$this->Informacion."',
          '".$this->Correos."',
        @Result);", "@Result");

        if (!$result['error']) {
          $Email = new Email();
          $EmailTest = new EmailTest();
          
          if($this->Descripcion == 'boletin'){ 
            $Email->MailerSubject = utf8_decode("Boletín");
            $Email->MailerBody = $EmailTest->registroBoletin($this->Informacion); 
          }elseif($this->Descripcion == 'catalogo'){
            $Email->MailerSubject = utf8_decode("Descarga de catálogo");
            $Email->MailerBody = $EmailTest->DesCatalogo($this->Catalogo);
          }else{
            $Email->MailerSubject = "Curso";
            $this->Correo = ['cursos@fibremex.com.mx'];
            $Email->MailerBody = $EmailTest->cursos($this->Curso);
          }
          //$Email->MailerBody = $this->Descripcion == 'boletin' ? $EmailTest->registroBoletin($this->Informacion) : $EmailTest->cursos($this->Curso);
          $Email->MailerListTo = $this->Correo;
          $Email->EmailSendEmail();
        }else{
          throw new Exception("No se pudo guardar la información, intenta de nuevo por favor!");
        }
        return $return_json ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result;

      }

      }
    } catch (Exception $e) {
      throw $e;
    }
  }

  public static function controller(){
    try {
      $CatalogoCursos = new CatalogoCursos();
      $Action = $CatalogoCursos->Tool->validate_isset_post('Action');
      $CatalogoCursos->Descripcion =  $CatalogoCursos->Tool->validate_isset_post('Descripcion');
      $CatalogoCursos->Correos     =  $CatalogoCursos->Tool->validate_isset_post('Correos');
      switch ($Action) {
        case 'RegistroCatalogo':
          $Empresa      = $CatalogoCursos->Tool->validDataString('Empresa', 'Empresa', true);
          $Nombre       = $CatalogoCursos->Tool->validDataString('Nombre', 'Nombre', true);
          $Telefono     = $CatalogoCursos->Tool->validPhoneNumber('Telefono', 'Telefono', true);
          $Email        = $CatalogoCursos->Tool->validEmail('Email', 'Correo', true);
          $Giro         = $CatalogoCursos->Tool->validDataString('Giro', 'Giro de la empresa', true);

          $CatalogoCursos->Catalogo['Catalogos'] = [
            'Nombre'      => $Nombre,
            'Empresa'     => $Empresa,
            'Email'       => $Email,
            'Telefono'    => $Telefono,   
            'Giro'        => $Giro   
          ];
          
          $CatalogoCursos->Informacion =  json_encode($CatalogoCursos->Catalogo);
          echo $CatalogoCursos->sendEmail(true);
          break;
        case 'RegistroCursos':
          $NombreCurso  = $CatalogoCursos->Tool->validDataString('NombreCurso', 'Nombre del Curso', true);
          $Nombre       = $CatalogoCursos->Tool->validDataString('Nombre', 'Nombre', true);
          $Empresa      = $CatalogoCursos->Tool->validDataString('Empresa', 'Empresa', true);
          $Email        = $CatalogoCursos->Tool->validEmail('Email', 'Correo', true);
          $Telefono     = $CatalogoCursos->Tool->validPhoneNumber('Telefono', 'Telefono', true);

          $CatalogoCursos->Curso['Cursos'] = [
            'NombreCurso' => $NombreCurso,
            'Nombre'      => $Nombre,
            'Empresa'     => $Empresa,
            'Email'       => $Email,
            'Telefono'    => $Telefono   
          ];

          $CatalogoCursos->Informacion =  json_encode($CatalogoCursos->Curso);
          echo $CatalogoCursos->sendEmail(true);
          break;
        case 'RegistroBoletin':
          $CatalogoCursos->Informacion =  $CatalogoCursos->Tool->validEmail('Correo', 'Correo', true);
          echo $CatalogoCursos->sendEmail(true);
          break;
        default:
          echo $CatalogoCursos->Tool->Message_return(true,  "No se encontro la opción solicitada, por favor pide ayuda al departamento de TI...", null, true);
          break;
      }
    } catch (Exception $e) {
      echo $CatalogoCursos->Tool->Message_return(true, "Error: ".$e->getMessage(), null, true);
    }
  }

}

  $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_POST['ActionCursos'])) { 
    CatalogoCursos::controller();
  }
  unset($Tool);