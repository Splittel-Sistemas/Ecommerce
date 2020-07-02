var ClienteB2B_list_documentos_listDocumentos_table = function(){
    GlobalInitialDatatableSimple('table_clienteB2B_documentos');
}

var ClienteB2B_list_documentos_showDetalles = function(DocEntry,DocType){
    GlobalOpenModal('ClienteB2B_documentos_list')
    ajax_button_modal(
      "../../views/Cuenta/B2B/Documentos/DetalleDocumento.php", 
      "post", 
      "html", 
      { 
          DocEntry : DocEntry,
          DocType : DocType,
      }, 
      function(response) {
        document.getElementById('ClienteB2B_documentos_list_body').innerHTML = ""
        document.getElementById('ClienteB2B_documentos_list_body').innerHTML = response
      },
      ("btn-"+DocEntry),
      "ClienteB2B_documentos_list_body",
    )    
  }
var ClienteB2B_list_documentos_showDetalles_pay = function(DocEntry,DocType){
    GlobalOpenModal('ClienteB2B_documentos_list_det')
    ajax_button_modal(
      "../../views/Cuenta/B2B/Documentos/DetalleDocumento.php", 
      "post", 
      "html", 
      { 
          DocEntry : DocEntry,
          DocType : DocType,
      }, 
      function(response) {
        document.getElementById('ClienteB2B_documentos_list_det_body').innerHTML = ""
        document.getElementById('ClienteB2B_documentos_list_det_body').innerHTML = response
      },
      ("btn-"+DocEntry),
      "ClienteB2B_documentos_list_det_body",
    )    
  }
var ClienteB2B_list_documentos_payment = function(DocEntry,DocDate){
  GlobalOpenModal('ClienteB2B_documentos_list')
  ajax_button_modal(
    "../../views/Cuenta/B2B/Pagos/Documentos.php", 
    "post", 
    "html", 
    { 
        DocEntry : DocEntry,
        DocDate : DocDate,
    }, 
    function(response) {
      document.getElementById('ClienteB2B_documentos_list_body').innerHTML = ""
      document.getElementById('ClienteB2B_documentos_list_body').innerHTML = response
    },
    ("btn-"+DocEntry),
    "ClienteB2B_documentos_list_body",
  )    
}

// ClienteB2B_list_documentos_listDocumentos_table();
var ClienteB2B_list_detalle_cotizacion = function(Elem){
  GlobalOpenModal('ClienteB2B_list_detalle')
  ajax_(
    "../../views/Cuenta/B2B/Pendientes/Detalle.php", 
    "post", 
    "html", 
    { 
        CotizacionKey : Elem.getAttribute('CotizacionKey'),
    }, 
    function(response) {
      document.getElementById('ClienteB2B_list_detalle_body').innerHTML = ""
      document.getElementById('ClienteB2B_list_detalle_body').innerHTML = response
      GlobalInitialDatatableSimple('TablePendientesDetalle');
    })    
}

var AgregarCotizacionActual = function(Elem){
   window.location.href = "../Carrito/index.php?Key="+Elem.getAttribute('CotizacionKey')+" ";
}


var updatePedidoTipoCambio = function(Elem) {
  ajax_("../../models/Cotizacion/Detalle.php", "post", "json", { Action: 'change', ActionDetalle: true, DetalleCotizacionKey: Elem.getAttribute('CotizacionKey') }, 
    function(response){
      if (!response.error) {
        window.location.href = "../Carrito";
      }
    })
}
