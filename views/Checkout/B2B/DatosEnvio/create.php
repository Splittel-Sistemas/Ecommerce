
<?php 

if (!class_exists("GetShipToAdressByAddressName")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/BussinesPartner/GetShipToAdressByAddressName.php';
}

$GetShipToAdressByAddressName = new GetShipToAdressByAddressName();
$obj = $GetShipToAdressByAddressName;

if (isset($_POST['AddressName'])) {
  try {
    $GetShipToAdressByAddressName->AddressName = $_POST['AddressName'];
    $result = $GetShipToAdressByAddressName->get();
    $obj = $result->GetShipToAdressByAddressNameResult->Record;
    $ErrorCode = $result->GetShipToAdressByAddressNameResult->ErrorCode;
  } catch (SoapFault $fault) {
    $ErrorCode = -100;
  }
}

?>

<div class="row no-gutters">
  <div class="col-md-12" id="notify" data-offset-top="-1">
    <div class=" py-5 px-3 justify-content-center align-items-center">
      <div style="max-width: 500px;">
        <div id="alert-datos-envio"></div>
        <!-- <div class="h1 text-normal mb-3 text-center">Registro</div> -->
        <h3 class="margin-bottom-1x text-center">Datos de envio</h3>
          <form class="" novalidate="" id="form-data-factura">
          <?php if (!isset($_POST['AddressName'])): ?>
          <div class="row">
            <div class="col-sm-12 form-group">
              <!-- <label>Nombre Dirección <strong class="text-danger">*</strong></label> -->
              <input class="form-control form-control-pill" type="text" id="NombreDireccion" name="NombreDireccion" placeholder="Nombre Dirección *">
            </div>
          </div>
          <?php endif ?>
          <div class="row">
            <div class="col-sm-12 form-group">
              <!-- <label>Calle <strong class="text-danger">*</strong></label> -->
              <input class="form-control form-control-pill" type="text" id="Calle" name="Calle" value="<?php echo $obj->Street ?>" placeholder="Calle *">
            </div>
            <div class="col-sm-12 form-group">
              <!-- <label>Número <strong class="text-danger">*</strong></label> -->
              <input class="form-control form-control-pill" type="text" id="NumeroExterior" name="NumeroExterior" value="<?php echo $obj->StreetNo ?>" placeholder="Número *">
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 form-group">
              <!-- <label>Colonia <strong class="text-danger">*</strong></label> -->
              <input class="form-control form-control-pill" type="text" id="Colonia" name="Colonia" value="<?php echo $obj->Block ?>" placeholder="Colonia *">
            </div>
            <div class="col-sm-12 form-group">
              <!-- <label>Código Postal <strong class="text-danger">*</strong></label> -->
              <input class="form-control form-control-pill" type="text" id="CodigoPostal" name="CodigoPostal" value="<?php echo $obj->ZipCode ?>" placeholder="Código Postal *">
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12 form-group">
              <!-- <label>Estado <strong class="text-danger">*</strong></label> -->
              <select class="form-control form-control-pill" id="Estado" name="Estado" onchange="showMunicipios(this, 'Delegacion')">
                <?php 
                  include $_SERVER["DOCUMENT_ROOT"]."/fibra-optica/models/Tools/Estados.php";

                  $Estado = new Estados();
                  foreach ($Estado->CountryWithCitys['Mexico'] as $city) {
                    $selected = $obj->State == $city['value'] ? "selected" : "";
                  ?>
                  <option value="<?php echo $city['value'] ?>" <?php echo $selected; ?>><?php echo $city['label'] ?></option>
                <?php } ?>
              </select>
              <!-- <div class="valid-feedback">Looks good!</div> -->
            </div>
            <div class="col-sm-12 form-group">
              <!-- <label>Delegación <strong class="text-danger">*</strong></label> -->
              <select class="form-control form-control-pill"  id="Delegacion" name="Delegacion" >
              <?php 
                if (isset($_POST['AddressName'])) {
                  $_POST['CiudadKey'] = $obj->State;
                  $_POST['MunicipioDescripcion'] = $obj->County;
                  include  $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Config/Municipios.php'; 
                }
              ?>
              </select>
              <!-- <div class="valid-feedback">Looks good!</div> -->
            </div>
          </div>
          <?php if (!isset($_POST['AddressName'])): ?>
          <button type="button" class="btn btn-primary btn-block float-right" onclick="sendDataEnvioB2B()"><i class="icon-send"></i>&nbsp;Enviar</button>
          <?php else: ?>
          <button type="button" class="btn btn-info btn-block float-right" AddressName="<?php echo $_POST['AddressName'] ?>" onclick="updateDataEnvioB2B(this)">Actualizar</button>
          <?php endif ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>