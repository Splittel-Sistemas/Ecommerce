<div class="row no-gutters">
  <div class="col-md-12" id="notify" data-offset-top="-1">
    <div class=" py-5 px-3 justify-content-center align-items-center">
      <form class="row">
        <div class="col-sm-12 col-md-6 form-group">
          <label>Nombre <strong class="text-danger">*</strong></label>
          <input class="form-control" type="text" id="Nombre" name="Nombre">
        </div>
        <div class="col-sm-12 col-md-6 form-group">
          <label>Correo <strong class="text-danger">*</strong></label>
          <input class="form-control" type="text" id="Correo" name="Correo">
        </div>
        <div class="col-sm-12 col-md-6 form-group">
          <label>Categoría <strong class="text-danger">*</strong></label>
          <select class="form-control" name="Categoria" id="Categoria">
            <?php 
              $CategoriaController = new CategoriaController();
              $CategoriaController->filter = "WHERE id_codigo <> 'A8' ";
              $CategoriaController->order = "";
              $response = $CategoriaController->get();

                foreach ($response->records as $CategoriaCont => $Categoria){
                  $selected = $category == $Categoria->CodigoKey ? 'selected': '';
                  
            ?>
            <option value="<?php echo $Categoria->CodigoKey;?>" <?php echo $selected;?>><?php echo $Categoria->Descripcion?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-sm-12 col-md-6 form-group">
          <label>Título de la pregunta <strong class="text-danger">*</strong></label>
          <input class="form-control" type="text" id="Titulo" name="Titulo">
        </div>
        <div class="col-sm-12 form-group">
          <label>Detalle de la pregunta <strong class="text-danger">*</strong></label>
          <textarea class="form-control" name="Pregunta" id="Pregunta" rows="8"></textarea>
        </div>
        <div class="col-sm-12">
          <button type="button" class="btn btn-primary float-right" onclick="EnviarPregunta()">Enviar Pregunta</button>
        </div>
      </form>
    </div>
  </div>
</div>