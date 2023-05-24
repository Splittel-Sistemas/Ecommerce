<?php
if (isset($_POST["Descripcion"])) {
  if (!class_exists("ProductoController")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
  }
  if (!class_exists("SubcategoriasN1Controller")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Subcategorias/SubcategoriasN1.Controller.php';
  }
  if (!class_exists("SubmenuController")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Submenu/Submenu.Controller.php';
  }

  if (!function_exists('url_amigable')) {
    function url_amigable($url_tmp)
    {
      //Convertimos a minúsculas y UTF8
      $url_utf8 = mb_strtolower($url_tmp, 'UTF-8');

      //Reemplazamos espacios por guion
      $find = array(' ', '&', '\r\n', '\n', '+');
      $url_utf8 = str_replace($find, '-', $url_utf8);

      $url_utf8 = strtr(
        utf8_decode($url_utf8),
        utf8_decode('_àáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'),
        '-aaaaaaaceeeeiiiionoooooouuuuyy'
      );

      //Ya que usamos TRANSLIT en el comando iconv, tenemos que limpiar los simbolos que quedaron
      $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
      $repl = array('', '-', '');
      $url = preg_replace($find, $repl, $url_utf8);

      return $url;
    }
  }
  $like = "";
  $e = explode(" ", $_POST["Descripcion"]);
  for ($i = 0; $i < count($e); $i++) {
   
    if ($e[$i] != ""  && $e[$i] != "de" && $e[$i] != "DE" && $e[$i] != "O" && $e[$i] != "o" && $e[$i] != "para" && $e[$i] != "PARA" && $e[$i] != "con" && $e[$i] != "CON" ) {
      $like .= " OR desc_producto LIKE '%" . $e[$i] . "%'";
    }
  }

  $like2 = "";
  $e = explode(" ", $_POST["Descripcion"]);
  for ($i = 0; $i < count($e); $i++) {
    if ($e[$i] != ""  && $e[$i] != "de" && $e[$i] != "DE" && $e[$i] != "O" && $e[$i] != "o" && $e[$i] != "para" && $e[$i] != "PARA" && $e[$i] != "con" && $e[$i] != "CON" ) {

      $like2 .= " OR codigo LIKE '%" . $e[$i] . "%' ";
    }
  }


  $desc = "";
  $e = explode(" ", $_POST["Descripcion"]);
  for ($i = 0; $i < count($e); $i++) {
    if ($e[$i] != "" && $e[$i] != "de" && $e[$i] != "DE" && $e[$i] != "O" && $e[$i] != "o" && $e[$i] != "para" && $e[$i] != "PARA" && $e[$i] != "con" && $e[$i] != "CON") {

      $desc .= " OR descripcion LIKE '%" . $e[$i] . "%'";
    }
  }
  $SubmenuController = new SubmenuController();
  $SubmenuController->filter = "WHERE (descripcion LIKE '%" . $_POST["Descripcion"] . "%' $desc  ) AND activo='si'  ";
  $SubmenuController->order = "LIMIT 6";
  $Subcategoria = $SubmenuController->get();
  if ($Subcategoria->count > 0) {
    foreach ($Subcategoria->records as $key => $Subcategoria_) {
      if ($Subcategoria_->nivel == 2) {
?>
        <a class="list-group-item item-product" href="../Productos/categorias.php?id_sbct=<?php echo $Subcategoria_->Key; ?>">
          <?php echo $Subcategoria_->Descripcion; ?>
        </a>
      <?php }
      if ($Subcategoria_->nivel == 3) {
      ?>
        <a class="list-group-item item-product" href="../Productos/categorias.php?id_sbct=<?php echo $Subcategoria_->CategoriasKey; ?>&id_gpo=<?php echo $Subcategoria_->Key; ?>">
          <?php echo $Subcategoria_->Descripcion; ?>
        </a>
      <?php
      }
    }
  }
  unset($SubmenuController);
  unset($Subcategoria);
  unset($Subcategoria_);



  //BUSCADOR DE PRODUCTOS FIJOS
  $ProductoController = new ProductoController();
  $ProductoController->filter = "WHERE ((desc_producto LIKE '%" . $_POST["Descripcion"] . "%'   $like   OR codigo LIKE '%" . $_POST["Descripcion"] . "%'  $like2) AND producto_activo = 'si' )  ";
  $ProductoController->order = " LIMIT 6";
  $ResultProducto_ = $ProductoController->GetProductosFijos_();



  foreach ($ResultProducto_->records as $key => $Obj) {

    if ($Obj->ProductoCodigoConfigurable != '' && $Obj->ConfigurableFijo == 'no') { ?>
      <a class="list-group-item item-product" href="../Productos/configurables.php?codigo=<?php echo urlencode($Obj->ProductoCodigoConfigurable); ?>">
        <?php echo $Obj->ProductoCodigo; ?> - <?php echo $Obj->ProductoDescripcion; ?>
      </a>
    <?php } else { ?>
      <a class="list-group-item item-product" href="../Productos/fijos.php?id_prd=<?php echo urlencode($Obj->ProductoCodigo); ?>&nom=<?php echo url_amigable($Obj->ProductoDescripcion); ?>">
        <?php echo $Obj->ProductoCodigo; ?> - <?php echo $Obj->ProductoDescripcion; ?>
      </a>

    <?php
    }
  }
  unset($ProductoController);
  unset($ResultProducto_);
  unset($Obj);




  //BUSCADOR DE SUBCATEGORIAS

  $cat = "";
  $e = explode(" ", $_POST["Descripcion"]);
  for ($i = 0; $i < count($e); $i++) {
    if ($e[$i] != "") {

      $cat .= " OR desc_subcategoria LIKE '%" . $e[$i] . "%'";
    }
  }
  $clave = "";
  $div = $telefono = str_split($_POST["Descripcion"], 4);

  foreach ($div as $value) {
    /*  echo $value."<br/>"; */
    $clave .= " OR clave LIKE '%" . $value . "%'";
  }
  $SubcategoriasN1Controller = new SubcategoriasN1Controller();
  $SubcategoriasN1Controller->filter = "WHERE (desc_subcategoria LIKE '%" . $_POST["Descripcion"] . "%' $cat  OR clave LIKE '%" . $_POST["Descripcion"] . "%' $clave ) AND activo='si'  ";
  $SubcategoriasN1Controller->order = "LIMIT 6";
  $ResultSubcategoriasN1 = $SubcategoriasN1Controller->get();
  if ($ResultSubcategoriasN1->count > 0) {
    $SubcategoriaN1Key = $ResultSubcategoriasN1->records[0]->CategoriasKey;
    foreach ($ResultSubcategoriasN1->records as $key => $SubcategoriaN1) {


    ?>
      <a class="list-group-item item-product" href="../Productos/configurables.php?codigo=<?php echo urlencode($SubcategoriaN1->Codigo); ?>">
        <?php echo "<span style='color:#BF202F;'>Configúralo -></span> " . $SubcategoriaN1->Descripcion; ?>
      </a>
  <?php
    }
  }


  unset($SubcategoriasN1Controller);
  unset($ResultSubcategoriasN1);
  unset($SubcategoriaN1);
} else { ?>
  <a class="list-group-item item-product" href="#">
    No se envian datos, si el problema persiste por favor pide ayuda a tu ejecutivo
  </a>
<?php } ?>