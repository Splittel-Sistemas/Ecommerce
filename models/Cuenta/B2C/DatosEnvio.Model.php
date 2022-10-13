<?php

  class DatosEnvio{
    protected $conn;
    protected $Tool;

    public $DatosEnvioKey;
    public $Nombre;
    public $Apellido;
    public $Celular;
    public $Telefono;
    public $Calle;
    public $NumeroExterior;
    public $NumeroInterior;
    public $CodigoPostal;
    public $Estado;
    public $Municipio;
    public $Delegacion;
    public $Colonia;
    public $Referencia;
    public $Activo;
    public $ClienteKey;
    public $email_ejecutivo;

    public function SetParameters($conn, $Tool){
      $this->conn = $conn;
      $this->Tool = $Tool;
    }

    public function Parameters(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function SetDatosEnvioKey($DatosEnvioKey){
      if(!is_numeric($DatosEnvioKey) || is_null($DatosEnvioKey)){
        throw new Exception('$DatosEnvioKey debería de ser numero');
      }
      $this->DatosEnvioKey = $DatosEnvioKey;
    }

    public function SetNombre($Nombre){
      if(!is_string($Nombre) || is_null($Nombre)){
        throw new Exception('$Nombre debería de ser alfanumerico');
      }
      $this->Nombre = $Nombre;
    }

    public function SetApellido($Apellido){
      if(!is_string($Apellido) || is_null($Apellido)){
        throw new Exception('$Apellido debería de ser alfanumerico');
      }
      $this->Apellido = $Apellido;
    }

    public function SetCelular($Celular){
      if(!is_numeric($Celular) || is_null($Celular)){
        throw new Exception('$Celular debería de ser numero');
      }
      $this->Celular = $Celular;
    }

    public function SetTelefono($Telefono){
      if(!is_numeric($Telefono) || is_null($Telefono)){
        throw new Exception('$Telefono debería de ser numero');
      }
      $this->Telefono = $Telefono;
    }

    public function SetCalle($Calle){
      if(!is_string($Calle) || is_null($Calle)){
        throw new Exception('$Calle debería de ser alfanumerico');
      }
      $this->Calle = $Calle;
    }

    public function SetNumeroExterior($NumeroExterior){
      if(!is_string($NumeroExterior) || is_null($NumeroExterior)){
        throw new Exception('$NumeroExterior debería de ser alfanumerico');
      }
      $this->NumeroExterior = $NumeroExterior;
    }

    public function SetNumeroInterior($NumeroInterior){
      if(!is_string($NumeroInterior) || is_null($NumeroInterior)){
        throw new Exception('$NumeroInterior debería de ser alfanumerico');
      }
      $this->NumeroInterior = $NumeroInterior;
    }

    public function SetCodigoPostal($CodigoPostal){
      if(!is_numeric($CodigoPostal) || is_null($CodigoPostal)){
        throw new Exception('$CodigoPostal debería de ser numero');
      }
      $this->CodigoPostal = $CodigoPostal;
    }

    public function SetEstado($Estado){
      if(!is_string($Estado) || is_null($Estado)){
        throw new Exception('$Estado debería de ser alfanumerico');
      }
      $this->Estado = $Estado;
    }

    public function SetMunicipio($Municipio){
      if(!is_string($Municipio) || is_null($Municipio)){
        throw new Exception('$Municipio debería de ser alfanumerico');
      }
      $this->Municipio = $Municipio;
    }

    public function SetDelegacion($Delegacion){
      if(!is_string($Delegacion) || is_null($Delegacion)){
        throw new Exception('$Delegacion debería de ser alfanumerico');
      }
      $this->Delegacion = $Delegacion;
    }

    public function SetColonia($Colonia){
      if(!is_string($Colonia) || is_null($Colonia)){
        throw new Exception('$Colonia debería de ser alfanumerico');
      }
      $this->Colonia = $Colonia;
    }

    public function SetReferencia($Referencia){
      if(!is_string($Referencia) || is_null($Referencia)){
        throw new Exception('$Referencia debería de ser alfanumerico');
      }
      $this->Referencia = $Referencia;
    }

    public function SetActivo($Activo){
      if(is_null($Activo)){
        throw new Exception('$Activo debería de ser numero');
      }
      $this->Activo = $Activo;
    }

    public function SetClienteKey($ClienteKey){
      if(!is_numeric($ClienteKey) || is_null($ClienteKey)){
        throw new Exception('$ClienteKey debería de ser numero');
      }
      $this->ClienteKey = $ClienteKey;
    }

    public function GetDatosEnvioKey(){
      return $this->DatosEnvioKey; 
    }public function GetClienteKey(){
      return $this->ClienteKey; 
    }public function GetNombre(){
      return $this->Nombre; 
    }public function GetApellido(){
      return $this->Apellido; 
    }public function GetCelular(){
      return $this->Celular; 
    }public function GetTelefono(){
      return $this->Telefono; 
    }public function GetCalle(){
      return $this->Calle; 
    }public function GetNumeroExterior(){
      return $this->NumeroExterior; 
    }public function GetNumeroInterior(){
      return $this->NumeroInterior; 
    }public function GetCodigoPostal(){
      return $this->CodigoPostal; 
    }public function GetEstado(){
      return $this->Estado; 
    }public function GetMunicipio(){
      return $this->Municipio; 
    }public function GetDelegacion(){
      return $this->Delegacion; 
    }public function GetColonia(){
      return $this->Colonia; 
    }public function GetReferencia(){
      return $this->Referencia; 
    }public function GetActivo(){
      return $this->Activo; 
    }public function Getemail_ejecutivo(){
      return $this->email_ejecutivo; 
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function GetBy($filter){
      try {
        $this->Parameters();
        $data = false;
        if (!$this->conn->conexion()->connect_error) {
          $SQLSTATEMENT = "SELECT * FROM datos_envio ".$filter." ";
          // echo $SQLSTATEMENT;
          $result = $this->conn->QueryReturn($SQLSTATEMENT);
          while ($row = $result->fetch_object()) {
            $this->DatosEnvioKey  = $row->id;  
            $this->ClienteKey     = $row->id_cliente;  
            $this->Nombre         = $row->nombre;  
            $this->Apellido       = $row->apellido;  
            $this->Celular        = $row->celular;  
            $this->Telefono       = $row->telefono;  
            $this->Calle          = $row->calle;  
            $this->NumeroExterior = $row->n_ext;  
            $this->NumeroInterior = $row->n_int;  
            $this->CodigoPostal   = $row->cp;  
            $this->Estado         = $row->estado;  
            $this->Municipio      = $row->ciudad;  
            $this->Delegacion     = $row->delegacion;  
            $this->Colonia        = $row->colonia;  
            $this->Referencia     = $row->referencia;
            $this->Activo         = $row->activo;
            $data = true;
          }
        }
          return $data;
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
    public function Get($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM datos_envio ".$filter." ".$orderBy;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $data = [];
        while ($row = $result->fetch_object()) {
          $DatosEnvio = new DatosEnvio();
          $DatosEnvio->DatosEnvioKey  = $row->id;  
          $DatosEnvio->ClienteKey     = $row->id_cliente;  
          $DatosEnvio->Nombre         = $row->nombre;  
          $DatosEnvio->Apellido       = $row->apellido;  
          $DatosEnvio->Celular        = $row->celular;  
          $DatosEnvio->Telefono       = $row->telefono;  
          $DatosEnvio->Calle          = $row->calle;  
          $DatosEnvio->NumeroExterior = $row->n_ext;  
          $DatosEnvio->NumeroInterior = $row->n_int;  
          $DatosEnvio->CodigoPostal   = $row->cp;  
          $DatosEnvio->Estado         = $row->estado;  
          $DatosEnvio->Municipio      = $row->ciudad;  
          $DatosEnvio->Delegacion     = $row->delegacion;  
          $DatosEnvio->Colonia        = $row->colonia;  
          $DatosEnvio->Referencia     = $row->referencia;
          $DatosEnvio->Activo         = $row->activo;
          $data[] = $DatosEnvio;
        }
        unset($DatosEnvio);  
        return $data;
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
    
    
     public function GetCliente($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM login_cliente ".$filter." ".$orderBy;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $data = [];
        while ($row = $result->fetch_object()) {
          $DatosEnvio = new DatosEnvio();
          $DatosEnvio->email_ejecutivo  = $row->email_ejecutivo;  
          $data[] = $DatosEnvio;
        }
        unset($DatosEnvio);  
        return $data;
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
    public function create(){
      try {
        $result = $this->conn->Exec_store_procedure_json("CALL ClienteDatosEnvio(
          ".$this->DatosEnvioKey.",
          '".$this->Nombre."',
          '".$this->Apellido."',
          '".$this->Celular."',
          '".$this->Telefono."',
          '".$this->Calle."',
          '".$this->NumeroExterior."',
          '".$this->NumeroInterior."',
          '".$this->CodigoPostal."',
          '".$this->Estado."',
          '".$this->Municipio."',
          '".$this->Delegacion."',
          '".$this->Colonia."',
          '".$this->Referencia."',
          '".$this->Activo."',
          ".$this->ClienteKey.",
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }

 ?>