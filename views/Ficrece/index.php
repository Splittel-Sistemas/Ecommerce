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
  <div class="page-title">
    <div class="container">
      <div class="column">
        <h1>FICRECE</h1>
      </div>
      <div class="column">
        <ul class="breadcrumbs">
          <li><a href="index.html">Home</a>
          </li>
          <li class="separator">&nbsp;</li>
          <li>FICRECE</li>
        </ul>
      </div>
    </div>
  </div>
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
          <br>
          <h3><b>Invertimos en favor de tu rendimiento</b> </h3>
          <p style="text-align: center;" class="padding-top-1x"><b>Apoyamos el crecimiento de los proyectos de telecomunicaciones</b> con el impulso financiero requerido.
            Ponemos a trabajar en su favor al fabricante Optronics y su línea de ensamble con el objetivo de ofrecer la calidad que
            los mayores estándares brindan.

            <br>
            <br>
            Nuestro programa de financiamiento <b> FICRECE</b> busca consolidar nuestra alianza comercial contigo, para lograrlo podemos
            otorgarte un crédito que nos permita trabajar juntos en cada conexión.

            <br>
            <br>
            <b>Tenemos la propuesta financiera que apoyará tu proyecto: </b>
          </p>
        </div>

      </div>
      <div class="row text-center">
        <div class="col-12 padding-bottom-1x d-flex justify-content-center">
          <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
            <a class="btn btn " href="./Create.php"><img class="rounded" src="../../public/images/img_spl/ficrece/b.png" alt="soluciones"></a>
          <?php } else { ?>
            <a class="btn btn " href="../Login/index.php?url=../Ficrece/Create.php"><img class="rounded" src="../../public/images/img_spl/ficrece/b.png" alt="soluciones"></a>
          <?php } ?>


        </div>
      </div>

      <div class="row text-center">
        <div class="col-1 padding-bottom-1x text-center">
        </div>
        <div class="col-10 padding-bottom-1x text-center">
          <p style="text-align: center;" class="padding-top-1x"><b>Te apoyamos con una parte proporcional de la inversión total del proyecto que tienes en puerta,
              estrechemos nuestra relación y juntos alcancemos un rendimiento más alto.
            </b> </p>
        </div>

      </div>
      <div class="row text-center ">
        <div class="col-1 padding-bottom-1x text-center">
        </div>
        <div class="col-10 padding-bottom-1x text-center">
          <img class="rounded" src="../../public/images/img_spl/ficrece/3.png" alt="soluciones">
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