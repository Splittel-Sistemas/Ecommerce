<?php
if (!class_exists("Mensaje")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Solicitud/Ficrece/Mensaje.Model.php';
}
class SolicitudC
{

  protected $Connection;
  protected $Tool;

  public $RazonSocial;
  public $Rfc;
  public $DomicilioFiscal;
  public $NombreSolicitud;
  public $Departamento;
  public $Titulo;
  public $Telefono;
  public $Correo;
  public $CorreEjecutivo;
  public $NummeroInt;
  public $Calle;
  public $Colonia;
  public $Cuidad;
  public $CP;
  public $Estado;
  public $NombreComercial;
  public $Web;
  public $valoresCheck;
  public $Doc1;


  public function SetRazonSocial($RazonSocial)
  {
    if (empty($RazonSocial)) {
      throw new Exception('Nombre es requerido');
    }
    $this->RazonSocial = $RazonSocial;
  }
  public function SetRfc($Rfc)
  {
    if (empty($Rfc)) {
      throw new Exception('Rfc es requerido');
    }
    $this->Rfc = $Rfc;
  }
  public function SetDomicilioFiscal($DomicilioFiscal)
  {
    if (empty($DomicilioFiscal)) {
      throw new Exception(' RAZON SOCIAL  es requerido');
    }
    $this->DomicilioFiscal = $DomicilioFiscal;
  }
  public function SetNombreSolicitud($NombreSolicitud)
  {
    if (empty($NombreSolicitud)) {
      throw new Exception(' RAZON SOCIAL  es requerido');
    }
    $this->NombreSolicitud = $NombreSolicitud;
  }
  public function SetDepartamento($Departamento)
  {

    $this->Departamento = $Departamento;
  }
  public function SetTitulo($Titulo)
  {

    $this->Titulo = $Titulo;
  }
  public function SetTelefono($Telefono)
  {
    if (empty($Telefono)) {
      throw new Exception(' Telefono es requerido');
    }
    $this->Telefono = $Telefono;
  }
  public function SetCorreo($Correo)
  {
    if (empty($Correo)) {
      throw new Exception(' Correo es requerido');
    }
    $this->Correo = $Correo;
  }
  public function SetCorreEjecutivo($CorreEjecutivo)
  {
    if (empty($CorreEjecutivo)) {
      throw new Exception(' CorreEjecutivo es requerido');
    }
    $this->CorreEjecutivo = $CorreEjecutivo;
  }
  public function SetNummeroInt($NummeroInt)
  {
    if (empty($NummeroInt)) {
      throw new Exception(' NummeroInt es requerido');
    }
    $this->NummeroInt = $NummeroInt;
  }
  public function SetCalle($Calle)
  {
    if (empty($Calle)) {
      throw new Exception(' Calle es requerido');
    }
    $this->Calle = $Calle;
  }

  public function SetColonia($Colonia)
  {
    if (empty($Colonia)) {
      throw new Exception(' Colonia es requerido');
    }
    $this->Colonia = $Colonia;
  }
  public function SetCuidad($Cuidad)
  {
    if (empty($Cuidad)) {
      throw new Exception(' Cuidad es requerido');
    }
    $this->Cuidad = $Cuidad;
  }
  public function SetCP($CP)
  {
    if (empty($CP)) {
      throw new Exception(' CP es requerido');
    }
    $this->CP = $CP;
  }
  public function SetEstado($Estado)
  {
    if (empty($Estado)) {
      throw new Exception(' Estado es requerido');
    }
    $this->Estado = $Estado;
  }
  public function SetNombreComercial($NombreComercial)
  {

    $this->NombreComercial = $NombreComercial;
  }
  public function SetWeb($Web)
  {

    $this->Web = $Web;
  }
  public function SetvaloresCheck($valoresCheck)
  {
    if (empty($valoresCheck)) {
      throw new Exception(' GIRO DE LA EMPRESA es requerido');
    }
    $this->valoresCheck = $valoresCheck;
  }
  public function SetDoc1($Doc1)
  {

    $this->Doc1 = $Doc1;
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
      $SQLSTATEMENT = "SELECT * FROM t49_alta_clientes " . $filter . " ";
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
      $SQLSTATEMENT = "SELECT * FROM t49_alta_clientes " . $filter . " ";
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
      $SQLSTATEMENT = "SELECT *, count(fecha) as TotalSolicituds FROM t49_alta_clientes " . $filter . " ";
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
      $result = $this->Connection->Exec_store_procedure_json("CALL  SolicitudAltacliente (
          '0',
          '" . $this->RazonSocial . "',
          '" . $this->Rfc . "',
          '" . $this->DomicilioFiscal . "',
          '" . $this->NombreSolicitud . "',
          '" . $this->Departamento . "',
          '" . $this->Titulo . "',
          '" . $this->Telefono . "',
          '" . $this->Correo . "',
          '" . $this->CorreEjecutivo . "',
          '" . $this->NummeroInt . "',
          '" . $this->Calle . "',
          '" . $this->Colonia . "',
          '" . $this->Cuidad . "',
          '" . $this->CP . "',
          '" . $this->Estado . "',
          '" . $this->NombreComercial . "',
          '" . $this->Web . "',
          '" . $this->valoresCheck . "',
          '" . $this->Doc1 . "',
       
            '',
            '',



        @Result);", "@Result");

      return $result;
    } catch (Exception $e) {
      throw $e;
    }
  }
}
