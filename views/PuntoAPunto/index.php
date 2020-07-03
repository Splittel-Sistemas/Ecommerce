<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
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
         
          <!-- BANNER-->
          <div class="gallery-wrapper">
            <div class="gallery-item">
              <img src="../../public/images/img_spl/puntoapunto/banner1.jpg" alt="Banner">
            </div>
          </div>
         
          <!-- IMG 1-->   
            <div class="gallery-wrapper">
              <div class="gallery-item">
                <img src="../../public/images/img_spl/puntoapunto/banner2.jpg" alt="Banner1">
              </div>
            </div>
          
          <!-- IMG 2-->  
            <div class="gallery-wrapper">
              <div class="gallery-item">
                <img src="../../public/images/img_spl/puntoapunto/banner3.jpg" alt="Banner2">
              </div>
            </div>

          
         
        </div>
      </div>
    </div>
    
            
      




   
  
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <script>
      // altura('.grid_1_4')
      altura('.grid_1_3')
    </script>
  </body>
</html>
