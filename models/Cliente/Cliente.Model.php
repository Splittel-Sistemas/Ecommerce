<?php
class Cliente{
    public $ClienteKey;
    public $Nombre;
    public $Apellidos;
    public $Telefono;
    public $Email;
    private $ConfirmPassword;
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
    public $Redondeo;
    public $Segmento;
    public $Hash;

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
    }public function SetConfirmPassword($ConfirmPassword){
        $this->ConfirmPassword = $ConfirmPassword;
    }public function SetCardCode($CardCode){
        $this->CardCode = $CardCode;
    }public function SetSociedad($Sociedad){
        $this->Sociedad = $Sociedad;
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
    public function SetSegmento($Segmento){
        $this->Segmento = $Segmento;
    }
    public function SetHash($Hash){
        $this->Hash = $Hash;
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
    }public function GetRedondeo(){
        return $this->Redondeo;
    }
    public function GetSegmento(){
        return $this->Segmento;
    }
    public function GetHash(){
        return $this->Hash;
    }

    public function GetByRecoveryPass($email){
        try {
        $SQLSTATEMENT = "SELECT t1.id_cliente, t1.email, t1.cardcode, t0.pass,t0.fecha FROM t88 AS t0
                            INNER JOIN login_cliente t1 ON t0.email = t1.email
                            WHERE t0.email = '".$email."' 
                                    AND t0.fecha >= DATE_SUB(NOW(), INTERVAL 23 HOUR)
                                    AND t1.activo='si'
                            ORDER BY fecha DESC
                            LIMIT 1";
        //echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        if ($row = $result->fetch_object()) {
            $Cliente = new Cliente();
            $Cliente->ClienteKey    =   $row->id_cliente;
            $Cliente->Email         =   $row->email;
            $Cliente->Hash          =   $row->pass;
            $data[] = $Cliente;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }

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
          $this->Redondeo      =   $row->redondear;
          $this->Segmento      =   $row->segmento;

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

    public function createb2b(){
        try {
            $result = $this->Connection->Exec_store_procedure_json("CALL ClienteB2BRegistro(
                ".$this->ClienteKey.",
                '".$this->Nombre."',
                '".$this->Apellidos."',
                '".$this->Telefono."',
                '".$this->Email."',
                '".$this->Password."',
                '".$this->ConfirmPassword."',
                '".$this->CardCode."',
                '".$this->Sociedad."',
                '".$this->PasswordB2b."',
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