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
		console.log(response)   
	})
}

var EnviarMensaje =  function(){
    let Mensaje  = document.getElementById('Mensaje')
	ajax_("../../models/Solicitud/Consultecnico/Mensaje.Route.php", "POST", "JSON", 
	{ 
        Action: 'create', 
        ActionMensaje : true,
		Mensaje : Mensaje.value,
        PreguntaKey: 1,
	}, 
	function(response){
		console.log(response)   
	})
}