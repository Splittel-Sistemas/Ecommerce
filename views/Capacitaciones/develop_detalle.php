<div class="container padding-top-3x padding-bottom-3x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
<?php 
      if (!class_exists("CatalogoCursos")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/Cursos.php';
      }
      $CatalogoCursos = new CatalogoCursos();
      $responseD = $CatalogoCursos->get("", "ORDER BY fecha DESC", false);
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