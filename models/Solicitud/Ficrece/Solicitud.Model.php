<?php
if (!class_exists("Mensaje")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Solicitud/Ficrece/Mensaje.Model.php';
}
class SolicitudC
{

  protected $Connection;
  protected $Tool;

  public $NombreSolicitud;
  public $Correo;
  public $RazonSocial;
  public $DomicilioFiscal;
  public $Colonia;
  public $Ciudad;
  public $Cp;
  public $Fax;
  public $Rfc;
  public $FechaConstitucion;
  public $Curp;
  public $Telefono;
  public $Giro;
  public $FechaAlta;
  public $JefeDepto;
  public $Beneficiario;
  public $FormaPago;
  public $Nombre1;
  public $Domicilio1;
  public $Ciudad1;
  public $Telefono1;
  public $Nombre2;
  public $Domicilio2;
  public $Ciudad2;
  public $Telefono2;
  public $Nombre3;
  public $Domicilio3;
  public $Ciudad3;
  public $Telefono3;
  public $MontoCredito;
  public $Plazo;
  public $Observaciones;
  public $Doc1;
  public $Doc2;
  public $Doc3;
  public $Doc4;
  public $Doc5;
  public $Doc6;
  public $Doc7;
  public $Doc8;
  public $Doc9;


  
  public function SetNombreSolicitud($NombreSolicitud)
  {
    if (empty($NombreSolicitud)) {
      throw new Exception('Nombre es requerido');
    }
    $this->NombreSolicitud = $NombreSolicitud;
  }
  public function SetCorreo($Correo)
  {
    if (empty($Correo)) {
      throw new Exception('Correo es requerido');
    }
    $this->Correo = $Correo;
  }
  public function SetRazonSocial($RazonSocial)
  {
    if (empty($RazonSocial)) {
      throw new Exception(' RAZON SOCIAL  es requerido');
    }
    $this->RazonSocial = $RazonSocial;
  }
  public function SetDomicilioFiscal($DomicilioFiscal)
  {
    if (empty($DomicilioFiscal)) {
      throw new Exception('DOMICILIO FISCAL es requerido');
    }
    $this->DomicilioFiscal = $DomicilioFiscal;
  }
  public function SetColonia($Colonia)
  {
    if (empty($Colonia)) {
      throw new Exception('Colonia es requerido');
    }
    $this->Colonia = $Colonia;
  }public function SetCiudad($Ciudad)
  {
    if (empty($Ciudad)) {
      throw new Exception('CIUDAD es requerido');
    }
    $this->Ciudad = $Ciudad;
  }public function SetCp($Cp)
  {
    if (empty($Cp)) {
      throw new Exception('C.P. es requerido');
    }
    $this->Cp = $Cp;
  }public function SetFax($Fax)
  {
    
    $this->Fax = $Fax;
  }public function SetRfc($Rfc)
  {
    if (empty($Rfc)) {
      throw new Exception('Rfc es requerido');
    }
    $this->Rfc = $Rfc;
  }public function SetFechaConstitucion($FechaConstitucion)
  {
    if (empty($FechaConstitucion)) {
      throw new Exception('FECHA CONSTITUCION es requerido');
    }
    $this->FechaConstitucion = $FechaConstitucion;
  }public function SetCurp($Curp)
  {
    if (empty($Curp)) {
      throw new Exception('Curp es requerido');
    }
    $this->Curp = $Curp;
  }public function SetTelefono($Telefono)
  {
    if (empty($Telefono)) {
      throw new Exception('Telefono es requerido');
    }
    $this->Telefono = $Telefono;
  }
  public function SetGiro($Giro)
  {
    if (empty($Giro)) {
      throw new Exception('Giro del Negocio es requerido');
    }
    $this->Giro = $Giro;
  }public function SetFechaAlta($FechaAlta)
  {
    if (empty($FechaAlta)) {
      throw new Exception('Fecha de alta SHCP es requerido');
    }
    $this->FechaAlta = $FechaAlta;
  }public function SetJefeDepto($JefeDepto)
  {
    if (empty($JefeDepto)) {
      throw new Exception('JEFE DEL DEPTO. DE CUENTAS POR PAGAR, CORREO Y NÚMERO DE EXTENSIÓN  es requerido');
    }
    $this->JefeDepto = $JefeDepto;
  }public function SetBeneficiario($Beneficiario)
  {
    if (empty($Beneficiario)) {
      throw new Exception('NOMBRE DEL DUEÑO BENEFICIARIO es requerido');
    }
    $this->Beneficiario = $Beneficiario;
  }public function SetFormaPago($FormaPago)
  {
    if (empty($FormaPago)) {
      throw new Exception('FORMA DE PAGO es requerido');
    }
    $this->FormaPago = $FormaPago;
  }public function SetNombre1($Nombre1)
  {
    if (empty($Nombre1)) {
      throw new Exception('Nombre de Referencia es requerido');
    }
    $this->Nombre1 = $Nombre1;
  }public function SetDomicilio1($Domicilio1)
  {
    if (empty($Domicilio1)) {
      throw new Exception('Domicilio de Referencia es requerido');
    }
    $this->Domicilio1 = $Domicilio1;
  }public function SetCiudad1($Ciudad1)
  {
    if (empty($Ciudad1)) {
      throw new Exception('Ciudad de Referencia es requerido');
    }
    $this->Ciudad1 = $Ciudad1;
  }public function SetTelefono1($Telefono1)
  {
    if (empty($Telefono1)) {
      throw new Exception('Telefono de Referencia es requerido');
    }
    $this->Telefono1 = $Telefono1;
  }
  public function SetNombre2($Nombre2)
  {
   
    $this->Nombre2 = $Nombre2;
  }public function SetDomicilio2($Domicilio2)
  {
   
    $this->Domicilio2 = $Domicilio2;
  }public function SetCiudad2($Ciudad2)
  {
   
    $this->Ciudad2 = $Ciudad2;
  }public function SetTelefono2($Telefono2)
  {
    
    $this->Telefono2 = $Telefono2;
  } public function SetNombre3($Nombre3)
  {
   
    $this->Nombre3 = $Nombre3;
  }public function SetDomicilio3($Domicilio3)
  {
   
    $this->Domicilio3 = $Domicilio3;
  }public function SetCiudad3($Ciudad3)
  {
   
    $this->Ciudad3 = $Ciudad3;
  }public function SetTelefono3($Telefono3)
  {
    
    $this->Telefono3 = $Telefono3;
  }public function SetMontoCredito($MontoCredito)
  {
    if (empty($MontoCredito)) {
      throw new Exception('Monto del Credito es requerido');
    }
    $this->MontoCredito = $MontoCredito;
  }public function SetObservaciones($Observaciones)
  {
    if (empty($Observaciones)) {
      throw new Exception('Observaciones es requerido');
    }
    $this->Observaciones = $Observaciones;
  }public function SetPlazo($Plazo)
  {
    if (empty($Plazo)) {
      throw new Exception('PLAZO DE CRÉDITO SOLICITADO es requerido');
    }
    $this->Plazo = $Plazo;
  }

