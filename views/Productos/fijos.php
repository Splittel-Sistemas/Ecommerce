<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <?php
  if (!class_exists("ProductoController")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
  }
  if (isset($_GET['id_prd'])) {
    $ProductoController = new ProductoController();
    $ProductoController->filter = "WHERE codigo = '" . $_GET['id_prd'] . "' AND (codigo_configurable = '' OR codigo_configurable IS NULL  OR configurablefijo='si'  ) AND producto_activo = 'si'  ";
    $ProductoController->order = "";
    $Obj = $ProductoController->GetByProductosFijos();

    $Meta_Key = !empty($Obj->MetaKey) ? $Obj->MetaKey : '';
    $Meta_Description = !empty($Obj->MetaDescription) ? $Obj->MetaDescription : '';
  ?>
    <meta name="Description" content="<?php echo $Meta_Description; ?>" />
    <meta name="keywords" content="<?php echo $Meta_Key; ?>" />
  <?php
  }
  ?>
  <!-- <title> Contacto </title> -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Head.php'; ?>
  <link href="../../public/fonts/Roboto/Roboto.css?family=Roboto+Mono&display=swap" rel="stylesheet">
  <style type="text/css">
    .styleClave {
      font-family: 'Roboto Mono', monospace;
    }
  </style>
</head>
<!-- Body-->

<body>
  <!-- Header -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Header.php'; ?>
  <?php
  if (!class_exists("ProductoController")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
  }
  if (!class_exists("SubmenuController")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Submenu/Submenu.Controller.php';
  }
  if (isset($_GET['id_prd'])) {
    $ProductoController = new ProductoController();
    $ProductoController->filter = "WHERE codigo = '" . $_GET['id_prd'] . "' AND (codigo_configurable = '' OR codigo_configurable IS NULL OR configurablefijo='si') AND producto_activo = 'si'  ";
    $ProductoController->order = "";
    $Obj = $ProductoController->GetByProductosFijos();

    $SubmenuController = new SubmenuController();
    $SubmenuController->filter = "WHERE codigo = '" . $_GET['id_prd'] . "' ";
    $SubmenuController->order = "ORDER BY id_categoria ASC";
    $ObjMenu = $SubmenuController->GetByFixedCode();
    //print_r($ObjMenu);
    if (!empty($Obj->ProductoCodigo) && !empty($ObjMenu->records[0]->Key)) {
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
                <a href="categorias.php?id_ct=<?php echo $ObjMenu->records[0]->FamiliaKey ?>"><?php echo $Obj->CategoriaFamiliaDescripcion; ?></a>
              </li>
              <li class="separator">&nbsp;</li>
              <li>
                <a href="categorias.php?id_sbct=<?php echo $ObjMenu->records[0]->Key ?>"><?php echo $ObjMenu->records[0]->Descripcion; ?></a>
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
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/views/Productos/Fijos/index.php' ?>
      </div>
      <!-- Description CEO-->
      <?php
      if ($Obj->ProductoCeo != '') {
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
          <div class="row">
            <div class="col-lg-1 col-md-8 order-md-2">
            </div>
            <div class="col-lg-10 col-md-8 order-md-2">
              <p class="text-muted text-justify">Para comprar este producto</p>
              <a href="https://fibremex.com/fibra-optica/views/Login/">inicia sesión aquí</a>
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
      if ($Obj->ProductoCategoriaKey != 'A8') {
      ?>
        <div class="container padding-bottom-3x mb-2">
          <?php include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/views/Productos/Fijos/detalle.php' ?>
        </div>
      <?php
      }
      ?>
    <?php } else { ?>
      <div class="padding-bottom-3x mb-1 mt-5">
        <div class="text-center">
          <h2>Producto no encontrado</h2>
        </div>
      </div>
    <?php } ?>
  <?php } else { ?>
    <div class="padding-bottom-3x mb-1 mt-5">
      <div class="text-center">
        <h2>Producto no encontrado</h2>
      </div>
    </div>
  <?php } ?>
  <!-- Footer -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Footer.php'; ?>
  <!-- scripts JS -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Scripts.php'; ?>
  <script type="text/javascript" src="../../public/scripts/Productos/Comentarios.js?id=<?php echo rand() ?>"></script>
</body>

</html>
<?php
unset($ProductoController);
unset($Obj);
unset($RelacionadosController);
unset($ResultProductosRelacionados);
?>