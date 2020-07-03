<?php
  if (!class_exists('PedidoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
  }

  $PedidoController = new PedidoController();
  $PedidoController->filter = "WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND t05_f008 <> 0  ";
  $PedidoController->order = "";
  $ResultPedido = $PedidoController->ListPedidoB2C_();
?>
<div class="table-responsive table-hover mb-0">
      <table class="table cell-border" id="TablePendientesB2C">
          <thead>
            <tr>
              <th class="text-center align-middle">#</th>
              <th class="text-center align-middle">Fecha Creación</th>
              <th class="text-center align-middle">Total</th>
              <th class="text-center align-middle">Moneda de pago</th>
              <th class="text-center align-middle">Estatus</th>
              <th class="text-center align-middle">Detalle</th>
              <th class="text-center align-middle">Ficha pago</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($ResultPedido->records as $Pedido) : ?>
            <tr>
              <td class="text-center align-middle"><?php echo $Pedido->Key; ?></td>
              <td class="text-center align-middle"><?php echo $Pedido->Fecha; ?></td>
              <?php if ($Pedido->MonedaPago == "USD"): ?>
                <td class="text-center align-middle"><?php echo '$'.$Pedido->Total; ?></td>
              <?php else: ?>
                <td class="text-center align-middle"><?php echo '$'.$Pedido->TotalMXP ?></td>
              <?php endif ?>
              <td class="text-center align-middle"><?php echo $Pedido->MonedaPago; ?></td>
              <td class="text-center align-middle">En proceso</td>
              <td class="text-center align-middle" class="text-medium">
                <span class="text-info cursor-point" CotizacionKey="<?php echo $Pedido->Key; ?>" onclick="ClienteB2C_list_detalle_cotizacion(this)">
                  <i class="icon-file-text"></i>
                </span>
              </td>
              <?php 
                  $OpenPay_ = $Pedido->OpenPayResponse;
                  $OpenPayTransaction = $OpenPay_['transaction'];
                  if($OpenPayTransaction['method'] == 'bank_account'){
              ?>
              <td class="text-center align-middle">
                <a class="text-primary" style="text-decoration: none;" target="_blank" href="<?php echo $_SESSION['Ecommerce-OpenPayUrl'].'/spei-pdf/'.$_SESSION['Ecommerce-OpenPayId'].'/'.$OpenPayTransaction['id']; ?>">
                  <i class="icon-download"></i>
                </a>
              </td>
              <?php }else{ ?>
                <td class="text-center align-middle"> - </td>
              <?php } ?>
            </tr>
          <?php endforeach ?>               
          </tbody>
      </table>
  </div>
<?php 
  unset($PedidoController);
?>