<?php 

/**
 * 
 */
@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].$_SESSION['Ecommerce_Directorio'].'/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].$_SESSION['Ecommerce_Directorio'].'/models/Tools/Functions_tools.php';
}

class Historia
{
  private $conn;
  private $Tool;

  public $HistoriaFecha;
  public $HistoriaImg;

  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }

  public function get($filter, $order, $return_json){
    try {
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM menu_catalogo_historia ".$filter." ".$order;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        while ($row = $result->fetch_object()) {
          $Historia = new Historia();
          $Historia->HistoriaFecha  = $row->fecha;
          $Historia->HistoriaImg    = $row->imagen;
          $items[] = $Historia;
          unset($Historia);
        }
      }
      // unset($this->conn);
      return  $this->Tool->Message_return(false, "Obtención datos historia obtenidos", $items, $return_json);     
    } catch (Exception $e) {
      
    }
  }

}