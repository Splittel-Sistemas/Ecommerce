<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php 
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; 

      if (!class_exists("NosotrosController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Nosotros/Nosotros.Controller.php';
      }
      $NosotrosController = new NosotrosController();
      $Nosotros = $NosotrosController->getBy();
     ?>
     <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1><?php echo $Nosotros->GetTitulo();?></h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Nosotros</li>
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
            <!-- <li><i class="icon-user"></i><a href="#">Gregory Smith</a></li>
            <li><i class="icon-tag"></i><a href="#">Gadgets</a></li>
            <li><i class="icon-message-square"></i><a class="scroll-to" href="#comments">12</a></li> -->
          </ul>
          <!-- Gallery-->
          <?php if (!empty($Nosotros->GetImgPrincipal())): ?>              
          <div class="gallery-wrapper">
            <div class="gallery-item">
              <img src="../../public/images/img_spl/nosotros/<?php echo $Nosotros->GetImgPrincipal();?>" alt="<?php echo $Nosotros->GetTitulo();?>">
            </div>
          </div>
          <?php endif ?>
          <h2 class="padding-top-1x padding-bottom-0x pt-4  d-flex justify-content-center">
            <div class="d-flex justify-content-center row"><?php echo $Nosotros->GetSubtitulo1()?></div>
          </h2>          
          <p style="text-align: justify;"> <?php echo nl2br($Nosotros->GetTexto1()); ?></p>

          <h2 class="padding-top-2x padding-bottom-0x pt-4  d-flex justify-content-center">
            <div class="d-flex justify-content-center row"><?php echo $Nosotros->GetSubtitulo2()?></div>
          </h2>
          <p style="text-align: justify;"> <?php echo nl2br($Nosotros->GetTexto2());?> </p>
          
          
         <div class="padding-top-4x gallery-wrapper">
            <div class="gallery-item">
                <img src="../../public/images/img_spl/nosotros/<?php echo $Nosotros->GetImg2();?>" alt="<?php echo $Nosotros->GetImg2();?>">
            </div>
          </div>
      
          <div class="padding-top-2x gallery-wrapper">
            <div class="gallery-item">
            <img src="../../public/images/img_spl/nosotros/<?php echo $Nosotros->GetImg3();?>" alt="<?php echo $Nosotros->GetImg3();?>"></div>
          </div>
          
          <h2 class="padding-top-2x padding-bottom-0x pt-4  d-flex justify-content-center">
            <div class="d-flex justify-content-center row"><?php echo $Nosotros->GetSubtitulo3()?></div>
          </h2>
                
          <p style="text-align: justify;"><?php echo nl2br($Nosotros->GetTexto3()); ?></p>
          <div class="padding-top-4x gallery-wrapper">
            <div class="gallery-item">
            <img src="../../public/images/img_spl/nosotros/<?php echo $Nosotros->GetImg4();?>" alt="<?php echo $Nosotros->GetImg2();?>"></div>
          </div>   
        
          <h2 class="padding-top-2x padding-bottom-0x pt-4  d-flex justify-content-center">
            <div class="d-flex justify-content-center row"><?php echo $Nosotros->GetSubtitulo4()?></div>
          </h2>
                
          <p style="text-align: justify;"><?php echo nl2br($Nosotros->GetTexto4()); ?></p>   
       
          <div class="gallery-wrapper owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: true, &quot;loop&quot;: true, &quot;margin&quot;: 30, &quot;autoplay&quot;: false, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;576&quot;:{&quot;items&quot;:2},&quot;991&quot;:{&quot;items&quot;:3},&quot;1200&quot;:{&quot;items&quot;:3}} }">
            <?php
             $dirname = "../../public/images/img_spl/nosotros/slide/";
                $images = glob($dirname."*.jpg");
                foreach($images as $image) {
            ?>
            <div class="padding-top-5x gallery-item">
                <a href="<?php echo $image?>" data-size="1000x667">
                <img src="../../public/images/<?php echo $image?>" alt="Image"></a>
                <span class="caption">Nosotros</span>
            </div>
           <?php
           }
           ?>
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
  unset($NosotrosController);
  unset($ResultNosotrosController);
  unset($Nosotros);
 ?>