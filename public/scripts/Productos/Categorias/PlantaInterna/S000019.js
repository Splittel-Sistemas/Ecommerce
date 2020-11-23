// Distribuidores Preconectorizados

var Marca = "OP"
var Ensamble = "EE"
var Familia = "DP"
var Unidad = document.getElementById('Cable')
var NumeroAcopladoresMin = 1
var Pig = 'P'

var contP1 = 0
var contP2 = 0
var cont_1 = 0
var cont_2 = 0
var DistribuidoresPreconectorizados_ = function(TipoDistribuidor){
  let CantidadPigtails = document.getElementById('CantidadPigtails')
  let NumeroAcopladores = document.getElementById('NumeroAcopladores')
  let TipoAcoplador = document.getElementById('TipoAcoplador')
  let Puertos = document.getElementById('Puertos')
  let Distribuidor = TipoDistribuidor
  let TipoFibra = document.getElementById('TipoFibra')
  let TipoFibraDescripcion = TipoFibra.options[TipoFibra.selectedIndex].text
  let CodigoGenerado = ''
  let NumeroAcopladoresTotal = ''
  let CapacidadDistribuidor = ''

  if(Distribuidor == '1U' || Distribuidor == '1E'){ 
    StyleDisplayNoneOrBlock_2(CantidadPigtails, 'block', [0,1,2,3,4,5,8]); 
    StyleDisplayNoneOrBlock_2(CantidadPigtails, 'none', [6,7,9,10,11]);
    if(CantidadPigtails.value > 36){
      StyleDisplayNoneOrBlock_2(TipoAcoplador, 'block', [0,1,2]);
      StyleDisplayNoneOrBlock_2(TipoAcoplador, 'none', [3,4,5,6,7,8,9]);
      contP1 == 0 ? TipoAcoplador.selectedIndex = 0 : ''
      contP1++
      contP2 = 0
    }else{
      StyleDisplayNoneOrBlock_2(TipoAcoplador, 'block', [0,1,2,3,4,5,6,7,8,9]);
      contP1 = 0
    }
    if( TipoAcoplador.value=='STU' || TipoAcoplador.value=='STP' || TipoAcoplador.value=='FCU' || TipoAcoplador.value=='FCP' ) {
      Puertos.selectedIndex = 1
      NumeroAcopladoresTotal=CantidadPigtails.value
      CapacidadDistribuidor=36
    }else if( ( TipoAcoplador.value=='LCU' || TipoAcoplador.value=='LCA' || TipoAcoplador.value=='LCP') ){
      if((CantidadPigtails.value >= 4 && CantidadPigtails.value <= 36)){
        Puertos.selectedIndex = 0
        NumeroAcopladoresTotal=(CantidadPigtails.value/2)
      }
      if(CantidadPigtails.value >36){
        Puertos.selectedIndex = 2
        NumeroAcopladoresTotal=(CantidadPigtails.value/4)
      }
      CapacidadDistribuidor=18
    }else if( ( TipoAcoplador.value=='SCU' || TipoAcoplador.value=='SCA' || TipoAcoplador.value=='SCP') ){
      if((CantidadPigtails.value >= 4 && CantidadPigtails.value <= 18)){
      Puertos.selectedIndex = 1
      NumeroAcopladoresTotal=(CantidadPigtails.value)
      }
      if(CantidadPigtails.value >18){
        Puertos.selectedIndex = 0
      NumeroAcopladoresTotal=(CantidadPigtails.value/2)
      }
      CapacidadDistribuidor=36
    }
  }
  
  if(Distribuidor == '2U'){
     StyleDisplayNoneOrBlock_2(CantidadPigtails, 'block', [0,1,2,3,4,5,6,7,8,10]);
     StyleDisplayNoneOrBlock_2(CantidadPigtails, 'none', [9,11]);
     if(CantidadPigtails.value > 72){
      StyleDisplayNoneOrBlock_2(TipoAcoplador, 'block', [0,1,2]);
      StyleDisplayNoneOrBlock_2(TipoAcoplador, 'none', [3,4,5,6,7,8,9]);
      contP1 == 0 ? TipoAcoplador.selectedIndex = 0 : ''
      contP1++
      contP2 = 0
    }else{
      StyleDisplayNoneOrBlock_2(TipoAcoplador, 'block', [0,1,2,3,4,5,6,7,8,9]);
      contP1 = 0
    }
    if( TipoAcoplador.value=='STU' || TipoAcoplador.value=='STP' || TipoAcoplador.value=='FCU' || TipoAcoplador.value=='FCP' ) {
      Puertos.selectedIndex = 1
      NumeroAcopladoresTotal=CantidadPigtails.value
      CapacidadDistribuidor=72
    }else if( ( TipoAcoplador.value=='LCU' || TipoAcoplador.value=='LCA' || TipoAcoplador.value=='LCP') ){
      if((CantidadPigtails.value >= 4 && CantidadPigtails.value <= 72)){
        Puertos.selectedIndex = 0
        NumeroAcopladoresTotal=(CantidadPigtails.value/2)
      }
      if(CantidadPigtails.value >72){
        Puertos.selectedIndex = 2
        NumeroAcopladoresTotal=(CantidadPigtails.value/4)
      }
      CapacidadDistribuidor=36
    }else if( ( TipoAcoplador.value=='SCU' || TipoAcoplador.value=='SCA' || TipoAcoplador.value=='SCP') ){
      if((CantidadPigtails.value >= 4 && CantidadPigtails.value <= 36)){
      Puertos.selectedIndex = 1
      NumeroAcopladoresTotal=(CantidadPigtails.value)
      }
      if(CantidadPigtails.value >36){
        Puertos.selectedIndex = 0
      NumeroAcopladoresTotal=(CantidadPigtails.value/2)
      }
      CapacidadDistribuidor=72
    }
  }
  if(Distribuidor == '4U'){ 
    StyleDisplayNoneOrBlock_2(CantidadPigtails, 'block', [0,1,2,3,4,5,6,7,8,9,10,11]);
    if(CantidadPigtails.value > 144){
      StyleDisplayNoneOrBlock_2(TipoAcoplador, 'block', [0,1,2]);
      StyleDisplayNoneOrBlock_2(TipoAcoplador, 'none', [3,4,5,6,7,8,9]);
      contP1 == 0 ? TipoAcoplador.selectedIndex = 0 : ''
      contP1++
      contP2 = 0
    }else{
      StyleDisplayNoneOrBlock_2(TipoAcoplador, 'block', [0,1,2,3,4,5,6,7,8,9]);
      contP1 = 0
    }
    if( TipoAcoplador.value=='STU' || TipoAcoplador.value=='STP' || TipoAcoplador.value=='FCU' || TipoAcoplador.value=='FCP' ) {
      Puertos.selectedIndex = 1
      NumeroAcopladoresTotal=CantidadPigtails.value
      CapacidadDistribuidor=144
    }else if( ( TipoAcoplador.value=='LCU' || TipoAcoplador.value=='LCA' || TipoAcoplador.value=='LCP') ){
      if((CantidadPigtails.value >= 4 && CantidadPigtails.value <= 144)){
        Puertos.selectedIndex = 0
        NumeroAcopladoresTotal=(CantidadPigtails.value/2)
      }
      if(CantidadPigtails.value >144){
        Puertos.selectedIndex = 2
        NumeroAcopladoresTotal=(CantidadPigtails.value/4)
      }
      CapacidadDistribuidor=72
    }else if( ( TipoAcoplador.value=='SCU' || TipoAcoplador.value=='SCA' || TipoAcoplador.value=='SCP') ){
      if((CantidadPigtails.value >= 4 && CantidadPigtails.value <= 72)){
      Puertos.selectedIndex = 1
      NumeroAcopladoresTotal=(CantidadPigtails.value)
      }
      if(CantidadPigtails.value >72){
        Puertos.selectedIndex = 0
      NumeroAcopladoresTotal=(CantidadPigtails.value/2)
      }
      CapacidadDistribuidor=144
    }
  }
  if(Distribuidor == '1W'){
    StyleDisplayNoneOrBlock_2(CantidadPigtails, 'block', [0,1,2]);
    StyleDisplayNoneOrBlock_2(CantidadPigtails, 'none', [3,4,5,6,7,8,9,10,11]);
    StyleDisplayNoneOrBlock_2(TipoAcoplador, 'block', [0,1,2,3,4,5,6,7,8,9]);
    if( TipoAcoplador.value=='STU' || TipoAcoplador.value=='STP' || TipoAcoplador.value=='FCU' || TipoAcoplador.value=='FCP' ) {
      Puertos.selectedIndex = 1
      NumeroAcopladoresTotal=CantidadPigtails.value
      CapacidadDistribuidor=12
    }else if( ( TipoAcoplador.value=='SCU' || TipoAcoplador.value=='SCA' || TipoAcoplador.value=='SCP') ){
      if((CantidadPigtails.value >= 4 && CantidadPigtails.value <= 6)){
      Puertos.selectedIndex = 1
      NumeroAcopladoresTotal=(CantidadPigtails.value)
      }
      if(CantidadPigtails.value >6){
        Puertos.selectedIndex = 0
      NumeroAcopladoresTotal=(CantidadPigtails.value/2)
      }
      CapacidadDistribuidor=12
    }else{
      Puertos.selectedIndex = 0
      NumeroAcopladoresTotal=(CantidadPigtails.value/2)
      CapacidadDistribuidor=6
    }
    
  }
  if(Distribuidor == '2W'){
    StyleDisplayNoneOrBlock_2(CantidadPigtails, 'block', [0,1,2,3,4]);
    StyleDisplayNoneOrBlock_2(CantidadPigtails, 'none', [5,6,7,8,9,10,11]);
    StyleDisplayNoneOrBlock_2(TipoAcoplador, 'block', [0,1,2,3,4,5,6,7,8,9]);
    if( TipoAcoplador.value=='STU' || TipoAcoplador.value=='STP' || TipoAcoplador.value=='FCU' || TipoAcoplador.value=='FCP' ) {
      Puertos.selectedIndex = 1
      NumeroAcopladoresTotal=CantidadPigtails.value
      CapacidadDistribuidor=24
    }else if( ( TipoAcoplador.value=='SCU' || TipoAcoplador.value=='SCA' || TipoAcoplador.value=='SCP') ){
      if((CantidadPigtails.value >= 4 && CantidadPigtails.value <= 12)){
      Puertos.selectedIndex = 1
      NumeroAcopladoresTotal=(CantidadPigtails.value)
      }
      if(CantidadPigtails.value >12){
        Puertos.selectedIndex = 0
      NumeroAcopladoresTotal=(CantidadPigtails.value/2)
      }
      CapacidadDistribuidor=24
    }else{
      Puertos.selectedIndex = 0
      NumeroAcopladoresTotal=(CantidadPigtails.value/2)
      CapacidadDistribuidor=12
    }
    
  }
  if(Distribuidor == 'E2W'){
    StyleDisplayNoneOrBlock_2(CantidadPigtails, 'block', [0,1,2,3,4,5,6]);
    StyleDisplayNoneOrBlock_2(CantidadPigtails, 'none', [7,8,9,10,11]);
    StyleDisplayNoneOrBlock_2(TipoAcoplador, 'block', [0,1,2,3,4,5,6,7,8,9]);
    if( TipoAcoplador.value=='STU' || TipoAcoplador.value=='STP' || TipoAcoplador.value=='FCU' || TipoAcoplador.value=='FCP' ) {
      Puertos.selectedIndex = 1
      NumeroAcopladoresTotal=CantidadPigtails.value
      CapacidadDistribuidor=48
    }else if( ( TipoAcoplador.value=='SCU' || TipoAcoplador.value=='SCA' || TipoAcoplador.value=='SCP') ){
      if((CantidadPigtails.value >= 4 && CantidadPigtails.value <= 24)){
      Puertos.selectedIndex = 1
      NumeroAcopladoresTotal=(CantidadPigtails.value)
      }
      if(CantidadPigtails.value >24){
        Puertos.selectedIndex = 0
      NumeroAcopladoresTotal=(CantidadPigtails.value/2)
      }
      CapacidadDistribuidor=48
    }else{
      Puertos.selectedIndex = 0
      NumeroAcopladoresTotal=(CantidadPigtails.value/2)
      CapacidadDistribuidor=24
    }
    
  }

  if (TipoAcoplador.value == "LCP" || TipoAcoplador.value == "SCP" || TipoAcoplador.value == "FCP" || TipoAcoplador.value == "STP") {
      StyleDisplayNoneOrBlock_2(TipoFibra, 'block', [1,2,3,4])
      StyleDisplayNoneOrBlock_2(TipoFibra, 'none', [0])
      cont_1 == 0 ? TipoFibra.selectedIndex = 1 : ''
      cont_1++
      cont_2 = 0
  }else{
      StyleDisplayNoneOrBlock_2(TipoFibra, 'none', [1,2,3,4])
      StyleDisplayNoneOrBlock_2(TipoFibra, 'block', [0])
      cont_2 == 0 ? TipoFibra.selectedIndex = 0 : ''
      cont_2++
      cont_1 = 0
  }
  NumeroAcopladores.value=NumeroAcopladoresTotal
    //NumeroAcopladoresIdText.innerHTML = 'Número de acopladores '+NumeroAcopladoresMin+'~'+NumeroAcopladoresMax+':'
   CodigoGenerado = Marca+Ensamble+Familia+Unidad.value+NumeroConCeros2(NumeroAcopladoresTotal, 2)+TipoAcoplador.value+Puertos.value+TipoFibra.value+Pig
      // Obtener Precio
      let acoplador = TipoAcoplador.options[TipoAcoplador.selectedIndex].getAttribute('acoplador')
      let data = {
        Action: 'calcular',
        ActionCalcularPrecioPreconectorizados : true,
        Conector: TipoAcoplador.value,
        Distribuidor: Unidad.value,
        Capacidad: CapacidadDistribuidor,
        Acoplador: acoplador,
        TipoFibra: TipoFibra.value,
        Puerto: Puertos.value,
        NumeroAcopladores: CantidadPigtails.value,
        SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
      }
      calcularPrecioPreconectorizados(data)
      // Registrar descripción 
      let DescripcionProducto = document.getElementById('descripcion-producto-configurable')
      let Descripcion = DescripcionProducto.getAttribute('descripcion')+" con "+CantidadPigtails.value+" Pigtails "+TipoAcoplador.value+" "+TipoFibraDescripcion
      data = { Codigo: CodigoGenerado, Descripcion: Descripcion }
      NombreProductoConfigurable(data)
   
    
    // Agregación de codigo para la vista en el identificador
    showClave(CodigoGenerado)
    Directorio = Marca+Ensamble+Familia+Unidad.value
    ListImgProducto(Directorio)
    ListProductoDescription(Directorio)
    ListProductoAdicional(Directorio)
    agregarFichaTecnicaConfigurable(Marca+Ensamble+Familia+Unidad.value)
}
/**
 * Calcular precio 
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var calcularPrecioPreconectorizados = function(data) {
  ajax_('../../models/Productos/Distribuidores/Preconectorizados/PreconectorizadoCalcularPrecio.Route.php', 'POST', 'JSON', data, 
  function(response){
    if (!response.error) {
      $('#span-leyenda').remove()
      StyleDisplayNoneOrBlock(document.getElementById('btn-configurable'), 'block')
      StyleDisplayNoneOrBlock(document.getElementById('div-quantity'), 'block')
      document.getElementById('CostoProducto').value = response.precioNormal 
      document.getElementById('Costo').innerHTML = "$"+response.precio
    }else{
      ProductoEspecial()
    }
  })
}

var DistribuidoresPreconectorizados = function() {
  switch(Unidad.value){
    case '1U' : 
      DistribuidoresPreconectorizados_('1U')
    break;
    case '1E' : 
      DistribuidoresPreconectorizados_('1E')
    break;
    case '2U' : 
      DistribuidoresPreconectorizados_('2U')
    break;
    case '4U' : 
      DistribuidoresPreconectorizados_('4U')
    break;
    case '1W' : 
      DistribuidoresPreconectorizados_('1W')
    break;
    case '2W' : 
      DistribuidoresPreconectorizados_('2W')
    break;
    case 'E2W' : 
      DistribuidoresPreconectorizados_('E2W')
    break;
    default:
      templateAlert("warning", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
  }  
}

DistribuidoresPreconectorizados()