// Jumpers

var Marca = "OP"
var Familia = "JA"
var Jumper = document.getElementById('Cable')
var DescPrdConf = document.getElementById('DscProductoConfigurable')

var PosicionPulidoJumpers = [
  'A',
  'U'
]
function validateDecimalEntero(valor) {
  var patronEntero = /^\d*$/; 
  var patron1Decimal = /^\d*(\.\d{1})?\d{0}$/;
  if (patronEntero.test(valor) || patron1Decimal.test(valor)) {
      return true;
  } else {
      return false;
  }
}
function validateEntero(valor) {
  var patronEntero = /^\d*$/; 
  if (patronEntero.test(valor)) {
      return true;
  } else {
    //console.log('test'+valor.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1'))
    document.getElementById('Longitud').value=valor.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1')
  }
}

function JumperValidacionLongitud(Elem, Tamano){//Solo numeros
  if (Elem.value.indexOf('.') > -1)
  {
    let x = Elem.value.split(".", 2);
    if(x[0] == 999){
      Elem.value = Elem.value.substring(0,Tamano)
      return false
    }
    if(x[0].length <= 3){
      Elem.value = Elem.value.substring(0,x[0].length +2)
    }else{
      Elem.value = x[0].substring(0,Tamano)+'.'+x[1]
    }
  }else{
    if(Elem.value.length >= Tamano){
      Elem.value = Elem.value.substring(0,Tamano)
    }
  }
}





