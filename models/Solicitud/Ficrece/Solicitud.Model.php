<?php
  if (!class_exists("Mensaje")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Solicitud/Ficrece/Mensaje.Model.php';
  }
  class SolicitudC{

    protected $Connection;
    protected $Tool;
    
    public $Nombre;
    public $Correo;
    public $Monto;
    public $date;

    public function SetNombre($Nombre){
      if (empty($Nombre)) {
        throw new Exception('Nombre es requerido');
      }
      $this->Nombre = $Nombre;
    }public function SetCorreo($Correo){
      if (empty($Correo)) {
        throw new Exception('Correo es requerido');
      }
      $this->Correo = $Correo;
    }public function SetMonto($Monto){
      if (empty($Monto)) {
        throw new Exception(' Monto es requerido');
      }
      $this->Monto = $Monto;
    }public function SetFecha($Fecha){
      if (empty($Fecha)) {
        throw new Exception('Fecha es requerido');
      }
      $this->Fecha = $Fecha;
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
        $SQLSTATEMENT = "SELECT * FROM t48_solicitud_ficrece ".$filter." ";
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
    public function Get($filter){
      try {
        $SQLSTATEMENT = "SELECT * FROM t48_solicitud_ficrece ".$filter." ";
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
          $Solicitud->Mensaje   =   $Mensaje->Get(" WHERE id = ".$Solicitud->Key." ", " ORDER BY fecha_solicitud ASC");
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
    public function Get_($filter){
      try {
        $SQLSTATEMENT = "SELECT *, count(fecha) as TotalSolicituds FROM t48_solicitud_ficrece ".$filter." ";
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

    public function Add(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL SolicitudFicrece(
          '0',
          '".$this->Nombre."',
          '".$this->Correo."',
          '".$this->Monto."',
          '".$this->Fecha."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
  
  }