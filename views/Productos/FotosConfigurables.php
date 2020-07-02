<?php 
  if (isset($_POST['DirectorioImgProducto']) && isset($_POST['ImgProducto'])) {
    $Directorio = "public/images/img_spl/productos/".$_POST['DirectorioImgProducto']."/fotos/".$_POST['ImgProducto'];
?>

<div class="product-carousel owl-carousel gallery-wrapper">
  <div class="gallery-item" data-hash="1">
    <a href="#" onclick="VerPhotoPs(this)" data-size="1000x667">
      <img class="PhotoPs" src="<?php echo "../../".$Directorio?>.jpg" alt="Product">
    </a>
  </div>
</div>

<ul class="product-thumbnails">
  <li class="active">
    <a href="#1">
      <img src="<?php echo "../../".$Directorio?>.jpg" alt="Product">
    </a>
  </li>
</ul>

<?php } ?>