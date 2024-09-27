<!DOCTYPE html>
<html lang="en">

<head>
  <!-- <title> Contacto </title> -->
  <?php //include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Head.php'; ?>
  <title>Aprovecha 3 meses sin intereses en equipos de medición y accesorios de fibra óptica</title>
  <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8">
    <meta name="Description" content="Compra equipos de medición y accesorios para fibra óptica con 3 meses sin intereses. Aprovecha esta promoción para optimizar tus proyectos de fibra óptica con facilidades de pago" />
<!-- Favicon and Apple Icons-->
<link rel="icon" type="image/x-icon" href="../../public/Icons/fibremex.ico">
<!-- Vendor Styles including: Bootstrap, Font Icons, public, etc.-->
<link rel="stylesheet" media="screen" href="../../public/plantilla/css/vendor.min.css">
<!-- Main Template Styles-->
<link id="mainStyles" rel="stylesheet" media="screen" href="../../public/plantilla/css/styles-BF202F.min.css">
<link  rel="stylesheet" media="screen" href="../../public/plantilla/customizer/customizer.min.css">
<link rel="stylesheet" type="text/css" href="../../public/plugins/tingle/tingle.css">
<!--  Google Tag Manager Documentacion  -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5VNXXFL');</script>
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
                  <img alt="" style="width:100%" class="rounded " src="../../public/images/img_spl/promociones/msi/landing-msi.png" alt="soluciones">
                  <span class="caption"><?php //echo $response->titulo;
                                        ?></span>
                </div>
              </div>
            </div>
            <!--TEXTO 1-->
            <div class="col-lg-12 col-md-12 order-md-2">

              <p style="text-align: justify;" class="padding-top-1x text-muted">
              Del <b>09 de septiembre al 31 de octubre</b> equípate con los mejores equipos en medición y accesorios de la marca <b>Optronics</b>® y 
              disfruta de <b>3 meses sin intereses</b> en compras superiores a 500 USD + IVA.
              </p>
            </div>
            <div class="col-lg-12 col-md-12 order-md-2">
            <h4 class="text-muted opacity-75 margin-top-1x">
                  <strong>Conoce los productos participantes</strong>
                </h4>
            </div>
            <div class="col-lg-12 col-md-12 order-md-2 padding-bottom-1x">
            <h6 class="text-muted opacity-75 ">
                  <strong>Equipos de medición OTDRs</strong>
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
        $ProductoController->filter = "WHERE codigo IN ('OPEMMINOTDR2101','OPEMFHO51','OPEMFHO51MD2140FCU','OPEMFHO51T43F') AND producto_activo='si' ";
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
                    <h4 class="product-price" id="id-product-price-<?php echo $obj->ProductoCodigo?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceMXN; ?> MXP">
                      $<?php echo $priceUSD ?> USD
                    </h4>
                    <?php } ?>
                    </div>
                </div>
                <div class="product-button-group">
                 
                  <?php if ($obj->MinimoCompra > 0) { ?>
            <input type="hidden" name="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" id="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" value="<?php echo $obj->MinimoCompra;?>">
          <?php }else{ ?>
          <input type="hidden" name="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" id="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" value="1">
          <?php } ?>
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



            <!-- CIERRES DE EMPLAME-->
            <div class="col-lg-12 col-md-12 order-md-2 padding-top-2x padding-bottom-1x">
              <div class="row">
                <div class="col-lg-6 col-md-6">
                    <h6 class="text-muted opacity-75 ">
                      <strong>Equipo y accesorios de fusión</strong>
                    </h6>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h6 class="text-muted opacity-75 ">
                      <strong>Bobinas de lanzamiento</strong>
                    </h6>
                </div>
              </div>
            </div>
            <div class="col-lg-12 col-md-12 order-md-2">
            <div class="row SameHeight">
            <?php
        if (!class_exists("ProductoController")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
        }
        $ProductoController = new ProductoController();
        $ProductoController->filter = "WHERE codigo IN ('OPEFEMPANU04001','OPHEKPRFEMP') AND producto_activo='si' ";
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
                    <h4 class="product-price" id="id-product-price-<?php echo $obj->ProductoCodigo?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceMXN; ?> MXP">
                      $<?php echo $priceUSD ?> USD
                    </h4>
                    <!--
                    <input class="form-control form-control-sm text-center" type="number" oninput="ActualizaCantidadCarrete('<?php echo $obj->ProductoCodigo?>',this.value,<?php echo $obj->ProductoPrecio?>)"  value="1">
                    -->
                   
                    <?php } ?>
                    </div>
                </div>
                <div class="product-button-group">
                 
                <?php if ($obj->MinimoCompra > 0) { ?>
            <input type="hidden" name="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" id="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" value="<?php echo $obj->MinimoCompra;?>">
          <?php }else{ ?>
          <input type="hidden" name="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" id="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" value="1">
          <?php } ?>
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

            <div class="col-md-3 col-sm-6 col-12">
            </div>
        <?php
       
       
                     $SubcategoriasN1Controller = new SubcategoriasN1Controller();
                     
                       $SubcategoriaKeyGPO='';
                       $SubcategoriasN1Controller->filter = "WHERE id_subcategoria = 'S000039' AND activo='si' ";
                    
                     
                     $SubcategoriasN1Controller->order = "";
                     
                     $ResultSubcategoriasN1 = $SubcategoriasN1Controller->get();
                     
                     if($ResultSubcategoriasN1->count > 0 ){
                       $SubcategoriaN1Key = $ResultSubcategoriasN1->records[0]->CategoriasKey;
                       
                       foreach ($ResultSubcategoriasN1->records as $key => $SubcategoriaN1){ 
                         $ConfiguracionPath = $SubcategoriaN1->Configuracion == 1 
                         ? "../Productos/configurables.php?codigo=".$SubcategoriaN1->Codigo."" : "#";
       
                         $imgUrl = file_exists(("../../public/images/img_spl/subsubcategorias/".$SubcategoriaN1->FolderName.".jpg")) 
                         ? "../../public/images/img_spl/subsubcategorias/".$SubcategoriaN1->FolderName.".jpg" 
                         : "../../public/images/img_spl/notfound1.png"; 
                     ?>
                       <div class="col-md-3 col-sm-6 col-12">
                         <div class="product-card mb-30">
                           <?php if ($SubcategoriaN1->Configuracion == 0){ ?>
                           <div class="product-badge bg-primary">Próximamente</div>
                           <?php } ?>
                           <a class="product-thumb" href="<?php echo $ConfiguracionPath ?>&nom=<?php echo url_amigable($SubcategoriaN1->Descripcion);?>">
                           <img src="<?php echo $imgUrl ?>" alt="<?php echo $SubcategoriaN1->Descripcion;?>"></a>
                           <div class="product-card-body">
                             <h1 class="product-title"><a href="<?php echo $ConfiguracionPath ?>&nom=<?php echo url_amigable($SubcategoriaN1->Descripcion);?>"><?php echo $SubcategoriaN1->Descripcion;?></a></h1>
                           </div>
                         </div>
                       </div>
                     <?php 
                         } 
                       } 
        ?>
            </div>
            </div>
            
       
        
            <div class="col-lg-12 col-md-12 order-md-2 padding-bottom-1x">
            <h6 class="text-muted opacity-75 ">
                  <strong>Accesorios</strong>
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
        $ProductoController->filter = "WHERE codigo IN ('OPEMVFL01MW','OPEMFVL10MW','OPEM3306B','OPHE2212',
                                                        'OPHE2211','OPHE2210','OPEMADLC125','OPHECOPACC20T',
                                                        'OPEFCOP001','OPHECOPACC20D') AND producto_activo='si' ";
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
                    <h4 class="product-price" id="id-product-price-<?php echo $obj->ProductoCodigo?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceMXN; ?> MXP">
                      $<?php echo $priceUSD ?> USD
                    </h4>
                    <!--
                    <input class="form-control form-control-sm text-center" type="number" oninput="ActualizaCantidadCarrete('<?php echo $obj->ProductoCodigo?>',this.value,<?php echo $obj->ProductoPrecio?>)"  value="1">
                    -->
                   
                    <?php } ?>
                    </div>
                </div>
                <div class="product-button-group">
                 
                <?php if ($obj->MinimoCompra > 0) { ?>
            <input type="hidden" name="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" id="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" value="<?php echo $obj->MinimoCompra;?>">
          <?php }else{ ?>
          <input type="hidden" name="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" id="ProductoCantidad-<?php echo $obj->ProductoCodigo; ?>" value="1">
          <?php } ?>
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
        



        <div class="col-lg-12 col-md-12 order-md-2 padding-top-3x ">
        <p style="text-align: justify;" class="text-muted text-center">
            <b>¿Cómo aprovechar la promoción?</b>
            </p>
            <p style="text-align: justify;" class="text-muted">
            1.  Ingresa a <a href="https://fibremex.com/fibra-optica/views/Login/">fibremex.com</a> e inicia sesión. 
                Si no cuentas con tu acceso, comunícate con tu ejecutivo de ventas o contáctanos <a href="https://fibremex.com/fibra-optica/views/Contacto/">aquí.</a><br/>
            2.  Los productos participantes tendrán la etiqueta <b>3 MSI.</b><br/>
            3.  Elige los productos de tu interés y añádelos al carrito.<br/>
            4.  Dirígete a tu <b>carrito</b> y verifica tu lista de productos.<br/>
            5.  Haz clic en <b>Terminar pedido</b>.<br/>
            6.  Completa los datos de envío y paquetería<br/>
            7.  En la sección de pago, ingresa tu tarjeta de crédito (consulta las tarjetas participantes) y selecciona <b>3 meses sin intereses</b>.<br/>
            8.  Haz clic en resumen, después en <b>pagar</b> y ¡listo!<br/>

            </p>
            <p style="text-align: justify;" class="text-muted text-center padding-top-3x ">
            <b>
            ¡Disfruta de tus productos y maximiza su rendimiento!
            </b>
            </p>
            <p style="text-align: justify;" class="text-muted text-center">
            <i>Nota:</i> La promoción no se verá reflejada si el pedido incluye productos fuera de la oferta
            </p>
        </div>
           
        <div class="col-lg-12 col-md-12 order-md-2 padding-top-3x text-center" >
        <p style="text-align: justify;" class="text-muted text-center">
            <b>
            TARJETAS PARTICIPANTES
            </b>
            </p>
          
            <div class="debit">
              <img class="img-responsive" src="../../public/images/OpenPay/cards1.png">
            </div>
          
        </div>
         <!-- BANNER 2-->
        
         <div class="col-lg-12 col-md-12 order-md-2 padding-top-3x">
              <div class="gallery-wrapper">
                <div class="gallery-item">
                  <img alt="" style="width:100%" class="rounded " src="../../public/images/img_spl/promociones/msi/landing-msi1.png" alt="soluciones">
                  <span class="caption"><?php //echo $response->titulo;
                                        ?></span>
                </div>
              </div>
            </div>

            <div class="col-lg-12 col-md-12 order-md-2 text-center">
            <p style="text-align: justify;" class="padding-top-1x text-muted">
            Al adquirir alguno de nuestros equipos de medición, recibirás un curso de capacitación personalizado para un uso adecuado de tu equipo.
            <br/>
            <p style="font-size:13px;" class=" text-muted">*Disponible de forma presencial en nuestras instalaciones o en modalidad online.</p>

            </p>
            </div>


            <div class="col-lg-12 col-md-12 order-md-2">
            <p style="text-align: justify;" class="padding-top-3x text-muted text-center">
            <b>¿POR QUÉ ELEGIRNOS?</b>
            </p>
            </div>
            <div class="col-lg-12 col-md-8 order-md-2">

           
