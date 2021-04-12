 <div class="row align-items-end pb-4">
    <div class="col-sm-4" id="ColorSelect">
      <div class="form-group mb-0">
        <label for="quantity">Color</label>
        <select class="form-control" id="Color" name="Color" onchange="Categoria6()">
          <option value="AZ">Azul</option>
          <option value="RO">Rojo</option>
          <option value="VE">Verde</option>
          <option value="BL">Blanco</option>
          <option value="GR">Gris</option>
          <option value="NE">Negro</option>
        </select>
      </div>
    </div> 
    <div class="col-sm-4" id="LongitudInput">
      <div class="form-group mb-0">
        <label id="LongitudIdText"></label>
        <input type="text" maxlength="3" class="form-control" id="Longitud" name="Longitud" value="1" onkeyup="Categoria6()">
      </div>
    </div> 
  </div>