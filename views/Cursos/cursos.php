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
    <?php 
      if (!class_exists("CatalogoCursos")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/Cursos.php';
      }
      $CatalogoCursos = new CatalogoCursos();
      $response = $CatalogoCursos->get("", "", false);
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Cursos Optronics</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Cursos</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-2x mb-2">
    <?php if ($response->count > 0): ?>
      <?php foreach ($response->records as $key => $row): ?>
      <div class="row align-items-center padding-bottom-2x padding-top-2x">
        <div class="col-md-5">
          <img class="d-block m-auto img-thumbnail" src="../../public/images/img_spl/cursos/<?php echo $row->img_general;?>" alt="<?php echo $row->nombre;?>">
        </div>
        <div class="col-md-7 text-md-left text-center">
          <div class="mt-30 hidden-md-up"></div>
          <h2><?php echo $row->nombre;?></h2>
          <p class="text-muted" style="text-align: justify;"><?php echo nl2br($row->texto1);?></p>
          <a class="text-decoration-none" href="cursos_detalle.php?id=<?php echo $row->id;?>">Conocer más&nbsp;<i class="icon-arrow-right d-inline-block align-middle"></i></a>
        </div>
      </div>
      <hr>
      <?php endforeach ?>
    <?php endif ?>      
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
?>