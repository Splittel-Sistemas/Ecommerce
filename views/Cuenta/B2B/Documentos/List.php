<?php 

  /***
   * [0]
   * [20]
   * []
   * [400]
   */
  if (!class_exists("GetListDocumentosByBussinessPartner")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/BussinesPartner/GetListDocumentosByBussinessPartner.php';
  }
  // echo "hola";
  $GetListDocumentosByBussinessPartner = new GetListDocumentosByBussinessPartner();
  try {
    $GetListDocumentosByBussinessPartner->FechaInicial = $fecha1;
    $GetListDocumentosByBussinessPartner->FechaFin = $fecha2;
    $responseGetListDocumentosByBussinessPartner = (object)$GetListDocumentosByBussinessPartner->get(false)->GetListDocumentosByBussinessPartnerResult;
    $ErrorCode = $responseGetListDocumentosByBussinessPartner->ErrorCode;
  } catch (Exception $e) {
    $ErrorCode = -100;
  }
  if($ErrorCode == 0){
    if($responseGetListDocumentosByBussinessPartner->Count > 0){
?>
    <div class="table-responsive-sm">
        <table class="table table-hover" id="table_clienteB2B_documentos_1">
            <thead >
              <tr>
                <th>#</th>
                <th>Fecha Creaci&oacute;n</th>
                <th>Total USD</th>
                <th>Tipo</th>
                <th>Detalle</th>
                <th>Estatus</th>
              </tr>
            </thead>
            <tbody>
      <?php
      $i=1;
            foreach ($responseGetListDocumentosByBussinessPartner->Records->Document_ as $documento) { ?>
                <tr>
                  <td><?php echo $documento->DocNum; ?></td>
                  <td><?php echo date("d-m-Y",strtotime($documento->DocDate)); ?></td>
                  <td>$<?php echo number_format($documento->DocTotal,2) ?></td>
                  <td><?php echo $documento->DocType; ?></td>
                  <td>
                      <button id="btn-<?php echo $documento->DocEntry; ?>" class="btn btn-sm btn-outline-primary" onclick="ClienteB2B_list_documentos_showDetalles('<?php echo $documento->DocEntry; ?>','<?php echo $documento->DocType; ?>');">ver</button>
                  </td>
                  <td>Entregado</td>
                </tr>
        <?php 
        $i++;
                } 
        ?>
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
    include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/ErrorProcessWS.php';
  }
 ?>
