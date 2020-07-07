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
        <div class="col-md-9 col-sm-8 col-2">  
          <div class="row">
            <?php  
              if (!class_exists("PuntosProductosController")) {
                include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Puntos/PuntosProductos.Controller.php';
              }
            
              $PuntosProductosController = new PuntosProductosController();
              $Result = $PuntosProductosController->Get();
              foreach ($Result->records as $key => $Producto){
            ?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4" >
              <div class="product-card mb-30 grid_1_4" >
                <a class="product-thumb" href="../Productos/fijos.php?id_prd=<?php echo $Producto->Codigo;?>">
                  <?php 
                    $imgUrl = "../../public/images/img_spl/notfound.png"; 
                  ?>
                  <img src="<?php echo $imgUrl; ?>" alt="<?php echo $Producto->Descripcion;?>">
                </a>
                <div class="rating-stars">
                  <?php 
                    if (!class_exists('ComentariosController')) {
                      include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Productos/Comentarios.Controller.php';
                    }
                    $ComentariosController = new ComentariosController();
                    $ComentariosController->filter = "WHERE IdProducto = '".$Producto->Codigo."'";
                    $Comentarios = $ComentariosController->Comentarios();
                    
                    if($Comentarios->count > 0){
                      $RecordsComentarios = $Comentarios->records[0];
                      $Promedio = (int)$RecordsComentarios->Promedio;
                      for ($i=0; $i < 5; $i++) { 
                        if ($i < $Promedio) {
                  ?>
                  <i class="icon-star filled"></i>
                  <?php }else{ ?>
                  <i class="icon-star"></i>
                  <?php } } }else{ ?>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                  <?php } ?>
                </div>
                <div class="product-card-body">
                  <div class="product-category "><a href="../Productos/fijos.php?id_prd=<?php echo $Producto->Codigo;?>"><?php echo $Producto->Codigo?></a></div>
                  <h3 class="product-title grid_1_3">
                  <a href="../Productos/fijos.php?id_prd=<?php echo $Producto->Codigo;?>"><?php echo $Producto->Descripcion;?></a>
                  
                  </h3>
                  <h4 class="product-price">
                  <?php echo $Producto->Puntos; ?> PTS
                  </h4>
                </div>
                <div class=" product-button-group">
                  <input type="hidden" name="ProductoCantidad-<?php echo $Producto->Codigo;?>" id="ProductoCantidad-<?php echo $Producto->Codigo;?>" value="1">
                  <a class="product-button" href="#" descuento="<?php echo $Producto->Descuento ?>" codigo="<?php echo $Producto->Codigo;?>" onclick="AgregarArticulo(this)"><i class="icon-shopping-cart"></i>
                <span>Canjear</span></a></div>
              </div>
            </div>
            <?php } ?>
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
