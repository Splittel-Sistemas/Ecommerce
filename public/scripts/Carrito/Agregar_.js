/**
 * Agregar productos fijos
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
*/
var AgregarArticulo = function(Elem){
	let Descuento = Elem.getAttribute('descuento')
	let Codigo    = Elem.getAttribute('codigo')
	let CantidadValidacion  = Elem.getAttribute('validacion') ? 1 : 0
	let Cantidad  = document.getElementById('ProductoCantidad-'+Codigo)
	ajax_("../../models/Pedido/Detalle.Route.php", "POST", "JSON", 
	{ 
		Action: 'create', 
		ActionPedidoDetalle: true, 
		Cantidad: Cantidad.value, 
		Codigo: Codigo, 
		Descuento: Descuento, 
		CantidadValidacion : CantidadValidacion
	}, 
	function(response){
		if (!response.error) {
			templateAlert("success", "", "Se agrego correctamente el producto", "topRight", "icon-check-circle")
			if(document.getElementById('ListProductosCarrito')){
				ListProductosCarrito_()
			}
			LisResumenProductosCarrito_()
		}else{
			templateAlert("danger", "", response.message, "topRight", "icon-slash")
		}    
	})
}

/**
 * Agregar productos fijos-configurables
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
*/
var AgregarArticuloFijoConfigurable = function(Elem){
	let Descuento = Elem.getAttribute('descuento')
	let Codigo    = Elem.getAttribute('codigo')
	let CantidadValidacion  = Elem.getAttribute('validacion') ? 1 : 0
	let Cantidad  = document.getElementById('quantity')
	ajax_("../../models/Pedido/Detalle.Route.php", "POST", "JSON", 
	{ 
		Action: 'create', 
		ActionPedidoDetalle: true, 
		Cantidad: Cantidad.value, 
		Codigo: Codigo, 
		Descuento: Descuento, 
		CantidadValidacion : CantidadValidacion
	}, 
	function(response){
		if (!response.error) {
			templateAlert("success", "", "Se agrego correctamente el producto", "topRight", "icon-check-circle")
			if(document.getElementById('ListProductosCarrito')){
				ListProductosCarrito_()
			}
			LisResumenProductosCarrito_()
		}else{
			templateAlert("danger", "", response.message, "topRight", "icon-slash")
		}    
	})
} 

var AgregarArticuloConfigurable = function(Elem){
	let Codigo  			= document.getElementById('CodeClave')
	let CodigoConfigurable  = document.getElementById('CodeConfigurable')
	let Cantidad            = document.getElementById('quantity')
	let Descuento 			= Elem.getAttribute('descuento')
	let CantidadValidacion  = Elem.getAttribute('validacion') ? 1 : 0
	let Precio              = document.getElementById('CostoProducto')

	ajax_("../../models/Pedido/Detalle.Route.php", "POST", "JSON", 
	{ 
		Action: 'create-configurable', 
		ActionPedidoDetalle: true, 
		Cantidad: Cantidad.value, 
		Codigo: Codigo.value, 
		CodigoConfigurable: CodigoConfigurable.value, 
		Descuento: Descuento, 
		Precio: Precio.value, 
		CantidadValidacion : CantidadValidacion
	}, 
	function(response){
		if (!response.error) {
			templateAlert("success", "", "Se agrego correctamente el producto", "topRight", "icon-check-circle")
		}else{
			templateAlert("danger", "", response.message, "topRight", "icon-check-circle")
		}
		
		if(document.getElementById('ListProductosCarrito')){
			ListProductosCarrito_()
		}
		LisResumenProductosCarrito_()
	})
} 


var ListProductosCarrito_ = function(){
	ajax_("../../views/Carrito/List.php", "POST", "HTML", {  },  
	function(response){
		document.getElementById('ListProductosCarrito').innerHTML = response
	})
}

var LisResumenProductosCarrito_ = function(){
	ajax_("../../views/Carrito/Resumen/index.php", "POST", "HTML", {  },  
	function(response){
		document.getElementById('ListResumenProductosCarrito').innerHTML = response
		document.getElementById('ListResumenProductosCarritoMovil').innerHTML = response
		if ($('.tamano_carrito_resumen').height() > 400) {
			$('.tamano_carrito_resumen').removeClass('scroll_1').addClass('scroll_1')
		}
	})
}

var DeleteProducto = function(Key, Codigo) {
  ajax_("../../models/Pedido/Detalle.Route.php", "POST", "JSON", 
  { 
	Action: 'delete', 
  	ActionPedidoDetalle: true, 
  	Key: Key, 
	Codigo: Codigo 
  }, 
  function(response){
    if (!response.error) {
      if (document.getElementById('ListProductosCarrito')) {
        ListProductosCarrito_()
      }
      LisResumenProductosCarrito_()
      document.getElementById('AlertFinishPedido').innerHTML = ""
      document.getElementById('AlertFinishPedidoWarning').innerHTML = ""
    }
  })
}

var FinishPedido = function(Elem) {
  if(Elem.getAttribute('costo') == 0 || Elem.getAttribute('requiere') == 0){
    let Subtotal = Elem.getAttribute("subtotal")
    if (Subtotal > 0) {
      let Existencia = Elem.getAttribute("existencia")
      if (Existencia == 0) {
        Existencia = Elem.getAttribute("existencia1")
        if (Existencia == 0) {
          window.location.href = "../Checkout/"
        }else{
          document.getElementById('AlertFinishPedido').innerHTML = ""
          document.getElementById('AlertFinishPedidoWarning').innerHTML = ""
          Alerts("AlertFinishPedidoWarning", "warning", "No tenemos el sufuciente stock... por el momento no puedes continuar con el proceso de tu pedido")
        }
      }else{
        document.getElementById('AlertFinishPedido').innerHTML = ""
        document.getElementById('AlertFinishPedidoWarning').innerHTML = ""
        Alerts("AlertFinishPedido", "danger", "No hay existencia de stock... por el momento no puedes continuar con el proceso de tu pedido")
      }
    }else{
      document.getElementById('AlertFinishPedido').innerHTML = ""
      document.getElementById('AlertFinishPedidoWarning').innerHTML = ""
      Alerts("AlertFinishPedido", "info", "Debes agregar productos para poder continuar...")
    }
  }else{
    document.getElementById('AlertFinishPedido').innerHTML = ""
    document.getElementById('AlertFinishPedidoWarning').innerHTML = ""
    Alerts("AlertFinishPedido", "info", "Tu pedido no cuenta aún con costo de envio")
  }
}