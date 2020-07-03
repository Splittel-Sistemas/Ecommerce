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

class Infografias
{
  private $conn;
  private $Tool;

  public $InfografiasKey;
  public $InfografiasNombre;
  public $InfografiasContenido;
  public $InfografiasImg;
  public $InfografiasPDF;
  public $InfografiasActivo;

  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }

  public function get($filter, $order, $return_json){
    try {
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM menu_infografias ".$filter." ".$order;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        while ($row = $result->fetch_object()) {
          $Infografias = new Infografias();
          $Infografias->InfografiasKey       = $row->id;
          $Infografias->InfografiasNombre    = $row->nombre;
          $Infografias->InfografiasContenido = $row->contenido;
          $Infografias->InfografiasImg       = $row->img;
          $Infografias->InfografiasPDF       = $row->pdf;
          $Infografias->InfografiasActivo    = $row->activo;
          $items[] = $Infografias;
          unset($Infografias);
        }
      }
      // unset($this->conn);
      return  $this->Tool->Message_return(false, "Obtención datos Infografias obtenidos", $items, $return_json);     
    } catch (Exception $e) {
      
    }
  }

}