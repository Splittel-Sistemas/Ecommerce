<?php 
    if (!class_exists("MensajeController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Solicitud/Consultecnico/Mensaje.Controller.php';
    }
    $MensajeController = new MensajeController();
    $MensajeController->filter = " WHERE t41_pk01 = ".$_POST['pregunta']." ";
    $MensajeController->order = " ORDER BY t42_f098 DESC";
    $ResultMensaje = $MensajeController->Get();
    foreach ($ResultMensaje->records as $key => $Obj_) {
        if( $Obj_->Estatus == "CLIENTE" ){
            $ImgUser = "../../public/images/Otros/user_.jpg";
            $nomResp='Anonimo';
         }else{
          
          if (!class_exists('ConsultecnicosController')) {
            include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Solicitud/Consultecnico/Consultecnicos.Controller.php';
          }
          
          $ConsultecnicosController = new ConsultecnicosController();
          $ConsultecnicosController->filter = "WHERE IdSplitnet=".$Obj_->ConsultorKey;
          $ResultConsultecnicos = $ConsultecnicosController->Get();
          foreach ($ResultConsultecnicos->records as $key => $Object1_) {
            $ImgFib = $Object1_->Imagen;
            $nomRE=$Object1_->Nombre.' '.$Object1_->Apellido;
          }
          $nomResp=$nomRE;
          $ImgUser="../../public/images/img_spl/splittellers/".$ImgFib;
        }
        
?>
<!-- Messages-->
<div class="comment">
    <div class="comment-author-ava"><img src="<?php echo $ImgUser ?>" alt="Avatar"></div>
    <div class="comment-body">
      <p class="comment-text"><?php echo $Obj_->Key >= 55 ? ($Obj_->Mensaje) : nl2br($Obj_->Mensaje); ?></p>
      <div class="comment-footer">
              <?php
              if($Obj_->Adjunto!=''){
                ?>
              <span class="comment-meta">
              <a target="_blank" href="../../public/images/img_spl/consultecnico/<?php echo $Obj_->Adjunto;?>">
              <i class="icon-download-cloud"></i>
              <?php echo $Obj_->Adjunto;?></a></span>
              <br/>
              <?php
              } ?>
              <span class="comment-meta"><?php echo ($nomResp);?></span>
              </div>
    </div>
</div>
<?php } ?>