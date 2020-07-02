/**
 * Listar datos de envió 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var ListDatosEnvio = function(Elem) {
  ajaxViews('../../views/Cuenta/B2C/DatosEnvio/List.php', 'POST', 'HTML', {}, 
  function(response){
    document.getElementById('List-datosEnvio').innerHTML = response
    GlobalInitialDatatableSimple('table-datosEnvio')
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
      GlobalCloseModal('modal-datos-envio')
      ListDatosEnvio()
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
  ajaxViews('../../views/Cuenta/B2C/DatosEnvio/Create.php', 'POST', 'HTML', {}, 
  function(response){
    GlobalOpenModal('modal-datos-envio')
    document.getElementById('modal-body-datos-envio').innerHTML = response
  })
}
/**
 * Mostrar formulario para actualización información 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var EditarFormDatosEnvio = function(Elem) {
  ajaxViews('../../views/Cuenta/B2C/DatosEnvio/Create.php', 'POST', 'HTML', { DatosEnvioKey: Elem.getAttribute('DatosEnvioKey') }, 
  function(response){
    GlobalOpenModal('modal-datos-envio')
    document.getElementById('modal-body-datos-envio').innerHTML = response
  })
}

GlobalInitialDatatableSimple('table-datosEnvio')