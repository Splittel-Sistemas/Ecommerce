<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <title> Contacto </title> -->
  <?php 
  @session_start();
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Head.php'; ?>

</head>
<!-- Body-->

<body>
  <!-- Header -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Header.php'; ?>
  
  <!-- Page Content-->
  <div class="container padding-top-3x padding-bottom-3x ">
    <div class="row justify-content-center">
      <!-- Content-->
      <div class="col-xl-11 col-lg-11 order-lg-2">

        <div class="row">
         
         
            <!-- BANNER 1-->
            <div class="col-lg-12 col-md-12 order-md-2">
              <div class="gallery-wrapper">
                <div class="gallery-item">
                  <img alt="" style="width:100%" class="rounded " src="../../public/images/img_spl/wisp/1-banner landing wisp.png" alt="soluciones">
                  <span class="caption"><?php //echo $response->titulo;
                                        ?></span>
                </div>
              </div>
            </div>
            <!--TEXTO 1-->
            <div class="col-lg-12 col-md-12 order-md-2">

              <p style="text-align: justify;" class="padding-top-1x text-muted">
              En el mundo digitalizado y siempre conectado de hoy, los proveedores de servicios de internet desempeñan un papel
                fundamental en la vida cotidiana de las personas y en el desarrollo de comunidades enteras. En este contexto, en
                Fibremex®, nos enorgullece ofrecer soluciones de fibra óptica de vanguardia diseñadas específicamente para
                fortalecer la infraestructura de red de los ISP y WISP.
              </p>
            </div>
            <div class="col-lg-12 col-md-12 order-md-2">
            <h4 class="text-muted opacity-75 margin-top-1x">
                  <strong>Conoce los productos de fibra óptica</strong>
                </h4>
            </div>
            <div class="col-lg-12 col-md-12 order-md-2 padding-bottom-1x">
            <h6 class="text-muted opacity-75 ">
                  <strong>Cables de fibra óptica</strong>
                </h6>
            </div>
            <!-- CABLES DE FIBRA OPTICA-->
            <div class="col-lg-12 col-md-12 order-md-2">
            <div class="row">
        <?php
        if (!class_exists("ProductoController")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
        }
        $ProductoController = new ProductoController();
        $ProductoController->filter = "WHERE codigo IN ('OPCFOCE09MSA06B3B-4K','OPCFOCE09MSA12B3B-4k','OPCFOCE09MSA24B3B-4k','OPCFOCE09SAG12B2B-4k','OPCFOCE09SAG24B2B-4K',
        'OPCFOCE09SAG36B2B-4K','OPCFOCE09SAG48B2B-4K','OPCFOCE09SAG72B2B-4K','OPCFOCE09SAG96B2B-4K','OPCFOIE29DR801ZH-2k','OPCFOIE29DR802ZH-2K','OPCFOIE39DR001TP-2K','OPCFOIE39DR002ZH-2k') AND producto_activo='si' ";
        $ProductoController->order = "";
        $getProduct = $ProductoController->GetProductosFijos_();
        //print_r($getProduct);

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
                <div class="product-card-body classAbsolute">
                <div style="height:100%;">
                  <div class="product-category"><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoCodigo ?></a></div>
                  <h3 class="product-title" ><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoDescripcion ?></a></h3>
                  <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
                    <?php if($_SESSION['CurrencySite']=='USD'){?>
                    <h4 class="product-price" id="id-product-price-<?php echo $obj->ProductoCodigo?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceMXN; ?> MXP">
                      $<?php echo $priceUSD ?> USD
                    </h4>
                    <?php }else{ ?>
                        <h4 class="product-price " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceUSD; ?> USD">
                        $<?php echo $priceMXN ?> MXN
                      </h4>
                      <?php }?>
                    <!--
                    <input class="form-control form-control-sm text-center" type="number" oninput="ActualizaCantidadCarrete('<?php echo $obj->ProductoCodigo?>',this.value,<?php echo $obj->ProductoPrecio?>)"  value="1">
                    -->
                    <input class="form-control form-control-sm text-center" type="number" oninput="ActualizaCantidadCarrete('<?php echo $obj->ProductoCodigo?>',this.value)" value="1">
                    <?php } ?>
                    </div>
                </div>
                <div class="product-button-group">
                 
                  <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
                    <input class="form-control form-control-sm text-center" type="hidden" name="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" id="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" value="1">
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
            </div>



            <!-- CIERRES DE EMPLAME-->
            <div class="col-lg-12 col-md-12 order-md-2 padding-top-2x padding-bottom-1x">
            <h6 class="text-muted opacity-75 ">
                  <strong>Cierres de emplame tipo NAP</strong>
                </h6>
            </div>
            <div class="col-lg-12 col-md-12 order-md-2">
            <div class="row SameHeight">
        <?php
        if (!class_exists("ProductoController")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
        }
        $ProductoController = new ProductoController();
        $ProductoController->filter = "WHERE codigo IN ('OPCEF08SC36E65HT8SCA','OPCEF08SC36E65HT8SCU','OPCEF16SC144E65HT','OPCEF16SC144E65HTSCA','OPCEF08SC68HT','OPCEF08SC68HTSCA','OPCEF08SC68HTSCU','OPCEF16SC65HT','OPCEF16SC65HT16SCAS','OPCEF16SC65HT16SCUS') AND producto_activo='si' ";
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
                <div class="product-card-body classAbsolute ">
                <div style="height:100%;">
                  <div class="product-category"><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoCodigo ?></a></div>
                  <h3 class="product-title" ><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoDescripcion ?></a></h3>
                  <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
                    <?php if($_SESSION['CurrencySite']=='USD'){?>
                    <h4 class="product-price" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceMXN; ?> MXP">
                      $<?php echo $priceUSD ?> USD
                    </h4>
                    <?php }else{ ?>
                        <h4 class="product-price " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceUSD; ?> USD">
                        $<?php echo $priceMXN ?> MXN
                      </h4>
                      <?php }?>
                    <input class="form-control form-control-sm text-center" type="number" oninput="ActualizaCantidadCarrete('<?php echo $obj->ProductoCodigo?>',this.value)" value="1">
                  <?php } ?>
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
            </div>
            
          <!-- CONECTORES MECANICOS & EPLAMADORA-->
          <div class="col-lg-12 col-md-12 order-md-2 padding-top-2x padding-bottom-1x">
            <div class="row">
                <div class="col-lg-8">
                <h6 class="text-muted opacity-75 ">
                    <strong>Conectores mecánicos</strong>
                    </h6>
                </div>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 order-md-2 padding-bottom-1x">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                    <?php
        if (!class_exists("ProductoController")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
        }
        $ProductoController = new ProductoController();
        $ProductoController->filter = "WHERE codigo IN ('OPCOMESCUMULUNAZ','OPCOMESCAMULUNVE') AND producto_activo='si' ";
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
            <div class="col-sm-6">
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
                    <?php if($_SESSION['CurrencySite']=='USD'){?>
                    <h4 class="product-price" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceMXN; ?> MXP">
                      $<?php echo $priceUSD ?> USD
                    </h4>
                    <?php }else{ ?>
                        <h4 class="product-price " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceUSD; ?> USD">
                        $<?php echo $priceMXN ?> MXN
                      </h4>
                      <?php }?>
                    <input class="form-control form-control-sm text-center" type="number" oninput="ActualizaCantidadCarrete('<?php echo $obj->ProductoCodigo?>',this.value)" value="1">
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
                </div>
                   </div>
          </div>

              <!-- EQUIPOS DE MEDICION Y FUSION  -->
            <div class="col-lg-12 col-md-12 order-md-2 padding-top-2x padding-bottom-1x">
              <h6 class="text-muted opacity-75 ">
                    <strong>Equipos de medición y fusión</strong>
                  </h6>
            </div>
         <div class="col-lg-12 col-md-12 order-md-2">
         <div class="row">
        <?php
        if (!class_exists("ProductoController")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
        }
        $ProductoController = new ProductoController();
        $ProductoController->filter = "WHERE codigo IN ('OPEFEMPANU06001','OPEMMINOTDR2101','OPEMFHO51T43F','OPEMFHO51') AND producto_activo='si' ";
        $ProductoController->order = "";
        $getProduct = $ProductoController->GetProductosFijos_();
        //print_r($getProduct);

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
                <div class="product-card-body classAbsolute">
                <div style="height:100%;">
                  <div class="product-category"><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoCodigo ?></a></div>
                  <h3 class="product-title" ><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoDescripcion ?></a></h3>
                  <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
                    <?php if($_SESSION['CurrencySite']=='USD'){?>
                    <h4 class="product-price" id="id-product-price-<?php echo $obj->ProductoCodigo?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceMXN; ?> MXP">
                      $<?php echo $priceUSD ?> USD
                    </h4>
                    <?php }else{ ?>
                        <h4 class="product-price " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceUSD; ?> USD">
                        $<?php echo $priceMXN ?> MXN
                      </h4>
                      <?php }?>
                    <!--
                    <input class="form-control form-control-sm text-center" type="number" oninput="ActualizaCantidadCarrete('<?php echo $obj->ProductoCodigo?>',this.value,<?php echo $obj->ProductoPrecio?>)"  value="1">
                    -->
                    <input class="form-control form-control-sm text-center" type="number" oninput="ActualizaCantidadCarrete('<?php echo $obj->ProductoCodigo?>',this.value)" value="1">
                    <?php } ?>
                    </div>
                </div>
                <div class="product-button-group">
                 
                  <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
                    <input class="form-control form-control-sm text-center" type="hidden" name="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" id="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" value="1">
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

        </div>

             <!-- SUJECION DE CABLES  -->
             <div class="col-lg-12 col-md-12 order-md-2 padding-top-2x padding-bottom-1x">
              <h6 class="text-muted opacity-75 ">
                    <strong>Sujeción de cables</strong>
                  </h6>
            </div>
         <div class="col-lg-12 col-md-12 order-md-2">
         <div class="row">
        <?php
        if (!class_exists("ProductoController")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
        }
        $ProductoController = new ProductoController();
        $ProductoController->filter = "WHERE codigo IN ('OPHAHEDACGRPW','OPHAHEDACPW','OPHARAQSA12','OPHAFLEAI07058',
        'OPHAFLEAI07034','OPHATENAC','OPHAGANTENFS') AND producto_activo='si' ";
        $ProductoController->order = "";
        $getProduct = $ProductoController->GetProductosFijos_();
        //print_r($getProduct);

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
                <div class="product-card-body classAbsolute">
                <div style="height:100%;">
                  <div class="product-category"><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoCodigo ?></a></div>
                  <h3 class="product-title" ><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoDescripcion ?></a></h3>
                  <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
                    <?php if($_SESSION['CurrencySite']=='USD'){?>
                    <h4 class="product-price" id="id-product-price-<?php echo $obj->ProductoCodigo?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceMXN; ?> MXP">
                      $<?php echo $priceUSD ?> USD
                    </h4>
                    <?php }else{ ?>
                        <h4 class="product-price " data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceUSD; ?> USD">
                        $<?php echo $priceMXN ?> MXN
                      </h4>
                      <?php }?>
                    <!--
                    <input class="form-control form-control-sm text-center" type="number" oninput="ActualizaCantidadCarrete('<?php echo $obj->ProductoCodigo?>',this.value,<?php echo $obj->ProductoPrecio?>)"  value="1">
                    -->
                    <input class="form-control form-control-sm text-center" type="number" oninput="ActualizaCantidadCarrete('<?php echo $obj->ProductoCodigo?>',this.value)" value="1">
                    <?php } ?>
                    </div>
                </div>
                <div class="product-button-group">
                 
                  <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
                    <input class="form-control form-control-sm text-center" type="hidden" name="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" id="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" value="1">
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

        </div>

         <!--TEXTO 1-->
         <div class="col-lg-12 col-md-12 order-md-2">

            <p style="text-align: justify;" class="padding-top-1x text-muted">
            La fibra óptica es la columna vertebral de la conectividad moderna, y entendemos su importancia crítica para el éxito
            operativo y la satisfacción del cliente de los proveedores de servicios de internet. Es por eso que Fibremex®,
            entendemos las dificultades que enfrentan nuestros clientes al lidiar con la escasez de productos en el mercado y nos
            esforzamos para que nuestros productos estén disponibles en gran cantidad y listos para ser enviados en el momento
            que lo necesites.
            </p>
        </div>

        <!-- IMAGENES -->
        <div class="col-lg-12 col-md-8 order-md-2">

           
            </div>

            <div class="col-lg-6 col-md-6 order-md-2">

            <h6 class="text-muted text-center text-normal margin-top-2x">
            <img alt="" src="../../public/images/img_spl/wisp/img-almacen1.png"></a>
          
            </h6>

            </div>
            <div class="col-lg-6 col-md-6 order-md-2">

            <h6 class="text-muted text-center text-normal margin-top-2x">
            <img alt="" src="../../public/images/img_spl/wisp/img-almacen2.png"></a>
            </h6>

            </div>
            <div class="col-lg-6 col-md-6 order-md-2">

            <h6 class="text-muted text-center text-normal margin-top-2x">
            <img alt="" src="../../public/images/img_spl/wisp/img-almacen3.png"></a>
            </h6>

            </div>
            <div class="col-lg-6 col-md-6 order-md-2">

            <h6 class="text-muted text-center text-normal margin-top-2x">
            <img alt="" src="../../public/images/img_spl/wisp/img-almacen4.png"></a>
            
            </h6>

        </div>
        <div class="col-lg-12 col-md-12 order-md-2 padding-top-3x">
        <hr class="padding-top-1x padding-bottom-1x">
        </div>
        <!-- BANNER 2-->
        <div class="col-lg-12 col-md-12 order-md-2 padding-top-1x">
              <div class="gallery-wrapper">
                <div class="gallery-item">
                  <img alt="" style="width:100%" class="rounded " src="../../public/images/img_spl/wisp/2-banner fintec.png" alt="soluciones">
                  <span class="caption"><?php //echo $response->titulo;
                                        ?></span>
                </div>
              </div>
            </div>


         <!--TEXTO 1-->
         <div class="col-lg-12 col-md-12 order-md-2">

            <p style="text-align: justify;" class="padding-top-1x text-muted">
            Reconocemos el papel fundamental que desempeñan los proveedores de servicios de internet en la reducción de la
            brecha digital y en la facilitación del acceso a internet en áreas marginadas y rurales. En apoyo a esta misión, nos
            complace ofrecer un amplio programa de formación técnica diseñado específicamente para equipar a los proveedores
            de servicios de internet con las habilidades y conocimientos necesarios para desplegar y mantener infraestructuras de
            fibra óptica de manera eficiente y efectiva
            </p>
        </div>

        <!-- PRODUCTOS -->
        <div class="col-lg-4 col-md-4 order-md-2 text-center">
    
              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/wisp/cursos-1.png">
              </h6>
              <button type="button" class="btn btn-primary" onclick="window.open('../Cursos/2-curso-de-planta-interna', '_blank')">Conocer más</button>
     
        </div>
        <div class="col-lg-4 col-md-4 order-md-2 text-center">
              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/wisp/cursos-2.png">
              </h6>
              <button type="button" class="btn btn-primary" onclick="window.open('../Cursos/1-curso-de-planta-externa', '_blank')">Conocer más</button>
        </div>
        <div class="col-lg-4 col-md-4 order-md-2 text-center">
              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/wisp/cursos-3.png">
              </h6>
              <button type="button" class="btn btn-primary" onclick="window.open('../Cursos/3-gpon', '_blank')">Conocer más</button>
        </div>

        <div class="col-lg-12 col-md-12 order-md-2 padding-top-3x ">

            <p style="text-align: justify;" class="text-muted">
            <b>OFERTA DE CAPACITACIÓN OPTRONICS</b><br/>
            Abrimos nuestras puertas para darte la bienvenida con talleres y actividades didáctica, porque tenemos la iniciativa de
            desarrollar tus capacidades de instalador e integrador de equipos y redes de telecomunicaciones con enfoque en fibra
            óptica para que alcances tus metas.
            </p>
        </div>
           
        <div class="col-lg-12 col-md-12 order-md-2">

            <p style="text-align: justify;" class="padding-top-1x text-muted">
            <b>DEVELOP</b>
            es más que un curso, es un espacio exclusivo diseñado para generar simulaciones de campo en el que podrás
            realizar prácticas con herramientas especializadas, conocer de cerca los procesos y tener la instrucción de
            especialistas con vasta experiencia.
            </p>
        </div>


        <div class="col-lg-12 col-md-12 order-md-2">

            <p style="text-align: justify;" class="padding-top-1x text-muted">
            Capacitarte puede ser la clave para mantenerte actualizado y crecer en el mundo de las telecomunicaciones. Nuestra
            propuesta está dividida en <b>30% teoría y 70% práctica</b>, en cuatro apartados especializados que puedes disfrutar de uno
            sin haber cursado otro.
            </p>
        </div>

         <!-- BANNER 2-->
         <div class="col-lg-12 col-md-12 order-md-2 padding-top-3x">
              <div class="gallery-wrapper">
                <div class="gallery-item">
                  <img alt="" style="width:100%" class="rounded " src="../../public/images/img_spl/wisp/Insider_Banner1.png" alt="soluciones">
                  <span class="caption"><?php //echo $response->titulo;
                                        ?></span>
                </div>
              </div>
            </div>
        

            <div class="col-lg-12 col-md-12 order-md-2">
            <p style="text-align: justify;" class="padding-top-1x text-muted">
            <b>INSIDER</b><br/>
            Te presentamos nuestro programa de seminarios online totalmente gratuitos, en los que podrás apreciar de cerca
            equipos, herramientas y soluciones integrales que conforman las redes de telecomunicaciones del presente.
            </p>
            </div>

            <div class="col-lg-12 col-md-12 order-md-2">
            <p style="text-align: justify;" class="padding-top-1x text-muted">
            Nuestros seminarios surgen a partir de conocer las necesidades operativas de nuestros clientes, con el objetivo de
            mostrarles la utilidad de cada producto y su proceso de instalación y uso, porque queremos que tus metas se cumplan y
            tus proyectos se logren.
            </p>
            </div>


            <div class="col-lg-12 col-md-12 order-md-2">
            <div class="text-muted opacity-75 padding-top-3x ">CALENDARIO DE EVENTOS</div>
  <hr class="padding-top-1x">
  <h6 class=" text-normal padding-bottom-2x">Consulta nuestra oferta academica de todo el año.</h6>
  <div class="col-lg-12 col-md-8 order-md-2">
    <div class="accordion" id="accordion1" role="tablist">
      <?php
      $CatalogoCursos = new CatalogoCapacitaciones();
      $responseCal = $CatalogoCursos->getMonths("", "", false)->records;

      ?>
      <?php foreach ($responseCal as $row) : ?>
        <div class="card">
          <div class="card-header" role="tab" style="background-color:#f5f5f5;">
            <h3><a <?php if ($row->mes_num == date("n") && $row->anio == date("Y")) { ?> expanded="true" <?php } ?> class="collapsed" href="#collapse<?php echo $row->mes_num . $row->anio; ?>" data-toggle="collapse">
                <b><?php echo "Calendario actividades <span class='text-uppercase'>" . $row->mes_nombre . '</span>'; ?></b></a>
            </h3>
          </div>
          <div class="collapse <?php if ($row->mes_num == date("n") && $row->anio == date("Y")) { ?> show <?php } ?>" id="collapse<?php echo $row->mes_num . $row->anio; ?>" data-parent="#accordion1" role="tabpanel">
            <div class="card-body">
              <table style="width:100%;">
                <?php
                $CatalogoEventos = new CatalogoCapacitaciones();
                $responseCalEvents = $CatalogoEventos->getEventsCal("WHERE activo='si' AND month(start)= $row->mes_num AND YEAR(start) = $row->anio", "ORDER BY start ASC", false);
                $cont = 1;
                $cont1 = 1;
                foreach ($responseCalEvents as $row1) :
                  if ($cont == 1 || $varAnt != $row1->title) {
                    $CatalogoEventosEsp = new CatalogoCapacitaciones();
                    $responseCalEventsEsp = $CatalogoEventosEsp->getEventsCal("where month(start)= $row->mes_num AND YEAR(start) = $row->anio AND title='" . $row1->title . "'", "", false);
                    $rwSpan = count($responseCalEventsEsp);
                  }
                ?>
                  <tr style="border-spacing: 0 8px;">
                    <?php
                    if ($cont % 2) {
                      $colorBack = '#f5f5f5';
                    } else {
                      $colorBack = '#ffffff';
                    }
                   ?>
                    <td style="background-color:<?php echo $colorBack; ?>"><small><b>  <?php echo $row1->title; ?></b></small></td>
                    <td style="background-color:<?php echo $colorBack; ?>"><small>&nbsp;&nbsp;<?php echo $row1->title1; ?></small></td>
                    <td style="background-color:<?php echo $colorBack; ?>"><small><?php echo $row1->fecha; ?></small></td>
                    <td style="text-align:center; background-color:<?php echo $colorBack; ?>;"><small><?php echo $row1->costo; ?></small></td>
                    <td style="text-align:center; width:10%; background-color:<?php echo $colorBack; ?>">
                      <small>
                        <?php if ($row1->title == 'Insider') { ?>
                          <a style="color: #BF202F;" href="<?php echo $row1->link; ?>" target="_blank">Registro</a>
                        <?php } else { ?>
                          <a style="color: #BF202F;" href="<?php echo $row1->link; ?>" target="_blank">Ver más</a>
                        <?php } ?>
                      </small>
                    </td>
                  </tr>
                <?php
                  $varAnt = $row1->title;
                  $cont++;
                endforeach
                ?>
              </table>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
            </div>

            

            
            

            <!-- LOGO OPTRONICS -->
            <div class="col-lg-12 col-md-8 order-md-2 padding-top-2x">

              <h6 class="text-muted text-center text-normal ">
                <img alt="" src="../../public/images/img_spl/wisp/logo-fibremex.png" style="width:30%">
              </h6>

            </div>
            
            <div class="col-lg-12 col-md-12 order-md-2 padding-top-2x ">
            <p style="text-align: justify;" class="text-muted">
            Estamos comprometidos con la construcción de un país y un mundo mejor conectado. Nuestro objetivo es ser su socio
            de confianza en el camino hacia una conectividad más rápida, confiable y accesible para todos.
            </p>
            </div>
            
            <div class="col-lg-12 col-md-12 order-md-2 ">
            <p style="text-align: justify;" class="text-muted">
            Nuestros asesores están listos para atender tus dudas. Si deseas más información sobre nuestros productos
            escribenos a <b>ventas@fibremex.com.mx</b> o haz clic en el siguiente botón.
            </p>
            </div>

            <!-- BOTON -->
            <div class="col-lg-12 col-md-8 order-md-2 margin-top-2x ">

              <h6 class="text-muted text-center text-normal margin-top-1x">
                <a target="_blank" href="https://api.whatsapp.com/send?phone=+524423094756&text=%C2%A1Hola!%20Quiero%20m%C3%A1s%20informaci%C3%B3n%20sobre%20WISP">
                    <img style="width:30%" src="../../public/images/img_spl/wisp/boton whatsapp.png"></a>
              </h6>




            </div>

        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Footer.php'; ?>
  <!-- scripts JS -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Scripts.php'; ?>
  <script>
    //let Volumetria = JSON.parse('<?php //echo $jsonVolumetria; ?>');
        //console.log(Volumetria); // Output: ["apple", "banana", "cherry"]
        
        // Iterate over the array and display each fruit
        //Volumetria.forEach(Volumetria => {
        //    console.log(Volumetria);
        //});
    function ActualizaCantidadCarrete(Codigo,Cantidad){
/*
      let res=(searchByCriteria(Volumetria,Cantidad*4000,Codigo))
      let Desc=0
      console.log(res[0])
      console.log(res.length)
      if(res.length>0){
        Desc=res[0].descuento
      }
      */
      document.getElementById('ProductoCantidad-'+Codigo).value=Cantidad

     // $calculatePrice = $obj->ProductoPrecio - ($obj->ProductoPrecio * ($obj->Descuento / 100));
     // $priceUSD = bcdiv($calculatePrice, 1, 3);
     // $priceMXN = number_format($calculatePrice * $_SESSION['Ecommerce-WS-CurrencyRate'], 3);
      
      //let CalculatePrice = ( (PrecioProducto - (PrecioProducto * (Desc/100)))*(Cantidad*4000) )
      //let CalculatePrice3 = Math.trunc(CalculatePrice * 1000) / 1000;

      //$('#id-product-price-'+Codigo).empty()
      //$('#id-product-price-'+Codigo).append("$"+CalculatePrice3+" USD")
      
    }
    function searchByCriteria(Volumetriass, Cantidad, searchTerm) {
    return Volumetriass.filter(Volumetriaa => {
        // Verificar si la edad del usuario es mayor a minAge
        const matchesSearchTerm = ['codigo'].some(key => 
            String(Volumetriaa[key]).toLowerCase().includes(searchTerm.toLowerCase())
        );

        let minCondition = Cantidad >= Volumetriaa.min;
        
        let maxCondition = Cantidad <= Volumetriaa.max;
        
        // Devolver verdadero si ambas condiciones se cumplen
        return matchesSearchTerm && minCondition && maxCondition;
    });
}
  </script>
   <script>
      altura('.featured_products_card')
      altura('.featured_products_content')
      altura('.featured_products_price')
      altura('.featured_products_card_1')
      altura('.featured_products_content_1')
      
      PositionAltura('.SameHeight')

    </script>
</body>

</html>

<?php

unset($CatalogoCursos);
unset($response);
unset($first_cur);
unset($final_cur);

?>