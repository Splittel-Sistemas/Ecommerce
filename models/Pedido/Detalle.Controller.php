<?php
@session_start();
if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists('Detalle_')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Detalle.Model.php';
}if (!class_exists('Pedido_')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Model.php';
}if (!class_exists('SalesQuatation_')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/B2B/SalesQuatation.Model.php';
}if (!class_exists('Invoice')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/B2C/Invoice.Model.php';
}if (!class_exists("Email")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/Email.php';
}if (!class_exists("TemplateCanjeoPuntos")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Email/CanjeoPuntos.php';
}if (!class_exists("PuntosCanjeados")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Puntos/PuntosCanjeados.Model.php';
}

class DetalleController{
    protected $Connection;
    protected $Tool;

    public $filter;
    public $order;

    public function __construct(){
        $this->Connection    = new Connection();
        $this->Tool          = new Functions_tools();
    }
    
    public function GetByDetallePedido(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $DetalleModel  = new Detalle_();
                $DetalleModel->SetParameters($this->Connection, $this->Tool);
                $result = $DetalleModel->GetByDetallePedido($this->filter, $this->order);
                return $DetalleModel;
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function GetDetallePedido(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $DetalleModel  = new Detalle_();
                $DetalleModel->SetParameters($this->Connection, $this->Tool);
                $PedidoKey = isset($_SESSION["Ecommerce-PedidoKey"]) ? $_SESSION["Ecommerce-PedidoKey"] : ""; 
                $result = $DetalleModel->ListDetallePedido("WHERE pedidokey = '".$PedidoKey."' AND detalle_activo = 'si' ","");
                return $this->Tool->Message_return(false,  "", $result, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function GetDetallePedido_($filter){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $DetalleModel  = new Detalle_();
                $DetalleModel->SetParameters($this->Connection, $this->Tool);
                $result = $DetalleModel->ListDetallePedido($filter, "");
                return $this->Tool->Message_return(false,  "", $result, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function GetDetallePedidoPuntos($filter){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $DetalleModel  = new Detalle_();
                $DetalleModel->SetParameters($this->Connection, $this->Tool);
                $result = $DetalleModel->ListDetallePedidoPuntos($filter, "");
                return $this->Tool->Message_return(false,  "", $result, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function ListDetallePedido(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $DetalleModel  = new Detalle_();
                $DetalleModel->SetParameters($this->Connection, $this->Tool);
                $result = $DetalleModel->ListDetallePedido($this->filter, $this->order);
                return $this->Tool->Message_return(false,  "", $result, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function DetallePedidoActualizar(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $ResultDetallePedido = $this->GetDetallePedido_("WHERE pedidokey = '".$_SESSION["Ecommerce-PedidoKey"]."' AND detalle_activo = 'si' AND producto_codigo_configurable = '' ", "");
                $data = false;
                foreach($ResultDetallePedido->records as $key => $Obj){
                    $DetalleModel  = new Detalle_();
                    $DetalleModel->SetParameters($this->Connection, $this->Tool);
                    $DetalleModel->SetKey($Obj->DetalleKey);
                    $DetalleModel->SetPedidoKey($Obj->PedidoKey);
                    $DetalleModel->SetCodigo($Obj->DetalleCodigo);
                    $DetalleModel->SetCantidad($Obj->DetalleCantidad);
                    $DetalleModel->SetDescuento($Obj->Descuento);
                    $ResultDetalle = $DetalleModel->Update();
                    if(!$ResultDetalle['error']){
                        $data = !$ResultDetalle['error'];
                    }
                }
                return $data;
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function AgregarArticuloPedido(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                if(isset($_SESSION['Ecommerce-CostoEnvio']) && $_SESSION['Ecommerce-CostoEnvio'] > 1){
                    if(!isset($_SESSION["Ecommerce-PedidoKey"])){
                        $PedidoModel = new Pedido_();  
                        $PedidoModel->SetParameters($this->Connection, $this->Tool);  
                        $PedidoModel->SetTipoCambio($_SESSION['Ecommerce-WS-CurrencyRate']);    
                        $PedidoModel->SetDiasExtraCredito(isset($_SESSION['Ecommerce-WS-GetExtraDays']) ? $_SESSION['Ecommerce-WS-GetExtraDays'] : 0);    
                        $PedidoModel->SetClienteKey(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);    
                        $PedidoModel->SetTipoPedido("NORMAL");
                        $ResultPedido =  $PedidoModel->CreatePedido(); 
                        if(!$ResultPedido['error']){
                            $_SESSION["Ecommerce-PedidoKey"] = $ResultPedido['keyy'];
                        }
                    }
                    if(isset($_SESSION["Ecommerce-PedidoKey"])){
                        $DetalleModel  = new Detalle_();
                        $DetalleModel->SetParameters($this->Connection, $this->Tool);
                        $DetalleModel->SetKey(0);
                        $DetalleModel->SetPedidoKey($_SESSION["Ecommerce-PedidoKey"]);
                        $DetalleModel->SetCodigo($_POST['Codigo']);
                        $DetalleModel->SetCantidad($_POST['Cantidad']);
                        $DetalleModel->SetDescuento($_POST['Descuento']);
                        $DetalleModel->SetCantidadValidacion($_POST['CantidadValidacion']);
                        return $ResultDetalle = $DetalleModel->Create();
                    }
                    return $ResultPedido;
                }else{
                    throw new Exception("Recuerda que una vez solicitado tu costo de envio, no podras agregar mas productos a tu pedido.");
                }
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function PedidoConPuntos()
    {
        try {
            if($_POST['Existe'] == 0){
                return $this->Pedido();
            }else if($_POST['Existe'] == 1){
                return $this->AgregarArticuloPedidoConPuntos();
            }else{
                throw new Exception("Opción no disponible!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function Pedido(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PuntosCanjeados = new PuntosCanjeados();
                $PuntosCanjeados->SetParameters($this->Connection, $this->Tool);
                $PuntosCanjeados->SetClienteKey($_SESSION["Ecommerce-ClienteKey"]);
                $PuntosCanjeados->SetProductoPuntosKey($_POST['Key']);
                $Result = $PuntosCanjeados->Create();  
                unset($PuntosCanjeados);              
                if(!$Result['error']){
                    $data =[
                        "Nombre"    => $_POST['ContactoNombre'],
                        "Telefono"  => $_POST['ContactoTelefono'],
                        "Correo"    => $_POST['ContactoCorreo'],
                        "Ciudad"    => $_POST['DomicilioCiudad'],
                        "Calle"     => $_POST['DomicilioCalle'],
                        "NoExt"     => $_POST['DomicilioNoExt'],
                        "Colonia"   => $_POST['DomicilioColonia'],
                        "Key"       => $_POST['Key'],
                    ];
                    $Email = new Email();
                    $TemplateCanjeoPuntos = new TemplateCanjeoPuntos();
                    $Email->MailerSubject = "Canjeo de productos";
                    $Email->MailerBody = $TemplateCanjeoPuntos->body($data);
                    $Email->MailerListTo[] = $_SESSION['Ecommerce-ClienteEmail'];
                    $Email->MailerListBCC[] = "marketing.directo@splittel.com";
                    $Email->EmailSendEmail();
                    unset($Email);
                    unset($TemplateCanjeoPuntos);
                    $_SESSION['Ecommerce-ClientePuntosDisponibles'] = $_SESSION['Ecommerce-ClientePuntosDisponibles'] - $_POST['Puntos'];
                    return $this->Tool->Message_return(false, "", [], false);
                }else{
                    throw new Exception("No se pudo guardar la información solicitada!");
                }
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function AgregarArticuloPedidoConPuntos(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                if(!isset($_SESSION["Ecommerce-PuntosPedidoKey"])){
                    $PedidoModel = new Pedido_();  
                    $PedidoModel->SetParameters($this->Connection, $this->Tool);  
                    $PedidoModel->SetTipoCambio($_SESSION['Ecommerce-WS-CurrencyRate']);    
                    $PedidoModel->SetDiasExtraCredito(isset($_SESSION['Ecommerce-WS-GetExtraDays']) ? $_SESSION['Ecommerce-WS-GetExtraDays'] : 0);    
                    $PedidoModel->SetClienteKey(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);    
                    $PedidoModel->SetTipoPedido("CANJEO");    
                    $ResultPedido =  $PedidoModel->CreatePedido(); 
                    if(!$ResultPedido['error']){
                        $_SESSION["Ecommerce-PuntosPedidoKey"] = $ResultPedido['keyy'];
                    }
                }
                if(isset($_SESSION["Ecommerce-PuntosPedidoKey"])){
                    $DetalleModel  = new Detalle_();
                    $DetalleModel->SetParameters($this->Connection, $this->Tool);
                    $DetalleModel->SetKey(0);
                    $DetalleModel->SetPedidoKey($_SESSION["Ecommerce-PuntosPedidoKey"]);
                    $DetalleModel->SetCodigo($_POST['Codigo']);
                    $ResultDetalle = $DetalleModel->CreatePuntos();
                    

                    if (!$ResultDetalle['error']) {
                        $PuntosCanjeados = new PuntosCanjeados();
                        $PuntosCanjeados->SetParameters($this->Connection, $this->Tool);
                        $PuntosCanjeados->SetClienteKey($_SESSION["Ecommerce-ClienteKey"]);
                        $PuntosCanjeados->SetProductoPuntosKey($_POST['Key']);
                        $Result = $PuntosCanjeados->Create(); 
                        
                        $PedidoModel = new Pedido_();
                        $PedidoModel->SetParameters($this->Connection,  $this->Tool);
                        $PedidoExiste = $PedidoModel->GetBy("where id = '".$_SESSION['Ecommerce-PuntosPedidoKey']."' ");
                        # comprobación si el pedio actual existe
                        if ($PedidoExiste) {
                            # guardar información relevante al pedido
                            $PedidoModel->SetMetodoPago($_SESSION['Ecommerce-ClienteTipo'] == 'B2B' ? 99 : '03');
                            $PedidoModel->SetMonedaPago('USD');
                            $PedidoModel->SetDatosEnvioKey($_POST['datosEnvio']);
                            $PedidoModel->SetDatosFacturacionKey($_POST['datosFacturacion']);
                            // $PedidoModel->SetNumeroguia();
                            $PedidoModel->SetTipoCambio($_SESSION['Ecommerce-WS-CurrencyRate']);
                            $PedidoModel->SetCFDIUser('G03');
                            $ResultPedido = $PedidoModel->Update();
                            if (!$ResultPedido['error']) {
                                unset($ExistePedido);
                                unset($PedidoModel);
                                if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
                                    # guardado de información pedido b2b para posteriromente generar los documentos sap
                                    $SalesQuatationModel = new SalesQuatation_();
                                    $SalesQuatationModel->SetParameters($this->Connection, $this->Tool);
                                    $SalesQuatationModel->SetPedidoKey($_SESSION['Ecommerce-PuntosPedidoKey']);
                                    $SalesQuatationModel->SetEstatus(50);
                                    $SalesQuatationModel->SetIntentos(0);
                                    $SalesQuatationModel->SetContactoNombre($_POST['ContactoNombre']);
                                    $SalesQuatationModel->SetContactoTelefono($_POST['ContactoTelefono']);
                                    $SalesQuatationModel->SetContactoCorreo($_POST['ContactoCorreo']);
                                    $ResultSalesQuatation = $SalesQuatationModel->create();
                                    unset($_SESSION['Ecommerce-PuntosPedidoKey']);
                                    $_SESSION['Ecommerce-ClientePuntosDisponibles'] = $_SESSION['Ecommerce-ClientePuntosDisponibles'] - $_POST['Puntos'];
                                }else{
                                    # guardado de información pedido b2c para posteriromente generar los documentos sap
                                    $InvoiceModel = new Invoice();
                                    $InvoiceModel->SetParameters($this->Connection, $this->Tool);
                                    $InvoiceModel->SetPedidoKey($_SESSION['Ecommerce-PuntosPedidoKey']);
                                    $InvoiceModel->SetRequiereFactura($_POST['RequiereFactura']);
                                    $InvoiceModel->SetEstatus(50);
                                    $InvoiceModel->SetIntentos(0);
                                    $ResultInovice = $InvoiceModel->create();
                                    unset($_SESSION['Ecommerce-PuntosPedidoKey']);
                                    $_SESSION['Ecommerce-ClientePuntosDisponibles'] = $_SESSION['Ecommerce-ClientePuntosDisponibles'] - $_POST['Puntos'];
                                }
                                unset($ClienteModel);
                                unset($ClienteExiste);
                                unset($PedidoModel);
                                unset($PedidoExiste);
                                return $ResultPedido;
                            }else{
                                throw new Exception("No se pudo guardar la información acerca de tu pedido, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                            }
                        }else{
                            unset($PedidoModel);
                            unset($PedidoExiste);
                            throw new Exception("No se encuentra información acerca del pedido!");
                        }
                    }else{
                        throw new Exception("No se pudo agregar el articulo seleccionado, por favor contacta a tu ejecutivo!");
                    }
                    return $ResultDetalle;
                }
                return $ResultPedido;
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function AgregarArticuloConfigurablePedido(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                if(isset($_SESSION['Ecommerce-CostoEnvio']) && $_SESSION['Ecommerce-CostoEnvio'] > 1){
                    if(!isset($_SESSION["Ecommerce-PedidoKey"])){
                        $PedidoModel = new Pedido_();  
                        $PedidoModel->SetParameters($this->Connection, $this->Tool);  
                        $PedidoModel->SetTipoCambio($_SESSION['Ecommerce-WS-CurrencyRate']);    
                        $PedidoModel->SetDiasExtraCredito(isset($_SESSION['Ecommerce-WS-GetExtraDays']) ? $_SESSION['Ecommerce-WS-GetExtraDays'] : 0);    
                        $PedidoModel->SetClienteKey(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);    
                        $PedidoModel->SetTipoPedido("NORMAL");
                        $ResultPedido =  $PedidoModel->CreatePedido(); 
                        if(!$ResultPedido['error']){
                            $_SESSION["Ecommerce-PedidoKey"] = $ResultPedido['keyy'];
                        }
                    }
                    if(isset($_SESSION["Ecommerce-PedidoKey"])){
                        $DetalleModel  = new Detalle_();
                        $DetalleModel->SetParameters($this->Connection, $this->Tool);
                        $DetalleModel->SetKey(0);
                        $DetalleModel->SetPedidoKey($_SESSION["Ecommerce-PedidoKey"]);
                        $DetalleModel->SetCodigo($_POST['Codigo']);
                        $DetalleModel->SetCodigoConfigurable($_POST['CodigoConfigurable']);
                        $DetalleModel->SetCantidad($_POST['Cantidad']);
                        $DetalleModel->SetDescuento($_POST['Descuento']);
                        $DetalleModel->SetSubtotal($_POST['Precio']);
                        return $ResultDetalle = $DetalleModel->CreateConfigurable();
                    }
                    return $ResultPedido;
                }else{
                    throw new Exception("Recuerda que una vez solicitado tu costo de envio, no podras agregar mas productos a tu pedido.");
                }
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function DeleteArticuloPedido(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                if(isset($_SESSION["Ecommerce-PedidoKey"])){
                    $DetalleModel  = new Detalle_();
                    $DetalleModel->SetParameters($this->Connection, $this->Tool);
                    $DetalleModel->SetKey($_POST['Key']);
                    $DetalleModel->SetPedidoKey($_SESSION["Ecommerce-PedidoKey"]);
                    $DetalleModel->SetCodigo($_POST['Codigo']);
                    $ResultDetalle = $DetalleModel->Delete();
                    return $ResultDetalle;
                }else{
                    throw new Exception("No hay un pedido actual, por favor recarga la página");
                }
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}