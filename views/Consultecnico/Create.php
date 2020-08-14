<form>
  <div class="row">
    <div class="col-sm-12 col-md-6 form-group">
      <label>Nombre <strong class="text-danger">*</strong></label>
      <input class="form-control" type="text" id="Nombre" name="Nombre">
    </div>
    <div class="col-sm-12 col-md-6 form-group">
      <label>Correo <strong class="text-danger">*</strong></label>
      <input class="form-control" type="text" id="Correo" name="Correo">
    </div>
    <div class="col-sm-12 col-md-6 form-group">
      <label>Titulo <strong class="text-danger">*</strong></label>
      <input class="form-control" type="text" id="Titulo" name="Titulo">
    </div>
    <div class="col-sm-12 col-md-6 form-group">
      <label>Categoría <strong class="text-danger">*</strong></label>
      <select class="form-control" name="Categoria" id="Categoria">
        <option value="f">f</option>
      </select>
    </div>
    <div class="col-sm-12 form-group">
      <label>Pregunta <strong class="text-danger">*</strong></label>
      <textarea class="form-control" name="Pregunta" id="Pregunta" cols="30" rows="8"></textarea>
    </div>
  </div>
  <button type="button" class="btn btn-primary float-right" onclick="EnviarPregunta()">Enviar Pregunta</button>
</form>

<form>
  <div class="row">
    <div class="col-sm-12 form-group">
      <label>Mensaje <strong class="text-danger">*</strong></label>
      <textarea class="form-control" name="Mensaje" id="Mensaje" cols="30" rows="8"></textarea>
    </div>
  </div>
  <button type="button" class="btn btn-primary float-right" onclick="EnviarMensaje()">Enviar Mensaje</button>
</form>