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
      $response = $Videos->get("WHERE activo='si' AND id='".$_GET['id']."'", "", false)->records[0];
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>VIDEOS</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="index.php">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li><a href="../Biblioteca/videos.php">Videos</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li><?php echo $response->VideosTitulo;?></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
          <!-- Post Meta-->
          <ul class="post-meta mb-4">
            <li><h1 class="pt-4"><?php echo $response->VideosTitulo;?></h1></li>
          </ul>
          <!-- Gallery-->
          <div class="gallery-wrapper">
            <div class="gallery-item">
              <a href="#" data-type="video" 
              data-video="&lt;div class=&quot;wrapper&quot;&gt;&lt;div class=&quot;video-wrapper&quot;&gt;&lt;iframe 
              class=&quot;pswp__video&quot; width=&quot;960&quot; height=&quot;640&quot; 
              src=&quot;<?php echo $response->VideosLink;?>&quot; frameborder=&quot;0&quot; 
              allowfullscreen&gt;&lt;/iframe&gt;&lt;/div&gt;&lt;/div&gt;">
              <img src="<?php echo $response->VideosImg;?>" alt="Image"></a>
              <span class="caption"><?php echo $response->VideosTitulo;?></span>
            </div>
          </div>
         <!-- <h2 class="pt-4"><?php //echo $response->VideosTitulo1?></h2> -->
          <h2 style="text-align: justify; Font-size:14px">
            <?php echo nl2br($response->VideosContenido); ?>
          </h2>
          <!-- Post Tags + Share-->
          <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 pb-4">
            <div class="pb-2"></div>
            <div class="pb-2"><span class="d-inline-block align-middle text-sm text-muted">Share post:&nbsp;&nbsp;&nbsp;</span>
             <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a>
            <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-twitter" href="https://twitter.com/share?ref_src=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>"><i class="socicon-twitter"></i></a>
           </div>
          </div>
          <!-- Post Navigation-->
          <?php 
            $first_video = $Videos->get("", "ORDER BY id ASC LIMIT 1 ", false)->records[0]->VideosKey;
            $first_video == $_GET['id'] ? $first_video = '#' : $first_video = "video_detalle.php?id=".($_GET['id'] - 1);

            $final_video = $Videos->get("", "ORDER BY id DESC LIMIT 1 ", false)->records[0]->VideosKey;
            $final_video == $_GET['id'] ? $final_video = '#' : $final_video = "video_detalle.php?id=".($_GET['id'] + 1);
           ?>
          <div class="entry-navigation">
            <div class="column text-left"><a class="btn btn-outline-secondary btn-sm" href="<?php echo $first_video; ?>"><i class="icon-arrow-left"></i>&nbsp;Prev</a></div>
            <div class="column"><a class="btn btn-outline-secondary view-all" href="videos.php" data-toggle="tooltip" data-placement="top" title="Todos"><i class="icon-menu"></i></a></div>
            <div class="column text-right"><a class="btn btn-outline-secondary btn-sm" href="<?php echo $final_video; ?>">Next&nbsp;<i class="icon-arrow-right"></i></a></div>
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
  unset($first_video);
  unset($final_video);
 ?>