<div class="row align-items-end pb-4">

    <div class="col-sm-4" id="MultimodoTipoFibraSelect">
        <div class="form-group mb-0">
            <label for="quantity">Tipo de Fibra</label>
            <select class="form-control" id="MultimodoTipoFibra" name="MultimodoTipoFibra" onchange="JumpersFibraOptica()">
                <option value="9">Monomodo G657A2</option>
            </select>
        </div>
    </div>

    <div class="col-sm-4" id="TipoCubiertaSelect">
        <div class="form-group mb-0">
            <label for="quantity">Tipo Cubierta</label>
            <select class="form-control" id="TipoCubierta" name="TipoCubierta" onchange="JumpersFibraOptica()">
                <option value="R">Riser</option>
            </select>
        </div>
    </div>

    <div class="col-sm-4" id="NumeroHilosSelect">
        <div class="form-group mb-0">
            <label for="quantity">Número de hilos</label>
            <select class="form-control" id="NumeroHilos" name="NumeroHilos" onchange="JumpersFibraOptica()">
                <option value="D">Duplex</option>
            </select>
        </div>
    </div>

    <div class="col-sm-4" id="Conector1Select">
        <div class="form-group mb-0">
            <label for="quantity">Conector #1</label>
            <select class="form-control" id="Conector1" name="Conector1" onchange="JumpersFibraOptica()">
                <option value="CS" position="8">CS</option>
            </select>
        </div>
    </div>
    <div class="col-sm-4" id="Pulido1Select">
        <div class="form-group mb-0">
            <label for="quantity">Pulido #1</label>
            <select class="form-control" id="Pulido1" name="Pulido1" onchange="JumpersFibraOptica()">
                <option value="U" position="0">UPC</option>
            </select>
        </div>
    </div>
    <div class="col-sm-4" id="Bota1Select">
        <div class="form-group mb-0">
            <label for="quantity">Bota #1</label>
            <select class="form-control" id="Bota1" name="Bota1" onchange="JumpersFibraOptica()">
                <option value="C">Bota Corta</option>
            </select>
        </div>
    </div>

    <div class="col-sm-4" id="Conector2Select">
        <div class="form-group mb-0">
            <label for="quantity">Conector #2</label>
            <select class="form-control" id="Conector2" name="Conector2" onchange="ActualizarBota2()">
                <option value="CS" position="8">CS</option>
                <option value="SN" position="7">SN</option>
                <option value="LU" DescConector="LC" position="0">LC Uniboot</option>
            </select>
        </div>
    </div>
    <div class="col-sm-4" id="Pulido2Select">
        <div class="form-group mb-0">
            <label for="quantity">Pulido #2</label>
            <select class="form-control" id="Pulido2" name="Pulido2" onchange="JumpersFibraOptica()">
                <option value="U" position="0">UPC</option>
            </select>
        </div>
    </div>
    <div class="col-sm-4" id="Bota2Select">
        <div class="form-group mb-0">
            <label for="quantity">Bota #2</label>
            <select class="form-control" id="Bota2" name="Bota2" onchange="ActualizarConector2()">
                <option value="C">Bota Corta</option>
                <option value="">Bota Estándar</option>
                <option value="M">Mini Flexible</option>
            </select>
        </div>
    </div>

    <div class="col-sm-4" id="DiametroSelect">
        <div class="form-group mb-0">
            <label for="quantity">Diámetro de cable</label>
            <select class="form-control" id="Diametro" name="Diametro" onchange="JumpersFibraOptica()">
                <option value="2" position="0">2 mm</option>
            </select>
        </div>
    </div>
    <div class="col-sm-4" id="LongitudInput">
        <div class="form-group mb-0">
            <label for="quantity">Longitud (m) 0.1~999:</label>
            <input type="text" class="form-control" maxlength="5" id="Longitud" name="Longitud" value="1" oninput="JumpersFibraOptica()">
        </div>
    </div>

</div>