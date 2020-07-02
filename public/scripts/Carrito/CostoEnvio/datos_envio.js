var elegirDatosEnvioB2C = function(){
	ajaxViews('../../views/Carrito/CostoEnvio/B2C/datos_envio.php', 'POST', 'HTML', {}, 
  function(response){
    GlobalOpenModal('modal-carrito-list-datos-envio')
    document.getElementById('modal-body-carrito-list-datos-envio').innerHTML = response
  })
}

var elegirDatosEnvioB2B = function(){
	ajaxViews('../../views/Carrito/CostoEnvio/B2B/datos_envio.php', 'POST', 'HTML', {}, 
  function(response){
    GlobalOpenModal('modal-carrito-list-datos-envio')
    document.getElementById('modal-body-carrito-list-datos-envio').innerHTML = response
  })
}