<?php 
@session_start();
if(isset($_SESSION['Ecommerce-ClienteKey']))
{
  if (!class_exists("GetBillToAdress")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/BussinesPartner/GetBillToAdress.php';
  }
  
    $GetBillToAdress = new GetBillToAdress();
      try {
          $responseGetBillToAdress = $GetBillToAdress->get(false);
          $responseGetBillToAdressError = $responseGetBillToAdress->GetBillToAdressResult->ErrorCode;
          $responseGetBillToAdressMessage = $responseGetBillToAdress->GetBillToAdressResult->ErrorDescription;
          $responseGetBillToAdressCount = $responseGetBillToAdress->GetBillToAdressResult->Count;
          $responseGetBillToAdress = $responseGetBillToAdress->GetBillToAdressResult->Records;
          
      } catch (SoapFault  $th) {
        $responseGetBillToAdressError = 100;
        $responseGetBillToAdressMessage = "Algo falló, por favor vuelve a recarcar la pagina";
      }
      catch (\Throwable $th) {
        $responseGetBillToAdressError = 100;
        $responseGetBillToAdressMessage = "Algo falló, por favor vuelve a recarcar la pagina";
      }
      unset($GetBillToAdress);
  
  // $responseGetBillToAdressError = GetData()->GetBillToAdressResult->ErrorCode;
  // $responseGetBillToAdressMessage = GetData()->GetBillToAdressResult->ErrorDescription;
  // print_r($responseGetBillToAdressCount);
  if($responseGetBillToAdressError == 0){
    if($responseGetBillToAdressCount > 0){
?>
<div class="col-lg-12">
    <div class="row">
    <hr class="padding-bottom-1x">
    <div class="table-responsive table-hover mb-0">
      <table class="table cell-border" id="TableGetBillToAdress">
        <thead class="thead-default">
          <tr>
            <th>Raz&oacute;n Social</th>
            <th>C.P.</th>
            <th>RFC</th>
          </tr>
        </thead>
        <tbody>
       <?php
$direcciones = $responseGetBillToAdress->BussinessPartnerAdresses ?? [];

if (is_object($direcciones)) {
    // El servicio devuelve una sola dirección
    $direcciones = [$direcciones];
} elseif (!is_array($direcciones)) {
    // No hay direcciones
    $direcciones = [];
}

foreach ($direcciones as $Adress) {
?>
    <tr>
        <td class="align-middle">
            <?php echo htmlspecialchars((string)($Adress->CardName ?? ''), ENT_QUOTES, 'UTF-8'); ?><br>

            <span class="text-gray-dark" id="df_rsocial<?php echo htmlspecialchars((string)($Adress->Adress ?? ''), ENT_QUOTES, 'UTF-8'); ?>"></span><br>

            <span class="text-muted text-sm" id="df_calle<?php echo htmlspecialchars((string)($Adress->Adress ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
                <?php
                echo htmlspecialchars(
                    ($Adress->Street ?? '') .
                    " No Ext. " . ($Adress->StreetNo ?? '') .
                    ", Col. " . ($Adress->Block ?? '') . ",",
                    ENT_QUOTES,
                    'UTF-8'
                );
                ?>
            </span>

            <span class="text-muted text-sm" id="df_estado<?php echo htmlspecialchars((string)($Adress->Adress ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
                <?php
                echo htmlspecialchars(
                    ($Adress->City ?? '') . ", " . ($Adress->State ?? ''),
                    ENT_QUOTES,
                    'UTF-8'
                );
                ?>
            </span>
        </td>

        <td class="align-middle" id="df_cp<?php echo htmlspecialchars((string)($Adress->ZipCode ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars((string)($Adress->ZipCode ?? ''), ENT_QUOTES, 'UTF-8'); ?>
        </td>

        <td class="align-middle" id="df_rfc<?php echo htmlspecialchars((string)($Adress->FederalTaxID ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars((string)($Adress->FederalTaxID ?? ''), ENT_QUOTES, 'UTF-8'); ?>
        </td>
    </tr>
<?php
}
?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php
    }else{
?>
      <div class="alert alert-warning alert-dismissible fade show text-center margin-bottom-1x">
          <span class="alert-close" data-dismiss="alert"></span>
          <i class="icon-alert-triangle"></i>&nbsp;&nbsp;<span class="text-medium">Alerta:</span> No existen registros
      </div>
<?php     
    }
  }else{
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/ErrorProcessWS.php';    
  }
}
else{
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/SessionExpired.php';
}
 ?>