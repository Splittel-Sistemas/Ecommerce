<div class="row align-items-end pb-4" id="">
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Tipo de terminacion</label>
        <select class="form-control" id="TipoTerminacion" name="TipoTerminacion" onchange="interior_exterior_cable()">
            <option selected onselect="" value="9UM">900 um</option>
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
            <option value="09">Monomodo</option>
            <option value="62">Multimodo OM1</option>
            <option value="50">Multimodo OM2</option>
            <option value="55">Multimodo OM3</option>
            <option value="57">Multimodo OM4</option>
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
      <label for="quantity">Conector lado A</label>
        <select id="conec_lad_a" onchange="interior_exterior_cable()" class="form-control">
        <option value="BI" position="0" data-conector="LCA">LCA 900um</option>
          <option value="AR" position="1" data-conector="LCU">LCU 900um</option>
          <option value="AY" position="2" data-conector="SCA">SCA 900um</option>
          <option value="AT" position="3" data-conector="SCU">SCU 900um</option>
          <option value="AX" position="4" data-conector="STU">STU 900um</option>
          <option value="BA" position="5" data-conector="FCA">FCA 900um</option>
          <option value="AU" position="6" data-conector="FCU">FCU 900um</option>
          <!-- multimodo -->
          <option value="AS" position="7" data-conector="LCP">LCP 900um</option>
          <option value="AV" position="8" data-conector="SCP">SCP 900um</option>
          <option value="AZ" position="9" data-conector="STP">STP 900um</option>
          <option value="AW" position="10" data-conector="FCP">FCP 900um</option>

          <option value="BJ" position="11" data-conector="LCA">LCA 2mm Simplex</option>
          <option value="AA" position="12" data-conector="LCU">LCU 2mm Simplex</option>
          <option value="AB" position="13" data-conector="LCU">LCU 2mm Dúplex</option>
          <option value="AJ" position="14" data-conector="SCA">SCA 2mm Simplex</option>
          <option value="AC" position="15" data-conector="SCU">SCU 2mm Simplex</option>
          <option value="AI" position="16" data-conector="STU">STU 2mm Simplex</option>
          <option value="AL" position="17" data-conector="FCA">FCA 2mm Simplex</option>
          <option value="AD" position="18" data-conector="FCU">FCU 2mm Simplex</option>
          <!-- multimodo -->
          <option value="AE" position="19" data-conector="LCP">LCP 2mm Simplex</option>
          <option value="AF" position="20" data-conector="LCP">LCP 2mm Dúplex</option>
          <option value="AG" position="21" data-conector="SCP">SCP 2mm Simplex</option>
          <option value="AK" position="22" data-conector="STP">STP 2mm Simplex</option>
          <option value="AH" position="23" data-conector="FCP">FCP 2mm Simplex</option>            
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Conector lado B</label>
        <select id="conec_lad_b" onchange="interior_exterior_cable()" class="form-control">
        <option value="">Sin conector</option>
          <option value="BI" position="0" data-conector="LCA">LCA 900um</option>
          <option value="AR" position="1" data-conector="LCU">LCU 900um</option>
          <option value="AY" position="2" data-conector="SCA">SCA 900um</option>
          <option value="AT" position="3" data-conector="SCU">SCU 900um</option>
          <option value="AX" position="4" data-conector="STU">STU 900um</option>
          <option value="BA" position="5" data-conector="FCA">FCA 900um</option>
          <option value="AU" position="6" data-conector="FCU">FCU 900um</option>
          <!-- multimodo -->
          <option value="AS" position="7" data-conector="LCP">LCP 900um</option>
          <option value="AV" position="8" data-conector="SCP">SCP 900um</option>
          <option value="AZ" position="9" data-conector="STP">STP 900um</option>
          <option value="AW" position="10" data-conector="FCP">FCP 900um</option>

          <option value="BJ" position="11" data-conector="LCA">LCA 2mm Simplex</option>
          <option value="AA" position="12" data-conector="LCU">LCU 2mm Simplex</option>
          <option value="AB" position="13" data-conector="LCU">LCU 2mm Dúplex</option>
          <option value="AJ" position="14" data-conector="SCA">SCA 2mm Simplex</option>
          <option value="AC" position="15" data-conector="SCU">SCU 2mm Simplex</option>
          <option value="AI" position="16" data-conector="STU">STU 2mm Simplex</option>
          <option value="AL" position="17" data-conector="FCA">FCA 2mm Simplex</option>
          <option value="AD" position="18" data-conector="FCU">FCU 2mm Simplex</option>
          <!-- multimodo -->
          <option value="AE" position="19" data-conector="LCP">LCP 2mm Simplex</option>
          <option value="AF" position="20" data-conector="LCP">LCP 2mm Dúplex</option>
          <option value="AG" position="21" data-conector="SCP">SCP 2mm Simplex</option>
          <option value="AK" position="22" data-conector="STP">STP 2mm Simplex</option>
          <option value="AH" position="23" data-conector="FCP">FCP 2mm Simplex</option>    
        </select>
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Número de hilos<span id="NoHilos_label">1-12</span></label>
        <input class="form-control" maxlength="2" type="text" value="2" id="NoHilos" name="" onmouseup="interior_exterior_cable()" oninput="interior_exterior_cable()">
    </div>
  </div>
  <div class="col-sm-4">
    <div class="form-group mb-0">
        <label for="quantity">Longitud <span id="Longitud_label">1-999 (m)</span></label>
        <input class="form-control" maxlength="5" type="text" value="1" id="Longitud" name="" onmouseup="interior_exterior_cable()" oninput="interior_exterior_cable()">
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