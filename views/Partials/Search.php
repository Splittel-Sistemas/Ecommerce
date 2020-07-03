<?php 
  if (isset($_POST["Descripcion"])){
  if (!class_exists("ProductoController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Producto.Controller.php';
  }
  if (!class_exists("SubcategoriasController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Subcategorias/Subcategorias.Controller.php';
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
  <a class="list-group-item item-product" href="../Productos/fijos.php?id_prd=<?php echo $Obj->ProductoCodigo; ?>">
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
