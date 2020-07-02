<?php 

/**
 * 
 */
@session_start();
if (!class_exists("Connection")) {
  require_once $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  require_once $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}

class CatalogoDescripciones
{

  private $conn;
  private $Tool;
  
  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }
  /**
   * Description
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function get($filter, $order, $return_json){
    try {
      $items = [];
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM catalogo_descripciones ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        while ($row = $result->fetch_object()) {
          $items[] = $row;
        }
        $response = $this->Tool->Message_return(false, "", $items, $return_json);
      }
    } catch (Exception $e) {
      $response = $this->Tool->Message_return(false, "Error: ".$e->getMessage(), null, $return_json);
    }
    return $response;
  }
}