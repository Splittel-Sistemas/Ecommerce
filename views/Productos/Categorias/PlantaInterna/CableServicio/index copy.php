<div class="row align-items-end pb-4" id="">
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Número de hilos</label>
      <select class="form-control" id="NumeroHilos" name="NumeroHilos" onchange="CableServicio()">
        <option value="04">4 hilos</option>
        <option value="06">6 hilos</option>
        <option value="08">8 hilos</option>
        <!-- <option value="12">12 hilos</option> -->
      </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Longitud (m) 3~99</label>
      <input type="text" class="form-control" name="Longitud" id="Longitud" value="3" onkeyup="CableServicio()">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Diámetro</label>
      <select class="form-control" id="Diametro" name="Diametro" onchange="CableServicio()">
        <option value="20">2mm</option>
        <option value="90">900um</option>
      </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Conector</label>
      <select class="form-control" id="Conector" name="Conector" onchange="CableServicio()">
        <option value="">SC/APC</option>
      </select>
    </div>
  </div>
</div>