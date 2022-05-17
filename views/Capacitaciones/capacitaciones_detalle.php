<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
    <link href='../../public/plugins/fullcalendar/lib/main.css' rel='stylesheet' />
    <script src='../../public/plugins/fullcalendar/lib/main.js'></script>
    
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>
    <?php 
     if (!class_exists("CatalogoCapacitaciones")) {
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/Capacitaciones.php';
      }
      $CatalogoCursos = new CatalogoCapacitaciones();
      $response = $CatalogoCursos->get("WHERE activo = 'si' AND id = '".$_GET['id']."' ", "", false)->records[0];
    
    ?>
  
    <!-- Page Content-->
    <div class="container padding-top-3x padding-bottom-3x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
    
          <!-- Gallery-->
          <div class="gallery-wrapper">
            <div class="gallery-item">
            <img src="../../public/images/img_spl/capacitaciones/<?php echo $response->banner1;?>" alt="<?php echo $response->nombre;?>">
          <span class="caption"><?php echo $response->titulo;?></span></div>
          </div>
         
          <h2 class="pt-4"><?php echo $response->titulo1?></h2>
          <p style="text-align: justify;"><?php
                echo nl2br($response->texto1);
            ?></p>
          <?php if(!empty($response->titulo1_2)): ?>
            <div class="text-muted opacity-75 padding-top-3x"><?php echo $response->titulo1_2; ?>
          <hr class="padding-top-1x">
          </div>

          <?php endif ?>
         <!-- IMAGEN -->
         <?php if(!empty($response->banner2)):
            list($ancho, $alto, $tipo, $atributos) = getimagesize("../../public/images/img_spl/capacitaciones/$response->banner2");
            $atributos1=$ancho."x".$alto;
            ?>
            
              <div class="gallery-wrapper padding-top-1x ">
                <div class="gallery-item">
                
                <img id='banner2' src="../../public/images/img_spl/capacitaciones/<?php echo $response->banner2;?>" alt="<?php echo $response->nombre;?>">
                <span class="caption"><?php echo $Soluciones->nombre;?></span>
                </div>
              </div>
          <?php endif?>
          <p style="text-align: justify;"><?php
                echo nl2br($response->texto1_1);
            ?></p>
          <?php if(!empty($response->titulo2)): ?>
            <div class="text-muted opacity-75 padding-top-3x"><?php echo $response->titulo2; ?>
          <hr class="padding-top-1x">
          </div>

          <?php endif ?>
          <?php
          /****************SECCION ESPECIAL PARA CADA CAPACITACION*****************/
          if(!empty($response->detalle)):
            include($response->detalle);
          endif
          ?>
          <style>
          a {
                color: black;
                text-decoration: underline;
            }
          .fc-toolbar-title { text-transform: uppercase; }
          </style>
          <!--
          <h6 class="text-center text-normal padding-top-2x">Consulta nuestra oferta academica de todo el año.</h6>

            <div class="text-muted opacity-75 padding-top-3x ">CALENDARIO DE EVENTOS</div>
          <hr class="padding-top-1x">
          <div style="text-decoration:none" class="" id='calendar'> 
          
        </div>
          -->
          
            <div class="text-muted opacity-75 padding-top-3x ">CALENDARIO DE EVENTOS</div>
            <hr class="padding-top-1x">
            <h6 class=" text-normal padding-bottom-2x">Consulta nuestra oferta academica de todo el año.</h6>
          <div class="col-lg-12 col-md-8 order-md-2">          
          <div class="accordion" id="accordion1" role="tablist">
            <?php 
              $CatalogoCursos = new CatalogoCapacitaciones();
              $responseCal = $CatalogoCursos->getMonths("", "", false)->records;
              
            ?>
            <?php foreach ($responseCal as $row ): ?>
            <div class="card">
              <div class="card-header" role="tab" style="background-color:#f5f5f5;">
                <h3 ><a <?php if($row->mes_num == date("n") && $row->anio == date("Y")){ ?> expanded="true" <?php }?> class="collapsed" href="#collapse<?php echo $row->mes_num.$row->anio;?>" data-toggle="collapse">
                <b><?php echo "Calendario actividades <span class='text-uppercase'>".$row->mes_nombre.'</span>';?></b></a>
              </h3>
              </div>
              <div class="collapse <?php if($row->mes_num == date("n") && $row->anio == date("Y")){ ?> show <?php }?>" id="collapse<?php echo $row->mes_num.$row->anio;?>" data-parent="#accordion1" role="tabpanel">
                <div class="card-body">
                <table style="width:100%;" >
                <?php 
                    $CatalogoEventos = new CatalogoCapacitaciones();
                    $responseCalEvents = $CatalogoEventos->getEventsCal("where month(start)= $row->mes_num AND YEAR(start) = $row->anio", "ORDER BY start ASC", false);
                    $cont=1;
                    $cont1=1;
                    foreach ($responseCalEvents as $row1 ): 
                      if($cont==1 || $varAnt!=$row1->title){
                      $CatalogoEventosEsp = new CatalogoCapacitaciones();
                      $responseCalEventsEsp = $CatalogoEventosEsp->getEventsCal("where month(start)= $row->mes_num AND YEAR(start) = $row->anio AND title='".$row1->title."'", "", false);
                      $rwSpan=count($responseCalEventsEsp);
                    }
                  ?>
                  <tr style="border-spacing: 0 8px;">
                    <?php 
                    if($cont % 2){
                      $colorBack='#f5f5f5';
                      
                    }else{
                      $colorBack='#ffffff';
                    }
                    /*
                    if($cont==1 || $varAnt!=$row1->title){
                      if($cont1 % 2){
                        $colorBack1='#BF202F';
                      }else{
                        $colorBack1='#1f3b56';
                      }
                      ?>
                    <td rowspan="<?php echo $rwSpan?>" style="text-align:center; ">
                      <img style="padding-right: 20px;" src="../../public/images/img_spl/capacitaciones/<?php echo $row1->title;?>.jpg">
                    </td>
                    <?php 
                      $cont1++;  
                      }else{
                      
                    }*/?>
                    <td style="background-color:<?php echo $colorBack;?>"><small><?php echo $row1->title;?></small></td>
                    <td style="background-color:<?php echo $colorBack;?>"><small><?php echo $row1->descripcion;?></small></td>
                    <td style="background-color:<?php echo $colorBack;?>"><small><?php echo $row1->fecha;?></small></td>
                    <td style="text-align:center; background-color:<?php echo $colorBack;?>;"><small><?php echo $row1->costo;?></small></td>
                    <td style="text-align:center; width:10%; background-color:<?php echo $colorBack;?>"><small><a style="color: #BF202F;" href="<?php echo $row1->link;?>" target="_blank">Ver más</a></small></td>
                  </tr>
                  <?php 
                      $varAnt=$row1->title;
                      $cont++;
                      endforeach 
                      ?>
                </table>
                </div>
              </div>
            </div>
            <?php endforeach ?>
          </div>  
        </div>
          <p class="text-muted text-center text-normal margin-top-3x">
            Seguimos con nuestra oferta de actividades y eventos para darte a conocer mejor las soluciones que ofrecemos y mantenerte
            actualizado con la información relevante y actual a todo lo relacionado con la fibra óptica y las telecomunicaciones.
         </p>

          <p class="text-muted text-center text-normal  margin-top-3x">
            <b>Mantenemos la comunicación abierta para resolver tus dudas</b>
           
         </p>

          <h6 class="text-muted text-center text-normal margin-top-3x">
            <a target="_blank" href="<?php echo$response->link_whatsapp?>"><img src="../../public/images/img_spl/capacitaciones/whatsapp-fibremex.png"></a>
          </h6>

          <h6 class="text-muted text-center text-normal text-uppercase margin-top-3x"><?php echo $response->text_form;?> </h6>
          <h6 class="text-muted text-center text-normal ">Deja tus datos y a la brevedad nos comunicaremos contigo para porporcionarte m&aacute;s informaci&oacute;n</h6>
          <hr class="margin-bottom-1x margin-top-2x">
          <form id="form-cursos">
            <input class="form-control" type="hidden" name="ActionCursos" id="ActionCursos" value="true">
            <input class="form-control" type="hidden" name="Action" id="Action" value="RegistroCursos">
            <input class="form-control" type="hidden" name="Descripcion" id="Descripcion" value="capacitacion">
            <input class="form-control" type="hidden" name="NombreCurso" id="NombreCurso" value="<?php echo $response->nombre;?>">
            <div class="row">
              <div class="col-sm-6 form-group">
                <label for="validationCustom04">Nombre</label>
                <input class="form-control cursos" type="text"  name="Nombre" id="Nombre" required>
              </div>
              <div class="col-sm-6 form-group">
                <label for="validationCustom05">Empresa</label>
                <input class="form-control cursos" type="text"  name="Empresa" id="Empresa" required>
                
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group">
                <label>Email</label>
                <input class="form-control cursos" type="email" name="Email" id="Email" required>
              </div>
              <div class="col-sm-6 form-group">
                <label>Telefono</label>
                <input class="form-control cursos" type="text" name="Telefono" id="Telefono" required>                
              </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="EmailCursos(this)">Enviar</button>
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
          </form>
          
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
          <?php 
          
            $CatalogoCursos = new CatalogoCapacitaciones();
            $first_cur = $CatalogoCursos->get("", "ORDER BY id ASC LIMIT 1 ", false)->records[0];
            $first_cur = $first_cur->id;
            if($first_cur !=$_GET['id']){
              $nombre_ficur = $CatalogoCursos->get("WHERE id=".($_GET['id'] - 1), "", false)->records[0];
              $nombre_ficur = $nombre_ficur->nombre;
            }else{
              $nombre_ficur ="";
            }
            $first_cur == $_GET['id'] ? $first_cur = '#' : $first_cur = "".($_GET['id'] - 1)."-".url_amigable($nombre_ficur);

            $CatalogoCursos = new CatalogoCapacitaciones();
            $final_cur = $CatalogoCursos->get("", "ORDER BY id DESC LIMIT 1 ", false)->records[0];
            $final_cur = $final_cur->id;
            if($final_cur !=$_GET['id']){
            $nombre_fcur = $CatalogoCursos->get("WHERE id=".($_GET['id'] + 1), "", false)->records[0];
            $nombre_fcur = $nombre_fcur->nombre;
            }else{
              $nombre_fcur ="";
            }
            $final_cur == $_GET['id'] ? $final_cur = '#' : $final_cur = "".($_GET['id'] + 1)."-".url_amigable($nombre_fcur);
           ?>
          <div class="entry-navigation">
            <div class="column text-left"><a class="btn btn-outline-secondary btn-sm" href="<?php echo $first_cur; ?>"><i class="icon-arrow-left"></i>&nbsp;Prev</a></div>
            <div class="column"><a class="btn btn-outline-secondary view-all" href="#" data-toggle="tooltip" data-placement="top" title="Todos"><i class="icon-menu"></i></a></div>
            <div class="column text-right"><a class="btn btn-outline-secondary btn-sm" href="<?php echo $final_cur; ?>">Next&nbsp;<i class="icon-arrow-right"></i></a></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <?php
      $CatalogoCursos = new CatalogoCapacitaciones();
      $response = $CatalogoCursos->getEvents("", "", true);
      $jsonEvents=($response);
    ?>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          themeSystem: 'bootstrap4',
          locale: 'es',
          initialView:"dayGridMonth",
          events:<?php echo $jsonEvents; ?>,
          headerToolbar:{left:"prev,next today",center:"title",right:"dayGridMonth,timeGridWeek,timeGridDay,listWeek"},
          buttonText: {
            today: 'Hoy',
            day: 'Día',
            week:'Semana',
            month:'Mes',
            list:'Agenda'
          }
        });   
        calendar.render();


      });
    </script>
  </body>
</html>

<?php 
  
  unset($CatalogoCursos);
  unset($response);
  unset($first_cur);
  unset($final_cur);
  
 ?>