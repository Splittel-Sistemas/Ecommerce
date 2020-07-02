
<?php 
@session_start();
if(isset($_SESSION['Ecommerce-ClienteKey']))
{
?>
<div class="col-lg-12">
    <div id="clienteB2B_listContainer">
    <?php include 'List.php'; ?>
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
    include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/SessionExpired.php';
}
?>