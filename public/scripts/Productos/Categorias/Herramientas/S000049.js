var Cable = document.getElementById('Cable')
var Marca = "OP"
var Familia = "HEMA"
nameLabel("Cantidad")
var IdentificadorSimple = function(){
    let Tipo = "ID"
    let Ancho = document.getElementById("Ancho")
    let Color = document.getElementById("Color")
    let Diametro = document.getElementById("Diametro")

    if(Ancho[0].selected==true){
        StyleDisplayNoneOrBlock_2(Diametro, 'block', [0]);
        StyleDisplayNoneOrBlock_2(Diametro, 'none', [1]);
        Diametro[0].selected=true;
    }else if(Ancho[1].selected==true){
        StyleDisplayNoneOrBlock_2(Diametro, 'block', [0,1]);
    }else if(Ancho[2].selected==true){
        StyleDisplayNoneOrBlock_2(Diametro, 'block', [1]);
        StyleDisplayNoneOrBlock_2(Diametro, 'none', [0]);
        Diametro[1].selected=true;
    }

    CodigoGenerado = Marca+Familia+Tipo+Ancho.value+Color.value+Diametro.value
    ListImgProductoOnly(Marca+Familia+Tipo+'/fotos',Marca+Familia+Tipo+Color.value)
    ListProductoDescription(Marca+Familia+Tipo)
    ListProductoAdicional(Marca+Familia+Tipo)
    //console.log(Marca+Familia+Tipo)
    // Agreación de codigo para la vista en el identificador
    showClave(CodigoGenerado)
    existEcommerce_(CodigoGenerado)
  }

  var IdentificadorProteccionUV = function(){
    let Tipo = "IP"
    let Ancho = document.getElementById("Ancho")
    let Color = document.getElementById("Color")
    let Diametro = document.getElementById("Diametro")

    if(Ancho[0].selected==true){
        StyleDisplayNoneOrBlock_2(Diametro, 'block', [0,1]);
       // StyleDisplayNoneOrBlock_2(Diametro, 'none', [1]);
        //Diametro[0].selected=true;
    }else if(Ancho[1].selected==true){
        StyleDisplayNoneOrBlock_2(Diametro, 'block', [0,1]);
    }else if(Ancho[2].selected==true){
        StyleDisplayNoneOrBlock_2(Diametro, 'block', [0,1]);
        //StyleDisplayNoneOrBlock_2(Diametro, 'none', [0]);
        //Diametro[1].selected=true;
    }else if(Ancho[3].selected==true){
        StyleDisplayNoneOrBlock_2(Diametro, 'block', [1]);
        StyleDisplayNoneOrBlock_2(Diametro, 'none', [0]);
        Diametro[1].selected=true;
    }

    CodigoGenerado = Marca+Familia+Tipo+Ancho.value+Color.value+Diametro.value
    ListImgProductoOnly(Marca+Familia+Tipo+'/fotos',Marca+Familia+Tipo+Color.value)
    ListProductoDescription(Marca+Familia+Tipo)
    ListProductoAdicional(Marca+Familia+Tipo)
    // Agreación de codigo para la vista en el identificador
    showClave(CodigoGenerado)
    existEcommerce_(CodigoGenerado)
  }

  var IdentificadorFondoReflectivo = function(){
    let Tipo = "IR"
    let Ancho = document.getElementById("Ancho")
    let Color = document.getElementById("Color")
    let Diametro = document.getElementById("Diametro")

    if(Ancho[0].selected==true){
        StyleDisplayNoneOrBlock_2(Diametro, 'block', [0]);
        StyleDisplayNoneOrBlock_2(Diametro, 'none', [1]);
        Diametro[0].selected=true;
    }else if(Ancho[1].selected==true){
        StyleDisplayNoneOrBlock_2(Diametro, 'block', [0,1]);
    }else if(Ancho[2].selected==true){
        StyleDisplayNoneOrBlock_2(Diametro, 'block', [1]);
        StyleDisplayNoneOrBlock_2(Diametro, 'none', [0]);
        Diametro[1].selected=true;
    }

    CodigoGenerado = Marca+Familia+Tipo+Ancho.value+Color.value+Diametro.value
    ListImgProductoOnly(Marca+Familia+Tipo+'/fotos',Marca+Familia+Tipo+Color.value)
    ListProductoDescription(Marca+Familia+Tipo)
    ListProductoAdicional(Marca+Familia+Tipo)
    // Agreación de codigo para la vista en el identificador
    showClave(CodigoGenerado)
    existEcommerce_(CodigoGenerado)
  }

  var IdentificadorBandera = function(){
    let Tipo = "IB"
    let Ancho = document.getElementById("Ancho")
    let Color = document.getElementById("Color")
    let Diametro = document.getElementById("Diametro")
    if(Ancho.value == '203'){
      StyleDisplayNoneOrBlock_2(Diametro, "none", [0])
      if(Diametro.value=='A')
        Diametro.selectedIndex = 1
    }else{
      StyleDisplayNoneOrBlock_2(Diametro, "block", [0,1])
    }

    CodigoGenerado = Marca+Familia+Tipo+Ancho.value+Color.value+Diametro.value
    ListImgProductoOnly(Marca+Familia+Tipo+'/fotos',Marca+Familia+Tipo+Color.value)
    ListProductoDescription(Marca+Familia+Tipo)
    ListProductoAdicional(Marca+Familia+Tipo)
    // Agreación de codigo para la vista en el identificador
    showClave(CodigoGenerado)
    existEcommerce_(CodigoGenerado)
  }

  var IdentificadorEtiqueta = function(){
    let Tipo = "IE"
    let Ancho = document.getElementById("Ancho")
    let Color = document.getElementById("Color")

    CodigoGenerado = Marca+Familia+Tipo+Ancho.value+Color.value
    ListImgProductoOnly(Marca+Familia+Tipo+'/fotos',Marca+Familia+Tipo+Color.value)
    ListProductoDescription(Marca+Familia+Tipo)
    ListProductoAdicional(Marca+Familia+Tipo)
    // Agreación de codigo para la vista en el identificador
    showClave(CodigoGenerado)
    existEcommerce_(CodigoGenerado)
  }

  var IdentificadorAutolaminado = function(){
    let Tipo = "EA"
    let Ancho = document.getElementById("Ancho")
    let Color = document.getElementById("Color")

    CodigoGenerado = Marca+Familia+Tipo+Ancho.value+Color.value
    ListImgProductoOnly(Marca+Familia+Tipo+'/fotos',Marca+Familia+Tipo+Color.value)
    ListProductoDescription(Marca+Familia+Tipo)
    ListProductoAdicional(Marca+Familia+Tipo)
    // Agreación de codigo para la vista en el identificador
    showClave(CodigoGenerado)
    existEcommerce_(CodigoGenerado)
  }

var EquipoIdentificacion = function() {
    switch(Cable.value){
      case 'I-SIM' : 
        IdentificadorSimple()
      break;
      case 'I-PUV' : 
        IdentificadorProteccionUV()
      break; 
      case 'I-FR' : 
        IdentificadorFondoReflectivo()
      break;
      case 'I-BA' : 
        IdentificadorBandera()
      break;
      case 'I-ET' : 
        IdentificadorEtiqueta()
      break;
      case 'I-AU' : 
        IdentificadorAutolaminado()
      break;
      default:
        templateAlert("danger", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
        console.log("No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo")
    }
  }

EquipoIdentificacion()