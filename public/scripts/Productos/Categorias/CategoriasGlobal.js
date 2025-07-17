var RemoveOptionsSelect = function(Elem, Options){
  for (var i = 0; i < Options.length; i++) {
    Elem.remove(Options[i]-i)    
  }
}
/**
 * Remover Opción elemento select
 *
 * @param {Object} Elem
 * @param {Integer} Option position select
 *
 */
var RemoveOptionSelect = function(Elem, Option){
  Elem.remove(Option)    
}
/**
 * Remover Elemento
 *
 * @param {Object} Elem
 *
 */
var RemoveElement = function(Elem){
  Elem.innerHTML = ""  
}
/**
 * Ocultar opciones de un select
 *
 * @param {Object} opt - Foo
 *
 */
var StyleDisplayNoneOrBlock_2 = function(Elem, Propiedad, Options){
  for (var i = 0; i < Options.length; i++) {
    Elem[Options[i]].style.display = Propiedad
  }
}
/**
 * Ocultar un elemento 
 *
 * @param {Object} Elem
 * @param {String} Propiedad -> none o block
 *
 */
var StyleDisplayNoneOrBlock = function(Elem, Propiedad){
    Elem.style.display = Propiedad
}
/**
 * Cambiar titulo 
 *
 * @param {String} Codigo
 *
 */
var nameLabel = function(Text){
  if(document.getElementById('changename'))
    document.getElementById('changename').innerHTML = Text
}
/**
 * Envio de codigo para mostrarlo en el DOM
 *
 * @param {String} Codigo
 *
 */
var showClave = function(Codigo){
	let Clave = document.getElementById('Clave')
  let CodeClave = document.getElementById('CodeClave')
	Clave.innerHTML = Codigo
  CodeClave.value = Codigo
}
/**
 * Description
 *
 * @param {Integers} Numero
 * @param {Integers} TotalDigitos
 *
 * @return {String}   
 */
var NumeroConCeros = function(Numero, TotalDigitos){
  let Ceros = ""
  Numero = Numero * 10
  Numero = Numero.toString()
  TotalCeros = TotalDigitos - Numero.length
  for (var i = 0; i < TotalCeros; i++) {
    Ceros += "0" 
  }
  return Ceros+Numero
}
/**
 * Description
 *
 * @param {Integers} Numero
 * @param {Integers} TotalDigitos
 *
 * @return {String}   
 */
var NumeroConCeros2 = function(Numero, TotalDigitos){
  let Ceros = ""
  Numero = Numero.toString()
  TotalCeros = TotalDigitos - Numero.length
  for (var i = 0; i < TotalCeros; i++) {
    Ceros += "0" 
  }
  return Ceros+Numero
}
/**
 * Description
 *
 * @param {Integers} Numero
 * @param {Integers} TotalDigitos
 *
 * @return {String}   
 */
