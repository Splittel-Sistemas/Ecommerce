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
      if (!class_exists("Catalogo")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Biblioteca/Catalogo/Catalogo.php';
      }if (!class_exists("Historia")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Biblioteca/Catalogo/Historia.php';
      }
      $Catalogo = new Catalogo();
      $response = $Catalogo->get("", "", false)->records[0];
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>SOLUCIONES FIBREMEX</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li><?php echo $response->CatalogoTitulo;?></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-2x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
          <!-- Post Meta-->
          <ul class="post-meta mb-4">

          </ul>
          <!-- Gallery-->
          <?php if(!empty($response->CatalogoImgPrincipal)): ?>
          <div class="gallery-wrapper">
            <div class="gallery-item">
              <img src="../../public/images/img_spl/catalogo/<?php echo $response->CatalogoImgPrincipal;?>" alt="<?php echo $response->CatalogoTitulo;?>">
            </div>
          </div>
          <?php endif ?>
          
          <h2 class="pt-4 padding-bottom-1x d-flex justify-content-center">
            <div class="d-flex justify-content-center row">
              <?php echo $response->CatalogoSubtitulo1?>
            </div>
          </h2>
          <p style="margin-top-3x text-align: justify;">
            <?php echo nl2br($response->CatalogoTexto1);?>
          </p>
          <div class="row pt-3 pb-2 ">
            <div class="col-xl-10 offset-xl-1">
              <blockquote class="margin-top-2x margin-bottom-1x">
                <p><?php echo nl2br($response->CatalogoComillas)?></p>
              </blockquote>
            </div>
          </div>
           <p class="padding-top-2x" style="text-align: justify;">
            <?php echo nl2br($response->CatalogoTexto2);?>
          </p>
        </div>
      </div>
    </div>
    <?php 
      $Historia = new Historia();
      $responseHistoria = (object)$Historia->get("", "", false);
      $HistoriaCont = 1;
    ?>
    <?php foreach ($responseHistoria->records as $key => $row): ?>
      <section class="fw-section " style="position: relative; background-repeat:no-repeat;  background-size:100% 100%; <?php if($aux % 2 == 0){?> background-color: #f6f6f6" <?php }?>>
        <span class="overlay" style="opacity: .0;"></span>
        <div class="container text-center">
          <img src="../../public/images/img_spl/catalogo/historia/<?php echo $row->HistoriaImg?>" alt="image">
        </div>
      </section>   
    <?php $HistoriaCont++; endforeach ?>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
  </body>
</html>

<?php 
  
  unset($Catalogo);
  unset($response);
  unset($Historia);
  unset($responseHistoriaresponseHistoria);
  
 ?>