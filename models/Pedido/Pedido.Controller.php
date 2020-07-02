<?php

@session_start();
if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Connection.php';
}if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
}if (!class_exists('Pedido_')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Pedido.Model.php';
}if (!class_exists('SalesQuatation_')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/B2B/SalesQuatation.Model.php';
}if (!class_exists("Email")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Email/Email.php';
}if (!class_exists("TemplatePedido")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/views/Templates/Email/Pedido.php';
}if (!class_exists("TemplateCostoEnvio")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/views/Templates/Email/CostoEnvio.php';
}if (!class_exists('DetalleController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Detalle.Controller.php';
}if (!class_exists("UpdateRefDeliveryController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/Ecommerce/UpdateRefDelivery.Controller.php';
}if (!class_exists("Webhook")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Logs/Webhook.Model.php';
}
class PedidoController{
    protected $Connection;
    protected $Tool;
    protected $PedidoModel;

    public function __construct(){
        $this->Connection = new Connection();
        $this->Tool = new Functions_tools();
    }
    public function SetParameters(){
        $this->Connection = $conn;
        $this->Tool = $Tool;
    }
    public function getBy(){
        try {
          if (!$this->Connection->conexion()->connect_error) {
            $PedidoModel = new Pedido_(); 
            $PedidoModel->SetParameters($this->Connection, $this->Tool);
            $PedidoModel->GetBy($this->filter, $this->order);
            return $PedidoModel;
          }
        } catch (Exception $e) {
          throw $e;
        }
      }
    public function get(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $result = $PedidoModel->Get($this->filter, $this->order);
                unset($PedidoModel);
                return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $result, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function ListPedidoB2B(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $data = $PedidoModel->ListPedidoB2B("WHERE t06_f006 <> 0 AND t06_f010 <= 150 AND t12_f004 = 'completed' ","");
                unset($PedidoModel);
                return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function GetPedidoB2B_(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $data = $PedidoModel->GetPedidoB2B("WHERE t06_f006 <> 0 AND t06_f010 <= 150 AND metodo_pago = 99 ","");
                unset($PedidoModel);
                return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function GetPedidoB2B(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $data = $PedidoModel->GetPedidoB2B($this->filter,$this->order);
                unset($PedidoModel);
                return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function ListPedidoB2C(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $data = $PedidoModel->ListPedidoB2C("WHERE t05_f008 <> 0 AND t05_f011 <= 150 AND t12_f004 = 'completed' ","");
                unset($PedidoModel);
                return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function PedidosPagoBancoTranferenciaCompleta(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $data = $PedidoModel->ListPedidoPagoBanco("WHERE t12_f003 = 0 AND t12_f004 = 'completed' AND t12_f006 = 'bank_account' ","");
                foreach ($data as $key => $row) {
                    $Email = new Email(true);
                    $TemplatePedido = new TemplatePedido();
                    $Email->MailerSubject = "Ecommerce";
                    $Email->MailerBody = $TemplatePedido->EcommercePedidoPagoBanco($row->Key);
                    $Email->MailerListTo = [$row->Correo];
                    $Email->EmailSendEmail();
                    
                    $Webhook = new Webhook();
                    $Webhook->SetParameters($this->Connection, $this->Tool);
                    $Webhook->SetPedidoKey($row->Key);
                    $Webhook->SetEstatus(1);
                    $Webhook->update();

                    unset($Webhook);
                    unset($Email);
                    unset($TemplatePedido);
                }
                unset($PedidoModel);
                return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function ListPedidoB2C_(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $data = $PedidoModel->ListPedidoB2C($this->filter,$this->order);
                unset($PedidoModel);
                return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function ListInfoPagoBanco(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $data = $PedidoModel->GetInfoPagoBanco("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND t12_f004 = 'in_progress' "," ORDER BY id DESC LIMIT 1");
                unset($PedidoModel);
                return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function ListInfoPagoBanco_($PedidoKey){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $data = $PedidoModel->GetInfoPagoBanco("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND id = ".$PedidoKey." AND t12_f004 = 'in_progress' "," ORDER BY id DESC LIMIT 1");
                unset($PedidoModel);
                return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function PaqueteriaPaqueteRecibido(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $ResultPedido = $PedidoModel->Get("WHERE numero_guia_estatus = 'OK' AND recibio <> '' ","");
                $UpdateRefDeliveryController = new UpdateRefDeliveryController();
                foreach ($ResultPedido as $key => $Pedido) {
                    $UpdateRefDeliveryController->NumEcommerce  = $Pedido->Key;
                    $UpdateRefDeliveryController->ClienteKey    = $Pedido->ClienteKey;
                    $UpdateRefDeliveryController->DateDelivery  = $Pedido->FechaRecibido;
                    $UpdateRefDeliveryController->Received      = $Pedido->Recibio;
                    $UpdateRefDeliveryController->create();
                }
                unset($PedidoModel);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function ActualizarCliente(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $data = $PedidoModel->UpdateCliente("WHERE id = ".$_SESSION["Ecommerce-PedidoKey"]." AND activo = 'si' ");
                unset($PedidoModel);
                return $data;
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function CostoEnvio(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $PedidoModel->SetKey($_SESSION['Ecommerce-PedidoKey']);
                $PedidoModel->SetEnvio(1);
                $PedidoModel->SetDatosEnvioKey($_POST['datosEnvio']);
                $ResultPedido = $PedidoModel->UpdateCostoEnvio();
                if(!$ResultPedido['error']){
                    $Email = new Email();
                    $TemplateCostoEnvio = new TemplateCostoEnvio();
                    $Email->MailerSubject = "Solicitud costo de envio";
                    $Email->MailerBody = $TemplateCostoEnvio->body();
                    $Email->MailerListTo[] = $_SESSION['Ecommerce-ClienteTipo'] == 'B2C' ? 'yareli.garcia@splittel.com' : $_SESSION['Ecommerce-ClienteEjecutivo'];
                    $Email->EmailSendEmail();
                    unset($Email);
                    unset($TemplateCostoEnvio);
                    $_SESSION['Ecommerce-CostoEnvio'] =  1;
                }
                unset($PedidoModel);
                return $ResultPedido;
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function ActualizarTipoCambio(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $PedidoModel->SetKey($_SESSION['Ecommerce-PedidoKey']);
                $PedidoModel->SetTipoCambio($_SESSION['Ecommerce-WS-CurrencyRate']);
                $ResultPedido = $PedidoModel->UpdateTipoCambio();
                unset($PedidoModel);
                return $ResultPedido;
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function CuentaCotizacion(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $_SESSION['Ecommerce-PedidoKey'] = $_POST['PedidoKey'];
                $this->filter = "WHERE id =  ".$_SESSION['Ecommerce-PedidoKey']." ";
                $this->order = "";
                $Pedido = $this->getBy();
                $_SESSION['Ecommerce-CostoEnvio'] =  2;
                if($Pedido->GetEnvio() == ''){
                    # actualizar tipo de cambio
                    $PedidoTipoCambio = $this->ActualizarTipoCambio();
                    if(!$PedidoTipoCambio['error']){
                        $DetalleController = new DetalleController();
                        $DetalleController->DetallePedidoActualizar();
                        unset($Pedido);
                        unset($DetalleController);
                        return $PedidoTipoCambio;
                    }else{
                        throw new Exception("No se pudo actualizar tipo de cambio para el pedido actual!");
                    }
                }else if($Pedido->GetEnvio() == 0){
                    # existe costo de envio y no se puede modificar nada 
                    $_SESSION['Ecommerce-CostoEnvio'] =  0;
                    return $this->Tool->Message_return(false,  "Pedido", null, false);
                }else if($Pedido->GetEnvio() == 1){
                    # se solicito costo de envio  no se puede modificar nada
                    $_SESSION['Ecommerce-CostoEnvio'] =  1;
                    return $this->Tool->Message_return(false,  "Pedido", null, false);
                }
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function LineaCredito(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection, $this->Tool);
                $PedidoModel->SetKey($_SESSION['Ecommerce-PedidoKey']);
                $PedidoModel->SetTipoCambio($_SESSION['Ecommerce-WS-CurrencyRate']);
                $PedidoModel->SetDiasExtraCredito($_SESSION['Ecommerce-WS-GetExtraDays']);
                $ResultPedido = $PedidoModel->PedidoLineaCredito();
                unset($PedidoModel);
                return $ResultPedido;
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function pagoCredito(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
               if (isset($_SESSION['Ecommerce-PedidoKey']) && !is_null($_SESSION['Ecommerce-PedidoKey'])) {
                    $ClienteModel = new Cliente();
                    $ClienteModel->SetParameters($this->Connection, $this->Tool);
                    $ClienteExiste = $ClienteModel->GetBy("where id_cliente = '".$_SESSION['Ecommerce-ClienteKey']."' ");

                    if ($ClienteExiste) {
                        $PedidoModel = new Pedido_();
                        $PedidoModel->SetParameters($this->Connection, $this->Tool);
                        $ExistePedido = $PedidoModel->GetBy("WHERE id = '".$_SESSION['Ecommerce-PedidoKey']."' ");
                        if ($ExistePedido) {
                            # actualizar pedido b2b al pagar por linea de credito
                            $PedidoModel->SetMetodoPago(99);
                            $PedidoModel->SetMonedaPago($_POST['monedaPago']);
                            $PedidoModel->SetDatosEnvioKey($_POST['datosEnvio']);
                            $PedidoModel->SetDatosFacturacionKey($_POST['datosFacturacion']);
                            // $PedidoModel->SetNumeroguia();
                            $PedidoModel->SetPaqueteria($_POST['paqueteria']);
                            $PedidoModel->SetTipoCambio($_SESSION['Ecommerce-WS-CurrencyRate']);
                            $PedidoModel->SetDiasExtraCredito($_SESSION['Ecommerce-WS-GetExtraDays']);
                            $PedidoModel->SetCFDIUser($_POST['CFDIUser']);
                            $ResultPedido = $PedidoModel->Update();
                            if (!$ResultPedido['error']) {
                                unset($ExistePedido);
                                unset($PedidoModel);
                                # guardado de información pedido b2b
                                $SalesQuatationModel = new SalesQuatation_();
                                $SalesQuatationModel->SetParameters($this->Connection, $this->Tool);
                                $SalesQuatationModel->SetPedidoKey($_SESSION['Ecommerce-PedidoKey']);
                                $SalesQuatationModel->SetEstatus(50);
                                $SalesQuatationModel->SetReferencia($_POST['referencia']);
                                $SalesQuatationModel->SetIntentos(0);
                                $SalesQuatationModel->SetContactoNombre($_POST['ContactoNombre']);
                                $SalesQuatationModel->SetContactoTelefono($_POST['ContactoTelefono']);
                                $SalesQuatationModel->SetContactoCorreo($_POST['ContactoCorreo']);
                                $ResultSalesQuatation = $SalesQuatationModel->create();
                                // print_r($ResultSalesQuatation);
                                if (!$ResultSalesQuatation['error']) {
                                    $Email = new Email(true);
                                    $TemplatePedido = new TemplatePedido();
                                    $Email->MailerSubject = "Ecommerce";
                                    $Email->MailerBody = $TemplatePedido->body();
                                    $Email->MailerListTo = [$ClienteModel->GetEmail()];
                                    $Email->EmailSendEmail();
                                    unset($Email);
                                    unset($TemplatePedido);
                                    
                                    $_SESSION['Ecommerce-PedidoTotal'] = 0;
                                    unset($_SESSION['Ecommerce-PedidoKey']);
                                    unset($SalesQuatationController);
                                    unset($ResultSalesQuatation);
                                    return $ResultPedido;
                                }else{
                                    throw new Exception("No se pudo guardar la información acerca de tu pedido B2B, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                                }
                            }else{
                                return $ResultPedido;
                            }
                        }else{
                            unset($ClienteModel);
                            unset($ClienteExiste);
                            unset($PedidoModel);
                            unset($PedidoExiste);
                            throw new Exception("No se encuentra información del pedido solicitado, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                        }
                    }else{
                        unset($ClienteModel);
                        unset($ClienteExiste);
                        throw new Exception("No se encuentra información acerca del cliente!");
                    }
                }else{
                    throw new Exception("No existe Pedido, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                }
            }else{
                throw new Exception("No hay datos maestros, por favor contacta con tu ejecutivo!");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }    
}