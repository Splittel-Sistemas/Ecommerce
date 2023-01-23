 <div class="row align-items-end pb-4">
    <div class="col-sm-4" id="TipoFibraSelect">
      <div class="form-group mb-0">
        <label for="quantity">Tipo de Fibra</label>
        <select class="form-control" id="TipoFibra" name="TipoFibra" onchange="Pigtails()">
          <option value="09">Monomodo</option>
          <option value="62">Multimodo OM1</option>
          <option value="50">Multimodo OM2</option>
          <option value="55">Multimodo OM3</option>
          <option value="57">Multimodo OM4</option>
        </select>
      </div>
    </div> 
    <div class="col-sm-4" id="NumeroHilosSelect">
      <div class="form-group mb-0">
        <label for="quantity">Numero de hilos</label>
        <select class="form-control" id="NumeroHilos" name="NumeroHilos" onchange="Pigtails()">
        <option value="">Simplex</option>
        <option value="S06">Set de 6 colores</option>
        <option value="S12">Set de 12 colores</option>
        </select>
      </div>
    </div> 
    <div class="col-sm-4" id="LongitudInput">
      <div class="form-group mb-0">
        <label id="LongitudIdText"></label>
        <input type="text" class="form-control" id="Longitud" name="Longitud" value="1" onkeyup="Pigtails()">
      </div>
    </div> 
    <div class="col-sm-4" id="TipoPulidoSelect">
      <div class="form-group mb-0">
        <label for="quantity">Tipo Pulido</label>
        <select class="form-control" id="TipoPulido" name="TipoPulido" onchange="Pigtails()">
          <option value="U">UPC</option>
          <option value="A">APC</option>
          <option value="P">PC</option>
        </select>
      </div>
    </div> 
    <div class="col-sm-4" id="DiametroSelect">
      <div class="form-group mb-0">
        <label for="quantity">Diámetro</label>
        <select class="form-control" id="Diametro" name="Diametro" onchange="Pigtails()">
          <option value="9">900μm</option>
          <option value="2">2mm</option>
        </select>
      </div>
    </div> 
  </div>