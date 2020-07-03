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

class Catalogo
{
  private $conn;
  private $Tool;

  public $CatalogoTitulo;
  public $CatalogoImgPrincipal;
  public $CatalogoSubtitulo1;
  public $CatalogoTexto1;
  public $CatalogoComillas;
  public $CatalogoTexto2;

  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }

  public function get($filter, $order, $return_json){
    try {
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM menu_catalogo ".$filter." ".$order;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        while ($row = $result->fetch_object()) {
          $Catalogo = new Catalogo();
          $Catalogo->CatalogoTitulo        = $row->titulo;
          $Catalogo->CatalogoImgPrincipal  = $row->img_principal;
          $Catalogo->CatalogoSubtitulo1    = $row->subtitulo1;
          $Catalogo->CatalogoTexto1        = $row->texto1;
          $Catalogo->CatalogoComillas      = $row->comillas;
          $Catalogo->CatalogoTexto2        = $row->texto2;
          $items[] = $Catalogo;
          unset($Catalogo);
        }
      }
      // unset($this->conn);
      return  $this->Tool->Message_return(false, "Obtención datos Catalogo obtenidos", $items, $return_json);     
    } catch (Exception $e) {
      
    }
  }

}