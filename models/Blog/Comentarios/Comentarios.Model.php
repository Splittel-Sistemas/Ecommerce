<?php
if (!class_exists("Email")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/Email.php';
}if (!class_exists("EmailTest")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/EmailTest.php';
}
  class ComentariosBlog{

    protected $Connection;
    protected $Tool;
    
    public $Key;
    public $Descripcion;
    public $Activo;
    public $ClienteKey;
    public $Tipo;
    public $BlogKey;
    public $ComentarioRel;
    
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetKey($Key){
      $this->Key = $Key;
    }public function SetReview($Descripcion){
      $this->Descripcion = $Descripcion;
    }public function SetClienteKey($ClienteKey){
      $this->ClienteKey = $ClienteKey;
    }public function SetType($Tipo){
      $this->Tipo = $Tipo;
    }public function SetBlogKey($BlogKey){
      $this->BlogKey = $BlogKey;
    }public function SetComentarioRel($ComentarioRel){
      $this->ComentarioRel = $ComentarioRel;
    }
    
  
    /**
     * Listar Comentarios 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    
    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_blog_comentarios ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
          $Obj = new stdClass();
          $Obj->Key           =   $row->id;
          $Obj->KeyBlog       =   $row->id_blog;
          $Obj->KeyCliente    =   $row->id_cliente;
          $Obj->KeyRelacionado=   $row->id_comentario;
          $Obj->Review     =   $row->comentario;
          $Obj->fecha    =   $row->fecha;
          $data[] = $Obj;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Add(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL BlogAgregarComentario(
          '".$this->Key."',
          '".$this->BlogKey."',
          '".$this->ComentarioRel."',
          '".$this->ClienteKey."',
          '".$this->Descripcion."',
          '".$this->Tipo."',
        @Result);", "@Result");

        if (!$result['error']) {
          $Email = new Email();
          $EmailTest = new EmailTest();
            $Email->MailerSubject = utf8_decode("Nuevo comentario en blog");
            $this->Correo = ['capacitaciones@optronics.com.mx'];
            $Email->MailerBody = $EmailTest->blog($this->Descripcion,$this->BlogKey);
            $Email->MailerListTo = $this->Correo;
            $Email->EmailSendEmail();
        }else{
          throw new Exception("No se pudo guardar la información, intenta de nuevo por favor!");
        }


        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
  
  }