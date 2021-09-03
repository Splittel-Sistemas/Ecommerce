// function de ajax global para el uso del mismo
var ajaxViews = function(url, method, type, data, success){
  $.ajax({
    url: url,
    method: method, 
    data : data,
    dataType: type,
    success: function(response){ 
      if(response != null && success != null){
        success(response);
      }              
    },
    error: function( jqXHR, textStatus, errorThrown){
      console.log("Error: " + errorThrown,"Hubo un error en la llamada:  " + url + " | " + textStatus)
    }
  });
};

var ajax_ = function(url, method, type, data, success){
  $.ajax({
    url: url,
    method: method, 
    data : data,
    dataType: type,
    beforeSend: function(xhr){
      Elem = document.getElementById('dataInterna')      
      xhr.setRequestHeader('Authorization', "Basic " + btoa(Elem.getAttribute('primero') + ":" + Elem.getAttribute('segundo'))); 
      $('#customizer-backdrop').addClass('active')
    },
    success: function(response){ 
      if(response != null && success != null){
        success(response);
        $('#customizer-backdrop').removeClass('active')
      }              
    },
    error: function( jqXHR, textStatus, errorThrown){
      console.log("Error: " + errorThrown,"Hubo un error en la llamada:  " + url + " | " + textStatus)
      $('#customizer-backdrop').removeClass('active')
    }
  });
};

var ajax_button_modal = function(url, method, type, data, success,button,modal_id){
  $.ajax({
    url: url,
    method: method, 
    data : data,
    dataType: type,
    beforeSend: function(){
      document.getElementById(modal_id).innerHTML = ""
      document.getElementById(modal_id).innerHTML = '<center><div class="spinner-grow text-primary m-2" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Loading...</span></div></center>'
    },
    success: function(response){ 
      if(response != null && success != null){
        success(response);
      }              
    },
    error: function( jqXHR, textStatus, errorThrown){
      console.log("Error: " + errorThrown,"Hubo un error en la llamada:  " + url + " | " + textStatus)
    }
  });
};

var altura = function(classs) {
  let altura_arr = [];
  $(classs).each(function(){//RECORREMOS TODOS LOS CONTENEDORES, DEBEN TENER LA MISMA CLASE
    let altura_elems = $(this).height(); //LES SACAMOS LA ALTURA
    altura_arr.push(altura_elems);//METEMOS LA ALTURA AL ARREGLO
  });


  //OBTENCIÓN DE LA ALTURA MAS GRANDE
  let newAltura; 
  for (let i = altura_arr.length - 1; i >= 0; i--) {
    if (altura_arr[i+1] > altura_arr[i]) {
      newAltura = altura_arr[i+1]
    }else{
      newAltura = altura_arr[i]
    }
  }

  $(classs).each(function(){//RECORREMOS DE NUEVO LOS CONTENEDORES
    $(this).css('height',newAltura);//LES PONEMOS A TODOS LOS CONTENEDORES LA ALTURA QUE ES EL MAS GRANDE.
  });
}


var templateAlert = function(classs, title, message, position, icon){
  let configiziToast = {
    class: "iziToast-" + classs || "",
    title: title,
    message: message,
    animateInside: !1,
    position: position,
    progressBar: !1,
    icon: icon,
    timeout: 5000,
    transitionIn: "fadeInLeft",
    transitionOut: "fadeOut",
    transitionInMobile: "fadeIn",
    transitionOutMobile: "fadeOut"
  };
  iziToast.show(configiziToast);
}

