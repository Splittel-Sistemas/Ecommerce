<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Checkout</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Checkout</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
      <div class="card text-center">
        <div class="card-body padding-top-2x">
        <p><img src="../../public/images/img_spl/iconos/close.png" width="200px" height="200px" /></p>
          <h3 class="card-title">&#33;Su orden no se ha generado!</h3>
          <?php 
            @session_start();
            if (!class_exists("ErrorOpenPayController")) {
              include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Logs/ErrorOpenPay.Controller.php';
            }if (!class_exists('OpenPayController')) {
              include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/OpenPay/OpenPay.Controller.php';
            } 
          
            $OpenPayController = new OpenPayController();
            if(isset($_SESSION["Ecommerce-OpenPay-Bank-Id"]) && $_SESSION["Ecommerce-OpenPay-Bank-Id"]!=''){

            $result = $OpenPayController->GetCharge($_SESSION["Ecommerce-OpenPay-Bank-Id"]);

            $ErrorOpenPayController = new ErrorOpenPayController();
            $ErrorOpenPayController->filter = "Where t15_f001 = ".$result->error_code;
            $ErrorOpenPayController->order = "";
            $ErrorOpenPay = $ErrorOpenPayController->GetBy();

            if (!empty($ErrorOpenPay->GetDescription())) {
            ?>
          <p class="card-text"><?php echo $ErrorOpenPay->GetDescription(); ?></p>
          <?php }else{ ?>
          <p class="card-text">Vuelva a intentar de lo contrario favor de contactar a su ejecutivo de ventas.</p>
          <?php } ?>
          <?php } else {?>
            <p class="card-text">Vuelva a intentar de lo contrario favor de contactar a su ejecutivo de ventas.</p>
            <?php } ?>
          <p class="card-text"> 
            <u>Para volver a iniciar su proceso de compra</u>
          </p>
          <div class="padding-top-1x padding-bottom-1x"><a class="btn btn-outline-primary" href="../Checkout/"><i class="icon-cart"></i>&nbsp;Reintentar</a></div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
  </body>
</html>
<?php 
  unset($ErrorOpenPayController);
  unset($ErrorOpenPay);
?>
