<?php 
    if (!class_exists("MensajeController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Solicitud/Consultecnico/Mensaje.Controller.php';
    }
    $MensajeController = new MensajeController();
    $MensajeController->filter = " WHERE t41_pk01 = ".$_POST['pregunta']." ";
    $ResultMensaje = $MensajeController->Get();
    foreach ($ResultMensaje->records as $key => $Obj_) {
?>
<!-- Messages-->
<div class="comment">
    <div class="comment-author-ava"><img src="../../public/images/Otros/user_.jpg" alt="Avatar"></div>
    <div class="comment-body">
    <p class="comment-text"><?php echo $Obj_->Mensaje ?></p>
    <div class="comment-footer"><span class="comment-meta">--</span></div>
    </div>
</div>
<?php } ?>