</div>

        <!-- PRODUCTOS -->
        <div class="col-lg-4 col-md-4 order-md-2 text-center">
    
              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/promociones/msi/b1.png">
              </h6>
              <h5 class="text-center    margin-top-1x" style="font-size : 16px;color:#505050">
              <b>Medición precisa:</b>
              </h5>
              <p style="text-align: justify;" class="padding-top-1x text-muted text-center">
              Equipos OTDRs que garantizan la validación y optimización de tu red.
              </p>
     
        </div>
        <div class="col-lg-4 col-md-4 order-md-2 text-center">
              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/promociones/msi/b2.png">
              </h6>
              <h5 class="text-center    margin-top-1x" style="font-size : 16px;color:#505050">
              <b>Experiencia y confianza:</b>
              </h5>
              <p style="text-align: justify;" class="padding-top-1x text-muted text-center">
              Más de 24 años en el mercado nos respaldan como líderes en soluciones de fibra óptica y telecomunicaciones
              </p>
        </div>
        <div class="col-lg-4 col-md-4 order-md-2 text-center">
              <h6 class="text-muted text-center text-normal margin-top-2x">
                <img alt="" src="../../public/images/img_spl/promociones/msi/b3.png">
              </h6>
              <h5 class="text-center    margin-top-1x" style="font-size : 16px;color:#505050">
              <b>Eficiencia y rapidez:</b>
              </h5>
              <p style="text-align: justify;" class="padding-top-1x text-muted text-center">
              Soluciones diseñadas para agilizar y mejorar la instalación y el mantenimiento de tus proyectos de fibra óptica.
              </p>
        </div>
          
          
          
            <div class="col-lg-12 col-md-12 order-md-2">
            <p style="text-align: justify;" class="padding-top-3x text-muted text-center">
            <h1 class="text-muted text-center"><b>La precisión y calidad que tu red merece, solo con Optronics®</b></h1>
            </p>
            </div>
            

            
            <div class="col-lg-12 col-md-8 order-md-2 padding-top-2x">

            <h6 class="text-muted text-center text-normal ">
            <img alt="" src="../../public/images/img_spl/wisp/logo-fibremex.png" style="width:30%">
            </h6>

            </div>


           
            <div class="col-lg-12 col-md-12 order-md-2 padding-top-2x">
            <p style="text-align: justify;" class="text-muted">
            Nuestros asesores están listos para atender tus dudas. Si deseas más información sobre nuestros productos
            escribenos a <b>ventas@fibremex.com.mx</b> o haz clic en el siguiente botón.
            </p>
            </div>

            <!-- BOTON -->
            <div class="col-lg-12 col-md-8 order-md-2 margin-top-2x ">

              <h6 class="text-muted text-center text-normal margin-top-1x">
                <a target="_blank" href="https://api.whatsapp.com/send?phone=+524423094756&text=%C2%A1Hola!%20Quiero%20m%C3%A1s%20informaci%C3%B3n%20sobre%20MSI">
                    <img style="width:30%" src="../../public/images/img_spl/wisp/boton whatsapp.png"></a>
              </h6>

            </div>

            <div class="col-lg-12 col-md-12 order-md-2 padding-top-2x">
            <p style="text-align: justify;" class="text-muted" >
            <b>Términos y condiciones:</b><br/>
            * Compra mínima de 500 USD + IVA.<br/>
            * Solo con tarjetas de crédito participantes, hasta agotar existencias.<br/>
            * Promoción válida únicamente para compras realizadas a través de nuestro e-commerce.<br/>
            * La promoción no se verá reflejada al momento del pago si el pedido incluye productos fuera de la promoción.<br/>
            * Accesorios participantes: Localizadores de fallas, adaptadores y equipos de corte.<br/>
            * Sujeto a restricciones.

            </p>
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