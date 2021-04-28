 <div class="row align-items-end pb-4">
    <div class="col-sm-4" id="ColorSelect">
      <div class="form-group mb-0">
        <label for="quantity">Color</label>
        <select class="form-control" id="Color" name="Color" onchange="Categoria6A()">
          <?php if ($_GET['codigo'] == "C77"): ?>
            <option value="ME">Metálico</option>
          <?php else: ?>
            <option value="AZ">Azul</option>
            <option value="RO">Rojo</option>
            <option value="VE">Verde</option>
            <option value="BL">Blanco</option>
            <option value="GR">Gris</option>
            <?php if ($_GET['codigo'] == "C97"): ?>
            <option value="AM">Amarillo</option>
            <option value="NE">Negro</option>
          <?php endif ?>
          <?php endif ?>
        </select>
      </div>
    </div> 
    <?php if($_GET['codigo'] == "C97"){ ?>
    <div class="col-sm-4" id="LongitudInput">
      <div class="form-group mb-0">
        <label id="LongitudIdText">Longitud (pies)</label>
        <input oninput="this.value=this.value.replace(/[^0-9]/g,'');" type="text" class="form-control" id="Longitud" name="Longitud" value="1" onkeyup="Categoria6A()">
      </div>
    </div>
    <?php }else if($_GET['codigo'] == "C70"){ ?>
    <div class="col-sm-4" id="LongitudSelect">
      <div class="form-group mb-0">
        <label id="Longitud_1IdText">Longitud (pies)</label>
        <select class="form-control" id="Longitud_1" name="Longitud_1" onchange="Categoria6A()">
            <option value="03">3</option>
            <option value="07">7</option>
            <option value="10">10</option>
            <option value="15">15</option>
        </select>
      </div>
    </div> 
    <?php }else{ ?>
    <div class="col-sm-4" id="LongitudSelect">
      <div class="form-group mb-0">
        <label id="Longitud_1IdText">Tipo</label>
        <select class="form-control" id="Longitud_1" name="Longitud_1" onchange="Categoria6A()">
            <option value="0010">1m</option>
            <option value="0020">2m</option>
            <option value="0030">3m</option>
            <option value="0040">4m</option>
            <option value="0050">5m</option>
        </select>
      </div>
    </div> 
    <div class="col-sm-4" id="LongitudInput">
      <div class="form-group mb-0">
        <label id="LongitudIdText"></label>
        <input type="text" class="form-control" id="Longitud" name="Longitud" value="1" onkeyup="Categoria6A()">
      </div>
    </div> 
    <?php } ?>
  </div>