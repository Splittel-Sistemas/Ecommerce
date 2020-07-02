/**
 * Listar datos de facturación 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var ListDatosFacturacion = function() {
	ajaxViews('../../views/Cuenta/B2C/DatosFacturacion/List.php', 'POST', 'HTML', {}, 
	function(response){
		document.getElementById('List-datosFacturacion').innerHTML = response
		GlobalInitialDatatableSimple('table-datosFacturacion')
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
			ListDatosFacturacion()
			GlobalCloseModal('modal-datos-facturacion')
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
	ajaxViews('../../views/Cuenta/B2C/DatosFacturacion/Create.php', 'POST', 'HTML', {}, 
	function(response){
		GlobalOpenModal('modal-datos-facturacion')
		document.getElementById('modal-body-datos-facturacion').innerHTML = response
	})
}
/**
 * Mostrar formulario para actualización información
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var editarFormDatosFacturacion = function(Elem) {
	ajaxViews('../../views/Cuenta/B2C/DatosFacturacion/Create.php', 'POST', 'HTML', { DatosFacturacionKey: Elem.getAttribute('DatosFacturacionKey') }, 
	function(response){
		GlobalOpenModal('modal-datos-facturacion')
		document.getElementById('modal-body-datos-facturacion').innerHTML = response
	})
}

GlobalInitialDatatableSimple('table-datosFacturacion')