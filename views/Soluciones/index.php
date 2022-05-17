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
            <img class="rounded" src="../../public/images/img_spl/soluciones/version1/baner-landing-soluciones.jpg" alt="soluciones">
          <span class="caption"><?php //echo $response->titulo;?></span></div>
          </div>
         
          <!--<h2 class="pt-4"><b>APOYAMOS LA ECONOMÍA DE TUS PROYECTOS</b></h2>-->
          <p style="text-align: justify;" class="padding-top-1x">
                Con el objetivo de apoyarte en tu toma de decisión, formamos una selección con los productos indispensables para la construcción de redes óptimas. 
                Queremos presentarte aquellos equipos especializados que no pueden faltar en una instalación de fibra óptica o cableado estructurado sistema de cobre para que estén a tu alcance cuando más los requieras.
                Atendemos las necesidades de tus proyectos de telecomunicaciones con las soluciones eficientes y de calidad que llevamos hasta donde estés.
            </p>
         <?php 
                if (!class_exists("Soluciones_")) {
                  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Soluciones/Soluciones.Controller.php';
                  }
                  $SolucionesController = new SolucionesController();
                  $SolucionesController->filter = "WHERE activo = 'si' ";
                  $SolucionesController->order = "";
                  $Soluciones = $SolucionesController->Get()->records;
                  
            ?>
            <div class="text-muted opacity-75 padding-top-3x">OFERTA DE SOLUCIONES
              <hr class="padding-top-1x">
          </div>
            <div class="row">
            <?php foreach ($Soluciones as $row ): 
             ?>
            <div class="row align-items-center padding-bottom-2x padding-top-2x" >
                    <div class="col-md-12">
                    <h2 style="text-align: center;"><b><?php echo $row->Titulo;?></b></h2>
                    <p class="text-muted" style="text-align: center;"><?php echo ($row->Subtitulo);?></p>
                    </div>
                    <div class="col-md-12 padding-top-1x">
                      <div class="isotope-grid cols-3 mb-4"><div class="gutter-sizer"></div>
                      <div class="grid-sizer"></div>
                          <div class="grid-item">
                            <div class="blog-post">
                              <img src="../../public/images/img_spl/soluciones/version1/<?php echo $row->Img_1;?>" alt="<?php echo $row->Titulo;?>">
                              
                              <div class="post-body text-center">
                                <span class=" text-center">
                                  <a target="_blank" class="btn btn-sm btn-pill btn-outline-danger margin-bottom-none " href="<?php echo $row->Link_1;?>">VER ONLINE</a>
                                  
                                </span>
                                
                              </div>
                            </div>
                          </div>
                        
                          <div class="grid-item">
                            <div class="blog-post">
                              <img src="../../public/images/img_spl/soluciones/version1/<?php echo $row->Img_2;?>" alt="<?php echo $row->Titulo;?>">
                              
                              <div class="post-body text-center">
                              
                                <span class=" text-center">
                                <a style="color:#f44336;" target="_blank" class="btn btn-sm btn-pill btn-outline-danger margin-bottom-none text-uppercase" href="<?php echo $row->Link_2;?>">VER ONLINE</a>
                                  
                                </span>
                                
                              </div>
                            </div>
                          </div>
                          <div class="grid-item">
                            <div class="blog-post">
                              <img src="../../public/images/img_spl/soluciones/version1/<?php echo $row->Img_3;?>" alt="<?php echo $row->Titulo;?>">
                              
                              <div class="post-body text-center">
                              
                                <span class=" text-center">
                                <a style="color:#f44336;" target="_blank" class="btn btn-sm btn-pill btn-outline-danger margin-bottom-none text-uppercase" href="<?php echo $row->Link_3;?>">VER ONLINE</a>
                                  
                                </span>
                                
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5 padding-top-1x">
                      
                      <img style="border:0px;" class="d-block m-auto img-thumbnail " src="../../public/images/img_spl/soluciones/version1/icono-seminario.jpg" alt="<?php echo $row->titulo;?>">
              
                    </div>
                    <div class="col-md-7 text-md-left text-center">
                      <div class="mt-30 hidden-md-up"></div>
                      <b class="text-muted opacity-75 "><?php echo $row->Titulo1;?></b>
                      <p class="text-muted padding-top-1x" style="text-align: justify;"><?php echo nl2br($row->Texto);?></p>

                      <?php 
                    if (!class_exists("CatalogoCapacitaciones")) {
                      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/Capacitaciones.php';
                      }
                      $CatalogoCursos = new CatalogoCapacitaciones();
                      $responseI = $CatalogoCursos->getEvents("WHERE start >= NOW() AND  id_solucion=".$row->SolucionesKey, "LIMIT 1", false)->records[0];
                      //echo $Json= json_encode($response);
                ?>

                      <a style="color: #BF202F;" class="text-decoration-none" target="_blank" href="<?php echo $responseI->link;?>"><u>Entra aquí para conocer la fecha y registrarte.</u>&nbsp;</a> 
                    </div>
            </div>
                <!--  <hr style="width:100%; height: 15px;" id="I<?php echo $row->id?>">  -->
            <?php endforeach ?>

            </div>
            
          <div class="col-lg-12 col-md-8 order-md-2">   
          <h5 class="text-center text-muted opacity-75 margin-top-3x">  
            <strong>DISTRIBUIMOS CALIDAD CON SOLUCIONES CONFIABLE</strong>
            </h5>
          <h6 class="text-muted text-center text-normal margin-top-2x">
            <img src="../../public/images/img_spl/soluciones/version1/stock-horario.jpg"></a>
            </h6>
            <h6 class="text-muted text-center text-normal margin-top-4x">
            <img src="../../public/images/img_spl/soluciones/version1/logo-fmx.jpg"></a>
            </h6>
          <p class="text-muted text-center text-normal ">
          Si quieres conocer más sobre las soluciones que distribuimos de la marca <b>Optronics</b>, no dudes en escribirnos.
         </p>
        
          <h6 class="text-muted text-center text-normal margin-top-3x">
            <a target="_blank" href="https://api.whatsapp.com/send?phone=+524423094756&text=%C2%A1Hola! Me gustario obtener informacion sobre las soluciones"><img src="../../public/images/img_spl/soluciones/version1/boton-whtas.jpg"></a>
          </h6>

         
          
         
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