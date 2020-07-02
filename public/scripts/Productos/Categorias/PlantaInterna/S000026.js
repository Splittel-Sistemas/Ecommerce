// Divisores Ópticos

var Marca = "OP"
var Familia = "DO"
var Cable = document.getElementById('Cable')

var DivisorSplitter250 = function(){
  let Cable = "SP"
  let Diametro = 'SF'
  let DiametroSelect = document.getElementById('DiametroSelect')
  let ConectorEntradaSelect = document.getElementById('ConectorEntradaSelect')  
  let ConectorSalidaSelect = document.getElementById('ConectorSalidaSelect') 
  let EntradaSalidas = document.getElementById('EntradaSalidas')
  let SalidasSplitter = EntradaSalidas.options[EntradaSalidas.selectedIndex].getAttribute('SalidasSplitterValue')
  let SalidasCouplerSelect = document.getElementById('SalidasCouplerSelect')

  // Remove Elementos Select
  StyleDisplayNoneOrBlock(DiametroSelect, "none")
  StyleDisplayNoneOrBlock(ConectorEntradaSelect, "none")
  StyleDisplayNoneOrBlock(ConectorSalidaSelect, "none")
  StyleDisplayNoneOrBlock(SalidasCouplerSelect, "none")

  StyleDisplayNoneOrBlock_2(EntradaSalidas,'none', [1,3,4,6,10,11,12,13])
  // Codigo Generado de acuerdo a las opciones selecionadas
  let CodigoGenerado = Marca+Familia+EntradaSalidas.value+SalidasSplitter+Diametro+Cable
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  ListImgProducto("OPDOSFSP")
  ListProductoDescription("OPDOSFSP")
  ListProductoAdicional("OPDOSFSP")
  existEcommerce_(CodigoGenerado)
}

var DivisorSplitter900ConConectores = function(){
  let Cable = "SP"
  let Diametro = 'CF'
  let ConectorEntrada = 'SCA'
  let ConectorSalida = 'SCA'
  let DiametroSelect = document.getElementById('DiametroSelect')
  let ConectorEntradaSelect = document.getElementById('ConectorEntradaSelect')  
  let ConectorSalidaSelect = document.getElementById('ConectorSalidaSelect') 
  let EntradaSalidas = document.getElementById('EntradaSalidas')
  let SalidasSplitter = EntradaSalidas.options[EntradaSalidas.selectedIndex].getAttribute('SalidasSplitterValue')
  let SalidasCouplerSelect = document.getElementById('SalidasCouplerSelect')

  // Remove Elementos Select
  StyleDisplayNoneOrBlock(DiametroSelect, "none")
  StyleDisplayNoneOrBlock(ConectorEntradaSelect, "none")
  StyleDisplayNoneOrBlock(ConectorSalidaSelect, "none")
  StyleDisplayNoneOrBlock(SalidasCouplerSelect, "none")
  StyleDisplayNoneOrBlock_2(EntradaSalidas,'none', [1,3,4,6,10,11,12,13])
  // Codigo Generado de acuerdo a las opciones selecionadas
  let CodigoGenerado = Marca+Familia+EntradaSalidas.value+SalidasSplitter+ConectorEntrada+ConectorSalida+Diametro+Cable
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  console.log(CodigoGenerado)
  ListImgProducto("OPDOSCACFSP")
  ListProductoDescription("OPDOSCACFSP")
  ListProductoAdicional("OPDOSCACFSP")
  existEcommerce_(CodigoGenerado)
}

var SlimCassetteConConector = function(){
  let ElemDiametro = document.getElementById('Diametro')
  let EntradaSalidas = document.getElementById('EntradaSalidas')
  let EntradaSalidasSelect = document.getElementById('EntradaSalidasSelect')
  let EntradaSalidas2 = document.getElementById('EntradaSalidas2')
  let EntradaSalidasSelect2 = document.getElementById('EntradaSalidasSelect2')
  let Diametro = ""
    StyleDisplayNoneOrBlock(EntradaSalidasSelect, "none")
    StyleDisplayNoneOrBlock(EntradaSalidasSelect2, "block")
    NewElemEntradaSalidas = EntradaSalidas2
    NewEntradaSalidas = EntradaSalidas2.value
  if (ElemDiametro.value != "CF") {
    Diametro = ElemDiametro.value
  }
  let ConectorEntrada = 'SCA'
  let ConectorSalida = 'SCA'
  let ConectorEntradaSelect = document.getElementById('ConectorEntradaSelect')  
  let ConectorSalidaSelect = document.getElementById('ConectorSalidaSelect') 
  let SalidasSplitter = NewElemEntradaSalidas.options[NewElemEntradaSalidas.selectedIndex].getAttribute('SalidasSplitterValue')
  let SalidasCouplerSelect = document.getElementById('SalidasCouplerSelect')
  // Remove Elementos Select
  StyleDisplayNoneOrBlock(ConectorEntradaSelect, "none")
  StyleDisplayNoneOrBlock(ConectorSalidaSelect, "none")
  StyleDisplayNoneOrBlock(SalidasCouplerSelect, "none")
  // Codigo Generado de acuerdo a las opciones selecionadas
  let CodigoGenerado = Marca+Familia+NewEntradaSalidas+SalidasSplitter+ConectorEntrada+ConectorSalida+Diametro+Cable.value
  let DirectorioImgProducto = Marca+Familia+ConectorEntrada+ConectorSalida+Diametro+Cable.value
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(DirectorioImgProducto)
  ListProductoAdicional(DirectorioImgProducto)
  existEcommerce_(CodigoGenerado)
}

