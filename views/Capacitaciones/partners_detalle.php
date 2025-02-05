<div class="container padding-top-3x padding-bottom-3x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
<p class="text-muted text-center text-normal  padding-top-3x">
            <b>Sólo habrá cupo para 9 participantes durante cada certificación.<br>
                Las certificaciones se abrirán de manera trimestral.</b>
</p>

<div class="row padding-top-3x">
<div class="gallery-wrapper ">
            <div class="row">
              <div class="col-md-4 col-sm-6 col-4">
                <div class="gallery-item">
                   <a href="../../public/images/img_spl/capacitaciones/Partners1.jpg" data-size="365x254">
                    <img src="../../public/images/img_spl/capacitaciones/Partners1.jpg" alt="Partners Optronics">
                    </a>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 col-4">
                <div class="gallery-item">
                <a href="../../public/images/img_spl/capacitaciones/Partners2.jpg" data-size="365x254">
                        <img src="../../public/images/img_spl/capacitaciones/Partners2.jpg" alt="Partners Optronics">
                        </a>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 col-4">
                <div class="gallery-item">
                    <a href="../../public/images/img_spl/capacitaciones/Partners3.jpg" data-size="365x254">
                    <img src="../../public/images/img_spl/capacitaciones/Partners3.jpg" alt="Partners Optronics">
                    </a>
                </div>
              </div>
            </div>
          </div>
</div>
</div>
<div class="col-xl-12 col-lg-8 order-lg-2">
<p class="text-muted text-center text-normal  margin-top-3x">
        Consulta nuestro calendario de eventos. Si te interesa alguno de los temas que tocamos,<br/>
        <b>llámanos al 800 134 26 90,</b> queremos atenderte.
</p>

<div class="text-muted opacity-75 padding-top-3x ">CALENDARIO DE EVENTOS</div>
  <hr class="padding-top-1x">
  <h6 class=" text-normal padding-bottom-2x">Consulta nuestra oferta academica de todo el año.</h6>
  <div class="col-lg-12 col-md-8 order-md-2">
    <div class="accordion" id="accordion1" role="tablist">
      <?php
      $CatalogoCursos = new CatalogoCapacitaciones();
      $responseCal = $CatalogoCursos->getMonths("AND title = 'Partners'
      AND title1 != '' ", "", false)->records;

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
                $responseCalEvents = $CatalogoEventos->getEventsCal("where month(start)= $row->mes_num AND YEAR(start) = $row->anio 	AND title = 'Partners'
                AND title1 != ''", "ORDER BY start ASC", false);
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
                    <td style="background-color:<?php echo $colorBack; ?>"><small><b>  <?php echo $row1->title; ?></b></small></td>
                    <td style="background-color:<?php echo $colorBack; ?>"><small>&nbsp;&nbsp; <?php echo $row1->title1; ?></small></td>
                    <td style="background-color:<?php echo $colorBack; ?>"><small><?php echo $row1->fecha; ?></small></td>
                    <td style="text-align:center; background-color:<?php echo $colorBack; ?>;"><small><?php echo $row1->costo; ?></small></td>
                    <td style="text-align:center; width:10%; background-color:<?php echo $colorBack; ?>">
                      <small>
                        <?php if ($row1->title == 'Insider') { ?>
                          <a style="color: #BF202F;" href="<?php echo $row1->link; ?>" target="_blank">Registro</a>
                        <?php } else { ?>
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
    </div>
  </div>