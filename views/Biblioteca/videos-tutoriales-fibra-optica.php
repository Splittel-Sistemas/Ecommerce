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
      if (!class_exists("Videos")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Biblioteca/Videos/Videos.php';
      }
      $Videos = new Videos();
      $response = $Videos->get("", "", false);
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>VIDEOS FIBREMEX</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li><a href="../Biblioteca/videos-tutoriales-fibra-optica.php">Videos</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-12 col-lg-8 order-lg-2 col-12">
          <!-- Post Meta-->
          <div class="col-lg-12 col-md-8 order-md-2 col-12">
            <hr class="margin-bottom-1x">
            <div class="gallery-wrapper">
              <div class="row">
              <?php if ($response->count > 0): ?>
                <?php foreach ($response->records as $key => $row): ?>
                <div class="col-md-4 col-sm-6 col-6" onclick="javascript:location.href='video_detalle.php?id=<?php echo $row->VideosKey; ?>&nom=<?php echo $row->VideosPrefijo; ?>'">
                  <div class="gallery-item">
                    <a href="#">
                      <img style="padding-bottom: 10px;" src="<?php echo $row->VideosImg;?>" alt="<?php echo $row->VideosTitulo;?>" >
                    </a>
                    <h1 class="text-sm text-muted navi-link"> <?php echo $row->VideosTitulo;?></h1>
                  </div>
                </div>
                <?php endforeach ?>
              <?php endif ?>
              </div>
            </div>
          </div>
          <!-- Post Tags + Share-->
          <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 pb-4">
            <div class="pb-2"><span class="d-inline-block align-middle text-sm text-muted">Share post:&nbsp;&nbsp;&nbsp;</span>
               <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a>
              <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-twitter" href="https://twitter.com/share?ref_src=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>"><i class="socicon-twitter"></i></a>
            </div>
          </div>
          <!-- Post Navigation-->
          <div class="entry-navigation">
          
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
  unset($Videos);
  unset($response);  
 ?>