var CouplerSinConector250 = function(){
  let SalidasCoupler = document.getElementById('SalidasCoupler')
  let Diametro = 'SF'  
  
  let DiametroSelect = document.getElementById('DiametroSelect')
  let ConectorEntradaSelect = document.getElementById('ConectorEntradaSelect')  
  let ConectorSalidaSelect = document.getElementById('ConectorSalidaSelect')  
  let EntradaSalidasSelect = document.getElementById('EntradaSalidasSelect') 
  let EntradaSalidas = document.getElementById('EntradaSalidas') 
  // Remove Elementos Select
  StyleDisplayNoneOrBlock(DiametroSelect, "none")
  StyleDisplayNoneOrBlock(ConectorEntradaSelect, "none")
  StyleDisplayNoneOrBlock(ConectorSalidaSelect, "none")
  RemoveOptionsSelect(EntradaSalidas, [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13])
  StyleDisplayNoneOrBlock_2(SalidasCoupler,'none' ,[1,3,9,10])
  EntradaSalidas = '102' 
  // StyleDisplayNoneOrBlock(EntradaSalidasSelect, "none")
  // Codigo Generado de acuerdo a las opciones selecionadas
  let CodigoGenerado = Marca+Familia+EntradaSalidas+SalidasCoupler.value+Diametro+Cable.value
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  ListImgProducto("OPDOSFCO")
  ListProductoDescription("OPDOSFCO")
  ListProductoAdicional("OPDOSFCO")
  existEcommerce_(CodigoGenerado)
}

var CassetteLGXSplitter = function(){
  document.getElementById('LabelConectorEntrada').innerHTML = "Conector Entrada/Salidas"
  let ConectorEntrada = 'SCA'
  let ConectorSalida = 'SCA'
  let EntradaSalidas = document.getElementById('EntradaSalidas')  
  let SalidasSplitter = EntradaSalidas.options[EntradaSalidas.selectedIndex].getAttribute('SalidasSplitterValue')
  let DiametroSelect = document.getElementById('DiametroSelect')
  let SalidasCouplerSelect = document.getElementById('SalidasCouplerSelect')
  // Remove Elementos Select
  StyleDisplayNoneOrBlock(DiametroSelect, "none")
  StyleDisplayNoneOrBlock(SalidasCouplerSelect, "none")
  // StyleDisplayNoneOrBlock(ConectorEntradaSelect, "none")
  StyleDisplayNoneOrBlock(ConectorSalidaSelect, "none")
  // Codigo Generado de acuerdo a las opciones selecionadas
  let CodigoGenerado = Marca+Familia+EntradaSalidas.value+SalidasSplitter+ConectorEntrada+ConectorSalida+Cable.value
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  ListImgProducto("OPDOCASP")
  ListProductoDescription("OPDOCASP")
  ListProductoAdicional("OPDOCASP")
  existEcommerce_(CodigoGenerado)
}

