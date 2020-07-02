<?php 
  if (isset($_POST['DirectorioImgProducto'])) {
    $Directorio = "public/images/img_spl/productos/".$_POST['DirectorioImgProducto']."/";
    $Img = glob("../../".$Directorio."*.jpg");
?>

<div class="product-carousel owl-carousel gallery-wrapper">
<?php foreach ($Img as $cont_img => $value): $cont_img = $cont_img + 1; ?>
  <div class="gallery-item" data-hash="<?php echo $cont_img;?>">
    <a href="#" data-size="1000x667" onclick="VerPhotoPs(this)" option="<?php echo $cont_img; ?>">
      <img class="PhotoPs" src="<?php echo "../../".$Directorio.$cont_img;?>.jpg" alt="Product">
    </a>
  </div>
<?php endforeach ?>
</div>

<ul class="product-thumbnails">
<?php foreach ($Img as $cont_img => $value): $cont_img = $cont_img + 1; ?>
  <li <?php if($cont_img==1){?> class="active" <?php }?> >
    <a href="#<?php echo $cont_img;?>">
      <img src="<?php echo "../../".$Directorio.$cont_img;?>.jpg" alt="Product">
    </a>
  </li>
<?php endforeach ?>
</ul>

<?php } ?>