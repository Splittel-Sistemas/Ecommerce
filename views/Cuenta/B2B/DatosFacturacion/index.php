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
          if(sizeof($responseGetBillToAdress->BussinessPartnerAdresses) == 1){
            $Adress = $responseGetBillToAdress->BussinessPartnerAdresses;
?>
          <tr>
            <td class="align-middle">
  			      <?php echo $Adress->CardName;?><br>
              <span class="text-gray-dark" id="df_rsocial<?php echo $Adress->Adress;?>"><?php ?></span><br>
              <span class="text-muted text-sm" id="df_calle<?php echo $Adress->Adress;?>"><?php echo $Adress->Street." No Ext. ".$Adress->StreetNo. ", Col. ".$Adress->Block.",";?></span>
              <span class="text-muted text-sm" id="df_estado<?php echo $Adress->Adress;?>"><?php echo $Adress->City.", ".$Adress->State;?></span>
            </td>
            <td class="align-middle" id="df_cp<?php echo $Adress->ZipCode;?>"><?php echo $Adress->ZipCode?></td>
            <td class="align-middle" id="df_rfc<?php echo $Adress->FederalTaxID;?>"><?php echo $Adress->FederalTaxID; ?></td>
          </tr>
<?php
          }else{
            foreach ($responseGetBillToAdress->BussinessPartnerAdresses as $Adress) {
              print_r($Adress->Adress);

        ?>
          <tr>
            <td class="align-middle">
			      <?php echo $Adress->CardName;?><br>
              <span class="text-gray-dark" id="df_rsocial<?php echo $Adress->Adress;?>"><?php ?></span><br>
              <span class="text-muted text-sm" id="df_calle<?php echo $Adress->Adress;?>"><?php echo $Adress->Street." No Ext. ".$Adress->StreetNo. ", Col. ".$Adress->Block.",";?></span>
              <span class="text-muted text-sm" id="df_estado<?php echo $Adress->Adress;?>"><?php echo $Adress->City.", ".$Adress->State;?></span>
            </td>
            <td class="align-middle" id="df_cp<?php echo $Adress->ZipCode;?>"><?php echo $Adress->ZipCode?></td>
            <td class="align-middle" id="df_rfc<?php echo $Adress->FederalTaxID;?>"><?php echo $Adress->FederalTaxID; ?></td>
          </tr>
<?php  
            }
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