var DivisorSplitter900SinConnectores = function()
{
  let Cable = "SP"
  let Diametro = 'CF9'
  let DiametroSelect = document.getElementById('DiametroSelect')
  let ConectorEntradaSelect = document.getElementById('ConectorEntradaSelect')  
  let ConectorSalidaSelect = document.getElementById('ConectorSalidaSelect') 
  let EntradaSalidas = document.getElementById('EntradaSalidas')
  let SalidasSplitter = EntradaSalidas.options[EntradaSalidas.selectedIndex].getAttribute('SalidasSplitterValue')
  let SalidasCouplerSelect = document.getElementById('SalidasCouplerSelect')
  // Remove Elementos Select
  StyleDisplayNoneOrBlock(DiametroSelect, "none")
  StyleDisplayNoneOrBlock(SalidasCouplerSelect, "none")
  StyleDisplayNoneOrBlock(ConectorEntradaSelect, "none")
  StyleDisplayNoneOrBlock(ConectorSalidaSelect, "none")
  // Codigo Generado de acuerdo a las opciones selecionadas
  let CodigoGenerado = Marca+Familia+EntradaSalidas.value+SalidasSplitter+Diametro+Cable
  // Agreación de codigo para la vista en el identificador
  showClave(CodigoGenerado)
  ListImgProducto("OPDOCFSP")
  ListProductoDescription("OPDOCFSP")
  ListProductoAdicional("OPDOCFSP")
  existEcommerce_(CodigoGenerado)
}
var SlimCassetteSinConector = function()
{
  alert("SlimCassetteSinConector")
}
var CassetteLGXCoupler = function()
{
  let Cable = "CACO"
  let Diametro = ''
  let DiametroSelect = document.getElementById('DiametroSelect')
  let ConectorEntradaSelect = document.getElementById("ConectorEntrada");
  let ConectorSalidaSelect = document.getElementById("ConectorSalida");
  let EntradaSalidas = "102"; 
  let SalidasCoupler = document.getElementById('SalidasCoupler')
  StyleDisplayNoneOrBlock(DiametroSelect, "none")
  // StyleDisplayNoneOrBlock(document.getElementById('ConectorEntradaSelect'), "none")
  // StyleDisplayNoneOrBlock(document.getElementById('ConectorSalidaSelect'), "none")
  // StyleDisplayNoneOrBlock(document.getElementById('EntradaSalidasSelect'), "none")
  let CodigoGenerado = Marca+Familia+EntradaSalidas+SalidasCoupler.value+ConectorEntradaSelect.value+ConectorSalidaSelect.value+Diametro+Cable
  showClave(CodigoGenerado)
  ListImgProducto('OPDOCACO')
  ListProductoDescription('OPDOCACO')
  ListProductoAdicional('OPDOCACO')
  existEcommerce_(CodigoGenerado)
}
var MiniCassetteCoupler = function()
{
  let Cable = "9MC"
  let ElemDiametro = document.getElementById('Diametro')
  let EntradaSalidas = document.getElementById('EntradaSalidas')
  let SalidasCoupler = document.getElementById('SalidasCoupler')
  StyleDisplayNoneOrBlock(document.getElementById('ConectorEntradaSelect'), "none")
  StyleDisplayNoneOrBlock(document.getElementById('ConectorSalidaSelect'), "none")
  
  let CodigoGenerado = Marca+Familia+EntradaSalidas.value+SalidasCoupler.value+ElemDiametro.value+Cable
  showClave(CodigoGenerado)
  ListImgProducto('OPDOCF9MC')
  ListProductoDescription('OPDOCF9MC')
  ListProductoAdicional('OPDOCF9MC')
  existEcommerce_(CodigoGenerado)
}

var contremove = 0
var DivisoresOpticos = function() {
  console.log(Cable.value)
  switch(Cable.value){
    case 'SP-1' : 
      DivisorSplitter250()
    break;
    case 'SP-2' : 
      DivisorSplitter900ConConectores()
    break;
    case 'SC' : 
      contremove == 0 ? RemoveOptionSelect(Diametro, 0) : ""
      contremove++
      SlimCassetteConConector()
    break;
    case 'CO' : 
      CouplerSinConector250()
    break;
    case 'CASP' : 
      contremove == 0 ? RemoveOptionsSelect(EntradaSalidas, [3,5,6,7,8,9,10,11,12,13]) : ""
      contremove++
      CassetteLGXSplitter()
    break;
    case 'SP-3' : 
      DivisorSplitter900SinConnectores()
    break;
    case 'SC-1' : 
      contremove == 0 ? RemoveOptionSelect(Diametro, 0) : ""
      contremove++
      SlimCassetteSinConector()
    break;
    case 'CASP-1' : 
      if(contremove == 0){
        RemoveOptionsSelect(document.getElementById('ConectorEntrada'), [1])
        RemoveOptionsSelect(document.getElementById('ConectorSalida'), [1])
        RemoveOptionsSelect(document.getElementById('EntradaSalidas'), [1,2,3,4,5,6,7,8,9,10,11,12,13])
      }
      contremove++
      CassetteLGXCoupler()
    break;
    case  'MINC': 
      if(contremove == 0){
        RemoveOptionsSelect(document.getElementById('Diametro'), [0,2])
        RemoveOptionsSelect(document.getElementById('EntradaSalidas'), [1,2,3,4,5,6,7,8,9,10,11,12,13])
      }
      contremove++
      MiniCassetteCoupler()
    break;
    default:
      templateAlert("warning", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
  }  
  nameLabel('Cantidad')
}

DivisoresOpticos()