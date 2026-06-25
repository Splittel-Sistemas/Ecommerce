<div class="modal" tabindex="-1" id="modal_agregra_cupon">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Cupon</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" name="accion" value="agregar">
                    <div class="form-group">
                        <label for="codigo_cupon">Codigo del Cupon</label>
                        <input type="text" class="form-control" name="codigo">
                    </div>
                    <button type="button" class="btn btn-primary" id="btn_agregra_cupon" onclick="AgregarCupon()">Agregar</button>
                    <div class="spinner-border text-danger" role="status" style="display: none;" id="loading_cupon">
                        <span class="sr-only">Loading...</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>