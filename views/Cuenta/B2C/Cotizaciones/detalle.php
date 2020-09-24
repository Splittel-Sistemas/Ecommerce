<?php
  if (!class_exists('DetalleController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Detalle.Controller.php';
  }if (!class_exists('PedidoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
  }
  $DetalleController = new DetalleController();
  $DetalleController->filter = "WHERE pedidokey = ".$_POST['CotizacionKey']." AND detalle_activo = 'si' ";
  $DetalleController->order = "";
  $Obj = $DetalleController->ListDetallePedido();
?>
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
          $PedidoController = new PedidoController;
          $PedidoController->filter = "WHERE id = ".$_POST['CotizacionKey']." ";
          $PedidoController->order = "";
          $Pedido = $PedidoController->getBy();

          if($Pedido->GetMonedaPago() == 'USD' || empty($Pedido->GetMonedaPago()) || $Pedido->GetMonedaPago() == null){
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
<?php
  unset($DetalleController);
  unset($Obj);
  unset($PedidoController);
  unset($Pedido);