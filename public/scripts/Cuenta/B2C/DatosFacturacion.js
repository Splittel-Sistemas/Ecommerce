var sendDataEnvioDatosFacturacion = function(elem) {
  ajax_("../../models/B2C/Cuenta/DatosFacturacion.php", "POST", "JSON", $('#form-data-factura').serialize(), 
  function(response) {
    if (!response.error) {
      templateAlert(response.typeError, "", response.message, "topRight", "icon-check-circle")
      ListDatoFacturacionCliente()
    }else{
      templateAlert(response.typeError, "", response.message, "topRight", "icon-slash")
    }
  })
}

var showFormEditDatosFacturacion = function(elem){
  ajax_(
  "../../views/Cuenta/B2C/DatosFacturacion/Create.php", 
  "post", 
  "html", 
  { ClienteFacturaKey: elem.getAttribute('ClienteFacturaKey')}, 
  function(response) {
    GlobalOpenModal('modal-create-update')
    document.getElementById('modal-create-update-body').innerHTML = ""
    document.getElementById('modal-create-update-body').innerHTML = response
  })
}

var showFormNewDatosFacturacion = function(elem){
  ajax_(
  "../../views/Cuenta/B2C/DatosFacturacion/Create.php", 
  "post", 
  "html", 
  { }, 
  function(response) {
    GlobalOpenModal('modal-create-update')
    document.getElementById('modal-create-update-body').innerHTML = ""
    document.getElementById('modal-create-update-body').innerHTML = response
  })
}


var ListDatoFacturacionCliente = function(){
  ajax_(
  "../../views/Cuenta/B2C/DatosFacturacion/List.php", 
  "post", 
  "html", 
  { }, 
  function(response) {
    GlobalCloseModal('modal-create-update')
    document.getElementById('ListDatosFacturacion').innerHTML = ""
    document.getElementById('ListDatosFacturacion').innerHTML = response
  })
}

GlobalInitialDatatableSimple('TableDatosFacturacion')