  public function SetDoc1($Doc1)
  {
  
    $this->Doc1 = $Doc1;
  }
  public function SetDoc2($Doc2)
  {
    
    $this->Doc2 = $Doc2;
  }public function SetDoc3($Doc3)
  {
    if (empty($Doc3)) {
      throw new Exception('3.- Identificación oficial del representante legal es requerido');
    }
    $this->Doc3 = $Doc3;
  }public function SetDoc4($Doc4)
  {
    if (empty($Doc4)) {
      throw new Exception('4.- Alta en Hacienda y RFC es requerido');
    }
    $this->Doc4 = $Doc4;
  }public function SetDoc5($Doc5)
  {
    if (empty($Doc5)) {
      throw new Exception('5.- Comprobante de domicilio (No mayor a 3 meses) es requerido');
    }
    $this->Doc5 = $Doc5;
  }public function SetDoc6($Doc6)
  {
    if (empty($Doc6)) {
      throw new Exception('6.- Estados Financieros de los últimos 3 meses es requerido');
    }
    $this->Doc6 = $Doc6;
  }public function SetDoc7($Doc7)
  {
    if (empty($Doc7)) {
      throw new Exception('7.- Estados de Cuenta bancarios es requerido');
    }
    $this->Doc7 = $Doc7;
  }public function SetDoc8($Doc8)
  {
    if (empty($Doc8)) {
      throw new Exception('8.- Autorización para solicitar reportes de crédito es requerido');
    }
    $this->Doc8 = $Doc8;
  }
  public function SetDoc9($Doc9)
  {
    if (empty($Doc9)) {
      throw new Exception('9.- Opinión de cumplimiento es requerido');
    }
    $this->Doc9 = $Doc9;
  }














