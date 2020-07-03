 <div class="col-lg-12 col-md-8 order-md-2">
          
  <div class="accordion" id="accordion1" role="tablist">
    <?php 
      if (!class_exists('CatalogoRastreoPedidos')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Catalogos/RastreoPedidos.php';
      }
      $CatalogoRastreoPedidos = new CatalogoRastreoPedidos();
      $responseCatalogoRastreoPedidos = (object)$CatalogoRastreoPedidos->get("", "", false);
     ?>
    <?php foreach ($responseCatalogoRastreoPedidos->records as $key => $row): ?>
    <div class="card">
      <div class="card-header" role="tab">
        <h6><a class="collapsed" href="#collapse<?php echo $key;?>" data-toggle="collapse"><?php echo $row->titulo;?></a></h6>
      </div>
      <div class="collapse" id="collapse<?php echo $key;?>" data-parent="#accordion1" role="tabpanel">
        <div class="card-body"><p style="text-align: justify;"><?php echo nl2br($row->descripcion);?></p></div>
      </div>
    </div>
    <?php endforeach ?>
  </div>  
</div>