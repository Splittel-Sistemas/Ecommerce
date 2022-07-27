<?php
  class Pedido_{

    protected $Connection;
    protected $Tool;
    
    public $Key;
    public $ClienteKey;
    public $SubTotal;
    public $Iva;
    public $Total;
    public $PedidoSubtotalMXN;
    public $PedidoIvaMXN;
    public $PedidoTotalMXN;
    public $Envio;
    public $Fecha;
    public $FechaMas10Dias;
    public $Activo;
    public $Estatus;
    public $MetodoPago;
    public $MonedaPago;
    public $DatosEnvioKey;
    public $DatosFacturacionKey;
    public $Numeroguia;
    public $Paqueteria;
    public $TipoCambio;
    public $DiasExtraCredito;
    public $CFDIUser;
    public $NumeroGuiaEstatus;
    public $NombrePaqueteria;
    public $EnvioCorreo;
    public $EmailEjecutivo;
    
    public function SetParameters($conn, $Tool){
        $this->Connection = $conn;
        $this->Tool = $Tool;
    }
    public function SetKey($Key){
      if(!is_numeric($Key)){
        throw new Exception('$Key debería de ser int');
      }
      $this->Key = $Key;
    }public function SetClienteKey($ClienteKey){
      if(!is_numeric($ClienteKey)){
        throw new Exception('$ClienteKey debería de ser int, valor recibido : '.$ClienteKey);
      }
      $this->ClienteKey = $ClienteKey;
    }public function SetSubTotal($SubTotal){
      if(!is_numeric($SubTotal)){
        throw new Exception('$SubTotal debería de ser int');
      }
      $this->SubTotal = $SubTotal;
    }public function SetIva($Iva){
      if(!is_numeric($Iva)){
        throw new Exception('$Iva debería de ser int');
      }
      $this->Iva = $Iva;
    }public function SetTotal($Total){
      if(!is_numeric($Total)){
        throw new Exception('$Key debería de ser int');
      }
      $this->Total = $Total;
    }public function SetEnvio($Envio){
      $this->Envio = $Envio;
    }public function SetMetodoPago($MetodoPago){
      $this->MetodoPago = $MetodoPago;
    }public function SetMonedaPago($MonedaPago){
      $this->MonedaPago = $MonedaPago;
    }public function SetDatosEnvioKey($DatosEnvioKey){
      if(is_null($DatosEnvioKey)){
          throw new Exception('$DatosEnvioKey no puede ser nulo');
      }
      $this->DatosEnvioKey = $DatosEnvioKey;
    }public function SetDatosFacturacionKey($DatosFacturacionKey){
      $this->DatosFacturacionKey = $DatosFacturacionKey;
    }public function SetNumeroguia($Numeroguia){
      $this->Numeroguia = $Numeroguia;
    }public function SetPaqueteria($Paqueteria){
      $this->Paqueteria = $Paqueteria;
    }public function SetTipoCambio($TipoCambio){
      if(!is_numeric($TipoCambio)){
        throw new Exception('No hay tipo de cambio, por favor recarga la pagina');
      }
      $this->TipoCambio = $TipoCambio;
    }public function SetDiasExtraCredito($DiasExtraCredito){
      if(!is_numeric($DiasExtraCredito)){
        throw new Exception('$DiasExtraCredito debería de ser int');
      }
      $this->DiasExtraCredito = $DiasExtraCredito;
    }public function SetCFDIUser($CFDIUser){
      $this->CFDIUser = $CFDIUser;
    }public function SetEstatus($Estatus){
      $this->Estatus = $Estatus;
    }public function SetNumeroGuiaEstatus($NumeroGuiaEstatus){
      $this->NumeroGuiaEstatus = $NumeroGuiaEstatus;
    }public function SetNombrePaqueteria($NombrePaqueteria){
      $this->NombrePaqueteria = $NombrePaqueteria;
    }public function SetFechaRecibido($FechaRecibido){
      $this->FechaRecibido = $FechaRecibido;
    }public function SetRecibio($Recibio){
      $this->Recibio = $Recibio;
    }public function SetEstatusPuntos($EstatusPuntos){
      $this->EstatusPuntos = $EstatusPuntos;
    }public function SetTipoPedido($TipoPedido){
      $this->TipoPedido = $TipoPedido;
    }public function SetEnvioCorreo($EnvioCorreo){
      $this->EnvioCorreo = $EnvioCorreo;
    }

    public function GetKey(){
      return $this->Key;
    }public function GetCliente(){
      return $this->Cliente;
    }public function GetSubTotal(){
      return $this->SubTotal;
    }public function GetIva(){
      return $this->Iva;
    }public function GetTotal(){
      return $this->Total;
    }public function GetSubTotalMXN(){
      return $this->SubtotalMXN;
    }public function GetIvaMXN(){
      return $this->IvaMXN;
    }public function GetTotalMXN(){
      return $this->TotalMXN;
    }public function GetEnvio(){
      return $this->Envio;
    }public function GetFecha(){
      return $this->Fecha;
    }public function GetFechaMas10Dias(){
      return $this->FechaMas10Dias;
    }public function GetMonedaPago(){
      return $this->MonedaPago;
    }public function GetStatus(){
      return $this->Status;
    }public function GetNumeroguia(){
      return $this->Numeroguia;
    }public function GetDatosEnvioKey(){
      return $this->DatosEnvioKey;
    }public function GetDatosFacturacionKey(){
      return $this->DatosFacturacionKey;
    }public function GetPaqueteria(){
      return $this->Paqueteria;
    }public function GetEnvioCorreo(){
      return $this->EnvioCorreo;
    }

    public function Add(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoCrear(
          null,
          '".$this->ClienteKey."',
          '".$this->SubTotal."',
          '".$this->Iva."',
          '".$this->Total."',
          '".$this->TipoCambio."',
          '".$this->DiasExtraCredito."',
          'C',
          'si',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function Update(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoActualizar(
          '".$this->Key."',
          '".$this->ClienteKey."',
          '".$this->SubTotal."',
          '".$this->Iva."',
          '".$this->Total."',
          'si',
          '".$this->Estatus."',
          '".$this->MetodoPago."',
          '".$this->MonedaPago."',
          '".$this->DatosEnvioKey."',
          '".$this->DatosFacturacionKey."',
          '".$this->Numeroguia."',
          '".$this->Paqueteria."',
          '".$this->TipoCambio."',
          '".$this->DiasExtraCredito."',
          '".$this->CFDIUser."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function Update3DSecure(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoActualizar(
          '".$this->Key."',
          '".$this->ClienteKey."',
          '".$this->SubTotal."',
          '".$this->Iva."',
          '".$this->Total."',
          'si',
          '".$this->Estatus."',
          '".$this->MetodoPago."',
          '".$this->MonedaPago."',
          '".$this->DatosEnvioKey."',
          '".$this->DatosFacturacionKey."',
          '".$this->Numeroguia."',
          '".$this->Paqueteria."',
          '".$this->TipoCambio."',
          '".$this->DiasExtraCredito."',
          '".$this->CFDIUser."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function UpdateStatusPackageDelivered($filter){
      try {
        $SQLSTATEMENT = "UPDATE cotizacion_encabezado SET estatus_recibio_paquete = 1 ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function UpdateCliente($filter){
      try {
        $SQLSTATEMENT = "UPDATE cotizacion_encabezado SET id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function UpdateTipoCambio(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoTipoCambioActualizar(
          '".$this->Key."',
          '".$this->TipoCambio."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function UpdateCostoEnvio(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoCostoEnvioActualizar(
          '".$this->Key."',
          '".$this->Envio."',
          '".$this->DatosEnvioKey."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function CreatePedido(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoCrear(
          '".$this->TipoCambio."',
          '".$this->DiasExtraCredito."',
          '".$this->ClienteKey."',
          '".$_SERVER['REMOTE_ADDR']."',
          '".$this->TipoPedido."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function PedidoAgregarNumeroGuia(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoAgregarNumeroGuia(
          '".$this->Key."',
          '".$this->Numeroguia."',
          '".$this->NombrePaqueteria."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
    public function PedidoActualizarEstatusNumeroGuia(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoActualizarEstatusNumeroGuia(
          '".$this->Key."',
          '".$this->Numeroguia."',
          '".$this->NumeroGuiaEstatus."',
          '".$this->FechaRecibido."',
          '".$this->Recibio."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function PedidoLineaCredito(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoLineaCredito(
          '".$this->Key."',
          '".$this->TipoCambio."',
          '".$this->DiasExtraCredito."',
          '1',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function PedidoUpdateEstatusPuntosPagoCredito(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoUpdateEstatusPuntosPagoCredito(
          '".$this->Key."',
          '".$this->EstatusPuntos."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function ActualizarEstatusEnvioCorreo(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoActualizarEstatusEnvioCorreo(
          ".$this->Key.",
          ".$this->EnvioCorreo.",
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
    /**
     * Listar Pedido 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function GetBy($filter){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_pedido ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->Key                    =   $row->id;
          $this->ClienteKey             =   $row->id_cliente;
          $this->SubTotal               =   $row->subtotal;
          $this->Iva                    =   $row->iva;
          $this->Total                  =   $row->total;
          $this->SubtotalMXN            =   $row->pedidoSubtotalMXN;
          $this->IvaMXN                 =   $row->pedidoIvaMXN;
          $this->TotalMXN               =   $row->pedidoTotalMXN;
          $this->Envio                  =   $row->envio;
          $this->Fecha                  =   $row->fecha;
          $this->FechaMas10Dias         =   $row->fecha_mas10dias;
          $this->MetodoPago             =   $row->metodo_pago;
          $this->MonedaPago             =   $row->moneda_pago;
          $this->DatosEnvioKey          =   $row->datos_envio;
          $this->DatosFacturacionKey    =   $row->datos_facturacion;
          $this->Numeroguia             =   $row->numero_guia;
          $this->Paqueteria             =   $row->paqueteria;
          $this->TipoCambio             =   $row->tipoCambio;
          $this->DiasExtraCredito       =   $row->DiasExtraCredito;
          $this->CFDIUser               =   $row->CFDIUser;
          $this->Estatus                =   $row->estatus;
          $this->Activo                 =   $row->activo; 
          $this->NumeroGuiaEstatus      =   $row->numero_guia_estatus; 
          $this->NombrePaqueteria       =   $row->nombre_paqueteria; 
          $this->FechaRecibido          =   $row->fecha_recibio_paquete; 
          $this->Recibio                =   $row->recibio; 
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
    /**
     * Listar pedidos
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function Get($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_pedido ".$filter." ".$orderBy;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = array();
        while ($row = $result->fetch_object()) {
          $newPedido = new Pedido_();
          $newPedido->Key                    =   $row->id;
          $newPedido->ClienteKey             =   $row->id_cliente;
          $newPedido->SubTotal               =   $row->subtotal;
          $newPedido->Iva                    =   $row->iva;
          $newPedido->Total                  =   $row->total;
          $newPedido->SubtotalMXN            =   $row->pedidoSubtotalMXN;
          $newPedido->IvaMXN                 =   $row->pedidoIvaMXN;
          $newPedido->TotalMXN               =   $row->pedidoTotalMXN;
          $newPedido->MetodoPago             =   $row->metodo_pago;
          $newPedido->MonedaPago             =   $row->moneda_pago;
          $newPedido->DatosEnvioKey          =   $row->datos_envio;
          $newPedido->DatosFacturacionKey    =   $row->datos_facturacion;
          $newPedido->Numeroguia             =   $row->numero_guia;
          $newPedido->Paqueteria             =   $row->paqueteria;
          $newPedido->TipoCambio             =   $row->tipoCambio;
          $newPedido->DiasExtraCredito       =   $row->DiasExtraCredito;
          $newPedido->CFDIUser               =   $row->CFDIUser;
          $newPedido->Estatus                =   $row->estatus;
          $newPedido->Activo                 =   $row->activo; 
          $newPedido->Fecha                  =   $row->fecha; 
          $newPedido->NumeroGuiaEstatus      =   $row->numero_guia_estatus; 
          $newPedido->NombrePaqueteria       =   $row->nombre_paqueteria; 
          $newPedido->FechaRecibido          =   $row->fecha_recibio_paquete; 
          $newPedido->Recibio                =   $row->recibio;
          $newPedido->EnvioCorreo            =   $row->envio_correo;
          $data[] = $newPedido;
          unset($newPedido);
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
    /**
     * Listar Pedidos B2B
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function GetPedidoB2B($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_pedido_b2b_ ".$filter." ".$orderBy;
        //echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = array();
        while ($row = $result->fetch_object()) {
          $newPedido = new Pedido_();
          $newPedido->Key                   = $row->id; 
          $newPedido->ClienteKey            = $row->id_cliente; 
          $newPedido->SubTotal              = $row->subtotal; 
          $newPedido->Iva                   = $row->iva; 
          $newPedido->Total                 = $row->total; 
          $newPedido->SubTotalMXP           = $row->pedidoSubtotalMXN; 
          $newPedido->IvaMXP                = $row->pedidoIvaMXN; 
          $newPedido->TotalMXP              = $row->pedidoTotalMXN;
          $newPedido->Fecha                 = $row->fecha;
          $newPedido->MetodoPago            = $row->metodo_pago; 
          $newPedido->MonedaPago            = $row->moneda_pago; 
          $newPedido->DatosEnvioKey         = $row->datos_envio; 
          $newPedido->DatosFacturacionKey   = $row->datos_facturacion; 
          $newPedido->Numeroguia            = $row->numero_guia; 
          $newPedido->Paqueteria            = $row->paqueteria; 
          $newPedido->TipoCambio            = $row->tipo_cambio; 
          $newPedido->DiasExtraCredito      = $row->dias_extra_credito; 
          $newPedido->CFDIUser              = $row->CFDI_user; 
          $newPedido->Estatus               = $row->estatus; 
          $newPedido->Activo                = $row->activo; 
          $newPedido->EstatusB2B            = $row->t06_f006; 
          $newPedido->Referencia            = $row->t06_f007; 
          $newPedido->OpenPayTransaccionKey = $row->t06_f008; 
          $newPedido->Intentos              = $row->t06_f010; 
          $newPedido->ContactoNombre        = $row->t06_f011; 
          $newPedido->ContactoTelefono      = $row->t06_f012; 
          $newPedido->ContactoCorreo        = $row->t06_f013; 
          $data[] = $newPedido;
          unset($newPedido);
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
    /**
     * Listar Pedidos B2B transferencia
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function ListPedidoB2B($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_pedido_b2b ".$filter." ".$orderBy;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = array();
        while ($row = $result->fetch_object()) {
          $newPedido = new Pedido_();
          $newPedido->Key                   = $row->id; 
          $newPedido->ClienteKey            = $row->id_cliente; 
          $newPedido->SubTotal              = $row->subtotal; 
          $newPedido->Iva                   = $row->iva; 
          $newPedido->Total                 = $row->total; 
          $newPedido->SubTotalMXP           = $row->pedidoSubtotalMXN; 
          $newPedido->IvaMXP                = $row->pedidoIvaMXN; 
          $newPedido->TotalMXP              = $row->pedidoTotalMXN;
          $newPedido->Fecha                 = $row->fecha;
          $newPedido->MetodoPago            = $row->metodo_pago; 
          $newPedido->MonedaPago            = $row->moneda_pago; 
          $newPedido->DatosEnvioKey         = $row->datos_envio; 
          $newPedido->DatosFacturacionKey   = $row->datos_facturacion; 
          $newPedido->Numeroguia            = $row->numero_guia; 
          $newPedido->Paqueteria            = $row->paqueteria; 
          $newPedido->TipoCambio            = $row->tipo_cambio; 
          $newPedido->DiasExtraCredito      = $row->dias_extra_credito; 
          $newPedido->CFDIUser              = $row->CFDI_user; 
          $newPedido->Estatus               = $row->estatus; 
          $newPedido->Activo                = $row->activo; 
          $newPedido->EstatusB2B            = $row->t06_f006; 
          $newPedido->Referencia            = $row->t06_f007; 
          $newPedido->OpenPayTransaccionKey = $row->t06_f008; 
          $newPedido->Intentos              = $row->t06_f010; 
          $newPedido->ContactoNombre        = $row->t06_f011; 
          $newPedido->ContactoTelefono      = $row->t06_f012; 
          $newPedido->ContactoCorreo        = $row->t06_f013; 
          $newPedido->OpenPayResponse       = json_decode($row->t12_f005, JSON_UNESCAPED_UNICODE); 
          $data[] = $newPedido;
          unset($newPedido);
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
    /**
     * Listar Pedidos B2C
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function ListPedidoB2C($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_pedido_b2c ".$filter." ".$orderBy;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = array();
        while ($row = $result->fetch_object()) {
          $newPedido = new Pedido_();
          $newPedido->Key                   = $row->id; 
          $newPedido->ClienteKey            = $row->id_cliente; 
          $newPedido->SubTotal              = $row->subtotal; 
          $newPedido->Iva                   = $row->iva; 
          $newPedido->Total                 = $row->total;
          $newPedido->SubTotalMXP           = $row->pedidoSubtotalMXN; 
          $newPedido->IvaMXP                = $row->pedidoIvaMXN; 
          $newPedido->TotalMXP              = $row->pedidoTotalMXN; 
          $newPedido->Fecha                 = $row->fecha; 
          $newPedido->MetodoPago            = $row->metodo_pago; 
          $newPedido->MonedaPago            = $row->moneda_pago; 
          $newPedido->DatosEnvioKey         = $row->datos_envio; 
          $newPedido->DatosFacturacionKey   = $row->datos_facturacion; 
          $newPedido->Numeroguia            = $row->numero_guia; 
          $newPedido->Paqueteria            = $row->paqueteria; 
          $newPedido->TipoCambio            = $row->tipo_cambio; 
          $newPedido->DiasExtraCredito      = $row->dias_extra_credito; 
          $newPedido->CFDIUser              = $row->CFDI_user; 
          $newPedido->Estatus               = $row->estatus; 
          $newPedido->Activo                = $row->activo;
          $newPedido->NumeroGuiaEstatus     = $row->numero_guia_estatus; 
          $newPedido->NombrePaqueteria      = $row->nombre_paqueteria; 
          $newPedido->FacturaKey            = $row->t05_f005; 
          $newPedido->RequiereFactura       = $row->t05_f007; 
          $newPedido->EstatusB2C            = $row->t05_f008; 
          $newPedido->OpenPayTransaccionKey = $row->t05_f009; 
          $newPedido->Referencia            = $row->t05_f010; 
          $newPedido->Intentos              = $row->t05_f011; 
          $newPedido->OpenPayResponse       = json_decode($row->t12_f005, JSON_UNESCAPED_UNICODE); 
          $data[] = $newPedido;
          unset($newPedido);
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
    public function GetInfoPagoBanco($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_informacion_pago_banco_progreso ".$filter." ".$orderBy;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = array();
        while ($row = $result->fetch_object()) {
          $newPedido = new Pedido_();
          $newPedido->Key                   = $row->id; 
          $newPedido->ClienteKey            = $row->id_cliente; 
          $newPedido->SubTotal              = $row->subtotal; 
          $newPedido->Iva                   = $row->iva; 
          $newPedido->Total                 = $row->total; 
          $newPedido->OpenPayResponse       = json_decode($row->t12_f005, JSON_UNESCAPED_UNICODE); 
          $data[] = $newPedido;
          unset($newPedido);
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
     /**
     * Listar Pedidos B2B transferencia
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function ListPedidoPagoBanco($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_pedido_pago_banco_completo ".$filter." ".$orderBy;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = array();
        while ($row = $result->fetch_object()) {
          $newPedido = new Pedido_();
          $newPedido->Key    = $row->pedidokey; 
          $newPedido->Correo = $row->email; 
          $newPedido->CorreoEjecutivo = $row->emailejecutivo; 
          $data[] = $newPedido;
          unset($newPedido);
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
     /**
     * Listar Pedido 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function GetTotalPuntos($fields, $filter){
      try {
        $SQLSTATEMENT = "SELECT ".$fields." FROM listar_pedido ".$filter." ";
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->ClienteKey             =   $row->id_cliente;
          $this->SubTotal               =   $row->subtotalbycliente;
          $this->PuntosTotal            =   $row->totalpuntosbycliente;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    /**
     * Listar Pedido 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function GetTotalPuntosCanjeados($fields, $filter){
      try {
        $SQLSTATEMENT = "SELECT ".$fields." FROM listar_puntos_canjeados ".$filter." ";
        // echo $SQLSTATEMENT; 
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->ClienteKey             =   $row->clientekey;
          $this->PuntosTotal            =   $row->totalpuntos;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }
  }