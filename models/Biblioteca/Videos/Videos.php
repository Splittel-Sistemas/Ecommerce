<?php 

/**
 * 
 */
@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}

class Videos
{
  private $conn;
  private $Tool;

  public $VideosKey;
  public $VideosTitulo;
  public $VideosImg;
  public $VideosLink;
  public $VideosContenido;
  public $VideosActivo;
  public $VideosPrefijo;

  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }

  public function get($filter, $order, $return_json){
    try {
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM menu_videos ".$filter." ".$order;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        while ($row = $result->fetch_object()) {
          $Videos = new Videos();
          $Videos->VideosKey       = $row->id;
          $Videos->VideosTitulo    = $row->titulo;
          $Videos->VideosImg       = $row->img;
          $Videos->VideosLink      = $row->link;
          $Videos->VideosContenido = $row->contenido;
          $Videos->VideosActivo    = $row->activo;
          $Videos->VideosPrefijo    = $row->prefijo;
          $items[] = $Videos;
          unset($Videos);
        }
      }
      // unset($this->conn);
      return  $this->Tool->Message_return(false, "Obtención datos Videos obtenidos", $items, $return_json);     
    } catch (Exception $e) {
      
    }
  }

}