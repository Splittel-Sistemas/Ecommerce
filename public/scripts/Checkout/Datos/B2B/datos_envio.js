	var ListDatosEnvioCheckoutB2B = function(elem){
		ajaxViews('../../views/Checkout/B2B/datos_envio.php', "post", "html", { }, 
		function(response) {
			document.getElementById('PartialCheckout-1').innerHTML = response
		})
	}

	var mostrarFormDatosEnvioB2B = function(elem){
		ajaxViews("../../views/Checkout/B2B/DatosEnvio/create.php", "post", "html", { }, 
		function(response) {
			GlobalOpenModal('modal-datos')
    		document.getElementById('modal-body-datos').innerHTML = response
		})
	}

	var sendDataEnvioB2B = function(elem) {
		let NombreDireccion = document.getElementById('NombreDireccion')
		let Calle = document.getElementById('Calle')
		let NumeroExterior = document.getElementById('NumeroExterior')
		let Colonia = document.getElementById('Colonia')
		let CodigoPostal = document.getElementById('CodigoPostal')
		let Estado = document.getElementById('Estado')
		let Delegacion = document.getElementById('Delegacion')
		let x = document.getElementById("Estado").selectedIndex;
		let y = document.getElementById("Estado").options;

		let EstadoDescripcion = y[x].text
		ajax_("../../models/WebService/BussinesPartner/AddNewAddressBussinesPartner.php", "POST", "JSON",
		{
			Action: 'create',
			ActionEnvio: true,
			TipoDireccion: 'ShipTo',
			NombreDireccion: NombreDireccion.value,
			Calle: Calle.value,
			NumeroExterior: NumeroExterior.value,
			Colonia: Colonia.value,
			CodigoPostal: CodigoPostal.value,
			Estado: Estado.value,
			EstadoDescripcion: EstadoDescripcion,
			Delegacion: Delegacion.value
		}, 
		function(response) {
			console.log(response)
			response = response.AddNewAddressBussinesPartnerResult
			if (response.ErrorCode == 0) {
				templateAlert(response.ErrorType, "", 'Registrado exitosamente', "topRight", "icon-check-circle")
				GlobalCloseModal('modal-datos')
				ListDatosEnvioCheckoutB2B()
			}else{
				templateAlert('danger', "", 'No se pudo registrar!', "topRight", "icon-slash")
			}
		})
	}

	function countChars(obj){
    const longitudMax = 50;
    const longitudAct = obj.value.length;
	const contador = document.getElementById("contador");
    contador.innerHTML = `${longitudAct}/${longitudMax}`;
	}