<div class="container  mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
<?php 
     if (!class_exists("CatalogoCapacitaciones")) {
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/Capacitaciones.php';
      }
      $CatalogoCursos = new CatalogoCapacitaciones();
     // $responseI = $CatalogoCursos->getEvents("WHERE start >= NOW() AND title = 'Insider' AND title1 != '' ORDER BY start ASC", "LIMIT 7", false)->records;
      //echo $Json= json_encode($response);
?>
<div class="row">
<?php foreach ($responseI as $row ): 
    
    ?>
 <span id="I<?php echo $row->id?>" class="padding-bottom-1x"> </span>      
<div class="row align-items-center padding-bottom-2x padding-top-2x" >
        <div class="col-md-5">
          
          <img class="d-block m-auto img-thumbnail" src="../../public/images/img_spl/capacitaciones/<?php echo $row->imagen;?>" alt="<?php echo $row->title1;?>">
   
        </div>
        <div class="col-md-7 text-md-left text-center">
          <div class="mt-30 hidden-md-up"></div>
          <h2><b><?php echo $row->title1;?></b></h2>
          <p class="text-muted" style="text-align: justify;">
          Fecha: <?php echo nl2br($row->start);?><br/>
          Hora: <?php echo nl2br($row->Hora);?> am</p>
          <p class="text-muted" style="text-align: justify;"><?php echo nl2br($row->descripcion1);?></p>
          <a style="color: #BF202F;" class="text-decoration-none" target="_blank" href="<?php echo $row->link;?>"><u>Aparta tu lugar aquí</u>&nbsp;</a>
        </div>
</div>
      <hr style="width:100%; height: 15px;" id="I<?php echo $row->id?>">
 <?php endforeach ?>
</div>
<div class="row">
<div class="padding-top-2x" >
<h2 class="text-center"><b>Obtén tu constancia INSIDER y recibe grandes beneficios</b></h2>
<p class="text-muted" style="text-align: justify;">
Al concluir todos los seminarios del ciclo INSIDER, te otorgaremos una constancia en recomendacion a tu esfuerzo. Lo único que
debes hacer es registrarte y estar presente en cada uno de ellos. Tu constancia te traerá grandes beneficios para el crecimiento
de tus proyectos.
</p>
</div>

<div class="padding-top-1x gallery-wrapper" >
            <div class="gallery-item" style="margin-bottom:0px;">
            <img src="../../public/images/img_spl/capacitaciones/beneficios-Insider1.jpg" ></div>
          </div>
</div>  
</div>
</div>
</div>
<section class="fw-section padding-bottom-10x" 
  style="background-image: url(../../public/images/img_spl/capacitaciones/beneficios-Insider2.jpg);
        background-size: ">
      <div class="container text-center"></div>
    </section>
    <div class="container padding-top-1x padding-bottom-3x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
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
      $responseCal = $CatalogoCursos->getMonths("	AND title = 'Insider'
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
                $responseCalEvents = $CatalogoEventos->getEventsCal("where month(start)= $row->mes_num AND YEAR(start) = $row->anio 	AND title = 'Insider'
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
                    <td style="background-color:<?php echo $colorBack; ?>"><small><?php echo $row1->title; ?></small></td>
                    <td style="background-color:<?php echo $colorBack; ?>"><small><?php echo $row1->descripcion; ?></small></td>
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