<?php
  if (!class_exists("GetOrdersRejected")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/Document/GetOrdersRejected.php';
  }

  try {
    $GetOrdersRejected = new GetOrdersRejected();
    $ResponseGetOrdersRejected = (object)$GetOrdersRejected->get(false);
    $ResponseGetOrdersRejected = $ResponseGetOrdersRejected->GetOrdersRejectedResult;
    $ErrorCode = $ResponseGetOrdersRejected->ErrorCode;
    // print_r($ResponseGetOrdersRejected);
  } catch (Exception $e) {
    $ErrorCode = -100;
    // print_r($e);
  }

  if($ErrorCode >= 0){
    if($ResponseGetOrdersRejected->Count > 0){
      $ResponseGetOrdersRejected = $ResponseGetOrdersRejected->Records->Document_;
?>
      <div class="table-responsive table-hover mb-0">
            <table class="table cell-border" id="TablePedidosRechazadosB2B">
              <thead>
                  <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">Fecha Creaci&oacute;n</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Tipo</th>
                  <th class="text-center">Estatus</th>
                  </tr>
              </thead>
              <tbody>
              <?php if (sizeof($ResponseGetOrdersRejected) == 1): $document = $ResponseGetOrdersRejected; ?>
                <tr>
                  <td class="text-center"><?php echo $document->DocNum; ?></td>
                  <td class="text-center"><?php echo $document->DocDate; ?></td>
                  <td class="text-center"><?php echo '$'.$document->DocTotal; ?></td>
                  <td class="text-center"><?php echo $document->DocType; ?></td>
                  <td class="text-center"><?php echo $document->Status; ?></td>
                </tr>
              <?php else: ?>
              <?php foreach ($ResponseGetOrdersRejected as $document) : ?>
                <tr>
                  <td class="text-center"><?php echo $document->DocNum; ?></td>
                  <td class="text-center"><?php echo $document->DocDate; ?></td>
                  <td class="text-center"><?php echo '$'.$document->DocTotal; ?></td>
                  <td class="text-center"><?php echo $document->DocType; ?></td>
                  <td class="text-center"><?php echo $document->Status; ?></td>
                </tr>
              <?php endforeach ?>               
              <?php endif ?>
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
?>

<?php 
  unset($GetOrdersRejected);
  unset($ResponseGetOrdersRejected);
?>