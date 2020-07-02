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
class CablesPreconectorizadosF0
{
  private $conn;
  private $Tool;

  
  public $CablesPreconLongitud;
  public $CablesPreconConA;
  public $CablesPreconConB;

  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }
 
  
  /**
   * Calculo de costos 
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function calculo($return_json){
    try {
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM t33_preconectorizado_figura0 WHERE tipo='Fibra'";
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $row = $result->fetch_object();

        $SQLSTATEMENT3 = "SELECT * FROM t33_preconectorizado_figura0 WHERE tipo='Bolsa'";
        $result3 = $this->conn->QueryReturn($SQLSTATEMENT3);
        $row3 = $result3->fetch_object();

        $SQLSTATEMENT1 = "SELECT * FROM t33_preconectorizado_figura0 WHERE tipo='Conector' AND componente='".$this->CablesPreconConA."'";
        $result1 = $this->conn->QueryReturn($SQLSTATEMENT1);
        $row1 = $result1->fetch_object();

        if($this->CablesPreconConB!=''){
          $SQLSTATEMENT2 = "SELECT * FROM t33_preconectorizado_figura0 WHERE tipo='Conector' AND componente='".$this->CablesPreconConB."'";
          $result2 = $this->conn->QueryReturn($SQLSTATEMENT2);
          $row2 = $result2->fetch_object();
          $PrecioCon2=$row2->precio;
        }else{
          $PrecioCon2=0;
        }

        $Costo=($row->precio*$this->CablesPreconLongitud)+($row1->precio)+($PrecioCon2)+($row3->precio);
        $descuento = 0;
        if(isset($_SESSION['Ecommerce-ClienteDescuento'])){
        $descuento = $_SESSION['Ecommerce-ClienteDescuento'];
        }

        $Costo = $Costo-($Costo*($descuento/100));
        $Costo1= (((($Costo/.80)/.6378)/.98)/.80);
        $items = [
          "costo" => bcdiv(($Costo1), '1', 2),
          "costoFabricacion" => bcdiv(($Costo1), '1', 2),
          "precioVentaOptronics" => bcdiv(($Costo1)/0.80, '1', 2)
        ];
        return $this->Tool->Message_return(false, "", $items, $return_json);
      
      }
    } catch (Exception $e) {
      throw $e; 
    }

  }

  public static function controller(){
    try {
      $CablesPrecon = new CablesPreconectorizadosF0();
      $Action = $CablesPrecon->Tool->validate_isset_post('Action');
      switch ($Action) {
        case 'calculo':
          $CablesPrecon->CablesPreconLongitud     = $CablesPrecon->Tool->validNumber('CablesPreconLongitud', 'Longitud', true);
          $CablesPrecon->CablesPreconConA    = $CablesPrecon->Tool->validate_isset_post('CablesPreconConA');
          $CablesPrecon->CablesPreconConB    = $CablesPrecon->Tool->validate_isset_post('CablesPreconConB');
          echo $CablesPrecon->calculo(true);
          break;
        default:
          throw new Exception("No se encontro la opción solicitada, por favor pide ayuda al departamento de TI...");
          break;
      }
    } catch (Exception $e) {
      echo $CablesPrecon->Tool->Message_return(true, $e->getMessage(), null, true);
    }
  }

}

$Tool = new Functions_tools();
# Comprobación Autorización Ajax    
if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_POST['ActionPrecioPreconectorizados'])) { 
  CablesPreconectorizadosF0::controller();
}
unset($Tool);