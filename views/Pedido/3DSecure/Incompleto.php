<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8">
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" media="screen" href="../../public/plantilla/css/vendor.min.css">
    <!-- Main Template Styles-->
    <link id="mainStyles" rel="stylesheet" media="screen" href="../../public/plantilla/css/styles-BF202F.min.css">
    <link  rel="stylesheet" media="screen" href="../../public/plantilla/customizer/customizer.min.css">
    <link rel="stylesheet" type="text/css" href="../../public/plugins/tingle/tingle.css">
  </head>
  <!-- Body-->
  <body>
    <div class="container padding-bottom-3x mb-2">  
      <div class="card text-center">
        <div class="card-body padding-top-2x">
        <p><img src="../../public/images/img_spl/iconos/close.png" width="200px" height="200px" /></p>
          <h3 class="card-title">&#33;Su orden no se ha generado!</h3>
          <?php 
            if (!class_exists("ErrorOpenPayController")) {
              include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Logs/ErrorOpenPay.Controller.php';
            }
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
          <p class="card-text"> 
            <u>Para volver a iniciar su proceso de compra</u>
          </p>
          <div class="padding-top-1x padding-bottom-1x"><a class="btn btn-outline-primary" onclick="window.parent.location.href='../Checkout'"><i class="icon-cart"></i>&nbsp;Reintentar</a></div>
        </div>
      </div>
    </div>
  </body>
</html>