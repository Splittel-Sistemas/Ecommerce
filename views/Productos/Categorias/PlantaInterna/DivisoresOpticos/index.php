<div class="row align-items-end pb-4">
  <div class="col-sm-4" id="DiametroSelect">
    <div class="form-group mb-0">
      <label for="quantity">Diámetro</label>
      <select class="form-control" id="Diametro" name="Diametro" onchange="DivisoresOpticos()">
        <option value="SF">250um</option>
        <option value="CF">900um</option>
        <option value="CF2">2mm</option>
      </select>
    </div>
  </div>
  <div class="col-sm-4" id="ConectorEntradaSelect">
    <div class="form-group mb-0">
      <label for="" id="LabelConectorEntrada">Conector Entrada</label>
      <select class="form-control" id="ConectorEntrada" name="ConectorEntrada" onchange="DivisoresOpticos()">
        <option value="SCA">SC/APC</option>
        <?php if ($_GET['codigo'] != "C65"): ?>
          <option value="">Sin conector</option>
        <?php endif ?>
      </select>
    </div>
  </div> 
  <div class="col-sm-4" id="ConectorSalidaSelect">
    <div class="form-group mb-0">
      <label for="quantity">Conector Salida</label>
      <select class="form-control" id="ConectorSalida" name="ConectorSalida" onchange="DivisoresOpticos()">
        <option value="SCA">SC/APC</option>
        <option value="">Sin conector</option>
      </select>
    </div>
  </div> 
  <div class="col-sm-4" id="EntradaSalidasSelect">
    <div class="form-group mb-0">
      <label for="quantity">Entradas / Salidas</label>
      <select class="form-control" id="EntradaSalidas" name="EntradaSalidas" onchange="DivisoresOpticos()">
        <option value="102" SalidasSplitterValue="50">1x2</option>
        <option value="103" SalidasSplitterValue="33">1x3</option>
        <option value="104" SalidasSplitterValue="25">1x4</option>
        <option value="105" SalidasSplitterValue="20">1x5</option>
        <option value="106" SalidasSplitterValue="16">1x6</option>
        <option value="108" SalidasSplitterValue="12">1x8</option>
        <option value="110" SalidasSplitterValue="10">1x10</option>
        <option value="116" SalidasSplitterValue="62">1x16</option>
        <option value="132" SalidasSplitterValue="31">1x32</option>
        <option value="164" SalidasSplitterValue="15">1x64</option>
        <option value="202" SalidasSplitterValue="50">2x2</option>
        <option value="204" SalidasSplitterValue="25">2x4</option>
        <option value="208" SalidasSplitterValue="12">2x8</option>
        <option value="216" SalidasSplitterValue="62">2x16</option>
      </select>
    </div>
  </div> 
  <div class="col-sm-4" id="EntradaSalidasSelect2" style="display: none;">
    <div class="form-group mb-0">
      <label for="quantity">Entradas / Salidas</label>
      <select class="form-control" id="EntradaSalidas2" name="EntradaSalidas2" onchange="DivisoresOpticos()">
        <option value="102" SalidasSplitterValue="50">1x2</option>
        <option value="103" SalidasSplitterValue="33">1x3</option>
        <option value="104" SalidasSplitterValue="25">1x4</option>
        <option value="108" SalidasSplitterValue="12">1x8</option>
        <option value="116" SalidasSplitterValue="62">1x16</option>
        <option value="132" SalidasSplitterValue="31">1x32</option>
        <option value="164" SalidasSplitterValue="15">1x64</option>
        <option value="204" SalidasSplitterValue="25">2x4</option>
        <option value="216" SalidasSplitterValue="62">2x16</option>
      </select>
    </div>
  </div>
  <div class="col-sm-4" id="SalidasCouplerSelect">
    <div class="form-group mb-0">
      <label for="quantity">% Salidas(Coupler)</label>
      <select class="form-control" id="SalidasCoupler" name="SalidasCoupler" onchange="DivisoresOpticos()">
        <option value="50">50%</option>
        <option value="55">55/45</option>
        <option value="60">60/40</option>
        <option value="65">65/35</option>
        <option value="70">70/30</option>
        <option value="75">75/25</option>
        <option value="80">80/20</option>
        <option value="85">85/15</option>
        <option value="90">90/10</option>
        <option value="95">95/5</option>
        <option value="99">99/1</option>
      </select>
    </div>
  </div>
</div>
