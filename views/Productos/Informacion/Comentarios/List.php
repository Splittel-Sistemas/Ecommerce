<?php 

  if (isset($_POST['IdProducto'])) {
   $IdProducto = $_POST['IdProducto'];
  } else if (isset($_GET['id_prd'])) {
    $IdProducto = $_GET['id_prd'];
  } else {
    $IdProducto = "";
  }

  if (isset($_POST['IdCategoria'])) {
   $IdCategoria = $_POST['IdCategoria'];
  } else if (isset($_GET['codigo'])) {
    $IdCategoria = $_GET['codigo'];
  } else {
    $IdCategoria = "";
  }

  if (!class_exists('ComentariosController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Productos/Comentarios.Controller.php';
  }

  $Where = empty($IdProducto) ? "WHERE IdCategoria = '".$IdCategoria."' " : "WHERE IdProducto = '".$IdProducto."' ";
  
  $ComentariosController = new ComentariosController();
  $ComentariosController->filter = $Where;
  $Comentarios = $ComentariosController->Comentarios_();
?>

<div class="container padding-top-2x">
  <div class="row">
    <div class="col-md-3 mb-4">
      <div class="card border-default">
        <div class="card-body">
          <?php 
            if (count($Comentarios['items']) > 0): 
              $ComentariosPrincipal = $Comentarios['Principal'];
          ?>
          <div class="text-center">
            <div class="d-inline align-baseline display-3 mr-1"><?php echo $ComentariosPrincipal->Promedio ?></div>
            <div class="d-inline align-baseline text-sm text-warning mr-1">
              <div class="rating-stars">
              <?php 
                for ($i=0; $i < 5; $i++) { 
                  if ($i < (int)$ComentariosPrincipal->Promedio) {
              ?>
                <i class="icon-star filled"></i>
              <?php }else{ ?>
                <i class="icon-star"></i>
               <?php } } ?>
              </div>
            </div>
          </div>
          <div class="pt-3">
            <?php foreach ($Comentarios['items'] as $key => $Items): ?>
            <label class="text-medium text-sm"><?php echo $Items['Estrellas'] ?> 
              Estrellas <span class='text-muted'>- <?php echo $Items['TotalComentarios'] ?></span>
            </label>
            <div class="progress margin-bottom-1x">
              <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $Items['Porcentaje'] ?>%; height: 2px;" aria-valuenow="<?php echo $Items['Porcentaje'] ?>" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <?php endforeach ?>
          </div>
          <?php else: ?>
          <div class="text-center">
            <div class="d-inline align-baseline display-3 mr-1">0</div>
            <div class="d-inline align-baseline text-sm text-warning mr-1">
                <div class="rating-stars">
                  <i class="icon-star"></i>
                  <i class="icon-star"></i>
                  <i class="icon-star"></i>
                  <i class="icon-star"></i>
                  <i class="icon-star"></i>
                </div>
            </div>
          </div>
          <div class="pt-3">
            <label class="text-medium text-sm">5 Estrellas <span class='text-muted'>- 0</span></label>
            <div class="progress margin-bottom-1x">
              <div class="progress-bar bg-warning" role="progressbar" style="width: 0%; height: 2px;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <label class="text-medium text-sm">4 Estrellas <span class='text-muted'>- 0</span></label>
            <div class="progress margin-bottom-1x">
              <div class="progress-bar bg-warning" role="progressbar" style="width: 0%; height: 2px;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <label class="text-medium text-sm">3 Estrellas <span class='text-muted'>- 0</span></label>
            <div class="progress margin-bottom-1x">
              <div class="progress-bar bg-warning" role="progressbar" style="width: 0%; height: 2px;" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <label class="text-medium text-sm">2 Estrellas <span class='text-muted'>- 0</span></label>
            <div class="progress margin-bottom-1x">
              <div class="progress-bar bg-warning" role="progressbar" style="width: 0%; height: 2px;" aria-valuenow="3" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <label class="text-medium text-sm">1 Estrella <span class='text-muted'>- 0</span></label>
            <div class="progress mb-2">
              <div class="progress-bar bg-warning" role="progressbar" style="width: 0; height: 2px;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <?php endif ?>
          <div class="pt-2">
            <button class="btn btn-warning btn-sm btn-block" onclick="showFormCreate()">Dejar comentario</button>
          </div>
        </div>
      </div>
    </div>
    <?php 
      $Limit = isset($_POST['ocultar']) && $_POST['ocultar'] == 'false' ? "" : "LIMIT 3 " ;

      $ComentariosController->filter = $Where;
      $ComentariosController->order = $Limit;
      $ComentariosGet = $ComentariosController->Get();

      $Style = $ComentariosGet->count > 0 ? "scroll" : "";
     ?>
    <div class="col-md-8 <?php echo $Style?>">
      <h3 class="padding-bottom-1x">Últimos comentarios</h3>
      <!-- Review-->
      <?php foreach ($ComentariosGet->records as $ComentarioList){ ?>
      <div class="comment">
        <div class="comment-author-ava"><img src="../../public/images/Otros/user_.jpg" alt="Comment author"></div>
        <div class="comment-body">
          <div class="comment-header d-flex flex-wrap justify-content-between">
            <h4 class="comment-title"><?php echo $ComentarioList->Titulo; ?></h4>
            <div class="mb-2">
              <div class="rating-stars">
                <?php 
                  for ($i=0; $i < 5; $i++) { 
                    if ($i < $ComentarioList->Estrellas) {
                ?>
                  <i class="icon-star filled"></i>
                <?php }else{ ?>
                  <i class="icon-star"></i>
                 <?php } } ?>
              </div>
            </div>
          </div>
          <p class="comment-text"><?php echo $ComentarioList->Descripcion; ?></p>
          <div class="comment-footer"><span class="comment-meta"><?php echo $ComentarioList->Usuario ?></span></div>
        </div>
      </div>
      <?php } ?>
      <!-- View All Button-->
      <?php if ($ComentariosGet->count > 3 && empty($Limit)): ?>
      <a class="btn btn-info btn-sm btn-block" onclick="ListReviews(this)" boolean="true" href="#">ocultar comentarios</a>
      <?php endif ?>
      <?php if ($ComentariosGet->count >= 3 && !empty($Limit)): ?>
      <a class="btn btn-info btn-sm btn-block" onclick="ListReviews(this)" boolean="false" href="#">ver todos los comentarios</a>
      <?php endif ?>
    </div>
  </div>
</div>