var NumeroConCeros3 = function(Numero, TotalDigitos){
  let Ceros = ""
  Numero = Numero * 100
  Numero = Numero.toString()
  TotalCeros = TotalDigitos - Numero.length
  for (var i = 0; i < TotalCeros; i++) {
    Ceros += "0" 
  }
  return Ceros+Numero
}
/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var ComprobacionDecimales = function(Elem){
  if (Elem.value.split('.')[1]) {
    if (Elem.value.split('.')[1].length > 1) {
      return false
    }
  }
}
/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var ValidInputRange = function(element,initial, end){
  if(element.value != ''){
    if(element.value >= initial && element.value <= end){
      element.classList.remove('border-danger');
      return true;
    }else{
      element.classList.add('border-danger');
      return false;
    }
  }else{
    element.classList.remove('border-danger');
    return false;
  }
}
/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var agregarFichaTecnica = function(name, descripcion){
 
  return '<button class="btn btn-outline-secondary btn-sm "> '+
    '<a href="../../public/images/img_spl/'+name+'.pdf" target="_blank">'+
      '<i class="icon-download"></i>&nbsp;'+descripcion+''+
    '</a>'+
  '</button>';
  
}
var agregarCertificado = function(name, descripcion){
  return '<button class="btn btn-outline-secondary btn-sm "> '+
    '<a href="'+name+'" target="_blank">'+
      '<i class="icon-download"></i>&nbsp;'+descripcion+''+
    '</a>'+
  '</button>';
}
/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var agregarMiniCatalogo = function(Codigo, descripcion){
  return '<button class="btn btn-outline-secondary btn-sm "> '+
    '<a href="../../public/images/img_spl/productos/'+Codigo+'/Mini Catalogo/.pdf" target="_blank">'+
      '<i class="icon-download"></i>&nbsp;'+descripcion+''+
    '</a>'+
  '</button>';
}
/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var ListImgProducto = function(DirectorioImgProducto){
  ajax_(
  '../../views/Productos/index.php', 
  'post', 
  'html', 
  { DirectorioImgProducto: DirectorioImgProducto }, 
  function(response){
    document.getElementById('showcarousel').innerHTML = "";
    document.getElementById('showcarousel').innerHTML = response;
    RestartOWLCarousel()

  })
}
/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var ListImgProductoOnly = function(DirectorioImgProducto,img_nombre){
  ajax_(
  '../../views/Productos/onlyimage.php', 
  'post', 
  'html', 
  { DirectorioImgProducto: DirectorioImgProducto,nombre:img_nombre }, 
  function(response){
		document.getElementById('showcarousel').innerHTML = "";
		document.getElementById('showcarousel').innerHTML = response;
		RestartOWLCarousel()

  })
}
/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var ChangeListImgProducto = function(DirectorioImgProducto, ImgProducto){
  ajax_(
  '../../views/Productos/FotosConfigurables.php', 
  'post', 
  'html', 
  { DirectorioImgProducto: DirectorioImgProducto, ImgProducto: ImgProducto }, 
  function(response){
    document.getElementById('showcarousel').innerHTML = "";
    document.getElementById('showcarousel').innerHTML = response;
    RestartOWLCarousel()
  })
}
/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var ListProductoDescription = function(DirectorioImgProducto){
  ajax_(
  '../../views/Productos/Informacion/Descripcion/index.php', 
  'post', 
  'html', 
  { DirectorioImgProducto: DirectorioImgProducto }, 
  function(response){
   document.getElementById('description').innerHTML = "";
   document.getElementById('description').innerHTML = response;
  })
}
/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var ListProductoAdicional = function(DirectorioImgProducto){
  ajax_(
  '../../views/Productos/Informacion/Adicional/index.php', 
  'post', 
  'html', 
  { DirectorioImgProducto: DirectorioImgProducto }, 
  function(response){
   document.getElementById('adicional').innerHTML = "";
   document.getElementById('adicional').innerHTML = response;
  })
}

var ListProductoMiniCatalogo = function(DirectorioImgProducto){
  ajax_(
  '../../views/Productos/Informacion/MiniCatalogo/index.php', 
  'post', 
  'html', 
  { DirectorioImgProducto: DirectorioImgProducto }, 
  function(response){
   document.getElementById('add-minicatalogo').innerHTML = "";
   document.getElementById('add-minicatalogo').innerHTML = response;
  })
}
var ListProductoManual = function(DirectorioImgProducto){
  ajax_(
  '../../views/Productos/Informacion/Manual/index.php', 
  'post', 
  'html', 
  { DirectorioImgProducto: DirectorioImgProducto }, 
  function(response){
   document.getElementById('add-manual').innerHTML = "";
   document.getElementById('add-manual').innerHTML = response;
  })
}
/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var VideoProductosCofigurables = function(UrlVideo) {
  let dataVideo = '<a href="#" data-toggle="tooltip" data-type="video" title="Ver video"><div class="wrapper">'+
                    '<div class="video-wrapper"> ' +
                      '<iframe class="pswp__video" class="pswp__video"width="960" height="640" src="'+UrlVideo+'" allow="autoplay" frameborder="0" allowfullscreen>'+
                      '</iframe>'+
                    '</div>'+
                  '</div></a>';
  document.getElementById('video-producto').setAttribute("data-video", dataVideo)
}

