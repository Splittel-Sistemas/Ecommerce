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
  ListProductoMiniCatalogo("OPCFOCExxARxxPPSS")
  ListProductoManual("OPCFOCExxARxxPPSS")
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
  ListProductoMiniCatalogo("OPCFOCExxF8SAxx")
  ListProductoManual("OPCFOCExxF8SAxx")
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
  ListProductoMiniCatalogo("OPCFOCExxF8SAMPxx")
  ListProductoManual("OPCFOCExxF8SAMPxx")
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
  ListProductoMiniCatalogo("OPCFOCExxADxxPPSS")
  ListProductoManual("OPCFOCExxADxxPPSS")
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
  ListProductoMiniCatalogo("OPCFOCExxDIxxxPPSS")
  ListProductoManual("OPCFOCExxDIxxxPPSS")
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var CableExteriorMiniFigura8 = function(){
  let SelectMaterialCubierta = document.getElementById("SelectMaterialCubierta")
  SelectMaterialCubierta ? SelectMaterialCubierta.remove() : ""

  if(TipoFibra.value == '57'){
    NumeroFibras[1].style.display = "none"
    NumeroFibras.selectedIndex = 0
  }else{
    NumeroFibras[1].style.display = "block"
  }
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+Cable.value+NumeroFibras.value
  ListImgProducto("OPCFOCExxM8xx")
  ListProductoDescription("OPCFOCExxM8xx")
  ListProductoAdicional("OPCFOCExxM8xx")
  ListProductoMiniCatalogo("OPCFOCExxM8xx")
  ListProductoManual("OPCFOCExxM8xx")
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var CableDropPlano = function(){
  //let NumeroHilos = document.getElementById("NumeroHilosTotal")
  // let NumeroHilosTotalText = document.getElementById("NumeroHilosTotalText")
  //NumeroHilos.value = TipoFibra.value == "09" ? "12" : "01"  
  // Codigo Generado de acuerdo a las opciones selecionadas
  if(TipoFibra.value == '29'){
    StyleDisplayNoneOrBlock_2(NumeroFibras, "none", [2, 3])
    StyleDisplayNoneOrBlock_2(NumeroFibras, "block", [0, 1])
    if(NumeroFibras.selectedIndex == 2 || NumeroFibras.selectedIndex == 3 )
    {
      NumeroFibras[0].selected = true;
    }
  }else{
    StyleDisplayNoneOrBlock_2(NumeroFibras, "none", [0, 1])
    StyleDisplayNoneOrBlock_2(NumeroFibras, "block", [2, 3])
    if(NumeroFibras.selectedIndex == 0 || NumeroFibras.selectedIndex == 1 ){
       NumeroFibras[2].selected = true;
    }
  }
  CodigoGenerado = Marca+Familia+TipoFibra.value+Cable.value+NumeroFibras.value
  ListImgProducto("OPCFOx9DRFTTHPxx")
  ListProductoDescription("OPCFOx9DRFTTHPxx")
  ListProductoAdicional("OPCFOx9DRFTTHPxx")
  ListProductoMiniCatalogo("OPCFOx9DRFTTHPxx")
  ListProductoManual("OPCFOx9DRFTTHPxx")
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
  ListProductoMiniCatalogo("OPCFOMC09PExxx")
  ListProductoManual("OPCFOMC09PExxx")
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
  ListProductoMiniCatalogo(DirectorioImgProducto)
  ListProductoManual(DirectorioImgProducto)
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}
var ADDSAntitracking = function(){
  let MaterialCubierta = "D"
  let MaterialTuboHolgado = "3"
  let TipoConstruccion = "B"
  let TotalMetros = document.getElementById("TotalMetros")
  let DirectorioImgProducto = "OPCFOCE09SAS2XXXD3B" 
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+TotalMetros.value+NumeroFibras.value+MaterialCubierta+MaterialTuboHolgado+TipoConstruccion
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(DirectorioImgProducto)
  ListProductoAdicional(DirectorioImgProducto)
  ListProductoMiniCatalogo(DirectorioImgProducto)
  ListProductoManual(DirectorioImgProducto)
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)

}

