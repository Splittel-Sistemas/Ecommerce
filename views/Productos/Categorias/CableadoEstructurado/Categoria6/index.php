 <div class="row align-items-end pb-4">
    <div class="col-sm-4" id="ColorSelect">
      <div class="form-group mb-0">
        <label for="quantity">Color</label>
        <select class="form-control" id="Color" name="Color" onchange="Categoria6()">
        <?php if ($_GET['codigo'] == "C101"): ?>
            <option value="ME">Metálico</option>
          <?php else: ?>
          <option value="AZ">Azul</option>
          <option value="RO">Rojo</option>
          <option value="VE">Verde</option>
          <option value="BL">Blanco</option>
          <option value="GR">Gris</option>
          <option value="NE">Negro</option>
          <?php endif ?>
        </select>
      </div>
    </div> 
    <?php if ($_GET['codigo'] == "C101" || $_GET['codigo'] == "C102"): ?>
      <div class="col-sm-4" id="LongitudInput_1">
      <div class="form-group mb-0">
        <label id="Longitud_1IdText">Longitud (metros)</label>
        <select class="form-control" id="Longitud_1" name="Longitud_1" onchange="Categoria6()">
            <option value="1">1</option>
            <option value="2">2</option>
            <?php if ( $_GET['codigo'] == "C102" ): ?>
              <option value="3">3</option>
              <option value="5">5</option>
              <?php endif ?>
        </select>
      </div>
    </div> 
    <?php else: ?>
    <div class="col-sm-4" id="LongitudInput">
      <div class="form-group mb-0">
        <label id="LongitudIdText"></label>
        <input type="text" maxlength="3" class="form-control" id="Longitud" name="Longitud" value="1" onkeyup="Categoria6()">
      </div>
    </div> 
    <?php endif ?>
  </div>