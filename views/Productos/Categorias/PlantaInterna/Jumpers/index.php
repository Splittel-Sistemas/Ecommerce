<?php 
  if ($_GET['codigo'] == 'C19') {
    include 'c19_jumper_mpo.php';    
  }else if ($_GET['codigo'] == 'C89') {
    include 'c89_jumper_mpo_break_out.php';    
  }else if ($_GET['codigo'] == 'C18') {
    include 'c18_jumper_especial.php';    
  }else if ($_GET['codigo'] == 'C93') {
    include 'c93_cable_mtp_lc.php';    
  }else if ($_GET['codigo'] == 'C94') {
    include 'c94_cable_breakout_lc.php';    
  }elseif ($_GET['codigo'] == 'C95') {
    include 'c95_cable_mtpro_mtprous.php';    
  }else if ($_GET['codigo'] == 'C96') {
    include 'c96_cable_mtpro_lc.php';    
  }else{
?>
  <div class="row align-items-end pb-4">
    <div class="col-sm-4" id="Conector1Select">
      <div class="form-group mb-0">
        <label for="quantity">Conector #1</label>
        <select class="form-control" id="Conector1" name="Conector1" onchange="JumpersFibraOptica()">
         <option value="LC" position="0">LC</option>
          <option value="SC" position="1">SC</option>
          <option value="ST" position="2">ST</option>
          <option value="FC" position="3">FC</option>
          <?php if ($_GET['codigo'] == 'C16'): ?>
          <option value="MU" position="4">MU</option>
          <option value="E2" position="5">E2000</option>
          <?php else: ?>
          <option value="MT" position="6">MTRJ</option>
          <?php endif ?>
        </select>
      </div>
    </div>
    <div class="col-sm-4" id="Conector2Select">
      <div class="form-group mb-0">
        <label for="quantity">Conector #2</label>
        <select class="form-control" id="Conector2" name="Conector2" onchange="JumpersFibraOptica(true)">
         <option value="LC" position="0">LC</option>
          <option value="SC" position="1">SC</option>
          <option value="ST" position="2">ST</option>
          <option value="FC" position="3">FC</option>
          <?php if ($_GET['codigo'] == 'C16'): ?>
          <option value="MU" position="4">MU</option>
          <option value="E2" position="5">E2000</option>
          <?php else: ?>
          <option value="MT" position="6">MTRJ</option>
          <?php endif ?>
        </select>
      </div>
    </div>
    <div class="col-sm-4" id="MultimodoTipoFibraSelect">
      <div class="form-group mb-0">
        <label for="quantity">Tipo de Fibra</label>
        <select class="form-control" id="MultimodoTipoFibra" name="MultimodoTipoFibra" onchange="JumpersFibraOptica()">
          <?php if ($_GET['codigo'] == 'C17'): ?>
          <option value="09">Monomodo Bend Radius G657A1</option>
          <?php endif ?>
          <option value="62">OM1 62.5/125um</option>
          <option value="50">OM2 50/125um</option>
          <option value="55">OM3 50/125 10G</option>
          <?php if (!($_GET['codigo'] == 'C17')): ?>
          <option value="57">OM4 50/125 10-40G</option>
          <?php endif ?>
        </select>
      </div>
    </div> 
    <div class="col-sm-4" id="MonomodoTipoFibraSelect">
      <div class="form-group mb-0">
        <label for="quantity">Tipo de Fibra</label>
        <select class="form-control" id="MonomodoTipoFibra" name="MonomodoTipoFibra" onchange="JumpersFibraOptica()">
          <option value="09">Monomodo Bend Radius G657A1</option>
          <option value="29">Monomodo Bend Radius G657A2</option>
          <option value="09">Monomodo Bend Radius G657A2</option>
        </select>
      </div>
    </div> 
    <div class="col-sm-4" id="PulidoConector1Select">
      <div class="form-group mb-0">
        <label for="quantity">Pulido Conector #1</label>
        <select class="form-control" id="PulidoConector1" name="PulidoConector1" onchange="JumpersFibraOptica()">
          <?php if ($_GET['codigo'] == 'C15'): ?>
          <option value="P" position="2">PC</option>
          <?php endif ?>
          <option value="A" position="0">APC</option>
          <option value="U" position="1" selected>UPC</option>
          <?php if ($_GET['codigo'] == 'C17'): ?>
          <option value="P" position="2">PC</option>
          <?php endif ?>
        </select>
      </div>
    </div>
    <div class="col-sm-4" id="PulidoConector2Select">
      <div class="form-group mb-0">
        <label for="quantity">Pulido Conector #2</label>
        <select class="form-control" id="PulidoConector2" name="PulidoConector2" onchange="JumpersFibraOptica()">
        <?php if ($_GET['codigo'] == 'C15'): ?>
          <option value="P" position="2">PC</option>
          <?php endif ?>
          <option value="A" position="0">APC</option>
          <option value="U" position="1" selected>UPC</option>
          <?php if ($_GET['codigo'] == 'C17'): ?>
          <option value="P" position="2">PC</option>
          <?php endif ?>
        </select>
      </div>
    </div>
    <div class="col-sm-4" id="TipoCubiertaSelect">
      <div class="form-group mb-0">
        <label for="quantity">Tipo Cubierta</label>
        <select class="form-control" id="TipoCubierta" name="TipoCubierta" onchange="JumpersFibraOptica()">
          <option value="RI">Riser</option>
          <option value="PL">Plenum</option>
          <option value="ZH">Cero Halógeno</option>
          <?php if ($_GET['codigo'] == 'C17'): ?>
          <option value="RA" position="2">Riser armado</option>
          <?php endif ?>
        </select>
      </div>
    </div> 
    <div class="col-sm-4" id="NumeroHilosSelect">
      <div class="form-group mb-0">
        <label for="quantity">Número de hilos</label>
        <select class="form-control" id="NumeroHilos" name="NumeroHilos" onchange="JumpersFibraOptica()">
          <option value="S">Simplex</option>
          <option value="D" selected>Duplex</option>
        </select>
      </div>
    </div> 
    <div class="col-sm-4" id="DiametroSelect">
      <div class="form-group mb-0">
        <label for="quantity">Diámetro de cable</label>
        <select class="form-control" id="Diametro" name="Diametro" onchange="JumpersFibraOptica()">
          <option value="1">1.6 mm</option>
          <option value="2" selected>2 mm</option>
          <option value="3">3 mm</option>
        </select>
      </div>
    </div> 
    <div class="col-sm-4" id="LongitudInput">
      <div class="form-group mb-0">
        <label for="quantity">Longitud (m) 0.1~999:</label>
        <input type="text" class="form-control" id="Longitud" name="Longitud" value="1" onkeyup="JumpersFibraOptica()">
      </div>
    </div> 
  </div>
<?php } ?>