var VerPhotoPs = function(Elem){
   var pswpElement = document.querySelectorAll('.pswp')[0];
    var items = []
    $('.PhotoPs').each(function(index, el) {
      items.push({
        src: this.getAttribute('src'),
        w: 1000,
        h: 667
      })
    });

    // define options (if needed)
    var options = {
        // optionName: 'option value'
        // for example:
        index: Elem.getAttribute('option')-1, // start at first slide
        showHideOpacity: true,
        // Adds class pswp__ui--idle to pswp__ui element when mouse isn't moving for 4000ms
        timeToIdle: 4000,

        // Same as above, but this timer applies when mouse leaves the window
        timeToIdleOutside: 1000,

        // Delay until loading indicator is displayed
        loadingIndicatorDelay: 1000,
    };

    // Initializes and opens PhotoSwipe
    var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
    // gallery.destroy()
    gallery.init();
}

var existCodeSapPatchCord = function(Codigo){
  ajax_("../../models/Productos/Producto.Route.php", "POST", "JSON", 
  { 
    Action: 'get', 
    ActionProducto: true, 
    Codigo: Codigo
  }, 
  function(response){
    let Stock='';
    if(document.getElementById('add-stock')){
     Stock = document.getElementById('add-stock')
        Stock.innerHTML = ""
    }
    if (!response.error && response.count > 0) {
      let resultResponse = response.records[0]
      let DescripcionLarga = document.getElementById('descripcionLarga')
      let Descripcion_CEO = document.getElementById('descripcionCEO')
      let DescPrdConf = document.getElementById('DscProductoConfigurable')
        // agregar stock
        if(document.getElementById('add-stock'))
          Stock.innerHTML = resultResponse.ProductoExistencia
        // agregar descricpión larga
        //console.log(resultResponse)
        DescripcionLarga.innerHTML = resultResponse.DescripcionLarga
        if(resultResponse.DescripcionCeo){
        Descripcion_CEO.innerHTML = resultResponse.DescripcionCeo.replace(/(?:\r\n|\r|\n)/g, '<br>');
        }else{
          Descripcion_CEO.innerHTML = '';
        }
        if(resultResponse.ProductoDescripcion){
          DescPrdConf.innerHTML = resultResponse.ProductoDescripcion.replace(/(?:\r\n|\r|\n)/g, '<br>');
          }else{
            DescPrdConf.innerHTML = '';
          }

        let Precio = resultResponse.Descuento > 0 
          ? resultResponse.ProductoPrecio - (resultResponse.ProductoPrecio * (resultResponse.Descuento /100)) 
          : resultResponse.ProductoPrecio 
        if(document.getElementById('btn-fijo'))
          StyleDisplayNoneOrBlock(document.getElementById('btn-fijo'), 'block')
        if(document.getElementById('btn-configurable'))
          StyleDisplayNoneOrBlock(document.getElementById('btn-configurable'), 'none')
        if(document.getElementById('div-quantity'))
          StyleDisplayNoneOrBlock(document.getElementById('div-quantity'), 'block')
        if(document.getElementById('div-longitud'))
          StyleDisplayNoneOrBlock(document.getElementById('div-longitud'), 'none')
        if(document.getElementById('precio-longitud'))
        document.getElementById('precio-longitud').value = Precio
        
        if(document.getElementById('btn-fijo')){
          document.getElementById('btn-fijo').setAttribute('descuento', resultResponse.Descuento)
          document.getElementById('btn-fijo').setAttribute('codigo', resultResponse.ProductoCodigo)
        }
        if(document.getElementById('Costo')){
          if(CurrencySite=='USD'){
          document.getElementById('Costo').innerHTML = 'Precio: $ '+Precio+' USD '
          }else{
             precio1 = (Precio*CurrencyRate).toFixed(3)
          document.getElementById('Costo').innerHTML = 'Precio: $ '+precio1+' MXN'
          }
        }

        let FichaTecnicaTecnica = document.getElementById('add-ficha-tecnica-mini-catalogo')
        FichaTecnicaTecnica.innerHTML =''
        
      if((resultResponse.FichaRuta != '' && resultResponse.FichaRuta!=null)){
        
        FichaTecnicaTecnica.innerHTML = agregarFichaTecnica(resultResponse.FichaRuta, 'Ficha Técnica')
      }
      if((resultResponse.Certificado != '' && resultResponse.Certificado!=null)){
       // let FichaTecnicaTecnica = document.getElementById('add-ficha-tecnica-mini-catalogo')
        FichaTecnicaTecnica.innerHTML += agregarCertificado(resultResponse.Certificado, 'Certificado de pruebas')
      }

   }else{
    StyleDisplayNoneOrBlock(document.getElementById('btn-fijo'), 'none')
    StyleDisplayNoneOrBlock(document.getElementById('btn-configurable'), 'block')
   }
  })
  StockEnTransito(Codigo)
}

