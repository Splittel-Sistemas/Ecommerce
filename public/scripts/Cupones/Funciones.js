function AgregarCupon() {
    $('#btn_agregra_cupon').prop('disabled', true);

    const accion = $('#modal_agregra_cupon').find('form').find('input[name="accion"]').val().trim();
    const codigo = $('#modal_agregra_cupon').find('form').find('input[name="codigo"]').val().trim();

    if (accion.trim() == '' || codigo.trim() == '') {
        $('#btn_agregra_cupon').prop('disabled', false);
        templateAlert("warning", "", "No se a escrito un codigo de cupon.", "topCenter", "icon-slash");
        return;
    }

    $.ajax({
        url: "../../models/Cupones/Cupones.Router.php",
        method: "POST",
        data: {
            accion,
            codigo
        },
        dataType: 'json',
        beforeSend: function () {
            $('#loading_cupon').css('display', 'inline-block');
        },
        success: function (response) {
            if (response.respuesta) {
                $('#loading_cupon').css('display', 'none');
                templateAlert("success", "", response.mensaje, "topCenter", "icon-slash");

                setTimeout(() => {
                    window.location.reload(true);
                }, 1000);
            } else {
                templateAlert("warning", "", response.mensaje, "topCenter", "icon-slash");
                $('#btn_agregra_cupon').prop('disabled', false);
                $('#loading_cupon').css('display', 'none');
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            templateAlert("danger", "", "Error inesperado en la consulta.", "topCenter", "icon-slash");
            $('#btn_agregra_cupon').prop('disabled', false);
            $('#loading_cupon').css('display', 'none');
        },
    });
}

function MostarModalAgregarCupon() {
    $('#modal_agregra_cupon').modal('show');
}