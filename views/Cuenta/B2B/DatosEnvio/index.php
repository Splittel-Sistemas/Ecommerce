<?php 
@session_start();
if(isset($_SESSION['Ecommerce-ClienteKey']))
{
  if (!class_exists("GetShipToAdress")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/BussinesPartner/GetShipToAdress.php';
  }

  $GetShipToAdress = new GetShipToAdress();
  try {
    $responseGetShipToAdress = $GetShipToAdress->get(false);
    $ErrorCode = $responseGetShipToAdress->GetShipToAdressResult->ErrorCode;
  } catch (SoapFault $fault) {
    $ErrorCode = -100;
  }
  
 
?>

<div class="col-lg-12">
  <div class="row">
    <div class="col-lg-12">
      <button class="btn btn-square btn-outline-primary float-md-right " onclick="showFormNewDatosEnvioB2B(this)"><i class="icon-plus-circle"></i> Nuevo</button>
    </div>
  </div>
  <?php
   if ($ErrorCode == 0){
    if($responseGetShipToAdress->GetShipToAdressResult->Count){
      $responseGetShipToAdress = $responseGetShipToAdress->GetShipToAdressResult->Records; 
  ?>
  <div class="row">
    <hr class="padding-bottom-1x">
    <div class="table-responsive table-hover mb-0">
      <table class="table cell-border" id="TableGetShipToAdress">
        <thead>
          <tr>
            <th>Dirección</th>
            <th>C.P.</th>
            <th>Contacto</th>
            <th>Teléfono</th>
            <th>Editar</th>
            <th>Eliminar</th>
          </tr> 
        </thead>
        <tbody>
        <?php 
          if(sizeof($responseGetShipToAdress->BussinessPartnerAdresses) == 1){
            $listAddress[] = $responseGetShipToAdress->BussinessPartnerAdresses;
          }else{
            $listAddress = $responseGetShipToAdress->BussinessPartnerAdresses;
          }           
            foreach ($listAddress as $Adress) {
        ?>
          <tr>
            <td class="align-middle">
            <span class="text-gray-dark" id="de_ciudad<?php echo $Adress->Adress;?>"><?php echo $Adress->City;?></span><br>
            <span class="text-muted text-sm" id="de_calle<?php echo $Adress->Adress;?>"><?php echo $Adress->Street." No Ext. ".$Adress->StreetNo. "Col. ".$Adress->Block;?></span>
            <span class="text-muted text-sm"></span>
            </td>
            <td class="align-middle" id="de_cp<?php echo $Adress->Adress;?>"><?php echo $Adress->ZipCode?></td>
            <td class="align-middle" id="de_contacto<?php echo $Adress->Adress;?>"></td>
            <td class="align-middle" id="de_telefono<?php echo $Adress->Adress;?>"></td>
            <td class="align-middle text-center">
              <span class="text-warning cursor-pointer" id="<?php echo $Adress->Adress;?>" onclick="showFormEditDatosEnvioB2B(this)"><i class="icon-edit"></i></span>
            </td>
            <td class="align-middle text-center">
              <span class="text-danger cursor-pointer" id="<?php echo $Adress->Adress;?>" onclick="deleteDataEnvioB2B(this)"><i class="icon-x"></i></span>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php }else{ ?>
      <div class="alert alert-warning alert-dismissible fade show text-center margin-bottom-1x">
          <span class="alert-close" data-dismiss="alert"></span>
          <i class="icon-alert-triangle"></i>&nbsp;&nbsp;<span class="text-medium">Alerta:</span> No existen registros
      </div>
<?php
    }
  }else{
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/ErrorProcessWS.php';
  }?>
</div>
<?php
  unset($GetShipToAdress);
  unset($responseGetShipToAdress);
}
else{
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/SessionExpired.php';
}
 ?>