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


  //BUSCADOR DE PRODUCTOS FIJOS
  $ProductoController = new ProductoController();
  $ProductoController->filter = "WHERE ((desc_producto LIKE '%" . $_POST["Descripcion"] . "%'   $like   OR codigo LIKE '%" . $_POST["Descripcion"] . "%'  $like2) AND producto_activo = 'si' AND subcategoria_activo='si') AND existencia > 0 ";
  $ProductoController->order = " ";
  $ResultProducto_ = $ProductoController->GetProductosFijos_();

?>
 
<?php  

function highlightWords($query, $word){
  $texto_resaltado = preg_replace('/(' . preg_quote($query, '/') . ')/i', '<span style="background-color: yellow;">$1</span>', $word);
    return $texto_resaltado;
}

foreach ($ResultProducto_->records as $key => $Obj) {
  
  $contenido_resaltado = highlightWords($_POST["Descripcion"], $Obj->ProductoDescripcion);
  $contenido_resaltado_ = highlightWords($_POST["Descripcion"], $Obj->ProductoCodigo);

    if ($Obj->ProductoCodigoConfigurable != '' && $Obj->ConfigurableFijo == 'no') { ?>
      <a class="list-group-item item-product item-font" href="../Productos/configurables.php?codigo=<?php echo urlencode($Obj->ProductoCodigoConfigurable); ?>">
      
      <?php echo $contenido_resaltado_; ?> - <?php echo $contenido_resaltado; ?>
      </a>
    <?php } else { ?>
      <a class="list-group-item item-product item-font" href="../Productos/fijos.php?id_prd=<?php echo urlencode($Obj->ProductoCodigo); ?>&nom=<?php echo url_amigable($Obj->ProductoDescripcion); ?>">
        <?php echo $contenido_resaltado_; ?> - <?php echo $contenido_resaltado; ?>
      </a>

    <?php
    }
  }
  unset($ProductoController);
  unset($ResultProducto_);
  unset($Obj);




  
} else { ?>
  <a class="list-group-item item-product" href="#">
    No se envian datos, si el problema persiste por favor pide ayuda a tu ejecutivo
  </a>
<?php } ?>