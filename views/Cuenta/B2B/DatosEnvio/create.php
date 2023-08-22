
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


<form class="" novalidate="" id="form-data-factura">
  <?php if (!isset($_POST['AddressName'])): ?>
  <div class="row">
    <div class="col-sm-12 form-group">
      <label>Nombre Dirección <strong class="text-danger">*</strong></label>
      <input class="form-control form-control-sm" type="text" id="NombreDireccion" name="NombreDireccion" maxlength="50">
    </div>
  </div>
  <?php endif ?>
  <div class="row">
    <div class="col-sm-6 form-group">
      <label>Calle <strong class="text-danger">*</strong></label>
      <input class="form-control form-control-sm" type="text" id="Calle" name="Calle" value="<?php echo $obj->Street ?>">
    </div>
    <div class="col-sm-6 form-group">
      <label>Número <strong class="text-danger">*</strong></label>
      <input class="form-control form-control-sm" type="text" id="NumeroExterior" name="NumeroExterior" value="<?php echo $obj->StreetNo ?>">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 form-group">
      <label>Colonia <strong class="text-danger">*</strong></label>
      <input class="form-control form-control-sm" type="text" id="Colonia" name="Colonia" value="<?php echo $obj->Block ?>">
    </div>
    <div class="col-sm-6 form-group">
      <label>Código Postal <strong class="text-danger">*</strong></label>
      <input class="form-control form-control-sm" type="text" id="CodigoPostal" name="CodigoPostal" value="<?php echo $obj->ZipCode ?>">
    </div>
  </div>
  <div class="row">
    <div class="col-sm-6 form-group">
      <label>Estado <strong class="text-danger">*</strong></label>
      <select class="form-control form-control-sm" id="Estado" name="Estado" onchange="showMunicipios(this, 'Delegacion')">
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
    <div class="col-sm-6 form-group">
      <label>Delegación <strong class="text-danger">*</strong></label>
      <select class="form-control form-control-sm"  id="Delegacion" name="Delegacion">
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
  <button class="btn btn-danger float-right" type="button" onclick="sendDataEnvioB2B(this)">Enviar</button>
  <?php else: ?>
  <button class="btn btn-info float-right" type="button" AddressName="<?php echo $_POST['AddressName'] ?>" onclick="updateDataEnvioB2B(this)">Actualizar</button>
  <?php endif ?>
</form>