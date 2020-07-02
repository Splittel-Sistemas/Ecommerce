<?php if (isset($_POST['DirectorioImgProducto'])) { ?>

  <?php 
    $Directorio = "public/images/img_spl/productos/".$_POST['DirectorioImgProducto']."/descripcion/";
    $Img = glob("../../../../".$Directorio."*.jpg");
    foreach ($Img as $cont_img => $value): 
      $cont_img = $cont_img + 1; 
  ?>
    <img class="img-responsive" src="<?php echo "../../".$Directorio.$cont_img;?>.jpg" alt="Product">
  <?php endforeach ?>
<?php } ?>