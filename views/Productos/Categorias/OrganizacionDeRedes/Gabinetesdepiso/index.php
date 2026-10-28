<div class="row align-items-end pb-4">
    <div class="col-sm-6">
        <div class="form-group mb-0">
            <label for="CEspecial">Caracteristica Especial</label>
            <select class="form-control" id="CEspecial" name="CEspecial" onchange="GabinetesPiso()">
                <option value="0" selected>Ninguna</option>
                <option value="1">Marco Giratorio</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group mb-0">
            <label for="UnidadesG">Unidades</label>
            <select class="form-control" id="UnidadesG" name="UnidadesG" onchange="GabinetesPiso()">
                <option value="022" selected>22 Unidades</option>
                <option value="042">42 Unidades</option>
            </select>
        </div>
    </div>
</div>

<div class="row align-items-end pb-4">
    <div class="col-sm-6">
        <div class="form-group mb-0">
            <label for="AnchoG">Ancho</label>
            <select class="form-control" id="AnchoG" name="AnchoG" onchange="GabinetesPiso()">
                <option value="600">600</option>
                <option value="800">800</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group mb-0">
            <label for="ProfundidadG">Profundidad</label>
            <select class="form-control" id="ProfundidadG" name="ProfundidadG" onchange="GabinetesPiso()">
                <option value="600">600</option>
                <option value="1000">1000</option>
            </select>
        </div>
    </div>
</div>

<div class="row align-items-end pb-4">
    <div class="col-sm-6">
        <div class="form-group mb-0">
            <label for="PuertaFrontalG" id="LPuertaFrontalG">Puerta Frontal</label>
            <select class="form-control" id="PuertaFrontalG" name="PuertaFrontalG" onchange="GabinetesPiso()">
                <option value="C">Cristal Ranurada</option>
                <option value="V">Ventilada</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group mb-0">
            <label for="PuertaTraceraG" id="LPuertaTraceraG">Puerta Tracera</label>
            <select class="form-control" id="PuertaTraceraG" name="PuertaTraceraG" onchange="GabinetesPiso()">
                <option value="V">Ventilada</option>
                <option value="PD">Doble Sección</option>
            </select>
        </div>
    </div>
</div>