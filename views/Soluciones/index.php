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

      if (!class_exists("SolucionesController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Soluciones/Soluciones.Controller.php';
      }if (!class_exists("ProductoController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Producto.Controller.php';
      }if (!class_exists("SubcategoriasN1Controller")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/SubcategoriasN1.Controller.php';
      }

      $SolucionesController = new SolucionesController();
      $SolucionesController->filter = "WHERE activo = 'si' AND id = '".$_GET['id']."' ";
      $SolucionesController->order = "";
      $Soluciones = $SolucionesController->GetBy();
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Soluciones</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li><?php echo $Soluciones->Descripcion; ?></li>
          </ul>
        </div>
      </div>
    </div>
     <!-- Page Content-->
    <div class="container padding-bottom-1x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
          <!-- Post Meta-->
          <ul class="post-meta mb-4">
            <li>
              <i class="icon-clock"></i>
              <a href="#"><?php echo ucwords(strftime( '%B' , strtotime($Soluciones->Fecha))).' '.strftime(date("j, Y",strtotime($Soluciones->Fecha)));?></a>
            </li>
          </ul>
          <!-- BANNER-->
          <?php if(!empty($Soluciones->Img)): ?>
          <div class="gallery-wrapper">
            <div class="gallery-item">
              <img src="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img;?>" alt="<?php echo $Soluciones->Titulo;?>">
            </div>
          </div>
          <?php endif ?>
          
          <!-- SUBTITULO 1-->
          <?php if(!empty($Soluciones->Subtitulo)): ?>
          <h5 class="pt-4 padding-bottom-0x d-flex justify-content-left" >
          <?php echo $Soluciones->Subtitulo?></h5>
          <?php endif ?>

          <!-- TEXTO 1-->
          <?php if(!empty($Soluciones->Texto)): ?>
          <p style="text-align: justify;">
            <?php echo nl2br($Soluciones->Texto); ?>
          </p>
          <?php endif ?>

          
          <!-- COMILLAS-->
          <div class="row pt-3 pb-2">
            <div class="col-xl-10 offset-xl-1">
              <blockquote class="margin-top-1x margin-bottom-1x">
                <p><?php echo nl2br($Soluciones->Comillas)?></p>
              </blockquote>
            </div>
          </div>
          
          <!-- TEXTO ALT-->
          <?php if(!empty($Soluciones->Texto_alt)): ?>
          <p style="text-align: justify;"><?php echo nl2br($Soluciones->Texto_2); ?></p>
          <?php endif?>
          
          <!-- IMAGEN -->
          <?php if(!empty($Soluciones->Img_alt)):
            list($ancho, $alto, $tipo, $atributos) = getimagesize("../../public/images/img_spl/soluciones/$Soluciones->Img_alt");
            $atributos1=$ancho."x".$alto;
            ?>
              <div class="gallery-wrapper">
                <div class="gallery-item">
                <a href="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img_alt;?>" data-size="<?php echo $atributos1;?>">
                <img src="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img_alt;?>" alt="<?php echo $Soluciones->Descripcion;?>"></a><span class="caption"><?php echo $Soluciones->Descripcion;?></span>
                </div>
              </div>
          <?php endif?>
          
          <!-- SUBTITULO 2-->
          <?php if(!empty($Soluciones->Subtitulo_2)): ?>
          <h5 class="pt-4 padding-bottom-0x d-flex justify-content-left" >
          <?php echo $Soluciones->Subtitulo_2?></h5>
          <?php endif ?>
          
          <!-- TEXTO 2-->
          <?php if(!empty($Soluciones->Texto_2)): ?>
          <p style="text-align: justify;"><?php echo nl2br($Soluciones->Texto_2); ?></p>
          <?php endif?>

          <?php if(!empty($Soluciones->Img_2)):
            list($ancho, $alto, $tipo, $atributos) = getimagesize("../../public/images/img_spl/soluciones/$Soluciones->Img_2");
            $atributos1=$ancho."x".$alto;
            ?>
              <div class="gallery-wrapper">
                <div class="gallery-item">
                <a href="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img_2;?>" data-size="<?php echo $atributos1;?>">
                <img src="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img_2;?>" alt="<?php echo $Soluciones->Descripcion;?>"></a><span class="caption"><?php echo $Soluciones->Descripcion;?></span>
                </div>
              </div>
          <?php endif?>
           <!-- SUBTITULO 3-->
           <?php if(!empty($Soluciones->Subtitulo_3)): ?>
          <h5 class="pt-4 padding-bottom-0x d-flex justify-content-left" >
          <?php echo $Soluciones->Subtitulo_3?></h5>
          <?php endif ?>
          
          <!-- TEXTO 3-->
          <?php if(!empty($Soluciones->Texto_3)): ?>
          <p style="text-align: justify;"><?php echo nl2br($Soluciones->Texto_3); ?></p>
          <?php endif?>
          
         <!-- IMG 3-->   
          <?php if(!empty($Soluciones->Img_3)):
                list($ancho1, $alto1, $tipo, $atributos) = getimagesize("../../public/images/img_spl/soluciones/$Soluciones->Img_3");
                $atributos2=$ancho1."x".$alto1;
                ?>
            <br />
            <br />
            <div class="gallery-wrapper">
              <div class="gallery-item"><a href="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img_3;?>" data-size="<?php echo $atributos2;?>">
                <img src="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img_3;?>" alt="<?php echo $Soluciones->Descripcion;?>"></a><span class="caption"><?php echo $Soluciones->Descripcion;?></span>
              </div>
            </div>
           <?php endif ?>
          
           <!-- SUBTITULO 4-->
           <?php if(!empty($Soluciones->Subtitulo_4)): ?>
          <h5 class="pt-4 padding-bottom-0x d-flex justify-content-left" >
          <?php echo $Soluciones->Subtitulo_4?></h5>
          <?php endif ?>
          
          <!-- TEXTO 4-->
          <?php if(!empty($Soluciones->Texto_4)): ?>
          <p style="text-align: justify;"><?php echo nl2br($Soluciones->Texto_4); ?></p>
          <?php endif?>
          
          <!-- IMG 4-->   
          <?php if(!empty($Soluciones->Img_4)):
                list($ancho1, $alto1, $tipo, $atributos) = getimagesize("../../public/images/img_spl/soluciones/$Soluciones->Img_4");
                $atributos2=$ancho1."x".$alto1;
                ?>
            <br />
            <br />
            <div class="gallery-wrapper">
              <div class="gallery-item"><a href="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img_4;?>" data-size="<?php echo $atributos2;?>">
                <img src="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img_4;?>" alt="<?php echo $Soluciones->Descripcion;?>"></a><span class="caption"><?php echo $Soluciones->Descripcion;?></span>
              </div>
            </div>
           <?php endif ?>
          
          <!-- IMG 5-->   
          <?php if(!empty($Soluciones->Img_5)):
                list($ancho1, $alto1, $tipo, $atributos) = getimagesize("../../public/images/img_spl/soluciones/$Soluciones->Img_5");
                $atributos2=$ancho1."x".$alto1;
                ?>
            <br />
            <br />
            <div class="gallery-wrapper">
              <div class="gallery-item"><a href="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img_5;?>" data-size="<?php echo $atributos2;?>">
                <img src="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img_5;?>" alt="<?php echo $Soluciones->Descripcion;?>"></a><span class="caption"><?php echo $Soluciones->Descripcion;?></span>
              </div>
            </div>
           <?php endif ?>
          
           <!-- SUBTITULO 5-->
           <?php if(!empty($Soluciones->Subtitulo_5)): ?>
          <h5 class="pt-4 padding-bottom-0x d-flex justify-content-left" >
          <?php echo $Soluciones->Subtitulo_5?></h5>
          <?php endif ?>

          <!-- IMG 6-->   
          <?php if(!empty($Soluciones->Img_6)):
                list($ancho1, $alto1, $tipo, $atributos) = getimagesize("../../public/images/img_spl/soluciones/$Soluciones->Img_6");
                $atributos2=$ancho1."x".$alto1;
                ?>
            <br />
            <br />
            <div class="gallery-wrapper">
              <div class="gallery-item"><a href="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img_6;?>" data-size="<?php echo $atributos2;?>">
                <img src="../../public/images/img_spl/soluciones/<?php echo $Soluciones->Img_6;?>" alt="<?php echo $Soluciones->Descripcion;?>"></a><span class="caption"><?php echo $Soluciones->Descripcion;?></span>
              </div>
            </div>
           <?php endif ?>

           <!-- SUBTITULO 6-->
           <?php if(!empty($Soluciones->Subtitulo_6)): ?>
          <h5 class="pt-4 padding-bottom-0x d-flex justify-content-left" >
          <?php echo $Soluciones->Subtitulo_6?></h5>
          <?php endif ?>
          
          <!-- VIDEO-->   
          <?php if(!empty($Soluciones->Video)):
                ?>
            <?php echo "video"?>
           <?php endif ?>
          
           <?php if(!empty($Soluciones->Img_formulario && $Soluciones->To_formulario)):
                ?>
            <?php echo "formulario"?>

           <?php endif ?>

        </div>
      </div>
    </div>
    
            
      <?php
      $SolucionesController->filter = "WHERE id_solucion = '".$_GET['id']."' ";
      $SolucionesController->order = "";
      $SolucionesRelacionados = $SolucionesController->Relacionados();
      if($SolucionesRelacionados->count>0):
      ?>
      <div class="container padding-bottom-1x mb-2">
            <div class="row justify-content-center ">
              <div class="col-xl-9 col-lg-8 order-lg-2">
                <h5 class="padding-top-1x padding-bottom-1x">
                  Productos Relacionados
                </h5>
              </div>
            </div>
          </div>  

      <div class="container padding-bottom-1x mb-2">
        <div class="row justify-content-center ">
          <div class="col-md-9 col-sm-8 col-12">  
            <div class="row">
            <?php  
              $ProductoController = new ProductoController();
              
              foreach ($SolucionesRelacionados->records as $key => $Relacionados){
                if($Relacionados->Tipo == NULL){
                  $ProductoController->filter = "WHERE codigo = '".$Relacionados->Codigo."' AND (codigo_configurable = '' OR codigo_configurable IS NULL ) AND producto_activo = 'si'  ";
                  $ProductoController->order = "";
                  $Producto = $ProductoController->GetByProductosFijos();
                  if(!empty($Producto->ProductoCodigo)){
            ?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-4" >
              <div class="product-card mb-30 grid_1_4" >
                <a class="product-thumb" href="../Productos/fijos.php?id_prd=<?php echo $Relacionados->Codigo;?>">
                  <?php 
                    $imgUrl = file_exists(utf8_decode("../../public/images/img_spl/productos/".$Relacionados->Codigo."/thumbnail/".$Producto->ProductoImgPrincipal."")) 
                    ? "../../public/images/img_spl/productos/".$Relacionados->Codigo."/thumbnail/".$Producto->ProductoImgPrincipal."" 
                    : "../../public/images/img_spl/notfound.png"; 
                  ?>
                  <img src="<?php echo $imgUrl; ?>" alt="<?php echo $Producto->ProductoDescripcion;?>">
                </a>
                <div class="rating-stars">
                  <?php 
                    if (!class_exists('ComentariosController')) {
                      include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Productos/Comentarios.Controller.php';
                    }
                    $ComentariosController = new ComentariosController();
                    $ComentariosController->filter = "WHERE IdProducto = '".$Relacionados->Codigo."'";
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
                  <div class="product-category "><a href="../Productos/fijos.php?id_prd=<?php echo $Relacionados->Codigo;?>"><?php echo $Relacionados->Codigo?></a></div>
                  <h3 class="product-title grid_1_3">
                  <a href="../Productos/fijos.php?id_prd=<?php echo $Relacionados->Codigo;?>"><?php echo $Producto->ProductoDescripcion;?></a>
                  
                  </h3>
                  <h4 class="product-price" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo number_format((($Producto->ProductoPrecio-($Producto->ProductoPrecio*($Producto->Descuento/100))) * $_SESSION['Ecommerce-WS-CurrencyRate']),3) ;?> MXP">
                  $<?php echo bcdiv($Producto->ProductoPrecio-($Producto->ProductoPrecio*($Producto->Descuento/100)),1,3); ?> USD
                  </h4>
                </div>
                <div class=" product-button-group">
                  <input type="hidden" name="ProductoCantidad-<?php echo $Relacionados->Codigo;?>" id="ProductoCantidad-<?php echo $Relacionados->Codigo;?>" value="1">
                  <a class="product-button" href="#" descuento="<?php echo $Producto->Descuento ?>" codigo="<?php echo $Relacionados->Codigo;?>" onclick="AgregarArticulo(this)"><i class="icon-shopping-cart"></i>
                <span>Agregar al carrito</span></a></div>
              </div>
            </div>
            <?php 
                } 
              }else{ 

              $SubcategoriasN1Controller = new SubcategoriasN1Controller();
              $SubcategoriasN1Controller->filter = "WHERE codigo = '".$Relacionados->Codigo."' AND activo='si' ";
              $ResultSubcategoriasN1Controller = $SubcategoriasN1Controller->get();

              if($ResultSubcategoriasN1Controller->count > 0){
              foreach ($ResultSubcategoriasN1Controller->records as $key => $Subcategorias) {
                $ConfiguracionPath = $row->SubcategoriaConfiguracion == 1 
                ? "../Productos/configurables.php?codigo=".$row->SubcategoriaCodigo." " : "#";

                $imgUrl = file_exists(("../../public/images/img_spl/subsubcategorias/".$row->SubcategoriaDescripcion.".jpg")) 
                ? "../../public/images/img_spl/subsubcategorias/".$row->SubcategoriaDescripcion.".jpg" 
                : "../../public/images/img_spl/notfound1.png"; 
            ?>
            <div class="col-md-4 col-sm-4 col-12">
              <div class="product-card mb-30">
                <?php if ($Subcategorias->Configuracion == 0): ?>
                <div class="product-badge bg-primary">Próximamente</div>
                <?php endif ?>
                <a class="product-thumb" href="<?php echo $ConfiguracionPath ?>">
                <img src="<?php echo $imgUrl ?>" alt="<?php echo $Subcategorias->Descripcion;?>"></a>
                <div class="product-card-body">
                  <h3 class="product-title grid_1_3"><a href="<?php echo $ConfiguracionPath ?>"><?php echo $Subcategorias->Descripcion;?></a></h3>
                </div>
              </div>
            </div>
            <?php 
                    }
                  } 
                } 
              }
            ?>
          </div>
        </div>
      </div>
    </div>
          <?php endif ?>




    <div class="container padding-bottom-2x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
          <!-- Post Tags + Share-->
          <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 pb-4">
            <div class="pb-2"></div>
            <div class="pb-2"><span class="d-inline-block align-middle text-sm text-muted">Share post:&nbsp;&nbsp;&nbsp;</span>
              <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a>
              <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-twitter" href="https://twitter.com/share?ref_src=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>"><i class="socicon-twitter"></i></a>
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
<?php 
  unset($SolucionesController);
  unset($Soluciones);
  unset($SolucionesRelacionados);
  unset($ProductoController);
  unset($Producto);
  unset($ComentariosController);
  unset($Comentarios);
  unset($SubcategoriasN1Controller);
  unset($ResultSubcategoriasN1Controller);
?>