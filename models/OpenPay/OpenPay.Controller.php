<?php
@session_start();
if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Tools/Connection.php';
}
if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Tools/Functions_tools.php';
}
if (!class_exists('Pedido_')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Pedido/Pedido.Model.php';
}
if (!class_exists('Cliente')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Cliente/Cliente.Model.php';
}
if (!class_exists('OpenPay_')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/OpenPay/OpenPay.Model.php';
}
if (!class_exists('SalesQuatation_')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Pedido/B2B/SalesQuatation.Model.php';
}
if (!class_exists('Invoice')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Pedido/B2C/Invoice.Model.php';
}
if (!class_exists("ErrorOpenPay")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Logs/ErrorOpenPay.Model.php';
}
if (!class_exists("Email")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Email/Email.php';
}
if (!class_exists("TemplatePedido")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Templates/Email/Pedido.php';
}
class OpenPayController
{
    private $Connection;
    private $Tool;

    public function __construct()
    {
        $this->Connection = new Connection();
        $this->Tool = new Functions_tools();
    }
    public function SetParameters($conn, $Tool)
    {
        $this->Connection = $conn;
        $this->Tool = $Tool;
    }
    public function GetCharge($id)
    {
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $OpenPay_ =  new OpenPay_();
                $OpenPay_->SetId($_SESSION['Ecommerce-OpenPayId']);
                $OpenPay_->SetPublicKey($_SESSION['Ecommerce-OpenPayPrivateKey']);
                $OpenPay_->SetProductionMode(filter_var($_SESSION['Ecommerce-OpenPayProductionMode'], FILTER_VALIDATE_BOOLEAN));
                $Result = $OpenPay_->GetCharge($id);
                return $Result;
            } else {
                throw new Exception("No hay datos maestros por favor contacta con tu ejecutivo!", 1);
            }
        } catch (OpenpayApiTransactionError $e) {
            if ($this->openPayExeption($e, "ERROR en la transacción1:")) {
                throw new Exception("ERROR en la transacción1:");
            }
            throw new Exception("ERROR en la transacción: No se guardo Log");
        } catch (OpenpayApiRequestError $e) {
            if ($this->openPayExeption($e, "ERROR en la petición1:")) {
                throw new Exception("ERROR en la petición1:");
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
   /*  public function ComprobarPago3DSecure($IdTransaccion)
    {
        try {
            $result = $this->GetCharge($IdTransaccion);
            $array = [
                "completed" => false,
                "status" => $result->status,
                "message" => "No se a completado la transacción: " . $IdTransaccion,
                "openpay" => [
                    "url" => $result->payment_method->url
                ]
            ];
            if ($result->status == "completed") {
                unset($_SESSION["Ecommerce-OpenPay-3DSecure-Id"]);
                $array = [
                    "completed" => true,
                    "status" => $result->status,
                    "message" => "transacción : " . $IdTransaccion . " completada exitosamente "
                ];
            } else if ($result->status == "failed") {
                unset($_SESSION["Ecommerce-OpenPay-3DSecure-Id"]);
            }
            return $array;
        } catch (Exception $e) {
            throw $e;
        }
    } */
    public function ComprobarPago3DSecure($IdTransaccion)
    {
        try {
            $result = $this->GetCharge($IdTransaccion);
            $array = [
                "completed" => false,
                "status" => $result->status,
                "message" => "No se a completado la transacción: " . $IdTransaccion,
                "openpay" => [
                    "url" => $result->payment_method->url
                ]
            ];
            if ($result->status == "completed") {
                unset($_SESSION["Ecommerce-OpenPay-3DSecure-Id"]);
                $array = [
                    "completed" => true,
                    "status" => $result->status,
                    "message" => "transacción : " . $IdTransaccion . " completada exitosamente "
                ];
            } else {
               
             
                
                $array = [
                    "completed" => false,
                    "status" => $result->status,
                    "message" => "No se a completado la transacción: " . $IdTransaccion,
                    "openpay" => [
                        "url" => $result->payment_method->url
                    ]
                ];
                $PedidoModel = new Pedido_();
                $PedidoModel->SetParameters($this->Connection,  $this->Tool);
                $PedidoModel->GetBy("where id = '" . $_SESSION['Ecommerce-PedidoKey'] . "' ");
                $ResultPedido = $PedidoModel->Update3DCANCEL($_SESSION['Ecommerce-PedidoKey'] );

                if (!$ResultPedido['error']) {
                    unset($ExistePedido);
                    unset($PedidoModel);
                }else {
                    throw new Exception("No se pudo guardar la información");
                }

                unset($_SESSION["Ecommerce-OpenPay-3DSecure-Id"]);
                unset($_SESSION['Ecommerce-PedidoKey']);
            }
            return $array;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function PagoTarjeta()
    {
        try {
            if (!$this->Connection->conexion()->connect_error) {
                # validaciones para continuar con el proceso
                $this->validaciones();
                # cliente
                $ClienteModel = new Cliente();
                $ClienteModel->SetParameters($this->Connection, $this->Tool);
                $ClienteExiste = $ClienteModel->GetBy("where id_cliente = '" . $_SESSION['Ecommerce-ClienteKey'] . "' ");
                # valiaion si existe información acerca del cliente solicitado
                if ($ClienteExiste) {
                    $PedidoModel = new Pedido_();
                    $PedidoModel->SetParameters($this->Connection,  $this->Tool);
                    $PedidoExiste = $PedidoModel->GetBy("where id = '" . $_SESSION['Ecommerce-PedidoKey'] . "' ");
                    # comprobación si el pedio actual existe
                    if ($PedidoExiste) {
                        # crear cargo pago pedido mediante Open Pay
                        $OpenPay_ =  new OpenPay_();
                        $OpenPay_->SetId($_SESSION['Ecommerce-OpenPayId']);
                        $OpenPay_->SetPublicKey($_SESSION['Ecommerce-OpenPayPrivateKey']);
                        $OpenPay_->SetTokenId($_POST['tokenId']);
                        $OpenPay_->SetDeviceSessionId($_POST['deviceSessionId']);
                        $OpenPay_->SetProductionMode(filter_var($_SESSION['Ecommerce-OpenPayProductionMode'], FILTER_VALIDATE_BOOLEAN));
                        $ResultCharge = $OpenPay_->CreateChargeCard($ClienteModel, $PedidoModel);
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
                                        $_SESSION['Ecommerce-PedidoTotal'] = 0;
                                        unset($_SESSION['Ecommerce-PedidoKey']);
                                        unset($SalesQuatationModel);
                                        unset($ResultSalesQuatation);
                                    } else {
                                        throw new Exception("No se pudo guardar la información acerca de tu pedido Ecommerce, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                                    }
                                } else {
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
                                        $_SESSION['Ecommerce-PedidoTotal'] = 0;
                                        unset($_SESSION['Ecommerce-PedidoKey']);
                                        unset($InvoiceModel);
                                        unset($ResultInovice);
                                    } else {
                                        throw new Exception("No se pudo guardar la información acerca de tu pedido Ecommerce, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                                    }
                                }
                                unset($ClienteModel);
                                unset($ClienteExiste);
                                unset($PedidoModel);
                                unset($PedidoExiste);
                                return $ResultPedido;
                            } else {
                                throw new Exception("No se pudo guardar la información acerca de tu pedido, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                            }
                        } else {
                            throw new Exception("No se pudo generar tu pago de forma correcta, por favor contacta a tu ejecutivo!");
                        }
                        return $ResultCharge;
                    } else {
                        unset($ClienteModel);
                        unset($ClienteExiste);
                        unset($PedidoModel);
                        unset($PedidoExiste);
                        throw new Exception("No se encuentra información acerca del pedido!");
                    }
                } else {
                    unset($ClienteModel);
                    unset($ClienteExiste);
                    throw new Exception("No se encuentra información acerca del cliente!");
                }
            } else {
                throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos");
            }
        } catch (OpenpayApiTransactionError $e) {
            if ($this->openPayExeption($e, "ERROR en la transacción:")) {
                throw new Exception("ERROR en la transacción:");
            }
            throw new Exception("ERROR en la transacción: No se guardo Log");
        } catch (OpenpayApiRequestError $e) {
            if ($this->openPayExeption($e, "ERROR en la petición3:")) {
                throw new Exception("ERROR en la petición3:");
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
    public function PagoBanco()
    {
        try {
            if (!$this->Connection->conexion()->connect_error) {
                # validaciones para continuar con el proceso
                $this->validaciones();
                # cliente
                $ClienteModel = new Cliente();
                $ClienteModel->SetParameters($this->Connection, $this->Tool);
                $ClienteExiste = $ClienteModel->GetBy("where id_cliente = '" . $_SESSION['Ecommerce-ClienteKey'] . "' ");
                # valiaion si existe información acerca del cliente solicitado
                if ($ClienteExiste) {
                    $PedidoModel = new Pedido_();
                    $PedidoModel->SetParameters($this->Connection,  $this->Tool);
                    $PedidoExiste = $PedidoModel->GetBy("where id = '" . $_SESSION['Ecommerce-PedidoKey'] . "' ");
                    # comprobación si el pedio actual existe
                    if ($PedidoExiste) {
                        # crear cargo pago pedido mediante Open Pay
                        $OpenPay_ =  new OpenPay_();
                        $OpenPay_->SetId($_SESSION['Ecommerce-OpenPayId']);
                        $OpenPay_->SetPublicKey($_SESSION['Ecommerce-OpenPayPrivateKey']);
                        $OpenPay_->SetProductionMode(filter_var($_SESSION['Ecommerce-OpenPayProductionMode'], FILTER_VALIDATE_BOOLEAN));
                        $ResultCharge = $OpenPay_->CreateChargeBank($ClienteModel, $PedidoModel);
                        # asignar id transacción a variable de sesión
                        $_SESSION["Ecommerce-OpenPay-Bank-Id"] = $ResultCharge->id;
                        # comprobar si el cargo se completo exitosamente!
                        if ($ResultCharge->status == 'in_progress') {
                            # guardar información relevante al pedido
                            $PedidoModel->SetMetodoPago('03');
                            $PedidoModel->SetMonedaPago($_POST['monedaPago']);
                            $PedidoModel->SetDatosEnvioKey($_POST['datosEnvio']);
                            $PedidoModel->SetDatosFacturacionKey($_POST['datosFacturacion']);
                            $PedidoModel->SetEstatus('C');
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
                                    $_SESSION['Ecommerce-PedidoTotal'] = 0;
                                    unset($_SESSION['Ecommerce-PedidoKey']);
                                    unset($SalesQuatationModel);
                                    unset($ResultSalesQuatation);
                                } else {
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
                                    $_SESSION['Ecommerce-PedidoTotal'] = 0;
                                    unset($_SESSION['Ecommerce-PedidoKey']);
                                    unset($InvoiceModel);
                                    unset($ResultInovice);
                                }
                                unset($ClienteModel);
                                unset($ClienteExiste);
                                unset($PedidoModel);
                                unset($PedidoExiste);
                                unset($_SESSION["Ecommerce-OpenPay-Bank-Id"]);
                                return $ResultPedido;
                            } else {
                                throw new Exception("No se pudo guardar la información acerca de tu pedido, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                            }
                        } else {
                            throw new Exception("No se pudo generar tu pago de forma correcta, por favor contacta a tu ejecutivo!");
                        }
                        return $ResultCharge;
                    } else {
                        unset($ClienteModel);
                        unset($ClienteExiste);
                        unset($PedidoModel);
                        unset($PedidoExiste);
                        throw new Exception("No se encuentra información acerca del pedido!");
                    }
                } else {
                    unset($ClienteModel);
                    unset($ClienteExiste);
                    throw new Exception("No se encuentra información acerca del cliente!");
                }
            } else {
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

    public function Pago3DSecure()
    {
        try {
            if (!$this->Connection->conexion()->connect_error) {
                # validaciones para continuar con el proceso
                $this->validaciones();
                # cliente
                $ClienteModel = new Cliente();
                $ClienteModel->SetParameters($this->Connection, $this->Tool);
                $ClienteExiste = $ClienteModel->GetBy("where id_cliente = '" . $_SESSION['Ecommerce-ClienteKey'] . "' ");
                # valiaion si existe información acerca del cliente solicitado
                if ($ClienteExiste) {
                    $PedidoModel = new Pedido_();
                    $PedidoModel->SetParameters($this->Connection,  $this->Tool);
                    $PedidoExiste = $PedidoModel->GetBy("where id = '" . $_SESSION['Ecommerce-PedidoKey'] . "' ");
                    # comprobación si el pedio actual existe
                   
                    if ($PedidoExiste) {
                       
                        if (isset($_SESSION["Ecommerce-OpenPay-3DSecure-Id"])) {
                            return $this->ComprobarPago3DSecure($_SESSION["Ecommerce-OpenPay-3DSecure-Id"]);
                        }
                        # crear cargo pago pedido mediante Open Pay
                        $OpenPay_ =  new OpenPay_();
                        $OpenPay_->SetParameters($this->Connection, $this->Tool);
                        $OpenPay_->SetId($_SESSION['Ecommerce-OpenPayId']);
                        $OpenPay_->SetPublicKey($_SESSION['Ecommerce-OpenPayPrivateKey']);
                        $OpenPay_->SetTokenId($_POST['tokenId']);
                        $OpenPay_->SetDeviceSessionId($_POST['deviceSessionId']);
                        $OpenPay_->SetProductionMode(filter_var($_SESSION['Ecommerce-OpenPayProductionMode'], FILTER_VALIDATE_BOOLEAN));
                        $ResultCharge = $OpenPay_->CreateCharge3DSecure($ClienteModel, $PedidoModel);
                        # comprobar si el cargo se completo exitosamente!
                        print_r($ResultCharge );
                        exit();
                        if ($ResultCharge->status == 'charge_pending') {
                            # Pedido
                            $PedidoModel = new Pedido_();
                            $PedidoModel->SetParameters($this->Connection,  $this->Tool);
                            $PedidoExiste = $PedidoModel->GetBy("where id = '" . $_SESSION['Ecommerce-PedidoKey'] . "' ");
                            # guardar información relevante al pedido
                            $PedidoModel->SetMetodoPago('03');
                            $PedidoModel->SetMonedaPago($_POST["monedaPago"]);
                            $PedidoModel->SetDatosEnvioKey($_POST["datosEnvio"]);
                            $PedidoModel->SetDatosFacturacionKey($_POST["datosFacturacion"]);
                            // $PedidoModel->SetNumeroguia();
                            $PedidoModel->SetPaqueteria($_POST["paqueteria"]);
                            $PedidoModel->SetTipoCambio($_SESSION['Ecommerce-WS-CurrencyRate']);
                            if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
                                $PedidoModel->SetDiasExtraCredito($_SESSION['Ecommerce-WS-GetExtraDays']);
                            }
                            $PedidoModel->SetCFDIUser($_POST["CFDIUser"]);
                            $PedidoModel->SetEstatus('C');
                            $ResultPedido = $PedidoModel->Update3DSecure();
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
                                    $SalesQuatationModel->SetReferencia($_POST["referencia"]);
                                    $SalesQuatationModel->SetContactoNombre($_POST["ContactoNombre"]);
                                    $SalesQuatationModel->SetContactoTelefono($_POST["ContactoTelefono"]);
                                    $SalesQuatationModel->SetContactoCorreo($_POST["ContactoCorreo"]);
                                    $ResultSalesQuatation = $SalesQuatationModel->create();
                                    if (!$ResultSalesQuatation['error']) {
                                        unset($SalesQuatationModel);
                                        unset($ResultSalesQuatation);
                                    } else {
                                        throw new Exception("No se pudo guardar la información acerca de tu pedido Ecommerce, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                                    }
                                } else {
                                    # guardado de información pedido b2c para posteriromente generar los documentos sap
                                    $InvoiceModel = new Invoice();
                                    $InvoiceModel->SetParameters($this->Connection, $this->Tool);
                                    $InvoiceModel->SetOpenPayTransaccionKey($ResultCharge->id);
                                    $InvoiceModel->SetPedidoKey($_SESSION['Ecommerce-PedidoKey']);
                                    $InvoiceModel->SetRequiereFactura($_POST["RequiereFactura"]);
                                    $InvoiceModel->SetEstatus(50);
                                    $InvoiceModel->SetReferencia($_POST["referencia"]);
                                    $InvoiceModel->SetIntentos(0);
                                    $ResultInovice = $InvoiceModel->create();
                                    if (!$ResultInovice['error']) {
                                        unset($InvoiceModel);
                                        unset($ResultInovice);
                                    } else {
                                        throw new Exception("No se pudo guardar la información acerca de tu pedido Ecommerce, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                                    }
                                }
                                unset($ClienteModel);
                                unset($ClienteExiste);
                                unset($PedidoModel);
                                unset($PedidoExiste);
                            } else {
                                throw new Exception("No se pudo guardar la información acerca de tu pedido, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                            }
                            $_SESSION["Ecommerce-OpenPay-3DSecure-Id"] = $ResultCharge->id;
                            $Result = [
                                "completed" => false,
                                "status" => $ResultCharge->status,
                                "openpay" => [
                                    "url" => $ResultCharge->payment_method->url
                                ]
                            ];
                            return $Result;
                        } else {
                            throw new Exception("No se pudo generar tu pago de forma correcta, por favor contacta a tu ejecutivo!");
                        }
                        return $ResultCharge;
                    } else {
                        unset($ClienteModel);
                        unset($ClienteExiste);
                        unset($PedidoModel);
                        unset($PedidoExiste);
                        throw new Exception("No se encuentra información acerca del pedido!");
                    }
                } else {
                    unset($ClienteModel);
                    unset($ClienteExiste);
                    throw new Exception("No se encuentra información acerca del cliente!");
                }
            } else {
                throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos");
            }
        } catch (OpenpayApiTransactionError $e) {
            if ($this->openPayExeption($e, "ERROR en la transacción2:")) {
                throw new Exception("ERROR en la transacción2:");
            }
            throw new Exception("ERROR en la transacción: No se guardo Log");
        } catch (OpenpayApiRequestError $e) {
            if ($this->openPayExeption($e, "ERROR en la petición:2")) {
                throw new Exception("ERROR en la petición:2");
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

    public function Pago3DSecureSuccess()
    {
        try {
            if (!$this->Connection->conexion()->connect_error) {
                # cliente
                $ClienteModel = new Cliente();
                $ClienteModel->SetParameters($this->Connection, $this->Tool);
                $ClienteExiste = $ClienteModel->GetBy("where id_cliente = '" . $_SESSION['Ecommerce-ClienteKey'] . "' ");
                # valiaion si existe información acerca del cliente solicitado
                if ($ClienteExiste) {
                    # Pedido
                    $PedidoModel = new Pedido_();
                    $PedidoModel->SetParameters($this->Connection,  $this->Tool);
                    $PedidoExiste = $PedidoModel->GetBy("where id = '" . $_SESSION['Ecommerce-PedidoKey'] . "' ");
                    # guardar información relevante al pedido
                    $PedidoModel->SetEstatus('P');
                    $ResultPedido = $PedidoModel->Update3DSecure();
                    if (!$ResultPedido['error']) {
                        $_SESSION['Ecommerce-PedidoTotal'] = 0;
                        unset($_SESSION['Ecommerce-PedidoKey']);
                    } else {
                        throw new Exception("No se pudo guardar la información acerca de tu pedido, por favor recarga la pagina. Si el problema persiste por favor de contactar con su ejecutivo!");
                    }

                    unset($ClienteModel);
                    unset($ClienteExiste);
                    unset($PedidoModel);
                    unset($PedidoExiste);
                    return $ResultPedido;
                } else {
                    unset($ClienteModel);
                    unset($ClienteExiste);
                    throw new Exception("No se encuentra información acerca del cliente!");
                }
            } else {
                throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function openPayExeption($exeption, $message)
    {
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
            } else {
                throw new Exception("No hay datos maestros por favor contacta con tu ejecutivo!", 1);
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function validaciones()
    {
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
