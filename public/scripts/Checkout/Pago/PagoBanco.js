var PagarPedidoBanco = function(Elem){ 
		let monedaPago = getChecked('.monedaPago')
		let pagoBanco = document.getElementById('pagoBanco')
		let paqueteria = document.getElementById('paqueteria')
		let check = document.getElementById('check')
		let transportationCodeAux = transportationCode
		let referencia = document.getElementById('referencia-pedido-resumen')
		let cfdiUser   = document.getElementById('CFDIUser')
		let regimenfiscalAux = document.getElementById("RegimenFiscal");
		let requiereFactura   = document.getElementById('RequiereFactura')
		let checkDatosEnvio       = getChecked('.datosEnvio')
		let checkDatosFacturacion = getChecked('.datosFacturacion')
				checkDatosFacturacion = requiereFactura.checked ? checkDatosFacturacion : '' 
				OpenPayMetodoPago = 'banco'
				let regimenfiscal =requiereFactura.checked ? regimenfiscalAux.value : ""
		let data = {
			Action : "PagoBanco", 
			ActionOpenPay : true, 
			datosEnvio : checkDatosEnvio,
			datosFacturacion : checkDatosFacturacion,
			paqueteria : check.value + paqueteria.value,
			transportationCode: transportationCodeAux,
			monedaPago : monedaPago,
			metodoPago : OpenPayMetodoPago,
			CFDIUser : cfdiUser.value,
			RegimenFiscal : regimenfiscal,
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