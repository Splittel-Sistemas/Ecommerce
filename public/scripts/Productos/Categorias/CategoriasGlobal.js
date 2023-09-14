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
        if(document.getElementById('Costo'))
        document.getElementById('Costo').innerHTML = 'Precio: $ '+Precio+' USD '

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
        document.getElementById('Costo').innerHTML = 'Precio: $ '+Precio+' USD '
        nuevoPrecioPorLongitud(document.getElementById('longitud'))
      }else{
        document.getElementById('precio-longitud').value = 0
        ProductoEspecial()
        getDescuentoByFamiliaProductosConfigurables()
      }
    }else{
      ProductoEspecial()
      getDescuentoByFamiliaProductosConfigurables()
    }
  })
}

var existJumper_ = function(Codigo){
  console.log(Codigo)
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
 //console.log(resultResponse);
      // agregar stock
      if(Stock)
        if(resultResponse.ProductoExistencia!='' && resultResponse.ProductoExistencia>0)
          Stock.innerHTML = resultResponse.ProductoExistencia
          else
          Stock.innerHTML = '0.00'
     
    }else{
      let Stock = document.getElementById('add-stock')
      Stock.innerHTML = '0.00'
    }
  })
}




var nuevoPrecioPorLongitud = function(Elem){
  document.getElementById('quantity').value = Elem.value
  if (Elem.value > 0 && Elem.value != "") {
    let precio = Elem.value * document.getElementById('precio-longitud').value
    precio = precio.toFixed(3)
    document.getElementById('Costo').innerHTML = 'Precio: $ '+precio
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
      console.log(response)
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
  let FichaTecnicaTecnica = document.getElementById('add-ficha-tecnica-mini-catalogo')
  FichaTecnicaTecnica.innerHTML ='';
  if(idFicha != ''){
  ajax_("../../models/Productos/ProductoConfigurable.Route.php","POST","json", 
    { 
      Action: 'GetFichaTecnica', 
      CodigoFicha: idFicha
    }, 
    function(response){
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


var CalcularPrecio = function(url, data){
  ajax_(url, 'POST', 'JSON', data, 
  function(response){
    if (!response.error) {
      $('#span-leyenda').remove()
      StyleDisplayNoneOrBlock(document.getElementById('btn-configurable'), 'block')
      StyleDisplayNoneOrBlock(document.getElementById('div-quantity'), 'block')
      let mostrarPrecio = parseInt(response.descuento) > 0 ? '<span class="h4 d-block">'+
      '<p class="text-muted"><small><span style="font-size: 18px;">Precio de lista:<br>$'+response.precioNormal+' USD</span>&nbsp;'+
      '<br>Tu precio con descuento:<br><b class="text-primary">'+
        '$'+response.precio+' USD '+
      '</b></small></p>'+
    '</span>' : 
    '<span class="h4 d-block">Precio: '+
      '$'+response.precio+' USD '+
    '</span>';
      document.getElementById('CostoProducto').value = response.precioNormal 
      document.getElementById('Costo').innerHTML = mostrarPrecio
    }else{
      ProductoEspecial()
    }
  })
}

var CalcularPrecioPatchCords = function(url, data){
  ajax_(url, 'POST', 'JSON', data, 
  function(response){
    console.log(response)
    if (!response.error) {
      $('#span-leyenda').remove()
      let mostrarPrecio = parseInt(response.descuento) > 0 ? '<span class="h4 d-block">'+
      '<p class="text-muted"><small><span style="font-size: 18px;">Precio de lista:<br>$'+response.precioNormal+' USD</span>&nbsp;'+
      '<br>Tu precio con descuento:<br><b class="text-primary">'+
        '$'+response.precio+' USD '+
      '</b></small></p>'+
    '</span>' : 
    '<span class="h4 d-block">Precio: '+
     '$'+response.precio+' USD '+
    '</span>';
      document.getElementById('CostoProducto').value = response.precioNormal 
      document.getElementById('Costo').innerHTML = mostrarPrecio
    }else{
      ProductoEspecial()
    }
  })
}