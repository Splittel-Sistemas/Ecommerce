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

class CatalogoProductos
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
        $SQLSTATEMENT = "SELECT * FROM list_all_productos ".$filter." ".$order;
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

  public function masVendidos($filter, $order){
    try {
      $items = [];
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT *, COUNT(*) as total FROM listar_productos_mas_vendidos ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        while ($row = $result->fetch_object()) {
          $items[] = $row;
        }
        $response = $this->Tool->Message_return(false, "", $items, false);
      }
    } catch (Exception $e) {
      $response = $this->Tool->Message_return(false, "Error: ".$e->getMessage(), null, false);
    }
    return $response;
  }

  public function controller(){
    try {
      $Action = $this->Tool->validate_isset_post('Action');
      switch ($Action) {
        case 'get':
          $CatalogoProductos = new CatalogoProductos();
          $CatalogoProductos->Codigo = $this->Tool->validate_isset_post('Codigo');
          echo $CatalogoProductos->get("WHERE codigo = '".$CatalogoProductos->Codigo."' ", "", true);
          break;
        default:
          throw new Exception("No se encontro la opcion solicitada!");
          break;
      }
    } catch (Exception $e) {
      echo $this->Tool->Message_return(true, $e->getMessage(), null, true);
    }
  }

}

  $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_POST['ActionProductos'])) { 
    $CatalogoProductos = new CatalogoProductos();
    $CatalogoProductos->Controller();
    unset($CatalogoProductos);
  }
  unset($Tool);