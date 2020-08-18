<div class="accordion" id="accordion1" role="tablist">
  <?php 
    if (!class_exists('PreguntaCController')) {
      include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Solicitud/Consultecnico/Pregunta.Controller.php';
    }
    $category = isset($_GET['Categoria']) ? $_GET['Categoria'] : 'A1'; 
    $PreguntaCController = new PreguntaCController();
    $PreguntaCController->filter = "WHERE t41_f004 = '".$category."' ";
    $ResultPregunta = $PreguntaCController->Get();
    foreach ($ResultPregunta->records as $key => $Obj) {
  ?>
  <div class="card">
    <div class="card-header" role="tab">
    <h6><a href="#collapse<?php echo $Obj->Key ?>" data-toggle="collapse"><?php echo $Obj->Pregunta ?></a></h6>
    </div>
    <div class="collapse <?php echo $key == 0 ? 'show' : '' ?>" id="collapse<?php echo $Obj->Key ?>" data-parent="#accordion1" role="tabpanel">
      <div class="card-body" id="listar-mensajes-pregunta-<?php echo $Obj->Key ?>">
        <?php 
          if(count($Obj->Mensaje) > 0){
          foreach ($Obj->Mensaje as $key => $Obj_) {
        ?>
        <!-- Messages-->
        <div class="comment">
          <div class="comment-author-ava"><img src="../../public/images/Otros/user_.jpg" alt="Avatar"></div>
          <div class="comment-body">
            <p class="comment-text"><?php echo $Obj_->Mensaje ?></p>
            <div class="comment-footer"><span class="comment-meta">--</span></div>
          </div>
        </div>
        <?php } }?>
        <!-- Reply Form-->
        <h5 class="mb-30 padding-top-1x">Dejar Mensaje</h5>
        <form>
          <div class="row">
            <div class="col-sm-12 form-group">
              <textarea class="form-control" name="Mensaje-<?php echo $Obj->Key ?>" id="Mensaje-<?php echo $Obj->Key ?>" cols="30" rows="8" placeholder="Escribe tú mensaje aqui..."></textarea>
            </div>
          </div>
          <button type="button" class="btn btn-primary float-right" preguntakey="<?php echo $Obj->Key ?>" onclick="EnviarMensaje(this)">Enviar Mensaje</button>
        </form>
      </div>
    </div>
  </div>
  <?php } ?>
</div>