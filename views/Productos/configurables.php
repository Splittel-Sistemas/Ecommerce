<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include  $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
    <!--  -->
    <link href="../../public/fonts/Roboto/Roboto.css?family=Roboto+Mono&display=swap" rel="stylesheet">
    <style type="text/css">
      .styleClave{
        font-family: 'Roboto Mono', monospace;
      }
    </style>
  </head>
  <!-- Body-->
  <body>
    <?php 
      #Header
      include  $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; 

      if (!class_exists("CategoriaController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Categorias/Categoria.Controller.php';
      }

      $CategoriaController = new CategoriaController();
      $CategoriaController->filter = "WHERE codigo = '".$_GET['codigo']."' ";
      $CategoriaController->order = "";
      $Obj = $CategoriaController->estructura();
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1 id="descripcion-producto-configurable" descripcion="<?php echo $Obj->SubcategoriaN1Descripcion; ?>"><?php echo $Obj->SubcategoriaN1Descripcion; ?></h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>
              <a href="categorias.php?id_ct=<?php echo $Obj->CategoriaCodigoKey ?>"><?php echo $Obj->CategoriaDescripcion; ?></a>
            </li>
            <li class="separator">&nbsp;</li>
            <li><a href="categorias.php?id_sbct=<?php echo $Obj->SubcategoriaN1Key ?>&sbn=<?php echo $Obj->SubcategoriaSubnivel ?>"><?php echo $Obj->SubcategoriaDescripcion; ?></a>
            </li>
            <li></li>
            <li>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x">
      <div class="row">
        <!-- Poduct Gallery-->
        <div class="col-md-6">
          <div class="product-gallery">
            <div class="gallery-wrapper">
              <div class="gallery-item video-btn text-center" id="video-producto">
                
              </div>
            </div><!--<span class="product-badge bg-danger">Sale</span> -->
            <div id="showcarousel">

            </div>
          </div>
        </div>
        <!-- Product Info-->
        <div class="col-md-6">
          <div class="padding-top-2x mt-2 hidden-md-up"></div>
          <h2 class="mb-3"></h2>
          <span class="h3 d-block"><img src="../../public/images/img_spl/marcas/optronics1.png"/></span>
          <div id="leyenda" class="col-12 mb-4">
            <span class="h3 " id="Costo" >$ </span>
          </div>
          <div class="col-12 pt-1 mb-5">
            <span class="product-badge bg-secondary border-default text-body">
              Stock: <span id="add-stock"></span>
            </span>
          </div>
          <input type="hidden" id="CostoProducto">
          <p class="mt-3 text-muted text-justify" id="descripcionLarga"></p>
            <input type="hidden" id="Cable" name="Cable" value="<?php echo $Obj->SubcategoriaN1Codigo; ?>">
            <?php 
              $FileUbicacionTemplate = $Obj->CategoriaFolderName.'/'.$Obj->SubcategoriaFolderName;
              $FileUbicacionJs = $Obj->CategoriaFolderName.'/'.$Obj->SubcategoriaN1Key;
              include  $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Productos/Categorias/'.$FileUbicacionTemplate.'/index.php';             
            ?>  
          <div class="row align-items-end pb-4">
            <div class="col-sm-4">
              <div class="form-group mb-0" id="div-quantity">
                <label for="quantity">Cantidad</label>
                <input type="text" class="form-control" name="quantity" id="quantity">
                <input type="hidden" class="form-control" name="CodeClave" id="CodeClave">
                <input type="hidden" class="form-control" name="CodeConfigurable" id="CodeConfigurable" value="<?php echo $_GET['codigo']; ?>">
              </div>
              <div class="form-group mb-0" id="div-longitud" style="display: none;">
                <label for="longitud" id="changename">Longitud (m)</label>
                <input type="text" class="form-control" name="longitud" id="longitud" onkeyup="nuevoPrecioPorLongitud(this)" value="1">
                <input type="hidden" class="form-control" name="precio-longitud" id="precio-longitud">
                <input type="hidden" class="form-control" name="CodeClave" id="CodeClave">
                <input type="hidden" class="form-control" name="CodeConfigurable" id="CodeConfigurable" value="<?php echo $_GET['codigo']; ?>">
              </div>
            </div>
            <div class="col-sm-4">
              <div class="pt-4 hidden-sm-up"></div>
              <button type="button" style="background-color: #bc2130" class="btn btn-primary btn-block m-0" id="btn-configurable" descuento="0" onclick="AgregarArticuloConfigurable(this)">
              <i class="icon-bag"></i> Agregar al carrito</button>
              <button type="button" style="background-color: #bc2130; display: none;" class="btn btn-primary btn-block m-0" id="btn-fijo" onclick="AgregarArticuloFijoConfigurable(this)">
              <i class="icon-bag"></i> Agregar al carrito</button>
            </div>
          </div>
          <div class="pt-1 mb-4"><span class="text-medium">CLAVE:</span> <span id="Clave" class="styleClave"></span> </div>
          <hr class="mb-2">
          <div class="d-flex flex-wrap justify-content-between">
            <div class="mt-2 mb-2" id="add-ficha-tecnica-mini-catalogo">   
            </div> 
            <div class="mt-2 mb-2"><span class="text-muted">Compartir:&nbsp;&nbsp;</span>
              <div class="d-inline-block">
                <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a>
                <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-twitter" href="https://twitter.com/share?ref_src=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>"><i class="socicon-twitter"></i></a>
              <!--  <a class="social-button shape-rounded sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="socicon-instagram"></i></a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container padding-bottom-3x mb-2">
        <div class="row">
        <div class="col-lg-1 col-md-8 order-md-2">
        </div>
          <div class="col-lg-10 col-md-8 order-md-2">
            <p class="text-muted text-justify" id="descripcionCEO">
            
            </p>
          </div>
          <div class="col-lg-1 col-md-8 order-md-2">
        </div>
        </div>
      </div>
    <!-- Product Details-->
    <div class="container padding-bottom-3x mb-2">
      <div class="row">
      <div class="col-lg-12 col-md-8 order-md-2">
        <hr class="margin-bottom-1x">
          <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item"><a class="nav-link active" href="#description" data-toggle="tab" role="tab">Descripción</a></li>
            <li class="nav-item"><a class="nav-link" href="#adicional" data-toggle="tab" role="tab">Información adicional</a></li>
            <!-- <li class="nav-item"><a class="nav-link" href="#inf3" data-toggle="tab" role="tab">Relacionados</a></li> -->
            <li class="nav-item"><a class="nav-link" href="#inf4" data-toggle="tab" role="tab">Comentarios</a></li>
            <!-- <li class="nav-item"><a class="nav-link" href="#inf5" data-toggle="tab" role="tab">360</a></li> -->
          </ul>
          <div class="tab-content">
            <div class="tab-pane fade show active" id="description" role="tabpanel">
             <!-- inclusion de información necesaria descripción del producto mediante JavaScript -->
            </div>
            <div class="tab-pane fade" id="adicional" role="tabpanel">                          
             <!-- inclusion de información necesaria adicional del producto mediante JavaScript -->
            </div>
            <div class="tab-pane fade" id="inf3" role="tabpanel">
             <!-- inclusion de información necesaria productos relacionados -->
            </div>
            <div class="tab-pane fade" id="inf4" role="tabpanel">
             <!-- Reviews-->
              <?php include  $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Productos/Informacion/Comentarios/index.php'; ?>
            </div>
            <div class="tab-pane fade show " id="inf5" role="tabpanel">
              <!-- <iframe height="500px" src="../../public/images/img_spl/productos/OPEFEMPANU04001/360/PRUEBAOKOKOK.html"></iframe>  -->
            </div>
          </div>
        </div>
      </div>
    </div>  
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Productos/Informacion/Comentarios/comentarios-modal.php'; ?> 
    <!-- Footer -->
    <?php include  $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include  $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <script type="text/javascript" src="../../public/scripts/Productos/Comentarios.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Productos/Categorias/CategoriasGlobal.js?id=<?php echo rand();?>"></script>
    <script type="text/javascript" src="../../public/scripts/Productos/Categorias/<?php echo $FileUbicacionJs ?>.js?id=<?php echo rand();?>"></script>
  </body>
</html>

<?php 
  unset($CategoriaController);
  unset($Obj);
 ?>