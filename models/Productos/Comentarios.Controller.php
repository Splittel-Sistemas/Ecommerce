<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists("Comentarios")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Productos/Comentarios.Model.php';
}
  /**
   * 
   */
  class ComentariosController{
    
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
          $ComentariosModel = new Comentarios();
          $ComentariosModel->SetParameters($this->Connection, $this->Tool);
          $Result = $ComentariosModel->Get($this->filter, $this->order);
          unset($ComentariosModel);
          return $this->Tool->Message_return(false, "", $Result, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Comentarios(){
      try {
        if(!$this->Connection->conexion()->connect_error){
          $ComentariosModel = new Comentarios();
          $ComentariosModel->SetParameters($this->Connection, $this->Tool);
          $Result = $ComentariosModel->ListarComentarios($this->filter, "");
          unset($ComentariosModel);
          return $this->Tool->Message_return(false, "", $Result, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Comentarios_(){
      try {
        if(!$this->Connection->conexion()->connect_error){
          $ComentariosModel = new Comentarios();
          $ComentariosModel->SetParameters($this->Connection, $this->Tool);
          $resultPrincipal = $ComentariosModel->ListarComentarios($this->filter, "")[0];
          $Principal['Principal'] = $resultPrincipal;

          $TotalComentariosPrincipal = $resultPrincipal->TotalComentarios;

          
          $result = $ComentariosModel->ListarComentarios($this->filter, "GROUP BY t01_f003 ORDER BY t01_f003 DESC");
          $items = [];
          foreach ($result as $key => $Comentario) {
            $Porcentaje = number_format((($Comentario->TotalComentarios / $TotalComentariosPrincipal) * 100), 2 );
            $items[] = [
              'Estrellas' => $Comentario->Estrellas,
              'TotalComentarios' => $Comentario->TotalComentarios,
              'Porcentaje' => $Porcentaje,
              'Usuario' => $Comentario->Usuario
            ];
          }
          $Principal['items'] = $items;
          // print_r($Principal);
          return $Principal;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Create(){
      try {
        if(!$this->Connection->conexion()->connect_error){
          $ComentariosModel = new Comentarios();
          $ComentariosModel->SetParameters($this->Connection, $this->Tool);
          $ComentariosModel->SetKey(0);
          $ComentariosModel->SetTitulo($_POST['Titulo']);
          $ComentariosModel->SetDescripcion($_POST['Descripcion']);
          $ComentariosModel->SetEstrellas($_POST['Estrellas']);
          $ComentariosModel->SetClienteKey(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
          $ComentariosModel->SetProductoKey($_POST['ProductoKey']);
          $ComentariosModel->SetCategoriaKey($_POST['CategoriaKey']);
          return $ComentariosModel->Add();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }