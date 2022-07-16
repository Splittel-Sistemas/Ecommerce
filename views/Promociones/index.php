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

    <!-- Page Content-->
    <div class="container padding-top-3x padding-bottom-3x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
    
          <!-- Gallery-->
          <div class="gallery-wrapper">
            <div class="gallery-item">
            <img class="rounded" src="../../public/images/img_spl/promociones/baner-landing.jpg" alt="promociones">
          <span class="caption"><?php //echo $response->titulo;?></span></div>
          </div>
         
          <h2 class="pt-4"><b>APOYAMOS LA ECONOMÍA DE TUS PROYECTOS</b></h2>
          <p style="text-align: justify;"><?php
                echo ('Aumentamos tus posibilidades de inversión con promociones que favorecen tu bolsillo. Conoce nuestra oferta de productos en 
                promoción, no dejes pasar más tiempo, hoy tienes la oportunidad de obtener tus soluciones de conectividad con una ventaja 
                agregada, ahorrar recursos de tu proyecto.');
            ?></p>
         <?php 
                if (!class_exists("CatalogoPromociones")) {
                  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Promociones/Promociones.php';
                  }
                  $CatalogoCursos = new CatalogoPromociones();
                  $responseI = $CatalogoCursos->get("WHERE activo = 'si' ", "", false)->records;
                  //echo $Json= json_encode($response);
            ?>
            <div class="row">
            <?php foreach ($responseI as $row ): 
              if($row->link!=''){ 
                ?>
            <a class="text-decoration-none"  href="<?php echo $row->link;?>" ">
            <?php }?>
            <div class="row align-items-center padding-bottom-2x padding-top-2x" >
                    <div class="col-md-5">
                      
                      <img class="d-block m-auto img-thumbnail " src="../../public/images/img_spl/promociones/<?php echo $row->imagen;?>" alt="<?php echo $row->titulo;?>">
              
                    </div>
                    <div class="col-md-7 text-md-left text-center">
                      <div class="mt-30 hidden-md-up"></div>
                      <h2><b><?php echo $row->titulo;?></b></h2>
                      <p class="text-muted" style="text-align: justify;"><?php echo nl2br($row->texto);?></p>
                     <!-- <a style="color: #BF202F;" class="text-decoration-none" target="_blank" href="<?php echo $row->link;?>"><u><?php echo $row->vigencia;?></u>&nbsp;</a> -->
                     <span style="color: #BF202F;" class="text-decoration-none" ><?php echo $row->vigencia;?>&nbsp;</span> 
                    </div>
            </div>
            <?php if($row->link!=''){ ?>
            </a>
            <?php }?>
                  <hr style="width:100%; height: 15px;" id="I<?php echo $row->id?>">
            <?php endforeach ?>

            </div>
            
          <div class="col-lg-12 col-md-8 order-md-2">          
         <!--
          <p class="text-muted text-center text-normal margin-top-3x">
            Seguimos con nuestra oferta de actividades y eventos para darte a conocer mejor las soluciones que ofrecemos y mantenerte
            actualizado con la información relevante y actual a todo lo relacionado con la fibra óptica y las telecomunicaciones.
         </p>
            -->
          <p class="text-muted text-center text-normal  margin-top-3x">
            <b>¿Quieres conocer más sobre nuestras promociones?</b><br/>
            Contáctanos para que un ejecutivo pueda atenderte.
         </p>
        
          <h6 class="text-muted text-center text-normal margin-top-3x">
            <a target="_blank" href="https://api.whatsapp.com/send?phone=+524423094756&text=%C2%A1Hola! Me gustario obtener informacion sobre las promociones"><img src="../../public/images/img_spl/capacitaciones/whatsapp-fibremex.png"></a>
          </h6>

         
          
          <!-- Post Tags + Share-->
          <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 pb-4">
            <div class="pb-2"></div>
            <div class="pb-2"><span class="d-inline-block align-middle text-sm text-muted">Share post:&nbsp;&nbsp;&nbsp;</span>
            <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a>
            <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-twitter" href="https://twitter.com/share?ref_src=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>"><i class="socicon-twitter"></i></a>
          <!--  <a class="social-button shape-rounded sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="socicon-instagram"></i></a> -->
            
            </div>
          </div>
          <!-- Post Navigation-->
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
  
  unset($CatalogoCursos);
  unset($response);
  unset($first_cur);
  unset($final_cur);
  
 ?>