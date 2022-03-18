<?php 
     if (!class_exists("CatalogoCapacitaciones")) {
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/Capacitaciones.php';
      }
      $CatalogoCursos = new CatalogoCapacitaciones();
      $responseF = $CatalogoCursos->get("WHERE  id <> '".$_GET['id']."' ", "", false)->records;
      //echo $Json= json_encode($response);
?>
<div class="row">
<?php foreach ($responseF as $row ): ?>
          <div class="grid-item col-md-4">
            <div class="blog-post">
              <a class="post-thumb" href="../Capacitaciones/<?php echo $row->id;?>-<?php echo $row->nombre;?>">
                <img src="../../public/images/img_spl/capacitaciones/<?php echo $row->img_general;?>" alt="<?php echo $row->nombre;?>">
                
              </a>
              <div class="post-body">
                <h1 class="post-title">
                  <a href="../Capacitaciones/<?php echo $row->id;?>-<?php echo $row->nombre;?>"><?php echo $row->nombre;?></a>
                </h1>
                <p><?php echo $row->texto_general;?> 
                <br/><br/>
                  <a class="btn btn-sm btn-primary" href='../Capacitaciones/<?php echo $row->id;?>-<?php echo $row->nombre;?>'>Conocer más</a>
                </p>
              </div>
            </div>
          </div>
 <?php endforeach ?>
</div>