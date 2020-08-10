<!-- Leave a Review-->
<div class="modal fade" id="modal-review">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form id="form-review">
          <input type="hidden" id="ProductoKey" name="ProductoKey" value="<?php echo $IdProducto ?>">
          <input type="hidden" id="CategoriaKey" name="CategoriaKey" value="<?php echo $IdCategoria ?>">
          <div id="modal-body-review">
            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Leave a Review-->
<div class="modal fade" id="modal-360">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body-360">
      <?php
        $fichero_360 = "../../public/images/img_spl/productos/".$Obj->ProductoCodigo."/360/".$Obj->ProductoCodigo.".html";
        if (file_exists($fichero_360)) {
        ?>
        <iframe height="500px" src="<?php echo $fichero_360;?>"></iframe>              
      <?php
      }
      ?>
      </div>
    </div>
  </div>
</div>