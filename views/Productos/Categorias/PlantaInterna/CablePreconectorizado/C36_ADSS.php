<div class="row align-items-end pb-4" id="">
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de terminacion</label>
        <select class="form-control" id="TipoTerminacion" name="TipoTerminacion" onchange="interior_exterior_cable()">
            <option onselect="" selected value="9UM">900 um</option>
            
            <!-- <option value="3MM">3 mm</option> -->
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de cubierta</label>
        <select class="form-control" id="TipoCubierta" name="TipoCubierta" onchange="interior_exterior_cable()">
          <option selected value="E">Polietileno</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de fibra</label>
        <select class="form-control" id="TipoFibra" name="TipoFibra" onchange="interior_exterior_cable()">
            <option selected value="09">Monomodo</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Conector lado A</label>
        <select id="conec_lad_a" onchange="interior_exterior_cable()" class="form-control">
        <option value="BI" position="0">LCA 900um</option>
          <option value="AR" position="1">LCU 900um</option>
          <option value="AY" position="2">SCA 900um</option>
          <option value="AT" position="3">SCU 900um</option>
          <option value="AX" position="4">STU 900um</option>
          <option value="BA" position="5">FCA 900um</option>
          <option value="AU" position="6">FCU 900um</option>
          <!-- multimodo -->
          <option value="AS" position="7">LCP 900um</option>
          <option value="AV" position="8">SCP 900um</option>
          <option value="AZ" position="9">STP 900um</option>
          <option value="AW" position="10">FCP 900um</option>

          <option value="BJ" position="11">LCA 2mm Simplex</option>
          <option value="AA" position="12">LCU 2mm Simplex</option>
          <option value="AB" position="13">LCU 2mm Dúplex</option>
          <option value="AJ" position="14">SCA 2mm Simplex</option>
          <option value="AC" position="15">SCU 2mm Simplex</option>
          <option value="AI" position="16">STU 2mm Simplex</option>
          <option value="AL" position="17">FCA 2mm Simplex</option>
          <option value="AD" position="18">FCU 2mm Simplex</option>
          <!-- multimodo -->
          <option value="AE" position="19">LCP 2mm Simplex</option>
          <option value="AF" position="20">LCP 2mm Dúplex</option>
          <option value="AG" position="21">SCP 2mm Simplex</option>
          <option value="AK" position="22">STP 2mm Simplex</option>
          <option value="AH" position="23">FCP 2mm Simplex</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Conector lado B</label>
        <select id="conec_lad_b" onchange="interior_exterior_cable()" class="form-control">
        <option value="">Sin conector</option>
          <option value="BI" position="0">LCA 900um</option>
          <option value="AR" position="1">LCU 900um</option>
          <option value="AY" position="2">SCA 900um</option>
          <option value="AT" position="3">SCU 900um</option>
          <option value="AX" position="4">STU 900um</option>
          <option value="BA" position="5">FCA 900um</option>
          <option value="AU" position="6">FCU 900um</option>
          <!-- multimodo -->
          <option value="AS" position="7">LCP 900um</option>
          <option value="AV" position="8">SCP 900um</option>
          <option value="AZ" position="9">STP 900um</option>
          <option value="AW" position="10">FCP 900um</option>

          <option value="BJ" position="11">LCA 2mm Simplex</option>
          <option value="AA" position="12">LCU 2mm Simplex</option>
          <option value="AB" position="13">LCU 2mm Dúplex</option>
          <option value="AJ" position="14">SCA 2mm Simplex</option>
          <option value="AC" position="15">SCU 2mm Simplex</option>
          <option value="AI" position="16">STU 2mm Simplex</option>
          <option value="AL" position="17">FCA 2mm Simplex</option>
          <option value="AD" position="18">FCU 2mm Simplex</option>
          <!-- multimodo -->
          <option value="AE" position="19">LCP 2mm Simplex</option>
          <option value="AF" position="20">LCP 2mm Dúplex</option>
          <option value="AG" position="21">SCP 2mm Simplex</option>
          <option value="AK" position="22">STP 2mm Simplex</option>
          <option value="AH" position="23">FCP 2mm Simplex</option> 
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Número de hilos<span id="NoHilos_label">1-12</span></label>
        <input class="form-control" maxlength="2" type="text" value="" id="NoHilos" name="" onmouseup="interior_exterior_cable()" onkeyup="interior_exterior_cable()">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Longitud <span id="Longitud_label">1-999 (m)</span></label>
        <input class="form-control" maxlength="3" type="text" value="" id="Longitud" name="" onmouseup="interior_exterior_cable()" onkeyup="interior_exterior_cable()">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Adicionales</label>
        <select id="Adicionales" onchange="interior_exterior_cable()" class="form-control">
        <option value="">Sin Malla</option>
            <option value="MA">Con Malla</option>
            <option value="BO">Con Break-Out 2mm</option>
            <option value="BM">Con Break-Out a 2mm y malla</option>
        </select>
    </div>
  </div>
</div>