// Cables Interiores

var Marca = "OP"
var Familia = "CFO"
var FamiliaCable = "CI"
var Clave = document.getElementById('Clave')
var CodigoGenerado 
var DirectorioImgProducto

var CableDistribucion = function(){
  let TipoFibra = document.getElementById('TipoFibra')
  let TipoCubierta = document.getElementById('TipoCubierta')
  let NumeroHilos = document.getElementById('NumeroHilos')
  DirectorioImgProducto = NumeroHilos.value == "36" || NumeroHilos.value == "48" || NumeroHilos.value == "72" ? "OPCFOCI"+TipoFibra.value+"y48" : "OPCFOCI"+TipoFibra.value+"y24"; 
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+TipoCubierta.value+NumeroHilos.value
  // Agreación de codigo para la vista en el identificador
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(DirectorioImgProducto)
  ListProductoAdicional(DirectorioImgProducto)
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
}

var SimplexDuplexCont = 0;
var SimplexDuplexCont1 = 0;

var CableSimplexDuplex = function(){
  let cvefijo = 'YO'
  let TipoFibra = document.getElementById('TipoFibra')
  let NumeroHilos = document.getElementById('NumeroHilos')
  let DiametroCable = document.getElementById('DiametroCable')
  let TipoCubierta = document.getElementById('TipoCubierta')
  StyleDisplayNoneOrBlock_2(TipoCubierta, "none", [3, 4])
  if (TipoFibra.value == 62) {
    StyleDisplayNoneOrBlock_2(TipoCubierta, "none", [0, 1, 2])
    StyleDisplayNoneOrBlock_2(TipoCubierta, "block", [3, 4])
    SimplexDuplexCont1 == 0 ? TipoCubierta[3].selected = true : "" 
    SimplexDuplexCont1++
    SimplexDuplexCont = 0
  }else{
    StyleDisplayNoneOrBlock_2(TipoCubierta, "block", [0, 1, 2])
    SimplexDuplexCont == 0 ? TipoCubierta[0].selected = true : ""
    SimplexDuplexCont++
    SimplexDuplexCont1 = 0
  }
  DirectorioImgProducto = Marca+Familia+FamiliaCable+TipoFibra.value+NumeroHilos.value; 
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+FamiliaCable+TipoFibra.value+NumeroHilos.value+DiametroCable.value+TipoCubierta.value+cvefijo
  // Agreación de codigo para la vista en el identificador
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(DirectorioImgProducto)
  ListProductoAdicional(DirectorioImgProducto)
  showClave(CodigoGenerado)
  existEcommerce_(CodigoGenerado)
} 

var CableInterior = function() {
  let Cable = document.getElementById('Cable')
  switch(Cable.value){
    case 'CDIST' : 
      CableDistribucion()
    break;
    case 'CSIDU' : 
      CableSimplexDuplex()
    break;
    default:
      templateAlert("warning", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
      console.log("No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo")
  }
}

CableInterior()