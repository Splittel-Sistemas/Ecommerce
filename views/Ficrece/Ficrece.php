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
          <img class="rounded" src="../../public/images/img_spl/ficrece/banner.png" alt="soluciones">
        </div>
      
      </div>


      <div class="row">
        <div class="col-1 padding-bottom-1x text-center">
        </div>
        <div class="col-10 padding-bottom-1x text-center">
            <br>
          <p style="text-align: center;" class="padding-top-1x">Agradecemos tu interés en la línea de crédito que en Fibremex S. A. de C. V. ofrecemos. 
            <br>
            <br>
            Para conocer el resultado del crédito solicitado, te pedimos estar al pendiente de la respuesta en un plazo no mayor a 72 horas. 

            <br>
            <br>
            Nuestro personal del área de crédito y cobranza está a tu disposición para aclarar cualquier duda o conocer la respuesta a su solicitud.
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