<?php
if(isset($_POST['idComent'])){
 $idComentario=$_POST['idComent'];
}else{
  $idComentario='';
}
if(isset($_POST['idBlog'])){
  $idBlog=$_POST['idBlog'];
 }else{
   $idBlog='';
 }
?>

  <input type="hidden" id="Action" name="Action" value="createReply">
  <input type="hidden" id="ActionComentarios" name="ActionComentarios" value="true">
  <input type="hidden" id="KeyRelacion" name="KeyRelacion" value="<?php echo $idComentario;?>">
  <input type="hidden" id="BlogKey" name="BlogKey" value="<?php echo $idBlog?>"/>
  <div class="row">
    <div class="form-group col-sm-12">
      <label for="review-message">Descripción</label>
      <textarea class="form-control form-control-sm" name="Comment" id="comment-text" rows="5"></textarea>
    </div>
  </div>
<button type="button" class="btn btn-warning btn-sm btn-block" onclick="createReply()">Guardar</button>

