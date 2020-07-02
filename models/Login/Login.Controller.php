<?php 

/**
 * 
 */
@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists("Cliente")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Cliente/Cliente.Model.php';
}if (!class_exists('OpenPay_')) {
  include $_SERVER['DOCUMENT_ROOT'].'/store/models/OpenPay/OpenPay.Model.php';
}if (!class_exists('DetalleController')) {
  include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Detalle.Controller.php';
}if (!class_exists("GetSegmentController")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/BusinessPartner/GetSegment.Controller.php';
}if (!class_exists('PedidoController')) {
  include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Pedido.Controller.php';
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
            '".$this->Ip."',
            @Result);","@Result");

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
          if(isset($_SESSION['Ecommerce-ClienteTipo']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B' ){
             # obtención porcentaje de descuento cliente
            $GetSegmentController = new GetSegmentController();
            $resultGetSegmentController = $GetSegmentController->get();
            $resultGetSegment = $resultGetSegmentController->GetSegmentResult->Diccionary->Diccionary;
            $ErrorCode = $resultGetSegmentController->GetSegmentResult->ErrorCode;
            $_SESSION['Ecommerce-ClienteDescuento'] = $ErrorCode == 0 ? (float)$resultGetSegment[0]->Value : 'N/D';
          }
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


  
}