// -----

/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var hhh = 0 
var existEcommerce_ = function(Codigo){
  hhh = 1
  ajax_("../../models/Productos/Producto.Route.php", "POST", "JSON", 
  { 
    Action: 'get', 
    ActionProducto: true, 
    Codigo: Codigo
  }, 
  function(response){
    //console.log(response);
    if (!response.error && response.count > 0) {
      let resultResponse =  response.records[0]
      let DescripcionLarga = document.getElementById('descripcionLarga')
      let Descripcion_CEO = document.getElementById('descripcionCEO')
      let Stock = document.getElementById('add-stock')
      let DescPrdConf = document.getElementById('DscProductoConfigurable')
 //console.log(resultResponse);
      // agregar stock
      if(Stock)
        if(resultResponse.ProductoExistencia!='' && resultResponse.ProductoExistencia>0)
          Stock.innerHTML = resultResponse.ProductoExistencia
          else
          Stock.innerHTML = '0.00'
      // agregar descricpión larga
      DescripcionLarga.innerHTML = resultResponse.DescripcionLarga
      if(resultResponse.DescripcionCeo){
      Descripcion_CEO.innerHTML = resultResponse.DescripcionCeo.replace(/(?:\r\n|\r|\n)/g, '<br>');
      }else{
        Descripcion_CEO.innerHTML = '';
      }
      if(resultResponse.ProductoDescripcion){
        DescPrdConf.innerHTML = resultResponse.ProductoDescripcion.replace(/(?:\r\n|\r|\n)/g, '<br>');
        }else{
          DescPrdConf.innerHTML = '';
        }
      // agregar ficha técnica
      let FichaTecnicaTecnica = document.getElementById('add-ficha-tecnica-mini-catalogo')
      if((resultResponse.FichaRuta != '' && resultResponse.FichaRuta!=null)){
        FichaTecnicaTecnica.innerHTML = agregarFichaTecnica(resultResponse.FichaRuta, 'Ficha Técnica')
      }else{
        FichaTecnicaTecnica.innerHTML = '';
      }
      if((resultResponse.Certificado != '' && resultResponse.Certificado!=null)){
       // let FichaTecnicaTecnica = document.getElementById('add-ficha-tecnica-mini-catalogo')
        FichaTecnicaTecnica.innerHTML += agregarCertificado(resultResponse.Certificado, 'Certificado de pruebas')
      }

      if(resultResponse.ProductoPrecio > 0){
        let Precio = resultResponse.Descuento > 0 
        ? resultResponse.ProductoPrecio - (resultResponse.ProductoPrecio * (resultResponse.Descuento /100)) 
        : resultResponse.ProductoPrecio 
        StyleDisplayNoneOrBlock(document.getElementById('btn-fijo'), 'block')
        StyleDisplayNoneOrBlock(document.getElementById('div-longitud'), 'block')
        StyleDisplayNoneOrBlock(document.getElementById('btn-configurable'), 'none')
        StyleDisplayNoneOrBlock(document.getElementById('div-quantity'), 'none')
        document.getElementById('precio-longitud').value = Precio
        $('#span-leyenda').remove()
  
        document.getElementById('btn-fijo').setAttribute('descuento', resultResponse.Descuento)
        document.getElementById('btn-fijo').setAttribute('codigo', resultResponse.ProductoCodigo)
        if(CurrencySite=='USD'){
        document.getElementById('Costo').innerHTML = 'Precio: $ '+Precio+' USD '
        } else{
          precio1 = (Precio*CurrencyRate).toFixed(3)
        document.getElementById('Costo').innerHTML = 'Precio: $ '+precio1+' MXN'
        }
        nuevoPrecioPorLongitud(document.getElementById('longitud'))
      }else{
        document.getElementById('precio-longitud').value = 0
        ProductoEspecial()
        getDescuentoByFamiliaProductosConfigurables()
      }
    }else{
      ProductoEspecial()
      getDescuentoByFamiliaProductosConfigurables()
      let Stock = document.getElementById('add-stock')
      Stock.innerHTML = '0.00'
      let FichaTecnicaTecnica = document.getElementById('add-ficha-tecnica-mini-catalogo')
       FichaTecnicaTecnica.innerHTML = '';
    }

    StockEnTransito(Codigo)

  })
}

