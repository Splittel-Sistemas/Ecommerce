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
class CablesPreconectorizados
{
  private $conn;
  private $Tool;

  public $CablesPreconId;
  public $CablesPreconNumeroHilos;
  public $CablesPreconLongitud;
  public $CablesPreconTipoFibra;

  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }
  /**
   * Obtención precios base por producto
   *
   * @param string $filter condiciones para la consulta SQL
   * @param string $order ordenamiento para la consulta SQL
   * @param boolean $return_json true: Json false: Array
   *
   * @return obj
   */
  public function getPrecioBase($filter, $order, $return_json){
    try {
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM t02_optronics_precio_base ".$filter." ".$order;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $row = $result->fetch_object();
        return $this->Tool->Message_return(false, "Datos obtenidos exitosamente...", $row, $return_json);
      }
    } catch (Exception $e) {
      throw $e;      
    }
  }
  /**
   * Obtención precios base rango por producto
   *
   * @param string $filter condiciones para la consulta SQL
   * @param string $order ordenamiento para la consulta SQL
   * @param boolean $return_json true: Json false: Array
   *
   * @return obj
   */
  public function getPrecioBaseRango($filter, $order, $return_json){
    try {
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM t03_optronics_precio_base_rango ".$filter." ".$order;
       //print_r($SQLSTATEMENT);
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $row = $result->fetch_object();
        return $this->Tool->Message_return(false, "Datos obtenidos exitosamente...", $row, $return_json);
      }
    } catch (Exception $e) {
      throw $e; 
    }
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
      $PrecioBase = $this->getPrecioBase("WHERE t02_f001 = ".$this->CablesPreconId." AND t02_f002 = ".$this->CablesPreconTipoFibra." ", "", false)->records;
      // print_r($PrecioBase);
      $PrecioBaseRango = $this->getPrecioBaseRango("WHERE t03_f001 = ".$this->CablesPreconId." AND t03_f002 = ".$this->CablesPreconTipoFibra." AND ".$this->CablesPreconNumeroHilos." >= t03_f003 AND ".$this->CablesPreconNumeroHilos." <= t03_f004 ", "", false)->records;
      if($PrecioBase && $PrecioBaseRango)  {
        $FactorHilos = $PrecioBase->t02_f003;
        $FactorMetro = $PrecioBase->t02_f004;
        $Precio      = $PrecioBase->t02_f005;
        $Monto = $PrecioBaseRango->t03_f005;
      }else{
        $FactorHilos =0;
        $FactorMetro =0;
        $Precio=0;
        $Monto=0;
      }
      

      
       
     
        if ($this->CablesPreconNumeroHilos == 2 && $this->CablesPreconLongitud == 1) {
          $Costo = $Precio;
        }elseif ($this->CablesPreconNumeroHilos == 2 && $this->CablesPreconLongitud > 1) {
          $Costo = $Precio + (($this->CablesPreconLongitud - 1) * $Monto);
        }elseif ($this->CablesPreconNumeroHilos > 2 && $this->CablesPreconLongitud == 1) {
          $Costo = $Precio + (($this->CablesPreconNumeroHilos - 2) * $FactorHilos);
        }elseif ($this->CablesPreconNumeroHilos > 2 && $this->CablesPreconLongitud > 1) {
          $Costo = $Precio + (($this->CablesPreconNumeroHilos - 2) * $FactorHilos) + (($this->CablesPreconLongitud - 1) * $Monto);
        }else{
          throw new Exception("No se pudo calcular el costo.....");
        }
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
      unset($PrecioBase);
      unset($PrecioBaseRango);
      return $this->Tool->Message_return(false, "", $items, $return_json);
    } catch (Exception $e) {
      throw $e; 
    }
  }

  public static function controller(){
    try {
      $CablesPrecon = new CablesPreconectorizados();
      $Action = $CablesPrecon->Tool->validate_isset_post('Action');
      switch ($Action) {
        case 'calculo':
          $CablesPrecon->CablesPreconId           = $CablesPrecon->Tool->validate_isset_post('CablesPreconId');
          $CablesPrecon->CablesPreconNumeroHilos  = $CablesPrecon->Tool->validNumber('CablesPreconNumeroHilos', 'Número de hilos', true);
          $CablesPrecon->CablesPreconLongitud     = $CablesPrecon->Tool->validNumber('CablesPreconLongitud', 'Longitud', true);
          $CablesPrecon->CablesPreconTipoFibra    = $CablesPrecon->Tool->validate_isset_post('CablesPreconTipoFibra');
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
  CablesPreconectorizados::controller();
}
unset($Tool);