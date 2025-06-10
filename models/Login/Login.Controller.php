<?php 

/**
 * 
 */
@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Cliente")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Cliente/Cliente.Model.php';
}if (!class_exists('OpenPay_')) {
  include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/OpenPay/OpenPay.Model.php';
}if (!class_exists('DetalleController')) {
  include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Detalle.Controller.php';
}if (!class_exists("GetSegmentController")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/BusinessPartner/GetSegment.Controller.php';
}if (!class_exists('PedidoController')) {
  include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
}if (!class_exists('EncrypData_')) {
  include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/EncrypData.php';
}if (!class_exists("Email")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/Email.php';
}if (!class_exists("EmailTest")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/EmailTest.php';
}

class LoginController{

  protected $conn;
  protected $Tool;
  public $Correo;
  public $Password;
  public $Ip;

  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }
  /**
   * validación de login
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function validateLogin(){
    try{
      if(!$this->conn->conexion()->connect_error){
        $result = array();
        $result = $this->conn->Exec_store_procedure_json("CALL Login(
            '".$this->Correo."',
            '".$this->Password."',
            ".$this->validatePassword().",
            '".$this->Ip."',
            @Result);","@Result");

        unset($EncrypData);
        if (!$result['error']) {
          $ResultLoad = $this->load();
        }
        return $result;
      }else{
        return $this->Tool->Message_return(true,"Error!!, No existe conexión",null, false);
      }
    }catch (Exception $e) {
      throw $e;
    }
  }
  /**
   * validación de login
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function validatePassword(){
    try{
      $ClienteModel = new Cliente();
      $ClienteModel->SetParameters($this->conn, $this->Tool);
      $Existe = $ClienteModel->GetBy("where email = '".$this->Correo."' and activo = 'si'");
      if ($Existe) {
        $EncrypData = new EncrypData_('password');  
        $PasswordDesincriptada = $EncrypData->cadenaDecrypt($ClienteModel->GetPassword());
        return $PasswordDesincriptada == $this->Password ? 1 : 0;
      }else{
        throw new Exception("Contraseña o correo incorrectos");
      }
      unset($ClienteModel);
      return 0;
    }catch (Exception $e) {
      throw $e;
    }
  }
  /**
   * Información si el cliente ingreso satisfactoriamente 
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function load(){
    try {
      $ClienteModel = new Cliente();
      $ClienteModel->SetParameters($this->conn, $this->Tool);
      $Existe = $ClienteModel->GetBy("where email = '".$this->Correo."'");
      if ($Existe) {
        $_SESSION['Ecommerce-ClienteKey']      = $ClienteModel->GetClienteKey();
        $_SESSION['Ecommerce-ClienteNombre']   = $ClienteModel->GetNombre().' '.$ClienteModel->GetApellidos();
        $_SESSION['Ecommerce-ClienteEmail']    = $ClienteModel->GetEmail();
        $_SESSION['Ecommerce-ClienteTipo']     = $ClienteModel->GetTipo();
        $_SESSION['Ecommerce_ClienteIngreso']  = $ClienteModel->GetIngreso();
        $_SESSION['Ecommerce-ClienteDescuento'] = $ClienteModel->GetDescuento();
        $_SESSION['Ecommerce-ClienteRedondeo'] = $ClienteModel->GetRedondeo();
        $_SESSION['Ecommerce-ClienteSegmento'] = $ClienteModel->GetSegmento();

        // si existe la sesión tipo de cliente y es B2B 
        if(isset($_SESSION['Ecommerce-ClienteTipo']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B' ){
          $_SESSION['Ecommerce-ClienteEjecutivo'] = $ClienteModel->GetEmailEjecutivo();
          $_SESSION['Ecommerce-WS-GetExtraDays'] = $ClienteModel->GetDiasCredito();
        }

        $OpenPay_ = new OpenPay_();
        $OpenPay_->SetParameters($this->conn, $this->Tool);
        $OpenPayKeys = $OpenPay_->GetKeys();
        if($OpenPayKeys){
          $_SESSION['Ecommerce-OpenPayId']              	= $OpenPay_->GetId();
          $_SESSION['Ecommerce-OpenPayPrivateKey']      	= $OpenPay_->GetPrivateKey();
          $_SESSION['Ecommerce-OpenPayPublicKey']       	= $OpenPay_->GetPublicKey();
          $_SESSION['Ecommerce-OpenPaySandboxMode']     	= $OpenPay_->GetSandboxMode();
          $_SESSION['Ecommerce-OpenPayProductionMode']  	= $OpenPay_->GetProductionMode();
          $_SESSION['Ecommerce-OpenPayUrl']  				      = $OpenPay_->GetUrl();
        }else{
          throw new Exception("No se encontro información acerca Open Pay");
        }

        if(isset($_SESSION["Ecommerce-PedidoKey"]) && $_SESSION["Ecommerce-PedidoKey"]!=""){
          $PedidoController = new PedidoController();
          $PedidoController->ActualizarCliente();
          $DetalleController = new DetalleController();
          $DetalleController->DetallePedidoActualizar();
        }
      }else{
        throw new Exception("¡No se encuentra registrado aún!");
      }
      unset($ClienteModel);
      unset($OpenPay_);
      unset($PedidoController);
      unset($DetalleController);
      return true;
    } catch (Exception $e) {
      throw new Exception("Error al intentar cargar información");
    }
  }

public function generarPasswordTem($longitud = 12) {
  

    $mayusculas = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $minusculas = 'abcdefghijklmnopqrstuvwxyz';
    $numeros    = '0123456789';
    $simbolos   = '!*(]}>?/'; // excluye @

    // Aseguramos al menos un carácter de cada tipo
    $password = '';
    $password .= $mayusculas[random_int(0, strlen($mayusculas) - 1)];
    $password .= $minusculas[random_int(0, strlen($minusculas) - 1)];
    $password .= $numeros[random_int(0, strlen($numeros) - 1)];
    $password .= $simbolos[random_int(0, strlen($simbolos) - 1)];

    // Rellenamos el resto
    $todos = $mayusculas . $minusculas . $numeros . $simbolos;
    for ($i = 4; $i < $longitud; $i++) {
        $password .= $todos[random_int(0, strlen($todos) - 1)];
    }

    // Mezclar para evitar patrón predecible
    return str_shuffle($password);
}

/**
   * send password temp
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function sendPasswordTemp(){
    try{
      $passTemp=$this->generarPasswordTem(12);
      $hash = password_hash($passTemp, PASSWORD_DEFAULT);

      if(!$this->conn->conexion()->connect_error){
        $result = array();
        $result = $this->conn->Exec_store_procedure_json("CALL GeneratePassTemp(
            '".$this->Correo."',
            '".$passTemp."',
            '".$hash."',
            @Result);","@Result");

        
        if (!$result['error']) {
          $Email = new Email();
          $EmailTest = new EmailTest();
          
         
            $Email->MailerSubject = "Recuperar acceso";
            $Email->MailerBody = $EmailTest->RecoveryPassword($passTemp);
         
          $Email->MailerListTo[] = $this->Correo;
          $Email->EmailSendEmail();
        }
        return $result;
      }else{
        return $this->Tool->Message_return(true,"Error!!, No existe conexión",null, false);
      }
    }catch (Exception $e) {
      throw $e;
    }
  }
  
  /**
   * send password temp
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function activatePasswordTemp(){
    try{
     
      if(!$this->conn->conexion()->connect_error){

          $ClienteModel = new Cliente();
      $ClienteModel->SetParameters($this->conn, $this->Tool);
      $Existe = $ClienteModel->GetByRecoveryPass($this->Correo);
      if ($Existe) {
      
        if(password_verify($this->Password,$Existe[0]->Hash) ){
        
        $EncrypData = new EncrypData_('password');  
        $PasswordDesincriptada = $EncrypData->cadenaEncrypt($this->Password);
         
        $result = array();
        $result = $this->conn->Exec_store_procedure_json("CALL ChangePassRecoveryTemp(
            '".$Existe[0]->ClienteKey."',
            '".$PasswordDesincriptada."',
            '".$this->Correo."',
            @Result);","@Result");
        }else{
          throw new Exception("El token no valido, ha expirado o no se encuentra");
        }
       
      }else{
        throw new Exception("No se encuentra información del usuario");
      }
      unset($ClienteModel);

        return $result;
      }else{
        return $this->Tool->Message_return(true,"Error!!, No existe conexión",null, false);
      }
    }catch (Exception $e) {
      throw $e;
    }
  }
 
}