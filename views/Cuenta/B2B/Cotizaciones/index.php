<?php 
  @session_start();
  if(isset($_SESSION['Ecommerce-ClienteKey']))
  {
    if (!class_exists('PedidoController')) {
      include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
    }
    $PedidoController = new PedidoController();
    $PedidoController->filter = "WHERE estatus = 'C' AND total > 0 AND fecha >= DATE_SUB(CURDATE(), INTERVAL 15 DAY) AND id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." ";
    $PedidoController->order = "";
    $ResultPedido = $PedidoController->get();
?>
<div class="table-responsive table-hover mb-0">
  <table class="table cell-border" id="table-cotizaciones">
    <thead>
      <tr>
        <th  class="text-center">#</th>
        <th  class="text-center">Fecha creación</th>
        <th  class="text-center">Total</th>
        <th  class="text-center">Pedido detalle</th>
        <th  class="text-center">Carrito</th>
        <th  class="text-center">Cotización</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($ResultPedido->records as $key => $PedidoDetalle) { ?>
      <tr>
        <td  class="text-center"><?php echo $PedidoDetalle->Key; ?></td>
        <td  class="text-center"><?php echo date("d-m-Y",strtotime($PedidoDetalle->Fecha)); ?></td>
        <td  class="text-center"><?php echo '$'.$PedidoDetalle->Total; ?></td>
        <td class="text-center">
          <span class="text-info cursor-point" CotizacionKey="<?php echo $PedidoDetalle->Key; ?>" onclick="PedidoDetalleB2B(this)">
            <i class="icon-file-text"></i>
          </span>
        </td>
        <td class="text-center">
          <span class="text-danger cursor-point" PedidoKey="<?php echo   base64_encode($PedidoDetalle->Key); ?>" onclick="cuentaCotizacion(this)">
            <i class="icon-shopping-cart"></i>
          </span>
        </td>
        <td class="text-center">
          <a class="text-danger cursor-point" target="_blank" href="../../models/Pedido/Pedido.PDF.php?pedidokey=<?php echo $PedidoDetalle->Key; ?>">
            <i class="icon-file"></i>
          </a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<div class="modal fade" id="Pedido-Detalle-B2B">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Pedido Detalle</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
      </div>
      <div class="modal-body" id="Pedido-Detalle-B2B-body">

      </div>
    </div>
  </div>
</div>
<?php
  }else{
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/SessionExpired.php';
  }
?>