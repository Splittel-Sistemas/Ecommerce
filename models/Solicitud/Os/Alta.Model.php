<?php
if (!class_exists("Mensaje")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Solicitud/Os/Mensaje.Model.php';
}
class SolicitudC
{

  protected $Connection;
  protected $Tool;
  protected $IOFactory;

  public $Empresa;
  public $Estado;
  public $Contacto;
  public $Correo;
  public $Telefono;
  public $Titulo;
  public $CorreEjecutivo;
  public $Marca;
  public $Modelo;
  public $serie;
  public $accesorios;
  public $observaciones;

  public $valoresCheck;
  public $guia;
  public $paqueteria;



  public function SetEmpresa($Empresa)
  {
    if (empty($Empresa)) {
      throw new Exception('Empresa es requerido');
    }
    $this->Empresa = $Empresa;
  }
  public function SetEstado($Estado)
  {
    if (empty($Estado)) {
      throw new Exception('Estado es requerido');
    }
    $this->Estado = $Estado;
  }
  public function SetContacto($Contacto)
  {
    if (empty($Contacto)) {
      throw new Exception('Contacto es requerido');
    }
    $this->Contacto = $Contacto;
  }
  public function SetCorreo($Correo)
  {
    if (empty($Correo)) {
      throw new Exception('Correo es requerido');
    }
    $this->Correo = $Correo;
  }
  public function SetCorreEjecutivo($CorreEjecutivo)
  {

    $this->CorreEjecutivo = $CorreEjecutivo;
  }
  public function SetTelefono($Telefono)
  {
    if (empty($Telefono)) {
      throw new Exception('Telefono es requerido');
    }
    $this->Telefono = $Telefono;
  }
  public function SetTitulo($Titulo)
  {

    $this->Titulo = $Titulo;
  }


  public function SetMarca($Marca)
  {
    if (empty($Marca)) {
      throw new Exception('Marca es requerido');
    }
    $this->Marca = $Marca;
  }
  public function SetModelo($Modelo)
  {
    if (empty($Modelo)) {
      throw new Exception('Modelo es requerido');
    }
    $this->Modelo = $Modelo;
  }

  public function Setserie($serie)
  {
    if (empty($serie)) {
      throw new Exception('Número de serie es requerido');
    }
    $this->serie = $serie;
  }
  public function Setaccesorios($accesorios)
  {
 
    $this->accesorios = $accesorios;
  }
  public function Setobservaciones($observaciones)
  {

    $this->observaciones = $observaciones;
  }
  public function Setpaqueteria($paqueteria)
  {
    if (empty($paqueteria)) {
      throw new Exception('Paqueteria es requerido');
    }
    $this->paqueteria = $paqueteria;
  }

  public function Setguia($guia)
  {
   
    $this->guia = $guia;
  }

  public function SetvaloresCheck($valoresCheck)
  {
    if (empty($valoresCheck)) {
      throw new Exception('GIRO DE LA EMPRESA es requerido');
    }
    $this->valoresCheck = $valoresCheck;
  }







  public function SetParameters($conn, $Tool)
  {
    $this->Connection = $conn;
    $this->Tool = $Tool;
  }

 

  public function Add()
  {
    try {
      $result = $this->Connection->Exec_store_procedure_json("CALL  SolicitudOrdenServicio (
          '0',
          '" . $this->Empresa . "',
          '" . $this->Estado . "',
          '" . $this->Contacto . "',
          '" . $this->Correo . "',
          '" . $this->Telefono . "',
          '" . $this->CorreEjecutivo . "',
          '" . $this->valoresCheck . "',
          '" . $this->Marca . "',
          '" . $this->Modelo . "',
          '" . $this->serie . "',
          '" . $this->observaciones . "',
          '" . $this->accesorios . "',
            '',
            '',
          '" . $this->paqueteria . "',
          '" . $this->guia . "',

        @Result);", "@Result");

      return $result;
    } catch (Exception $e) {
      throw $e;
    }
  }
}
