var sendDataEnvioCliente = function(elem) {
  ajax_("../../models/B2C/Cuenta/DatosEnvio.php", "POST", "JSON", $('#form-data-envio').serialize(), 
  function(response) {
    if (!response.error) {
      templateAlert(response.typeError, "", response.message, "topRight", "icon-check-circle")
      ListDatosEnvioCliente()
    }else{
      templateAlert(response.typeError, "", response.message, "topRight", "icon-slash")
    }
  })
}

var showFormEdit = function(elem){
  ajax_(
  "../../views/Cuenta/B2C/DatosEnvio/Create.php", 
  "post", 
  "html", 
  { ClienteEnvioKey: elem.getAttribute('ClienteEnvioKey')}, 
  function(response) {
    GlobalOpenModal('modal-create-update')
    // document.getElementById('modal-create-update-body').innerHTML = ""
    document.getElementById('modal-create-update-body').innerHTML = response
  })
}

var showFormNew = function(elem){
  ajax_(
  "../../views/Cuenta/B2C/DatosEnvio/Create.php", 
  "post", 
  "html", 
  { }, 
  function(response) {
    GlobalOpenModal('modal-create-update')
    // document.getElementById('modal-create-update-body').innerHTML = ""
    document.getElementById('modal-create-update-body').innerHTML = response
  })
}

var ListDatosEnvioCliente = function(){
  ajax_(
  "../../views/Cuenta/B2C/DatosEnvio/List.php", 
  "post", 
  "html", 
  { }, 
  function(response) {
    GlobalCloseModal('modal-create-update')
    document.getElementById('ListDatosEnvio').innerHTML = ""
    document.getElementById('ListDatosEnvio').innerHTML = response
  })
}

GlobalInitialDatatableSimple('TableDatosEnvio')