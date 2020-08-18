<?php
  if (!class_exists("Mensaje")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Solicitud/Consultecnico/Mensaje.Model.php';
  }
  class PreguntaC{

    protected $Connection;
    protected $Tool;
    
    public $Nombre;
    public $Correo;
    public $Titulo;
    public $Categoria;
    public $Pregunta;

    public function SetNombre($Nombre){
      $this->Nombre = $Nombre;
    }public function SetCorreo($Correo){
      $this->Correo = $Correo;
    }public function SetTitulo($Titulo){
      $this->Titulo = $Titulo;
    }public function SetCategoria($Categoria){
      $this->Categoria = $Categoria;
    }public function SetPregunta($Pregunta){
      $this->Pregunta = $Pregunta;
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
        $SQLSTATEMENT = "SELECT * FROM t41_consultecnico_pregunta ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->Key        =   $row->t41_pk01;
          $this->Nombre     =   $row->t41_f001;
          $this->Correo     =   $row->t41_f002;
          $this->Titulo     =   $row->t41_f003;
          $this->Categoria  =   $row->t41_f004;
          $this->Pregunta   =   $row->t41_f005;
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
        $SQLSTATEMENT = "SELECT * FROM t41_consultecnico_pregunta ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        $Mensaje = new Mensaje();
        $Mensaje->SetParameters($this->Connection, $this->Tool);

        while ($row = $result->fetch_object()) {
          $Pregunta = new PreguntaC();
          $Pregunta->Key        =   $row->t41_pk01;
          $Pregunta->Nombre     =   $row->t41_f001;
          $Pregunta->Correo     =   $row->t41_f002;
          $Pregunta->Titulo     =   $row->t41_f003;
          $Pregunta->Categoria  =   $row->t41_f004;
          $Pregunta->Pregunta   =   $row->t41_f005;
          $Pregunta->Mensaje   =   $Mensaje->Get("WHERE t41_pk01 = ".$Pregunta->Key." ", "");
          $data[] = $Pregunta;
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
        $SQLSTATEMENT = "SELECT *, count(t41_f004) as TotalPreguntas FROM t41_consultecnico_pregunta ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        $Mensaje = new Mensaje();
        $Mensaje->SetParameters($this->Connection, $this->Tool);

        while ($row = $result->fetch_object()) {
          $Pregunta = new PreguntaC();
          $Pregunta->Total      =   $row->TotalPreguntas;
          $data[] = $Pregunta;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Add(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL SolicitudConsultecnicoCrear(
          '0',
          '".$this->Nombre."',
          '".$this->Correo."',
          '".$this->Titulo."',
          '".$this->Categoria."',
          '".$this->Pregunta."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
  
  }