function initializePopovers() {
  $('[data-toggle="popover"]').popover();
}
function initializePopoverss() {
  $('[data-toggle="popovers"]').popover();
}
var StockEnTransito = function(Codigo){
  hhh = 1
  ajax_("../../models/EnTransito/EnTransito.Route.php", "POST", "JSON", 
  { 
    Action: 'get', 
    ActionProducto: true, 
    Codigo: Codigo
  }, 
  function(response){
    //console.log(response);
    
    if (!response.error && response.count > 0) {
      //let resultResponse =  response.records
      let Stock = document.getElementById('add-transito')
      let TextTra=''
      let StockTotal=0; 
      if(Stock){
        TextTra = TextTra +'<span style="color:white;"  class="mt-1 product-badge  bg-info text-white text-body" data-container="body" data-html="true" data-toggle="popover" data-placement="right" data-trigger="hover" title="En tr&aacute;nsito" data-content="<table class=\'table table-striped table-sm\'> <thead>  <tr> <th class=\'text-center\' scope=\'col\'>Cantidad</th>  <th class=\'text-center\' scope=\'col\'>Fecha estimada</th>   </tr> </thead> <tbody> '
        response.records.forEach(function(Responses) {
         
          let fecha = new Date("'"+Responses.Fecha+"'");
          let fechaTexto = fecha.toLocaleDateString('es-MX', {
            timeZone: 'America/Mexico_City',
            year: 'numeric', // año completo
            month: 'long', // nombre del mes
            day: 'numeric' // día del mes
          });
            TextTra = TextTra + '<tr><th class=\'px-3 text-center\' scope=\'row\'>'+Responses.Cantidad+'</th><th class=\'px-3 text-center\' scope=\'row\'>'+fechaTexto+'</th></tr>' 
            StockTotal=StockTotal+Responses.Cantidad

        });
        TextTra = TextTra + '</tbody> </table>" data-original-title=\'En transito\' >En Tránsito: '+StockTotal+' </span>'
        if(StockTotal>0)
          Stock.innerHTML += TextTra;
        else
          Stock.innerHTML = ''
      }
      initializePopovers();
     
    }else{
      let Stock = document.getElementById('add-transito')
      Stock.innerHTML = ''
    }
      
  })
}

