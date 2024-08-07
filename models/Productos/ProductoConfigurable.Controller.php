<?php
@session_start();
if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists('ProductoConfigurable')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Productos/ProductoConfigurable.Model.php';
}

class ProductoConfigurableController{
    private $Connection;
    private $Tool;
    private $PedidoModel;

    public function __construct(){
        $this->Connection    = new Connection();
        $this->Tool          = new Functions_tools();
    }
    
    public function AgregarNombreProductoConfigurable(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $ProductoConfigurableModel  = new ProductoConfigurable();
                $ProductoConfigurableModel->SetParameters($this->Connection, $this->Tool);
                $ProductoConfigurableModel->SetCodigo($_POST['Codigo']);
                $ProductoConfigurableModel->SetCodigoConfigurable($_POST['CodigoConfigurable']);
                $ProductoConfigurableModel->SetDescripcion($_POST['Descripcion']);
                return $ProductoConfigurableModel->Add();
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function GetFichaTecnica(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $ProductoConfigurableModel  = new ProductoConfigurable();
                $ProductoConfigurableModel->SetParameters($this->Connection, $this->Tool);
                $ProductoConfigurableModel->SetCodigo($_POST['CodigoFicha']);
                return $ProductoConfigurableModel->GetFicha();
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function GetCertificado(){
        try {
            if (!$this->Connection->conexion()->connect_error) {
                $ProductoConfigurableModel  = new ProductoConfigurable();
                $ProductoConfigurableModel->SetParameters($this->Connection, $this->Tool);
                return $ProductoConfigurableModel->ExistCert($_POST['CodigoFicha']);
            }else{
                throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

}
