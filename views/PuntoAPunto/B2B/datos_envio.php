<!-- --------------------------------------------- Datos de envió ----------------------------------------- -->

<h4 class="text-center text-md-left mt-5">Datos de envió</h4>
<?php 
  if (!class_exists("GetShipToAdressController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/BusinessPartner/GetShipToAdress.Controller.php';
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
        if (!class_exists('PedidoController')) {
          include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
        }
        if(isset($_SESSION["Ecommerce-PedidoKey"])){
          $PedidoController = new PedidoController;
          $PedidoController->filter = "WHERE id = ".$_SESSION["Ecommerce-PedidoKey"]." ";
          $PedidoController->order = "";
          # obtención de subtotal iva y total del pedido actual
          $Pedido = $PedidoController->getBy();      
        }
        
        $disabled = '';
        $table_td_color = '';
        foreach ($listGetShipToAdress as $key => $GetShipToAdress): 
          $check = $key == 0 ? 'checked': '';
      ?>
      <tr class="<?php echo $table_td_color;?>"> 
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
<hr class="padding-bottom-1x">
<?php }else{ ?>
  <h4>error!</h4>
<?php } ?>

<!-- --------------------------------------------- Datos de Facturación ----------------------------------------- -->

<h4 class="text-center text-md-left">Datos de Facturación</h4>
<hr class="padding-bottom-1x">

<div class="col-12 col-md-6" style="display: none;">
  <div class="custom-control custom-checkbox">
    <input class="custom-control-input" type="checkbox" id="RequiereFactura" name="RequiereFactura" checked>
    <label class="custom-control-label" for="RequiereFactura">Requiere Factura</label>
  </div>
</div>

<?php 
  if (!class_exists("GetBillToAdressController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/BusinessPartner/GetBillToAdress.Controller.php';
  }
  
  try {
    $GetBillToAdressController = new GetBillToAdressController();
    $resultGetBillToAdressController = $GetBillToAdressController->get();
    $ErrorCode = $resultGetBillToAdressController->GetBillToAdressResult->ErrorCode;
    // print_r($resultGetBillToAdressController);
  } catch (Exception $e) {
    $ErrorCode = -100;
  }

  if ($ErrorCode == 0) {
    if ($resultGetBillToAdressController->GetBillToAdressResult->Count == 1) {
      $listGetBillToAdress[] = $resultGetBillToAdressController->GetBillToAdressResult->Records->BussinessPartnerAdresses;
    }else{
      $listGetBillToAdress = $resultGetBillToAdressController->GetBillToAdressResult->Records->BussinessPartnerAdresses;
    }
    // print_r($listGetBillToAdress);
 ?>

 <div class="table-responsive shopping-cart">
  <table class="table" id="tableDatosFacturación">
    <thead>
      <tr>
        <th></th>
        <th>Razón social</th>
        <th class="text-center">Código Postal</th>
        <th class="text-center">RFC</th>
        <th class="text-center">Tipo de facturación</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($listGetBillToAdress as $key => $GetBillToAdress): 
          $check = $key == 0 ? 'checked': '';
      ?>
      <tr>
        <td>
          <div class="custom-control custom-radio">
            <input class="custom-control-input datosFacturacion" type="radio" id="radio-<?php echo $GetBillToAdress->Adress;?>" name="radioDatosFacturacion" value="<?php echo $GetBillToAdress->Adress;?>" <?php echo $check ?>>
            <label class="custom-control-label" for="radio-<?php echo $GetBillToAdress->Adress;?>"></label>
          </div>
        </td>
        <td>
          <span class="text-gray-dark" id="datosFacturacion-razonSocial-<?php echo $GetBillToAdress->Adress;?>"> <?php echo $GetBillToAdress->CardName;?></span><br>
          <span class="text-muted text-sm" id="datosFacturacion-direccion-<?php echo $GetBillToAdress->Adress;?>"> 
            <?php echo $GetBillToAdress->Street." No Ext. ".$GetBillToAdress->StreetNo. ", Col. ".$GetBillToAdress->Block.",";?>
          </span>
          <span class="text-muted text-sm" id="datosFacturacion-estado-<?php echo $GetBillToAdress->Adress;?>"> 
            <?php echo $GetBillToAdress->City.", ".$GetBillToAdress->State;?>
          </span>
        </td>
        <td class="text-center" id="datosFacturacion-codigoPostal-<?php echo $GetBillToAdress->Adress;?>"> <?php echo $GetBillToAdress->ZipCode ?> </td>
        <td class="align-middle" id="datosFacturacion-RFC-<?php echo $GetBillToAdress->Adress;?>"> <?php echo $GetBillToAdress->FederalTaxID; ?> </td>
        <td class="align-middle" id="datosFacturacion-tipoFacturacion-<?php echo $GetBillToAdress->Adress;?>"> </td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
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
<button class="btn btn-primary mt-5 float-right" onclick="AgregarArticuloPuntos()">Canjear</button>
