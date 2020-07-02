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
        if (!class_exists("EnProceso")) {
            include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/BussinesPartner/EnProceso.php';
        }
        $EnProceso = new EnProceso();
        try {
            $ResponseEnProceso = $EnProceso->get(false)->GetOrdersInProcessEcommerceResult;
			// print_r($ResponseEnProceso);
            $ErrorCode = $ResponseEnProceso->ErrorCode;
        } catch (SoapFault $fault) {
            $ErrorCode = -100;
        }
        if($ErrorCode == 0){
            $ResponseEnProceso = $ResponseEnProceso->Records;
        
            if(sizeof($ResponseEnProceso->Document_) == 1){
                $DocumentsOrders [] = $ResponseEnProceso->Document_;
            }else{
                $DocumentsOrders = $ResponseEnProceso->Document_;
            }
?>
        <style>
            @import url('//cdn.datatables.net/1.10.2/css/jquery.dataTables.css');
            td.details-control {
                background: url('http://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
                cursor: pointer;
            }
            tr.shown td.details-control {
                background: url('http://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
            }
        </style>
        <div class="col-lg-12">
            <div id="clienteB2B_listContainer">
                <div class="table-responsive table-hover mb-0">
                    <table class="table cell-border" id="table_clienteB2B_documentos1">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">Status</th>
                                <th class="text-center align-middle">Pedido</th>
                                <th class="text-center align-middle">Fecha Creación</th>
                                <th class="text-center align-middle">Total</th>
                                <th class="text-center align-middle">Moneda</th>
                                <th class="text-center align-middle">Número de guía</th>
                                <th class="text-center align-middle">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
// print_r($DocumentsOrders);
        foreach ($DocumentsOrders as $Doc) {
?>
                            <tr data-child-value="<?php echo $Doc->Status ?>">
                                <td class="details-control"></td>
                                <td class="text-center align-middle"><?php echo $Doc->DocNumEcommerce ?></td>
                                <td class="text-center align-middle"><?php echo date("d-m-Y",strtotime($Doc->DocDate)) ?></td>
                                <td class="text-center align-middle">$<?php echo number_format($Doc->DocTotal,2) ?></td>
                                <td class="text-center align-middle"><?php echo $Doc->DocCur ?></td>
                                <?php if(!empty($Doc->TrackNo)){ ?>
                                <td class="text-center align-middle">
                                    <a href="../Order/index.php?PaqueteriaKey=<?php echo $Doc->Paqueteria?>&PedidoKey=<?php echo $Doc->DocNumEcommerce?> " class="text-danger" target="_blank">
                                        <i class="icon-map-pin"></i>
                                    </a>
                                </td>
                                <?php }else{ ?>
                                <td class="text-center align-middle">--</td>
                                <?php } ?>
                                <td class="text-center align-middle">
                                    <span class="text-info cursor-point" onclick="ClienteB2B_list_documentos_showDetalles('<?php echo $Doc->DocEntry ?>','<?php echo $Doc->DocType ?>');">
                                        <i class="icon-file-text"></i>
                                    </span>
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
        <div class="modal fade" id="ClienteB2B_documentos_list">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Lista Partidas</h4>
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
        }else if($ErrorCode == 100){
?>
        <div class="alert alert-warning alert-dismissible fade show text-center margin-bottom-1x">
            <span class="alert-close" data-dismiss="alert"></span>
            <i class="icon-alert-triangle"></i>&nbsp;&nbsp;<span class="text-medium">Alerta:</span> <?php echo $ResponseEnProceso->ErrorDescription; ?>
        </div>
<?php
        }else{
            include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/ErrorProcessWS.php';
        }
        unset($EnProceso);
        unset($ResponseEnProceso);
    }else{
        include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/SessionExpired.php';
    }
?>