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

class CatalogoFichasTecnicas
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
        $SQLSTATEMENT = "SELECT * FROM catalogo_fichas_tecnicas ".$filter." ".$order;
         //echo $SQLSTATEMENT;
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
  /**
   * Description
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function productoFicha($filter, $order, $return_json){
    try {
      $items = []; 
      $response = $this->Tool->Message_return(false, "No hay ficha tecnica para el producto", $items, $return_json);
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM u_producto_ficha ".$filter." ".$order;
         //echo $SQLSTATEMENT;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $row = $result->fetch_object();
        if (!empty($row)) {
          $response = $this->get("WHERE id_ficha = '".$row->id_producto."' ", "", $return_json);
        }
      }
    } catch (Exception $e) {
      $response = $this->Tool->Message_return(false, "Error: ".$e->getMessage(), null, $return_json);
    }
    return $response;
  }

}