var Alerts = function(Element, Type, Message) {
  let alert = ""
  switch(Type){
    case 'primary' :
      alert = '<div class="alert alert-primary alert-dismissible fade show text-center margin-bottom-1x">'+
              '<span class="alert-close" data-dismiss="alert"></span><i class="icon-camera"></i>&nbsp;&nbsp;'+
                Message+
              '</div>';
      break;
    case 'info' :
      alert = '<div class="alert alert-info alert-dismissible fade show text-center margin-bottom-1x">'+
              '<span class="alert-close" data-dismiss="alert"></span><i class="icon-layers"></i>&nbsp;&nbsp;'+
                Message+
              '</div>';
      break;
    case 'success' :
      alert = '<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x">'+
              '<span class="alert-close" data-dismiss="alert"></span><i class="icon-check-circle"></i>&nbsp;&nbsp;'+
                Message+
              '</div>';
      break;
    case 'warning' :
      alert = '<div class="alert alert-warning alert-dismissible fade show text-center margin-bottom-1x">'+
              '<span class="alert-close" data-dismiss="alert"></span><i class="icon-bell"></i>&nbsp;&nbsp;'+
                Message+
              '</div>';
      break;
     case 'danger' :
      alert = '<div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x">'+
              '<span class="alert-close" data-dismiss="alert"></span><i class="icon-ban"></i>&nbsp;&nbsp;'+
                Message+
              '</div>';
      break;
  }
    document.getElementById(Element).innerHTML = alert
          
}


/**
 *  raphael-2.1.4.min.js
 * @param {*} element 
 */
var GlobalOpenModal = function(element){
  $("#" + element).modal("show");
}
/**
 *  raphael-2.1.4.min.js
 * @param {*} element 
 */
