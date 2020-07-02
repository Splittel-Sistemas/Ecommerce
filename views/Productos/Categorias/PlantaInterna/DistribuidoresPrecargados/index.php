<div class="row align-items-end pb-4">
  <div class="col-sm-6" id="TipoFibraSelect">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de Acoplador</label>
      <select class="form-control" id="TipoAcoplador" name="TipoAcoplador" onchange="DistribuidoresPrecargados()">
        <option value="LCU">LCU</option>
        <option value="LCA">LCA</option>
        <option value="LCP">LCP</option>
        <option value="SCU">SCU</option>
        <option value="SCA">SCA</option>
        <option value="SCP">SCP</option>
        <option value="FCU">FCU</option>
        <option value="FCP">FCP</option>
        <option value="STU">STU</option>
        <option value="STP">STP</option>
      </select>
    </div>
  </div> 
  <div class="col-sm-6" id="PuertoSelect">
    <div class="form-group mb-0">
      <label for="quantity">Puertos</label>
      <select class="form-control" id="Puertos" name="Puertos" onchange="DistribuidoresPrecargados()">
        <option value="D">Dúplex</option>
        <option value="S">Simplex</option>
        <option value="Q">Quad</option>
      </select>
    </div>
  </div> 
  <div class="col-sm-6" id="ColorSelect" style="display: none;">
    <div class="form-group mb-0">
      <label for="quantity">Color</label>
      <select class="form-control" id="Color" name="Color" onchange="DistribuidoresPrecargados()">
        <option value="">Beige</option>
        <option value="AQ">Aqua</option>
      </select>
    </div>
  </div> 
  <div class="col-sm-6" id="TipoFibraSelect">
    <div class="form-group mb-0">
      <label id="NumeroAcopladoresIdText"></label>
      <input type="text" class="form-control" id="NumeroAcopladores" name="NumeroAcopladores" value="1" onkeyup="DistribuidoresPrecargados()">
    </div>
  </div>
</div>