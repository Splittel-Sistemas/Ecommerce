<div class="card text-center">
  <div class="card-body padding-top-2x">
  <p><img src="../../public/images/img_spl/iconos/close.png" width="200px" height="200px" /></p>
    <h3 class="card-title">&#33;Su orden no se ha generado!</h3>
    <?php 
      if (!class_exists("ErrorOpenPayController")) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Logs/ErrorOpenPay.Controller.php';
      }

      $ErrorOpenPayController = new ErrorOpenPayController();
      $ErrorOpenPayController->filter = "WHERE t16_f005 = ".$_SESSION['Ecommerce-PedidoKey']." ";
      $ErrorOpenPayController->order = "ORDER BY t16_pk01 DESC LIMIT 1";
      $ErrorOpenPay = $ErrorOpenPayController->GetBy();

      if ($ErrorOpenPay) {
      ?>
    <p class="card-text"><?php echo $ErrorOpenPay->GetDescription(); ?></p>
    <?php }else{ ?>
    <p class="card-text">Vuelva a intentar de lo contrario favor de contactar a su ejecutivo de ventas.</p>
    <?php } ?>
    <p class="card-text"> 
      <u>Para volver a iniciar su proceso de compra</u>
    </p>
    <div class="padding-top-1x padding-bottom-1x"><a class="btn btn-outline-primary" onclick="ViewCheckout()"><i class="icon-cart"></i>&nbsp;Reintentar</a></div>
  </div>
</div>

<script>
  var ViewCheckout = function(Elem){
    window.parent.location.href = "../../Checkout"
  } 
</script>