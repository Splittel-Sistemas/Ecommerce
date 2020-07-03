<div class="col-lg-12 col-md-8 order-md-2">          
  <div class="accordion" id="accordion1" role="tablist">
    <?php 
      if (!class_exists('CatalogoFaqs')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Catalogos/Faqs.php';
      }
      $CatalogoFaqs = new CatalogoFaqs();
      $responseCatalogoFaqs = (object)$CatalogoFaqs->get("WHERE id=".$_GET['idc'], "", false);
     ?>
    <?php foreach ($responseCatalogoFaqs->records as $key => $row): ?>
    <div class="card">
      <div class="card-header" role="tab">
        <h6><a <?php if($key==0){ ?> expanded="true" <?php }?> class="collapsed" href="#collapse<?php echo $key;?>" data-toggle="collapse"><?php echo $row->titulo;?></a></h6>
      </div>
      <div class="collapse <?php if($key==0){ ?> show <?php }?>" id="collapse<?php echo $key;?>" data-parent="#accordion1" role="tabpanel">
        <div class="card-body"><p style="text-align: justify;"><?php echo nl2br($row->descripcion);?></p></div>
      </div>
    </div>
    <?php endforeach ?>
  </div>  
</div>