<?php
  class Detalle_{
    protected $Connection;
    protected $Tool;

    public $Key;
    public $PedidoKey;
    public $Codigo;
    public $Cantidad;
    public $Descuento;
    public $Subtotal;
    public $SubtotalSinDescuento;
    public $Iva;
    public $Total;
    public $CodigoConfigurable;
    public $Activo;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetKey($Key){
      $this->Key = $Key;
    }public function SetPedidoKey($PedidoKey){
      $this->PedidoKey = $PedidoKey;
    }public function SetCodigo($Codigo){
      if(is_null($Codigo) || empty($Codigo)){
        throw new Exception("Clave no valida");
      }
      $this->Codigo = $Codigo;
    }public function SetCantidad($Cantidad){
      if(is_null($Cantidad) || empty($Cantidad)){
        throw new Exception("Debes agregar la cantidad.");
      }else if(!is_numeric($Cantidad)){
        throw new Exception("Cantidad debe ser numerico.");
      }else if($Cantidad <= 0){
        throw new Exception("Cantidad invalido debe ser mayor a 0.");
      }
      $this->Cantidad = $Cantidad;
    }public function SetDescuento($Descuento){
      $this->Descuento = $Descuento;
    }public function SetSubtotal($Subtotal){
      $this->Subtotal = $Subtotal;
    }public function SetSubtotalSinDescuento($SubtotalSinDescuento){
      $this->SubtotalSinDescuento = $SubtotalSinDescuento;
    }public function SetIva($Iva){
      $this->Iva = $Iva;
    }public function SetTotal($Total){
      $this->Total = $Total;
    }public function SetCodigoConfigurable($CodigoConfigurable){
      $this->CodigoConfigurable = $CodigoConfigurable;
    }public function SetActivo($Activo){
      $this->Activo = $Activo;
    }public function SetCantidadValidacion($CantidadValidacion){
      $this->CantidadValidacion = $CantidadValidacion;
    }

    public function GetKey(){
      return $this->Key;
    }public function GetPedidoKey(){
      return $this->PedidoKey;
    }public function GetCodigo(){
      return $this->Codigo;
    }public function GetCantidad(){
      return $this->Cantidad;
    }public function GetDescuento(){
      return $this->Descuento;
    }public function GetSubtotal(){
      return $this->Subtotal;
    }public function GetSubtotalSinDescuento(){
      return $this->SubtotalSinDescuento;
    }public function GetIva(){
      return $this->Iva;
    }public function GetTotal(){
      return $this->Total;
    }public function GetCodigoConfigurable(){
      return $this->CodigoConfigurable;
    }public function GetActivo(){
      return $this->Activo;
    }

    public function GetByDetallePedido($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_detalle_pedido ".$filter." ".$orderBy;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;
        while ($row = $result->fetch_object()) {
            $this->PedidoKey                     = $row->pedidokey;
            $this->ClienteKey                    = $row->id_cliente;
            $this->PedidoSubtotal                = $row->pedidoSubtotal;
            $this->PedidoIva                     = $row->pedidoIva;
            $this->PedidoTotal                   = $row->pedidoTotal;
            $this->PedidoSubtotalMXN             = $row->pedidoSubtotalMXN;
            $this->PedidoIvaMXN                  = $row->pedidoIvaMXN;
            $this->PedidoTotalMXN                = $row->pedidoTotalMXN;
            $this->PedidoMonedaPago              = $row->moneda_pago;

            $this->DetalleKey                    = $row->detallekey;
            $this->DetalleCodigo                 = $row->detalle_codigo;
            $this->DetalleSubtotal               = $row->detalleSubtotal;
            $this->DetalleSubtotalSinDescuento   = $row->detalleSubtotalSinDescuento;
            $this->DetalleIva                    = $row->detalleIva;
            $this->DetalleTotal                  = $row->detalleTotal;
            $this->DetalleSubtotalMXN            = $row->detalleSubtotalMXN;
            $this->DetalleSubtotalSinDescuentoMXN  = $row->detalleSubtotalSinDescuentoMXN;
            $this->DetalleIvaMXN                 = $row->detalleIvaMXN;
            $this->DetalleTotalMXN               = $row->detalleTotalMXN;
            $this->DetalleCantidad               = $row->cantidad;
            $this->DetalleDescuento              = $row->descuento;
            $this->DetalleCodigoConfigurable     = $row->detalle_code_configurable;
            $this->DetalleActivo                 = $row->detalle_activo;

            $this->ProductoCodigo                = $row->producto_codigo;
            $this->ProductoDescripcion           = $row->desc_producto;
            $this->ProductoDescuento             = $row->descuento_producto;
            $this->ProductoExistencia            = $row->existencia;
            $this->ProductoPrecio                = $row->precio;
            $this->ProductoCodigoConfigurable    = $row->producto_codigo_configurable;
            $this->ProductoImgPrincipal          = $row->img_principal;
            $this->ProductoWarehouseCode         = !empty($row->almacen) ? $row->almacen : 'CEDIS';
            $this->ProductoCategoriaKey          = $row->categoria ;

            $this->ProductoConfigurableNombre    = $row->t17_f003;

            $remates = $this->ProductoCategoriaKey == 'A8' ? true : false;
            $this->Descuento    = !empty($newItem->ProductoDescuento) ? $this->Tool->CalcularDescuento($newItem->ProductoDescuento, $remates) : '';

            $this->TiempoEntrega    = $row->TiempoEntrega;

            $data[] = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function ListDetallePedido($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_detalle_pedido ".$filter." ".$orderBy;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = array();
        while ($row = $result->fetch_object()) {
            $newItem = new Detalle_();
            $newItem->PedidoKey                     = $row->pedidokey;
            $newItem->ClienteKey                    = $row->id_cliente;
            $newItem->PedidoSubtotal                = $row->pedidoSubtotal;
            $newItem->PedidoIva                     = $row->pedidoIva;
            $newItem->PedidoTotal                   = $row->pedidoTotal;
            $newItem->PedidoSubtotalMXN             = $row->pedidoSubtotalMXN;
            $newItem->PedidoIvaMXN                  = $row->pedidoIvaMXN;
            $newItem->PedidoTotalMXN                = $row->pedidoTotalMXN;
            $newItem->PedidoMonedaPago              = $row->moneda_pago;

            $newItem->DetalleKey                    = $row->detallekey;
            $newItem->DetalleCodigo                 = $row->detalle_codigo;
            $newItem->DetalleSubtotal               = $row->detalleSubtotal;
            $newItem->DetalleSubtotalSinDescuento   = $row->detalleSubtotalSinDescuento;
            $newItem->DetallePrecioUnidad           = $row->detallePrecioUnidad;
            $newItem->DetalleIva                    = $row->detalleIva;
            $newItem->DetalleTotal                  = $row->detalleTotal;
            $newItem->DetalleSubtotalMXN            = $row->detalleSubtotalMXN;
            $newItem->DetalleSubtotalSinDescuentoMXN  = $row->detalleSubtotalSinDescuentoMXN;
            $newItem->DetallePrecioUnidadMXN        = $row->detallePrecioUnidadMXN;
            $newItem->DetalleIvaMXN                 = $row->detalleIvaMXN;
            $newItem->DetalleTotalMXN               = $row->detalleTotalMXN;
            $newItem->DetalleCantidad               = $row->cantidad;
            $newItem->DetalleDescuento              = $row->descuento;
            $newItem->DetalleCodigoConfigurable     = $row->detalle_code_configurable;
            $newItem->DetalleActivo                 = $row->detalle_activo;

            $newItem->ProductoCodigo                = $row->producto_codigo;
            $newItem->ProductoDescripcion           = $row->desc_producto;
            $newItem->ProductoDescuento             = $row->descuento_producto;
            $newItem->ProductoExistencia            = $row->existencia;
            $newItem->ProductoPrecio                = $row->precio;
            $newItem->ProductoCodigoConfigurable    = $row->producto_codigo_configurable;
            $newItem->ProductoImgPrincipal          = $row->img_principal;
            $newItem->ProductoCostoEnvio            = $row->costo_envio;
            $newItem->ProductoWarehouseCode         = !empty($row->almacen) ? $row->almacen : 'CEDIS';
            $newItem->ProductoCategoriaKey          = $row->categoria ;

            $newItem->ProductoConfigurableNombre    = $row->t17_f003;
            
            $remates = $newItem->ProductoCategoriaKey == 'A8' ? true : false;
            $newItem->Descuento    = !empty($newItem->ProductoDescuento) ? $this->Tool->CalcularDescuento($newItem->ProductoDescuento, $remates) : '';
            
            $newItem->TiempoEntrega    = $row->TiempoEntrega;

            $data[] = $newItem;
            unset($newItem);
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function ListDetallePedidoPuntos($filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_detalle_pedido_puntos ".$filter." ".$orderBy;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = array();
        while ($row = $result->fetch_object()) {
            $newItem = new Detalle_();
            $newItem->PedidoKey                     = $row->pedidokey;
            $newItem->ClienteKey                    = $row->id_cliente;
            $newItem->PedidoSubtotal                = $row->pedidoSubtotal;
            $newItem->PedidoIva                     = $row->pedidoIva;
            $newItem->PedidoTotal                   = $row->pedidoTotal;
            $newItem->PedidoSubtotalMXN             = $row->pedidoSubtotalMXN;
            $newItem->PedidoIvaMXN                  = $row->pedidoIvaMXN;
            $newItem->PedidoTotalMXN                = $row->pedidoTotalMXN;
            $newItem->PedidoMonedaPago              = $row->moneda_pago;

            $newItem->DetalleKey                    = $row->detallekey;
            $newItem->DetalleCodigo                 = $row->detalle_codigo;
            $newItem->DetalleSubtotal               = $row->detalleSubtotal;
            $newItem->DetalleSubtotalSinDescuento   = $row->detalleSubtotalSinDescuento;
            $newItem->DetallePrecioUnidad           = $row->detallePrecioUnidad;
            $newItem->DetalleIva                    = $row->detalleIva;
            $newItem->DetalleTotal                  = $row->detalleTotal;
            $newItem->DetalleSubtotalMXN            = $row->detalleSubtotalMXN;
            $newItem->DetalleSubtotalSinDescuentoMXN  = $row->detalleSubtotalSinDescuentoMXN;
            $newItem->DetallePrecioUnidadMXN        = $row->detallePrecioUnidadMXN;
            $newItem->DetalleIvaMXN                 = $row->detalleIvaMXN;
            $newItem->DetalleTotalMXN               = $row->detalleTotalMXN;
            $newItem->DetalleCantidad               = $row->cantidad;
            $newItem->DetalleDescuento              = $row->descuento;
            $newItem->DetalleCodigoConfigurable     = $row->detalle_code_configurable;
            $newItem->DetalleActivo                 = $row->detalle_activo;

            $newItem->ProductoCodigo                = $row->producto_codigo;
            $newItem->ProductoDescripcion           = $row->desc_producto;
            $newItem->ProductoPuntos                = $row->puntos;
            $newItem->ProductoPrecio                = $row->precio;
            $newItem->ProductoWarehouseCode         = $row->almacen;

            $data[] = $newItem;
            unset($newItem);
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Top5ProductosMasComprados($fields, $filter, $orderBy){
      try {
        $SQLSTATEMENT = "SELECT ".$fields." FROM cotizacion_detalle ".$filter." ".$orderBy;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];
        while ($row = $result->fetch_object()) {
          $Obj = new stdClass();
          $Obj->Codigo  = $row->codigo;
          $Obj->Total   = $row->total;
          $data[] = $Obj;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Update(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoDetalleActualizar2(
          '".$this->Key."',
          '".$this->PedidoKey."',
          '".$this->Codigo."',
          '".$this->Cantidad."',
          '".$this->Descuento."',
          '". $_SESSION['Ecommerce-ClienteRedondeo']."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Create(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoDetalleAgregarProducto2(
          '".$this->Key."',
          '".$this->PedidoKey."',
          '".$this->Codigo."',
          '".$this->Cantidad."',
          '".$this->Descuento."',
          '".$this->CantidadValidacion."',
          '". $_SESSION['Ecommerce-ClienteRedondeo']."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function CreatePuntos(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoPuntosDetalleAgregarProducto2(
          '".$this->PedidoKey."',
          '".$this->Codigo."',
          '". $_SESSION['Ecommerce-ClienteRedondeo']."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function CreateConfigurable(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoDetalleAgregarProductoConfigurable(
          '".$this->Key."',
          '".$this->PedidoKey."',
          '".$this->Codigo."',
          '".$this->CodigoConfigurable."',
          '".$this->Cantidad."',
          '".$this->Descuento."',
          '".$this->Subtotal."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Delete(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PedidoDetalleDeleteProducto(
          '".$this->Key."',
          '".$this->PedidoKey."',
          '".$this->Codigo."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }
  }