var StockPorLote = function(Codigo){
  hhh = 1
  ajax_("../../models/WebService/Ecommerce/GetStockByLote.php", "POST", "JSON", 
  { 
    Action: 'get', 
    ActionProducto: true, 
    Codigo: Codigo
  }, 
  function(response){
    //console.log(response.StockPorLotesResult);
    if (response.StockPorLotesResult && response.StockPorLotesResult.ErrorCode==100) {
      
      let Lote = document.getElementById('add-lote')
      let TextTra=''
      let StockTotal=0; 
      let StockPorLote=0;
      let MetrosXLote=parseInt(response.StockPorLotesResult.InfoCarrete)
      if(Lote){
        Lote.innerHTML = ''
        if(response.StockPorLotesResult.Diccionarios.Diccionario){
        TextTra = TextTra +'<table class=\'table table-striped table-sm\' style=\'padding:0rem;\'> <tr><th class=\'text-center\'  colspan=\'2\'>Informaci&oacute;n de lotes disponibles</th></tr> <tr> <td class=\'text-center\' scope=\'col\'>Cantidad(m)</td>  <td class=\'text-center\' scope=\'col\'>Lote(s)</td>   </tr><tbody> '
        let diccionarios = response.StockPorLotesResult.Diccionarios.Diccionario;
        // Si no es un array, lo convertimos en uno.
        if (!Array.isArray(diccionarios)) {
          diccionarios = [diccionarios]; // Convertimos el objeto en un array con un solo elemento
        }
        
        
        for (let Responses of diccionarios) { 
          
          let Cant= parseInt(Responses.Cantidad);
          let Lotes= parseInt(Responses.Lotes);
          //console.log(Responses.Lotes);
         if(Cant>=100){
            TextTra = TextTra + '<tr class=\'px-3\' style=\'padding:0rem;\'><td style=\'padding:0rem;\' class=\'text-center\' scope=\'row\'>'+Cant+'</td><td style=\'padding:0rem;\' class=\'text-center\' scope=\'row\'>'+Lotes+'</td></tr>' 
         }   
         StockTotal=StockTotal+(Cant*Lotes)
            if(Cant>=MetrosXLote)
               StockPorLote++;

          }
        
        TextTra = TextTra + '</tbody> </table>'
        if(StockPorLote<=0)
          Lote.innerHTML += TextTra;
        else
        Lote.innerHTML = ''
        }
      }
     
    }else{
      let Lote = document.getElementById('add-lote')
      Lote.innerHTML = ''
    }
      
  })
}

var existJumper_ = function(Codigo){
  //console.log(Codigo)
  hhh = 1
  ajax_("../../models/Productos/Producto.Route.php", "POST", "JSON", 
  { 
    Action: 'get', 
    ActionProducto: true, 
    Codigo: Codigo
  }, 
  function(response){
    if (!response.error && response.count > 0) {
      let resultResponse =  response.records[0]
      let Stock = document.getElementById('add-stock')
      let LeyendaConfig = document.getElementById('LeyendaConf')
      //console.log(resultResponse);
      // agregar stock
      if(Stock)
        if(resultResponse.ProductoExistencia!='' && resultResponse.ProductoExistencia>0)
          Stock.innerHTML = resultResponse.ProductoExistencia
          else
          Stock.innerHTML = '0.00'

      if(LeyendaConfig)
        if(resultResponse.Leyenda!='' && resultResponse.Leyenda !== null ){
          LeyendaConfig.innerHTML = resultResponse.Leyenda
          LeyendaConfig.style.display = 'block';
        }else{
          LeyendaConfig.innerHTML = ''
          LeyendaConfig.style.display = 'none';
        }
      
     
    }else{
      let Stock = document.getElementById('add-stock')
      Stock.innerHTML = '0.00'
      let LeyendaConfig = document.getElementById('LeyendaConf')
      LeyendaConfig.innerHTML = ''
          LeyendaConfig.style.display = 'none';
    }
  })
  StockEnTransito(Codigo)
}




var nuevoPrecioPorLongitud = function(Elem){
  document.getElementById('quantity').value = Elem.value
  if (Elem.value > 0 && Elem.value != "") {
    let precio = Elem.value * document.getElementById('precio-longitud').value
    if(CurrencySite=='USD'){
    precio = precio.toFixed(3)
    document.getElementById('Costo').innerHTML = 'Precio: $ '+precio+' USD'
    }else{
      precio = (precio*CurrencyRate).toFixed(3)
    document.getElementById('Costo').innerHTML = 'Precio: $ '+precio+' MXN'
    }
  }
}

var ProductoEspecial = function(){
  StyleDisplayNoneOrBlock(document.getElementById('btn-fijo'), 'none')
  StyleDisplayNoneOrBlock(document.getElementById('btn-configurable'), 'none')
  StyleDisplayNoneOrBlock(document.getElementById('div-quantity'), 'none')
  document.getElementById('Costo').innerHTML = '$0'
  $('#span-leyenda').remove()
  $('#leyenda').append('<div class="col-12 pb-4 mt-4" id="span-leyenda">'+
    '<span class="product-badge bg-danger border-default text-body text-white">'+
      '<p>Producto especial, solicitar cotización a su ejecutivo de ventas</p></span></div>')
}

