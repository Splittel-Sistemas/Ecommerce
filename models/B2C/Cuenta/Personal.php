<?php 

  /**
   * Información personal acerca del usuario
   */
  @session_start();
  if (!class_exists("Connection")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
  }if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
  }
  class Personal{
    private $conn;
    private $Tools;
    
    public $PersonalKey;
    public $PersonalNombre;
    public $PersonalApellidos;
    public $PersonalEmail;
    public $PersonalTelefono;
    public $PersonalPassword;
    public $PersonalPasswordConfirm;
    public $PersonalFechaRegistro;
    public $PersonalTipoCliente;
    public $PersonalCardcode;
    public $PersonalSociedad;
    public $PersonalPasswordEcommerce;
    public $PersonalIngreso;

    public function __construct(){
      $this->conn = new Connection();
      $this->Tools = new Functions_tools();
    }
    /**
     * Obtención de datos relacionados al usuario
     *
     * @param string $filter Condiones para la consulta SQL
     * @param string $order Ordenamiento para la consulta SQL
     * @param boolean $return_json 
     *
     * @return obj dependiendo del return_json
     */
    public function get($filter, $order, $return_json){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $SQLSTATEMENT = "SELECT * FROM login_cliente ".$filter." ".$order;
          // echo $SQLSTATEMENT;
          $result = $this->conn->QueryReturn($SQLSTATEMENT);
          while ($row = $result->fetch_object()) {
            $Personal = new Personal();
            $Personal->PersonalKey                = $row->id_cliente;
            $Personal->PersonalNombre             = $row->nombre;
            $Personal->PersonalApellidos          = $row->apellidos;
            $Personal->PersonalTelefono           = $row->telefono;
            $Personal->PersonalPassword           = $row->password;
            $Personal->PersonalEmail              = $row->email;
            $Personal->PersonalFechaRegistro      = $row->fecha_registro;
            $Personal->PersonalTipoCliente        = $row->tipo_cliente;
            $Personal->PersonalCardcode           = $row->cardcode;
            $Personal->PersonalSociedad           = $row->sociedad;
            $Personal->PersonalPasswordEcommerce  = $row->pass_b2b;
            $Personal->PersonalIngreso            = $row->ingreso;
            $items[] = $Personal;
          }
          unset($Personal);
          return $this->Tools->Message_return(false, "Datos obtenidos exitosamente!!!", $items, $return_json);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    /**
     * Obtención de datos relacionados al usuario
     *
     * @param string $filter Condiones para la consulta SQL
     * @param string $order Ordenamiento para la consulta SQL
     * @param boolean $return_json 
     *
     * @return obj dependiendo del return_json
     */
    public function getB2C($filter, $order, $return_json){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $SQLSTATEMENT = "SELECT * FROM listar_cliente_data ".$filter." ".$order;
          // echo $SQLSTATEMENT;
          $result = $this->conn->QueryReturn($SQLSTATEMENT);
          while ($row = $result->fetch_object()) {
            $Personal = new Personal();
            $Personal->PersonalKey                = $row->id_cliente;
            $Personal->PersonalNombre             = $row->nombre;
            $Personal->PersonalApellidos          = $row->apellidos;
            $Personal->PersonalTelefono           = $row->telefono;
            $Personal->PersonalPassword           = $row->password;
            $Personal->PersonalEmail              = $row->email;
            $Personal->PersonalFechaRegistro      = $row->fecha_registro;
            $Personal->PersonalTipoCliente        = $row->tipo;
            $Personal->PersonalCardcode           = $row->cardcode_b2c;
            $Personal->PersonalSociedad           = $row->sociedad_b2c;
            $Personal->PersonalPasswordEcommerce  = $row->password_b2c;
            $items[] = $Personal;
          }
          unset($Personal);
          return $this->Tools->Message_return(false, "Datos obtenidos exitosamente!!!", $items, $return_json);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function create($return_json){
      if (!$this->conn->conexion()->connect_error) {
        try {
          $result = $this->conn->Exec_store_procedure_json("CALL createRegistroCliente(
            '".$this->PersonalNombre."',
            '".$this->PersonalApellidos."',
            '".$this->PersonalTelefono."',
            '".$this->PersonalEmail."',
            '".$this->PersonalPassword."',
            '".$this->PersonalPasswordConfirm."',
           @Result)", "@Result");
          # envio de correo 
          if (!$result['error']) {
            if (!class_exists("Email")) {
              include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/Email.php';
            }if (!class_exists("EmailTest")) {
              include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/EmailTest.php';
            }
              $Email = new Email();
              $EmailTest = new EmailTest();
              $Email->MailerSubject = utf8_decode("¡Gracias por registrarse!");
              $Email->MailerEmbeddedImagePath = $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/public/images/Otros/welcome.jpg';
              $Email->MailerEmbeddedImageId = "welcome";
              $Email->MailerEmbeddedImageTitle = "registrado";
              $Email->MailerListTo = [$this->PersonalEmail];
              $Email->MailerBody = $EmailTest->registroClienteB2C();
              $Email->EmailSendEmail();
          }
          return $return_json = true ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result;
        } catch (Exception $e) {
          throw $e;
        }
      }
    }

    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function changePassword($return_json){
      if (!$this->conn->conexion()->connect_error) {
        try {
          $result = $this->conn->Exec_store_procedure_json("CALL passwordRecovery(
            ".$_SESSION['Ecommerce-ClienteKey'].",
            '".$this->PersonalPassword."',
            '".$this->PersonalPasswordConfirm."',
           @Result)", "@Result");
          return $return_json = true ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result;
        } catch (Exception $e) {
          throw $e;
        }
      }
    }

    public static function controller(){
      try {
        $Personal =  new Personal();
        $Action = $Personal->Tools->validate_isset_post('Action');

        switch ($Action) {
          case 'create':
            $Personal->PersonalNombre           = $Personal->Tools->validDataString("PersonalNombre", 'Nombre', true);
            $Personal->PersonalApellidos        = $Personal->Tools->validDataString("PersonalApellidos", 'Apellido', true);
            $Personal->PersonalEmail            = $Personal->Tools->validEmail("PersonalEmail", "Correo", true);
            $Personal->PersonalTelefono         = $Personal->Tools->validPhoneNumber("PersonalTelefono", "Telefono", true);
            $Personal->PersonalPassword         = $Personal->Tools->validDataString("PersonalPassword", 'Contraseña', true);
            $Personal->PersonalPasswordConfirm  = $Personal->Tools->validDataString("PersonalPasswordConfirm", 'Confirmar contraseña', true);
            echo $Personal->create(true);
            break;
          case 'changePassword':
            $Personal->PersonalPassword         = $Personal->Tools->validDataString("PersonalPassword", 'Contraseña', true);
            $Personal->PersonalPasswordConfirm  = $Personal->Tools->validDataString("PersonalPasswordConfirm", 'Confirmar contraseña', true);
            $Personal->PersonalTerminos  = $Personal->Tools->validate_isset_post('PersonalTerminos');
            if ($Personal->PersonalTerminos == "false") {
              throw new Exception("Debes aceptar los terminos y condicones para poder continuar.");
            }
            echo $Personal->changePassword(true);
            break;
          default:
            echo $Personal->Tools->Message_return(true,  "No se encontro la opción solicitada, por favor pide ayuda al departamento de TI...", null, true);
            break;
        }
      } catch (Exception $e) {
        echo $Personal->Tools->Message_return(true, $e->getMessage(), null, true);
      }
    }

  }

  $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_POST['ActionPersonal'])) { 
    Personal::controller();
  }
  unset($Tool);