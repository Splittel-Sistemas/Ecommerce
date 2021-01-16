<div class="row align-items-end pb-4">
  <!-- Conector Lado A -->
  <div class="col-sm-4" id="ConectorLadoASelect">
    <div class="form-group mb-0">
      <label for="quantity">Conector Lado A</label>
      <select class="form-control" id="ConectorLadoA" name="ConectorLadoA" onchange="JumpersMTPUS()">
        <option value="A5">MTP PRO</option>
      </select>
    </div>
  </div>
  <!-- Conector Lado B -->
  <div class="col-sm-4" id="ConectorLadoBSelect">
    <div class="form-group mb-0">
      <label for="quantity">Conector Lado B</label>
      <select class="form-control" id="ConectorLadoB" name="ConectorLadoB" onchange="JumpersMTPUS()">
        <option value="AE">LCP dúplex 2mm</option>
      </select>
    </div>
  </div>
  <!-- Polaridad -->
  <div class="col-sm-4" id="PolaridadSelect">
    <div class="form-group mb-0">
      <label for="quantity">Polaridad</label>
      <select class="form-control" id="Polaridad" name="Polaridad" onchange="JumpersMTPUS()">
        <option value="A">Tipo A</option>
        <option value="B">Tipo B</option>
      </select>
    </div>
  </div>
  <!-- Cantidad de fibras -->
  <div class="col-sm-4" id="CantidadFibrasSelect">
    <div class="form-group mb-0">
      <label for="quantity">Cantidad de fibras</label>
      <select class="form-control" id="CantidadFibras" name="CantidadFibras" onchange="JumpersMTPUS()">
        <option value="08" NumeroHilos="8">8 fibras</option>
        <option value="12" NumeroHilos="12">12 fibras</option>
      </select>
    </div>
  </div>
  <!-- Diseño MPO -->
  <div class="col-sm-4" id="DisenoSelect">
    <div class="form-group mb-0">
      <label for="quantity">Género MTP Pro</label>
      <select class="form-control" id="Diseno" name="Diseno" onchange="JumpersMTPUS()">
        <option value="M">Macho</option>
      </select>
    </div>
  </div>
  <!-- Tipo de fibra -->
  <div class="col-sm-4" id="TipoFibraSelect">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de fibra</label>
      <select class="form-control" id="TipoFibra" name="TipoFibra" onchange="JumpersMTPUS()">
        <option value="55">OM3</option>
        <option value="57">OM4</option>
      </select>
    </div>
  </div>
  <!-- Longitud (m) 1~100: -->
  <div class="col-sm-4" id="LongitudInput">
    <div class="form-group mb-0">
      <label for="quantity">Longitud (m) 1~999:</label>
      <input type="text" class="form-control" id="Longitud" name="Longitud" value="1" onkeyup="JumpersMTPUS()">
    </div>
  </div> 
  <!-- Tipo Cubierta -->
  <div class="col-sm-4" id="TipoCubiertaSelect">
    <div class="form-group mb-0">
      <label for="quantity">Tipo Cubierta</label>
      <select class="form-control" id="TipoCubierta" name="TipoCubierta" onchange="JumpersMTPUS()">
        <option value="PL">Plenum</option>
        <option value="ZH">Cero Halógeno</option>
      </select>
    </div>
  </div>
  <!-- Longitud Break Out -->
  <div class="col-sm-4" id="LongitudBreakOutSelect">
    <div class="form-group mb-0">
      <label for="quantity">Longitud Break Out</label>
      <select class="form-control" id="LongitudBreakOut" name="LongitudBreakOut" onchange="JumpersMTPUS()">
        <option value="">Longitud estándar 75cm</option>
        <option value="W">Longitud 50cm</option>
        <option value="V">Longitud 40cm</option>
        <option value="Y">Longitud 35cm</option>
      </select>
    </div>
  </div>
</div>