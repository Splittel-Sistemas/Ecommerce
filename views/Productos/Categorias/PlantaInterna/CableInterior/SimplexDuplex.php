<div class="row align-items-end pb-4" id="">
  <div class="col-sm-6">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de Fibra</label>
      <select class="form-control" id="TipoFibra" name="TipoFibra" onchange="CableInterior()">
        <option value="29">Monomodo</option>
        <option value="62">Multimodo OM1</option>
        <option value="50">Multimodo OM2</option>
        <option value="55">Multimodo OM3</option>
        <option value="57">Multimodo OM4</option>
      </select>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group mb-0">
      <label for="quantity">Hilos</label>
      <select class="form-control" id="NumeroHilos" name="NumeroHilos" onchange="CableInterior()">
        <option value="S">Simplex</option>
        <option value="D">Duplex</option>
      </select>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group mb-0">
      <label for="quantity">Diámetro</label>
      <select class="form-control" id="DiametroCable" name="DiametroCable" onchange="CableInterior()">
        <option value="2">2MM</option>
        <option value="1">1.6MM</option>
        <option value="3">3MM</option>
      </select>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group mb-0">
      <label for="quantity">Tipo cubierta</label>
      <select class="form-control" id="TipoCubierta" name="TipoCubierta" onchange="CableInterior()">
        <option value="RB">Riser Bend Radius</option>
        <option value="PB">Plenum Bend Radius</option>
        <option value="HB">Cero Halógeno Bend Radius</option>
        <option value="R">Riser Estándar</option>
        <option value="P">Plenum Estándar</option>
      </select>
    </div>
  </div>
</div>