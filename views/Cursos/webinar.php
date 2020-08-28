<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
    <style>
  .video-btn>a {
    background-image: url("../../public/images/img_spl/productos/vista-360.jpg");
    background-size: 70px 70px;
  }
  .product-gallery .video-btn>a {
    width: 80px;
    height: 80px;
  }
  #new-btn-video::after{
    background-color: transparent;
    box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
    background-image: url("");
  }
  #new-btn-video::before{
    background-color: transparent;
    box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
    background-image: url("");
  }
</style>
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>
    <?php 
      if (!class_exists("CatalogoWebinars")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/Webinars.php';
      }
      $CatalogoWebinars = new CatalogoWebinars();
      $range1 = ($_GET['pag'] - 1) * $CatalogoWebinars->elem_totales_pagination;
      $range2 = $CatalogoWebinars->elem_totales_pagination;
    
     // $CatalogoWebinars = new CatalogoWebinars();
      $response = $CatalogoWebinars->get("WHERE activo = 'si' ", "ORDER BY fecha DESC  LIMIT ".$range1.", ".$range2." ", false);

     // $response = (object)$Blog->get("WHERE activo = 'si' ", "ORDER BY fecha DESC  LIMIT ".$range1.", ".$range2." ", false);
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Webinar Optronics</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Webinar</li>
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
          <img class="d-block m-auto img-thumbnail" src="../../public/images/img_spl/webinars/<?php echo $row->img;?>" alt="<?php echo $row->titulo;?>">
        </div>
        <div class="col-md-7 text-md-left text-center">
          <div class="mt-30 hidden-md-up"></div>
          <h2><?php echo $row->titulo;?></h2>
          <p class="text-muted" style="text-align: justify;"><?php echo nl2br($row->contenido);?></p>
            <button class="btn btn-outline-secondary btn-sm ">
          <div style="padding-top: 0px; padding-right: 0px; 
          padding-left: 0px; border: 0px; border-radius: 0px;" class="product-gallery" >
              <div class="gallery-wrapper">
              <div  class="gallery-item text-center">
               <a style="color: #BF202F; text-decoration: underline;" id="new-btn-video" 
               href="#" data-toggle="tooltip" data-type="video" 
               data-video="&lt;div class=&quot;wrapper&quot;&gt;&lt;div class=&quot;video-wrapper&quot;&gt;&lt;iframe class=&quot;pswp__video&quot; width=&quot;960&quot; height=&quot;640&quot; src=&quot;<?php echo $row->link;?>&quot; allow=&quot;autoplay&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;&lt;/div&gt;&lt;/div&gt;" 
               >
                <i class="icon-play"></i> Video
              </a>
              </div>
              </div>
            </div>
            </button>
        </div>
      </div>
      <hr>
      <?php endforeach ?>
    <?php endif ?>   
    <!-- Pagination-->
    <nav class="pagination">
        <div class="column">
          <ul class="pages">
            <?php 
              $total_elem_pag = $CatalogoWebinars->webinarsPagination("", "", false);
              $j = 1;
              $total_elem_pag->page_pagination == $_GET['pag'] ? $url = "#" : $url = "webinar.php?pag=".($_GET['pag']+1);

              for ($i=0; $i < $total_elem_pag->page_pagination; $i++) { 
                  $j == $_GET['pag'] ? $active = 'active' : $active ='';

            ?>
            <li class="<?php echo $active; ?>"><a href="webinar.php?pag=<?php echo $j; ?>"><?php echo $j; ?></a></li>
            <?php 
              $j++;
             } 
            ?>

          </ul>
        </div>
        <div class="column text-right hidden-xs-down"><a class="btn btn-outline-secondary btn-sm" href="<?php echo $url; ?>">Siguiente&nbsp;<i class="icon-chevron-right"></i></a></div>
      </nav>   
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