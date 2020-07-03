<?php
  if (!class_exists("GetListPaymentsByBussinessPartner")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/BussinesPartner/GetListPaymentsByBussinessPartner.php';
  }

  try {
    $GetListPaymentsByBussinessPartner = new GetListPaymentsByBussinessPartner();
    $GetListPaymentsByBussinessPartner->FechaInicial =  $fecha1;
    $GetListPaymentsByBussinessPartner->FechaFin =  $fecha2;
    $ResponseGetListPaymentsByBussinessPartner = (object)$GetListPaymentsByBussinessPartner->get(false);
    $ResponseGetListPaymentsByBussinessPartner = $ResponseGetListPaymentsByBussinessPartner->GetListPaymentsByBussinessPartnerResult;
    $ErrorCode = $ResponseGetListPaymentsByBussinessPartner->ErrorCode;
     // print_r($ResponseGetListPaymentsByBussinessPartner);
  } catch (Exception $e) {
    $ErrorCode = -100;
    // print_r($e);
  }

  if( $ErrorCode >= 0){
    if($ResponseGetListPaymentsByBussinessPartner->Count){
      if(sizeof($ResponseGetListPaymentsByBussinessPartner->Records->Payment) == 1){
          $Payment [] = $ResponseGetListPaymentsByBussinessPartner->Records->Payment;
      }else{
          $Payment = $ResponseGetListPaymentsByBussinessPartner->Records->Payment;
      }
?>
    <div class="table-responsive table-hover mb-0">
      <table class="table cell-border" id="TablePagos">
          <thead >
              <tr>
              <th class="text-center">#</th>
              <th class="text-center">Cliente</th>
              <th class="text-center">Fecha creaci&oacute;n</th>
              <th class="text-center">Total</th>
              <th class="text-center">Moneda</th>
              <th class="text-center">Detalle</th>
              </tr>
          </thead>
          <tbody>
          <?php foreach ($Payment as $pago) : ?>
            <tr>
              <td class="text-center"><?php echo $pago->DocNum; ?></td>
              <td class="text-center"><?php echo $pago->CardName; ?></td>
              <td class="text-center"><?php echo date("d-m-Y",strtotime($pago->DocDate)); ?></td>
              <td class="text-center">$<?php echo number_format($pago->DocTotal, 3); ?></td>
              <td class="text-center"><?php echo $pago->DocCurr; ?></td>
              <td class="text-center">
                <span class="text-info cursor-point" onclick="ClienteB2B_list_documentos_payment('<?php echo $pago->DocEntry; ?>','<?php echo date("d-m-Y",strtotime($pago->DocDate)); ?>')">
                  <i class="icon-file-text"></i>
                </span>
              </td>
            </tr>
          <?php endforeach ?>               
          </tbody>
      </table>
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
  unset($GetListPaymentsByBussinessPartner);
  unset($ResponseGetListPaymentsByBussinessPartner);
?>