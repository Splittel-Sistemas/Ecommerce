<div class="row align-items-end pb-4" id="">
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de Fibra</label>
      <select class="form-control" id="TipoFibra" name="TipoFibra" onchange="CableInterior()">
        <option value="09">Monomodo</option>
        <option value="62">Multimodo OM1</option>
        <option value="50">Multimodo OM2</option>
        <option value="55">Multimodo OM3</option>
        <option value="57">Multimodo OM4</option>
      </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de cubierta</label>
      <select class="form-control" id="TipoCubierta" name="TipoCubierta" onchange="CableInterior()">
        <option value="R">Riser</option>
        <option value="P">Plenum</option>
        <option value="H">LSZH</option>
      </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Número de hilos</label>
      <select class="form-control" id="NumeroHilos" name="NumeroHilos" onchange="CableInterior()">
        <option value="06">06</option>
        <option value="12">12</option>
        <option value="24">24</option>
        <option value="36">36</option>
        <option value="48">48</option>
        <option value="72">72</option>
      </select>
    </div>
  </div>
</div>