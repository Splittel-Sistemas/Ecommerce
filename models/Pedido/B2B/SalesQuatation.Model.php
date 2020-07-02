<?php 

  /**
   * 
   */
  class SalesQuatation_{
    public $OfertaVenta;
    public $OrdenVentaBorrador;
    public $OrdenVenta;
    public $PickingList;
    public $Pago;
    public $PedidoKey;
    public $Estatus;
    public $Referencia;
    public $OpenPayTransaccionKey;
    public $Intentos;
    public $ContactoNombre;
    public $ContactoTelefono;
    public $ContactoCorreo;

    protected $Tool;
    protected $Connection;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetOfertaVenta($OfertaVenta){
      if (is_null($OfertaVenta)) {
        throw new Exception('$OfertaVenta no es valido');
      }
      $this->OfertaVenta = $OfertaVenta;
    }public function SetOrdenVentaBorrador($OrdenVentaBorrador){
      if (is_null($OrdenVentaBorrador)) {
        throw new Exception('$OrdenVentaBorrador no es valido');
      }
      $this->OrdenVentaBorrador = $OrdenVentaBorrador;
    }public function SetOrdenVenta($OrdenVenta){
      if (is_null($OrdenVenta)) {
        throw new Exception('$OrdenVenta no es valido');
      }
      $this->OrdenVenta = $OrdenVenta;
    }public function SetPickingList($PickingList){
      if (is_null($PickingList)) {
        throw new Exception('$PickingList no es valido');
      }
      $this->PickingList = $PickingList;
    }public function SetPago($Pago){
      if (is_null($Pago)) {
        throw new Exception('$Pago no es valido');
      }
      $this->Pago = $Pago;
    }public function SetPedidoKey($PedidoKey){
      if (is_null($PedidoKey)) {
        throw new Exception('$PedidoKey no es valido');
      }
      $this->PedidoKey = $PedidoKey;
    }public function SetEstatus($Estatus){
      if (is_null($Estatus)) {
        throw new Exception('$Estatus no es valido');
      }
      $this->Estatus = $Estatus;
    }public function SetReferencia($Referencia){
      $this->Referencia = $Referencia;
    }public function SetOpenPayTransaccionKey($OpenPayTransaccionKey){
      $this->OpenPayTransaccionKey = $OpenPayTransaccionKey;
    }public function SetIntentos($Intentos){
      if (is_null($Intentos)) {
        throw new Exception('$Intentos no es valido');
      }
      $this->Intentos = $Intentos;
    }public function SetContactoNombre($ContactoNombre){
      if (is_null($ContactoNombre)) {
        throw new Exception('$ContactoNombre no es valido');
      }
      $this->ContactoNombre = $ContactoNombre;
    }public function SetContactoTelefono($ContactoTelefono){
      if (is_null($ContactoTelefono)) {
        throw new Exception('$ContactoTelefono no es valido');
      }
      $this->ContactoTelefono = $ContactoTelefono;
    }public function SetContactoCorreo($ContactoCorreo){
      if (is_null($ContactoCorreo)) {
        throw new Exception('$ContactoCorreo no es valido');
      }
      $this->ContactoCorreo = $ContactoCorreo;
    }

    public function GetOfertaVenta($OfertaVenta){
      return $this->OfertaVenta;
    }public function GetOrdenVentaBorrador($OrdenVentaBorrador){
      return $this->OrdenVentaBorrador;
    }public function GetOrdenVenta($OrdenVenta){
      return $this->OrdenVenta;
    }public function GetPickingList($PickingList){
      return $this->PickingList;
    }public function GetPago($Pago){
      return $this->Pago;
    }public function GetPedidoKey($PedidoKey){
      return $this->PedidoKey;
    }public function GetEstatus($Estatus){
      return $this->Estatus;
    }public function GetReferencia($Referencia){
      return $this->Referencia;
    }public function GetOpenPayTransaccionKey($OpenPayTransaccionKey){
      return $this->OpenPayTransaccionKey;
    }public function GetIntentos($Intentos){
      return $this->Intentos;
    }public function GetContactoNombre($ContactoNombre){
      return $this->ContactoNombre;
    }public function GetContactoTelefono($ContactoTelefono){
      return $this->ContactoTelefono;
    }public function GetContactoCorreo($ContactoCorreo){
      return $this->ContactoCorreo;
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
        $SQLSTATEMENT = "SELECT * FROM t06_b2b ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;
        while ($row = $result->fetch_object()) {
          $this->OfertaVenta            = $row->t06_f001;
          $this->OrdenVentaBorrador     = $row->t06_f002;
          $this->OrdenVenta             = $row->t06_f003;
          $this->PickingList            = $row->t06_f004;
          $this->Pago                   = $row->t06_f009;
          $this->PedidoKey              = $row->t06_f005;
          $this->Estatus                = $row->t06_f006;
          $this->Referencia             = $row->t06_f007;
          $this->OpenPayTransaccionKey  = $row->t06_f008;
          $this->Intentos               = $row->t06_f010;
          $this->ContactoNombre         = $row->t06_f011;
          $this->ContactoTelefono       = $row->t06_f012;
          $this->ContactoCorreo         = $row->t06_f013;
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
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoB2BCrear(
          '".$this->PedidoKey."',
          '".$this->Estatus."',
          '".$this->Referencia."',
          '".$this->OpenPayTransaccionKey."',
          '".$this->Intentos."',
          '".$this->ContactoNombre."',
          '".$this->ContactoTelefono."',
          '".$this->ContactoCorreo."',
          @Result
        );", "@Result");
        return $result;
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
    public function update(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoB2BActualizar(
          ".$this->PedidoKey.",
          '".$this->OfertaVenta."',
          '".$this->OrdenVentaBorrador."',
          '".$this->OrdenVenta."',
          '".$this->PickingList."',
          '".$this->Pago."',
          ".$this->Estatus.",
          ".$this->Intentos.",
          @Result
        );", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }