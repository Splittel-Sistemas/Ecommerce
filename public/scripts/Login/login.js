/**
 * Registro nuevo cliente
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var Registro = function() {
  ajax_('../../models/Cliente/Cliente.Route.php', 'POST', 'JSON', $('#form-registro').serialize(), 
  function(response){
    if (!response.error) {
      toastAlert(response.typeError, '', response.message, 'topLeft', "icon-check-circle")
      window.location.href = "../Login/password_recovery.php";
    }else{
      toastAlert('danger', '', response.message, 'topLeft', 'icon-ban')
    }
  })
}
/**
 * Validación Contraseña
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var ValidarPassword = function(Elem) {
  ajax_('../../models/Cliente/Cliente.Route.php', 'POST', 'JSON', 
  {
    Action: 'validatePassword',
    ActionCliente: true,
    Password : Elem.value
  }, 
  function(response){

      var elemento = ''
    document.getElementById("lista-especificaciones").innerHTML = ''
    $.each(response.items, function(i, item) {
      console.log(item)
      elemento += 
      '<a class="list-group-item item-product text-'+item.color+'" href="">'+
        ''+item.descripcion+''+
      '</a>'
    });
    document.getElementById("lista-especificaciones").innerHTML = elemento
    
    
  })
}

/**
 * Validación Contraseña
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var QuitarLista = function() {
  document.getElementById("lista-especificaciones").innerHTML = ''
}

/**
 * Inicio de sesión
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var Login = function() {
  let url = document.getElementById('url')
  ajax_('../../models/Login/Login.Route.php', 'POST', 'JSON', $('#form-login').serialize(), 
  function(response){
    if (!response.error) {
      toastAlert(response.typeError, '', response.message, 'topLeft', "icon-check-circle")
      window.location.href = url.value == '' ? '../Home' : url.value
    }else{
      toastAlert('danger', '', response.message, 'topLeft', 'icon-ban')
    }
  })
}

/**
 * Recovery
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var Recovery = function() {
  let url = document.getElementById('url')
  ajax_('../../models/Login/Login.Route.php', 'POST', 'JSON', $('#RecoveryForm').serialize(), 
  function(response){
    if (!response.error) {
      toastAlert(response.typeError, '', response.message, 'topLeft', "icon-check-circle")
      $('#RecoveryForm')[0].reset();
    }else{
      toastAlert('danger', '', response.message, 'topLeft', 'icon-ban')
    }
  })
}

/**
 * Validate
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var Validate = function() {
  let url = document.getElementById('url')
  ajax_('../../models/Login/Login.Route.php', 'POST', 'JSON', $('#ValidateForm').serialize(), 
  function(response){
    if (!response.error) {
      toastAlert1(response.typeError, '', response.message, 'topLeft', "icon-check-circle")
      $('#ValidateForm')[0].reset();
    }else{
      toastAlert('danger', '', response.message, 'topLeft', 'icon-ban')
    }
  })
}