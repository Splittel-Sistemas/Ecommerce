<!DOCTYPE html>
<html lang="es">

<head>

  <!-- <title> Contacto </title> -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Head.php'; ?>
</head>
<!-- Body-->

<body>
  <!-- Header -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Header.php'; ?>
  <?php
  if (!class_exists("ContactoController")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Contacto/Contacto.Controller.php';
  }
  $ContactoController = new ContactoController();
  $Contacto = $ContactoController->GetBy();
  ?>

  <!-- Page Title-->
  <br>
  <!-- Page Content-->
  <div class="container padding-bottom-3x mb-2">
    <div class="col-xl-12 col-lg-8 order-lg-2">
      <div class="row ">
        <div class="col-1 padding-bottom-1x text-center">
        </div>
        <div class="col-10 padding-bottom-1x text-center">
        <img class="rounded" src="../../public/images/img_spl/ficrece/BannerFibre.jpg">

        </div>

      </div>


      <div class="row">
        <div class="col-1 padding-bottom-1x text-center">
        </div>
        <div class="col-10 padding-bottom-1x text-center">
          <br>
          <p style="text-align: center;" class="padding-top-1x">Tu información ha sido enviada con éxito!
            <br>
            <br>

            Nuestro personal del área de ventas está a tu disposición para aclarar cualquier duda o conocer la respuesta a su solicitud.
          </p>
        </div>

      </div>


    </div>
    <!-- Sidebar          -->

  </div>


  </div>

  </div>



  <!-- Footer -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Footer.php'; ?>
  <!-- scripts JS -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Scripts.php'; ?>
  <!--  -->
  <script type="text/javascript" src="../../public/scripts/Ficrece/index.js?id=<?php echo rand() ?>"></script>
</body>

</html>
<?php
unset($Contacto);
unset($ContactoController);
?>