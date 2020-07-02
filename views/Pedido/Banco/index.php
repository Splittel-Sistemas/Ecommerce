<?php 
  if (!class_exists('PedidoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Pedido.Controller.php';
  }
  $PedidoController = new PedidoController;
  $Pedido = $PedidoController->ListInfoPagoBanco();
  $Pedido->count;
  $Pedido = $Pedido->records[0];

  $OpenPay_ = $Pedido->OpenPayResponse;
  $OpenPayTransaction = $OpenPay_['transaction'];

  $link = $_SESSION['Ecommerce-ClienteTipo'] == 'B2B' ? '../Cuenta/index.php?menu=4' : '../Cuenta/index.php?menu=3';
?>
<div class="card text-center">
  <div class="card-body padding-top-2x">
  <p><img src="../../public/images/img_spl/iconos/check.jpg" width="200px" height="200px" /></p>
    <h3 class="card-title">¡Gracias por su orden!</h3>          
    <p class="card-text">Su pedido se ha realizado y se procesará una vez que realice su pago correspondiente.</p>
    <p class="card-text"> 
      <u>Para ver los detalles de su compra:</u>
    </p>
    <div class="padding-top-1x padding-bottom-1x">
      <a class="btn btn-outline-primary" href="<?php echo $link ?>"><i class="icon-user"></i>&nbsp;Ir a mi cuenta</a>
      <a class="btn btn-outline-info" target="_blank" href="<?php echo $_SESSION['Ecommerce-OpenPayUrl'].'/spei-pdf/'.$_SESSION['Ecommerce-OpenPayId'].'/'.$OpenPayTransaction['id']; ?>">
        <i class="icon-file"></i>&nbsp;Ficha de pago
      </a>
    </div>
  </div>
</div>
<?php 
  unset($PedidController);
  unset($Pedido);
  unset($OpenPay_);
  unset($OpenPayTransaction);
?>