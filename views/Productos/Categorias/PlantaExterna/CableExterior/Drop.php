<div class="row align-items-end pb-4" id="">
  <div class="col-sm-6">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de Fibra</label>
      <select class="form-control" id="TipoFibra" name="TipoFibra" onchange="CableExterior()">
        <option value="09">Monomodo G657A1</option>
        <option value="29">Monomodo G657A2</option>
      </select>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group mb-0">
      <label for="quantity">Número de fibras</label>
      <select class="form-control" id="NumeroFibras" name="NumeroFibras" onchange="CableExterior()">
        <option value="01">1 Fibra</option>
        <option value="02">2 Fibras</option>
        <option value="12">12 Fibras</option>
        <option value="24">24 Fibras</option>
      </select>
    </div>
  </div>
</div>
<input type="hidden" name="NumeroHilosTotal" id="NumeroHilosTotal" value="12">

<!-- <p>Numero de Hilos: <span id="NumeroHilosTotalText">12</span></p>
 -->