<?php
class Cliente{
    public $ClienteKey;
    public $Nombre;
    public $Apellidos;
    public $Telefono;
    public $Email;
    public $Password;
    public $FechaIngreso;
    public $LastLogin;
    public $Activo;
    public $Tipo;
    public $CardCode;
    public $Sociedad;
    public $PasswordB2b;
    public $Ingreso;
    public $Descuento;
    public $EmailEjecutivo;
    public $DiasCredito;

    protected $Connection;
    protected $Tool;

    public function SetParameters($conn, $Tool){
        $this->Connection = $conn;
        $this->Tool = $Tool;
    }public function SetClienteKey($ClienteKey){
        if (!is_numeric($ClienteKey)) {
            throw new Exception('$ClienteKey debería de ser int');
        }
        $this->ClienteKey = $ClienteKey;
    }public function SetNombre($Nombre){
        if (empty($Nombre)) {
            throw new Exception('Nombre es requerido');
        }
        $this->Nombre = $Nombre;
    }public function SetApellidos($Apellidos){
        if (empty($Apellidos)) {
            throw new Exception('Apellidos es requerido');
        }
        $this->Apellidos = $Apellidos;
    }public function SetTelefono($Telefono){
        $this->Telefono = $Telefono;
    }public function SetEmail($Email){
        $this->Email = $Email;
    }public function SetPassword($Password){
        $this->Password = $Password;
    }public function SetPasswordB2b($PasswordB2b){
        $this->PasswordB2b = $PasswordB2b;
    }public function SetFechaIngreso($FechaIngreso){
        if (!is_string($FechaIngreso)) {
            throw new Exception('$FechaIngreso debería de ser int');
        }
        $this->FechaIngreso = $FechaIngreso;
    }public function SetActivo($Activo){
        $this->Activo = $Activo;
    }public function SetTipo($Tipo){
        $this->Tipo = $Tipo;
    }public function SetIngreso($Ingreso){
        $this->Ingreso = $Ingreso;
    }

    public function GetClienteKey(){
        return $this->ClienteKey;
    }public function GetNombre(){
        return $this->Nombre;
    }public function GetApellidos(){
        return $this->Apellidos;
    }public function GetTelefono(){
        return $this->Telefono;
    }public function GetEmail(){
        return $this->Email;
    }public function GetPassword(){
        return $this->Password;
    }public function GetFechaIngreso(){
        return $this->FechaIngreso;
    }public function GetLastLogin(){
        return $this->LastLogin;
    }public function GetActivo(){
        return $this->Activo;
    }public function GetTipo(){
        return $this->Tipo;
    }public function GetCardCode(){
        return $this->CardCode;
    }public function GetSociedad(){
        return $this->Sociedad;
    }public function GetPasswordB2b(){
        return $this->PasswordB2b;
    }public function GetIngreso(){
        return $this->Ingreso;
    }public function GetDescuento(){
        return $this->Descuento;
    }public function GetEmailEjecutivo(){
        return $this->EmailEjecutivo;
    }public function GetDiasCredito(){
        return $this->DiasCredito;
    }

    public function GetBy($filter){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_cliente_data ".$filter." ";
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->ClienteKey     =   $row->id_cliente;
          $this->Nombre         =   $row->nombre;
          $this->Apellidos      =   $row->apellidos;
          $this->Telefono       =   $row->telefono;
          $this->Email          =   $row->email;
          $this->Password       =   $row->password;
          $this->FechaIngreso   =   $row->fecha_registro;
          $this->Tipo           =   $row->tipo_cliente;
          $this->Ingreso        =   $row->ingreso;
          $this->EmailEjecutivo =   $row->email_ejecutivo;
          $this->Descuento      =   $row->descuento;
          $this->DiasCredito      =   $row->dias_credito;

          # si el cliente es un usuario B2B
          if ($this->Tipo == 'B2B') {
              $this->CardCode      =   $row->cardcode_b2b;
              $this->Sociedad      =   $row->sociedad_b2b;
              $this->PasswordB2b   =   $row->pass_b2b;
          }else{
              $this->CardCode      =   $row->cardcode_b2c;
              $this->Sociedad      =   $row->sociedad_b2c;
              $this->PasswordB2b   =   $row->password_b2c;
          }

          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM login_cliente ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
            $Cliente = new Cliente();
            $Cliente->ClienteKey    =   $row->id_cliente;
            $Cliente->Nombre        =   $row->nombre;
            $Cliente->Apellidos     =   $row->apellidos;
            $Cliente->Telefono      =   $row->telefono;
            $Cliente->Email         =   $row->email;
            $Cliente->Password      =   $row->password;
            $Cliente->FechaIngreso  =   $row->fecha_registro;
            $Cliente->Tipo          =   $row->tipo_cliente;
            $Cliente->CardCode      =   $row->cardcode;
            $Cliente->Sociedad      =   $row->sociedad;
            $Cliente->PasswordB2b   =   $row->pass_b2b;
            $Cliente->Ingreso       =   $row->ingreso;
            $data[] = $Cliente;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function create(){
        try {
            $result = $this->Connection->Exec_store_procedure_json("CALL ClienteRegistro(
                ".$this->ClienteKey.",
                '".$this->Nombre."',
                '".$this->Apellidos."',
                '".$this->Telefono."',
                '".$this->Email."',
                '".$this->Password."',
                '".$this->PasswordB2b."',
                '".$this->Activo."',
                '".$this->Tipo."',
                ".$this->Ingreso.",
                @Result);", "@Result");
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
    */
    public function ClienteB2BCambiarPassword(){
        try {
            $result = $this->Connection->Exec_store_procedure_json("CALL passwordRecovery(
                ".$_SESSION['Ecommerce-ClienteKey'].",
                '".$this->Password."',
                '".$this->PasswordB2b."',
                @Result)", "@Result");
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function ChangePassword(){
        try {
            $result = $this->Connection->Exec_store_procedure_json("CALL ChangePass(
                ".$this->ClienteKey.",
                '".$this->Password."',
                @Result)", "@Result");
            return $result;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function DiaFavoritoCompra($filter, $order){
        try {
            $SQLSTATEMENT = "SET lc_time_names = 'es_MX';";
            $resul = $this->Connection->QueryReturn($SQLSTATEMENT);

            $SQLSTATEMENT_ = "SELECT 
                                DATE_FORMAT(fecha,'%W') AS dia, 
                                COUNT(DATE_FORMAT(fecha,'%W')) AS total 
                              FROM listar_pedido_b2c ".$filter." ".$order;
            // echo $SQLSTATEMENT;
            $result = $this->Connection->QueryReturn($SQLSTATEMENT_);
            $data = [];
  
            while ($row = $result->fetch_object()) {
                $Obj = new stdClass();
                $Obj->Dia   =   $row->dia;
                $Obj->Total =   $row->total;
                $data[] = $Obj;
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function GetMonto($filter, $order){
        try {
            $SQLSTATEMENT_ = "SELECT SUM(total) as total FROM listar_pedido_b2c ".$filter." ".$order;
            // echo $SQLSTATEMENT;
            $result = $this->Connection->QueryReturn($SQLSTATEMENT_);
            $data = [];
  
            while ($row = $result->fetch_object()) {
                $Obj = new stdClass();
                $Obj->Total =   $row->total;
                $data[] = $Obj;
            }
            return $data;
        } catch (Exception $e) {
            throw $e;
        }
    }
}