  public function SetParameters($conn, $Tool)
  {
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
  public function GetBy($filter)
  {
    try {
      $SQLSTATEMENT = "SELECT * FROM t48_solicitud_ficrece " . $filter . " ";
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = false;

      while ($row = $result->fetch_object()) {
        $this->Key        =   $row->id;
        $this->Nombre     =   $row->nombre;
        $this->Correo     =   $row->correo;
        $this->Monto     =   $row->monto;
        $this->Fecha  =   $row->fecha;
        $this->Fecha_Solicitud   =   $row->fecha_solicitud;
        $data = true;
      }
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Listar Pedido 
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function Get($filter)
  {
    try {
      $SQLSTATEMENT = "SELECT * FROM t48_solicitud_ficrece " . $filter . " ";
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = [];

      $Mensaje = new Mensaje();
      $Mensaje->SetParameters($this->Connection, $this->Tool);

      while ($row = $result->fetch_object()) {
        $Solicitud = new SolicitudC();
        $Solicitud->Key        =   $row->id;
        $Solicitud->Nombre     =   $row->nombre;
        $Solicitud->Correo     =   $row->correo;
        $Solicitud->Monto     =   $row->monto;
        $Solicitud->Fecha  =   $row->fecha;
        $Solicitud->Fecha_Solicitud   =   $row->fecha_solicitud;
        $Solicitud->Mensaje   =   $Mensaje->Get(" WHERE id = " . $Solicitud->Key . " ", " ORDER BY fecha_solicitud ASC");
        $data[] = $Solicitud;
      }
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }

  /**
   * Listar Pedido 
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function Get_($filter)
  {
    try {
      $SQLSTATEMENT = "SELECT *, count(fecha) as TotalSolicituds FROM t48_solicitud_ficrece " . $filter . " ";
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = [];

      $Mensaje = new Mensaje();
      $Mensaje->SetParameters($this->Connection, $this->Tool);

      while ($row = $result->fetch_object()) {
        $Solicitud = new SolicitudC();
        $Solicitud->Total      =   $row->TotalSolicituds;
        $data[] = $Solicitud;
      }
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function Add()
  {
    try {
      $result = $this->Connection->Exec_store_procedure_json("CALL SolicitudFicrece(
          '0',
          '" . $this->NombreSolicitud. "',
          '" . $this->Correo. "',
          '" . $this->RazonSocial. "',
          '" . $this->DomicilioFiscal. "',
          '" . $this->Colonia. "',
          '" . $this->Ciudad. "',
          '" . $this->Cp. "',
          '" . $this->Fax. "',
          '" . $this->Rfc. "',
          '" . $this->FechaConstitucion. "',
          '" . $this->Curp. "',
          '" . $this->Telefono. "',
          '" . $this->Giro. "',
          '" . $this->FechaAlta. "',
          '" . $this->JefeDepto. "',
          '" . $this->Beneficiario. "',
          '" . $this->FormaPago. "',
          '" . $this->Nombre1. "',
          '" . $this->Domicilio1. "',
          '" . $this->Ciudad1. "',
          '" . $this->Telefono1. "',
          '" . $this->Nombre2. "',
          '" . $this->Domicilio2. "',
          '" . $this->Ciudad2. "',
          '" . $this->Telefono2. "',
          '" . $this->Nombre3. "',
          '" . $this->Domicilio3. "',
          '" . $this->Ciudad3. "',
          '" . $this->Telefono3. "',
          '" . $this->MontoCredito. "',
          '" . $this->Plazo. "',
          '" . $this->Observaciones. "',
          '" . $this->Doc1. "',
          '" . $this->Doc2. "',
          '" . $this->Doc3. "',
          '" . $this->Doc4. "',
          '" . $this->Doc5. "',
          '" . $this->Doc6. "',
          '" . $this->Doc7. "',
          '" . $this->Doc8. "',
          '" . $this->Doc9. "',

          '',

        @Result);", "@Result");
       
      return $result;
    } catch (Exception $e) {
      throw $e;
    }
  }
}
