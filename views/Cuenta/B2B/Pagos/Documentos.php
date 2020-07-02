<?php
@session_start();
if(isset($_SESSION['Ecommerce-ClienteKey']))
{
  if (!class_exists("GetDocumentsPayment")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/Payment/GetDocumentsPayment.php';
  }

  try {
    $GetDocumentsPayment = new GetDocumentsPayment();
    $GetDocumentsPayment->DocEntry = $_REQUEST['DocEntry'];
    $ResponseGetDocumentsPayment = (object)$GetDocumentsPayment->get(false);
    $ResponseGetDocumentsPayment = $ResponseGetDocumentsPayment->GetDocumentsPaymentResult;
  } catch (Exception $e) {
    // echo $e;
  }

  if($ResponseGetDocumentsPayment->ErrorCode == 0):
    if($ResponseGetDocumentsPayment->Count > 0){
?>
            <div class="table-responsive table-hover mb-0">
                <table class="table cell-border" id="table-pedido">
                    <thead class="thead-default">
                        <tr>
                            <th>#</th>
                            <th>Total</th>
                            <th>Días de atraso</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
    <?php 
                foreach ($ResponseGetDocumentsPayment->Records->Document_ as $obj) {
                    $date1 = new DateTime($_REQUEST['DocDate']);
                    $date2 = new DateTime(date("d-m-Y",strtotime($obj->DocDate)));
                    $diff = $date1->diff($date2);
    ?>
                        <tr>
                            <td><?php echo $obj->DocNum; ?></td>
                            <td>$<?php echo number_format($obj->DocTotal,2); ?></td>
                            <td><?php echo $diff->days; ?></td>
                            <td>
                                <button class="btn btn-sm btn-outline-info" onclick="ClienteB2B_list_documentos_showDetalles_pay('<?php echo $obj->DocEntry; ?>','<?php echo $obj->DocType; ?>')" >ver</button>
                            </td>
                        </tr>
    <?php
                }
    ?>               
                    </tbody>
                </table>
            </div>
<?php
    }else{
?>
<div class="alert alert-info alert-dismissible fade show text-center margin-bottom-1x">
    <span class="alert-close" data-dismiss="alert"></span>
    <i class="icon-alert-triangle"></i>&nbsp;&nbsp;<span class="text-medium"></span> Este es un pago a cuenta
  </div>
<?php
    }
    
?>

    <?php else: ?>
      <div><?php echo $ResponseGetDocumentsPayment->ErrorDescription; ?></div>
    <?php endif ?>
<?php 
  unset($GetDocumentsPayment);
  unset($ResponseGetDocumentsPayment);
}
else{
    include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/SessionExpired.php';
}
 ?>