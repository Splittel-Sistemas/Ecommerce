<div class="row align-items-end pb-4" id="">  
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Número de hilos</label>
      <select class="form-control" id="NumeroHilos" name="NumeroHilos" onchange="InteriorExterior()">
        <option value="01">01</option>
        <!-- <option value="02">02</option> -->
      </select>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de Fibra</label>
      <select class="form-control" id="TipoFibra" name="TipoFibra" onchange="InteriorExterior()">
        <option value="29">Monomodo G657A2</option>
        <option value="39">Monomodo G657B3</option>
      </select>
    </div>
  </div>
</div>

<!-- <input type="hidden" name="TipoFibra" id="TipoFibra" value="39">-->
<!-- <p>Tipo de fibra: <span>Monomodo G657B3</span></p>
<p>Tipo de cubierta: <span>LSZH</span></p> -->