var sendDataDocumento = function(elem) {
  ajax_(".../../models/B2C/Cuenta/Documentos.php", "POST", "JSON", $('#form-data-documento').serialize(), 
  function(response) {
    if (!response.error) {
      templateAlert(response.typeError, "", response.message, "topRight", "icon-check-circle")
      ListDatosDocumento()
    }else{
      templateAlert(response.typeError, "", response.message, "topRight", "icon-slash")
    }
  })
}

var showFormEditDocumento = function(elem){
  ajax_(
  "../../views/Cuenta/B2C/Documentos/Create.php", 
  "post", 
  "html", 
  { DocumentoKey: elem.getAttribute('DocumentoKey')}, 
  function(response) {
    GlobalOpenModal('modal-create-update')
    document.getElementById('modal-create-update-body').innerHTML = ""
    document.getElementById('modal-create-update-body').innerHTML = response
  })
}

var showFormNewDocumento = function(elem){
  ajax_(
  "../../views/Cuenta/B2C/Documentos/Create.php", 
  "post", 
  "html", 
  { }, 
  function(response) {
    GlobalOpenModal('modal-create-update')
    document.getElementById('modal-create-update-body').innerHTML = ""
    document.getElementById('modal-create-update-body').innerHTML = response
  })
}

var ListDatosDocumento = function(){
  ajax_(
  "../../views/Cuenta/B2C/Documentos/List.php", 
  "post", 
  "html", 
  { }, 
  function(response) {
    GlobalCloseModal('modal-create-update')
    document.getElementById('content_cuenta').innerHTML = ""
    document.getElementById('content_cuenta').innerHTML = response
    GlobalInitialDatatableSimple('table-Documento')
  })
}

var ListInforCotizacion = function(elem){
  ajax_(
  "../../views/Cuenta/B2C/Documentos/InfoCotizacion.php", 
  "post", 
  "html", 
  { DocumentoKey: elem.getAttribute('DocumentoKey')}, 
  function(response) {
    GlobalOpenModal('modal-create-update')
    document.getElementById('modal-create-update-body').innerHTML = ""
    document.getElementById('modal-create-update-body').innerHTML = response
    GlobalInitialDatatableSimple('TableInfoCotizacion')
  })
}

GlobalInitialDatatableSimple('TableDocumento')