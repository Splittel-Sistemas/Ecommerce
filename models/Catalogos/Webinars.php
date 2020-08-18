<?php 

/**
 * 
 */
@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}
/*
if (!class_exists("Email")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/Email.php';
}if (!class_exists("EmailTest")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/EmailTest.php';
}if (!class_exists("Captcha")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Captcha/Captcha.php';
}
*/

class CatalogoWebinars{
  protected $conn;
  protected $Tool;
  //protected $Correo = ["marketing.directo@splittel.com"];
  public $elem_totales_pagination = 4;
  
  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }
  /**
   * Obtención de información relevante catalogo webianrs
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function get($filter, $order, $return_json){
    try {
      $items = [];
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM menu_webinars ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        while ($row = $result->fetch_object()) {
          $items[] = $row;
        }
        return $this->Tool->Message_return(false, "", $items, $return_json);
    
      }
    } catch (Exception $e) {
      throw $e;
    }
  }

    /**
   * Obtención de blog y validaciones para construir la pginación
   * @param [string] $filter condiciones para la consulta SQL  
   * @param [string] $order  ordernamiento para la consulta SQL
   * @return [obj] Array o Json
  */
  public function webinarsPagination($filter, $order, $return_json)
  {
    $page_pagination = 0;
    if (!$this->conn->conexion()->connect_error) {
      $SQLSTATEMENT = "SELECT COUNT(*) AS total_blogs FROM menu_webinars ".$filter." ".$order;
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

  $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_POST['ActionCursos'])) { 
    CatalogoWebinars::controller();
  }
  unset($Tool);