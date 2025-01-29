<div class="container padding-top-3x padding-bottom-3x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
<?php 
      if (!class_exists("CatalogoCursos")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/Cursos.php';
      }
      $CatalogoCursos = new CatalogoCursos();
      $responseD = $CatalogoCursos->get(" WHERE activo='si' ", "ORDER BY fecha DESC", false);
    ?>


    <?php if ($responseD->count > 0): ?>
      <?php foreach ($responseD->records as $key => $row): ?>
      <div class="row align-items-center padding-bottom-2x padding-top-2x">
        <div class="col-md-5">
          <img class="d-block m-auto img-thumbnail" src="../../public/images/img_spl/cursos/<?php echo $row->img_general;?>" alt="<?php echo $row->nombre;?>">
        </div>
        <div class="col-md-7 text-md-left text-center">
          <div class="mt-30 hidden-md-up"></div>
          <h2><?php echo $row->nombre;?></h2>
          <p class="text-muted" style="text-align: justify;"><?php echo nl2br($row->texto1);?></p>
          <a style="color: #BF202F;" class="text-decoration-none" href="../Cursos/<?php echo $row->id;?>-<?php echo url_amigable($row->nombre);?>">Conocer más&nbsp;<i class="icon-arrow-right d-inline-block align-middle"></i></a>
        </div>
      </div>
      <hr>
      <?php endforeach ?>
    <?php endif ?>      
    <p class="text-muted text-center text-normal  margin-top-3x padding-bottom-2x">
        Consulta nuestro calendario de eventos. Si te interesa alguno de los temas que tocamos,<br/>
        <b>llámanos al 800 134 26 90,</b> queremos atenderte.
</p>

<div class="text-muted opacity-75 padding-top-3x ">CALENDARIO DE EVENTOS</div>
  <hr class="padding-top-1x">
  <?php
      $CatalogoEventos = new CatalogoCapacitaciones();
      $responseCalEvents = $CatalogoEventos->getEventsCal("WHERE activo='si' AND YEAR(start) = YEAR(NOW()) AND MONTH(START) >= MONTH(NOW()) AND title = 'Develop'", "ORDER BY start ASC", false);
      
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
      $CatalogoCursos = new CatalogoCapacitaciones();
      $responseCal = $CatalogoCursos->getMonths("AND title = 'Develop'
      AND title1 != ''", "", false)->records;

      ?>
      <?php foreach ($responseCal as $row) : ?>
        <div class="card">
          <div class="card-header" role="tab" style="background-color:#f5f5f5;">
            <h3><a <?php if ($row->mes_num == date("n") && $row->anio == date("Y")) { ?> expanded="true" <?php } ?> class="collapsed" href="#collapse<?php echo $row->mes_num . $row->anio; ?>" data-toggle="collapse">
                <b><?php echo "Calendario actividades <span class='text-uppercase'>" . $row->mes_nombre . '</span>'; ?></b></a>
            </h3>
          </div>
          <div class="collapse <?php if ($row->mes_num == date("n") && $row->anio == date("Y")) { ?> show <?php } ?>" id="collapse<?php echo $row->mes_num . $row->anio; ?>" data-parent="#accordion1" role="tabpanel">
            <div class="card-body">
              <table style="width:100%;">
                <?php
                $CatalogoEventos = new CatalogoCapacitaciones();
                $responseCalEvents = $CatalogoEventos->getEventsCal("WHERE activo='si' AND month(start)= $row->mes_num AND YEAR(start) = $row->anio 	AND title = 'Develop'
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
                    <td style="background-color:<?php echo $colorBack; ?>"><small><?php echo $row1->title1; ?></small></td>
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
      <?php } ?>
    </div>
  </div>