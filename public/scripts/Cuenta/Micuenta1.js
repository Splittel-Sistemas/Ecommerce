var Menu = function(){
  // ajax_("../../views/"+Elem.getAttribute("url")+"", "POST", "HTML", {  }, 
  // function(response){
  //   $('.menu-class').removeClass("active")
  //   Elem.classList.add("active")
  //   document.getElementById("ContenidoCuenta").innerHTML = response
    GlobalInitialDatatableSimple('TableGetShipToAdress');
    GlobalInitialDatatableSimple1('TableHistoricoPedidos', 2);
    ListDocumentosB2C()
    ListDocumentosB2B()
    ListHistorico()
  // })
}

  function format(value) {
  	  status0=['','Proceso','Surtido','Embarque','Envio'];
  	  status1=['','Proceso','Surtido_1','Embarque_1','Envio_1'];
  	  var i;
  	  var text='';
  		for (i = 1; i <= (status0.length-1); i++) {
  			if(i<=value){
  				text += "<img width='25%' src='../../public/images/img_spl/estatus_cliente/" + status1[i] + ".png'/>";
  			}else{
  				text += "<img width='25%' src='../../public/images/img_spl/estatus_cliente/" + status0[i] + ".png'/>";
  			}
  		}
  	  var resp='';
  	  
  	  
        return '<div class="w-auto p-3">' + text +' </div>';
  }

function format1(value) {
  console.log(value)
    status0=['Proceso','Surtido','Embarque','Envio','Entregado'];
    status1=['Proceso','Surtido_1','Embarque_1','Envio_1','Entregado_1'];
    var i;
    var text='';
    for (i = 0; i <= (status0.length-1); i++) {
      if(i<=value){
        text += "<img width='20%' src='../../public/images/img_spl/estatus_cliente/" + status1[i] + ".png'/>";
      }else{
        text += "<img width='20%' src='../../public/images/img_spl/estatus_cliente/" + status0[i] + ".png'/>";
      }
    }
    var resp='';
    
    
      return '<div class="w-auto p-3">' + text +' </div>';
  }

  var ListDocumentosB2C = function(){
    var table = GlobalInitialDatatableSimple('pedidos')

      // Add event listener for opening and closing details
      $('#pedidos').on('click', 'td.details-control', function () {
          var tr = $(this).closest('tr');
          var row = table.row(tr);

          if (row.child.isShown()) {
              // This row is already open - close it
              row.child.hide();
              tr.removeClass('shown');
          } else {
              // Open this row
              ajax_("../../models/WebService/Document/GetOrderStatusEcommerce.php", "post", "json", { Action: 'get', DocNumEcommerce: this.getAttribute('DocNumEcommerce') }, 
              function(response){
                  status0=['','Proceso','Surtido','Embarque','Envio'];
                  status1=['','Proceso','Surtido_1','Embarque_1','Envio_1'];
                  var i;
                  var text='';
                  for (i = 1; i <= (status0.length-1); i++) {
                    if(i<=response.GetOrderStatusEcommerceResult.Value){
                      text += "<img width='25%' src='../../public/images/img_spl/estatus_cliente/" + status1[i] + ".png'/>";
                    }else{
                      text += "<img width='25%' src='../../public/images/img_spl/estatus_cliente/" + status0[i] + ".png'/>";
                    }
                  }
                  row.child('<div class="w-auto p-3">' + text +' </div>').show();
                  // var resp='';
                  // newFormat(text)
              })
              tr.addClass('shown');
          }
      });
  }

  var ListDocumentosB2B = function(){
    var table = GlobalInitialDatatableSimple1('table_clienteB2B_documentos1', 1)

      // Add event listener for opening and closing details
      $('#table_clienteB2B_documentos1').on('click', 'td.details-control', function () {
        console.log('click')
          var tr = $(this).closest('tr');
          var row = table.row(tr);

          if (row.child.isShown()) {
              // This row is already open - close it
              row.child.hide();
              tr.removeClass('shown');
          } else {
              // Open this row
              row.child(format1(tr.data('child-value'))).show();
              tr.addClass('shown');
          }
      });
  }

  var ListHistorico = function(){
    GlobalInitialDatatableSimple('table_clienteB2B_documentos_1')
  }