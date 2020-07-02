var PagarPedidoBanco = function(Elem){ 
		let monedaPago = getChecked('.monedaPago')
		let pagoBanco = document.getElementById('pagoBanco')
		let paqueteria = document.getElementById('paqueteria')
		let referencia = document.getElementById('referencia-pedido-resumen')
		let cfdiUser   = document.getElementById('CFDIUser')
		let requiereFactura   = document.getElementById('RequiereFactura')
		let checkDatosEnvio       = getChecked('.datosEnvio')
		let checkDatosFacturacion = getChecked('.datosFacturacion')
				checkDatosFacturacion = requiereFactura.checked ? checkDatosFacturacion : '' 
				OpenPayMetodoPago = pagoBanco.checked ? 'banco' : 'tarjeta'
		let data = {
			Action : "PagoBanco", 
			ActionOpenPay : true, 
			datosEnvio : checkDatosEnvio,
			datosFacturacion : checkDatosFacturacion,
			paqueteria : paqueteria.value,
			monedaPago : monedaPago,
			metodoPago : OpenPayMetodoPago,
			CFDIUser : cfdiUser.value,
			referencia : referencia.value
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
	
		ajax_('../../models/OpenPay/OpenPay.Route.php', 'POST', 'JSON', data, 
		function(response){
			if (!response.error) {
				// toastAlert('success', '', response.message, 'topRight', "icon-check-circle")
				window.location.href = '../Pedido/Completado.php?method=bank'
			}else{
				// toastAlert('danger', '', response.message, 'topRight', 'icon-ban')
				window.location.href = '../Pedido/Incompleto.php'
			}
		})
	}