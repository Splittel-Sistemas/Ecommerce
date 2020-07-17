<?php 
  @session_start();
  if (!isset($_SESSION['Ecommerce-ClienteKey']) && $_SESSION['Ecommerce-ClienteTipo'] != 'B2B') {
    header('Location: ../Home');
  }else{
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
    <style>
      .modal-lg {
       max-width: 80%;
      }
    </style>
  </head>
  <!-- Body-->
  <body>
  <?php 
      #Header
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php';
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Programa de recompensas</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li><?php echo "Punto a punto" ?></li>
          </ul>
        </div>
      </div>
    </div>
     <!-- Page Content-->
    <div class="container padding-bottom-1x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
          <!-- BANNER 1 -->
          <div class="gallery-wrapper">
            <div class="gallery-item">
            <img src="../../public/images/img_spl/puntoapunto/banner1.jpg" alt="Banner1">
            </div>
          </div>
          <!-- BANNER 2 -->   
          <div class="gallery-wrapper">
            <div class="gallery-item">
              <img src="../../public/images/img_spl/puntoapunto/banner2.jpg" alt="Banner2">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container padding-bottom-1x mb-2">
    <div class="row justify-content-center ">
      <div class="col-md-9 col-sm-8 col-12">  
          <?php include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/PuntoAPunto/List.php';  ?>
      </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modal-datos-envio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body" id="modal-body-datos-envio">
            <div class="container padding-bottom-1x">
            <?php
              if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
                include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/PuntoAPunto/B2B/datos_envio.php'; 
              }else{
                include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/PuntoAPunto/B2C/datos_envio.php'; 
              } 
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <!--  -->
    <script type="text/javascript" src="../../public/scripts/PuntoAPunto/index.js?id=<?php echo rand() ?>"></script>
    <script>
      // altura('.grid_1_4')
      altura('.grid_1_3')
    </script>
  </body>
</html>
<?php } ?>