var ADDSAntirroedor = function(){
  
  let MaterialCubierta = "B"
  let MaterialTuboHolgado = "3"
  let TipoConstruccion = "P"
  let TotalMetros = document.getElementById("TotalMetros")
  let DirectorioImgProducto = "OPCFOCE09DASXXXB3P" 
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+TotalMetros.value+NumeroFibras.value+MaterialCubierta+MaterialTuboHolgado+TipoConstruccion
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(DirectorioImgProducto)
  ListProductoAdicional(DirectorioImgProducto)
  ListProductoMiniCatalogo(DirectorioImgProducto)
  ListProductoManual(DirectorioImgProducto)
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
  
}
var ADDSMini = function(){
  let MaterialCubierta = document.getElementById('MaterialCubierta')

  NumeroFibras[0].style.display = "none"
  NumeroFibras[2].style.display = "none"
  if(NumeroFibras.selectedIndex == 0 || NumeroFibras.selectedIndex == 2 ){
    NumeroFibras[1].selected = true;
 }

  TipoFibra[1].style.display = "none"
  TipoFibra[2].style.display = "none"
  TipoFibra[3].style.display = "none"
  TipoFibra[4].style.display = "none"

  MaterialCubierta[1].style.display = "none"


  let MaterialTuboHolgado = "3"
  let TipoConstruccion = "B"
  let CVE = "MSA"
  let DirectorioImgProducto = "OPCFOCE09MSAXXXB3B" 
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+CVE+NumeroFibras.value+MaterialCubierta.value+MaterialTuboHolgado+TipoConstruccion
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(DirectorioImgProducto)
  ListProductoAdicional(DirectorioImgProducto)
  ListProductoMiniCatalogo(DirectorioImgProducto)
  ListProductoManual(DirectorioImgProducto)
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
  
}

var ADDSAccess = function(){
  let MaterialCubierta = "B"
  let MaterialTuboHolgado = "2"
  let TipoConstruccion = "B"
  var Span = document.getElementById('TotalMetros')
  
  

  if(NumeroFibras.value == '12' || NumeroFibras.value == '24' || NumeroFibras.value == '48' || NumeroFibras.value == '96'){
    StyleDisplayNoneOrBlock_2(Span, "block", [0,1])
    
  }else{
    StyleDisplayNoneOrBlock_2(Span, "none", [1])
    StyleDisplayNoneOrBlock_2(Span, "block", [0])
    if(NumeroFibras.selectedIndex == 2 || NumeroFibras.selectedIndex == 4 || NumeroFibras.selectedIndex == 6){
      Span[0].selected = true;
    }
  }
  let CVE = Span.value
  let DirectorioImgProducto = "OPCFOCE09"+Span.value+"XXB2B" 
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+Span.value+NumeroFibras.value+MaterialCubierta+MaterialTuboHolgado+TipoConstruccion
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(DirectorioImgProducto)
  ListProductoAdicional(DirectorioImgProducto)
  ListProductoMiniCatalogo(DirectorioImgProducto)
  ListProductoManual(DirectorioImgProducto)
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
      contremove == 0 ? RemoveOptionsSelect(NumeroFibras, [2,3,4,5,6,7]) : ""
      contremove++
      CableExteriorMiniFigura8()
    break;
    case 'MC' : 
      MicroCable()
    break;
    case 'DRFTTHP' : 
      CableDropPlano()
    break;
    case 'ADSSA' : 
      ADDSAntitracking()
    break;
    case 'ADSSR' : 
      ADDSAntirroedor()
    break;
    case 'ADSSMN' : 
      ADDSMini()
    break;
    case 'ADSSAP' : 
      ADDSAccess()
    break;
    default:
      templateAlert("danger", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
      console.log("No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo")
  }
}

CableExterior()