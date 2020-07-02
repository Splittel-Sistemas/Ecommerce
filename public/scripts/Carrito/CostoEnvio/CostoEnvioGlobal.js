var solicitar = function(Elem){
	swal({
		title: "¿Estas seguro?",
		text: "Recuerda que una vez solicitado el costo de envio no podras modificar tu pedido!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			CostoEnvio()
		} 
	});
}

var CostoEnvio = function(){
	ajax_("../../models/Pedido/Pedido.Route.php", "post", "json", 
	{ 
		Action: 'solicitarCostoEnvio', 
		ActionPedido: true,
		datosEnvio: getChecked('.datosEnvio')
	}, 
	function(response){
		if(!response.error){
			if(document.getElementById('ListProductosCarrito')){
				ListProductosCarrito_()
			}
			LisResumenProductosCarrito_()
			GlobalCloseModal('modal-carrito-list-datos-envio')
			swal("Se ha solicitado correctamente costo de envio! En breve un ejecutivo asignara un costo de envío a tu pedido, "+
			"te enviaremos un email para confirmarte. Tu pedido estará disponible en las cotizaciones en Mi cuenta.", {
				icon: "success",
			});
		}
	})
}