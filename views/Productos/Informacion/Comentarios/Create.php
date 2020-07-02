  <input type="hidden" id="Action" name="Action" value="create">
  <input type="hidden" id="ActionComentarios" name="ActionComentarios" value="true">
  <div class="row">
    <div class="col-sm-12">
      <div class="form-group">
        <label for="review-subject">Titulo</label>
        <input class="form-control form-control-sm" type="text" id="Titulo" name="Titulo">
      </div>
    </div>
    <div class="col-sm-12">
      <div class="form-group">
        <label for="review-rating">Estrellas</label>
        <select class="form-control form-control-sm" id="Estrellas" name="Estrellas">
          <option value="5">5</option>
          <option value="4">4</option>
          <option value="3">3</option>
          <option value="2">2</option>
          <option value="1">1</option>
        </select>
      </div>
    </div>
    <div class="form-group col-sm-12">
      <label for="review-message">Descripción</label>
      <textarea class="form-control form-control-sm" id="Descripcion" name="Descripcion" rows="5"></textarea>
    </div>
  </div>
<button type="button" class="btn btn-warning btn-sm btn-block" onclick="createReview()">Guardar</button>
