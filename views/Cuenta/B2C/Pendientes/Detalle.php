<?php
  if (!class_exists('DetalleController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Detalle.Controller.php';
  }if (!class_exists('PedidoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
  }
  $DetalleController = new DetalleController();
  $DetalleController->filter = "WHERE pedidokey = ".$_POST['CotizacionKey']." AND detalle_activo = 'si'";
  $DetalleController->order = "";
  $Obj = $DetalleController->ListDetallePedido();
?>
<div class="accordion" id="accordion2" role="tablist">
  <div class="card">
    <div class="card-header" role="tab">
      <h6><a href="#collapseFour" data-toggle="collapse"><i class="icon-sun"></i>Datos de envío y facturación</a></h6>
    </div>
    <div class="collapse" id="collapseFour" data-parent="#accordion2" role="tabpanel">
      <div class="card-body">
        <div class="row padding-top-1x mt-3">
          <div class="col-sm-3">
            <?php
              $PedidoController = new PedidoController;
              $PedidoController->filter = "WHERE id = ".$_POST['CotizacionKey']." ";
              $PedidoController->order = "";
              $Pedido = $PedidoController->getBy();

              if (!class_exists('DatosEnvioController')) {
                include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cuenta/B2C/DatosEnvio.Controller.php';
              }
              $DatosEnvioController = new DatosEnvioController();
              $DatosEnvioController->filter = "WHERE id = ".$Pedido->GetDatosEnvioKey()." "; 
              $DatosEnvio = $DatosEnvioController->getBy();
            ?>
            <h5>Enviar a:</h5>
            <ul class="list-unstyled">
              <li><span class="text-muted">Ciudad:&nbsp; </span><div id="e_ciudad"><?php echo $DatosEnvio->GetMunicipio() ?></div></li>
              <li><span class="text-muted">Dirección:&nbsp; </span><div id="e_direccion"><?php echo $DatosEnvio->GetCalle().' No Ext. '.$DatosEnvio->GetNumeroExterior().' No Int.'.$DatosEnvio->GetNumeroInterior().' Col. '.$DatosEnvio->GetColonia(); ?></div></li>
              <li><span class="text-muted">Telefono:&nbsp; </span><div id="e_telefono"><?php echo $DatosEnvio->GetCelular(); ?></div></li>
            </ul>
          </div>
          <?php
            if(!empty($Pedido->GetDatosFacturacionKey())){
              if (!class_exists('DatosFacturacionController')) {
                include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cuenta/B2C/DatosFacturacion.Controller.php';
              }
              $DatosFacturacionController = new DatosFacturacionController();
              $DatosFacturacionController->filter = "WHERE id = ".$Pedido->GetDatosFacturacionKey()." ";
              $DatosFacturacion = $DatosFacturacionController->getBy();
          ?>
          <div class="col-sm-3">
             <h5>Facturar a:</h5>
            <ul class="list-unstyled">
              <li><span class="text-muted">RFC:&nbsp; </span><div id="f_rfc"><?php echo $DatosFacturacion->GetRFC(); ?></div></li>
              <li><span class="text-muted">Razón Social:&nbsp; </span><div id="f_razon"><?php echo $DatosFacturacion->GetRazonSocial(); ?></div></li>
              <li><span class="text-muted">Dirección:&nbsp; </span><div id="f_direccion"><?php echo $DatosFacturacion->GetCalle().' No Ext. '.$DatosFacturacion->GetNumeroExterior().' No Int.'.$DatosFacturacion->GetNumeroInterior().' Col. '.$DatosFacturacion->GetColonia(); ?></div></li>
              <li><span class="text-muted">&nbsp; </span><div id="f_tipo"></div></li>
            </ul>
          </div>
          <?php 
              unset($DatosFacturacionController);
              unset($DatosFacturacion);
            } 
          ?> 
          <div class="col-sm-3">
            <h5>Paqueteria:</h5>
            <ul class="list-unstyled">
              <li>
              <span class="text-muted"><div id="aux_paqueteria"><?php echo $Pedido->GetPaqueteria(); ?></div>
              </span>
              </li>
            </ul>
          </div>
          <div class="col-sm-3">
            <h5>Método de pago:</h5>
            <ul class="list-unstyled">
            <div id="aux_metodo_pago">tarjeta</div>
            </ul>
            <h5>Moneda De Facturación:</h5>
            <ul class="list-unstyled">
            <div id="aux_moneda_pago"><?php echo $Pedido->GetMonedaPago(); ?></div>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" role="tab">
      <h6><a class="collapsed" href="#collapseFive" data-toggle="collapse"><i class="icon-lock"></i>Detalle Pedido</a></h6>
    </div>
    <div class="collapse show" id="collapseFive" data-parent="#accordion2" role="tabpanel">
      <div class="card-body">
        <div class="table-responsive-sm">
          <table class="table table-sm table-bordered table-hover text-center" id="TableDetalleB2C">
            <thead class="thead-default">
              <tr>
                <th class="align-middle">#</th>
                <th class="align-middle">Codigo</th>
                <th class="align-middle">Descripción</th>
                <th class="align-middle">Cantidad</th>
                <th class="align-middle">Subtotal</th>
                <th class="align-middle">Iva</th>
                <th class="align-middle">Total</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              foreach ($Obj->records as $key => $data) { 
                $descripcionProducto = !empty($data->ProductoDescripcion) ? $data->ProductoDescripcion : $data->ProductoConfigurableNombre;
            ?>
              <tr>
                <td class="align-middle"><?php echo $key+1; ?></td>
                <td class="align-middle"><?php echo $data->DetalleCodigo; ?></td>
                <td class="align-middle"><?php echo $descripcionProducto; ?></td>
                <td class="align-middle"><?php echo $data->DetalleCantidad; ?></td>
                <?php if ($data->PedidoMonedaPago == 'USD' || empty($data->PedidoMonedaPago)): ?>                
                <td class="align-middle"><?php echo '$'.$data->DetalleSubtotal; ?></td>
                <td class="align-middle"><?php echo '$'.$data->DetalleIva; ?></td>
                <td class="align-middle"><?php echo '$'.$data->DetalleTotal; ?></td>
                <?php else: ?>
                <td class="align-middle"><?php echo '$'.$data->DetalleSubtotalMXN ?></td>
                <td class="align-middle"><?php echo '$'.$data->DetalleIvaMXN ?></td>
                <td class="align-middle"><?php echo '$'.$data->DetalleTotalMXN ?></td>
                <?php endif ?>
              </tr>
            <?php } ?>               
            </tbody>
              <tfoot>
              <?php 
                if($Pedido->GetMonedaPago() == 'USD'){
                  $pedidoSubtotal = $Pedido->GetSubTotal();
                  $pedidoIva = $Pedido->GetIva();
                  $pedidoTotal = $Pedido->GetTotal(); 
                }else{
                  $pedidoSubtotal = $Pedido->GetSubTotalMXN();
                  $pedidoIva = $Pedido->GetIvaMXN();
                  $pedidoTotal = $Pedido->GetTotalMXN(); 
                }
              ?>
              <tr>
                <td class="align-middle font-weight-bold" colspan="4">Total</td>
                <td class="align-middle"><?php echo '$'.$pedidoSubtotal ?></td>
                <td class="align-middle"><?php echo '$'.$pedidoIva ?></td>
                <td class="align-middle"><?php echo '$'.$pedidoTotal ?></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  unset($DetalleController);
  unset($Obj);
  unset($PedidoController);
  unset($Pedido);
  unset($DatosEnvioController);
  unset($DatosEnvio);