var NombreProductoConfigurable = function(Codigo, Descripcion){
  if(document.getElementById('CodeConfigurable')){
    ajax_(
    '../../models/Productos/ProductoConfigurable.Route.php', 
    'post', 
    'json', 
    { 
      Action: 'create',
      Codigo: Codigo,
      CodigoConfigurable: document.getElementById('CodeConfigurable').value,
      Descripcion: Descripcion
    }, 
    function(response){
      //console.log(response)
    })
  }
}

var getDescuentoByFamiliaProductosConfigurables = function(){
  ajax_("../../models/Subcategorias/SubcategoriasN1.Route.php", "POST", "JSON", 
  { 
    Action: 'get', 
    ActionSubcategoriasN1: true, 
    Codigo: document.getElementById('CodeConfigurable').value
  }, 
  function(response){
    resultResponse = response.records[0]
    if(document.getElementById('btn-fijo') )
    document.getElementById('btn-fijo').setAttribute('descuento', resultResponse.Descuento)
    if(document.getElementById('btn-configurable'))
    document.getElementById('btn-configurable').setAttribute('descuento', resultResponse.Descuento)
  })
}

if(document.getElementById('CodeConfigurable') && hhh == 0){
  getDescuentoByFamiliaProductosConfigurables()
}

/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var agregarFichaTecnicaConfigurable = function(idFicha){
  //console.log(idFicha)
  let FichaTecnicaTecnica = document.getElementById('add-ficha-tecnica-mini-catalogo')
  FichaTecnicaTecnica.innerHTML ='';
  if(idFicha != ''){
  ajax_("../../models/Productos/ProductoConfigurable.Route.php","POST","json", 
    { 
      Action: 'GetFichaTecnica', 
      CodigoFicha: idFicha
    }, 
    function(response){
      //console.log(response)
      if(response.ruta!=''){
      textFicha='<button class="btn btn-outline-secondary btn-sm "> '+
            '<a href="../../public/images/img_spl/'+response.ruta+'.pdf" target="_blank">'+
              '<i class="icon-download"></i>&nbsp;Ficha Técnica'+
            '</a>'+
          '</button>';
      FichaTecnicaTecnica.innerHTML = textFicha
      }
    
    })
  } 
}

