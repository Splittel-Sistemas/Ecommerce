<?php 

/**
 * 
 */
class Invoice{
  public $OpenPayTransaccionKey;
  public $OfertaVenta;
  public $Invoice;
  public $Pago;
  public $PedidoKey;
  public $RequiereFactura;
  public $Estatus;
  public $Referencia;
  public $Intentos;

  protected $Tool;
  protected $Connection;

  public function SetParameters($conn, $Tool){
    $this->Connection = $conn;
    $this->Tool = $Tool;
  }

  public function SetOpenPayTransaccionKey($OpenPayTransaccionKey){
    $this->OpenPayTransaccionKey = $OpenPayTransaccionKey;
  }public function SetOfertaVenta($OfertaVenta){
    if (is_null($OfertaVenta)) {
      throw new Exception('$OfertaVenta es valido');
    }
    $this->OfertaVenta = $OfertaVenta;
  }public function SetInvoice($Invoice){
    if (is_null($Invoice)) {
      throw new Exception('$Invoice no es valido');
    }
    $this->Invoice = $Invoice;
  }public function SetPago($Pago){
    if (is_null($Pago)) {
      throw new ExceptionPago('$Pago no es valido');
    }
    $this->Pago = $Pago;
  }public function SetPedidoKey($PedidoKey){
    if (is_null($PedidoKey)) {
      throw new Exception('$PedidoKey no es valido');
    }
    $this->PedidoKey = $PedidoKey;
  }public function SetRequiereFactura($RequiereFactura){
    $this->RequiereFactura = $RequiereFactura;
  }public function SetEstatus($Estatus){
    if (is_null($Estatus)) {
      throw new Exception('$Estatus no es valido');
    }
    $this->Estatus = $Estatus;
  }public function SetReferencia($Referencia){
    $this->Referencia = $Referencia;
  }public function SetIntentos($Intentos){
    if (is_null($Intentos)) {
      throw new Exception('$Intentos no es valido');
    }
    $this->Intentos = $Intentos;
  }

  public function GetOpenPayTransaccionKey($OpenPayTransaccionKey){
    return $this->OpenPayTransaccionKey;
  }public function GetOfertaVenta($OfertaVenta){
    return $this->OfertaVenta;
  }public function GetInvoice($Invoice){
    return $this->Invoice;
  }public function GetPago($Pago){
    return $this->Pago;
  }public function GetPedidoKey($PedidoKey){
    return $this->PedidoKey;
  }public function GetRequiereFactura($RequiereFactura){
    return $this->RequiereFactura;
  }public function GetEstatus($Estatus){
    return $this->Estatus;
  }public function GetReferencia($Referencia){
    return $this->Referencia;
  }public function GetIntentos($Intentos){
    return $this->Intentos;
  }

  /**
   * Description
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function ListB2C($filter){
    try {
      $SQLSTATEMENT = "SELECT * FROM t05_factura_b2c ".$filter." ";
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = false;
      while ($row = $result->fetch_object()) {
        $Invoice = new Invoice();
        $Invoice->OpenPayTransaccionKey  = $row->t05_f009;
        $Invoice->OfertaVenta            = $row->t05_f003;
        $Invoice->Invoice                = $row->t05_f004;
        $Invoice->Pago                   = $row->t05_f005;
        $Invoice->PedidoKey              = $row->t05_f006;
        $Invoice->RequiereFactura        = $row->t05_f007;
        $Invoice->Estatus                = $row->t05_f008;
        $Invoice->Referencia             = $row->t05_f010;
        $Invoice->Intentos               = $row->t05_f011;
        $data = $Invoice; 
      }
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }
  /**
   * Description
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function getBy($filter){
    try {
      $SQLSTATEMENT = "SELECT * FROM t05_factura_b2c ".$filter." ";
      $result = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = array();
      while ($row = $result->fetch_object()) {
        $this->OpenPayTransaccionKey  = $row->t05_f009;
        $this->OfertaVenta            = $row->t05_f003;
        $this->Invoice                = $row->t05_f004;
        $this->Pago                   = $row->t05_f005;
        $this->PedidoKey              = $row->t05_f006;
        $this->RequiereFactura        = $row->t05_f007;
        $this->Estatus                = $row->t05_f008;
        $this->Referencia             = $row->t05_f010;
        $this->Intentos               = $row->t05_f011;
        $data = true; 
      }
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }
  /**
   * Description
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function create(){
    try {
      $result = $this->Connection->Exec_store_procedure_json("CALL PedidoB2CCrear(
        '".$this->OpenPayTransaccionKey."',
        '".$this->OfertaVenta."',
        '".$this->Invoice."',
        '".$this->Pago."',
        '".$this->PedidoKey."',
        '".$this->RequiereFactura."',
        '".$this->Estatus."',
        '".$this->Referencia."',
        '".$this->Intentos."',
        @Result
      );", "@Result");
      
      return $result;
    } catch (Exception $e) {
      throw $e;
    }
  }

}