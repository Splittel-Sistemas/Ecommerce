<?php

class SolicitudCursos
{

  protected $Connection;
  protected $Tool;

  public $name;
  public $date;
  public $NombreSolicitud;
  public $Titulo;

  public $Empresa;
  public $Puesto;
  public $Telefono;

  public $CorreoEmpresarial;
  public $CorrePersonal;
  public $Whatsapp;
  public $Ap;
  public $Am;
  public $Doc1;
  public $Restriccion;

  public $Vehiculo;

  public function Setname($name)
  {
    if (empty($name)) {
      throw new Exception('Nombre del curso es requerido');
    }
    $this->name = $name;
  }
  public function Setdate($date)
  {
    if (empty($date)) {
      throw new Exception('Fecha es requerido');
    }
    $this->date = $date;
  }
  public function SetNombreSolicitud($NombreSolicitud)
  {
    if (empty($NombreSolicitud)) {
      throw new Exception('Nombre es requerido');
    }
    $this->NombreSolicitud = $NombreSolicitud;
  }
  public function SetTitulo($Titulo)
  {
    if (empty($Titulo)) {
      throw new Exception('Título es requerido');
    }
    $this->Titulo = $Titulo;
  }
  public function SetEmpresa($Empresa)
  {
    if (empty($Empresa)) {
      throw new Exception('Empresa es requerido');
    }
    $this->Empresa = $Empresa;
  }
  public function SetPuesto($Puesto)
  {
    if (empty($Puesto)) {
      throw new Exception('Puesto es requerido');
    }
    $this->Puesto = $Puesto;
  }
  public function SetTelefono($Telefono)
  {
    if (empty($Telefono)) {
      throw new Exception('Teléfono es requerido');
    }
    $this->Telefono = $Telefono;
  }
  public function SetCorreoEmpresarial($CorreoEmpresarial)
  {
    if (empty($CorreoEmpresarial)) {
      throw new Exception('Correo Empresarial es requerido');
    }
    $this->CorreoEmpresarial = $CorreoEmpresarial;
  }
  public function SetCorrePersonal($CorrePersonal)
  {
    if (empty($CorrePersonal)) {
      throw new Exception('Correo Personales requerido');
    }
    $this->CorrePersonal = $CorrePersonal;
  }
  public function SetWhatsapp($Whatsapp)
  {
    if (empty($Whatsapp)) {
      throw new Exception('Whats App personal es requerido');
    }
    $this->Whatsapp = $Whatsapp;
  }

  public function SetAp($Ap)
  {
    if (empty($Ap)) {
      throw new Exception(' APELLIDO PATERNO es requerido');
    }
    $this->Ap = $Ap;
  }  public function SetAm($Am)
  {
    if (empty($Am)) {
      throw new Exception('APELLIDO MATERNO es requerido');
    }
    $this->Am = $Am;
  }
  public function SetDoc1($Doc1)
  {
    if (empty($Doc1)) {
      throw new Exception('ANEXO es requerido');
    }
    $this->Doc1 = $Doc1;
  }
  public function SetRestriccion($Restriccion)
  {
    if (empty($Restriccion)) {
      throw new Exception('El campo RESTRICCION ALIMENTARIA es requerido');
    }
    $this->Restriccion = $Restriccion;
  }

  public function SetVehiculo($vehiculo)
  {
    if (empty($vehiculo) || $vehiculo == '') {
      $vehiculo = null;
    }
    $this->Vehiculo = $vehiculo;
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
      $SQLSTATEMENT = "SELECT * FROM t50_alta_cursos " . $filter . " ";
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
      $SQLSTATEMENT = "SELECT * FROM t50_alta_cursos " . $filter . " ";
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
      $SQLSTATEMENT = "SELECT *, count(fecha) as TotalSolicituds FROM t50_alta_cursos " . $filter . " ";
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
      $result = $this->Connection->Exec_store_procedure_json("CALL  SolicitudAltacurso (
          '0',
          '" . $this->name . "',
          '" . $this->date . "',
          '" . $this->NombreSolicitud . "',
          '" . $this->Empresa . "',
          '" . $this->Puesto . "',
          '" . $this->Telefono . "',
          '" . $this->CorreoEmpresarial . "',
          '" . $this->CorrePersonal . "',
          '" . $this->Whatsapp . "',
            '',
            '',
            '" . $this->Titulo . "',
            '" . $this->Ap . "',
            '" . $this->Am . "',
            '" . $this->Restriccion . "',
            '" . $this->Vehiculo . "',
        @Result);", "@Result");

      return $result;
    } catch (Exception $e) {
      throw $e;
    }
  }
}
