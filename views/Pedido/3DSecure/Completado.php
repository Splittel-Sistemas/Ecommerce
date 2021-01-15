<?php 
  if (!class_exists('OpenPayController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/OpenPay/OpenPay.Controller.php';
  }

  try {
    $OpenPayController = new OpenPayController();
    $OpenPayController->Pago3DSecureSuccess($_GET['id']);
  } catch (Exception $e) {
    throw $e;
  }
  
?>
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
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">	
      <?php $link = $_SESSION['Ecommerce-ClienteTipo'] == 'B2B' ? '../Cuenta/index.php?menu=4' : '../Cuenta/index.php?menu=4'; ?>
      <div class="card text-center">
        <div class="card-body padding-top-2x">
        <p><img src="../../public/images/img_spl/iconos/check.jpg" width="200px" height="200px" /></p>
          <h3 class="card-title">¡Gracias por su orden!</h3>          
          <p class="card-text">Su pedido se ha realizado y se procesará lo antes posible.</p>
          <p class="card-text"> 
            <u>Para ver los detalles de su compra:</u>
          </p>
          <div class="padding-top-1x padding-bottom-1x" id="verificar-pago-3d-secure" IdTransaccion="<?php echo $_GET['id'] ?>">
            <a class="btn btn-outline-primary" onclick="window.parent.location.href='<?php echo $link ?>'"><i class="icon-user"></i>&nbsp;Ir a mi cuenta</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>


