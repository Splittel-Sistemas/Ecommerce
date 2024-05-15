<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
    
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>

    <!-- Page Content-->
    <div class="container padding-top-3x padding-bottom-3x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
    
          <!-- Gallery-->
          <div class="gallery-wrapper">
            <div class="gallery-item">
            <img class="rounded" src="../../public/images/img_spl/promociones/baner-landing.jpg" alt="promociones">
          <span class="caption"><?php //echo $response->titulo;?></span></div>
          </div>
         
          <h2 class="pt-4"><b>APOYAMOS LA ECONOMÍA DE TUS PROYECTOS</b></h2>
          <p style="text-align: justify;"><?php
                echo ('Aumentamos tus posibilidades de inversión con promociones que favorecen tu bolsillo. Conoce nuestra oferta de productos en 
                promoción, no dejes pasar más tiempo, hoy tienes la oportunidad de obtener tus soluciones de conectividad con una ventaja 
                agregada, ahorrar recursos de tu proyecto.');
            ?></p>
         <?php 
                if (!class_exists("CatalogoPromociones")) {
                  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Promociones/Promociones.php';
                  }
                  $CatalogoCursos = new CatalogoPromociones();
                  $responseI = $CatalogoCursos->get("WHERE activo = 'si' ", "", false)->records;
                  //echo $Json= json_encode($response);
            ?>
            <div class="row">
            <?php foreach ($responseI as $row ): 
              if($row->link!=''){ 
                $target="";
                if($row->pestana=='si')
                  $target="_blank";
                ?>
            <a class="text-decoration-none"  href="<?php echo $row->link;?>" target="<?php echo $target;?>" >
            <?php }?>
            <div class="row align-items-center padding-bottom-2x padding-top-2x" >
                    <div class="col-md-5">
                      
                      <img class="d-block m-auto img-thumbnail " src="../../public/images/img_spl/promociones/<?php echo $row->imagen;?>" alt="<?php echo $row->titulo;?>">
              
                    </div>
                    <div class="col-md-7 text-md-left text-center">
                      <div class="mt-30 hidden-md-up"></div>
                      <h2><b><?php echo $row->titulo;?></b></h2>
                      <p class="text-muted" style="text-align: justify;"><?php echo nl2br($row->texto);?></p>
                     <!-- <a style="color: #BF202F;" class="text-decoration-none" target="_blank" href="<?php echo $row->link;?>"><u><?php echo $row->vigencia;?></u>&nbsp;</a> -->
                     <span style="color: #BF202F;" class="text-decoration-none" ><?php echo $row->vigencia;?>&nbsp;</span> 
                    </div>
            </div>
            <?php if($row->link!=''){ ?>
            </a>
            <?php }?>
                  <hr style="width:100%; height: 15px;" id="I<?php echo $row->id?>">
            <?php endforeach ?>

            </div>
              <!-- Featured Products -->
              </div>
    </div>

    <section class="container padding-top-2x padding-bottom-2x mb-2 d-none d-xs-none  d-sm-none d-md-block d-lg-block d-md-block">
      <h2 class="h3 pb-3 text-center">Productos de remate</h2>
      <div class="row">
        <?php
        if (!class_exists("ProductoController")) {
          include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
        }
        $ProductoController = new ProductoController();
        $ProductoController->filter = "WHERE leyenda='Últimas existencias' ";
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
                <?php //$variable = $obj->Leyenda != "" ? '<div class="product-badge bg-danger">' . $obj->Leyenda . '</div>' : ""; ?>


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
    <div class="container padding-top-2x padding-bottom-3x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
          <div class="col-lg-12 col-md-8 order-md-2">          
         <!--
          <p class="text-muted text-center text-normal margin-top-3x">
            Seguimos con nuestra oferta de actividades y eventos para darte a conocer mejor las soluciones que ofrecemos y mantenerte
            actualizado con la información relevante y actual a todo lo relacionado con la fibra óptica y las telecomunicaciones.
         </p>
            -->
          <p class="text-muted text-center text-normal  margin-top-3x">
            <b>¿Quieres conocer más sobre nuestras promociones?</b><br/>
            Contáctanos para que un ejecutivo pueda atenderte.
         </p>
        
          <h6 class="text-muted text-center text-normal margin-top-3x">
            <a target="_blank" href="https://api.whatsapp.com/send?phone=+524423094756&text=%C2%A1Hola! Me gustario obtener informacion sobre las promociones"><img src="../../public/images/img_spl/capacitaciones/whatsapp-fibremex.png"></a>
          </h6>

         
          
          <!-- Post Tags + Share-->
          <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 pb-4">
            <div class="pb-2"></div>
            <div class="pb-2"><span class="d-inline-block align-middle text-sm text-muted">Share post:&nbsp;&nbsp;&nbsp;</span>
            <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a>
            <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-twitter" href="https://twitter.com/share?ref_src=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>"><i class="socicon-twitter"></i></a>
          <!--  <a class="social-button shape-rounded sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="socicon-instagram"></i></a> -->
            
            </div>
          </div>
          <!-- Post Navigation-->
            </div>
          
        </div>
        </div>
        </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
  
  </body>
</html>

<?php 
  
  unset($CatalogoCursos);
  unset($response);
  unset($first_cur);
  unset($final_cur);
  
 ?>