<?php 
  if (isset($_POST["Descripcion"])){
  if (!class_exists("ProductoController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Producto.Controller.php';
  }
  if (!class_exists("SubcategoriasController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Subcategorias/Subcategorias.Controller.php';
  }
  if (!class_exists("SubcategoriasN1Controller")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Subcategorias/SubcategoriasN1.Controller.php';
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
  
  //BUSCADOR DE CATEGORIAS
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

  //BUSCADOR DE SUBCATEGORIAS
  $SubcategoriasN1Controller = new SubcategoriasN1Controller();
            $SubcategoriasN1Controller->filter = "WHERE (desc_subcategoria LIKE '%".$_POST["Descripcion"]."%') AND activo='si' ";
            $SubcategoriasN1Controller->order = "LIMIT 8";
            $ResultSubcategoriasN1 = $SubcategoriasN1Controller->get();
            if($ResultSubcategoriasN1->count > 0 ){
              $SubcategoriaN1Key = $ResultSubcategoriasN1->records[0]->CategoriasKey;
             	foreach ($ResultSubcategoriasN1->records as $key => $SubcategoriaN1){ 
               
             ?>
                <a class="list-group-item item-product" href="../Productos/configurables.php?codigo=<?php echo urlencode($SubcategoriaN1->Codigo); ?>">
                <?php echo "<span style='color:#BF202F;'>Configúralo -></span> ". $SubcategoriaN1->Descripcion; ?>
              </a>
            <?php 
                } 
            }
    unset($SubcategoriasN1Controller);
    unset($ResultSubcategoriasN1);
    unset($SubcategoriaN1);

  //BUSCADOR DE PRODUCTOS FIJOS
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
