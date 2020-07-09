
var Codigo = "" 
var Puntos = 0

var DatosEnvioPuntosModal = function(Elem){
  Codigo = Elem.getAttribute('codigo')
  Puntos = Elem.getAttribute('puntos')
  GlobalOpenModal("modal-datos-envio")
}
/**
 * Agregar productos
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
*/
var AgregarArticuloPuntos = function() {
  let requiereFactura       = document.getElementById('RequiereFactura')
  let checkDatosEnvio       = getChecked('.datosEnvio')
  let checkDatosFacturacion = getChecked('.datosFacturacion')
      checkDatosFacturacion = requiereFactura.checked ? checkDatosFacturacion : '' 
  let data = {
    Action: 'create-pedido-puntos', 
    ActionPedidoDetalle: true,
    datosEnvio : checkDatosEnvio,
    datosFacturacion : checkDatosFacturacion,
    Codigo: Codigo,
    Puntos: Puntos
  }
  
  // información pedido B2B
  if (document.getElementById('datosEnvio-correo-'+checkDatosEnvio)) {
    let contactoNombre   = document.getElementById('datosEnvio-nombre-'+checkDatosEnvio)
    let contactoTelefono = document.getElementById('datosEnvio-telefono-'+checkDatosEnvio)
    let contactoCorreo   = document.getElementById('datosEnvio-correo-'+checkDatosEnvio)
  
    data['ContactoNombre']    =  contactoNombre.value
    data['ContactoTelefono']  =  contactoTelefono.value
    data['ContactoCorreo']    =  contactoCorreo.value
  }else{
    data['RequiereFactura'] = requiereFactura.checked
  }
  
  ajax_("../../models/Pedido/Detalle.Route.php", "POST", "JSON", data,
  function(response){
    if(!response.error){
      ListProductosPuntos()
      GlobalCloseModal("modal-datos-envio")
      swal("Producto canjeado!", "exitosamente.", "success");
    }else{
      templateAlert("danger", "", response.message, "topRight", "icon-check-circle")
    }
  })
}

/**
 * Listar datos de envió 
 * @return {number} b - Bar
 */
var ListProductosPuntos = function() {
  ajaxViews('../../views/PuntoAPunto/List.php', 'GET', 'HTML', {}, 
  function(response){
    document.getElementById('List-Productos-Puntos').innerHTML = response
  })
}