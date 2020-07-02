<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Head.php'; ?>
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Header.php'; ?>
    <?php 
      if (!class_exists("Infografias")) {
        include $_SERVER["DOCUMENT_ROOT"].'/store/models/Biblioteca/Infografias.php';
      }
      $Infografias = new Infografias();
      $response = $Infografias->get("", "", false);
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>INFOGRAFÍAS</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Infografías</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1">
      <div class="row justify-content-center">
        <!-- Products-->
        <div class="col-lg-9">
          <!-- Products List-->
        <?php if ($response->count > 0): ?>
          <?php foreach ($response->records as $key => $row): ?>
          <div class="product-card product-list mb-30"><a class="product-thumb" href="../../public/images/img_spl/infografias/pdf/<?php echo $row->InfografiasPDF;?>">
            <img src="../../public/images/img_spl/infografias/imagenes/<?php echo $row->InfografiasImg;?>" alt="<?php echo $row->InfografiasNombre;?>"></a>
            <div class="product-card-inner">
              <div class="product-card-body">
                <div class="rating-stars">
                  <i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i><i class="icon-star"></i>
                </div>
                <div class="product-category">
                  <a href="#">Infografias / Fibra Optica</a>
                </div>
                <h3 class="product-title">
                  <a href="../../public/images/img_spl/infografias/pdf/<?php echo $row->InfografiasPDF;?>"><?php echo $row->InfografiasNombre;?></a>
                </h3>
                <h4 class="">&nbsp;</h4>
                <p class="text-sm text-muted hidden-xs-down my-1"><?php echo $row->InfografiasContenido?></p>
              </div>
              <div class="product-button-group">
                <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="product-button " href="https://twitter.com/share?ref_src=<?php echo $_SERVER["HTTP_HOST"].'/store/public/imagenes/img_spl/infografias/pdf/'.$row->InfografiasPDF;?>"><i class="socicon-twitter"></i><span>Compartir en twitter</span></a>
                <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="product-button " href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER["HTTP_HOST"].'/store/public/imagenes/img_spl/infografias/pdf/'.$row->InfografiasPDF;?>"><i class="socicon-facebook"></i><span>Compartir en facebook</span></a>
                <a class="product-button" href="../../public/images/img_spl/infografias/pdf/<?php echo $row->InfografiasPDF;?>" target="_blank">
                <i class="icon-download"></i><span>Ver ficha</span></a>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        <?php endif ?>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Scripts.php'; ?>
  </body>
</html>

<?php 
  
  unset($Infografias);
  unset($response);
  
 ?>