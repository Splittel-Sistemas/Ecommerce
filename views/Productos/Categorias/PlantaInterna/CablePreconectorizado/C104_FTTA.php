<div class="row align-items-end pb-4" id="">
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de terminacion</label>
        <select class="form-control" id="TipoTerminacion" name="TipoTerminacion" onchange="interior_exterior_cable()">
            <option selected value="2MM">2 mm</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de cubierta</label>
        <select class="form-control" id="TipoCubierta" name="TipoCubierta" onmouseup="interior_exterior_cable()" onchange="interior_exterior_cable()">
            <option selected value="Z">LSZH</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de fibra</label>
        <select class="form-control" id="TipoFibra" name="TipoFibra" onmouseup="interior_exterior_cable()" onchange="interior_exterior_cable()">
            <option selected value="29">Monomodo G657A2</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Conector lado A</label>
        <select id="conec_lad_a" onchange="interior_exterior_cable()" class="form-control">
            <option value="AB" data-conector="LCU">LCU 2mm Dúplex</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Conector lado B</label>
        <select id="conec_lad_b" onchange="interior_exterior_cable()" class="form-control">
            <option value="AB" data-conector="LCU">LCU 2mm Dúplex</option>
            <option value="BO" data-conector="SCA">SCA 2mm Dúplex</option>
            <option value="AC" data-conector="SCU">SCU 2mm Dúplex</option>
            <option value="AD" data-conector="FCU">FCU 2mm Dúplex</option>
            <option value="AI" data-conector="STU">STU 2mm Dúplex</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Número de hilos<span id="NoHilos_label">2</span></label>
        <input readonly="readonly" value ="2" maxlength="2" class="form-control" type="text" value="" id="NoHilos" name="" oninput="interior_exterior_cable()">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Longitud <span id="Longitud_label">3-999 (m)</span></label>
        <input class="form-control" maxlength="3" type="text" value="3" id="Longitud" name="" oninput="interior_exterior_cable()">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Adicionales</label>
        <select id="Adicionales" onchange="interior_exterior_cable()" class="form-control">
            <option value="">Terminaciones 0.03 / 0.34 m</option>
        </select>
    </div>
  </div>
</div>