// Atenuadores Monomodo

var Marca = "OP"
var Familia = "AT"
var TipoFibra = "SM"
var Aplicacion = "BF" //FIJO
var TipoAtenuador = document.getElementById('Cable')
var Atenuacion = document.getElementById('Atenuacion')
var CodigoGenerado 
var DirectorioImgProducto

var AtenuadorFC = function(){
  Aplicacion = "VAF" // VARIABLE
  RemoveOptionsSelect(Atenuacion, [2,3,4,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20])
  DirectorioImgProducto = Marca+Familia+TipoAtenuador.value+"VA"
  console.log(DirectorioImgProducto)
  // Codigo Generado de acuerdo a las opciones selecionadas
  CodigoGenerado = Marca+Familia+TipoAtenuador.value+Aplicacion+Atenuacion.value+TipoFibra
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(DirectorioImgProducto)
  ListProductoAdicional(DirectorioImgProducto)
  existEcommerce_(CodigoGenerado)
}
var contremove = 0
var AtenuadoresMonomodo = function() {
  if (TipoAtenuador.value == 'FC') {
    AtenuadorFC()
  }else{
    contremove == 0 ? RemoveOptionsSelect(Atenuacion, [0]) : ""
    contremove++
    // Codigo Generado de acuerdo a las opciones selecionadas
    DirectorioImgProducto = Marca+Familia+TipoAtenuador.value+Aplicacion
    console.log(DirectorioImgProducto)
    CodigoGenerado = Marca+Familia+TipoAtenuador.value+Aplicacion+Atenuacion.value+TipoFibra
    // Agreación de codigo para la vista en el identificador
    showClave(CodigoGenerado)
    ListImgProducto(DirectorioImgProducto)
    ListProductoDescription(DirectorioImgProducto)
    ListProductoAdicional(DirectorioImgProducto)
	  existEcommerce_(CodigoGenerado)
  }
}

AtenuadoresMonomodo()