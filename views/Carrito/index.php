<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title> Contacto </title> -->
    <?php 
    @session_start();
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>		
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Carrito</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Carrito</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1">
      
      <!-- Shopping Cart-->
      <div id="ListProductosCarrito">
        <?php if( $_SESSION['CurrencySite']=='USD'){?>
        <?php include 'List.php'; ?>
        <?php }else{?>
          <?php include 'ListPesos.php'; ?>
        <?php }?>
      </div>

      <!-- Related Products Carousel-->
      <h3 class="text-center padding-top-2x mt-2 padding-bottom-1x">También te puede interesar</h3>
      <div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;margin&quot;: 30, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;768&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
        <?php 
          if (!class_exists("ProductoController")) {
            include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Producto.Controller.php';
          }
          $ProductoController = new ProductoController();
          $ProductoController->order = "ORDER BY RAND() LIMIT 12 ";
          $getProduct = $ProductoController->GetProductosFijos();

          $columnas = "col-12";
          include '../product/fixed/fixed.php';
          unset($getProduct);
        ?>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="modal-carrito-list-datos-envio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body" id="modal-body-carrito-list-datos-envio">

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
     <script type="text/javascript" src="../../public/scripts/Carrito/CostoEnvio/CostoEnvioGlobal.js?id=<?php echo rand() ?>"></script>
     <script type="text/javascript" src="../../public/scripts/Carrito/CostoEnvio/datos_envio.js?id=<?php echo rand() ?>"></script>
  </body>
</html>