/**
 * Listar datos de envió 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var ListDatosEnvioCheckout = function(Elem) {
  ajaxViews('../../views/Checkout/B2C/datos_envio.php', 'POST', 'HTML', {}, 
  function(response){
    document.getElementById('PartialCheckout-1').innerHTML = response
  })
}
/**
 * Nuevo registro datos de envió 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var nuevoRegistroDatosEnvio = function() {
  ajax_('../../models/Cuenta/B2C/DatosEnvio.Route.php', 'POST', 'JSON', $('#form-datos-envio').serialize(), 
  function(response){
    if (!response.error) {
      toastAlert('success', '', response.message, 'topRight', 'icon-check-circle')
      GlobalCloseModal('modal-datos')
      ListDatosEnvioCheckout()
    }else{
      toastAlert('info', '', response.message, 'topRight', 'icon-help-circle')
      scrollTop('.modal')
    }
  })
}
/**
 * Mostrar formulario para creación de un nuevo registro 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var mostrarFormDatosEnvio = function() {
  ajaxViews('../../views/Checkout/B2C/DatosEnvio/create.php', 'POST', 'HTML', {}, 
  function(response){
    GlobalOpenModal('modal-datos')
    document.getElementById('modal-body-datos').innerHTML = response
  })
}