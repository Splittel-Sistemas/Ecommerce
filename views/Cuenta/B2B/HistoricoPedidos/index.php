<?php
    /**
     * [0]      Informacion obtenida                                    ok
     * [20]     Error al conectar con SAP DI API                        --  
     * [50]     Error al autentificarse con SAP DI API                  --
     * [100]    No existen docuementos                                  ok
     * [400]    Error del sistema                                       --
     */
    @session_start();
    if(isset($_SESSION['Ecommerce-ClienteKey'])){
        if (!class_exists("GetOrdersByCustomer")) {
            include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/BussinesPartner/GetOrdersByCustomer.php';
        }
        $GetOrdersByCustomer = new GetOrdersByCustomer();
        try {
            $ResponseGetOrdersByCustomer = $GetOrdersByCustomer->get(false)->GetOrdersByCustomerResult;
            // print_r($ResponseGetOrdersByCustomer);
            $ErrorCode = $ResponseGetOrdersByCustomer->ErrorCode;
        } catch (SoapFault $fault) {
            $ErrorCode = -100;
        }
        if($ErrorCode == 0){
            if($ResponseGetOrdersByCustomer->Count > 0){
                $ResponseEnProceso = $ResponseGetOrdersByCustomer->Records;
                if(sizeof($ResponseEnProceso->Document_) == 1){
                    $DocumentsOrders [] = $ResponseEnProceso->Document_;
                }else{
                    $DocumentsOrders = $ResponseEnProceso->Document_;
                }

?>
                <div class="col-lg-12">
                    <div id="clienteB2B_listContainer">
                        <div class="table-responsive table-hover mb-0">
                            <table class="table cell-border" id="table_clienteB2B_documentos1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Sap</th>
                                        <th class="text-center">Fecha creación</th>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Moneda</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  foreach ($DocumentsOrders as $Doc) { ?>
                                    <tr data-child-value="<?php echo $Doc->Status ?>">
                                        <td class="text-center"><?php echo $Doc->DocNumEcommerce ?></td>
                                        <td class="text-center"><?php echo $Doc->DocNum ?></td>
                                        <td class="text-center"><?php echo date("d-m-Y",strtotime($Doc->DocDate)) ?></td>
                                        <td class="text-center">$<?php echo number_format($Doc->DocTotal,2) ?></td>
                                        <td class="text-center"><?php echo $Doc->DocCur ?></td>
                                        <td class="text-center">Entregado</td>
                                        <td class="text-center">
                                            <span class="text-info cursor-point" onclick="ClienteB2B_list_documentos_showDetalles('<?php echo $Doc->DocEntry ?>','<?php echo $Doc->DocType ?>');">
                                                <i class="icon-file-text"></i>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="ClienteB2B_documentos_list">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Detalle documento</h4>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                            </div>
                            <div class="modal-body" id="ClienteB2B_documentos_list_body">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="ClienteB2B_documentos_list_det">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Detalle documento</h4>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                            </div>
                            <div class="modal-body" id="ClienteB2B_documentos_list_det_body">

                            </div>
                        </div>
                    </div>
                </div>

<?php
            }else{
?>
                <div class="alert alert-warning alert-dismissible fade show text-center margin-bottom-1x">
                    <span class="alert-close" data-dismiss="alert"></span>
                    <i class="icon-alert-triangle"></i>&nbsp;&nbsp;<span class="text-medium">Alerta:</span> Registros no encontrados
                </div>
<?php
            }
        }else if($ErrorCode == 100){
?>
            <div class="alert alert-info alert-dismissible fade show text-center margin-bottom-1x">
                <span class="alert-close" data-dismiss="alert"></span>
                <i class="icon-help-circle"></i> No existen documentos aún.
            </div>
<?php
        }else{
            include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/ErrorProcessWS.php';
        }
    }else{
        include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/SessionExpired.php';
    }


?>

        