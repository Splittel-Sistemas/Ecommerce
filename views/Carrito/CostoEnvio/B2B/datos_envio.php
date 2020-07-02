<!-- --------------------------------------------- Datos de envió ----------------------------------------- -->

<h4 class="text-center text-md-left">Seleccione Dirección de envió</h4>
<hr class="padding-bottom-1x">
<?php 
  if (!class_exists("GetShipToAdressController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/BusinessPartner/GetShipToAdress.Controller.php';
  }
  
  try {
    $GetShipToAdressController = new GetShipToAdressController();
    $resultGetShipToAdressController = $GetShipToAdressController->get();
    $ErrorCode = $resultGetShipToAdressController->GetShipToAdressResult->ErrorCode;
    // print_r($resultGetShipToAdressController);
  } catch (Exception $e) {
    $ErrorCode = -100;
  }

  if ($ErrorCode == 0) {
    if ($resultGetShipToAdressController->GetShipToAdressResult->Count == 1) {
      $listGetShipToAdress[] = $resultGetShipToAdressController->GetShipToAdressResult->Records->BussinessPartnerAdresses;
    }else{
      $listGetShipToAdress = $resultGetShipToAdressController->GetShipToAdressResult->Records->BussinessPartnerAdresses;
    }
    // print_r($listGetShipToAdress);
 ?>
 <div class="table-responsive shopping-cart">
  <table class="table" id="tableDatosEnvio">
    <thead>
      <tr>
        <th></th>
        <th>Dirección</th>
        <th class="text-center">Código Postal</th>
        <th class="text-center">Contacto</th>
        <th class="text-center">Teléfono</th>
        <th class="text-center">Correo</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($listGetShipToAdress as $key => $GetShipToAdress): 
          // $GetShipToAdress = $row->BussinessPartnerAdresses;
          // print_r($GetShipToAdress);
          $check = $key == 0 ? 'checked': '';
      ?>
      <tr>
        <td>
          <div class="custom-control custom-radio">
            <input class="custom-control-input datosEnvio" type="radio" id="radio-<?php echo $GetShipToAdress->Adress;?>" name="radioDatosEnvio" value="<?php echo $GetShipToAdress->Adress;?>" <?php echo $check ?>>
            <label class="custom-control-label" for="radio-<?php echo $GetShipToAdress->Adress;?>"></label>
          </div>
        </td>
        <td>
          <span class="text-gray-dark"> <?php echo $GetShipToAdress->Adress.' '.$GetShipToAdress->City;?></span><br>
          <span class="text-muted text-sm" id="datosEnvio-direccion-<?php echo $GetShipToAdress->Adress;?>"> 
            <?php echo $GetShipToAdress->Street." No Ext. ".$GetShipToAdress->StreetNo. " Col. ".$GetShipToAdress->Block;?>
          </span>
        </td>
        <td class="text-center" id="datosEnvio-codigoPostal-<?php echo $GetShipToAdress->Adress;?>"><?php echo $GetShipToAdress->ZipCode ?></td>
        <td class="text-center">
          <input type="text" class="form-control form-control-sm" id="datosEnvio-nombre-<?php echo $GetShipToAdress->Adress;?>" name="datosEnvio-nombre-<?php echo $GetShipToAdress->Adress;?>" value="<?php echo $GetShipToAdress->ContactPerson->Name ?>" autocomplete="off">
        </td>
        <td class="text-center">
          <input type="text" class="form-control form-control-sm" id="datosEnvio-telefono-<?php echo $GetShipToAdress->Adress;?>" name="datosEnvio-telefono-<?php echo $GetShipToAdress->Adress;?>" value="<?php echo $GetShipToAdress->ContactPerson->Telphone ?>" autocomplete="off">
        </td>
        <td class="text-center">
          <input type="text" class="form-control form-control-sm" id="datosEnvio-correo-<?php echo $GetShipToAdress->Adress;?>" name="datosEnvio-correo-<?php echo $GetShipToAdress->Adress;?>" value="<?php echo $GetShipToAdress->ContactPerson->Email ?>" autocomplete="off">
        </td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<button type="button" class="btn btn-outline-primary" onclick="solicitar(this)">Solicitar</button>
<?php }else{ ?>
  <h4>error!</h4>
<?php } 
  
  unset($GetBillToAdressController);
  unset($resultGetBillToAdressController);
  unset($listGetBillToAdress);
  unset($GetShipToAdressController);
  unset($resultGetShipToAdressController);
  unset($listGetShipToAdress);
  unset($CFDIUserController);
  unset($ResultCFDIUserController);
 ?>