// Cables Interior Exterior

var Marca = "OP"
var Familia = "CFO"
var FamiliaCable = "IE"
var TipoFibra = document.getElementById('TipoFibra')
var Clave = document.getElementById('Clave')

var CableInteriorExterior = function(){
  let NumeroHilos = document.getElementById('NumeroHilos')
  let TipoCubierta = document.getElementById('TipoCubierta')
  let DirectorioImgProducto = NumeroHilos.value == "36" || NumeroHilos.value == "48" ? "OPCFOIExxy48" : "OPCFOIExxy24"; 
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+TipoCubierta.value+NumeroHilos.value
  // Agreación de codigo para la vista en el identificador
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(DirectorioImgProducto)
  ListProductoAdicional(DirectorioImgProducto)
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var CableDropFigura8FTTH = function(){
  let TipoFibra = document.getElementById('TipoFibra')
  let NumeroHilos = document.getElementById('NumeroHilos')
  let TipoCubierta = document.getElementById('TipoCubierta')
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+Cable.value+NumeroHilos.value+TipoCubierta.value
  ListImgProducto("OPCFOIE29DR8xxZH")
  ListProductoDescription("OPCFOIE29DR8xxZH")
  ListProductoAdicional("OPCFOIE29DR8xxZH")
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var CableDropFiguraFTTH = function(){
  let TipoFibra = document.getElementById('TipoFibra')
  let NumeroHilos = document.getElementById('NumeroHilos')
  let TipoCubierta = NumeroHilos.value == 1 ? "TP" : "ZH"
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+Cable.value+NumeroConCeros2(NumeroHilos.value,3)+TipoCubierta
  ListImgProducto("OPCFOIE39DR0xxxx")
  ListProductoDescription("OPCFOIE39DR0xxxx")
  ListProductoAdicional("OPCFOIE39DR0xxxx")
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var InteriorExterior = function() {
  let Cable = document.getElementById('Cable')
  switch(Cable.value){
    case 'INTEXT' : 
      CableInteriorExterior()
    break;
    case 'DR8' : 
      CableDropFigura8FTTH()
    break;
    case 'DR' : 
      CableDropFiguraFTTH()
    break;
    default:
      templateAlert("warning", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
      console.log("No se encontro la opción solicitada por favor pide ayuda, a tú ejecutivo")
  }
}

InteriorExterior()