var ClienteB2C_list_detalle_cotizacion = function(Elem){
  GlobalOpenModal('ClienteB2C_list_detalle')
  ajax_(
    "../../views/Cuenta/B2C/Pendientes/Detalle.php", 
    "post", 
    "html", 
    { 
        CotizacionKey : Elem.getAttribute('CotizacionKey'),
    }, 
    function(response) {
      document.getElementById('ClienteB2C_list_detalle_body').innerHTML = response
      GlobalInitialDatatableSimple('TableDetalleB2C');
    })    
}