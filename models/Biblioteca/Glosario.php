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

class Glosario
{
  private $conn;
  private $Tool;

  public $GlosarioRango;
  public $GlosarioTermino;
  public $GlosarioDescripcion;

  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }

  public function get($filter, $order, $return_json){
    try {
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM menu_glosario ".$filter." ".$order;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        while ($row = $result->fetch_object()) {
          $Glosario = new Glosario();
          $Glosario->GlosarioRango        = $row->rango;
          $Glosario->GlosarioTermino      = $row->termino;
          $Glosario->GlosarioDescripcion  = $row->descripcion;
          $items[] = $Glosario;
          unset($Glosario);
        }
      }
      // unset($this->conn);
      return  $this->Tool->Message_return(false, "Obtención datos glosario obtenidos", $items, $return_json);     
    } catch (Exception $e) {
      
    }
  }

  public function getRangos($filter, $order, $return_json){
    try {
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT rango FROM menu_glosario ".$filter." ".$order;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        while ($row = $result->fetch_object()) {
          $Glosario = new Glosario();
          $Glosario->GlosarioRango        = $row->rango;
          $items[] = $Glosario;
          unset($Glosario);
        }
      }
      // unset($this->conn);
      return  $this->Tool->Message_return(false, "Obtención datos glosario obtenidos", $items, $return_json);     
    } catch (Exception $e) {
      
    }
  }

}