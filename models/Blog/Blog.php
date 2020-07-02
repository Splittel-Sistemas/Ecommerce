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

class Blog
{
  private $conn;
  private $Tool;

  public $BlogKey;
  public $BlogTitulo;
  public $BlogTituloLanding;
  public $BlogContenido;
  public $BlogContenidoLanding;
  public $BlogComillas;
  public $BlogImg;
  public $BlogImgLanding;
  public $BlogFecha;
  public $BlogActivo;
  public $elem_totales_pagination = 6;

  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }

  public function get($filter, $order, $return_json){
    try {
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM menu_blog ".$filter." ".$order;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        while ($row = $result->fetch_object()) {
          $Blog = new Blog();
          $Blog->BlogKey              = $row->id;
          $Blog->BlogTitulo           = $row->titulo;
          $Blog->BlogTituloLanding    = $row->titulo_landing;
          $Blog->BlogContenido        = $row->contenido;
          $Blog->BlogContenidoLanding = $row->contenido_landing;
          $Blog->BlogComillas         = $row->comillas;
          $Blog->BlogImg              = $row->img;
          $Blog->BlogImgLanding       = $row->img_landing;
          $Blog->BlogFecha            = $row->fecha;
          $Blog->BlogActivo           = $row->activo;
          $items[] = $Blog;
          unset($Blog);
        }
      }
      // unset($this->conn);
      return  $this->Tool->Message_return(false, "Obtención datos blog obtenidos", $items, $return_json);     
    } catch (Exception $e) {
      
    }
  }

  /**
   * Obtención de blog y validaciones para construir la pginación
   * @param [string] $filter condiciones para la consulta SQL  
   * @param [string] $order  ordernamiento para la consulta SQL
   * @return [obj] Array o Json
  */
  public function blogsPagination($filter, $order, $return_json)
  {
    $page_pagination = 0;
    if (!$this->conn->conexion()->connect_error) {
      $SQLSTATEMENT = "SELECT COUNT(*) AS total_blogs FROM menu_blog ".$filter." ".$order;
      $result = $this->conn->QueryReturn($SQLSTATEMENT);
      $row = $result->fetch_object();

      $page_pagination = intval($row->total_blogs/$this->elem_totales_pagination);

      if (!(($row->total_blogs%$this->elem_totales_pagination)==0)) {
        $page_pagination++;
      }
      $items = (object)["total_blogs" => $row->total_blogs, "page_pagination" => $page_pagination];
    }

    return $items;
  }

}