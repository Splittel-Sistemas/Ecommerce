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

  <!-- Page Content-->
  <div class="container padding-top-3x padding-bottom-3x ">
    <div class="row justify-content-center">
      <!-- Content-->
      <div class="col-xl-9 col-lg-8 order-lg-2">


        <?php
        if (!class_exists("Soluciones_")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/SolucionesTop/SolucionesTop.Controller.php';
        }
        $SolucionesTopController = new SolucionesTopController();
        $SolucionesTopController->filter = "WHERE nombre = 'Jumpers' ";
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
                  <img class="rounded" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/banners/" . $row->Banner1 ?>" alt="soluciones">
                  <span class="caption"><?php //echo $response->titulo;
                                        ?></span>
                </div>
              </div>
            </div>
            <!--TEXTO 1-->
            <div class="col-lg-12 col-md-12 order-md-2">

              <p style="text-align: justify;" class="padding-top-1x">
                <?= $row->Texto1 ?>
              </p>
            </div>
            <!-- BANNER 2-->
            <div class="col-lg-12 col-md-12 order-md-2">

              <div class="gallery-wrapper">
                <div class="gallery-item">
                  <img class="rounded" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/banners/" . $row->Banner2 ?>" alt="soluciones">
                  <span class="caption"><?php //echo $response->titulo;
                                        ?></span>
                </div>
              </div>
            </div>
            <!-- ICONOS -->
            <div class="col-lg-1 col-md-1 order-md-2">
            </div>
            <div class="col-lg-2 col-md-2 order-md-2">

              <h6 class="text-muted text-center text-normal ">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/" . $row->Icono1_img ?>"></a>

              </h6>
              <p class=" opacity-75 " style="font-size: 13px;width: 200px;">
                 <?= $row->Texto_icono1 ?>

              </p>
            </div>
           

            <div class="col-lg-2 col-md-2 order-md-2">

              <h6 class="text-muted text-center text-normal ">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/" . $row->Icono2_img ?>"></a>

              </h6>
              <p class=" opacity-75 " style="font-size: 13px;width: 200px;">
                 <?= $row->Texto_icono2 ?>

              </p>
            </div>

            <div class="col-lg-2 col-md-2 order-md-2">

              <h6 class="text-muted text-center text-normal ">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/" . $row->Icono3_img ?>"></a>

              </h6>
              <p class=" opacity-75 " style="font-size: 13px;width: 200px;">
                 <?= $row->Texto_icono3 ?>

              </p>
            </div>

            <div class="col-lg-2 col-md-2 order-md-2">

              <h6 class="text-muted  text-normal ">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/" . $row->Icono4_img ?>"></a>

              </h6>
              <p class=" opacity-75 " style="font-size: 13px;width: 200px;">
                 <?= $row->Texto_icono4 ?>

              </p>
            </div>

            <div class="col-lg-2 col-md-2 order-md-2">

              <h6 class="text-muted text-center text-normal ">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/" . $row->Icono5_img ?>"></a>

              </h6>
              <p class=" opacity-75 " style="font-size: 13px;width: 200px;">
                 <?= $row->Texto_icono5 ?>

              </p>
            </div>
            <div class="col-lg-1 col-md-1 order-md-2">
            </div>


            <!-- BANNER 3-->
            <div class="col-lg-12 col-md-12 order-md-2 margin-top-2x">

              <div class="gallery-wrapper">
                <div class="gallery-item">
                  <img class="rounded" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/banners/" . $row->Banner3 ?>" alt="soluciones">
                  <span class="caption"><?php //echo $response->titulo;
                                        ?></span>
                </div>
              </div>

            </div>



            <!-- APLICACIONES -->
            <div class="col-lg-12 col-md-8 order-md-2">

              <h4 class="text-center opacity-75 margin-top-2x">
                <strong>Aplicaciones</strong>
              </h4>
            </div>

            <div class="col-lg-6 col-md-6 order-md-2">

              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App1_img ?>"></a>
                <br>
                <h5 class="text-center text-muted opacity-75 margin-top-1x">
                  <strong> <?= $row->App1 ?></strong>

                </h5>
              </h6>

            </div>
            <div class="col-lg-6 col-md-6 order-md-2">

              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App2_img ?>"></a>
                <br>

                <h5 class="text-center text-muted opacity-75 margin-top-1x">
                  <strong> <?= $row->App2 ?></strong>

                </h5>
              </h6>

            </div>
            <div class="col-lg-6 col-md-6 order-md-2">

              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App3_img ?>"></a>
                <br>
                <h5 class="text-center text-muted opacity-75 margin-top-1x">
                  <strong> <?= $row->App3 ?></strong>

                </h5>
              </h6>

            </div>
            <div class="col-lg-6 col-md-6 order-md-2">

              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App4_img ?>"></a>
                <br>

                <h5 class="text-center text-muted opacity-75 margin-top-1x">
                  <strong> <?= $row->App4 ?></strong>

                </h5>
              </h6>

            </div>



            <!-- PRODUCTOS DESTACADOS
            -->
            <div class="col-lg-12 col-md-8 order-md-2">

              <h4 class="text-center  opacity-75 margin-top-2x">
                <strong>Selección de productos destacados
                </strong>
              </h4>

              <h6 class="text-muted text-center text-normal ">
                <?= $row->Texto2 ?>
              </h6>


            </div>
            <!-- LOGO OPTRONICS -->
            <div class="col-lg-12 col-md-8 order-md-2">

              <h6 class="text-muted text-center text-normal ">
                <img src="../../public/images/img_spl/solucionestop/Logo/Logo-optronics.png">
              </h6>

            </div>

            <!-- PRODUCTOS -->
            <div class="col-lg-3 col-md-3 order-md-2">
            <a href=" <?= $row->j1_link ?>" style="color: black;text-decoration: none;" target="_blank">

              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/jumpers/" . $row->J1_img ?>"></a>

              </h6>
              </a>

            </div>
            <div class="col-lg-3 col-md-3 order-md-2">
            <a href=" <?= $row->j2_link ?>" style="color: black;text-decoration: none;" target="_blank">

              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/jumpers/" . $row->J2_img ?>"></a>

              </h6>
              </a>

            </div>
            <div class="col-lg-3 col-md-3 order-md-2">
            <a href=" <?= $row->j3_link ?>" style="color: black;text-decoration: none;" target="_blank">

              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/jumpers/" . $row->J3_img ?>"></a>

              </h6>
              </a>

            </div>
            <div class="col-lg-3 col-md-3 order-md-2">
            <a href=" <?= $row->j4_link ?>" style="color: black;text-decoration: none;" target="_blank">

              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/jumpers/" . $row->J4_img ?>"></a>

              </h6>
              </a>

            </div>
            <!-- BOTON -->
            <div class="col-lg-12 col-md-8 order-md-2 margin-top-2x">

              <h6 class="text-muted text-center text-normal ">
                <?= $row->Texto3 ?>
              </h6>

              <h6 class="text-muted text-center text-normal margin-top-1x">
                <a target="_blank" href="https://api.whatsapp.com/send?phone=+524423094756&text=%C2%A1Hola! Me gustario obtener informacion sobre las soluciones"><img src="../../public/images/img_spl/solucionestop/boton/Boton.png"></a>
              </h6>




            </div>





        </div>
      <?php endforeach ?>
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

unset($CatalogoCursos);
unset($response);
unset($first_cur);
unset($final_cur);

?>