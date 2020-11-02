<?php
    @session_start();
    if (!class_exists('Connection')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Connection.php';
    }if (!class_exists('Functions_tools')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Functions_tools.php';
    }if (!class_exists('Pedido_')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Model.php';
    }if (!class_exists('Cliente')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cliente/Cliente.Model.php';
    }if (!class_exists('OpenPay_')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/OpenPay/OpenPay.Model.php';
    }if (!class_exists('SalesQuatation_')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/B2B/SalesQuatation.Model.php';
    }if (!class_exists('Invoice')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/B2C/Invoice.Model.php';
    }if (!class_exists("ErrorOpenPay")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Logs/ErrorOpenPay.Model.php';
    }if (!class_exists("Email")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/Email.php';
    }if (!class_exists("TemplatePedido")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Email/Pedido.php';
    }
    class OpenPayController{
        private $Connection;
        private $Tool;

        public function __construct(){
            $this->Connection = new Connection();
            $this->Tool = new Functions_tools();

        }
        public function SetParameters($conn,$Tool){
            $this->Connection = $conn;
            $this->Tool = $Tool;
        }
        public function PagoTarjeta(){
            try {
                if (!$this->Connection->conexion()->connect_error) {
                    # validaciones para continuar con el proceso
                    $this->validaciones();
                    # cliente
                    $ClienteModel = new Cliente();
                    $ClienteModel->SetParameters($this->Connection, $this->Tool);
                    $ClienteExiste = $ClienteModel->GetBy("where id_cliente = '".$_SESSION['Ecommerce-ClienteKey']."' ");
                    # valiaion si existe información acerca del cliente solicitado
                    if ($ClienteExiste) {
                        $PedidoModel = new Pedido_();
                        $PedidoModel->SetParameters($this->Connection,  $this->Tool);
                        $PedidoExiste = $PedidoModel->GetBy("where id = '".$_SESSION['Ecommerce-PedidoKey']."' ");
                        # comprobación si el pedio actual existe
                        if ($PedidoExiste) {
                            # crear cargo pago pedido mediante Open Pay
                            $OpenPay_ =  new OpenPay_();
                            $OpenPay_->SetId($_SESSION['Ecommerce-OpenPayId']);
                            $OpenPay_->SetPublicKey($_SESSION['Ecommerce-OpenPayPrivateKey']);
                            $OpenPay_->SetTokenId($_POST['tokenId']);
                            $OpenPay_->SetDeviceSessionId($_POST['deviceSessionId']);
                            $OpenPay_->SetProductionMode(filter_var($_SESSION['Ecommerce-OpenPayProductionMode'], FILTER_VALIDATE_BOOLEAN));
                            $ResultCharge = $OpenPay_->CreateChargeCard($ClienteModel,$PedidoModel);
                            # comprobar si el cargo se completo exitosamente!
                            if ($ResultCharge->status == 'completed') {
                                # guardar información relevante al pedido
                                $PedidoModel->SetMetodoPago('03');
                                $PedidoModel->SetMonedaPago($_POST['monedaPago']);
                                $PedidoModel->SetDatosEnvioKey($_POST['datosEnvio']);
                                $PedidoModel->SetDatosFacturacionKey($_POST['datosFacturacion']);
                                // $PedidoModel->SetNumeroguia();
                                $PedidoModel->SetPaqueteria($_POST['paqueteria']);
                                $PedidoModel->SetTipoCambio($_SESSION['Ecommerce-WS-CurrencyRate']);
                                if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
                                    $PedidoModel->SetDiasExtraCredito($_SESSION['Ecommerce-WS-GetExtraDays']);
                                }
                                $PedidoModel->SetCFDIUser($_POST['CFDIUser']);
                                $ResultPedido = $PedidoModel->Update();
                                if (!$ResultPedido['error']) {
                                    unset($ExistePedido);
                                    unset($PedidoModel);
                                    if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
                                        $this->Tool->validateSession($_SESSION['Ecommerce-WS-GetExtraDays']);
                                        # guardado de información pedido b2b para posteriromente generar los documentos sap
                                        $SalesQuatationModel = new SalesQuatation_();
                                        $SalesQuatationModel->SetParameters($this->Connection, $this->Tool);
                                        $SalesQuatationModel->SetPedidoKey($_SESSION['Ecommerce-PedidoKey']);
                                        $SalesQuatationModel->SetEstatus(50);
                                        $SalesQuatationModel->SetIntentos(0);
                                        $SalesQuatationModel->SetOpenPayTransaccionKey($ResultCharge->id);
                                        $SalesQuatationModel->SetReferencia($_POST['referencia']);
                                        $SalesQuatationModel->SetContactoNombre($_POST['ContactoNombre']);
                                        $SalesQuatationModel->SetContactoTelefono($_POST['ContactoTelefono']);
                                        $SalesQuatationModel->SetContactoCorreo($_POST['ContactoCorreo']);
                                        $ResultSalesQuatation = $SalesQuatationModel->create();
                                        if (!$ResultSalesQuatation['error']) {
                                            // Envio de correo de acuerdo a pedido realizado
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
                                            unset($SalesQuatationModel);
                                            unset($ResultSalesQuatation);
                                        }else{
                                            throw new Exception("No se pudo guardar la información acerca de tu pedido Ecommerce, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                                        }
                                    }else{
                                        # guardado de información pedido b2c para posteriromente generar los documentos sap
                                        $InvoiceModel = new Invoice();
                                        $InvoiceModel->SetParameters($this->Connection, $this->Tool);
                                        $InvoiceModel->SetOpenPayTransaccionKey($ResultCharge->id);
                                        $InvoiceModel->SetPedidoKey($_SESSION['Ecommerce-PedidoKey']);
                                        $InvoiceModel->SetRequiereFactura($_POST['RequiereFactura']);
                                        $InvoiceModel->SetEstatus(50);
                                        $InvoiceModel->SetReferencia($_POST['referencia']);
                                        $InvoiceModel->SetIntentos(0);
                                        $ResultInovice = $InvoiceModel->create();
                                        if (!$ResultInovice['error']) {
                                            // Envio de correo de acuerdo a pedido realizado
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
                                            unset($InvoiceModel);
                                            unset($ResultInovice);
                                        }else{
                                            throw new Exception("No se pudo guardar la información acerca de tu pedido Ecommerce, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                                        }
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
                                throw new Exception("No se pudo generar tu pago de forma correcta, por favor contacta a tu ejecutivo!");
                            }
                            return $ResultCharge;
                        }else{
                            unset($ClienteModel);
                            unset($ClienteExiste);
                            unset($PedidoModel);
                            unset($PedidoExiste);
                            throw new Exception("No se encuentra información acerca del pedido!");
                        }
                    }else{
                        unset($ClienteModel);
                        unset($ClienteExiste);
                        throw new Exception("No se encuentra información acerca del cliente!");
                    }
                }else{
                    throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos");
                }
            } catch (OpenpayApiTransactionError $e) {
                if ($this->openPayExeption($e, "ERROR en la transacción:")) {
                  throw new Exception("ERROR en la transacción:");
                }
                throw new Exception("ERROR en la transacción: No se guardo Log");
            } catch (OpenpayApiRequestError $e) {
                if ($this->openPayExeption($e, "ERROR en la petición:")) {
                  throw new Exception("ERROR en la petición:");
                }
                throw new Exception("ERROR en la petición: No se guardo Log");
            } catch (OpenpayApiConnectionError $e) {
                if ($this->openPayExeption($e, "ERROR en la conexión al API:")) {
                  throw new Exception("ERROR en la conexión al API:");
                }
                throw new Exception("ERROR en la conexión al API: No se guardo Log");
            } catch (OpenpayApiAuthError $e) {
                if ($this->openPayExeption($e, "ERROR en la autenticación:")) {
                  throw new Exception("ERROR en la autenticación:");
                }
                throw new Exception("ERROR en la autenticación: No se guardo Log");
            } catch (OpenpayApiError $e) {
                if ($this->openPayExeption($e, "ERROR en el API:")) {
                  throw new Exception("ERROR en el API:");
                }
                throw new Exception("ERROR en el API: No se guardo Log");
            } catch (Exception $e) {
                throw $e;
            }
        }
        public function PagoBanco(){
            try {
                if (!$this->Connection->conexion()->connect_error) {
                    # validaciones para continuar con el proceso
                    $this->validaciones();
                    # cliente
                    $ClienteModel = new Cliente();
                    $ClienteModel->SetParameters($this->Connection, $this->Tool);
                    $ClienteExiste = $ClienteModel->GetBy("where id_cliente = '".$_SESSION['Ecommerce-ClienteKey']."' ");
                    # valiaion si existe información acerca del cliente solicitado
                    if ($ClienteExiste) {
                        $PedidoModel = new Pedido_();
                        $PedidoModel->SetParameters($this->Connection,  $this->Tool);
                        $PedidoExiste = $PedidoModel->GetBy("where id = '".$_SESSION['Ecommerce-PedidoKey']."' ");
                        # comprobación si el pedio actual existe
                        if ($PedidoExiste) {
                            # crear cargo pago pedido mediante Open Pay
                            $OpenPay_ =  new OpenPay_();
                            $OpenPay_->SetId($_SESSION['Ecommerce-OpenPayId']);
                            $OpenPay_->SetPublicKey($_SESSION['Ecommerce-OpenPayPrivateKey']);
                            $OpenPay_->SetProductionMode(filter_var($_SESSION['Ecommerce-OpenPayProductionMode'], FILTER_VALIDATE_BOOLEAN));
                            $ResultCharge = $OpenPay_->CreateChargeBank($ClienteModel,$PedidoModel);
                            # comprobar si el cargo se completo exitosamente!
                            if ($ResultCharge->status == 'in_progress') {
                                # guardar información relevante al pedido
                                $PedidoModel->SetMetodoPago('03');
                                $PedidoModel->SetMonedaPago($_POST['monedaPago']);
                                $PedidoModel->SetDatosEnvioKey($_POST['datosEnvio']);
                                $PedidoModel->SetDatosFacturacionKey($_POST['datosFacturacion']);
                                // $PedidoModel->SetNumeroguia();
                                $PedidoModel->SetPaqueteria($_POST['paqueteria']);
                                $PedidoModel->SetTipoCambio($_SESSION['Ecommerce-WS-CurrencyRate']);
                                if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
                                    $PedidoModel->SetDiasExtraCredito($_SESSION['Ecommerce-WS-GetExtraDays']);
                                }
                                $PedidoModel->SetCFDIUser($_POST['CFDIUser']);
                                $ResultPedido = $PedidoModel->Update();
                                if (!$ResultPedido['error']) {
                                    unset($ExistePedido);
                                    unset($PedidoModel);
                                    if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
                                        $this->Tool->validateSession($_SESSION['Ecommerce-WS-GetExtraDays']);
                                        # guardado de información pedido b2b para posteriromente generar los documentos sap
                                        $SalesQuatationModel = new SalesQuatation_();
                                        $SalesQuatationModel->SetParameters($this->Connection, $this->Tool);
                                        $SalesQuatationModel->SetPedidoKey($_SESSION['Ecommerce-PedidoKey']);
                                        $SalesQuatationModel->SetEstatus(50);
                                        $SalesQuatationModel->SetIntentos(0);
                                        $SalesQuatationModel->SetOpenPayTransaccionKey($ResultCharge->id);
                                        $SalesQuatationModel->SetReferencia($_POST['paqueteria']);
                                        $SalesQuatationModel->SetContactoNombre($_POST['ContactoNombre']);
                                        $SalesQuatationModel->SetContactoTelefono($_POST['ContactoTelefono']);
                                        $SalesQuatationModel->SetContactoCorreo($_POST['ContactoCorreo']);
                                        $ResultSalesQuatation = $SalesQuatationModel->create();
                                        // if (!$ResultSalesQuatation['error']) {
                                        //     // Envio de correo de acuerdo a pedido realizado
                                        //     $Email = new Email(true);
                                        //     $TemplatePedido = new TemplatePedido();
                                        //     $Email->MailerSubject = "Ecommerce";
                                        //     $Email->MailerBody = $TemplatePedido->body();
                                        //     $Email->MailerListTo = [$ClienteModel->GetEmail()];
                                        //     $Email->EmailSendEmail();
                                        //     unset($Email);
                                        //     unset($TemplatePedido);

                                        //     $_SESSION['Ecommerce-PedidoTotal'] = 0;
                                        //     unset($_SESSION['Ecommerce-PedidoKey']);
                                        //     unset($SalesQuatationModel);
                                        //     unset($ResultSalesQuatation);
                                        // }else{
                                        //     throw new Exception("No se pudo guardar la información acerca de tu pedido Ecommerce, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                                        // }
                                        $_SESSION['Ecommerce-PedidoTotal'] = 0;
                                        unset($_SESSION['Ecommerce-PedidoKey']);
                                        unset($SalesQuatationModel);
                                        unset($ResultSalesQuatation);
                                    }else{
                                        # guardado de información pedido b2c para posteriromente generar los documentos sap
                                        $InvoiceModel = new Invoice();
                                        $InvoiceModel->SetParameters($this->Connection, $this->Tool);
                                        $InvoiceModel->SetOpenPayTransaccionKey($ResultCharge->id);
                                        $InvoiceModel->SetPedidoKey($_SESSION['Ecommerce-PedidoKey']);
                                        $InvoiceModel->SetRequiereFactura($_POST['RequiereFactura']);
                                        $InvoiceModel->SetEstatus(50);
                                        $InvoiceModel->SetReferencia($_POST['paqueteria']);
                                        $InvoiceModel->SetIntentos(0);
                                        $ResultInovice = $InvoiceModel->create();
                                        // if (!$ResultInovice['error']) {
                                        //     // Envio de correo de acuerdo a pedido realizado
                                        //     $Email = new Email(true);
                                        //     $TemplatePedido = new TemplatePedido();
                                        //     $Email->MailerSubject = "Ecommerce";
                                        //     $Email->MailerBody = $TemplatePedido->body();
                                        //     $Email->MailerListTo = [$ClienteModel->GetEmail()];
                                        //     $Email->EmailSendEmail();
                                        //     unset($Email);
                                        //     unset($TemplatePedido);

                                        //     $_SESSION['Ecommerce-PedidoTotal'] = 0;
                                        //     unset($_SESSION['Ecommerce-PedidoKey']);
                                        //     unset($InvoiceModel);
                                        //     unset($ResultInovice);
                                        // }else{
                                        //     throw new Exception("No se pudo guardar la información acerca de tu pedido Ecommerce, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                                        // }
                                        $_SESSION['Ecommerce-PedidoTotal'] = 0;
                                        unset($_SESSION['Ecommerce-PedidoKey']);
                                        unset($InvoiceModel);
                                        unset($ResultInovice);
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
                                throw new Exception("No se pudo generar tu pago de forma correcta, por favor contacta a tu ejecutivo!");
                            }
                            return $ResultCharge;
                        }else{
                            unset($ClienteModel);
                            unset($ClienteExiste);
                            unset($PedidoModel);
                            unset($PedidoExiste);
                            throw new Exception("No se encuentra información acerca del pedido!");
                        }
                    }else{
                        unset($ClienteModel);
                        unset($ClienteExiste);
                        throw new Exception("No se encuentra información acerca del cliente!");
                    }
                }else{
                    throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos");
                }
            } catch (OpenpayApiTransactionError $e) {
                if ($this->openPayExeption($e, "ERROR en la transacción:")) {
                  throw new Exception("ERROR en la transacción:");
                }
                throw new Exception("ERROR en la transacción: No se guardo Log");
            } catch (OpenpayApiRequestError $e) {
                if ($this->openPayExeption($e, "ERROR en la petición:")) {
                  throw new Exception("ERROR en la petición:");
                }
                throw new Exception("ERROR en la petición: No se guardo Log");
            } catch (OpenpayApiConnectionError $e) {
                if ($this->openPayExeption($e, "ERROR en la conexión al API:")) {
                  throw new Exception("ERROR en la conexión al API:");
                }
                throw new Exception("ERROR en la conexión al API: No se guardo Log");
            } catch (OpenpayApiAuthError $e) {
                if ($this->openPayExeption($e, "ERROR en la autenticación:")) {
                  throw new Exception("ERROR en la autenticación:");
                }
                throw new Exception("ERROR en la autenticación: No se guardo Log");
            } catch (OpenpayApiError $e) {
                if ($this->openPayExeption($e, "ERROR en el API:")) {
                  throw new Exception("ERROR en el API:");
                }
                throw new Exception("ERROR en el API: No se guardo Log");
            } catch (Exception $e) {
                throw $e;
            }
        }
        public function openPayExeption($exeption, $message){
            try {
              if (!$this->Connection->conexion()->connect_error) {
                $Error = [
                  "description" => $exeption->getMessage(),
                  "error_code"  => $exeption->getErrorCode(),
                  "category"    => $exeption->getCategory(),
                  "http_code"   => $exeption->getHttpCode(),
                  "request_id"  => $exeption->getRequestId()
                ]; 
      
                $ErrorOpenPay = new ErrorOpenPay();
                $ErrorOpenPay->SetParameters($this->Connection, $this->Tool);
                $ErrorOpenPay->SetErrorCode($exeption->getErrorCode());
                $ErrorOpenPay->SetErrorCodeHttp($exeption->getHttpCode());
                $ErrorOpenPay->SetDescription($message);
                $ErrorOpenPay->SetDataResponse(json_encode($this->Tool->Clear_data_for_sql($Error)));
                $ErrorOpenPay->SetPedidoKey($_SESSION['Ecommerce-PedidoKey']);
                $resultLog = $ErrorOpenPay->create();
      
                return !$resultLog['error'];
              }else{
                throw new Exception("No hay datos maestros por favor contacta con tu ejecutivo!", 1);
              }   
            } catch (Exception $e) {
              throw $e;
            }
        }

        public function validaciones(){
            # validación si sesión existe y es distinto de nulo
            $this->Tool->validateSession($_SESSION['Ecommerce-PedidoKey']);
            $this->Tool->validateSession($_SESSION['Ecommerce-ClienteKey']);
            $this->Tool->validateSession($_SESSION['Ecommerce-OpenPayId']);
            $this->Tool->validateSession($_SESSION['Ecommerce-OpenPayPrivateKey']);
            $this->Tool->validateSession($_SESSION['Ecommerce-OpenPayProductionMode']);
            $this->Tool->validateSession($_SESSION['Ecommerce-ClienteTipo']);
            $this->Tool->validateSession($_SESSION['Ecommerce-WS-CurrencyRate']);
        }
        

    }