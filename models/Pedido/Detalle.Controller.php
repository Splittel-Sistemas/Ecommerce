<?php
@session_start();
if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Connection.php';
}if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
}if (!class_exists('Detalle_')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Detalle.Model.php';
}if (!class_exists('Pedido_')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Pedido.Model.php';
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
                if(!isset($_SESSION["Ecommerce-PedidoKey"])){
                    $PedidoModel = new Pedido_();  
                    $PedidoModel->SetParameters($this->Connection, $this->Tool);  
                    $PedidoModel->SetTipoCambio($_SESSION['Ecommerce-WS-CurrencyRate']);    
                    $PedidoModel->SetDiasExtraCredito(isset($_SESSION['Ecommerce-WS-GetExtraDays']) ? $_SESSION['Ecommerce-WS-GetExtraDays'] : 0);    
                    $PedidoModel->SetClienteKey(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);    
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
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function AgregarArticuloConfigurablePedido(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                if(!isset($_SESSION["Ecommerce-PedidoKey"])){
                    $PedidoModel = new Pedido_();  
                    $PedidoModel->SetParameters($this->Connection, $this->Tool);  
                    $PedidoModel->SetTipoCambio($_SESSION['Ecommerce-WS-CurrencyRate']);    
                    $PedidoModel->SetDiasExtraCredito(isset($_SESSION['Ecommerce-WS-GetExtraDays']) ? $_SESSION['Ecommerce-WS-GetExtraDays'] : 0);    
                    $PedidoModel->SetClienteKey(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);    
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