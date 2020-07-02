var PedidoDetalleB2B = function(Elem){
	GlobalOpenModal('Pedido-Detalle-B2B')
	ajax_(
		"../../views/Cuenta/B2B/Cotizaciones/detalle.php", 
		"post", 
		"html", 
		{ 
			CotizacionKey : Elem.getAttribute('CotizacionKey'),
		}, 
		function(response) {
			document.getElementById('Pedido-Detalle-B2B-body').innerHTML = ""
			document.getElementById('Pedido-Detalle-B2B-body').innerHTML = response
			GlobalInitialDatatableSimple_('table-cotizaciones-pedido-detalle-b2b');
		})    
}

GlobalInitialDatatableSimple_('table-cotizaciones');