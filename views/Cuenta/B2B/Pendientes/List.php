<?php
  if (!class_exists('PedidoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
  }if (!class_exists('PedidoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
  }

  $PedidoController = new PedidoController();
  $PedidoController->filter = "WHERE t06_f006 <> 0 AND id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." ";
  $PedidoController->order = "";
  $ResultPedido = $PedidoController->GetPedidoB2B();
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
              <th class="text-center align-middle">Ficha Pago</th>
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
              <td class="text-center align-middle">
                <span class="text-info cursor-point" CotizacionKey="<?php echo $Pedido->Key; ?>" onclick="ClienteB2B_list_detalle_cotizacion(this)">
                  <i class="icon-file-text"></i>
                </span>
              </td>
              <?php 
                $Pedido_ = $PedidoController->ListInfoPagoBanco_($Pedido->Key);
                if($Pedido_->count > 0){
                  $Pedido_ = $Pedido_->records[0];
                
                  $OpenPay_ = $Pedido_->OpenPayResponse;
                  $OpenPayTransaction = $OpenPay_['transaction'];
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