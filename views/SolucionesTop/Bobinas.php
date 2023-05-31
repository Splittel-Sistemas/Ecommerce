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
      <div class="col-xl-8 col-lg-8 order-lg-2">


        <?php
        if (!class_exists("Soluciones_")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/SolucionesTop/SolucionesTop.Controller.php';
        }
        $SolucionesTopController = new SolucionesTopController();
        $SolucionesTopController->filter = "WHERE nombre = 'Bobinas' ";
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
                  <img alt="" class="rounded" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/banners/" . $row->Banner1 ?>" alt="Bobinas">

                </div>
              </div>
            </div>
            <!--TEXTO 1-->
            <div class="col-lg-12 col-md-12 order-md-2 ">

              <p style="text-align: justify;font-size : 14px;">
                <?= $row->Texto1 ?>
              </p>
            </div>
            <!-- BANNER 2-->
            <div class="col-lg-12 col-md-12 order-md-2 padding-top-1x">

              <div class="gallery-wrapper">
                <div class="gallery-item">
                  <img alt="" class="rounded" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/banners/" . $row->Banner2 ?>" alt="soluciones">

                </div>
              </div>
            </div>



            <!-- VENTAJAS -->
            <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

              <h6 class="text-muted text-center text-normal ">
                <img width="300" alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Ventajas/" . $row->Icono1_img ?>"></a>

              </h6>

            </div>
            <div class="col-lg-6 col-md-6 order-md-2  margin-top-4x" ">

              
                <h5 style=" font-size : 16px;color:#505050" class=" text-center  opacity-85 margin-top-1x">Disponibilidad en <br>
              <b>diferentes estructuras</b>
              </h5>

            </div>


            <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

              <h6 class="text-muted text-center text-normal ">
                <img width="300" alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Ventajas/" . $row->Icono2_img ?>"></a>

              </h6>
              <h5 style="font-size : 16px;color:#505050" class="text-center    margin-top-1x">
                Bobinas 100% cobre


              </h5>
            </div>
            <div class="col-lg-6 col-md-6 order-md-2  margin-top-2x">

              <h6 class="text-muted text-center text-normal ">
                <img width="300" alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Ventajas/" . $row->Icono3_img ?>"></a>

              </h6>
              <h5 style="font-size : 16px;color:#505050" class="text-center    margin-top-2x">
                Cableado estructurado certificable



              </h5>
            </div>

            <div class="col-lg-6 col-md-6 order-md-2  margin-top-1x">

              <h6 class="text-muted  text-normal " style="text-align: center;">
                <img width="300" alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Ventajas/" . $row->Icono4_img ?>"></a>

              </h6>
              <h5 style="font-size : 16px;color:#505050" class="text-center    margin-top-2x">
                Excelente rendimiento <br> eléctrico y mecánico


              </h5>
            </div>

            <div class="col-lg-6 col-md-6 order-md-2  margin-top-1x">

              <h6 class="text-muted text-center text-normal ">
                <img width="300" alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/Ventajas/" . $row->Icono5_img ?>"></a>

              </h6>

              <h5 style="font-size : 16px;color:#505050" class="text-center    margin-top-2x">
                Continuidad garantizada <br>
                en interior y exterior


              </h5>
            </div>


            <!-- BANNER 3-->

            <div class="col-lg-12 col-md-8 order-md-2   margin-top-2x text-center">
              <a href=" <?= $row->bannerlink ?>" style="color: black;text-decoration: none;" target="_blank">


                <img alt="" class="rounded" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/banners/" . $row->Banner3 ?>" alt="soluciones">


              </a>

            </div>



        </div>

      </div>


    </div>





  </div>


  <div class="container padding-top-3x padding-bottom-3x ">

    <div class="row justify-content-center">

      <div class="col-xl-8 col-lg-8 order-lg-2">
        <div class="row">

          <!-- APLICACIONES -->
          <div class="col-lg-12 col-md-8 order-md-2" style="padding-top: -16px;">

            <h4 class="text-center ">
              <strong style="font-size : 20px;color:#54575a">Aplicaciones</strong>
            </h4>
          </div>

          <div class="col-lg-6 col-md-6 order-md-2  padding-top-2x">

            <h6 class=" text-center text-normal ">
              <img width="300" alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App1_img ?>"></a>
              <br>
              <h5 class="text-center    margin-top-1x" style="font-size : 16px;color:#505050">
                <?= $row->App1 ?>

              </h5>
            </h6>

          </div>
          <div class="col-lg-6 col-md-6 order-md-2 padding-top-2x">

            <h6 class=" text-center text-normal ">
              <img width="300" alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App2_img ?>"></a>
              <br>

              <h5 class="text-center    margin-top-1x" style="font-size : 16px;color:#505050">
                <?= $row->App2 ?>

              </h5>
            </h6>

          </div>
          <div class="col-lg-6 col-md-6 order-md-2 margin-top-2x">

            <h6 class=" text-center text-normal ">
              <img width="300" alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App3_img ?>"></a>

            </h6>
            <h5 class="text-center    margin-top-1x" style="font-size : 16px;color:#505050">
              <?= $row->App3 ?>

            </h5>
          </div>
          <div class="col-lg-6 col-md-6 order-md-2" style="padding-top: 80px;">

            <h6 class=" text-center text-normal">
              <img width="300" alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/" . $row->App4_img ?>"></a>

            </h6>

            <h5 class="text-center    margin-top-1x" style="font-size : 16px;color:#505050">
              <?= $row->App4 ?>

            </h5>
          </div>

          <div class="col-lg-6 col-md-6  offset-md-3  order-md-2 margin-top-2x">

            <h6 class=" text-center text-normal ">
              <img width="300" alt="" src="../../public/images/img_spl/solucionestop/<?= $row->Nombre . "/aplicaciones/Aplicacion-5.png"  ?>"></a>
              <br>
              <h5 class="text-center    margin-top-1x" style="font-size : 16px;color:#505050">
                Data center

              </h5>
            </h6>

          </div>



          <!-- PRODUCTOS DESTACADOS
      -->
          <div class="col-lg-12 col-md-8 order-md-2  ">

            <h4 class="text-center   margin-top-2x" style="font-size : 20px;color:#54575a">
              <strong>Selección de productos destacados
              </strong>
            </h4>

            <h6 class=" text-center text-normal " style="font-size : 16px;color:#505050">
              <?= $row->Texto2 ?>
            </h6>


          </div>
          <!-- LOGO OPTRONICS -->
          <div class="col-lg-12 col-md-8 order-md-2">

            <h6 class=" text-center text-normal ">
              <img alt="" width="200" src="../../public/images/img_spl/solucionestop/Bobinas/Extra_1.png">
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

            <h6 class=" text-center text-normal " style="font-size : 14px;color:#505050">
              <?= $row->Texto3 ?>
            </h6>

            <h6 class=" text-center text-normal margin-top-1x">
              <a target="_blank" href="<?= $row->Whatslink ?>"><img alt="" width="350" src="../../public/images/img_spl/solucionestop/Bobinas/boton.png"></a>
            </h6>




          </div>
          <!-- LOGO OPTRONICS 2  -->
          <div class="col-lg-8 offset-md-2  order-md-2">

            <h6 class=" text-center text-normal ">
              <img alt="" src="../../public/images/img_spl/solucionestop/Bobinas/Extra_2.png">
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