
var Codigo = "" 
var Puntos = 0
var Existe = 0

var DatosEnvioPuntosModal = function(Elem){
  Codigo = Elem.getAttribute('codigo')
  Puntos = Elem.getAttribute('puntos')
  Existe = Elem.getAttribute('existe')
  Key    = Elem.getAttribute('key')
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
    Puntos: Puntos,
    Existe: Existe,
    Key: Key
  }
  
  // información pedido B2B
  if (document.getElementById('datosEnvio-correo-'+checkDatosEnvio)) {
    let contactoNombre    = document.getElementById('datosEnvio-nombre-'+checkDatosEnvio)
    let contactoTelefono  = document.getElementById('datosEnvio-telefono-'+checkDatosEnvio)
    let contactoCorreo    = document.getElementById('datosEnvio-correo-'+checkDatosEnvio)
    let domicilioCiudad   = document.getElementById('datosEnvio-ciudad-'+checkDatosEnvio)
    let domicilioCalle    = document.getElementById('datosEnvio-calle-'+checkDatosEnvio)
    let domicilioNoExt    = document.getElementById('datosEnvio-noExterior-'+checkDatosEnvio)
    let domicilioColonia  = document.getElementById('datosEnvio-colonia-'+checkDatosEnvio)
  
    data['ContactoNombre']    =  contactoNombre.value
    data['ContactoTelefono']  =  contactoTelefono.value
    data['ContactoCorreo']    =  contactoCorreo.value
    data['DomicilioCiudad']   =  domicilioCiudad.innerHTML
    data['DomicilioCalle']    =  domicilioCalle.innerHTML
    data['DomicilioNoExt']    =  domicilioNoExt.innerHTML
    data['DomicilioColonia']  =  domicilioColonia.innerHTML
  }else{
    data['RequiereFactura'] = requiereFactura.checked
  }

  console.log(data)
  
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