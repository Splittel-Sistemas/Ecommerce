<?php
@session_start();
if(isset($_SESSION['Ecommerce-ClienteKey']))
{
  if (!class_exists("GetDocumentLines")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/Document/GetDocumentLines.php';
  }

  try {
    $GetDocumentLines = new GetDocumentLines();
    $GetDocumentLines->DocEntry = $_REQUEST['DocEntry'];
    $GetDocumentLines->DocType = $_REQUEST['DocType'];
    $ResponseGetDocumentLines = (object)$GetDocumentLines->get(false);
    // print_r($ResponseGetDocumentLines);
    $ResponseGetDocumentLines = $ResponseGetDocumentLines->GetDocumentLinesResult;
  } catch (Exception $e) {
    $ResponseGetDocumentLines->ErrorCode = 100;
    // print_r($e);
  }

  if($ResponseGetDocumentLines->ErrorCode == 0){
    if(sizeof($ResponseGetDocumentLines->Records->DocumentLine) == 1){
      $LinesDoc [] = $ResponseGetDocumentLines->Records->DocumentLine;
    }else{
        $LinesDoc = $ResponseGetDocumentLines->Records->DocumentLine;
    }
?>
    <table class="table table-sm table-bordered table-hover" id="table-pedido">
        <thead class="thead-default">
            <tr>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Total + iva</th>
                <th>Moneda</th>
            </tr>
        </thead>
        <tbody>
<?php           
                $TotalProducts = 0;
                $TotalProductsIVa = 0;
                foreach ($LinesDoc as $documento1) {
                  $Price = $documento1->Price;
                  $TotalProducts = $TotalProducts + $Price;
                  $iva = $Price + ($Price * ($documento1->VatPercent / 100));
                  $TotalProductsIVa = $TotalProductsIVa + $iva;
?>
            <tr>
                <td><?php echo $documento1->ItemCode; ?></td>
                <td><?php echo $documento1->Dscription; ?></td>
                <td><?php echo $documento1->Quantity; ?></td>
                <td>$<?php echo number_format($Price,2); ?></td>
                <td>$<?php echo number_format($iva,2); ?></td>
                <td><?php echo $documento1->Currency; ?></td>
                
            </tr>
<?php   
                }            
?>
        </tbody>
        <tfoot class="thead-default">
            <tr>
                <th></th>
                <th></th>
                <th>Total</th>
                <th>$<?php echo number_format($TotalProducts,2); ?></th>
                <th>$<?php echo number_format($TotalProductsIVa,2); ?></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
<?php 
  }
  else
  {
?>
  <div class="alert alert-warning alert-dismissible fade show text-center margin-bottom-1x">
    <span class="alert-close" data-dismiss="alert"></span>
    <i class="icon-alert-triangle"></i>&nbsp;&nbsp;<span class="text-medium"></span> Algo ha ocurrido por favor vuelve a recargar esta pagina.
  </div>
<?php    
  }
?>

<?php 

  unset($GetDocumentLines);   
  unset($ResponseGetDocumentLines);   
}
else{
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/SessionExpired.php';
}
 ?>