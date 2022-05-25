<?php 
  foreach ($getProduct->records as $key => $obj) { 
    $urlDetailProduct = "../Productos/fijos.php?id_prd=".$obj->ProductoCodigo."&nom=".url_amigable($obj->ProductoDescripcion); #url detalle del producto
    $urlImg = "../../public/images/img_spl/productos/".$obj->ProductoCodigo."/thumbnail/".$obj->ProductoImgPrincipal; #url imagen del producto
    $newUrlImg = file_exists($urlImg) ? $urlImg : "../../public/images/img_spl/notfound.png"; # validación si existe $urlImg
    $calculatePrice = $obj->ProductoPrecio - ($obj->ProductoPrecio * ($obj->Descuento/100));
    $priceUSD = bcdiv($calculatePrice,1,3);
    $priceMXN = number_format($calculatePrice * $_SESSION['Ecommerce-WS-CurrencyRate'],3);
?>
<!-- Entry-->
<div class="entry">
  <div class="entry-thumb">
    <a href="<?php echo $urlDetailProduct ?>">
      <img src="<?php echo $newUrlImg?>" alt="Product">
    </a>
  </div>
  <div class="entry-content">
    <h4 class="entry-title">
      <a href="<?php echo $urlDetailProduct ?>"><?php echo $obj->ProductoDescripcion;?></a>
    </h4>
    <?php if(isset($_SESSION['Ecommerce-ClienteKey'])){ ?>
    <span class="entry-meta" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="$<?php echo $priceMXN ?> MXP">
    $<?php echo $priceUSD ?> USD
    <?php } ?>
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