<?php 
     if (!class_exists("CatalogoCapacitaciones")) {
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/Capacitaciones.php';
      }
      $CatalogoCursos = new CatalogoCapacitaciones();
      $responseI = $CatalogoCursos->getEventsInsider("WHERE activo = 'si' ", "", false)->records;
      //echo $Json= json_encode($response);
?>
<div class="row">
<?php foreach ($responseI as $row ): 
     /*<a class="post-thumb" href="../Capacitaciones/<?php echo $row->id;?>-<?php echo $row->nombre;?>">*/
    ?>
        
<div class="row align-items-center padding-bottom-2x padding-top-2x">
        <div class="col-md-5">
          <img class="d-block m-auto img-thumbnail" src="../../public/images/img_spl/capacitaciones/<?php echo $row->imagen;?>" alt="<?php echo $row->titulo;?>">
        </div>
        <div class="col-md-7 text-md-left text-center">
          <div class="mt-30 hidden-md-up"></div>
          <h2><b><?php echo $row->titulo;?></b></h2>
          <p class="text-muted" style="text-align: justify;"><?php echo nl2br($row->descripcion);?></p>
          <a style="color: #BF202F;" class="text-decoration-none" href="../Capacitaciones/<?php echo $row->id;?>-<?php echo $row->nombre;?>"><u>Aparta tu lugar aquí</u>&nbsp;</a>
        </div>
</div>
      <hr style="width:100%; height: 15px;">
 <?php endforeach ?>
</div>
<p class="text-muted text-center text-normal  margin-top-3x">
        Consulta nuestro calendario de eventos. Si te interesa alguno de los temas que tocamos,<br/>
        <b>llámanos al 800 134 26 90,</b> queremos atenderte.
</p>
