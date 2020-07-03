<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("ComentariosBlog")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Blog/Comentarios/Comentarios.Model.php';
}
  /**
   * 
   */
  class ComentariosBlogController{
    
    protected $Connection;
    protected $Tool;

    public $filter;
    public $order;

    public function __construct(){
      $this->Connection = new Connection();
      $this->Tool = new Functions_tools();
    }

    public function Get(){
      try {
        if(!$this->Connection->conexion()->connect_error){
          $ComentariosModel = new ComentariosBlog();
          $ComentariosModel->SetParameters($this->Connection, $this->Tool);
          $Result = $ComentariosModel->Get($this->filter, $this->order);
          unset($ComentariosModel);
          return $this->Tool->Message_return(false, "", $Result, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Create(){
      try {
        if(!$this->Connection->conexion()->connect_error){
          $ComentariosModel = new ComentariosBlog();
          $ComentariosModel->SetParameters($this->Connection, $this->Tool);
          $ComentariosModel->SetKey(0);
          $ComentariosModel->SetType(0);
          $ComentariosModel->SetBlogKey($_POST['BlogKey']);
          $ComentariosModel->SetClienteKey(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
          $ComentariosModel->SetReview($_POST['Comment']);
          $ComentariosModel->SetComentarioRel(0);
          return $ComentariosModel->Add();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function CreateReply(){
      try {
        if(!$this->Connection->conexion()->connect_error){
          $ComentariosModel = new ComentariosBlog();
          $ComentariosModel->SetParameters($this->Connection, $this->Tool);
          $ComentariosModel->SetKey(0);
          $ComentariosModel->SetType(1);
          $ComentariosModel->SetBlogKey($_POST['BlogKey']);
          $ComentariosModel->SetClienteKey(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
          $ComentariosModel->SetReview($_POST['Comment']);
          $ComentariosModel->SetComentarioRel($_POST['KeyRelacion']);
          return $ComentariosModel->Add();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }