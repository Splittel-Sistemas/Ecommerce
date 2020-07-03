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
     <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Preguntas frecuentes</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Preguntas frecuentes</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-1x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-lg-10">
          <!-- Gallery-->
          <div class="gallery-wrapper">
            <div class="gallery-item">
            <img src="../../public/images/img_spl/aclientes/Politicas-de-privacidad.jpg" alt="Preguntas frecuentes">
           
            </div>
          </div>
        </div>
      </div>
    </div>
                      
    <div class="container padding-bottom-2x mb-2">
      <div class="row justify-content-center">      
        <!-- Sidebar          -->
       
        <!-- Categories-->
        <div class="col-lg-10 " id="content_cuenta">
        <div class="col-lg-12 col-md-8 order-md-2">          
  <div class="accordion" id="accordion1" role="tablist">
  
  
    <?php
      if (!class_exists('CatalogoPPrivacidad')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Catalogos/PoliticasPrivacidad.php';
      }
      $CatalogoPprivacidad = new CatalogoPprivacidad();
      $responseCatalogoPprivacidad = (object)$CatalogoPprivacidad->get("", "", false);
     ?>
    <?php foreach ($responseCatalogoPprivacidad->records as $key => $row): ?>
    <div class="card">
      <div class="card-header" role="tab">
        <h6><a <?php if($key==0){ ?> expanded="true" <?php }?> class="collapsed" href="#collapse<?php echo $key;?>" data-toggle="collapse"><?php echo $row->titulo;?></a></h6>
      </div>
      <div class="collapse <?php if($key==0){ ?> show <?php }?>" id="collapse<?php echo $key;?>" data-parent="#accordion1" role="tabpanel">
        <div class="card-body"><p style="text-align: justify;"><?php echo nl2br($row->descripcion);?></p></div>
      </div>
    </div>
    <?php endforeach ?>
    
    
    
  </div>  
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