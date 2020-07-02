<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Head.php'; ?>
    <link href="../../public/fonts/Roboto/Roboto.css?family=Roboto+Mono&display=swap" rel="stylesheet">
    <style type="text/css">
      .styleClave{
        font-family: 'Roboto Mono', monospace;
      }
    </style>
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Header.php'; ?>
    <?php 
      if (!class_exists("ProductoController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/store/models/Productos/Producto.Controller.php';
      }
      $ProductoController = new ProductoController();
      $ProductoController->filter = "WHERE codigo = '".$_GET['id_prd']."' AND (codigo_configurable = '' OR codigo_configurable IS NULL ) AND producto_activo = 'si'  ";
      $ProductoController->order = "";
      $Obj = $ProductoController->GetByProductosFijos();
      if(!empty($Obj->ProductoCodigo)){
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Detalle del producto</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>
              <a href="categorias.php?id_ct=<?php echo $Obj->ProductoCategoriaKey ?>"><?php echo $Obj->CategoriaFamiliaDescripcion; ?></a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>
              <a <?php if($Obj->SubcategoriaSubnivel=='NO'){ ?> href="categorias.php?id_sbct=<?php echo $Obj->ProductoSubcategoriaKey;?>&sbn=no"<?php }?>
                   <?php if($Obj->SubcategoriaSubnivel=='SI'){ ?> href="categorias.php?id_sbct=<?php echo $Obj->ProductoSubcategoriaKey;?>&sbn=si"<?php }?>
                 ><?php echo $Obj->SubcategoriaDescripcion;?></a>
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
      <?php include $_SERVER['DOCUMENT_ROOT'].'/store/views/Productos/Fijos/index.php' ?>
    </div>
    <!-- Description CEO-->
    <?php 
    if($Obj->ProductoCeo!=''){
    ?>
      <div class="container padding-bottom-3x mb-2">
        <div class="row">
        <div class="col-lg-1 col-md-8 order-md-2">
        </div>
          <div class="col-lg-10 col-md-8 order-md-2">
            <p class="text-muted text-justify">
            <?php echo nl2br($Obj->ProductoCeo); ?>
            </p>
          </div>
          <div class="col-lg-1 col-md-8 order-md-2">
        </div>
        </div>
      </div>
    <?php
    }
    ?>
    <!-- Product Details-->
    <?php 
    if($Obj->ProductoCategoriaKey!='A8'){
    ?>
      <div class="container padding-bottom-3x mb-2">
        <?php include $_SERVER['DOCUMENT_ROOT'].'/store/views/Productos/Fijos/detalle.php' ?>
      </div>
    <?php
    }
    ?>
    <?php }else{ ?>
    <div class="padding-bottom-3x mb-1 mt-5">
      <div class="text-center">
          <h2>Producto no encontrado</h2>
      </div>
    </div>
    <?php } ?>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Scripts.php'; ?>
    <script type="text/javascript" src="../../public/scripts/Productos/Comentarios.js?id=<?php echo rand() ?>"></script>
  </body>
</html>
<?php 
  unset($ProductoController);
  unset($Obj);
  unset($RelacionadosController);
  unset($ResultProductosRelacionados);
?>