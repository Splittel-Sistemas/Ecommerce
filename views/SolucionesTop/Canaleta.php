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

  <!-- Page Content-->
  <div class="container padding-top-3x  ">
    <div class="row justify-content-center">
      <!-- Content-->
      <div class="col-xl-9 col-lg-8 order-lg-2">


        <?php
        if (!class_exists("Soluciones_")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/SolucionesTop/SolucionesTop.Controller.php';
        }
        $SolucionesTopController = new SolucionesTopController();
        $SolucionesTopController->filter = "WHERE nombre = 'Canaleta' ";
        $SolucionesTopController->order = "";
        $responseSolucionesTop = $SolucionesTopController->Get();

        ?>

        <div class="row">
          <?php foreach ($responseSolucionesTop->records as $SolucionesTop  => $row) :
          ?>
            <!-- BANNER 1-->
            <div class="col-lg-12 col-md-12 order-md-2">
              <div class="gallery-wrapper">
                <div class="gallery-item">
                  <img alt="" class="rounded" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/banners/" . $row->Banner1 ?>" alt="Canaleta">

                </div>
              </div>
            </div>
            <!--TEXTO 1-->
            <div class="col-lg-12 col-md-12 order-md-2 ">

              <p style="text-align: justify;">
                <?= $row->Texto1 ?>
              </p>
            </div>
            <!-- BANNER 2-->
            <div class="col-lg-12 col-md-12 order-md-2 padding-top-2x">

              <div class="gallery-wrapper">
                <div class="gallery-item">
                  <img alt="" class="rounded" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/banners/" . $row->Banner2 ?>" alt="soluciones">

                </div>
              </div>
            </div>



            <!-- VENTAJAS -->
            <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

              <h6 class="text-muted text-center text-normal ">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Ventajas/" . $row->Icono1_img ?>"></a>

              </h6>
              <h5 class="text-center text-muted    margin-top-1x">
                <strong>Instalación sencilla sin
                  herramienta especial</strong>

              </h5>
            </div>


            <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

              <h6 class="text-muted text-center text-normal ">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Ventajas/" . $row->Icono2_img ?>"></a>

              </h6>
              <h5 class="text-center text-muted    margin-top-1x">
                <strong>Gran variedad de accesorios
                  para enrutar</strong>

              </h5>

            </div>

            <div class="col-lg-12 col-md-12 order-md-2  margin-top-2x">

              <h6 class="text-muted text-center text-normal ">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Ventajas/" . $row->Icono3_img ?>"></a>

              </h6>

            </div>

            <div class="col-lg-6 col-md-6 order-md-2  margin-top-4x">

              <h6 class="text-muted  text-normal ">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Ventajas/" . $row->Icono4_img ?>"></a>

              </h6>
              <h5 class="text-center text-muted    margin-top-1x">
                <strong>Coples compatibles con otras marcas</strong>

              </h5>
            </div>

            <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

              <h6 class="text-muted text-center text-normal ">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Ventajas/" . $row->Icono5_img ?>"></a>

              </h6>
              <h5 class="text-center text-muted    margin-top-1x">
                <strong>Ensamble rápido y fácil</strong>

              </h5>
            </div>

        </div>

      </div>


    </div>





  </div>


  <div class="container padding-top-3x padding-bottom-3x ">

    <div class="row justify-content-center">

      <div class="col-xl-9 col-lg-8 order-lg-2">
        <div class="row">

          <!-- APLICACIONES -->
          <div class="col-lg-12 col-md-8 order-md-2">

            <h4 class="text-center ">
              <strong>Aplicaciones</strong>
            </h4>
          </div>

          <div class="col-lg-6 col-md-6 order-md-2  margin-top-1x">

            <h6 class=" text-center text-normal ">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App1_img ?>"></a>
              <br>
              <h5 class="text-center text-muted    margin-top-1x">
                <strong> <?= $row->App1 ?></strong>

              </h5>
            </h6>

          </div>
          <div class="col-lg-6 col-md-6 order-md-2 margin-top-4x">

            <h6 class=" text-center text-normal ">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App2_img ?>"></a>
              <br>

              <h5 class="text-center text-muted    margin-top-1x">
                <strong> <?= $row->App2 ?></strong>

              </h5>
            </h6>

          </div>
          <div class="col-lg-6 col-md-6 order-md-2 margin-top-2x">

            <h6 class=" text-center text-normal ">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App3_img ?>"></a>

            </h6>
            <h5 class="text-center text-muted    margin-top-1x">
              <strong> <?= $row->App3 ?></strong>

            </h5>
          </div>
          <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

            <h6 class=" text-center text-normal">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App4_img ?>"></a>

            </h6>

            <h5 class="text-center text-muted    margin-top-1x">
              <strong> <?= $row->App4 ?></strong>

            </h5>
          </div>

          <div class="col-lg-6 col-md-6 order-md-2 margin-top-2x">

            <h6 class=" text-center text-normal ">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/Aplicacion-5.png"  ?>"></a>
              <br>
              <h5 class="text-center text-muted    margin-top-1x">
                <strong>Sites</strong>

              </h5>
            </h6>

          </div>
          <div class="col-lg-6 col-md-6 order-md-2 margin-top-2x">

            <h6 class=" text-center text-normal ">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/Aplicacion-6.png" ?>"></a>
              <br>

              <h5 class="text-center text-muted    margin-top-1x">
                <strong>Enterprise</strong>

              </h5>
            </h6>

          </div>
          <div class="col-md-6 offset-md-3 order-md-2 ">

            <h6 class=" text-center text-normal margin-top-2x">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/Aplicacion-7.png"  ?>"></a>
              <h5 class="text-center text-muted    margin-top-1x">
                <strong> Centros de datos / cuartos de telecomunicaciones</strong>

              </h5>
            </h6>

          </div>


          <div class="col-lg-12 col-md-8 order-md-2   margin-top-2x text-center">
            <a href=" <?= $row->bannerlink ?>" style="color: black;text-decoration: none;" target="_blank">


              <img alt="" class="rounded" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Botones/Boton-1.png"  ?>" alt="soluciones">
              <span class="caption"><?php //echo $response->titulo;
                                    ?></span>

            </a>

          </div>
          <!-- PRODUCTOS DESTACADOS
      -->
          <div class="col-lg-12 col-md-8 order-md-2  ">

            <h4 class="text-center   margin-top-2x">
              <strong>Selección de productos destacados
              </strong>
            </h4>

            <h6 class=" text-center text-normal ">
              <?= $row->Texto2 ?>
            </h6>


          </div>
          <!-- LOGO OPTRONICS -->
          <div class="col-lg-12 col-md-8 order-md-2">

            <h6 class=" text-center text-normal ">
              <img alt="" width="250" src="../../public/images/img_spl/solucionestop/Canaleta/logo.png">
            </h6>

          </div>

          <!-- PRODUCTOS -->
          <div class="col-lg-3 col-md-3 order-md-2">
            <a href=" <?= $row->j1_link ?>" style="color: black;text-decoration: none;" target="_blank">

              <h6 class=" text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Productos/" . $row->J1_img ?>">
            </a>

            </h6>
            </a>

          </div>
          <div class="col-lg-3 col-md-3 order-md-2">
            <a href=" <?= $row->j2_link ?>" style="color: black;text-decoration: none;" target="_blank">

              <h6 class=" text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Productos/" . $row->J2_img ?>">
            </a>

            </h6>
            </a>

          </div>
          <div class="col-lg-3 col-md-3 order-md-2">
            <a href=" <?= $row->j3_link ?>" style="color: black;text-decoration: none;" target="_blank">

              <h6 class=" text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Productos/" . $row->J3_img ?>">
            </a>

            </h6>
            </a>

          </div>
          <div class="col-lg-3 col-md-3 order-md-2">
            <a href=" <?= $row->j4_link ?>" style="color: black;text-decoration: none;" target="_blank">

              <h6 class=" text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Productos/" . $row->J4_img ?>">
            </a>

            </h6>
            </a>

          </div>
          <!-- BOTON -->
          <div class="col-lg-12 col-md-8 order-md-2 margin-top-2x ">

            <h6 class=" text-center text-normal ">
              <?= $row->Texto3 ?>
            </h6>

            <h6 class=" text-center text-normal margin-top-1x">
              <a target="_blank" href="<?= $row->Whatslink ?>"><img alt="" width="350" src="../../public/images/img_spl/solucionestop/Canaleta/boton.png"></a>
            </h6>




          </div>
        </div>
      </div>





    </div>



  </div>
  </div>

<?php endforeach ?>
<!-- Footer -->
<?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Footer.php'; ?>
<!-- scripts JS -->
<?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Scripts.php'; ?>

</body>

</html>

<?php

unset($CatalogoCursos);
unset($response);
unset($first_cur);
unset($final_cur);

?>