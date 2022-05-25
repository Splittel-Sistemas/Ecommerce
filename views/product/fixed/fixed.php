<?php 
  if (!class_exists('ComentariosController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Productos/Comentarios.Controller.php';
  }
  foreach ($getProduct->records as $key => $obj) { 
    $urlDetailProduct = "../Productos/fijos.php?id_prd=".$obj->ProductoCodigo."&nom=".url_amigable($obj->ProductoDescripcion); #url detalle del producto
    $urlImg = "../../public/images/img_spl/productos/".$obj->ProductoCodigo."/thumbnail/".$obj->ProductoImgPrincipal; #url imagen del producto
    $newUrlImg = file_exists($urlImg) ? $urlImg : "../../public/images/img_spl/notfound.png"; # validación si existe $urlImg
    $calculatePrice = $obj->ProductoPrecio - ($obj->ProductoPrecio * ($obj->Descuento/100));
    $priceUSD = bcdiv($calculatePrice,1,3);
    $priceMXN = number_format($calculatePrice * $_SESSION['Ecommerce-WS-CurrencyRate'],3);
?>
<div class="<?php echo $columnas ?>">
  <div class="product-card mb-30">
    <div class="rating-stars">
      <?php 
        $ComentariosController = new ComentariosController();
        $ComentariosController->filter = "WHERE IdProducto = '".$obj->ProductoCodigo."'";
        $Comentarios = $ComentariosController->Comentarios();
        
        if($Comentarios->count > 0){
          $RecordsComentarios = $Comentarios->records[0];
          $Promedio = (int)$RecordsComentarios->Promedio;
          for ($i=0; $i < 5; $i++) { 
            if ($i < $Promedio) {
      ?>
      <i class="icon-star filled"></i>
      <?php }else{ ?>
      <i class="icon-star"></i>
      <?php } } }else{ ?>
        <i class="icon-star"></i>
        <i class="icon-star"></i>
        <i class="icon-star"></i>
        <i class="icon-star"></i>
        <i class="icon-star"></i>
      <?php }
        unset($ComentariosController);
        unset($Comentarios);
      ?>
    </div>
    <a class="product-thumb" href="<?php echo $urlDetailProduct ?>">
      <img src="<?php echo $newUrlImg ?>" alt="<?php echo $obj->ProductoDescripcion ?>">
    </a>
    <div class="product-card-body">
      <div class="product-category"><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoCodigo ?></a></div>
      <h3 class="product-title" style="height:60px;"><a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoDescripcion ?></a></h3>
      <!-- validar si existe variable de sesión -->
      <?php if(isset($_SESSION['Ecommerce-ClienteKey'])){ ?>
      <h4 class="product-price" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceMXN;?> MXP">
        $<?php echo $priceUSD ?> USD
      </h4>
      <?php } ?>
    </div>
    <div class="product-button-group">
      <input type="hidden" name="ProductoCantidad-<?php echo $obj->ProductoCodigo;?>" id="ProductoCantidad-<?php echo $obj->ProductoCodigo;?>" value="1">
      <?php if(isset($_SESSION['Ecommerce-ClienteKey'])){ ?>
      <a class="product-button" href="javascript:(0)" descuento="<?php echo $obj->Descuento ?>" codigo="<?php echo $obj->ProductoCodigo;?>" onclick="AgregarArticulo(this)">
      <?php }else{ ?>
      <a class="product-button" href="javascript:(0)">
      <?php } ?>
        <i class="icon-shopping-cart"></i><span>Agregar a carrito</span>
      </a>
    </div>
  </div>
</div>
<?php 
  unset($urlDetailProduct);
  unset($urlImg);
  unset($newUrlImg);
  unset($calculatePrice);
  unset($priceUSD);
  unset($priceMXN);
  } 
?>