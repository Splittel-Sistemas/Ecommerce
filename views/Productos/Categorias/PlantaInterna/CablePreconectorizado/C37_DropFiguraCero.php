<div class="row align-items-end pb-4" id="">
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de terminacion</label>
        <select class="form-control" id="TipoTerminacion" name="TipoTerminacion" onchange="interior_exterior_cable()">
            <option selected value="3MM">3 mm</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de cubierta</label>
        <select class="form-control" id="TipoCubierta" name="TipoCubierta" onmouseup="interior_exterior_cable()" onchange="interior_exterior_cable()">
            <option selected value="T">LSZH (TPU)</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de fibra</label>
        <select class="form-control" id="TipoFibra" name="TipoFibra" onmouseup="interior_exterior_cable()" onchange="interior_exterior_cable()">
            <option selected value="39">Monomodo G.657.B3</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Conector lado A</label>
        <select id="conec_lad_a" onchange="interior_exterior_cable()" class="form-control">
            <option value="BG" data-conector="SCU">SCU 3mm Simplex</option>
            <option value="BH" data-conector="SCA">SCA 3mm Simplex</option>
            <option value="BL" data-conector="LCU">LCU 3mm Simplex</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Conector lado B</label>
        <select id="conec_lad_b" onchange="interior_exterior_cable()" class="form-control">
            <option value="">Sin conector</option>
            <option value="BG" data-conector="SCU">SCU 3mm Simplex</option>
            <option value="BH" data-conector="SCA">SCA 3mm Simplex</option>
            <option value="BL" data-conector="LCU">LCU 3mm Simplex</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Número de hilos<span id="NoHilos_label">1-12</span></label>
        <input readonly="readonly" value ="1" maxlength="2" class="form-control" type="text" value="" id="NoHilos" name="" oninput="interior_exterior_cable()">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Longitud <span id="Longitud_label">1-999 (m)</span></label>
        <input class="form-control" maxlength="3" type="text" value="1" id="Longitud" name="" oninput="interior_exterior_cable()">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Adicionales</label>
        <select id="Adicionales" onchange="interior_exterior_cable()" class="form-control">
            <option value="">Sin malla</option>
            <option value="MA">Con Malla</option>
        </select>
    </div>
  </div>
</div>