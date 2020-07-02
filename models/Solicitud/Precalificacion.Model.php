<?php
  class Precalificacion{

    protected $Connection;
    protected $Tool;
    
    public $Terminos;
    public $Key;
    public $NombreFacturacion;
    public $RFC;
    public $NombreComercial;
    public $DireccionFacturacion;
    public $CodigoPostal;
    public $Correo;
    public $Contacto;
    public $TelefonoOficina;
    public $TelefonoMovil;
    public $PaginaWeb;
    public $DireccionOficina;
    public $GiroEmpresa;
    public $Presencia;
    public $NumeroEmpleados;
    public $ExperienciaMercado;
    public $Proyectos;
    public $SituacionFiscalKey;

    public function SetKey($Key){
      $this->Key = $Key;
    }public function SetTerminos($Terminos){
      $this->Terminos = $Terminos;
    }public function SetNombreFacturacion($NombreFacturacion){
      if(empty($NombreFacturacion)){
        throw new Exception("Nombre de facturación es requerido");
      }
      $this->NombreFacturacion = $NombreFacturacion;
    }public function SetRFC($RFC){
      if(empty($RFC)){
        throw new Exception("RFC es requerido");
      }
      $this->RFC = $RFC;
    }public function SetNombreComercial($NombreComercial){
      $this->NombreComercial = $NombreComercial;
    }public function SetDireccionFacturacion($DireccionFacturacion){
      if(empty($DireccionFacturacion)){
        throw new Exception("Dirección Facturación es requerido");
      }
      $this->DireccionFacturacion = $DireccionFacturacion;
    }public function SetCodigoPostal($CodigoPostal){
      if(empty($CodigoPostal)){
        throw new Exception("Código Postal de Facturación es requerido");
      }
      $this->CodigoPostal = $CodigoPostal;
    }public function SetCorreo($Correo){
      if(empty($Correo)){
        throw new Exception("Correo es requerido");
      }
      $this->Correo = $Correo;
    }public function SetContacto($Contacto){
      if(empty($Contacto)){
        throw new Exception("Nombre del contacto, título y departamento es requerido");
      }
      $this->Contacto = $Contacto;
    }public function SetTelefonoOficina($TelefonoOficina){
      if(empty($TelefonoOficina)){
        throw new Exception("Teléfono oficina es requerido");
      }
      $this->TelefonoOficina = $TelefonoOficina;
    }public function SetTelefonoMovil($TelefonoMovil){
      $this->TelefonoMovil = $TelefonoMovil;
    }public function SetPaginaWeb($PaginaWeb){
      $this->PaginaWeb = $PaginaWeb;
    }public function SetDireccionOficina($DireccionOficina){
      if(empty($DireccionOficina)){
        throw new Exception("Dirección de oficina es requerido");
      }
      $this->DireccionOficina = $DireccionOficina;
    }public function SetGiroEmpresa($GiroEmpresa){
      if(empty($GiroEmpresa)){
        throw new Exception("Giró Empresa es requerido");
      }
      $this->GiroEmpresa = $GiroEmpresa;
    }public function SetPresencia($Presencia){
      if(empty($Presencia)){
        throw new Exception("Presencia es requerido");
      }
      $this->Presencia = $Presencia;
    }public function SetNumeroEmpleados($NumeroEmpleados){
      if(empty($NumeroEmpleados)){
        throw new Exception("Número Empleados es requerido");
      }
      $this->NumeroEmpleados = $NumeroEmpleados;
    }public function SetExperienciaMercado($ExperienciaMercado){
      if(empty($ExperienciaMercado)){
        throw new Exception("Experiencia Mercado es requerido");
      }
      $this->ExperienciaMercado = $ExperienciaMercado;
    }public function SetProyectos($Proyectos){
      $this->Proyectos = $Proyectos;
    }public function SetSituacionFiscalKey($SituacionFiscalKey){
      $this->SituacionFiscalKey = $SituacionFiscalKey;
    }
    
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }
  
    /**
     * Listar Pedido 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function GetBy($filter){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_solicitud_precalificacion ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->Key                    				=   $row->t22_pk01;
          $this->NombreFacturacion             	=   $row->t22_f001;
          $this->RFC      											=   $row->t22_f002;
          $this->NombreComercial                =   $row->t22_f003;
          $this->DireccionFacturacion        		=   $row->t22_f004;
          $this->CodigoPostal   								=   $row->t22_f005;
          $this->Correo           							=   $row->t22_f006;
          $this->Contacto               				=   $row->t22_f007;
          $this->TelefonoOficina               	=   $row->t22_f008;
          $this->TelefonoMovil        					=   $row->t22_f009;
          $this->PaginaWeb          						=   $row->t22_f010;
          $this->DireccionOficina          			=   $row->t22_f011;
          $this->GiroEmpresa    								=   $row->t22_f012;
          $this->Presencia            					=   $row->t22_f013;
          $this->NumeroEmpleados             		=   $row->t22_f014;
          $this->ExperienciaMercado        			=   $row->t22_f015;
          $this->Proyectos     									=   $row->t22_f016; 
          $this->GiroEmpresaDescripcion 				=   $row->GiroEmpresaDescripcion;
          $this->PresenciaDescripcion           =   $row->PresenciaDescripcion;
          $this->NumeroEmpleadosDescripcion    	=   $row->NumeroEmpleadosDescripcion;
          $this->ExperienciaMercadoDescripcion	=   $row->ExperienciaMercadoDescripcion; 
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Add(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL SolicitudPrecalificacionCrear(
          '".$this->Terminos."',
          '".$this->NombreFacturacion."',
          '".$this->RFC."',
          '".$this->NombreComercial."',
          '".$this->DireccionFacturacion."',
          '".$this->CodigoPostal."',
          '".$this->Correo."',
          '".$this->Contacto."',
          '".$this->TelefonoOficina."',
          '".$this->TelefonoMovil."',
          '".$this->PaginaWeb."',
          '".$this->DireccionOficina."',
          '".$this->GiroEmpresa."',
          '".$this->Presencia."',
          '".$this->NumeroEmpleados."',
          '".$this->ExperienciaMercado."',
          '".$this->Proyectos."',
          '".$this->SituacionFiscalKey."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
  
  }