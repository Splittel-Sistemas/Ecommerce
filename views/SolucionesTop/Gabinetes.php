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
  <div class="container padding-top-3x padding-bottom-3x ">
    <div class="row justify-content-center">
      <!-- Content-->
      <div class="col-xl-9 col-lg-8 order-lg-2">


        <?php
        if (!class_exists("Soluciones_")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/SolucionesTop/SolucionesTop.Controller.php';
        }
        $SolucionesTopController = new SolucionesTopController();
        $SolucionesTopController->filter = "WHERE nombre = 'Gabinetes' ";
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
                  <img alt="" class="rounded" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/banners/" . $row->Banner1 ?>" alt="gabinetes">
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

        </div>

      </div>


    </div>





  </div>

  <div class="container padding-top-3x padding-bottom-3x ">

    <div class="row justify-content-center" style="background: linear-gradient(white 70%,  #ECECEC 30%);">

      <div class="col-lg-12 col-md-12 order-md-2 margin-top-2x"  >

        <div class="gallery-wrapper" >
          <div class="gallery-item" >
            <img alt="" class="rounded" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/banners/" . $row->Banner2 ?>" alt="gabinetes">
            <span class="caption"><?php //echo $response->titulo;
                                  ?></span>
          </div>
        </div>
      </div>
    </div>
    <!-- BANNER 2-->

    <div class="row justify-content-center" style="background-color: #ECECEC;">
      <!-- Content-->

      <div class="col-xl-9 col-lg-8 order-lg-2">
        <div class="row">
          <!-- ICONOS -->

          <div class="col-lg-12 col-md-8 order-md-2">

            <h4 class="text-center  margin-top-2x">
              <strong>Gabinetes</strong>
            </h4>
          </div>
          <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

            <div class="gallery-wrapper">
              <div class="gallery-item">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/" . $row->Nombre . "/" . $row->Icono1_img ?>" alt="gabinetes">

              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 order-md-2  margin-top-4x" ">

            <div class=" gallery-wrapper">
            <div class="gallery-item">
              <h5 class="text-center   margin-top-1x"><b>Puertas configurables </b> <br>para cubrir distintas necesidades <br> de ventilacion y protección</h5>

            </div>
          </div>
        </div>
        <br>

        <div class="col-lg-6 col-md-6 order-md-2  margin-top-1x" style="padding-top: 20px;">

          <h6 class=" text-center text-normal ">
            <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/" . $row->Nombre . "/" . $row->Icono2_img ?>" alt="gabinetes"></a>
            <h5 class="text-center  ">Control del flujo de aire</h5>
          </h6>

        </div>


        <div class="col-lg-6 col-md-6 order-md-2 ">

          <h6 class=" text-center text-normal ">
            <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/" . $row->Nombre . "/" . $row->Icono3_img ?>" alt="gabinetes"></a>
          </h6>
          <h5 class="text-center   ">Sistema de protección <br> y embalaje sin cargo extra</h5>

        </div>

        <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

          <h6 class=" text-center text-normal ">
            <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/" . $row->Nombre . "/" . $row->Icono4_img ?>" alt="gabinetes"></a>
            <h5 class="text-center   margin-top-1x">Estandarización para equipos de 19’’</h5>
          </h6>

        </div>

        <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

          <h6 class="  text-normal ">
            <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/" . $row->Nombre . "/" . $row->Icono5_img ?>" alt="gabinetes"></a>
            <h5 class="text-center   margin-top-1x">Envío gratuito a toda la república</h5>
          </h6>

        </div>

        <div class="col-lg-12 col-md-8 order-md-2">

          <h4 class="text-center  margin-top-2x">
            <strong>Racks</strong>
          </h4>
        </div>

        <div class="col-lg-12 col-md-12 order-md-2  margin-top-2x">

          <div class="gallery-wrapper">
            <div class="gallery-item">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/Racks/icono-6.png" ?>" alt="gabinetes">
              <h5 class="text-center   margin-top-1x">Desde 2 hasta 45 UR</h5>

            </div>
          </div>
        </div>
        <br>
        <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

          <h6 class=" text-center text-normal ">
            <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/Racks/icono-7.png" ?>" alt="gabinetes"></a>
            <h5 class="text-center   margin-top-1x">Configuración especial <br> para paredes</h5>
          </h6>

        </div>


        <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

          <h6 class=" text-center text-normal ">
            <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/Racks/icono-8.png" ?>" alt="gabinetes"></a>
          </h6>
          <h5 class="text-center   margin-top-1x">Diferentes capacidades de carga</h5>

        </div>

        <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

          <h6 class=" text-center text-normal ">
            <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/Racks/icono-9.png" ?>" alt="gabinetes"></a>
            <h5 class="text-center   margin-top-1x">Cumple con especificaciones <br>
              EIA-310-E</h5>
          </h6>

        </div>

        <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

          <h6 class="  text-normal ">
            <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/iconos/Racks/icono-10.png" ?>" alt="gabinetes"></a>
            <h5 class="text-center   margin-top-1x">Carga estática adaptable <br>
              a tus necesidades</h5>
          </h6>

        </div>

        <!-- BANNER 3-->
        <div class="col-lg-12 col-md-12 order-md-2 margin-top-2x">
          <a href=" <?= $row->bannerlink ?>" style="color: black;text-decoration: none;" target="_blank">

            <div class="">
              <div class="">
                <img alt="" class="rounded" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/banners/" . $row->Banner3 ?>" alt="gabinetes">
                <span class="caption"><?php //echo $response->titulo;
                                      ?></span>
              </div>
            </div>
          </a>

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

            <h4 class="text-center  margin-top-2x">
              <strong>Aplicaciones</strong>
            </h4>
          </div>

          <div class="col-lg-6 col-md-6 order-md-2 ">

            <h6 class=" text-center text-normal margin-top-2x">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App1_img ?>"></a>
              <br>
              <h5 class="text-center   margin-top-1x">
                <strong> <?= $row->App1 ?></strong>

              </h5>
            </h6>

          </div>
          <div class="col-lg-6 col-md-6 order-md-2">

            <h6 class=" text-center text-normal margin-top-2x">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App2_img ?>"></a>
              <br>

              <h5 class="text-center   margin-top-1x">
                <strong> <?= $row->App2 ?></strong>

              </h5>
            </h6>

          </div>
          <div class="col-lg-6 col-md-6 order-md-2">

            <h6 class=" text-center text-normal margin-top-2x">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App3_img ?>"></a>
              <br>
              <h5 class="text-center   margin-top-1x">
                <strong> <?= $row->App3 ?></strong>

              </h5>
            </h6>

          </div>
          <div class="col-lg-6 col-md-6 order-md-2">

            <h6 class=" text-center text-normal margin-top-2x">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App4_img ?>"></a>
              <br>

              <h5 class="text-center   margin-top-1x">
                <strong> <?= $row->App4 ?></strong>

              </h5>
            </h6>

          </div>

          <div class="col-lg-6 col-md-6 order-md-2">

            <h6 class=" text-center text-normal margin-top-2x">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/Aplicacion-5.png"  ?>"></a>
              <br>
              <h5 class="text-center   margin-top-1x">
                <strong>Redes de telecomunicaciones</strong>

              </h5>
            </h6>

          </div>
          <div class="col-lg-6 col-md-6 order-md-2">

            <h6 class=" text-center text-normal margin-top-4x">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/Aplicacion-6.png" ?>"></a>
              <br>

              <h5 class="text-center   margin-top-1x">
                <strong> Cableado estructurado</strong>

              </h5>
            </h6>

          </div>
          <div class="col-md-6 offset-md-3 order-md-2  margin-top-2x">

            <h6 class=" text-center text-normal margin-top-2x">
              <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/Aplicacion-7.png"  ?>"></a>
              <br>

              <h5 class="text-center   margin-top-1x">
                <strong> Distribuciones de alta densidad</strong>

              </h5>
            </h6>

          </div>
          <!-- PRODUCTOS DESTACADOS
      -->
          <div class="col-lg-12 col-md-8 order-md-2  margin-top-2x">

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
              <img alt="" src="../../public/images/img_spl/solucionestop/Gabinetes/logo.png">
            </h6>

          </div>

          <!-- PRODUCTOS -->
          <div class="col-lg-3 col-md-3 order-md-2">
            <a href=" <?= $row->j1_link ?>" style="color: black;text-decoration: none;" target="_blank">

              <h6 class=" text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/gabinetes/" . $row->J1_img ?>">
            </a>

            </h6>
            </a>

          </div>
          <div class="col-lg-3 col-md-3 order-md-2">
            <a href=" <?= $row->j2_link ?>" style="color: black;text-decoration: none;" target="_blank">

              <h6 class=" text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/gabinetes/" . $row->J2_img ?>">
            </a>

            </h6>
            </a>

          </div>
          <div class="col-lg-3 col-md-3 order-md-2">
            <a href=" <?= $row->j3_link ?>" style="color: black;text-decoration: none;" target="_blank">

              <h6 class=" text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/gabinetes/" . $row->J3_img ?>">
            </a>

            </h6>
            </a>

          </div>
          <div class="col-lg-3 col-md-3 order-md-2">
            <a href=" <?= $row->j4_link ?>" style="color: black;text-decoration: none;" target="_blank">

              <h6 class=" text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/gabinetes/" . $row->J4_img ?>">
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
              <a target="_blank" href="https://api.whatsapp.com/send?phone=+524423094756&text=%C2%A1Hola!%20Quiero%20m%C3%A1s%20informaci%C3%B3n%20sobre%20los%20GABINETES%20Y%20RACKS"><img alt="" src="../../public/images/img_spl/solucionestop/Gabinetes/boton.png"></a>
            </h6>




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