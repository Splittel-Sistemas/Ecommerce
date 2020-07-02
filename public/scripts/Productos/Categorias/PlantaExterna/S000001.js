// Cables Exteriores

var Cable = document.getElementById('Cable')
var Marca = "OP"
var Familia = "CFO"
var FamiliaCable = "CE"
var TipoFibra = document.getElementById('TipoFibra')
var NumeroFibras = document.getElementById('NumeroFibras')
var Clave = document.getElementById('Clave')

var CableExteriorArmadoMultiTubo = function(){
  let MaterialTuboHolgado = "PP"
  let TipoConstruccion = "SS"
  let MaterialCubierta = document.getElementById('MaterialCubierta')
  let MaterialCubiertaNewValue = MaterialCubierta.value == "B" ? "" : MaterialCubierta.value
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+Cable.value+NumeroFibras.value+MaterialCubiertaNewValue+MaterialTuboHolgado+TipoConstruccion
  ListImgProducto("OPCFOCExxARxxPPSS")
  ListProductoDescription("OPCFOCExxARxxPPSS")
  ListProductoAdicional("OPCFOCExxARxxPPSS")
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var CableExteriorFigura8SinArmadura = function(){
  let SelectMaterialCubierta = document.getElementById("SelectMaterialCubierta")
  SelectMaterialCubierta ? SelectMaterialCubierta.remove() : ""
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+Cable.value+NumeroFibras.value
  ListImgProducto("OPCFOCExxF8SAxx")
  ListProductoDescription("OPCFOCExxF8SAxx")
  ListProductoAdicional("OPCFOCExxF8SAxx")
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var CableExteriorFigura8MensajeroPlastico = function(){
  let SelectMaterialCubierta = document.getElementById("SelectMaterialCubierta")
  SelectMaterialCubierta ? SelectMaterialCubierta.remove() : ""
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+Cable.value+NumeroFibras.value
  ListImgProducto("OPCFOCExxF8SAMPxx")
  ListProductoDescription("OPCFOCExxF8SAMPxx")
  ListProductoAdicional("OPCFOCExxF8SAMPxx")
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var CableExteriorArmadoDielectrico = function(){
  let MaterialTuboHolgado = "PP"
  let TipoConstruccion = "SS"
  let MaterialCubierta = document.getElementById('MaterialCubierta')
  let MaterialCubiertaNewValue = MaterialCubierta.value == "B" ? "" : MaterialCubierta.value
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+Cable.value+NumeroFibras.value+MaterialCubiertaNewValue+MaterialTuboHolgado+TipoConstruccion
  ListImgProducto("OPCFOCExxADxxPPSS")
  ListProductoDescription("OPCFOCExxADxxPPSS")
  ListProductoAdicional("OPCFOCExxADxxPPSS")
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var CableExteriorDielectrico = function(){
  let MaterialTuboHolgado = "PP"
  let TipoConstruccion = "SS"
  let MaterialCubierta = document.getElementById('MaterialCubierta')
  let MaterialCubiertaNewValue = MaterialCubierta.value == "B" ? "" : MaterialCubierta.value
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+Cable.value+NumeroFibras.value+MaterialCubiertaNewValue+MaterialTuboHolgado+TipoConstruccion
  ListImgProducto("OPCFOCExxDIxxxPPSS")
  ListProductoDescription("OPCFOCExxDIxxxPPSS")
  ListProductoAdicional("OPCFOCExxDIxxxPPSS")
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var CableExteriorMiniFigura8 = function(){
  let SelectMaterialCubierta = document.getElementById("SelectMaterialCubierta")
  SelectMaterialCubierta ? SelectMaterialCubierta.remove() : ""
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+Cable.value+NumeroFibras.value
  ListImgProducto("OPCFOCExxM8xx")
  ListProductoDescription("OPCFOCExxM8xx")
  ListProductoAdicional("OPCFOCExxM8xx")
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var CableDropPlano = function(){
  let NumeroHilos = document.getElementById("NumeroHilosTotal")
  // let NumeroHilosTotalText = document.getElementById("NumeroHilosTotalText")
  NumeroHilos.value = TipoFibra.value == "09" ? "12" : "01"  
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+TipoFibra.value+Cable.value+NumeroHilos.value
  ListImgProducto("OPCFOx9DRFTTHPxx")
  ListProductoDescription("OPCFOx9DRFTTHPxx")
  ListProductoAdicional("OPCFOx9DRFTTHPxx")
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var MicroCable = function(){
  let NumeroHilos = document.getElementById("NumeroHilos")
  let TipoCubierta = document.getElementById("TipoCubierta")
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+Cable.value+TipoFibra.value+TipoCubierta.value+NumeroHilos.value
  ListImgProducto("OPCFOMC09PExxx")
  ListProductoDescription("OPCFOMC09PExxx")
  ListProductoAdicional("OPCFOMC09PExxx")
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var CableADDS = function(){
  let MaterialCubierta = "B"
  let MaterialTuboHolgado = "3"
  let TipoConstruccion = "B"
  let TotalMetros = document.getElementById("TotalMetros")
  console.log(TotalMetros)
  let DirectorioImgProducto = TotalMetros.value == "SA" ? "OPCFOCE09SAxxxB3B" : "OPCFOCE09SAS2xxB3B" 
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+TotalMetros.value+NumeroFibras.value+MaterialCubierta+MaterialTuboHolgado+TipoConstruccion
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(DirectorioImgProducto)
  ListProductoAdicional(DirectorioImgProducto)
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var contremove = 0
var CableExterior = function() {
  switch(Cable.value){
    case 'AR' : 
      CableExteriorArmadoMultiTubo()
    break;
    case 'F8SA' : 
      CableExteriorFigura8SinArmadura()
    break; 
    case 'F8SAMP' : 
      CableExteriorFigura8MensajeroPlastico()
    break;
    case 'AD' : 
      CableExteriorArmadoDielectrico()
    break;
    case 'ADDS' : 
      CableADDS()
    break;
    case 'DI' : 
      CableExteriorDielectrico()
    break;
    case 'M8' : 
      contremove == 0 ? RemoveOptionsSelect(NumeroFibras, [1,2,3,4,5,6,7]) : ""
      contremove++
      CableExteriorMiniFigura8()
    break;
    case 'MC' : 
      MicroCable()
    break;
    case 'DRFTTHP' : 
      CableDropPlano()
    break;
    default:
      templateAlert("danger", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
      console.log("No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo")
  }
}

CableExterior()