/**
 * Description
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var agregarCertificadoConfigurable = function(codigo){
  let CertificadoPrueba = document.getElementById('add-certificado')
  CertificadoPrueba.innerHTML='';
  if(codigo != ''){
  ajax_("../../models/Productos/ProductoConfigurable.Route.php","POST","json", 
    { 
      Action: 'GetCertificado', 
      CodigoFicha: codigo
    }, 
    function(response){
      
      if(response.certificado!=''){
        textCertificado='<button class="btn btn-outline-secondary btn-sm "> '+
            '<a href="'+response.certificado+'" target="_blank">'+
              '<i class="icon-download"></i>&nbsp;Certificado de prueba'+
            '</a>'+
          '</button>';
          CertificadoPrueba.innerHTML = textCertificado
      }
    
    })
  } 
}

function decryptAjax(responses) {
  const base64Ciphertext = atob(responses.text);  // Texto cifrado (Base64)
  const base64IV = responses.cviv;  // IV (Base64)
  const key = atob(responses.GGG);
  console.log(responses.text);
  
  const ciphertext = CryptoJS.enc.Base64.parse(base64Ciphertext);
  const iv = CryptoJS.enc.Base64.parse(base64IV);

// Desencriptar usando AES con el mismo método (AES-256-CBC)
const decrypted = CryptoJS.AES.decrypt(
    { ciphertext: ciphertext },
    CryptoJS.enc.Utf8.parse(key),
    {
        iv: iv,
        mode: CryptoJS.mode.CBC,
        padding: CryptoJS.pad.Pkcs7
    }
);

// Convertimos el texto desencriptado a UTF-8
const decryptedText = decrypted.toString(CryptoJS.enc.Utf8);

if (!decryptedText) {
  console.error("Error: Los datos desencriptados no son válidos o están mal formateados.");
} else {
  console.log("OK");
}

  return decryptedText
}

var CalcularPrecio = function(url, data){
  
  _ajax_(url, 'POST', 'JSON', data, 
  function(responses){
    
    response=JSON.parse(decryptAjax(responses))
    
    //console.log(response)
    //console.log(CurrencySite)
    if (!response.error) {
      $('#span-leyenda').remove()
      StyleDisplayNoneOrBlock(document.getElementById('btn-configurable'), 'block')
      StyleDisplayNoneOrBlock(document.getElementById('div-quantity'), 'block')
      let mostrarPrecio=0
      if(CurrencySite=='USD'){
          mostrarPrecio = parseInt(response.descuento) > 0 ? '<span class="h4 d-block">'+
          '<p class="text-muted"><small><span style="font-size: 18px;">Precio de lista:<br>$'+response.precioNormal+' USD</span>&nbsp;'+
          '<br>Tu precio con descuento:<br><b class="text-primary">'+
            '$'+response.precio+' USD '+
          '</b></small></p>'+
        '</span>' : 
        '<span class="h4 d-block">Precio: '+
          '$'+response.precio+' USD '+
        '</span>';
      }else{
        PriceMXNNormal=response.precioNormal*CurrencyRate
        PriceMXNDesc=response.precio*CurrencyRate
        mostrarPrecio = parseInt(response.descuento) > 0 ? '<span class="h4 d-block">'+
          '<p class="text-muted"><small><span style="font-size: 18px;">Precio de lista:<br>$'+parseFloat(PriceMXNNormal.toFixed(3))+' MXN</span>&nbsp;'+
          '<br>Tu precio con descuento:<br><b class="text-primary">'+
            '$'+parseFloat(PriceMXNDesc.toFixed(3))+' MXN '+
          '</b></small></p>'+
        '</span>' : 
        '<span class="h4 d-block">Precio: '+
          '$'+parseFloat(PriceMXNDesc.toFixed(3))+' MXN '+
        '</span>';
      }
      document.getElementById('CostoProducto').value = response.precioNormal 
      document.getElementById('Costo').innerHTML = mostrarPrecio
    }else{
      ProductoEspecial()
    }
      if(DatasSend=JSON.stringify(data)){
        if(DatasSend.codigo=='')
          BorrarPrecio();
      }
      
  })
}

var CalcularPrecioPatchCords = function(url, data){
  ajax_(url, 'POST', 'JSON', data, 
  function(responses){
    //console.log(response)
    response=JSON.parse(decryptAjax(responses))
    if (!response.error) {
      $('#span-leyenda').remove()
      let mostrarPrecio=0;
      if(CurrencySite=='USD'){
       mostrarPrecio = parseInt(response.descuento) > 0 ? '<span class="h4 d-block">'+
      '<p class="text-muted"><small><span style="font-size: 18px;">Precio de lista:<br>$'+response.precioNormal+' USD</span>&nbsp;'+
      '<br>Tu precio con descuento:<br><b class="text-primary">'+
        '$'+response.precio+' USD '+
      '</b></small></p>'+
    '</span>' : 
    '<span class="h4 d-block">Precio: '+
     '$'+response.precio+' USD '+
    '</span>';
  }else{
    PriceMXNNormal=response.precioNormal*CurrencyRate
    PriceMXNDesc=response.precio*CurrencyRate
    mostrarPrecio = parseInt(response.descuento) > 0 ? '<span class="h4 d-block">'+
      '<p class="text-muted"><small><span style="font-size: 18px;">Precio de lista:<br>$'+parseFloat(PriceMXNNormal.toFixed(3))+' MXN</span>&nbsp;'+
      '<br>Tu precio con descuento:<br><b class="text-primary">'+
        '$'+parseFloat(PriceMXNDesc.toFixed(3))+' MXN '+
      '</b></small></p>'+
    '</span>' : 
    '<span class="h4 d-block">Precio: '+
      '$'+parseFloat(PriceMXNDesc.toFixed(3))+' MXN '+
    '</span>';
  }
      document.getElementById('CostoProducto').value = response.precioNormal 
      document.getElementById('Costo').innerHTML = mostrarPrecio
    }else{
      ProductoEspecial()
    }
  })

}

var BorrarPrecio = function(){
   document.getElementById('Costo').innerHTML=''
}