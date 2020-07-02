<?php 
  if (isset($_POST['DirectorioImgProducto'])) {
    $Directorio = "public/images/img_spl/productos/".$_POST['DirectorioImgProducto']."/";
	$nombre=$_POST['nombre'];
  if(  file_exists("../../".$Directorio."/".$nombre.".jpg")){
	
?>

<div class="product-carousel owl-carousel gallery-wrapper">
  <div class="gallery-item" data-hash="<?php echo "../../".$Directorio."/".$nombre.".jpg"?>">
    <a href="#" data-size="1000x667" onclick="VerPhotoPs(this)" option="<?php echo "../../".$Directorio."/".$nombre.".jpg"?>">
      <img class="PhotoPs" src="<?php echo "../../".$Directorio."/".$nombre.".jpg"?>" alt="Product">
    </a>
  </div>
</div>

<ul class="product-thumbnails">
  <li class="active"  >
    <a href="#<?php echo "../../".$Directorio."/".$nombre.".jpg"?>">
      <img src="<?php echo "../../".$Directorio."/".$nombre.".jpg" ?>" alt="Product">
    </a>
  </li>
</ul>

<?php } 

  }?>