<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Cliente")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Cliente/Cliente.Model.php';
}if (!class_exists("Detalle_")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Pedido/Detalle.Model.php';
}if (!class_exists('Pedido_')) {
  include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Model.php';
}if (!class_exists('LoginController')) {
  include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Login/Login.Controller.php';
}if (!class_exists("Email")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/Email.php';
}if (!class_exists("TemplateRegistro")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Email/Registro.php';
}if (!class_exists('EncrypData_')) {
  include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/EncrypData.php';
}

  /**
   * 
   */
  class ClienteController{
    
    protected $conn;
    protected $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->Connection = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function get(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $ClienteModel = new Cliente(); 
          $ClienteModel->SetParameters($this->Connection, $this->Tool);
          $items = $ClienteModel->Get($this->filter, $this->order);
          unset($ClienteModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function getBy(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $ClienteModel = new Cliente(); 
          $ClienteModel->SetParameters($this->Connection, $this->Tool);
          $ClienteModel->GetBy($this->filter);
          return $ClienteModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function Create(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $validate = $this->validatePassword();
          if($validate['validate']){
            $EncrypData = new EncrypData_('password');
            $ClienteModel = new Cliente(); 
            $ClienteModel->SetParameters($this->Connection, $this->Tool);
            $ClienteModel->SetClienteKey(0);
            $ClienteModel->SetNombre($_POST["Nombre"]);
            $ClienteModel->SetApellidos($_POST["Apellidos"]);
            $this->Tool->validPhoneNumber("Telefono", "Télefono", true);
            $ClienteModel->SetTelefono($_POST["Telefono"]);
            $this->Tool->validEmail("Correo", "Correo", true);
            $ClienteModel->SetEmail($_POST["Correo"]);
            $ClienteModel->SetPassword($EncrypData->cadenaEncrypt($_POST["Password"]));
            $ClienteModel->SetPasswordB2b($EncrypData->cadenaEncrypt($_POST["ConfirmarPassword"]));
            $ClienteModel->SetActivo('si');
            $ClienteModel->SetTipo('B2C');
            $ClienteModel->SetIngreso(1);
            $ResultCliente = $ClienteModel->create();
            if(!$ResultCliente['error']){
              $LoginController = new LoginController();
              $LoginController->Correo = $ClienteModel->GetEmail();
              $LoginController->Password = $ClienteModel->GetPassword();
              $ResultLogin = $LoginController->validateLogin();
              unset($LoginController);
              if($ResultLogin['error']){
                $Email = new Email();
                $TemplateRegistro = new TemplateRegistro();
                $Email->MailerSubject = utf8_decode("¡Gracias por registrarse!");
                $Email->MailerEmbeddedImagePath = $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/public/images/Otros/welcome.jpg';
                $Email->MailerEmbeddedImageId = "welcome";
                $Email->MailerEmbeddedImageTitle = "registrado";
                $Email->MailerListTo = [$_POST["Correo"]];
                $Email->MailerBody = $TemplateRegistro->body();
                $Email->EmailSendEmail();
                unset($Email);
                unset($TemplateRegistro);
                return $ResultLogin;
              }
            }
            unset($EncrypData);
            unset($ClienteModel);
            return $ResultCliente;
          }else{
            throw new Exception("La contraseña ingresada no corresponde con las especificaciones requeridas.");
          }
        }else{
          throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function clienteB2BCambiarPassword(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $ClienteModel = new Cliente();
          $ClienteModel->SetParameters($this->Connection, $this->Tool);
          $ClienteModel->SetPassword($EncrypData->cadenaEncrypt($_POST["Password"]));
          $ClienteModel->SetPasswordB2b($EncrypData->cadenaEncrypt($_POST["ConfirmarPassword"]));
          $ResultCliente = $ClienteModel->ClienteB2BCambiarPassword();
          if(!$ResultCliente['error']){
            $_SESSION['Ecommerce_ClienteIngreso']  = 1;
          }
          return $ResultCliente;
        }
      } catch (Exception $e) {
          throw $e;
      }
    }

    public function PrimeraCompra(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $PedidoModel = new Pedido_();
          $PedidoModel->SetParameters($this->Connection, $this->Tool);
          $data = $PedidoModel->ListPedidoB2C("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." ", "ORDER BY fecha ASC LIMIT 1");
          unset($PedidoModel);
          return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
        }else{
          throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function PedidosRealizadosYear(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $PedidoModel = new Pedido_();
          $PedidoModel->SetParameters($this->Connection, $this->Tool);
          $FechaInicial = date('Y-01-01 00:00:00');
          $FechaFin     = date('Y-m-d 23:59:59');
          $data = $PedidoModel->ListPedidoB2C("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND fecha BETWEEN '".$FechaInicial."' AND '".$FechaFin."' ", "");
          unset($PedidoModel);
          return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
        }else{
          throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function DiaFavoritoCompra(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $ClienteModel = new Cliente();
          $ClienteModel->SetParameters($this->Connection, $this->Tool);
          $FechaInicial = date('Y-01-01 00:00:00');
          $FechaFin     = date('Y-m-d 23:59:59');
          $data = $ClienteModel->DiaFavoritoCompra("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND fecha BETWEEN '$FechaInicial' AND '$FechaFin' ", "GROUP BY DATE_FORMAT(fecha,'%W') ORDER BY total DESC LIMIT 1 ");
          unset($ClienteModel);
          return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
        }else{
          throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function CompraAnual(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $ClienteModel = new Cliente();
          $ClienteModel->SetParameters($this->Connection, $this->Tool);
          $FechaInicial = date('Y-01-01 00:00:00');
          $FechaFin     = date('Y-m-d 23:59:59');
          $data = $ClienteModel->GetMonto("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND fecha BETWEEN '$FechaInicial' AND '$FechaFin' ", "");
          unset($ClienteModel);
          return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
        }else{
          throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function CompraMensual(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $ClienteModel = new Cliente();
          $ClienteModel->SetParameters($this->Connection, $this->Tool);
          $FechaInicial = date('Y-m-01 00:00:00');
          $FechaFin     = date('Y-m-d 23:59:59');
          $data = $ClienteModel->GetMonto("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND fecha BETWEEN '$FechaInicial' AND '$FechaFin' ", "");
          unset($ClienteModel);
          return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
        }else{
          throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Top5ProductosMasCompradosMonto(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          if(isset($_SESSION["Ecommerce-ClienteKey"])){
            $DetalleModel  = new Detalle_();
            $DetalleModel->SetParameters($this->Connection, $this->Tool);
            $ResultDetalle = $DetalleModel->Top5ProductosMasComprados("codigo, SUM(total) AS total ", "WHERE id_cotizacion IN ( SELECT id FROM listar_pedido_b2c WHERE id_cliente = ".$_SESSION["Ecommerce-ClienteKey"]." ) AND activo = 'si' ", "GROUP BY codigo ORDER BY total DESC LIMIT 5");
            $items = '';
            $items_ = [];
            $data = [];
            if(count($ResultDetalle) > 0){
              foreach ($ResultDetalle as $key => $ProductosMasCompradosMonto) {
                if($key == 0){
                  $items = $ProductosMasCompradosMonto;
                }
                $items_[] = $ProductosMasCompradosMonto;
              }
              $data['ProductosMasCompradosMontoMaximo'] = $items;
              $data['ProductosMasCompradosMonto'] = $items_;
            }
            unset($DetalleModel);
            return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
          }else{
            throw new Exception("No existe ClienteKey");
          }
        }else{
          throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Top5ProductosMasCompradosCantidad(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          if(isset($_SESSION["Ecommerce-ClienteKey"])){
            $DetalleModel  = new Detalle_();
            $DetalleModel->SetParameters($this->Connection, $this->Tool);
            $ResultDetalle = $DetalleModel->Top5ProductosMasComprados("codigo, SUM(cantidad) AS total ", "WHERE id_cotizacion IN ( SELECT id FROM listar_pedido_b2c WHERE id_cliente = ".$_SESSION["Ecommerce-ClienteKey"]." ) AND activo = 'si' ", "GROUP BY codigo ORDER BY total DESC LIMIT 5");
            $items = '';
            $items_ = [];
            $data = [];
            if(count($ResultDetalle) > 0){
              foreach ($ResultDetalle as $key => $ProductosMasCompradosCantidad) {
                if($key == 0){
                  $items = $ProductosMasCompradosCantidad;
                }
                $items_[] = $ProductosMasCompradosCantidad;
              }
              $data['ProductosMasCompradosCantidadMaximo'] = $items;
              $data['ProductosMasCompradosCantidad'] = $items_;
            }
            unset($DetalleModel);
            return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
          }else{
            throw new Exception("No existe ClienteKey");
          }
        }else{
          throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function validatePassword(){
      try {
        $contador = 0;
        $data = [
          "validate" => false
        ];

        $data['items'] = [
          [ "color" => "danger", "descripcion" => "al menos 1 letra mayúscula" ],
          [ "color" => "danger", "descripcion" => "al menos 1 letra minúscula" ],
          [ "color" => "danger", "descripcion" => "al menos 1 carácter numérico" ],
          [ "color" => "danger", "descripcion" => "al menos 1 carácter especial" ],
          [ "color" => "danger", "descripcion" => "al menos 8 caracteres" ]
        ];
   
        if(preg_match("/(?=.*?[A-Z])/", $_POST['Password'])){
          $data['items'][0]["color"] = "success";
          $contador++;
        }if(preg_match("/(?=.*?[a-z])/", $_POST['Password'])){
          $data['items'][1]["color"] = "success";
          $contador++;
        }if(preg_match("/(?=.*?[0-9])/", $_POST['Password'])){
          $data['items'][2]["color"] = "success";
          $contador++;
        }if(preg_match("/(?=.*?[^\w\s])/", $_POST['Password'])){
          $data['items'][3]["color"] = "success";
          $contador++;
        }if(preg_match("/.{8,}$/", $_POST['Password'])){
          $data['items'][4]["color"] = "success";
          $contador++;
        }
   
        if($contador == 5){
          $data["validate"] = true;
        }

        return $data;
   
      }  catch (Exception $e) {
        throw new Exception("Error al intentar cargar información");
      }
    }

    public function GetTotalPuntos(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $PedidoModel = new Pedido_();
          $PedidoModel->SetParameters($this->Connection, $this->Tool);
          $PedidoModel->GetTotalPuntos("id_cliente, SUM(subtotal) AS subtotalbycliente, TRUNCATE((SUM(subtotal)/100),0) AS totalpuntosbycliente", "WHERE estatus = 'P' AND estatus_puntos = 0 AND tipo_pedido = 'NORMAL' AND id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." ");
          return $PedidoModel;
        }else{
          throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetTotalPuntosCanjeados(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $PedidoModel = new Pedido_();
          $PedidoModel->SetParameters($this->Connection, $this->Tool);
          $PedidoModel->GetTotalPuntosCanjeados("clientekey, SUM(puntos) AS totalpuntos ", "WHERE clientekey = ".$_SESSION['Ecommerce-ClienteKey']." ");
          return $PedidoModel;
        }else{
          throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Change($key, $pass){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $ClienteModel = new Cliente();
          $ClienteModel->SetParameters($this->Connection, $this->Tool);
          $ClienteModel->SetClienteKey($key);
          $ClienteModel->SetPassword($pass);
          $ResultCliente = $ClienteModel->ChangePassword();
          unset($ClienteModel);
          return $ResultCliente;
        }
      } catch (Exception $e) {
          throw $e;
      }
    }

  }
