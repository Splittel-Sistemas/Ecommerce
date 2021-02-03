<div class="row align-items-end pb-4" id="">
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de Fibra</label>
      <select class="form-control" id="TipoFibra" name="TipoFibra" onchange="CableExterior()">
        <option value="09">Monomodo G.652.D</option>
        <option value="62">OM1 62.5/125</option>
        <option value="50">OM2 50/125</option>
        <option value="55">OM3 50/125 10G</option>
        <option value="57">OM4 50/125 40G</option>
      </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Número de fibras</label>
      <select class="form-control" id="NumeroFibras" name="NumeroFibras" onchange="CableExterior()">
          <option value="06">6 Fibras</option>
            <option value="12">12 Fibras</option>
      </select>
    </div>
  </div>
  <div class="col-sm-4" id="SelectMaterialCubierta">
    <div class="form-group mb-0">
      <label for="quantity">Material de cubierta</label>
      <select class="form-control" id="MaterialCubierta" name="MaterialCubierta" onchange="CableExterior()">
        <option value="B">MDPE</option>
        <option value="C">LSZH</option>
      </select>
    </div>
  </div>
</div>