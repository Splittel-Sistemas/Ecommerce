var EnviarPregunta =  function(){
    let Nombre  = document.getElementById('Nombre')
    let Correo  = document.getElementById('Correo')
    let Titulo  = document.getElementById('Titulo')
    let Categoria  = document.getElementById('Categoria')
    let Pregunta  = document.getElementById('Pregunta')
	ajax_("../../models/Solicitud/Consultecnico/Pregunta.Route.php", "POST", "JSON", 
	{ 
        Action: 'create', 
        ActionPregunta : true,
		Nombre : Nombre.value,
        Correo : Correo.value,
        Titulo : Titulo.value,
        Categoria : Categoria.value,
        Pregunta : Pregunta.value,
	}, 
	function(response){
        if(!response.error){
            GlobalCloseModal('modal-consultecnico')
            window.location.href = "index.php?Categoria="+Categoria.value
        }
	})
}

var EnviarMensaje =  function(Elem){
    let Mensaje  = document.getElementById('Mensaje-'+Elem.getAttribute('preguntakey'))
	ajax_("../../models/Solicitud/Consultecnico/Mensaje.Route.php", "POST", "JSON", 
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