var JumpersMTP = function(){
  let Longitud = document.getElementById('Longitud')
  validateEntero(Longitud.value)
  JumperValidacionLongitud(Longitud, 3)

  let Conectarizacion = "A3"
  let Polaridad = document.getElementById('Polaridad')
  let Polaridadselected = Polaridad.options[Polaridad.selectedIndex].text
  let CantidadFibras = document.getElementById('CantidadFibras')
  let Diseno = document.getElementById('Diseno')
  let Disenoselected = Diseno.options[Diseno.selectedIndex].text
  let TipoFibra = document.getElementById('TipoFibra')
  let Fibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
  let TipoCable = 'R'
  let TipoCubierta = document.getElementById('TipoCubierta')
  
  let CodigoGenerado = ""
  
 
  let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
  Familia = "J"

  if(Longitud.value > 999){
    JumperValidacionLongitud(Longitud, 3)
  }
      
  if (Longitud.value > 0 && Longitud.value <= 999) {
    NewLongitud = NumeroConCeros2(Longitud.value, 3)
    CodigoGenerado = Marca+Familia+Conectarizacion+Conectarizacion+Polaridad.value+CantidadFibras.value+Diseno.value+TipoFibra.value+TipoCable+NewLongitud+TipoCubierta.value
    // Agreación de codigo para la vista en el identificador
    let descripcion = "Jumper MTP a MTP US CONEC Polaridad "+Polaridadselected+" de "+CantidadFibras.value+" hilos "+Disenoselected+" "+Fibraselected+" "+TipoCubiertaselected+" de "+Longitud.value+" metro(s) "
    
    NombreProductoConfigurable(CodigoGenerado, descripcion)
    DescPrdConf.innerHTML=descripcion

    ListImgProducto("OPJA3")
	  ListProductoDescription('OPJA3')
    ListProductoAdicional('OPJA3')
   
    let data = {
      Action: 'calcular',
      ActionCalcularPrecioMTP: true,
      Longitud: Longitud.value,
      Fibra: Fibraselected,
      CantidadFibras: CantidadFibras.value,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    CalcularPrecio("../../models/Productos/Jumpers/MTP/CalcularPrecioMTP.Route.php", data)
    //CalcularPrecio("../../models/Productos/Jumpers/MPO/CalcularPrecioMPO.Route.php", data)
    showClave(CodigoGenerado)
  }
 // agregarFichaTecnicaConfigurable('OPJA3')
 // agregarCertificadoConfigurable(CodigoGenerado)
}




var JumpersMPTLC = function(){
  let Longitud = document.getElementById('Longitud')
  validateEntero(Longitud.value)
  JumperValidacionLongitud(Longitud, 3)

  let ConectarizacionLadoA = document.getElementById('ConectorLadoA')
  let ConectarizacionLadoB = document.getElementById('ConectorLadoB')
  let Polaridad = document.getElementById('Polaridad')
  let Polaridadselected = Polaridad.options[Polaridad.selectedIndex].text
  let CantidadFibras = document.getElementById('CantidadFibras')
  let Diseno = document.getElementById('Diseno')
  let Disenoselected = Diseno.options[Diseno.selectedIndex].text
  let TipoFibra = document.getElementById('TipoFibra')
  let Fibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
  let NumeroHilos = CantidadFibras.options[CantidadFibras.selectedIndex].getAttribute('numerohilos')
  let TipoCable = 'R'
  let TipoCubierta = document.getElementById('TipoCubierta')
  let LongitudBreakOut = document.getElementById('LongitudBreakOut')
  let LongitudBreakOutselected = LongitudBreakOut.options[LongitudBreakOut.selectedIndex].text
  let CodigoGenerado = ""
  let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
  Familia = "J"

  if(Longitud.value > 999){
    JumperValidacionLongitud(Longitud, 3)
  }
      
  if (Longitud.value > 0 && Longitud.value <= 999) {
    NewLongitud = NumeroConCeros2(Longitud.value, 3)
    CodigoGenerado = Marca+Familia+ConectarizacionLadoA.value+Diseno.value+ConectarizacionLadoB.value+Polaridad.value+CantidadFibras.value+TipoFibra.value+TipoCable+NewLongitud+TipoCubierta.value+LongitudBreakOut.value
    // Agreación de codigo para la vista en el identificador
    let descripcion = "Jumper BreakOut MTP a LC duplex "+Polaridadselected+" de "+CantidadFibras.value+" hilos "+Disenoselected+" "+Fibraselected+" "+TipoCubiertaselected+" de "+Longitud.value+" metro(s) Break Out "+LongitudBreakOutselected
    NombreProductoConfigurable(CodigoGenerado, descripcion)
    DescPrdConf.innerHTML=descripcion
    //console.log(descripcion)
    ListImgProducto("OPJA3HAE")
    ListProductoDescription('OPJA3HAE')
    ListProductoAdicional('OPJA3HAE')
    let data = {
      Action: 'calcular',
      ActionCalcularPrecioMTPBreakOut: true,
      Longitud: Longitud.value,
      NumeroHilos: NumeroHilos,
      Fibra: TipoFibra.value,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    CalcularPrecio("../../models/Productos/Jumpers/MTPBreakOut/CalcularPrecioMTPBreakOut.Route.php", data)
  }
    showClave(CodigoGenerado)
    agregarFichaTecnicaConfigurable('OPJA3HAE')
    agregarCertificadoConfigurable(CodigoGenerado)
}

var JumpersMTPPRO = function(){
    let Longitud = document.getElementById('Longitud')
    validateEntero(Longitud.value)
    JumperValidacionLongitud(Longitud, 3)
  
    let Conectarizacion = "A5"
    let Polaridad = document.getElementById('Polaridad')
    let Polaridadselected = Polaridad.options[Polaridad.selectedIndex].text
    let CantidadFibras = document.getElementById('CantidadFibras')
    let Diseno = document.getElementById('Diseno')
    let Disenoselected = Diseno.options[Diseno.selectedIndex].text
    let TipoFibra = document.getElementById('TipoFibra')
    let Fibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let TipoCable = 'R'
    let TipoCubierta = document.getElementById('TipoCubierta')
    
    let CodigoGenerado = ""
    
    //CantidadFibras[0].style.display = "none"
    //TipoCubierta[0].style.display = "none"
    //TipoCubierta[1].style.display = "none"
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    Familia = "J"
  
    if(Longitud.value > 999){
      JumperValidacionLongitud(Longitud, 3)
    }
        
    if (Longitud.value > 0 && Longitud.value <= 999) {
      NewLongitud = NumeroConCeros2(Longitud.value, 3)
      CodigoGenerado = Marca+Familia+Conectarizacion+Conectarizacion+Polaridad.value+CantidadFibras.value+Diseno.value+TipoFibra.value+TipoCable+NewLongitud+TipoCubierta.value
      // Agreación de codigo para la vista en el identificador
      let descripcion = "Jumper MTP PRO a MTP PRO US CONEC Swap on site Polaridad "+Polaridadselected+" de "+CantidadFibras.value+" hilos "+Disenoselected+" "+Fibraselected+" "+TipoCubiertaselected+" de "+Longitud.value+" metro(s) "
      NombreProductoConfigurable(CodigoGenerado, descripcion)
      DescPrdConf.innerHTML=descripcion
     // console.log(descripcion)
     ListImgProducto("OPJA5")
        ListProductoDescription('OPJA5')
      ListProductoAdicional('OPJA5')
      let data = {
        Action: 'calcular',
        ActionCalcularPrecioMTPPro: true,
        Longitud: Longitud.value,
        Fibra: Fibraselected,
        CantidadFibras: CantidadFibras.value,
        SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
      }
    CalcularPrecio("../../models/Productos/Jumpers/MTPPro/CalcularPrecioMTPPro.Route.php", data)
      showClave(CodigoGenerado)
    }
    agregarFichaTecnicaConfigurable('OPJA5')
    agregarCertificadoConfigurable(CodigoGenerado)
  }

  var JumpersMTPPROLC = function(){
    let Longitud = document.getElementById('Longitud')
    validateEntero(Longitud.value)
    JumperValidacionLongitud(Longitud, 3)
  
    let ConectarizacionLadoA = document.getElementById('ConectorLadoA')
    let ConectarizacionLadoB = document.getElementById('ConectorLadoB')
    let Polaridad = document.getElementById('Polaridad')
    let Polaridadselected = Polaridad.options[Polaridad.selectedIndex].text
    let CantidadFibras = document.getElementById('CantidadFibras')
    let Diseno = document.getElementById('Diseno')
    let Disenoselected = Diseno.options[Diseno.selectedIndex].text
    let TipoFibra = document.getElementById('TipoFibra')
    let Fibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let NumeroHilos = CantidadFibras.options[CantidadFibras.selectedIndex].getAttribute('numerohilos')
    let TipoCable = 'R'
    let TipoCubierta = document.getElementById('TipoCubierta')
    let LongitudBreakOut = document.getElementById('LongitudBreakOut')
    let LongitudBreakOutselected = LongitudBreakOut.options[LongitudBreakOut.selectedIndex].text
    let CodigoGenerado = ""
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    Familia = "J"
  
    if(Longitud.value > 999){
      JumperValidacionLongitud(Longitud, 3)
    }
        
    if (Longitud.value > 0 && Longitud.value <= 999) {
      NewLongitud = NumeroConCeros2(Longitud.value, 3)
      CodigoGenerado = Marca+Familia+ConectarizacionLadoA.value+Diseno.value+ConectarizacionLadoB.value+Polaridad.value+CantidadFibras.value+TipoFibra.value+TipoCable+NewLongitud+TipoCubierta.value+LongitudBreakOut.value
      // Agreación de codigo para la vista en el identificador
      let descripcion = "Cable Break-Out MTP PRO a LC dúplex "+Polaridadselected+" de "+CantidadFibras.value+" hilos "+Disenoselected+" "+Fibraselected+" "+TipoCubiertaselected+" de "+Longitud.value+" metro(s) Break Out "+ LongitudBreakOutselected
      NombreProductoConfigurable(CodigoGenerado, descripcion)
      DescPrdConf.innerHTML=descripcion
      //console.log(descripcion)
      ListImgProducto("OPJA5MAE")
      ListProductoDescription('OPJA5MAE')
      ListProductoAdicional('OPJA5MAE')
      let data = {
        Action: 'calcular',
        ActionCalcularPrecioMTPProBreakOut: true,
        Longitud: Longitud.value,
        NumeroHilos: NumeroHilos,
        Fibra: TipoFibra.value,
        SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
      }
      CalcularPrecio("../../models/Productos/Jumpers/MTPProBreakOut/CalcularPrecioMTPProBreakOut.Route.php", data)
    }
      showClave(CodigoGenerado)
      agregarFichaTecnicaConfigurable('OPJA5MAE')
      agregarCertificadoConfigurable(CodigoGenerado)
  }

  var JumpersMPO = function(){
    let Longitud = document.getElementById('Longitud')
    //validateEntero(Longitud.value)
    JumperValidacionLongitud(Longitud, 3)
  
    let Conectarizacion="A1"
    let Polaridad = document.getElementById('Polaridad')
    let Polaridadselected = Polaridad.options[Polaridad.selectedIndex].text
    let CantidadFibras = document.getElementById('CantidadFibras')
    let Diseno = document.getElementById('Diseno')
    let Disenoselected = Diseno.options[Diseno.selectedIndex].text
    let TipoFibra = document.getElementById('TipoFibra')
    let Fibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let TipoCable = 'R'
    let TipoCubierta = document.getElementById('TipoCubierta')

    let CodigoGenerado = ""
    
    if(TipoFibra.value=='09'){
       Conectarizacion = "A2"
    }else{
       Conectarizacion = "A1"
    }

    CantidadFibras[0].style.display = "none"
    CantidadFibras[1].selected = true
    TipoCubierta[0].style.display = "none"
    TipoCubierta[1].style.display = "none"
    TipoCubierta[2].selected = "selected"
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    Familia = "J"
  
    if(Longitud.value > 500){
      JumperValidacionLongitud(Longitud, 2)
    }
        
    if (Longitud.value >= 1 && Longitud.value <= 500) {
      if (Longitud.value.includes(".")) {
        NewLongitud = NumeroConCeros(Longitud.value, 4)
      }else{
        NewLongitud = NumeroConCeros(Longitud.value, 3)
      }
      CodigoGenerado = Marca+Familia+Conectarizacion+Conectarizacion+Polaridad.value+CantidadFibras.value+Diseno.value+TipoFibra.value+TipoCable+NewLongitud+TipoCubierta.value
      // Agreación de codigo para la vista en el identificador
      let descripcion = "Jumper MPO "+Polaridadselected+" de "+CantidadFibras.value+" hilos "+Disenoselected+" "+Fibraselected+" "+TipoCubiertaselected+" de "+Longitud.value+" metro(s) "
      NombreProductoConfigurable(CodigoGenerado, descripcion)
      DescPrdConf.innerHTML=descripcion
      ChangeListImgProducto('OPJ'+Conectarizacion+Conectarizacion,'OPJ'+Conectarizacion+Conectarizacion+Polaridad.value+Diseno.value)
      ListProductoDescription('OPJ'+Conectarizacion+Conectarizacion)
      ListProductoAdicional('OPJ'+Conectarizacion+Conectarizacion)
      let data = {
        Action: 'calcular',
        ActionCalcularPrecioMPO: true,
        Longitud: Longitud.value,
        Fibra: Fibraselected,
        CantidadFibras: CantidadFibras.value,
        SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
      }
      CalcularPrecio("../../models/Productos/Jumpers/MPO/CalcularPrecioMPO.Route.php", data)
      showClave(CodigoGenerado)
    }else{
      showClave('')
    }
    agregarFichaTecnicaConfigurable('OPJ'+Conectarizacion+Conectarizacion)
    agregarCertificadoConfigurable(CodigoGenerado)
  }
  
  var JumpersMPOBreakOut = function(){
    let Longitud = document.getElementById('Longitud')
    validateEntero(Longitud.value)
    JumperValidacionLongitud(Longitud, 3)
  
    let ConectarizacionLadoA = document.getElementById('ConectorLadoA')
    let ConectarizacionLadoB = document.getElementById('ConectorLadoB')
    let Polaridad = document.getElementById('Polaridad')
    let Polaridadselected = Polaridad.options[Polaridad.selectedIndex].text
    let CantidadFibras = document.getElementById('CantidadFibras')
    let Diseno = document.getElementById('Diseno')
    let Disenoselected = Diseno.options[Diseno.selectedIndex].text
    let TipoFibra = document.getElementById('TipoFibra')
    let Fibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let NumeroHilos = CantidadFibras.options[CantidadFibras.selectedIndex].getAttribute('numerohilos')
    let TipoCable = 'R'
    let TipoCubierta = document.getElementById('TipoCubierta')
    let LongitudBreakOut = document.getElementById('LongitudBreakOut')
    let CodigoGenerado = ""
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    Familia = "J"
  
    if(Longitud.value > 100){
      JumperValidacionLongitud(Longitud, 2)
    }
        
    if (Longitud.value > 0 && Longitud.value <= 100) {
      NewLongitud = NumeroConCeros2(Longitud.value, 3)
      CodigoGenerado = Marca+Familia+ConectarizacionLadoA.value+Diseno.value+ConectarizacionLadoB.value+Polaridad.value+CantidadFibras.value+TipoFibra.value+TipoCable+NewLongitud+TipoCubierta.value+LongitudBreakOut.value
      // Agreación de codigo para la vista en el identificador
      let descripcion = "Jumper MPO-BreakOut "+Polaridadselected+" de "+CantidadFibras.value+" hilos "+Disenoselected+" "+Fibraselected+" "+TipoCubiertaselected+" de "+Longitud.value+" metro(s) "
      NombreProductoConfigurable(CodigoGenerado, descripcion)
      DescPrdConf.innerHTML=descripcion
   
      ListImgProducto("OPJA1xAE")
      ListProductoDescription('OPJA1xAE')
      ListProductoAdicional('OPJA1xAE')
      let data = {
        Action: 'calcular',
        ActionCalcularPrecioMPOBreakOut: true,
        Longitud: Longitud.value,
        NumeroHilos: NumeroHilos,
        Fibra: TipoFibra.value,
        SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
      }
      CalcularPrecio("../../models/Productos/Jumpers/MPOBreakOut/CalcularPrecioMPOBreakOut.Route.php", data)
    }
      showClave(CodigoGenerado)
      agregarFichaTecnicaConfigurable('OPJA1xAE')
      agregarCertificadoConfigurable(CodigoGenerado)
  }


var JumpersMTPUS = function() {
  switch(Jumper.value){
    case 'JMPO' : 
      JumpersMPO()
    break;
    case 'JMPOBO' : 
      JumpersMPOBreakOut()
    break;
    case 'MTPMTP' : 
      JumpersMTP()
    break;
    case 'MTPLC' : 
      JumpersMPTLC()
    break;
    case 'MTPMTPS' : 
      JumpersMTPPRO()
    break;
    case 'MTPPPLC' : 
      JumpersMTPPROLC()
    break;
    default:
      templateAlert("warning", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
  }  
}

JumpersMTPUS()