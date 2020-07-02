<?php

@session_start();
if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Connection.php';
}if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
}if (!class_exists('CodigoVerificacion')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tokens/CodigoVerificacion.Model.php';
}
class CodigoVerificacionController{
    protected $Connection;
    protected $Tool;

    public function __construct(){
        $this->Connection = new Connection();
        $this->Tool = new Functions_tools();
    }

    public function GetBy($pedidokey){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $CodigoVerificacionModel = new CodigoVerificacion();
                $CodigoVerificacionModel->SetParameters($this->Connection, $this->Tool);
                $CodigoVerificacionModel->GetBy("WHERE pedidokey = ".$pedidokey." ");
                return $CodigoVerificacionModel;
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    } 

    public function CodigoVerificacion(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $CodigoVerificacionModel = new CodigoVerificacion();
                $CodigoVerificacionModel->SetParameters($this->Connection, $this->Tool);
                $CodigoVerificacionModel->SetCodigo($this->generar_token_seguro(rand(20, 44)));
                $CodigoVerificacionModel->SetPedidoKey($_SESSION['Ecommerce-PedidoKey']);
                $ResultCodigoVerificacion = $CodigoVerificacionModel->create();
                if(!$ResultCodigoVerificacion['error']){
                    if (!class_exists("Email")) {
                        include $_SERVER["DOCUMENT_ROOT"].'/store/models/Email/Email.php';
                    }if (!class_exists("TemplateCodigoVerificacion")) {
                        include $_SERVER["DOCUMENT_ROOT"].'/store/views/Templates/Email/CodigoVerificacion.php';
                    }
                    
                    $Email = new Email();
                    $TemplateCodigoVerificacion = new TemplateCodigoVerificacion();
                    $Email->MailerSubject = utf8_decode("Codigo verificación");
                    $Email->MailerBody = $TemplateCodigoVerificacion->body($_SESSION['Ecommerce-PedidoKey']);
                    $Email->MailerListTo[] = $_SESSION['Ecommerce-ClienteEmail'];
                    $Email->EmailSendEmail();
                    unset($Email);
                    unset($TemplateCodigoVerificacion);
                }
                unset($CodigoVerificacionModel);
                return $ResultCodigoVerificacion;
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    } 

    public function VerificarCodigo(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $CodigoVerificacionModel = new CodigoVerificacion();
                $CodigoVerificacionModel->SetParameters($this->Connection, $this->Tool);
                $CodigoVerificacionModel->SetCodigo($_POST['Codigo']);
                $CodigoVerificacionModel->SetPedidoKey($_SESSION['Ecommerce-PedidoKey']);
                $ResultCodigoVerificacion = $CodigoVerificacionModel->update();
                unset($CodigoVerificacionModel);
                return $ResultCodigoVerificacion;
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    } 

    public function generar_token_seguro($longitud){
        if ($longitud < 4) {
            $longitud = 4;
        }
        return bin2hex(openssl_random_pseudo_bytes(($longitud - ($longitud % 2)) / 2));
    }
}