var GlobalOpenModal_ = function(element){
  $("#" + element).modal({
    show: true,
    backdrop: false,
  });
}
/**
* 
* @param {*} element 
*/
var GlobalCloseModal = function(element){
   $("#" + element).modal("hide");
}
/**
* 
*/
var GlobalInitialDatatable = function(element){
var table = $('#' + element).DataTable({
    "language": { "url": "public/plugins/DataTables/locales/Spanish.json" },
    "dom": 'Bfrtip',
    "buttons": [
        'excel', 'pdf'
    ],
    "autoWidth": false,
    orderCellsTop: true,
    fixedHeader: true,
    "order": [[ 0, "desc" ]]
});

$('#'+element+' thead tr').clone(true).appendTo( '#'+element+' thead' );
$('#'+element+' thead tr:eq(1) th').each( function (i) {
    
    if(i < $('#'+element+' thead tr:eq(1) th').toArray().length){
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control input-sm" placeholder="Buscar en '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    }
    
} );
}

var GlobalInitialDatatableSimple = function(element){
  var table = $('#' + element).DataTable({
      "language": { "url": "../../public/plugins/DataTables/locales/Spanish.json" },
      "dom": 'Bfrtip',
      "info":     false,
       buttons: [
          {
              extend:    'excelHtml5',
              // text:      '<i class="socicon-amazon"></i>',
              titleAttr: 'Exportar Excel'
          },
          {
              extend:    'pdfHtml5',
              // text:      '<i class="socicon-amazon"></i>',
              titleAttr: 'Exportar PDF'
          }
      ],
      "autoWidth": false,
      "searching": false,
      orderCellsTop: true,
      fixedHeader: true,
      "order": [[ 0, "desc" ]]
  });

  return table
}


var GlobalInitialDatatableSimple1 = function(element, position){
  var table = $('#' + element).DataTable({
      "language": { "url": "../../public/plugins/DataTables/locales/Spanish.json" },
      "dom": 'Bfrtip',
      "info":     false,
       buttons: [
          {
              extend:    'excelHtml5',
              // text:      '<i class="socicon-amazon"></i>',
              titleAttr: 'Exportar Excel'
          },
          {
              extend:    'pdfHtml5',
              // text:      '<i class="socicon-amazon"></i>',
              titleAttr: 'Exportar PDF'
          }
      ],
      "autoWidth": false,
      "searching": false,
      orderCellsTop: true,
      fixedHeader: true,
      "order": [[ position, "desc" ]]
  });

  return table
}

var GlobalInitialDatatableSimple_ = function(element){
  var table = $('#' + element).DataTable({
      "language": { "url": "../../public/plugins/DataTables/locales/Spanish.json" },
      "dom": 'Bfrtip',
      buttons: [
        'excelHtml5',
        'pdfHtml5'
      ],
      "autoWidth": false,
      "searching": false,
  });
  return table
}

var GlobalInitialDatatable_ = function(element){
  var table = $('#' + element).DataTable({
      "language": { "url": "../../public/plugins/DataTables/locales/Spanish.json" },
  });
  return table
}

var toastAlert = function(classs, title, message, position, icon){
  let configiziToast = {
    class: "iziToast-" + classs || "",
    title: title,
    message: message,
    animateInside: !1,
    position: position,
    progressBar: !1,
    icon: icon,
    timeout: 3200,
    transitionIn: "fadeInLeft",
    transitionOut: "fadeOut",
    transitionInMobile: "fadeIn",
    transitionOutMobile: "fadeOut"
  };
  iziToast.show(configiziToast);
}

var CleanSpaces = function(str) {
  while (str.indexOf(" ") > -1) {
    str = str.replace(" ", "");
  }
  return str;
}

var getChecked = function(Elem){
  let value 
  $(Elem).each(function(index, el) {
    if ($(this).is(":checked")) {
      value = $(this).val()
    }
  });
  return value
}

var Buscador = function(Elem){
  if (!(Elem.value == "") ) {
    ajaxViews("../../views/Partials/Search.php", "POST", "HTML", { Descripcion: Elem.value }, 
    function(response){
      document.getElementById("lista-productos-"+Elem.getAttribute("movil")).innerHTML = response
    })
  }else{
    document.getElementById("lista-productos-"+Elem.getAttribute("movil")).innerHTML = ""
  }
}

var scrollTop = function(Elem){
  $(Elem).animate({scrollTop:0}, 'slow');
}

var showMunicipios = function(Elem, SelectId){
  ajax_(
  "../../views/Config/Municipios.php", 
  "post", 
  "html", 
  { CiudadKey: Elem.value }, 
  function(response) {
    document.getElementById(SelectId).innerHTML = ""
    document.getElementById(SelectId).innerHTML = response
  })
}

/**
 * cmabio de contraseña para los clientes que inician sesión por primera vez
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var changePassword = function(){
  let PersonalPassword = document.getElementById('PersonalPassword')
  let PersonalPasswordConfirm = document.getElementById('PersonalPasswordConfirm')
  let data = { 
    Action: 'cambiarPassword',
    ActionCliente: true,
    Password: PersonalPassword.value,
    ConfirmarPassword: PersonalPasswordConfirm.value
  }
  if(document.getElementById('PersonalTerminos')){
    let PersonalTerminos = document.getElementById('PersonalTerminos')
    data['PersonalTerminos'] = PersonalTerminos.checked
  }
  ajax_(
  '../../models/Cliente/Cliente.Route.php', 
  'post', 
  'json', 
  data,
  function(response){
    if (!response.error) {
      templateAlert(response.typeError, "", response.message, "topCenter", "icon-help-circle")
      if(document.getElementById('PersonalTerminos')){
        window.location.href = "../Home/";
      }
    }else{
      templateAlert("warning", "", response.message, "topCenter", "icon-slash")
    }
  })
}


$(window).keydown(function(event){
  if(event.keyCode == 13) {
    event.preventDefault();
    return false;
  }
});


var BuscarProductos = function(Elem){
  if (!(Elem.value == "") ) {
    ajaxViews("../../views/Partials/Search.php", "POST", "HTML", { Descripcion: Elem.value }, 
    function(response){
      document.getElementById("lista-productos-"+Elem.getAttribute("movil")).innerHTML = response
    })
  }else{
    document.getElementById("lista-productos-"+Elem.getAttribute("movil")).innerHTML = ""
  }
}

var LineaCreditoTipoCambio = function(Elem){
  if(Elem.checked){
    GlobalOpenModal_('modal-datos-generar-codigo-verificacion')
    ajax_("../../models/Pedido/Pedido.Route.php", "POST", "HTML", 
    { 
      Action: 'lineaCredito', 
      ActionPedido: true, 
      EncabezadoLineaCredito: Elem.checked 
    }, 
    function(response){
      console.log(response)
    })
  }
}

var EmailCatalogo = function(Elem){
  gtag('event', 'conversion', {'send_to': 'AW-1069545026/ixqYCIPh0MIBEMLs__0D'}); 
  ajax_("../../models/Catalogos/Cursos.php", "POST", "JSON", $('#form-catalogo').serialize(), 
  function(response){
    if (!response.error) {
      $('.catalogo').val('')
      templateAlert(response.typeError, '', 'En breve iniciará tu descarga', 'topRight', 'check-circle')
      var a = document.createElement('a');
      var url = 'https://fibremex.com/fibra-optica/public/catalogos/Fibremex-Catálogo 2021.pdf';
      a.href = url;
      a.download = 'Fibremex-Catálogo 2021.pdf';
      document.body.append(a);
      a.click();
      a.remove();
      window.URL.revokeObjectURL(url);
    }else{
      templateAlert('warning', '', response.message, 'topRight', 'alert-triangle')
    }
  })
  
}

var EmailCursos = function(Elem){
  ajax_("../../models/Catalogos/Cursos.php", "POST", "JSON", $('#form-cursos').serialize(), 
  function(response){
    if (!response.error) {
      $('.cursos').val('')
      templateAlert(response.typeError, '', response.message, 'topRight', 'check-circle')
    }else{
      templateAlert('warning', '', response.message, 'topRight', 'alert-triangle')
    }
  })
}

var EmailBoletin = function(Elem){
  ajax_("../../models/Catalogos/Cursos.php", "POST", "JSON", $('#form-boletin').serialize(), 
  function(response){
    if (!response.error) {
      $('.boletin').val('')
      templateAlert(response.typeError, '', response.message, 'topRight', 'check-circle')
    }else{
      templateAlert('warning', '', response.message, 'topRight', 'alert-triangle')
    }
  })
}


if ($('.tamano_carrito_resumen').height() > 400) {
  $('.tamano_carrito_resumen').addClass('scroll_1')
}


var RestartOWLCarousel = function(){
  $('.owl-carousel').owlCarousel('destroy')
  $('.owl-carousel').owlCarousel({
      items: 1,
      dots: false,
      loop: !1,
      nav: !1,
      navText: [],
      slideBy: 1,
      lazyLoad: !1,
      autoplay: !1,
      autoplayTimeout: 4e3,
      responsive: {},
      animateOut: !1,
      animateIn: !1,
      smartSpeed: 450,
      navSpeed: 450
  });
}


function validacionCantidad(Elem){//Solo numeros
  if(Elem.value.length >= 5){
    Elem.value = Elem.value.substring(0,5)
  }
}

function validacionCantidad_(Elem, Tamano){//Solo numeros
  if(Elem.value.length >= Tamano){
    Elem.value = Elem.value.substring(0,Tamano)
  }
}

$( ".myclass" ).keypress(function(e) {
  var key = window.Event ? e.which : e.keyCode
  console.log(key)
  if(key >= 48 && key <= 57){

  }else{
    return false
  }
});

// instanciate new modal
var modal = new tingle.modal({
  footer: true,
  stickyFooter: false,
  closeMethods: ['overlay', 'button', 'escape'],
  closeLabel: "Close",
  cssClass: ['custom-class-1', 'custom-class-2'],
  onOpen: function() {
    console.log('modal open');
  },
  onClose: function() {
    console.log('modal closed');
  },
  beforeClose: function() {
    // here's goes some logic
    // e.g. save content before closing the modal
    return true; // close the modal
    return false; // nothing happens
  }
});


var facturacionBb2MXP = function(Elem){
  if(Elem.getAttribute('cliente') == "B2B"){
    if(Elem.value == "MXP"){
      document.getElementById("credito-cliente-b2b").style.display = "none";
      document.getElementById("linea_credito").checked = false;
    }else{
      document.getElementById("credito-cliente-b2b").style.display = "block";
    }
  }
}