<?php
    NameSpace Models;
    class Detalle
    {
        public $ItemCode;
        public $Description;
        public $Quantity;
        public $Total;
        public $IdCotizacion;
        public $Fecha;
        public $EmailEjecutivo;

        protected $Connection;
        
        public function __construct()
        {
      
        }
        public function SetParameters($conn)
        {
            $this->Connection = $conn;
        }

        public function Get_bp_cotizaciones($DocStatus,$Date1,$Date2,$id_cliente)
        {
            try {
                $SQLSTATEMENT = "call Email_lastQuoatations('".$Date1." 00:00:00','".$Date2." 23:59:59','1','".$id_cliente."')";
                // echo $SQLSTATEMENT;
                $result = $this->Connection->QueryReturn($SQLSTATEMENT);
				// print_r($result);
                $data = array();
                while ($row = $result->fetch_object()) {
                    $Detalle = new Detalle();
                    $Detalle->ItemCode = $row->codigo;
                    $Detalle->Description = $row->desc_producto;
                    $Detalle->Quantity = $row->quantity;
                    $Detalle->Total = $row->total;
                    $Detalle->IdCotizacion = $row->id_cotizacion;
                    $Detalle->Fecha = $row->fecha;
                    $Detalle->EmailEjecutivo = $row->email_ejecutivo;
                    $data[] = $Detalle;
                    unset($Detalle);
                }
                return $data;
            } catch (Exception $e) {
                throw $e;
            }
        }
    }
    

?>