<!-- --------------------------------------------- Datos de envió ----------------------------------------- -->

<h4 class="text-center text-md-left">Seleccione Dirección de envió</h4>
<hr class="padding-bottom-1x">
<?php 
  if (!class_exists("GetShipToAdressController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/BusinessPartner/GetShipToAdress.Controller.php';
  }
  
  try {
    $GetShipToAdressController = new GetShipToAdressController();
    $resultGetShipToAdressController = $GetShipToAdressController->get();
    $ErrorCode = $resultGetShipToAdressController->GetShipToAdressResult->ErrorCode;
    print_r($resultGetShipToAdressController);
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
      $check = '';
      $boleano = false;
        foreach ($listGetShipToAdress as $key => $GetShipToAdress): 
          $disabled = '';
          if(empty($GetShipToAdress->Street) || empty($GetShipToAdress->StreetNo) || empty($GetShipToAdress->Block) || 
          empty($GetShipToAdress->StreetNo) || empty($GetShipToAdress->ZipCode) || empty($GetShipToAdress->Adress) ||
          empty($GetShipToAdress->ContactPerson->Name) || empty($GetShipToAdress->ContactPerson->Telphone) || empty($GetShipToAdress->ContactPerson->Email) ||
          empty($GetShipToAdress->City)){
            $disabled = 'disabled';
          }else{
            $check = $disabled == "" && $check == "" && !$boleano ? 'checked': '';
          }
          if($check == "checked") $boleano = true
      ?>
      <tr>
        <td>
          <div class="custom-control custom-radio">
            <input class="custom-control-input datosEnvio" type="radio" id="radio-<?php echo $GetShipToAdress->Adress;?>" name="radioDatosEnvio" value="<?php echo $GetShipToAdress->Adress;?>" <?php echo $check ?> <?php echo $disabled ?>>
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