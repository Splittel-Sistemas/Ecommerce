<div class="container padding-top-3x  mb-2">
    <div class="row justify-content-center">
      <!-- Content-->
      <div class="col-xl-9 col-lg-8 order-lg-2">

       
      
       
        <p style="text-align: justify;"><?php
                                        echo nl2br($response->texto2);
                                        ?></p>
      </div>
    </div>
  </div>
<div class="container padding-top-1x padding-bottom-3x mb-2">
  <div class="row justify-content-center">
    <!-- Content-->
    <div class="col-xl-12 col-lg-8 order-lg-2">
      <div class="text-muted opacity-75 padding-top-3x ">CALENDARIO DE EVENTOS</div>
      <hr class="padding-top-1x">
      <?php
      $CatalogoEventos = new CatalogoCapacitaciones();
      $responseCalEvents = $CatalogoEventos->getEventsCal("WHERE activo='si' AND YEAR(start) = YEAR(NOW()) AND MONTH(START) >= MONTH(NOW()) AND title = 'Insider'", "ORDER BY start ASC", false);
      
      if(count($responseCalEvents) == 0){
        ?>
        
        <div class="col-md-12">
        <div class="gallery-wrapper" data-pswp-uid="1">
          <div class="gallery-item">

          <img  src="../../public/images/img_spl/capacitaciones/NuevasFechasProximamente.png">
        </div>
        </div>
        </div>
       
      <?php
      }else{
      ?>
      <h6 class=" text-normal padding-bottom-2x">Consulta nuestra oferta academica de todo el año.</h6>
      <div class="col-lg-12 col-md-8 order-md-2">
        <div class="accordion" id="accordion1" role="tablist">
          <?php
          /**
       * 
       * @var object $CatalogoCursos
       */
          $CatalogoCursos = new CatalogoCapacitaciones();
          $responseCal = $CatalogoCursos->getMonths("	AND title = 'Insider'
      AND title1 != ''", "", false)->records;

          ?>
          <?php foreach ($responseCal as $row) : ?>
            <div class="card">
              <div class="card-header" role="tab" style="background-color:#7A7A7A;">
                <h3><a <?php if ($row->mes_num == date("n") && $row->anio == date("Y")) { ?> expanded="true" <?php } ?> class="collapsed" href="#collapse<?php echo $row->mes_num . $row->anio; ?>" data-toggle="collapse">
                    <b style="color:white;"><?php echo "Calendario actividades <span class='text-uppercase'>" . $row->mes_nombre . '</span>'; ?></b></a>
                </h3>
              </div>
              <div class="collapse <?php if ($row->mes_num == date("n") && $row->anio == date("Y")) { ?> show <?php } ?>" id="collapse<?php echo $row->mes_num . $row->anio; ?>" data-parent="#accordion1" role="tabpanel">
                <div class="card-body">
                  <table style="width:100%;">
                    <?php
                    $CatalogoEventos = new CatalogoCapacitaciones();
                    $responseCalEvents = $CatalogoEventos->getEventsCal("WHERE activo='si' AND month(start)= $row->mes_num AND YEAR(start) = $row->anio 	AND title = 'Insider'
                AND title1 != '' ", "ORDER BY start ASC", false);
                    $cont = 1;
                    $cont1 = 1;
                    foreach ($responseCalEvents as $row1) :
                      if ($cont == 1 || $varAnt != $row1->title) {
                        $CatalogoEventosEsp = new CatalogoCapacitaciones();
                        $responseCalEventsEsp = $CatalogoEventosEsp->getEventsCal("where month(start)= $row->mes_num AND YEAR(start) = $row->anio AND title='" . $row1->title . "'", "", false);
                        $rwSpan = count($responseCalEventsEsp);
                      }
                    ?>
                      <tr style="border-spacing: 0 8px;">
                        <?php
                        if ($cont % 2) {
                          $colorBack = '#f5f5f5';
                        } else {
                          $colorBack = '#ffffff';
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
                      
                    }*/ ?>
                        <td style="background-color:<?php echo $colorBack; ?>"><small><b> <?php echo $row1->title; ?></b></small></td>
                        <td style="background-color:<?php echo $colorBack; ?>"><small>&nbsp;&nbsp;<?php echo $row1->title1; ?></small></td>
                        <td style="background-color:<?php echo $colorBack; ?>"><small><?php echo $row1->fecha; ?></small></td>
                        <td style="text-align:center; background-color:<?php echo $colorBack; ?>;"><small><?php echo $row1->costo; ?></small></td>
                        <td style="text-align:center; width:10%; background-color:<?php echo $colorBack; ?>">
                          <small>
                            <?php if ($row1->title == 'Insider') { 
                                  if(trim($row1->link)==''){ ?>
                                    <a style="color: #BF202F;" href="#" >Próximamente</a>
                            <?php      }else{
                              ?>
                              <a style="color: #BF202F;" href="<?php echo $row1->link; ?>" target="_blank">Registro</a>
                            <?php }
                          } else { ?>
                              <a style="color: #BF202F;" href="<?php echo $row1->link; ?>" target="_blank">Ver más</a>
                            <?php } ?>
                          </small>
                        </td>
                      </tr>
                    <?php
                      $varAnt = $row1->title;
                      $cont++;
                    endforeach
                    ?>
                  </table>
                </div>
              </div>
            </div>
          <?php endforeach ?>
          <?php } ?>
        </div>
      </div>