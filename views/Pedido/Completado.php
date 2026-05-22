<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <title> Contacto </title> -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Head.php'; ?>

  <style>
    /* Fondo de carga */
    #cargando-ficha {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #ffffff5e;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }
  </style>
</head>
<!-- Body-->

<body>
  <div class="card text-center" id="cargando-ficha">
    <div class="card-body" style="padding-top: 250px;">
      <p><img src="../../public/images/Otros/loading.gif" width="200px" height="200px" /></p>
      <h3 class="card-title">¡Cargando!</h3>
      <p class="card-text">Se esta generando la ficha de pago, por favor espere un momento.</p>
    </div>
  </div>

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
    <!-- Principal -->
    <?php
    unset($_SESSION["Ecommerce-OpenPay-3DSecure-Id"]);
    if (isset($_GET['method']) && $_GET['method'] == 'bank') {
      include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/views/Pedido/Banco/index.php';
    } else {
      include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/views/Pedido/Tarjeta/index.php';
    }
    ?>
  </div>

  <script>
    document.getElementById('cargando-ficha').remove();
  </script>

  <!-- Footer -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Footer.php'; ?>
  <!-- scripts JS -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Scripts.php'; ?>
</body>

</html>