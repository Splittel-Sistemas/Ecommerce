/**
 * Listar datos de facturación 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var ListDatosFacturacionCheckout = function() {
	ajaxViews('../../views/Checkout/B2C/datos_envio.php', 'POST', 'HTML', {},
	function(response){
		document.getElementById('PartialCheckout-1').innerHTML = response
	})
}
/**
 * Nuevo registro datos de facturación 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var nuevoRegistroDatosFacturacion = function(Elem) {
	ajax_('../../models/Cuenta/B2C/DatosFacturacion.Route.php', 'POST', 'JSON', $('#form-datos-facturacion').serialize(), 
	function(response){
		if (!response.error) {
			toastAlert('success', '', response.message, 'topRight', 'icon-check-circle')
			ListDatosFacturacionCheckout()
			GlobalCloseModal('modal-datos')
		}else{
			toastAlert('info', '', response.message, 'topRight', 'icon-help-circle')
			scrollTop('.modal')
		}
	})
}
/**
 * Mostrar formulario para creación de un nuevo registro 
 *
 * @return {number} b - Bar
 */
var mostrarFormDatosFacturacion = function() {
	ajaxViews('../../views/Checkout/B2C/DatosFacturacion/create.php', 'POST', 'HTML', {}, 
	function(response){
		GlobalOpenModal('modal-datos')
		document.getElementById('modal-body-datos').innerHTML = response
	})
}
