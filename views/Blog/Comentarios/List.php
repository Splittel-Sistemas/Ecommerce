<?php
if(isset($_GET['id'])){
    $IdBlog = $_GET['id'];
}elseif(isset($_POST['id'])){
    $IdBlog = $_POST['id'];
}else{
    $IdBlog = "";
}

if (!class_exists('ComentariosBlogController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Blog/Comentarios/Comentarios.Controller.php';
  }
 if (!class_exists('ClienteController')) {
		include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cliente/Cliente.Controller.php';
	}



  $Where = "WHERE id_blog = '".$IdBlog."' AND tipo=0 AND activo=1";
  $Order = "ORDER BY fecha DESC";
  
  $ComentariosController = new ComentariosBlogController();
  $ComentariosController->filter = $Where;
  $ComentariosController->order = $Order;
  $Comentarios = $ComentariosController->Get();
?>
<!-- Comments-->
<section class="padding-top-3x" data-offset-top="60" id="comments">
            <!-- Comment-->
            <div class="row justify-content-center">
            <!-- Content-->
            <div class="col-xl-9 col-lg-8 order-lg-2">
            <h3 class="padding-bottom-1x">Comentario</h3>

            <?php foreach ($Comentarios->records as $ComentarioList){ ?>

            <div class="comment">
              <div class="comment-author-ava">
              <?php
                       $ImgUser = "../../public/images/img_spl/usuarios/Us_".$ComentarioList->KeyCliente.".png";
                       if (file_exists($ImgUser) && $ComentarioList->KeyCliente!=0) { ?>
                        <img src="<?php echo $ImgUser;?>" alt="Comment author">
                  <?
                       }else{
                  ?>
                    <img src="../../public/images/Otros/user_.jpg" alt="Comment author">
                  <?php
                       }
                  ?>
              </div>
              <div class="comment-body">
                <div class="comment-header">
                  <h4 class="comment-title">
                  <?php 
                  if($ComentarioList->KeyCliente==0){
                    echo "Usuario";
                  }else{
                    $ClienteController = new ClienteController();
                    $ClienteController->filter = "WHERE id_cliente = ".$ComentarioList->KeyCliente." ";
                    $Cliente = $ClienteController->getBy();
                     echo $Cliente->GetNombre().' '.$Cliente->GetApellidos();
                  } ?>
                  </h4>
                </div>
                <p class="comment-text"><?php echo nl2br($ComentarioList->Review); ?></p>
                <div class="comment-footer">
                  <div class="column"><span class="comment-meta">
                  <?php echo date("d-m-Y", strtotime($ComentarioList->fecha));?></span></div>
                  <div class="column"><a class="reply-link" onclick="showFormCreate(<?php echo $ComentarioList->Key;?>)" href="#"><i class="icon-corner-up-left"></i>Responder</a></div>
                </div>
                <!-- Comment reply-->
              <?php
              
                $Where1 = "WHERE id_comentario ='".$ComentarioList->Key."' AND Id_blog = '".$IdBlog."' AND tipo=1 AND activo=1";
                $Order1 = "ORDER BY fecha ASC";
                
                $ComentariosController1 = new ComentariosBlogController();
                $ComentariosController1->filter = $Where1;
                $ComentariosController1->order = $Order1;
                $Comentarios1 = $ComentariosController1->Get();
                
                 foreach ($Comentarios1->records as $ComentarioList1){ ?>
            
                
                <div class="comment comment-reply">
                  <div class="comment-author-ava">
                  <?php
                       $ImgUser = "../../public/images/img_spl/usuarios/Us_".$ComentarioList1->KeyCliente.".png";
                       if (file_exists($ImgUser)) { ?>
                        <img src="<?php echo $ImgUser;?>" alt="Comment author">
                  <?
                       }else{
                  ?>
                    <img src="../../public/images/Otros/user_.jpg" alt="Comment author">
                  <?php
                       }
                  ?>
                  </div>
                  <div class="comment-body">
                    <div class="comment-header">
                      <h4 class="comment-title">
                  <?php 
                  if($ComentarioList1->KeyCliente==0){
                    echo "Usuario";
                  }else{
                    $ClienteController1 = new ClienteController();
                    $ClienteController1->filter = "WHERE id_cliente = ".$ComentarioList1->KeyCliente." ";
                    $Cliente1 = $ClienteController1->getBy();
                     echo $Cliente1->GetNombre().' '.$Cliente1->GetApellidos();
                  } ?></h4>
                    </div>
                    <p class="comment-text"><?php echo nl2br($ComentarioList1->Review); ?></p>
                    <div class="comment-footer"><span class="comment-meta"><?php echo date("d-m-Y", strtotime($ComentarioList1->fecha));?></span></div>
                  </div>
                </div>
                <?php }?>

              </div>
            </div>

            <?php } ?>

            </div>
          </div>
            
          </section>