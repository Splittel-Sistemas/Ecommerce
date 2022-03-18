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
          <div class="grid-item col-md-4 margin-top-1x products-card">
            <div class="blog-post products-card">
              <a class="post-thumb" href="#">
                <img src="../../public/images/img_spl/capacitaciones/<?php echo $row->imagen;?>" alt="<?php echo $row->titulo;?>">
                
              </a>
              <div class="post-body products-card">
                <h1 class="post-title" style="line-height:1.2;">
                  <a href="../Capacitaciones/<?php echo $row->id;?>-<?php echo $row->nombre;?>"><?php echo $row->titulo;?></a>
                </h1>
                <p style="font-size:13px;" class=""><?php echo nl2br($row->descripcion);?> 
                <br/><br/>
                  <a class="btn btn-sm btn-primary" href='#'>Aparta tu lugar aquí</a>
                </p>
              </div>
            </div>
          </div>
 <?php endforeach ?>
</div>
<p class="text-muted text-center text-normal  margin-top-3x">
        Consulta nuestro calendario de eventos. Si te interesa alguno de los temas que tocamos,<br/>
        <b>llámanos al 800 134 26 90,</b> queremos atenderte.
</p>
