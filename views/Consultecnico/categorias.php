<?php
  if (!class_exists("CategoriaController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Categorias/Categoria.Controller.php';
  }
  $CategoriaController = new CategoriaController();
  $CategoriaController->filter = " WHERE id_codigo <> 'A8'";
  $CategoriaController->order = "";
  $ResultCategorias = $CategoriaController->ListarCategoriasConsultecnico();
  foreach ($ResultCategorias->records as $key => $Obj) {
    $total = count($Obj->Pregunta) > 0 ? $Obj->Pregunta[0]->Total : 0;
?>
  <li><a href="index.php?Categoria=<?php echo $Obj->CodigoKey ?>"><?php echo $Obj->Descripcion ?></a><span>(<?php echo $total  ?>)</span></li>
<?php } ?>  