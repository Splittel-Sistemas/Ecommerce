<?php
@session_start();
if (!($_SESSION['Ecommerce-CostoEnvio'] == 0) && $_SESSION['requiereCostoEnvio'] > 0) {
  header('Location: ../Carrito');
}
if ($_SESSION['Ecommerce-PedidoTotal'] <= 0) {
  header('Location: ../Carrito');
} else if (!isset($_SESSION['Ecommerce-ClienteKey'])) {
  $_SESSION['Ecommerce-PedidoPagar'] = true;
  header('Location: ../Login');
} else {
  $_SESSION['Ecommerce-PedidoPagar'] = false;
?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Head.php';

    ?>
    <script>
      history.forward()
      document.onkeydown = function() {

        if (window.event && window.event.keyCode == 116) {

          window.event.keyCode = 505;

        }

        if (window.event && window.event.keyCode == 505) {

          return false;

        }

      }
     
    </script>
  </head>
  <!-- Body-->

  <body>

    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Header.php'; ?>
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
      <div class="row">
        <!-- Checkout Adress-->
        <div class="col-md-12">
          <div class="steps flex-sm-nowrap mb-5">
            <a class="step process active" id="process-1" number="1" onclick="addViewCheckout(this)">
              <h4 class="step-title">1. Datos de envió</h4>
            </a>
            <a class="step process" id="process-2" number="2" onclick="addViewCheckout(this)">
              <h4 class="step-title">2. Paquetería</h4>
            </a>
            <a class="step process" id="process-3" number="3" onclick="addViewCheckout(this)">
              <h4 class="step-title">3. Pago</h4>
            </a>
            <a class="step process" id="process-4" number="4" onclick="addViewCheckout(this)">
              <h4 class="step-title">4. Resumen</h4>
            </a>
          </div>
          <div id="PartialCheckout-1" class="PartialCheckout">
            <?php
            if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
              include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/views/Checkout/B2B/datos_envio.php';
            } else {
              include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/views/Checkout/B2C/datos_envio.php';
            }
            ?>
          </div>
          <div id="PartialCheckout-2" class="PartialCheckout" style="display: none">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/views/Checkout/Paqueteria.php'; ?>
          </div>
          <div id="PartialCheckout-3" class="PartialCheckout" style="display: none">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/views/Checkout/Pago.php'; ?>
          </div>
          <div id="PartialCheckout-4" class="PartialCheckout" style="display: none">
            <?php # include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/Checkout/resumen.php'; 
            ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-datos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body" id="modal-body-datos">

          </div>
        </div>
      </div>
    </div>
    <!-- Modal    data-backdrop="static"     data-keyboard="false"   -->

    <div class="modal fade" id="modal-3d-secure" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">SI CIERRA ESTA VENTANA TENDRA QUE INICIAR EL PROCESO DE NUEVO</h5>

          </div>
          <div class="modal-body" id="modal-body-3d-secure">

          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Scripts.php'; ?>
    <!--  -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/public/scripts/Checkout/Pago/OpenPayConfig.php'; ?>
    <!--  -->
    <script type="text/javascript" src="../../public/scripts/Checkout/index.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Checkout/Datos/B2C/datos_envio.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Checkout/Datos/B2C/datos_facturacion.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Checkout/Datos/B2B/datos_envio.js?id=<?php echo rand() ?>"></script>

    <!-- <script type="text/javascript" src="../../public/plugins/OpenPay/js/jquery.min.js"></script> -->
    <script type="text/javascript" src="../../public/plugins/OpenPay/js/openpay.v1.min.js"></script>
    <script type='text/javascript' src="../../public/plugins/OpenPay/js/openpay-data.v1.min.js"></script>
    <script type="text/javascript" src="../../public/scripts/Checkout/Pago/PagoTarjeta.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Checkout/Pago/Pago3DSecure.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Checkout/Pago/PagoCredito.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Checkout/Pago/PagoBanco.js?id=<?php echo rand() ?>"></script>

  </body>

  </html>
<?php } ?>