var EnviarSolicitud =  function(){
    let Nombre  = document.getElementById('Nombre')
    let Correo  = document.getElementById('Correo')
    let Monto  = document.getElementById('Monto')
    let date  = document.getElementById('date')

    
	ajax_("../../models/Solicitud/Ficrece/Solicitud.Route.php", "POST", "JSON", 
	{ 
        Action: 'create', 
        ActionSolicitud : true,
		Nombre : Nombre.value,
        Correo : Correo.value,
        Monto : Monto.value,
        date : date.value,
	}/* , 
	function(response){
        if(!response.error){
            GlobalCloseModal('modal-ficrece')
            window.location.href = "index.php?Categoria="+Categoria.value
        }else{
            templateAlert("danger", "", response.message, "topRight", "")
        }
	} */
    
    )
}

var EnviarMensaje =  function(Elem){
    let Mensaje  = document.getElementById('Mensaje-'+Elem.getAttribute('preguntakey'))
	ajax_("../../models/Solicitud/Ficrece/Mensaje.Route.php", "POST", "JSON", 
	{ 
        Action: 'create', 
        ActionMensaje : true,
		Mensaje : Mensaje.value,
        PreguntaKey: Elem.getAttribute('preguntakey'),
	}, 
	function(response){
        console.log(response)   
        if(!response.error){
            Mensaje.value = ''
            ListarMensajes(Elem.getAttribute('preguntakey'))
        }
	})
}

// var Listar =  function(){
//     ajax_('../../views/Consultecnico/List.php', 'POST', 'HTML', {}, 
//     function(response){
//         document.getElementById('list-consultecnico').innerHTML = response
//     })
// }

// var ListarCategorias =  function(){
//     ajax_('../../views/Consultecnico/categorias.php', 'POST', 'HTML', {}, 
//     function(response){
//         document.getElementById('listar-categorias-consultecnico').innerHTML = response
//     })
// }

var ListarMensajes = function(PreguntaKey){
    ajax_('../../views/Consultecnico/ListarMensajes.php', 'POST', 'HTML', {pregunta: PreguntaKey}, 
    function(response){
        document.getElementById('listar-mensajes-pregunta-'+PreguntaKey).innerHTML = response
    })
}