<?php
@session_start();
if (isset($_SESSION['Ecommerce_ClienteIngreso']) && $_SESSION['Ecommerce_ClienteIngreso'] == 0 && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
  header('Location: ../Login/password_recovery.php');
}
if (isset($_SESSION['Costo']) && $_SESSION['Costo']) {
  header('Location: ../Carrito');
}
if (isset($_SESSION['Ecommerce-PedidoPagar']) && $_SESSION['Ecommerce-PedidoPagar']) {
  header('Location: ../Checkout');
} else {
?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Head.php'; ?>

  </head>
  <!-- Body-->

  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5VNXXFL" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div id="customizer-backdrop" class="customizer-backdrop"></div>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Header.php'; ?>

    <!-- Main Slider  ESCRITORIO-->
    <section class="hero-slider d-none d-xs-none  d-sm-block d-md-block d-lg-block d-md-block" style="min-height:auto; background-image: url(../../public/images/img/hero-slider/main-bg1.webp);">
      <div style="min-height:auto;display:flex; align-items:center;" class="owl-carousel large-controls dots-inside" data-owl-carousel="{ &quot;nav&quot;: true, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 7000 }">
        <!--
        <div class="item">
          <div class="container padding-top-2x">
            <div class="row">
              <div style="display: flex; justify-content: flex-end"  class="col-lg-6 col-md-6 col-12 col-sm-6 col-xs-12 padding-bottom-2x text-md-right text-right justify-content-end">
                <div style="display: flex; justify-content: flex-end" class="from-bottom text-md-right text-right justify-content-end">
                  <a style="display: flex; justify-content: flex-end" class="justify-content-end float-right" href="<?php echo $linkIzquierda; ?>" target="<?php echo $Slide->TargetLink1 ?>">
                    <img style="display: flex; justify-content: flex-end" class="d-block mx-auto d-flex justify-content-end" src="<?php echo $ImgIzquierda; ?>"  alt="<?php echo $Slide->Descripcion; ?>">
                    
                  </a>
                </div>
              </div>
              <div style="display: flex; justify-content: flex-start" class="col-lg-6 col-md-6 col-12 col-sm-6 col-xs-12 padding-bottom-2x text-md-left text-left justify-content-start">
              <div style="display: flex; justify-content: flex-start" class="from-bottom text-md-left text-left justify-content-start">
                <a style="display: flex; justify-content: flex-start" class="justify-content-start float-left" href="<?php echo $linkDerecha; ?>" target="<?php echo $Slide->TargetLink2 ?>">
                  <img style="display: flex; justify-content: flex-start" class="d-block mx-auto float-left justify-content-start" src="<?php echo $ImgDerecha; ?>"  alt="<?php echo $Slide->Descripcion; ?>">
                </a>
              </div>
              </div>
            </div>
          </div>
        </div>
          -->

        <?php
        if (!class_exists('SlideController')) {
          include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Home/Slide.Controller.php';
        }
        $SlideController = new SlideController();
        $ResultSlide = $SlideController->get();
        foreach ($ResultSlide->records as $key => $Slide) {
          $linkIzquierda = $Slide->UrlImg1 == '' ? '#' : $Slide->UrlImg1;
          // $linkDerecha = $Slide->UrlImg2 == '' ? '#' : $Slide->UrlImg2;
          $ImgIzquierda = '../../public/images/img_spl/slide/img1/' . $Slide->PathImg1;
          // $ImgDerecha = '../../public/images/img_spl/slide/img2/'.$Slide->PathImg2;
        ?>
          <div class="item">
            <div class="container" style="width:100%; max-width:100%;padding-right: 0px; padding-left: 0px;margin-right: 0px; margin-left: 0px;">
              <a style="width:100%; display: flex; justify-content: flex-end" class="justify-content-end float-right" href="<?php echo $linkIzquierda; ?>" target="<?php echo $Slide->TargetLink1 ?>">
                <img style="min-height: 250px; width:100%; display: flex; justify-content: flex-end" class="d-block my-auto mx-auto d-flex justify-content-end" src="<?php echo $ImgIzquierda; ?>" alt="<?php echo $Slide->Descripcion; ?>">
              </a>
            </div>
          </div>
        <?php } ?>
      </div>
    </section>


    <!-- mobile -->

     
    <section class="hero-slider owl-slider d-xs-block  d-sm-none d-md-none d-lg-none d-md-none" style="min-height:auto; background-image: url(../../public/images/img/hero-slider/main-bg1.webp);">
     <style>.hero-slider>.owl-carousel.dots-inside .owl-dots{
      background-color:#991d1d00;border:1px solid #991d1d00
     }</style>
    
    <div id="carousel" style="min-height:auto;display:flex; align-items:center;" class="owl-carousel  carrusel large-controls dots-inside " >
        <?php
        if (!class_exists('SlideController')) {
          include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Home/Slide.Controller.php';
        }
        $SlideController = new SlideController();
        $ResultSlide = $SlideController->get();
        foreach ($ResultSlide->records as $key => $Slide) {
          $linkIzquierda = $Slide->UrlImg1 == '' ? '#' : $Slide->UrlImg1;
          // $linkDerecha = $Slide->UrlImg2 == '' ? '#' : $Slide->UrlImg2;
          $ImgIzquierda = '../../public/images/img_spl/slide/img1/' . $Slide->PathImg1;
          // $ImgDerecha = '../../public/images/img_spl/slide/img2/'.$Slide->PathImg2;
        ?>
          <div class="item">
            <div class="container" style="width:100%; max-width:100%;padding-right: 0px; padding-left: 0px;margin-right: 0px; margin-left: 0px;">
              <a style="width:100%; display: flex; justify-content: flex-end" class="justify-content-end float-right" href="<?php echo $linkIzquierda; ?>" target="<?php echo $Slide->TargetLink1 ?>">
                <img style="min-height: 250px; width:100%; display: flex; justify-content: flex-end" class="img-fluid d-block mx-auto" src="<?php echo $ImgIzquierda; ?>" alt="<?php echo $Slide->Descripcion; ?>">
              </a>
            </div>
          </div>
        <?php } ?>
      </div>

    
    </section>

    <!-- Top Categorias-->
    <h1 class="h3 padding-top-2x text-center"> Distribución de soluciones integrales de fibra óptica y cableado estructurado. </h1>
    <section class="container padding-top-2x padding-bottom-2x  d-flex justify-content-around ">
      <div class="row  " >
        <?php
        if (!class_exists("CategoriaController")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Categorias/Categoria.Controller.php';
        }
        $CategoriaController = new CategoriaController();
        $CategoriaController->filter = "WHERE activo='si'";
        $CategoriaController->order = "";
        $ResultCategoria = $CategoriaController->get();
        $CategoriaCont3 = 1;

        foreach ($ResultCategoria->records as $key => $Categoria) {

        ?>
          <div class="col" style="padding-right: 0px;padding-left: 0px;">
            <a style="text-decoration:none" href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey; ?>&nom=<?php echo url_amigable($Categoria->Descripcion); ?>">
              <img style="hover:color:red" onmouseover="this.src='../../public/images/img_spl/categorias/a_<?php echo $Categoria->Img ?>'" onmouseout="this.src='../../public/images/img_spl/categorias/<?php echo $Categoria->Img ?>'" class="d-block w-75 img-thumbnail rounded mx-auto mb-4" src="../../public/images/img_spl/categorias/<?php echo $Categoria->Img ?>" alt="Categorias">
              <h6 style="font-size: 15px;" class="mb-2" onMouseOver="this.style.color='#006da3'" onMouseOut="this.style.color='black'"><?php echo $Categoria->Descripcion ?></h6>
            </a>
            <p class="text-sm text-muted mb-0"></p>
          </div>
        <?php if ($CategoriaCont3 == 4) {
            echo '<div class="w-100 d-xs-block  d-sm-block d-md-none d-lg-none d-md-none "></div>';
          }
          $CategoriaCont3++;
        } ?>


      </div>
    </section>

    <!-- <section class="container padding-top-2x padding-bottom-2x  d-flex justify-content-around d-none d-sm-none d-lg-block">

      <div class="d-flex justify-content-between col-md-12 col-lg-12 col-12">

        <div class="row col-md-12 col-lg-12 col-12">

          <?php
          if (!class_exists("CategoriaController")) {
            include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Categorias/Categoria.Controller.php';
          }
          $CategoriaController = new CategoriaController();
          $CategoriaController->filter = "WHERE activo='si'";
          $CategoriaController->order = "";
          $ResultCategoria = $CategoriaController->get();
          $CategoriaCont = 1;

          foreach ($ResultCategoria->records as $key => $Categoria) {
            if ($CategoriaCont == 1 || ($CategoriaCont) == 5) {
          ?>
              <div class="col-md-6 col-12">
                <div class="row">
                <?php } ?>
                <div class="col-md-3 col-12 text-center mb-25">
                  <a style="text-decoration:none" href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey; ?>&nom=<?php echo url_amigable($Categoria->Descripcion); ?>">
                    <img style="hover:color:red" onmouseover="this.src='../../public/images/img_spl/categorias/a_<?php echo $Categoria->Img ?>'" onmouseout="this.src='../../public/images/img_spl/categorias/<?php echo $Categoria->Img ?>'" class="d-block w-75 img-thumbnail rounded mx-auto mb-4" src="../../public/images/img_spl/categorias/<?php echo $Categoria->Img ?>" alt="Categorias">
                    <h6 style="font-size: 15px;" class="mb-2" onMouseOver="this.style.color='#006da3'" onMouseOut="this.style.color='black'"><?php echo $Categoria->Descripcion ?></h6>
                  </a>
                  <p class="text-sm text-muted mb-0"></p>
                </div>
                <?php
                if (($CategoriaCont == 4) || $CategoriaCont == 8) { ?>
                </div>
              </div>
          <?php }
                $CategoriaCont++;
              } ?>
        </div>
      </div>
    </section> -->

    <!-- Banners -->
    <section class="container padding-top-1x">
      <div class="row">
        <?php
        if (!class_exists('MiniBannerController')) {
          include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Home/MiniBanner.Controller.php';
        }
        $MiniBannerController = new MiniBannerController();
        $MiniBannerController->filter = "WHERE t38_pk01=6";
        $MiniBannerController->order = "ORDER BY t39_f003 ASC";
        $ResultMinibanner = $MiniBannerController->get();
        foreach ($ResultMinibanner->records as $key => $MiniBanner) {
          $linkMiniBanner = $MiniBanner->UrlImg1 == '' ? '#' : $MiniBanner->UrlImg1;
          $ImgMiniBanner = '../../../' . $MiniBanner->PathImg1;
        ?>
          <div class="col-lg-4 col-sm-6">
            <div class="card border-0 bg-secondary mb-30">
              <div class="d-table w-100">
                <div class="d-table-cell align-middle">
                  <a href="<?php echo $linkMiniBanner; ?>" target="<?php echo $MiniBanner->TargetLink1 ?>">
                    <img class="d-block w-100" src="<?php echo $ImgMiniBanner; ?>" alt="<?php echo $MiniBanner->Descripcion; ?>">
                </div>
                </a>
              </div>
            </div>
          </div>
        <?php
        }
        ?>

      </div>
    </section>

    <!-- PRODUCTOS -->
    <section class="container padding-top-2x padding-bottom-2x mb-2 d-xs-block d-sm-block d-md-none d-lg-none">
      <h2 class="h3 pb-3 text-center">Productos Destacados </h2>
      <?php
      $cn = 1;
      $cn2 = 1;
      if ($cn % $cn2 == 0) {
        $cn2 = $cn2 + 4; ?>
        <div class="row SameHeight ">
        <?php } ?>
        <?php
        if (!class_exists("ProductoController")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
        }
        $ProductoController = new ProductoController();
        $ProductoController->filter = "WHERE destacado='si' AND destacado='si' ";
        $ProductoController->order = "";
        $getProduct = $ProductoController->GetProductosFijos_();
        $totalElements = count($getProduct->records);

        $CategoriaContxs = 1;
        $CategoriaContmd = 1;

        if ($getProduct->count > 0) {

          if (!class_exists('ComentariosController')) {
            include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Productos/Comentarios.Controller.php';
          }
          foreach ($getProduct->records as $key => $obj) {
            $urlDetailProduct = "../Productos/fijos.php?id_prd=" . $obj->ProductoCodigo . "&nom=" . url_amigable($obj->ProductoDescripcion); #url detalle del producto
            $urlImg = "../../public/images/img_spl/productos/" . $obj->ProductoCodigo . "/thumbnail/" . $obj->ProductoImgPrincipal; #url imagen del producto
            $newUrlImg = file_exists($urlImg) ? $urlImg : "../../public/images/img_spl/notfound.png"; # validación si existe $urlImg
            $calculatePrice = $obj->ProductoPrecio - ($obj->ProductoPrecio * ($obj->Descuento / 100));
            $priceUSD = bcdiv($calculatePrice, 1, 3);
            $priceMXN = number_format($calculatePrice * $_SESSION['Ecommerce-WS-CurrencyRate'], 3);

        ?>
            <div class="col " style="padding-right: 0px;padding-left: 0px;">
              <div class="product-card mb-30 " style="height:auto; word-wrap: break-word;">
                <?= $variable = $obj->Leyenda != "" ? '<div class="product-badge bg-danger">' . $obj->Leyenda . '</div>' : ""; ?>

                <!-- <div class="rating-stars">
                  <?php
                  $ComentariosController = new ComentariosController();
                  $ComentariosController->filter = "WHERE IdProducto = '" . $obj->ProductoCodigo . "'";
                  $Comentarios = $ComentariosController->Comentarios();

                  if ($Comentarios->count > 0) {
                    $RecordsComentarios = $Comentarios->records[0];
                    $Promedio = (int)$RecordsComentarios->Promedio;
                    for ($i = 0; $i < 5; $i++) {
                      if ($i < $Promedio) {
                  ?>
                        <i class="icon-star filled"></i>
                      <?php } else { ?>
                        <i class="icon-star"></i>
                    <?php }
                    }
                  } else { ?>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                  <?php }
                  unset($ComentariosController);
                  unset($Comentarios);
                  ?>
                </div> -->
                <a class="product-thumb" href="<?php echo $urlDetailProduct ?>">
                  <img src="<?php echo $newUrlImg ?>" alt="<?php echo $obj->ProductoDescripcion ?>">
                </a>
                <div class="product-card-body classAbsolute">
                  <div style="height:100%;">

                    <div class="product-category"><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoCodigo ?></a></div>
                    <h3 class="product-title" style="height:60px; overflow-y: scroll;"><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoDescripcion ?></a></h3>
                    <!-- validar si existe variable de sesión -->
                    <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) {
                     ?>
                    <h4 class="product-price" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceMXN; ?> MXP">
                      $<?php echo $priceUSD ?> USD
                    </h4>
                    <?php }?>
                  </div>

                </div>
                <div class="product-button-group">
                  <input type="hidden" name="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" id="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" value="1">
                  <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
                    <a class="product-button" href="javascript:(0)" descuento="<?php echo $obj->Descuento ?>" codigo="<?php echo $obj->ProductoCodigo; ?>" onclick="AgregarArticulo(this)">
                    <?php } else { ?>
                      <a class="product-button" href="../Login/">
                      <?php } ?>
                      <i class="icon-shopping-cart"></i><span>Agregar a carrito</span>
                      </a>
                </div>
              </div>
            </div>

        <?php
            if ($CategoriaContxs == 2 || $CategoriaContxs == 4 || $CategoriaContxs == 6 || $CategoriaContxs == 8 || $CategoriaContxs == 10) {
              echo '<div class="w-100 d-xs-block  d-sm-block d-md-none d-lg-none"></div>';
            }

            $CategoriaContxs++;
            unset($urlDetailProduct);
            unset($urlImg);
            unset($newUrlImg);
            unset($calculatePrice);
            unset($priceUSD);
            unset($priceMXN);
          }
        } ?>


        <?php
        if ($cn % 4 == 0 || $cn == $totalElements) { ?>
        </div>
      <?php } ?>
    </section>
    <!-- Featured Products -->


    <section class="container padding-top-2x padding-bottom-2x mb-2 d-none d-xs-none  d-sm-none d-md-block d-lg-block d-md-block">
      <h2 class="h3 pb-3 text-center">Productos Destacados</h2>
      <div class="row">
        <?php
        if (!class_exists("ProductoController")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
        }
        $ProductoController = new ProductoController();
        $ProductoController->filter = "WHERE destacado='si' AND destacado='si' ";
        $ProductoController->order = "";
        $getProduct = $ProductoController->GetProductosFijos_();


        if ($getProduct->count > 0) {
          if (!class_exists('ComentariosController')) {
            include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Productos/Comentarios.Controller.php';
          }
          foreach ($getProduct->records as $key => $obj) {
            $urlDetailProduct = "../Productos/fijos.php?id_prd=" . $obj->ProductoCodigo . "&nom=" . url_amigable($obj->ProductoDescripcion); #url detalle del producto
            $urlImg = "../../public/images/img_spl/productos/" . $obj->ProductoCodigo . "/thumbnail/" . $obj->ProductoImgPrincipal; #url imagen del producto
            $newUrlImg = file_exists($urlImg) ? $urlImg : "../../public/images/img_spl/notfound.png"; # validación si existe $urlImg
            $calculatePrice = $obj->ProductoPrecio - ($obj->ProductoPrecio * ($obj->Descuento / 100));
            $priceUSD = bcdiv($calculatePrice, 1, 3);
            $priceMXN = number_format($calculatePrice * $_SESSION['Ecommerce-WS-CurrencyRate'], 3);
        ?>
            <div class="col-sm-3">
              <div class="product-card mb-30">
                <?= $variable = $obj->Leyenda != "" ? '<div class="product-badge bg-danger">' . $obj->Leyenda . '</div>' : ""; ?>


                <div class="rating-stars">
                  <?php
                  $ComentariosController = new ComentariosController();
                  $ComentariosController->filter = "WHERE IdProducto = '" . $obj->ProductoCodigo . "'";
                  $Comentarios = $ComentariosController->Comentarios();

                  if ($Comentarios->count > 0) {
                    $RecordsComentarios = $Comentarios->records[0];
                    $Promedio = (int)$RecordsComentarios->Promedio;
                    for ($i = 0; $i < 5; $i++) {
                      if ($i < $Promedio) {
                  ?>
                        <i class="icon-star filled"></i>
                      <?php } else { ?>
                        <i class="icon-star"></i>
                    <?php }
                    }
                  } else { ?>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                    <i class="icon-star"></i>
                  <?php }
                  unset($ComentariosController);
                  unset($Comentarios);
                  ?>
                </div>
                <a class="product-thumb" href="<?php echo $urlDetailProduct ?>">
                  <img src="<?php echo $newUrlImg ?>" alt="<?php echo $obj->ProductoDescripcion ?>">
                </a>
                <div class="product-card-body">

                  <div class="product-category"><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoCodigo ?></a></div>
                  <h3 class="product-title" style="height:60px;"><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoDescripcion ?></a></h3>
                  <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
                    <h4 class="product-price" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceMXN; ?> MXP">
                      $<?php echo $priceUSD ?> USD
                    </h4>
                  <?php } ?>
                </div>
                <div class="product-button-group">
                  <input type="hidden" name="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" id="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" value="1">
                  <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
                    <a class="product-button" href="javascript:(0)" descuento="<?php echo $obj->Descuento ?>" codigo="<?php echo $obj->ProductoCodigo; ?>" onclick="AgregarArticulo(this)">
                    <?php } else { ?>
                      <a class="product-button" href="../Login/">
                      <?php } ?>
                      <i class="icon-shopping-cart"></i><span>Agregar a carrito</span>
                      </a>
                </div>
              </div>
            </div>
        <?php
            unset($urlDetailProduct);
            unset($urlImg);
            unset($newUrlImg);
            unset($calculatePrice);
            unset($priceUSD);
            unset($priceMXN);
          }
        }
        ?>
      </div>
    </section>

    <!-- ULTIMOS BLOGS -->
    <section class="fw-section padding-top-2x padding-bottom-2x">
      <h2 class="h3 pb-3 text-center">Información relevante del blog de fibra y cobre</h2>


      <?php
      if (!class_exists("Blog")) {
        include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Blog/Blog.php';
      }
      $Blog = new Blog();
      $response = (object)$Blog->get("WHERE activo = 'si' AND (pagina='Fibremex' OR pagina='ambas')", "ORDER BY fecha DESC  LIMIT 3", false);

      ?>
      <div class="container padding-bottom-3x mb-1">
        <hr class="col-lg-12 col-md-12 padding-bottom-1x padding-bottom-2x" />
        <div class="row" style="height:100%">


          <?php if ($response->count > 0) : ?>
            <?php $con1 = 1;
            $con2 = 1; ?>
            <?php foreach ($response->records as $key => $row) : ?>
              <div class="col-lg-4 col-md-3 ">
                <div class="blog-post ">
                  <?php // if ( ((($con2 % 2)!=0) &&  (($con1 % 2)!=0) )  || ( (($con1 % 2)==0) && (($con2 % 2)==0) )): 
                  ?>
                  <a class="post-thumb" href="../Blog/detalle.php?id=<?php echo $row->BlogKey; ?>&nom=<?php echo $row->BlogComillas; ?>">
                    <img src="../../public/images/img_spl/blog/<?php echo $row->BlogImg; ?>" alt="<?php echo $row->BlogTitulo; ?>">
                  </a>
                  <?php //endif 
                  ?>
                  <div class="post-body ">

                    <h2 class="post-title featured_products_content_1">
                      <a href="../Blog/detalle.php?id=<?php echo $row->BlogKey; ?>&nom=<?php echo $row->BlogComillas; ?>"><?php echo $row->BlogTitulo; ?></a>
                    </h2>
                    <p class="product-title featured_products_content_1"><?php echo $row->BlogContenido; ?>
                      <a href='../Blog/detalle.php?id=<?php echo $row->BlogKey; ?>&nom=<?php echo $row->BlogComillas; ?>'>Ver más</a>
                    </p>
                  </div>

                  <div class="card-footer text-muted">Publicado <?php echo imprimirTiempo($row->BlogFecha, '08:00:00'); ?></div>
                </div>
              </div>
            <?php endforeach ?>
          <?php endif ?>
        </div>
      </div>
    </section>

    <!-- Banner 1 -->
    <!--
     <section class="fw-section padding-top-2x padding-bottom-2x">
    <div class="row col-md-12 col-lg-12 col-12">
        <div class="col-md-12 col-lg-12 col-12 text-center">
          <h1 class="col-md-12 col-lg-12 col-12" style="font-size: 18px;">Somos Fibremex, el Catálogo de las telecomunicaciones, con una oferta integral para redes y fibra óptica. <br/>Conoce Grupo Splittel, nuestra casa. Transpórtate en un clic.</h1>
        </div>
      </div>

      <iframe frameBorder="0" style="height:625px;"  src="https://splittel.com/Splittour/" title="Splittour">
      </iframe>
     
    </section>
      -->
    <!-- Banner 1 -->
    <!--
    <section class="fw-section padding-top-4x padding-bottom-10x" style="background-image: url(../../public/images/img_spl/banners/shop-banner-bg-02.png);">
      <div class="container text-center"></div>
    </section>
      -->
    <!-- Empalmadora -->
    <!--
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
      -->
    <!-- Distribuidores -->
    <!--
    <section class="fw-section padding-top-4x padding-bottom-10x" style="background-image: url(../../public/images/img_spl/banners/shop-banner-bg-04.webp);">
      <div class="container text-center"></div>
    </section>
      -->
    <!-- Sistema de canalización -->
    <!--
    <section class="fw-section padding-top-4x padding-bottom-8x" style="background-image: url(../../public/images/img_spl/banners/shop-banner-bg-05.webp);">
      <div class="container text-center"></div>
    </section>
      -->
    <!-- Popular Brands Carousel-->
    <section class="bg-secondary padding-top-3x padding-bottom-3x">
      <div class="container">
        <center> <img src="../../public/images/img_spl/logos/splittel.png" style="width: 296px; height: 74px;" /> </center>
        <div class="padding-top-1x owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: false, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2}, &quot;470&quot;:{&quot;items&quot;:3},&quot;630&quot;:{&quot;items&quot;:4},&quot;991&quot;:{&quot;items&quot;:5},&quot;1200&quot;:{&quot;items&quot;:5}} }">
          <?php
          $dirname = "../../public/images/img_spl/logos/";
          $images = glob($dirname . "*.png");

          foreach ($images as $image) {
            if ($image != '../../public/images/img_spl/logos/splittel.png') {
          ?>
              <img class="d-block p-3 opacity-75 m-auto" src="<?php echo $image ?>" alt="<?php echo $image ?>">
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
        <div class="col-md-4 col-sm-6 text-center "><img class="d-block img-thumbnail rounded mx-auto mb-4" src="../../public/images/img_spl/servicios/01.png" alt="Gran Stock">
        </div>
        <div class="col-md-4 col-sm-6 text-center "><img class="d-block img-thumbnail rounded mx-auto mb-4" src="../../public/images/img_spl/servicios/02.png" alt="Entregas al dia siguiente">
        </div>
        <div class="col-md-4 col-sm-6 text-center "><img class="d-block img-thumbnail rounded mx-auto mb-4" src="../../public/images/img_spl/servicios/03.png" alt="Abrimos de lunes a sabado">
        </div>
      </div>
    </section>

    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Scripts.php'; ?>
    <script type="text/javascript">
      // altura('.featured_products_card')
      altura('.featured_products_card_1')
      altura('.featured_products_content_1')
    </script>
  <script type="text/javascript">
        $('.carrusel').owlCarousel({
          nav: false,
          center: true,
          dots: false,
          loop: true,
          autoplay: true,
          autoplayTimeout: 7000,
          items: 1,
          rtl: false,
          lazyLoad: true
        })
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
function imprimirTiempo($fecha, $hora)
{
  $start_date = new DateTime($fecha . " " . $hora);
  $since_start = $start_date->diff(new DateTime(date("Y-m-d") . " " . date("H:i:s")));
  echo "hace ";
  if ($since_start->y == 0) {
    if ($since_start->m == 0) {
      if ($since_start->d == 0) {
        if ($since_start->h == 0) {
          if ($since_start->i == 0) {
            if ($since_start->s == 0) {
              echo $since_start->s . ' segundos';
            } else {
              if ($since_start->s == 1) {
                echo $since_start->s . ' segundo';
              } else {
                echo $since_start->s . ' segundos';
              }
            }
          } else {
            if ($since_start->i == 1) {
              echo $since_start->i . ' minuto';
            } else {
              echo $since_start->i . ' minutos';
            }
          }
        } else {
          if ($since_start->h == 1) {
            echo $since_start->h . ' hora';
          } else {
            echo $since_start->h . ' horas';
          }
        }
      } else {
        if ($since_start->d == 1) {
          echo $since_start->d . ' día';
        } else {
          echo $since_start->d . ' días';
        }
      }
    } else {
      if ($since_start->m == 1) {
        echo $since_start->m . ' mes';
      } else {
        echo $since_start->m . ' meses';
      }
    }
  } else {
    if ($since_start->y == 1) {
      echo $since_start->y . ' año';
    } else {
      echo $since_start->y . ' años';
    }
  }
}


?>