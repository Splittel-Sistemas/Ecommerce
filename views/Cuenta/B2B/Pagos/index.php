<?php 
@session_start();
if(isset($_SESSION['Ecommerce-ClienteKey']))
{
    $fecha1 = isset($_REQUEST['fecha1']) && $_REQUEST['fecha1'] != null ? $_REQUEST['fecha1'] : date('Y-01-01');
    $fecha2 = isset($_REQUEST['fecha2']) && $_REQUEST['fecha2'] != null ? $_REQUEST['fecha2'] : date('Y-m-d');
?>
<div class="col-lg-12">
    <div class="row">
        <!-- <form action="mi_cuenta.php?idc=3" method="get">
            <div class="form-group">
                <div class="custom-control  custom-control-inline">
                <input class="form-control form-control-sm" type="text" value="" id="ex-radio-4" name="fecha1" placeholder="Fecha">
                <input class="form-control form-control-sm" type="hidden" value="3" name="idc" placeholder="Fecha">
                </div>
                <div class="custom-control  custom-control-inline">
                <input class="form-control form-control-sm" type="text" value="" id="ex-radio-5" name="fecha2"  placeholder="Fecha">
                </div>
                <div class="custom-control  custom-control-inline">
                <input class="btn btn-sm btn-outline-primary" type="submit" id="ex-radio-6" name="radio2" value="Consultar" onclick="">
                </div>
            </div> 
        </form> -->
    </div>
    <!-- <hr class="margin-bottom-1x"> -->
    <div id="clienteB2B_listContainer">
    <?php 
        include 'List.php';
    ?>
    </div>
</div>

<div class="modal fade" id="ClienteB2B_documentos_list">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Lista de documentos</h4>
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
}
else{
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/SessionExpired.php';
}
?>