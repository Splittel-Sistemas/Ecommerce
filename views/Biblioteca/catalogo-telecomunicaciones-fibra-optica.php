<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <title> Contacto </title> -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Head.php'; ?>

</head>
<!-- Body-->

<body>
  <!-- Header -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Header.php'; ?>
  <?php
  if (!class_exists("Catalogo")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Biblioteca/Catalogo/Catalogo.php';
  }
  if (!class_exists("Historia")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Biblioteca/Catalogo/Historia.php';
  }

  ?>
  <!-- Page Title-->
  <!--  <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>SOLUCIONES FIBREMEX</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li></li>
          </ul>
        </div>
      </div>
    </div> -->
  <!-- Page Content-->
  <br>
  <div class="container padding-bottom-2x mb-2">
    <div class="row justify-content-center">
      <!-- Content-->
      <div class="col-xl-12 col-lg-12 order-lg-12">
        <!-- Post Meta-->
        <iframe src="https://publicaciones.fibremex.com/catalogo-telecomunicaciones-fibremex/page/1" width="820" height="620" style="border:none;" allowfullscreen></iframe>
          
      </div>
      <div class="col-xl-12 col-lg-12 order-lg-12 padding-top-1x d-flex justify-content-center align-items-center">
          <div class="col-xl-3 col-lg-3 order-lg-3 text-center">
            <a download="Catalogo FMX.pdf" href="../../public/images/img_spl/catalogo/Catalogo FMX.pdf"  style="background-color: #bc2130" class="btn btn-primary btn-block m-0">
              Descarga el catálogo</a>
          </div>
        </div>
    </div>
  </div>

  <!-- Footer -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Footer.php'; ?>
  <!-- scripts JS -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Scripts.php'; ?>
</body>

</html>

<?php

unset($Catalogo);
unset($response);
unset($Historia);
unset($responseHistoriaresponseHistoria);

?>
  <script>
    $(document).ready(function() {

      $('#busqueda').hide(); //oculto mediante id
    });
  </script>