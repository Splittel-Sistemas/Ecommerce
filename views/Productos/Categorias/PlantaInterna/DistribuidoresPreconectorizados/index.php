<div class="row align-items-end pb-4">

<div class="col-sm-6" id="CantidadPigtailSelect">
    <div class="form-group mb-0">
      <label for="quantity">Cantidad de Pigtails</label>
      <select class="form-control" id="CantidadPigtails" name="CantidadPigtails" onchange="DistribuidoresPreconectorizados()">
        <option value="4">4</option>
        <option value="6">6</option>
        <option value="12">12</option>
        <option value="18">18</option>
        <option value="24">24</option>
        <option value="36">36</option>
        <option value="48">48</option>
        <option value="60">60</option>
        <option value="72">72</option>
        <option value="96">96</option>
        <option value="144">144</option>
        <option value="288">288</option>
      </select>
    </div>
  </div> 

  <div class="col-sm-6" id="TipoFibraSelect">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de Pigtail</label>
      <select class="form-control" id="TipoAcoplador" name="TipoAcoplador" onchange="DistribuidoresPreconectorizados()">
        <option value="LCU" acoplador="LC">LCU</option>
        <option value="LCA" acoplador="LC">LCA</option>
        <option value="LCP" acoplador="LC">LCP</option>
        <option value="SCU" acoplador="SC">SCU</option>
        <option value="SCA" acoplador="SC">SCA</option>
        <option value="SCP" acoplador="SC">SCP</option>
        <option value="FCU" acoplador="FC">FCU</option>
        <option value="FCP" acoplador="FC">FCP</option>
        <option value="STU" acoplador="ST">STU</option>
        <option value="STP" acoplador="ST">STP</option>
      </select>
    </div>
  </div> 
  <div class="col-sm-6" id="PuertoSelect" style="display:none;">
    <div class="form-group mb-0">
      <label for="quantity">Puertos</label>
      <select class="form-control" id="Puertos" name="Puertos" onchange="DistribuidoresPreconectorizados()">
        <option value="D">Dúplex</option>
        <option value="S">Simplex</option>
        <option value="Q">Quad</option>
      </select>
    </div>
  </div> 
  <div class="col-sm-6" id="TipoFibraSelect">
    <div class="form-group mb-0">
      <label>Tipo de Fibra</label>
      <select class="form-control" id="TipoFibra" name="TipoFibra" onchange="DistribuidoresPreconectorizados()" >
        <option value="09">Monomodo 9/125</option>
        <option value="62">Multimodo OM1 62.5 / 125</option>
        <option value="50">Multimodo OM2 50 / 125</option>
        <option value="55">Multimodo OM3 50 / 125 10G</option>
        <option value="57">Multimodo OM4 50 / 125 40G</option>
      </select>
    </div>
  </div>
  <div class="col-sm-6" id="NumeroAcopladoresSelect">
    <div class="form-group mb-0">
      <label id="NumeroAcopladoresIdText">Cantidad de Acopladores</label>
      <input type="text" class="form-control" id="NumeroAcopladores" name="NumeroAcopladores" readonly="readonly" onkeyup="DistribuidoresPreconectorizados()">
    </div>
  </div>
</div>
