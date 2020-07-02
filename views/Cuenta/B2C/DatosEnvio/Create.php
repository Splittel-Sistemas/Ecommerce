<div class="row no-gutters">
  <div class="col-md-12" id="notify" data-offset-top="-1">
    <div class=" py-5 px-3 justify-content-center align-items-center">
      <div style="max-width: 500px;">
        <div id="alert-datos-envio"></div>
        <!-- <div class="h1 text-normal mb-3 text-center">Registro</div> -->
        <h3 class="margin-bottom-1x text-center">Datos de envio</h3>
        <!-- <p>El registro solo te llevara algunos minutos para obtener el control de tus ordenes.</p> -->
        <?php 
          if (!class_exists('DatosEnvioController')) {
            include $_SERVER['DOCUMENT_ROOT'].'/store/models/Cuenta/B2C/DatosEnvio.Controller.php';
          }
          $DatosEnvioController = new DatosEnvioController();
          $DatosEnvioController->filter = isset($_POST['DatosEnvioKey']) ? "WHERE id = '".$_POST['DatosEnvioKey']."' " : "WHERE id = 0 "; 
          $key = isset($_POST['DatosEnvioKey']) ? $_POST['DatosEnvioKey'] : 0; 
          $DatosEnvio = $DatosEnvioController->getBy();
         ?>
        <form id="form-datos-envio">
          <input type="hidden" id="Action" name="Action" value="create">
          <input type="hidden" id="ActionDatosEnvio" name="ActionDatosEnvio" value="true">
          <input type="hidden" id="DatosEnvioKey" name="DatosEnvioKey" value="<?php echo $key ?>">
            <div class="form-group">
              <input class="form-control form-control-pill" type="text" id="Nombre" name="Nombre" placeholder="Nombre" value="<?php echo $DatosEnvio->GetNombre() ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <input class="form-control form-control-pill" type="text" id="Apellido" name="Apellido" placeholder="Apellido" value="<?php echo $DatosEnvio->GetApellido() ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <input class="form-control form-control-pill" type="text" id="Telefono" name="Telefono" placeholder="Teléfono" value="<?php echo $DatosEnvio->GetTelefono() ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <input class="form-control form-control-pill" type="text" id="Celular" name="Celular" placeholder="Celular" value="<?php echo $DatosEnvio->GetCelular() ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <input class="form-control form-control-pill" type="text" id="Calle" name="Calle" placeholder="Calle" value="<?php echo $DatosEnvio->GetCalle() ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <input class="form-control form-control-pill" type="text" id="NumeroInterior" name="NumeroInterior" placeholder="Numero interior" value="<?php echo $DatosEnvio->GetNumeroInterior() ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <input class="form-control form-control-pill" type="text" id="NumeroExterior" name="NumeroExterior" placeholder="Numero exterior" value="<?php echo $DatosEnvio->GetNumeroExterior() ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <input class="form-control form-control-pill" type="text" id="CodigoPostal" name="CodigoPostal" placeholder="Código postal" value="<?php echo $DatosEnvio->GetCodigoPostal() ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <select class="form-control form-control-pill" id="Estado" name="Estado" onchange="showMunicipios(this, 'Municipio')">
              <?php 
                if (!class_exists('Estados')) {
                  include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Estados.php';
                }
                $Estado = new Estados();
                foreach ($Estado->CountryWithCitys['Mexico'] as $Ciudad) {
                  $Seleted = $Ciudad['value'] == $DatosEnvio->GetEstado() ? 'selected' : '';
              ?>
                <option value="<?php echo $Ciudad['value'] ?>" <?php echo $Seleted ?>><?php echo $Ciudad['label'] ?></option>
                    
              <?php }  ?>
              </select>
            </div>
            <div class="form-group">
              <select class="form-control form-control-pill" id="Municipio" name="Municipio">
                
              </select>
            </div>
            <div class="form-group">
              <input class="form-control form-control-pill" type="text" id="Delegacion" name="Delegacion" placeholder="Delgación" value="<?php echo $DatosEnvio->GetDelegacion() ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <input class="form-control form-control-pill" type="text" id="Colonia" name="Colonia" placeholder="Colonia" value="<?php echo $DatosEnvio->GetColonia() ?>" autocomplete="off">
            </div>
            <div class="form-group">
              <textarea  class="form-control form-control-pill" name="Referencia" id="Referencia" rows="3" placeholder="Referencia"><?php echo $DatosEnvio->GetReferencia() ?></textarea>
            </div>
          <button type="button" class="btn btn-primary btn-block float-right" onclick="nuevoRegistroDatosEnvio()"><i class="icon-send"></i>&nbsp;Enviar</button>
        </form>

      </div>
    </div>
  </div>
</div>