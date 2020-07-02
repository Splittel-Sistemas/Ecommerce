  <div class="row align-items-end pb-4">
    <div class="col-sm-4" id="PolaridadSelect">
      <div class="form-group mb-0">
        <label for="quantity">Polaridad</label>
        <select class="form-control" id="Polaridad" name="Polaridad" onchange="JumpersFibraOptica()">
          <option value="A">Tipo A</option>
          <option value="B">Tipo B</option>
        </select>
      </div>
    </div>
    <div class="col-sm-4" id="CantidadFibrasSelect">
      <div class="form-group mb-0">
        <label for="quantity">Cantidad de fibras</label>
        <select class="form-control" id="CantidadFibras" name="CantidadFibras" onchange="JumpersFibraOptica()">
          <option value="08">8 fibras</option>
          <option value="12">12 fibras</option>
        </select>
      </div>
    </div>
    <div class="col-sm-4" id="DisenoSelect">
      <div class="form-group mb-0">
        <label for="quantity">Diseño</label>
        <select class="form-control" id="Diseno" name="Diseno" onchange="JumpersFibraOptica()">
          <option value="H">Hembra-Hembra</option>
          <option value="M">Macho-Macho</option>
          <option value="C">Hembra-Macho</option>
        </select>
      </div>
    </div>
    <div class="col-sm-4" id="TipoFibraSelect">
      <div class="form-group mb-0">
        <label for="quantity">Tipo de fibra</label>
        <select class="form-control" id="TipoFibra" name="TipoFibra" onchange="JumpersFibraOptica()">
          <option value="55">OM3</option>
          <option value="57">OM4</option>
        </select>
      </div>
    </div>
    <div class="col-sm-4" id="LongitudInput">
      <div class="form-group mb-0">
        <label for="quantity">Longitud (m) 1~100:</label>
        <input type="text" class="form-control" id="Longitud" name="Longitud" value="1" onkeyup="JumpersFibraOptica()">
      </div>
    </div> 
    <div class="col-sm-4" id="TipoCubiertaSelect">
      <div class="form-group mb-0">
        <label for="quantity">Tipo Cubierta</label>
        <select class="form-control" id="TipoCubierta" name="TipoCubierta" onchange="JumpersFibraOptica()">
          <option value="RI">Riser</option>
          <option value="PL">Plenum</option>
          <option value="ZH">Cero Halógeno</option>
        </select>
      </div>
    </div>
  </div>