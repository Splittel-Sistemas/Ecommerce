<?php  
    @session_start();
    if (!class_exists("Connection")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
    }if (!class_exists("Functions_tools")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
    }
    class Detalle
    {
        // private $conn;
        // // 
        // private $Tool;
        private $idCotizacion;
        private $codigo;
        private $cantidad;
        private $descuento;
        private $subTotal;
        private $iva;
        private $total;
        private $aactivo;
        private $fechaRegistro;

        // public function __construct($Conn){
        //     $this->$conn = $Conn;
        // }
        
    }
    class Pedido
    {
        protected  $conn;
        // 
        protected  $Tool;
        // 
        public $cliente;
        // 
        public $subTotal;
        // 
        public $iva;
        // 
        public $total;
        // 
        public $envio;
        // 
        public $envioIva;
        // 
        // visualisar si el cliente pueda verla
        public $Activo;
        // 
        // 
        public $estatus;
        // 
        public $metodoPago;
        // 
        public $monedaPago;
        // 
        public $datosEnvio;
        // 
        public $datosFacturacion;
        // 
        public $numeroGuia;
        // 
        public $paqueteria;
        // 
        public $tipoCambio;
        // 
        public $DiasExtraCredito;
        // 
        public $CFDI;
        // 
        public $descuento;
        public $DocumentLines;
        // 
        public function __construct(){
            
        }
        public function ConnectDB(){
            try {
                $this->conn = new Connection();
                if (!$this->conn->conexion()->connect_error) {
                    return true;
                }else{
                    return false;
                }
            } catch (Exception $e) {
                throw $e;
            }
        }
        public function getEncabezado($id){
            try {
                $SQLSTATEMENT = "SELECT * FROM cotizacion_encabezado where id = '".$id."' ";
                $result = $this->conn->QueryReturn($SQLSTATEMENT);
                while ($row = $result->fetch_object()) {
                    $this->cliente = $row->id_cliente;
                    $this->subTotal = $row->subtotal;
                    $this->iva = $row->iva;
                    $this->total = $row->total;
                    $this->envio = $row->envio;
                    $this->envioIva = $row->envio_iva;
                    $this->fecha = $row->fecha;
                    $this->Activo = $row->activo;
                    $this->estatus = $row->estatus;
                    $this->metodoPago = $row->metodo_pago;
                    $this->monedaPago = $row->moneda_pago;
                    $this->datosEnvio = $row->datos_envio;
                    $this->datosFacturacion = $row->datos_facturacion;
                    $this->numeroGuia = $row->numero_guia;
                    $this->paqueteria = $row->paqueteria;
                    $this->tipoCambio = $row->tipoCambio;
                    $this->DiasExtraCredito = $row->DiasExtraCredito;
                    $this->CFDI = $row->CFDIUser;
                    $this->descuento = $row->descuento;
                }
                // return $items[];
            } catch (Exception $e) {
                throw $e;
            }
        }
    }

    $Pedido = new Pedido();
    if($Pedido->ConnectDB()){
        $pedido_data = $Pedido->getEncabezado(517);
        print_r($Pedido);
    }else{
        echo "sin connecion a base de datos";
    }



?>