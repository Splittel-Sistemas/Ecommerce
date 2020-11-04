<?php 
  if (isset($_POST["Descripcion"])){
  if (!class_exists("ProductoController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Producto.Controller.php';
  }
  if (!class_exists("SubcategoriasController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Subcategorias/Subcategorias.Controller.php';
  }
  if (!function_exists('url_amigable')) {
    function url_amigable($url_tmp) {
      ##webdebe.com
      //Convertimos a minúsculas y UTF8
      $url_utf8 = mb_strtolower($url_tmp, 'UTF-8');
      
      //Reemplazamos espacios por guion
      $find = array(' ', '&', '\r\n', '\n', '+');
      $url_utf8 = str_replace ($find, '-', $url_utf8);
      
      $url_utf8 = strtr(utf8_decode($url_utf8),
        utf8_decode('_àáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'),
        '-aaaaaaaceeeeiiiionoooooouuuuyy');
      
      //Ya que usamos TRANSLIT en el comando iconv, tenemos que limpiar los simbolos que quedaron
      $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
      $repl = array('', '-', '');
      $url = preg_replace ($find, $repl, $url_utf8);
      
      return $url;
      }
    }
  $SubcategoriasController = new SubcategoriasController();
  $SubcategoriasController->filter = "WHERE desc_subcategoria LIKE '%".$_POST["Descripcion"]."%' AND activo='si' ";
  $SubcategoriasController->order = "LIMIT 5";
  $ResultSubcategoria_ = $SubcategoriasController->get();
  foreach ($ResultSubcategoria_->records as $key1 => $Obj1){
    if($Obj1->Subnivel=='SI'){
    ?>
    <a class="list-group-item item-product" href="../Productos/categorias.php?id_sbct=<?php echo $Obj1->SubcategoriasKey; ?>&sbn=si">
      <?php echo $Obj1->Descripcion; ?>
    </a>
    <?php 
    }
    if($Obj1->Subnivel=='NO'){
    ?>
    <a class="list-group-item item-product" href="../Productos/categorias.php?id_sbct=<?php echo $Obj1->SubcategoriasKey; ?>&sbn=no">
      <?php echo $Obj1->Descripcion; ?>
    </a>
  <?php }
  } 
unset($SubcategoriasController);
unset($ResultSubcategoria_);
unset($Obj1);
  $ProductoController = new ProductoController();
  $ProductoController->filter = "WHERE (desc_producto LIKE '%".$_POST["Descripcion"]."%' OR codigo LIKE '%".$_POST["Descripcion"]."%') AND producto_activo = 'si' AND codigo_configurable ='' ";
  $ProductoController->order = "LIMIT 20";
  $ResultProducto_ = $ProductoController->GetProductosFijos_();

  foreach ($ResultProducto_->records as $key => $Obj){
  ?>
  <a class="list-group-item item-product" href="../Productos/fijos.php?id_prd=<?php echo urlencode($Obj->ProductoCodigo); ?>&nom=<?php echo url_amigable($Obj->ProductoDescripcion);?>">
    <?php echo $Obj->ProductoCodigo; ?> - <?php echo $Obj->ProductoDescripcion; ?>
  </a>
<?php } 
    unset($ProductoController);
    unset($ResultProducto_);
    unset($Obj);
  }else{ ?>
  <a class="list-group-item item-product" href="#">
    No se envian datos, si el problema persiste por favor pide ayuda a tu ejecutivo
  </a>
<?php } ?>
