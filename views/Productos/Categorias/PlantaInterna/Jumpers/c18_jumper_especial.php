<div class="row align-items-end pb-4">

<div class="col-sm-4" id="MultimodoTipoFibraSelect">
      <div class="form-group mb-0">
        <label for="quantity">Tipo de Fibra</label>
        <select class="form-control" id="MultimodoTipoFibra" name="MultimodoTipoFibra" onchange="JumpersFibraOptica()">
            <option value="9">Monomodo</option>
            <option value="1">Multimodo OM1</option>
            <option value="2">Multimodo OM2</option>
            <option value="3">Multimodo OM3</option>
            <option value="4">Multimodo OM4</option>
        </select>
      </div>
    </div> 

    <div class="col-sm-4" id="TipoCubiertaSelect">
      <div class="form-group mb-0">
        <label for="quantity">Tipo Cubierta</label>
        <select class="form-control" id="TipoCubierta" name="TipoCubierta" onchange="JumpersFibraOptica()">
          <option value="R">Riser</option>
          <option value="P">Plenum</option>
          <option value="Z">Cero Halógeno</option>
        </select>
      </div>
    </div> 

    <div class="col-sm-4" id="NumeroHilosSelect">
      <div class="form-group mb-0">
        <label for="quantity">Número de hilos</label>
        <select class="form-control" id="NumeroHilos" name="NumeroHilos" onchange="JumpersFibraOptica()">
          <option value="S">Simplex</option>
          <option value="D">Duplex</option>
        </select>
      </div>
    </div> 
    
    <div class="col-sm-4" id="Conector1Select">
      <div class="form-group mb-0">
        <label for="quantity">Conector #1</label>
        <select class="form-control" id="Conector1" name="Conector1" onchange="JumpersFibraOptica()">
         <option value="LC" position="0">LC</option>
          <option value="SC" position="1">SC</option>
        </select>
      </div>
    </div>
    <div class="col-sm-4" id="Pulido1Select">
      <div class="form-group mb-0">
        <label for="quantity">Pulido #1</label>
        <select class="form-control" id="Pulido1" name="Pulido1" onchange="JumpersFibraOptica()">
         <option value="U" position="0">UPC</option>
          <option value="A" position="1">APC</option>
          <option value="P" position="2">PC</option>
        </select>
      </div>
    </div>
    <div class="col-sm-4" id="Bota1Select">
      <div class="form-group mb-0">
        <label for="quantity">Bota #1</label>
        <select class="form-control" id="Bota1" name="Bota1" onchange="JumpersFibraOptica()">
         <option value="M" position="0">Mini Flexible</option>
          <option value="R" position="1">Flexible con Refuerzo</option>
        </select>
      </div>
    </div>

    <div class="col-sm-4" id="Conector2Select">
      <div class="form-group mb-0">
        <label for="quantity">Conector #2</label>
        <select class="form-control" id="Conector2" name="Conector2" onchange="JumpersFibraOptica()">
         <option value="LC" position="0">LC</option>
          <option value="SC" position="1">SC</option>
          <option value="ST" position="2">ST</option>
          <option value="FC" position="3">FC</option>
        </select>
      </div>
    </div>
    <div class="col-sm-4" id="Pulido2Select">
      <div class="form-group mb-0">
        <label for="quantity">Pulido #2</label>
        <select class="form-control" id="Pulido2" name="Pulido2" onchange="JumpersFibraOptica()">
         <option value="U" position="0">UPC</option>
          <option value="A" position="1">APC</option>
          <option value="P" position="2">PC</option>
        </select>
      </div>
    </div>
    <div class="col-sm-4" id="Bota2Select">
      <div class="form-group mb-0">
        <label for="quantity">Bota #2</label>
        <select class="form-control" id="Bota2" name="Bota2" onchange="JumpersFibraOptica()">
         <option value="M" position="0">Mini Flexible</option>
          <option value="R" position="1">Flexible con Refuerzo</option>
          <option value="" position="2">Bota Estándar</option>
        </select>
      </div>
    </div>

    

    <div class="col-sm-4" id="DiametroSelect">
      <div class="form-group mb-0">
        <label for="quantity">Diámetro de cable</label>
        <select class="form-control" id="Diametro" name="Diametro" onchange="JumpersFibraOptica()">
          <option value="1">1.6 mm</option>
          <option value="2" selected>2 mm</option>
        </select>
      </div>
    </div> 
    <div class="col-sm-4" id="LongitudInput">
      <div class="form-group mb-0">
        <label for="quantity">Longitud (m) 0.1~999:</label>
        <input type="text" class="form-control"  maxlength="5" id="Longitud" name="Longitud" value="1" oninput="JumpersFibraOptica()">
      </div>
    </div> 

</div>