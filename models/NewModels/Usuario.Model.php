<?php
    NameSpace Models;
    class Usuario 
    {
        public $id_cliente;
        public $Nombre;
        public $Apellidos;
        public $Telefono;
        public $Email;
        public $tipoCliente;
        public $TotaCoti;
        public $CardCode;

        protected $Connection;
        
        public function __construct()
        {
      
        }
        public function SetParameters($conn)
        {
            $this->Connection = $conn;
        }

        public function Get_bp_cotizaciones($DocStatus,$Date1, $Date2)
        {
            try {
                $SQLSTATEMENT = "call Email_lastQuoatations('".$Date1." 00:00:00','".$Date2." 23:59:59','2',0)";
                // echo $SQLSTATEMENT;
                $result = $this->Connection->QueryReturn($SQLSTATEMENT);
                $data = array();
                while ($row = $result->fetch_object()) {
                    $Usuario = new Usuario();
                    $Usuario->id_cliente = $row->id_cliente;
                    $Usuario->Nombre = $row->nombre;
                    $Usuario->Apellidos = $row->apellidos;
                    $Usuario->Telefono = $row->telefono;
                    $Usuario->Email = $row->email;
                    $Usuario->tipoCliente = $row->tipo_cliente;
                    $Usuario->TotaCoti = $row->TotaCoti;
                    $Usuario->CardCode = $row->cardcode;
                    $data[] = $Usuario;
                    unset($Usuario);
                }
                // mysql_free_result($result);
                $result->free();
                return $data;
            } catch (\Exception $e) {
                throw $e;
            }
        }

    }
?>