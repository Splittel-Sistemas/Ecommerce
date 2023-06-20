var PagarPedidoCredito = function(){
  let monedaPago = getChecked('.monedaPago')
  let paqueteria = document.getElementById('paqueteria')
  let check = document.getElementById('check')
  let transportationCodeAux = transportationCode
  let referencia = document.getElementById('referencia-pedido-resumen')
  let checkDatosEnvio       = getChecked('.datosEnvio')
  let checkDatosFacturacion = getChecked('.datosFacturacion')
  let cfdiUser   = document.getElementById('CFDIUser')
  let contactoNombre   = document.getElementById('datosEnvio-nombre-'+checkDatosEnvio)
  let contactoTelefono   = document.getElementById('datosEnvio-telefono-'+checkDatosEnvio)
  let contactoCorreo   = document.getElementById('datosEnvio-correo-'+checkDatosEnvio)
  ajax_('../../models/Pedido/Pedido.Route.php', 'POST', 'JSON', 
  {
    Action : "pagoCredito", 
    ActionPedido : true, 
    datosEnvio : checkDatosEnvio,
    datosFacturacion : checkDatosFacturacion,
    paqueteria : check.value + paqueteria.value,
    transportationCode: transportationCodeAux,
    monedaPago : monedaPago,
    CFDIUser : cfdiUser.value,
    referencia : referencia.value,
    ContactoNombre : contactoNombre.value,
    ContactoTelefono : contactoTelefono.value,
    ContactoCorreo : contactoCorreo.value,
  }, 
  function(response){
    if (!response.error) {
      // toastAlert('success', '', response.message, 'topRight', "icon-check-circle")
      window.location.href = '../Pedido/Completado.php'
    }else{
      if(response.error && response.ErrorCode == 210){
        toastAlert('danger', '', response.message, 'topRight', 'icon-ban')
      }else{
        window.location.href = '../Pedido/Incompleto.php'
      }
    }
  })
}
/**
 * 
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var Generar = function(){
  ajax_('../../models/Tokens/CodigoVerificacion.Route.php', 'POST', 'JSON', 
  { 
    Action: 'generar', 
    ActionCodigoVerificacion: true, 
  }, 
  function(response){
    toastAlert('success', '', response.message, 'topRight', "icon-check-circle")
    GlobalCloseModal('modal-datos-generar-codigo-verificacion')
    GlobalOpenModal_('modal-datos-verificar-codigo-verificacion')
  })
} 
/**
 * 
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var Verificar = function(){
  ajax_('../../models/Tokens/CodigoVerificacion.Route.php', 'POST', 'JSON', 
  { 
    Action: 'verificar', 
    ActionCodigoVerificacion: true, 
    Codigo: document.getElementById('CodigoV').value
  }, 
  function(response){
    if (!response.error) {
      toastAlert('info', '', response.message, 'topRight', "icon-check-circle")
      GlobalCloseModal('modal-datos-verificar-codigo-verificacion')
    }
  })
} 