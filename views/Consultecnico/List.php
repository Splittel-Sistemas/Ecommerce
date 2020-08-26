<?php
  if(isset($_GET['Categoria'])){
    $category = isset($_GET['Categoria']) ? $_GET['Categoria'] : ''; 
 ?>
<div class="accordion" id="accordion1" role="tablist">
  <?php 
    if (!class_exists('PreguntaCController')) {
      include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Solicitud/Consultecnico/Pregunta.Controller.php';
    }
    
    $PreguntaCController = new PreguntaCController();
    $PreguntaCController->filter = "WHERE t41_f004 = '".$category."' AND t41_f006 = 1 ";
    $ResultPregunta = $PreguntaCController->Get();
    foreach ($ResultPregunta->records as $key => $Obj) {
  ?>
  <div class="card">
    <div class="card-header" role="tab">
      <a href="#collapse<?php echo $Obj->Key ?>" data-toggle="collapse"><?php echo $Obj->Titulo ?></a>
      <ul class="list-icon">
        <li class="ml-3"><?php echo $Obj->Pregunta ?></li>
      </ul>
    </div>
    <div class="collapse <?php echo $key == 0 ? 'show' : '' ?>" id="collapse<?php echo $Obj->Key ?>" data-parent="#accordion1" role="tabpanel">
      <div class="card-body">
        <div id="listar-mensajes-pregunta-<?php echo $Obj->Key ?>">
          <?php 
            if(count($Obj->Mensaje) > 0){
              foreach ($Obj->Mensaje as $key => $Obj_) {
                $ImgUser = $Obj_->Estatus == "CLIENTE" ? "../../public/images/Otros/user_.jpg" : "../../public/images/img_spl/usuarios/Us_1136.png";
          ?>
          <!-- Messages-->
          <div class="comment">
            <div class="comment-author-ava"><img src="<?php echo $ImgUser ?>" alt="Avatar"></div>
            <div class="comment-body">
              <p class="comment-text"><?php echo $Obj_->Mensaje ?></p>
              <div class="comment-footer"><span class="comment-meta">--</span></div>
            </div>
          </div>
          <?php } }?>
        </div>
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
<?php } ?>