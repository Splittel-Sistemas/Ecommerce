<?php 
  @session_start();
  if (isset($_SESSION['Ecommerce_ClienteIngreso']) && $_SESSION['Ecommerce_ClienteIngreso'] == 0 && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
    header('Location: ../Login/password_recovery.php');
  }if (isset($_SESSION['Costo']) && $_SESSION['Costo']) {
    header('Location: ../Carrito');
  }if (isset($_SESSION['Ecommerce-PedidoPagar'] ) && $_SESSION['Ecommerce-PedidoPagar']) {
    header('Location: ../Checkout');
  }else{
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
  </head>
  <!-- Body-->
  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5VNXXFL"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div id="customizer-backdrop" class="customizer-backdrop"></div>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>

    <!-- Main Slider -->
    <section class="hero-slider" style="background-image: url(../../public/images/img/hero-slider/main-bg1.webp);">
      <div class="owl-carousel large-controls dots-inside" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 7000 }">
        <?php
          if (!class_exists('SlideController')) {
            include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Home/Slide.Controller.php';
          }        
          $SlideController = new SlideController();
          $ResultSlide = $SlideController->get();
          foreach ($ResultSlide->records as $key => $Slide) {
            $linkIzquierda = $Slide->UrlImg1 == '' ? '#' : $Slide->UrlImg1;
            $linkDerecha = $Slide->UrlImg2 == '' ? '#' : $Slide->UrlImg2;
            $ImgIzquierda = '../../public/images/img_spl/slide/img1/'.$Slide->PathImg1;
            $ImgDerecha = '../../public/images/img_spl/slide/img2/'.$Slide->PathImg2;
        ?>
        <div class="item">
          <div class="container padding-top-2x">
            <div class="row">
              <div style="display: flex; justify-content: flex-end"  class="col-lg-6 col-md-6 col-12 col-sm-6 col-xs-12 padding-bottom-2x text-md-right text-right justify-content-end">
                <div style="display: flex; justify-content: flex-end" class="from-bottom text-md-right text-right justify-content-end">
                  <a style="display: flex; justify-content: flex-end" class="justify-content-end float-right" href="<?php echo $linkIzquierda;?>" target="<?php echo $Slide->TargetLink1 ?>">
                    <img style="display: flex; justify-content: flex-end" class="d-block mx-auto d-flex justify-content-end" src="<?php echo $ImgIzquierda;?>"  alt="<?php echo $Slide->Descripcion;?>">
                    
                  </a>
                </div>
              </div>
              <div style="display: flex; justify-content: flex-start" class="col-lg-6 col-md-6 col-12 col-sm-6 col-xs-12 padding-bottom-2x text-md-left text-left justify-content-start">
              <div style="display: flex; justify-content: flex-start" class="from-bottom text-md-left text-left justify-content-start">
                <a style="display: flex; justify-content: flex-start" class="justify-content-start float-left" href="<?php echo $linkDerecha;?>" target="<?php echo $Slide->TargetLink2 ?>">
                  <img style="display: flex; justify-content: flex-start" class="d-block mx-auto float-left justify-content-start" src="<?php echo $ImgDerecha;?>"  alt="<?php echo $Slide->Descripcion;?>">
                </a>
              </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </section>
    <!-- Top Categorias-->
    <section class="container padding-top-2x padding-bottom-2x  d-flex justify-content-around">
      <div class="d-flex justify-content-between col-md-12 col-lg-12 col-12">
        <div class="row col-md-12 col-lg-12 col-12">
          <?php
            if (!class_exists("CategoriaController")) {
              include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Categorias/Categoria.Controller.php';
            } 
            $CategoriaController = new CategoriaController();
            $CategoriaController->filter = "WHERE activo='si'";
            $CategoriaController->order = "";
            $ResultCategoria = $CategoriaController->get();
            $CategoriaCont = 1;

            foreach ($ResultCategoria->records as $key => $Categoria){
                if ($CategoriaCont == 1 || ($CategoriaCont / 4) == 1 || ($CategoriaCont / 7) == 1){ 
          ?>
          <div class="col-md-4 col-12">
            <div class="row">
                <?php } ?>
              <div class="col-md-4 col-12 text-center mb-25">
                  <a style="text-decoration:none" href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey; ?>">
                    <img style="hover:color:red" onmouseover="this.src='../../public/images/img_spl/categorias/a_<?php echo $Categoria->Img?>'" 
                    onmouseout="this.src='../../public/images/img_spl/categorias/<?php echo $Categoria->Img?>'" 
                    class="d-block w-75 img-thumbnail rounded mx-auto mb-4" src="../../public/images/img_spl/categorias/<?php echo $Categoria->Img?>" alt="Categorias">
                    <h6 style="font-size: 15px;" class="mb-2" onMouseOver="this.style.color='#006da3'"  onMouseOut="this.style.color='black'" ><?php echo $Categoria->Descripcion?></h6>
                </a> 
                <p class="text-sm text-muted mb-0"></p>
              </div>
            <?php 
             if (($CategoriaCont % 3 == 0) || $CategoriaCont == $ResultCategoria->count){ ?>
            </div>
          </div>
          <?php } 
          $CategoriaCont++;
           } ?>        
        </div>
      </div>
    </section>

    <!-- Banners -->
    <section class="container padding-top-1x">
      <div class="row">
      <?php
        if (!class_exists('MiniBannerController')) {
          include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Home/MiniBanner.Controller.php';
        }        
        $MiniBannerController = new MiniBannerController();
        $MiniBannerController->filter = "WHERE t38_pk01=6";
        $MiniBannerController->order = "ORDER BY t39_f003 ASC";
        $ResultMinibanner = $MiniBannerController->get();
        foreach ($ResultMinibanner->records as $key => $MiniBanner) {
          $linkMiniBanner = $MiniBanner->UrlImg1 == '' ? '#' : $MiniBanner->UrlImg1;
          $ImgMiniBanner = '../../../'.$MiniBanner->PathImg1;
      ?>
        <div class="col-lg-4 col-sm-6">
          <div class="card border-0 bg-secondary mb-30">
            <div class="d-table w-100">
              <div class="d-table-cell align-middle">
              <a href="<?php echo $linkMiniBanner;?>" target="<?php echo $MiniBanner->TargetLink1 ?>">
              <img class="d-block w-100" src="<?php echo $ImgMiniBanner;?>"  alt="<?php echo $MiniBanner->Descripcion;?>"></div>
              </a>  
              </div>
          </div>
        </div>
       <?php
        }
       ?>
        
      </div>
    </section>

    <!-- Cables de fibra óptica -->
     <!-- Banner 1 -->
     <section class="fw-section padding-top-2x padding-bottom-2x">
    <div class="row col-md-12 col-lg-12 col-12">
        <div class="col-md-12 col-lg-12 col-12 text-center">
          <h1 class="col-md-12 col-lg-12 col-12" style="font-size: 18px;">Somos Fibremex, el Catálogo de las telecomunicaciones, con una oferta integral para redes y fibra óptica. <br/>Conoce Grupo Splittel, nuestra casa. Transpórtate en un clic.</h1>
        </div>
      </div>

      <iframe frameBorder="0" style="height:625px;"  src="https://splittel.com/Splittour/" title="Splittour">
      </iframe>
     
    </section>
    <!-- Banner 1 -->
    <section class="fw-section padding-top-4x padding-bottom-10x" style="background-image: url(../../public/images/img_spl/banners/shop-banner-bg-02.png);">
      <div class="container text-center"></div>
    </section>
    <!-- Empalmadora -->
    <section class="fw-section padding-top-4x padding-bottom-8x" style="background-image: url(../../public/images/img_spl/banners/empalmadora-core4s.jpg);"><span class="overlay" style="opacity: .3;"></span>
      <div class="container text-center">
        <div class="d-inline-block  text-white text-lg py-2 px-3 rounded"></div>
        <div class="display-4 text-white py-4">&nbsp;</div>
        <div class="d-inline-block w-200 pt-2">&nbsp;</div>
        <div class="pt-5"></div>
      </div>
    </section>
    <a class="d-block position-relative mx-auto mb-5 mb-md-0" href="#" style="max-width: 882px; margin-top: -300px; z-index: 10;">
    <img class="d-block w-100" src="../../public/images/img_spl/banners/empalmadora1.png" alt="Empalmadora"></a>
    <!-- Distribuidores -->
    <section class="fw-section padding-top-4x padding-bottom-10x" style="background-image: url(../../public/images/img_spl/banners/shop-banner-bg-04.webp);">
      <div class="container text-center"></div>
    </section>
    <!-- Sistema de canalización -->
    <section class="fw-section padding-top-4x padding-bottom-8x" style="background-image: url(../../public/images/img_spl/banners/shop-banner-bg-05.webp);">
      <div class="container text-center"></div>
    </section>
    <!-- Popular Brands Carousel-->
    <section class="bg-secondary padding-top-3x padding-bottom-3x">
      <div class="container">
      <center> <img src="../../public/images/img_spl/logos/splittel.png" style="width: 296px; height: 74px;" /> </center>
        <div class="padding-top-1x owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: false, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2}, &quot;470&quot;:{&quot;items&quot;:3},&quot;630&quot;:{&quot;items&quot;:4},&quot;991&quot;:{&quot;items&quot;:5},&quot;1200&quot;:{&quot;items&quot;:5}} }">
            <?php
                $dirname = "../../public/images/img_spl/logos/";
                $images = glob($dirname."*.png");
                
                foreach($images as $image) {
                    if($image!='../../public/images/img_spl/logos/splittel.png'){
            ?>
            <img class="d-block p-3 opacity-75 m-auto" src="<?php echo $image?>" alt="<?php echo $image?>">
            <?php
                    }
            }
            ?>
        </div>
      </div>
    </section>
    <!-- Services-->
    <section class="container padding-top-3x padding-bottom-2x">
      <div class="row">
        <div class="col-md-4 col-sm-6 text-center mb-30"><img class="d-block img-thumbnail rounded mx-auto mb-4" src="../../public/images/img_spl/servicios/01.png" alt="Gran Stock">
          <h6 class="mb-2">&nbsp;</h6>
          <p class="text-sm text-muted mb-0">&nbsp;</p>
        </div>
        <div class="col-md-4 col-sm-6 text-center mb-30"><img class="d-block img-thumbnail rounded mx-auto mb-4" src="../../public/images/img_spl/servicios/02.png" alt="Entregas al dia siguiente">
          <h6 class="mb-2">&nbsp;</h6>
          <p class="text-sm text-muted mb-0">&nbsp;</p>
        </div>
        <div class="col-md-4 col-sm-6 text-center mb-30"><img class="d-block img-thumbnail rounded mx-auto mb-4" src="../../public/images/img_spl/servicios/03.png" alt="Abrimos de lunes a sabado">
          <h6 class="mb-2">&nbsp;</h6>
          <p class="text-sm text-muted mb-0">&nbsp;</p>
        </div>
      </div>
    </section>

     <!-- Footer -->
     <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <script type="text/javascript">
      // altura('.featured_products_card')
      altura('.featured_products_card_1')
      altura('.featured_products_content_1')
    </script>
  </body>
</html>
<?php 
  unset($SlideController);
  unset($ResultSlide);
  unset($CategoriaController);
  unset($ResultCategoria);
  unset($SubcategoriasN1Controller);
  unset($ResultSubcategoriasN1);
  unset($ProductoController);
  unset($ResultProducto_);
  unset($ComentariosController);
  unset($Comentarios);
  unset($ResultProducto);
  unset($ResultProductosMasVendidos);
  unset($ResultNuevosProductos);
  unset($ResultProductosMejorValorados);
  } 
?>