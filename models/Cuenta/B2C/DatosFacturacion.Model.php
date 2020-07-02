<?php 

  class DatosFacturacion{
    protected $conn;
    protected $Tool;

    public $DatosFacturacionKey;
    public $ClienteKey; 
    public $RazonSocial;
    public $Tipo;
    public $RFC;
    public $Calle;
    public $NumeroExterior;
    public $NumeroInterior;
    public $CodigoPostal;
    public $Estado;
    public $Ciudad;
    public $Delegacion;
    public $Colonia;
    public $Activo;

    public function Parameters(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function SetParameters($conn, $Tool){
      $this->conn = $conn;
      $this->Tool = $Tool;
    }

    public function SetDatosFacturacionKey($DatosFacturacionKey){
      if(!is_numeric($DatosFacturacionKey) || is_null($DatosFacturacionKey)){
        throw new Exception('$DatosFacturacionKey debería de ser numero');
      }
      $this->DatosFacturacionKey = $DatosFacturacionKey;
    }

    public function SetRazonSocial($RazonSocial){
      if(is_null($RazonSocial)){
        throw new Exception('$RazonSocial debería de ser alfanumerico');
      }
      $this->RazonSocial = $RazonSocial;
    }

    public function SetTipo($Tipo){
      if(is_null($Tipo)){
        throw new Exception('$Tipo debería de ser alfanumerico');
      }
      $this->Tipo = $Tipo;
    }

    public function SetRFC($RFC){
      if(is_null($RFC)){
        throw new Exception('$RFC debería de ser numero');
      }
      $this->RFC = $RFC;
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

    public function SetCiudad($Ciudad){
      if(!is_string($Ciudad) || is_null($Ciudad)){
        throw new Exception('$Ciudad debería de ser alfanumerico');
      }
      $this->Ciudad = $Ciudad;
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

    public function SetActivo($Activo){
      if(!is_numeric($Activo) || is_null($Activo)){
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

    public function GetDatosFacturacionKey(){
      return $this->DatosFacturacionKey;
    }public function GetRazonSocial(){
      return $this->RazonSocial;
    }public function GetTipo(){
      return $this->Tipo;
    }public function GetRFC(){
      return $this->RFC;
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
    }public function GetCiudad(){
      return $this->Ciudad;
    }public function GetDelegacion(){
      return $this->Delegacion;
    }public function GetColonia(){
      return $this->Colonia;
    }public function GetActivo(){
      return $this->Activo;
    }public function GetClienteKey(){
      return $this->ClienteKey;
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
        $SQLSTATEMENT = "SELECT * FROM datos_facturacion ".$filter." ".$orderBy;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $data = [];
        while ($row = $result->fetch_object()) {
          $DatosFacturacion = new DatosFacturacion();
          $DatosFacturacion->DatosFacturacionKey  = $row->id;  
          $DatosFacturacion->ClienteKey           = $row->id_cliente;  
          $DatosFacturacion->RazonSocial          = $row->razon_social;  
          $DatosFacturacion->Tipo                 = $row->tipo_facturacion;  
          $DatosFacturacion->RFC                  = $row->rfc;  
          $DatosFacturacion->Calle                = $row->calle;  
          $DatosFacturacion->NumeroExterior       = $row->n_ext;  
          $DatosFacturacion->NumeroInterior       = $row->n_int;  
          $DatosFacturacion->CodigoPostal         = $row->cp;  
          $DatosFacturacion->Estado               = $row->estado;  
          $DatosFacturacion->Ciudad               = $row->ciudad;  
          $DatosFacturacion->Delegacion           = $row->delegacion;  
          $DatosFacturacion->Colonia              = $row->colonia;  
          $DatosFacturacion->Activo               = $row->activo;
          $data[] = $DatosFacturacion;
        }
        unset($DatosFacturacion);  
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
    public function GetBy($filter){
      try {
        $this->Parameters();
        $data = false;
        if (!$this->conn->conexion()->connect_error) {
          $SQLSTATEMENT = "SELECT * FROM datos_facturacion ".$filter." ";
          $result = $this->conn->QueryReturn($SQLSTATEMENT);
          $data = false;
          while ($row = $result->fetch_object()) {
            $this->DatosFacturacionKey  = $row->id;  
            $this->ClienteKey           = $row->id_cliente;  
            $this->RazonSocial          = $row->razon_social;  
            $this->Tipo                 = $row->tipo_facturacion;  
            $this->RFC                  = $row->rfc;  
            $this->Calle                = $row->calle;  
            $this->NumeroExterior       = $row->n_ext;  
            $this->NumeroInterior       = $row->n_int;  
            $this->CodigoPostal         = $row->cp;  
            $this->Estado               = $row->estado;  
            $this->Ciudad               = $row->ciudad;  
            $this->Delegacion           = $row->delegacion;  
            $this->Colonia              = $row->colonia;  
            $this->Activo               = $row->activo;
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
    public function create(){
      try {
        $result = $this->conn->Exec_store_procedure_json("CALL ClienteDatosFacturacion(
          ".$this->DatosFacturacionKey.",
          ".$this->ClienteKey.",
          '".$this->RazonSocial."',
          '".$this->Tipo."',
          '".$this->RFC."',
          '".$this->Calle."',
          '".$this->NumeroExterior."',
          '".$this->NumeroInterior."',
          '".$this->CodigoPostal."',
          '".$this->Estado."',
          '".$this->Ciudad."',
          '".$this->Delegacion."',
          '".$this->Colonia."',
          '".$this->Activo."',
        @Result)", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }

 ?>