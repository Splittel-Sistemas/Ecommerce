// Jumpers

var Marca = "OP"
var Familia = "JU"
var Jumper = document.getElementById('Cable')
var DescPrdConf = document.getElementById('DscProductoConfigurable')

var PosicionConectorJumpers = [
  'LC',
  'SC',
  'ST',
  'FC',
  'MU',
  'E2',
  'MT'
];

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

var contJumperMultimodo = 0;
var JumpersMultimodo = async function(){
  let Longitud = document.getElementById('Longitud')
  JumperValidacionLongitud(Longitud, 3)

  let Conector1 = document.getElementById('Conector1')
  let Conector2 = document.getElementById('Conector2')
  // let TipoFibra = document.getElementById('TipoFibra')
  let MultimodoTipoFibra = document.getElementById('MultimodoTipoFibra')
  let MonomodoTipoFibraSelect = document.getElementById('MonomodoTipoFibraSelect')
  let TipoCubierta = document.getElementById('TipoCubierta')
  let NumeroHilos = document.getElementById('NumeroHilos')
  let NumeroHilosSelect = document.getElementById('NumeroHilosSelect')
  let Diametro = document.getElementById('Diametro')
  let PulidoConector1 = document.getElementById('PulidoConector1')
  let PulidoConector2 = document.getElementById('PulidoConector2')

  let PosicionConector1 = Conector1.options[Conector1.selectedIndex].getAttribute('position')
  let PosicionConector2 = Conector2.options[Conector2.selectedIndex].getAttribute('position')
  let PosicionPulidoConector1 = PulidoConector1.options[PulidoConector1.selectedIndex].getAttribute('position')
  let PosicionPulidoConector2 = PulidoConector2.options[PulidoConector2.selectedIndex].getAttribute('position')
  let CodigoGenerado = ""

    RemoveOptionsSelect(PulidoConector1, [1,2])
    RemoveOptionsSelect(PulidoConector2, [1,2])
    StyleDisplayNoneOrBlock(MonomodoTipoFibraSelect, 'none')
    StyleDisplayNoneOrBlock(NumeroHilosSelect, "block")

  

  if (PosicionConector1 == PosicionConector2) {
    if (PosicionPulidoConector1 < PosicionPulidoConector2) {
      NewConector1 = PosicionConectorJumpers[PosicionConector1]
      NewConector2 = PosicionConectorJumpers[PosicionConector2]
      NewPulidoConector1 = PulidoConector1.value
      NewPulidoConector2 = PulidoConector2.value
    }else{
      NewConector1 = PosicionConectorJumpers[PosicionConector2]
      NewConector2 = PosicionConectorJumpers[PosicionConector1]
      NewPulidoConector1 = PulidoConector2.value
      NewPulidoConector2 = PulidoConector1.value
    }
  }else{
    if (PosicionConector1 < PosicionConector2) {
      NewConector1 = PosicionConectorJumpers[PosicionConector1]
      NewConector2 = PosicionConectorJumpers[PosicionConector2]
      NewPulidoConector1 = PulidoConector1.value
      NewPulidoConector2 = PulidoConector2.value
    }else{
      NewConector1 = PosicionConectorJumpers[PosicionConector2]
      NewConector2 = PosicionConectorJumpers[PosicionConector1]
      NewPulidoConector1 = PulidoConector2.value
      NewPulidoConector2 = PulidoConector1.value
    }
  }

  if (Conector1.value == 'MT' || Conector2.value == 'MT') {
    NumeroHilos.value = 'D'
    contJumperMultimodo == 0 ? Diametro.selectedIndex = 0 : '';
    contJumperMultimodo++
    StyleDisplayNoneOrBlock_2(Diametro, 'none', [2])
    StyleDisplayNoneOrBlock_2(Diametro, 'none', [1])
    StyleDisplayNoneOrBlock_2(NumeroHilos, 'none', [0])
    StyleDisplayNoneOrBlock_2(NumeroHilos, 'block', [1])
  }else{
    contJumperMultimodo = 0
    StyleDisplayNoneOrBlock_2(Diametro, 'block', [2])
    StyleDisplayNoneOrBlock_2(NumeroHilos, 'block', [0])
  }

  if(TipoCubierta.value=="RI" && (MultimodoTipoFibra.value=="62" || MultimodoTipoFibra.value=="50")
   && (Conector1.value != 'MT' && Conector2.value != 'MT')){
    StyleDisplayNoneOrBlock_2(Diametro, 'block', [0,1,2])
  }else{
    StyleDisplayNoneOrBlock_2(Diametro, 'none', [2])
    if(Diametro.value==3)
      Diametro.selectedIndex = 0
  }

  if(MultimodoTipoFibra.value == "57" ){
    StyleDisplayNoneOrBlock_2(TipoCubierta, 'none', [0,1])
    TipoCubierta.selectedIndex = 2
  }else{
    StyleDisplayNoneOrBlock_2(TipoCubierta, 'block', [0,1,2])
  }


  if (Longitud.value > 0 && Longitud.value <= 999) {
    NewLongitud = NumeroConCeros(Longitud.value, 4)
    CodigoGenerado = Marca+Familia+NewConector1+NewPulidoConector1+NewConector2+NewPulidoConector2+MultimodoTipoFibra.value+NumeroHilos.value+NewLongitud+TipoCubierta.value+Diametro.value
    // Agreación de codigo para la vista en el identificador
    showClave(CodigoGenerado)

    let data = {
      Action: 'calcular',
      ActionCalcularPrecio : true, 
      Longitud: Longitud.value,
      Tipo: 'MM', // Tipo de jumper de acuerdo al catalogo de bd Multimodo
      Conector_1: NewConector1,
      Conector_2: NewConector2,
      Fibra : MultimodoTipoFibra.value,
      Pulido_1 : NewPulidoConector1,
      Pulido_2 : NewPulidoConector2,
      Cubierta : TipoCubierta.value,
      NumeroHilos : NumeroHilos.value,
      Codigo: CodigoGenerado,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    await CalcularPrecio("../../models/Productos/Jumpers/CalcularPrecio.Route.php", data)
    
    let Fibraselected = MultimodoTipoFibra.options[MultimodoTipoFibra.selectedIndex].text
    let TipoCubiertaselected=TipoCubierta.options[TipoCubierta.selectedIndex].text
    let Hiloselected=NumeroHilos.options[NumeroHilos.selectedIndex].text
    let Diametroselected=Diametro.options[Diametro.selectedIndex].text

    let descripcion_mpo = "Jumper Multimodo "+Conector1.value+PulidoConector1.value+'-'+Conector2.value+PulidoConector2.value+" "+Fibraselected+" "+TipoCubiertaselected+" "+Hiloselected+" de "+Diametroselected+" de "+Longitud.value+" metro(s) "
    NombreProductoConfigurable(CodigoGenerado, descripcion_mpo)
    DescPrdConf.innerHTML=descripcion_mpo
  }

  ChangeListImgProducto('OPJULCP','OPJU'+NewConector1+NewPulidoConector1+NewConector2+NewPulidoConector2+MultimodoTipoFibra.value+NumeroHilos.value)
  ListProductoDescription('OPJULCP')
  ListProductoAdicional('OPJULCP')
  agregarFichaTecnicaConfigurable('OPJULCP')
  agregarCertificadoConfigurable(CodigoGenerado)
  existJumper_(CodigoGenerado)
}

var JumpersMonomodo = async function(){
  let Longitud = document.getElementById('Longitud')
  JumperValidacionLongitud(Longitud, 3)

  let Conector1 = document.getElementById('Conector1')
  let Conector2 = document.getElementById('Conector2')
  let TipoFibra = document.getElementById('TipoFibra')
  let MonomodoTipoFibra = document.getElementById('MonomodoTipoFibra')
  let MultimodoTipoFibraSelect = document.getElementById('MultimodoTipoFibraSelect')
  let TipoCubierta = document.getElementById('TipoCubierta')
  let NumeroHilos = document.getElementById('NumeroHilos')
  let NumeroHilosSelect = document.getElementById('NumeroHilosSelect')
  let Diametro = document.getElementById('Diametro')
  let PulidoConector1 = document.getElementById('PulidoConector1')
  let PulidoConector2 = document.getElementById('PulidoConector2')
  let PulidoConector1Select = document.getElementById('PulidoConector1Select')
  let PulidoConector2Select = document.getElementById('PulidoConector2Select')

  let PosicionConector1 = Conector1.options[Conector1.selectedIndex].getAttribute('position')
  let PosicionConector2 = Conector2.options[Conector2.selectedIndex].getAttribute('position')
  let PosicionPulidoConector1 = PulidoConector1.options[PulidoConector1.selectedIndex].getAttribute('position')
  let PosicionPulidoConector2 = PulidoConector2.options[PulidoConector2.selectedIndex].getAttribute('position')
  let CodigoGenerado = ""

    RemoveOptionsSelect(PulidoConector1, 2)
    RemoveOptionsSelect(PulidoConector2, 2)
    StyleDisplayNoneOrBlock(MultimodoTipoFibraSelect, 'none')
    StyleDisplayNoneOrBlock(NumeroHilosSelect, 'block')
    StyleDisplayNoneOrBlock(PulidoConector1Select, 'block')
    StyleDisplayNoneOrBlock(PulidoConector2Select, 'block')
    StyleDisplayNoneOrBlock_2(PulidoConector1, 'block', [0,1])
    StyleDisplayNoneOrBlock_2(PulidoConector2, 'block', [0,1])
    StyleDisplayNoneOrBlock_2(Diametro, 'block', [0,1,2])

    StyleDisplayNoneOrBlock_2(MonomodoTipoFibra, 'block', [0,1,2])
    
    if (Conector2.value == "MU" || Conector2.value == "ST" ) {
      PulidoConector2[0].style.display = "none"
      PulidoConector2.selectedIndex = 1
    }

    if (Conector1.value == "MU" || Conector1.value == "ST") {
      PulidoConector1[0].style.display = "none"
      PulidoConector1.selectedIndex = 1
    }

    if (Conector1.value == "E2") {
      PulidoConector1[1].style.display = "none"
      PulidoConector1.selectedIndex = 0
      Diametro.selectedIndex = 1
      StyleDisplayNoneOrBlock_2(Diametro, 'none', [0,2])
    }

    if (Conector2.value == "E2") {
      PulidoConector2[1].style.display = "none"
      PulidoConector2.selectedIndex = 0
      Diametro.selectedIndex = 1
      StyleDisplayNoneOrBlock_2(Diametro, 'none', [0,2])
    }

    if((Conector1.value=='E2' || Conector1.value=='MU') || ((Conector2.value=='E2' || Conector2.value=='MU'))){
      if(Diametro.selectedIndex==2)
        Diametro.selectedIndex = 1
      StyleDisplayNoneOrBlock_2(Diametro, 'none', [2])
    }

    if (PosicionConector1 == PosicionConector2) {
      if (PosicionPulidoConector1 < PosicionPulidoConector2) {
        NewConector1 = PosicionConectorJumpers[PosicionConector1]
        NewConector2 = PosicionConectorJumpers[PosicionConector2]
        NewPulidoConector1 = PulidoConector1.value
        NewPulidoConector2 = PulidoConector2.value
      }else{
        NewConector1 = PosicionConectorJumpers[PosicionConector2]
        NewConector2 = PosicionConectorJumpers[PosicionConector1]
        NewPulidoConector1 = PulidoConector2.value
        NewPulidoConector2 = PulidoConector1.value
      }
    }else{
      if (PosicionConector1 < PosicionConector2) {
        NewConector1 = PosicionConectorJumpers[PosicionConector1]
        NewConector2 = PosicionConectorJumpers[PosicionConector2]
        NewPulidoConector1 = PulidoConector1.value
        NewPulidoConector2 = PulidoConector2.value
      }else{
        NewConector1 = PosicionConectorJumpers[PosicionConector2]
        NewConector2 = PosicionConectorJumpers[PosicionConector1]
        NewPulidoConector1 = PulidoConector2.value
        NewPulidoConector2 = PulidoConector1.value
      }
    }
    //inhabilita cero halogeno 3mm
    if(TipoCubierta.value=="ZH"){
      StyleDisplayNoneOrBlock_2(Diametro, 'none', [2])
      if(Diametro.value==3)
        Diametro.selectedIndex = 0
    }
    if(Diametro.selectedIndex == 0 || Diametro.selectedIndex == 2){
      StyleDisplayNoneOrBlock_2(MonomodoTipoFibra, 'none', [1,2])
      MonomodoTipoFibra.selectedIndex=0
    }else{
      StyleDisplayNoneOrBlock_2(MonomodoTipoFibra, 'none', [0,1])
      MonomodoTipoFibra.selectedIndex=2
    }

    
    if (Longitud.value > 0 && Longitud.value <= 999) {
      NewLongitud = NumeroConCeros(Longitud.value, 4)
      CodigoGenerado = Marca+Familia+NewConector1+NewPulidoConector1+NewConector2+NewPulidoConector2+MonomodoTipoFibra.value+NumeroHilos.value+NewLongitud+TipoCubierta.value+Diametro.value
      // Agreación de codigo para la vista en el identificador
      showClave(CodigoGenerado)

      let data = {
        Action: 'calcular',
        ActionCalcularPrecio : true, 
        Longitud: Longitud.value,
        Tipo: 'SM', // Tipo de jumper de acuerdo al catalogo de bd Monomodo
        Conector_1: NewConector1,
        Conector_2: NewConector2,
        Fibra : MonomodoTipoFibra.value,
        Pulido_1 : NewPulidoConector1,
        Pulido_2 : NewPulidoConector2,
        Cubierta : TipoCubierta.value,
        NumeroHilos : NumeroHilos.value,
        Codigo: CodigoGenerado,
        SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
      }
      await CalcularPrecio("../../models/Productos/Jumpers/CalcularPrecio.Route.php", data)

      let Fibraselected = MonomodoTipoFibra.options[MonomodoTipoFibra.selectedIndex].text
      let TipoCubiertaselected=TipoCubierta.options[TipoCubierta.selectedIndex].text
      let Hiloselected=NumeroHilos.options[NumeroHilos.selectedIndex].text
      let Diametroselected=Diametro.options[Diametro.selectedIndex].text
  
      let descripcion = "Jumper Monomodo "+Conector1.value+PulidoConector1.value+'-'+Conector2.value+PulidoConector2.value+" "+Fibraselected+" "+TipoCubiertaselected+" "+Hiloselected+" de "+Diametroselected+" de "+Longitud.value+" metro(s) "
      NombreProductoConfigurable(CodigoGenerado, descripcion)
      DescPrdConf.innerHTML=descripcion
    }
    if(Diametro.value==3){
        ChangeListImgProducto('OPJULCU','OPJU'+NewConector1+NewPulidoConector1+NewConector2+NewPulidoConector2+MonomodoTipoFibra.value+NumeroHilos.value+Diametro.value)
    }else{
         ChangeListImgProducto('OPJULCU','OPJU'+NewConector1+NewPulidoConector1+NewConector2+NewPulidoConector2+MonomodoTipoFibra.value+NumeroHilos.value)
    }
    ListProductoDescription('OPJULCU')
    ListProductoAdicional('OPJULCU')
    agregarFichaTecnicaConfigurable('OPJULCU')
    agregarCertificadoConfigurable(CodigoGenerado)
    existJumper_(CodigoGenerado)
}

var JumpersEspeciales = async function(){
  let Longitud = document.getElementById('Longitud')
  // conectores 
  let Conector1 = document.getElementById('Conector1')
  let Conector2 = document.getElementById('Conector2')
  // botas 
  let Bota1 = document.getElementById('Bota1')
  let Bota2 = document.getElementById('Bota2')
  // pulidos
  let PulidoConector1 = document.getElementById('Pulido1')
  let PulidoConector2 = document.getElementById('Pulido2')
  // Tipo de fibra
  let MultimodoTipoFibra = document.getElementById('MultimodoTipoFibra')

  // Elementos no necesarios 
  let TipoCubierta = document.getElementById('TipoCubierta')
  let NumeroHilos = document.getElementById('NumeroHilos')
  let Diametro = document.getElementById('Diametro')

  if(MultimodoTipoFibra.value=='9'){
    StyleDisplayNoneOrBlock_2(PulidoConector1, 'block', [0,1])
    StyleDisplayNoneOrBlock_2(PulidoConector1, 'none', [2])
    if(PulidoConector1.value=='P'){
        PulidoConector1.selectedIndex = 0
      }
      StyleDisplayNoneOrBlock_2(PulidoConector2, 'block', [0,1])
      StyleDisplayNoneOrBlock_2(PulidoConector2, 'none', [2])
      if(PulidoConector2.value=='P'){
          PulidoConector2.selectedIndex = 0
        }

        if(Conector2.value=='ST'){
          StyleDisplayNoneOrBlock_2(PulidoConector2, 'block', [0])
          StyleDisplayNoneOrBlock_2(PulidoConector2, 'none', [1,2])
          PulidoConector2.selectedIndex = 0
        }else{
          StyleDisplayNoneOrBlock_2(PulidoConector2, 'block', [0,1])
        }


  }else{
    StyleDisplayNoneOrBlock_2(PulidoConector1, 'none', [0,1])
    StyleDisplayNoneOrBlock_2(PulidoConector1, 'block', [2])
    if(PulidoConector1.value=='U' || PulidoConector1.value=='A'){
        PulidoConector1.selectedIndex = 2
      }
      StyleDisplayNoneOrBlock_2(PulidoConector2, 'none', [0,1])
      StyleDisplayNoneOrBlock_2(PulidoConector2, 'block', [2])
      if(PulidoConector2.value=='U' || PulidoConector2.value=='A'){
          PulidoConector2.selectedIndex = 2
        }
  }
  if(Conector1.value=='SC'){
    StyleDisplayNoneOrBlock_2(Bota1, 'none', [0])
    if(Bota1.value=='M'){
      Bota1.selectedIndex = 1
    }
  }else{
    StyleDisplayNoneOrBlock_2(Bota1, 'block', [0,1])
  }
  if(Conector2.value=='SC'){
    StyleDisplayNoneOrBlock_2(Bota2, 'none', [0])
    StyleDisplayNoneOrBlock_2(Bota2, 'block', [1,2])
    if(Bota2.value=='M'){
      Bota2.selectedIndex = 1
    }

  }
  if(Conector2.value=='LC'){
    StyleDisplayNoneOrBlock_2(Bota2, 'block', [0,1,2])
  }
  if(Conector2.value=='ST' || Conector2.value=='FC' ){
    StyleDisplayNoneOrBlock_2(Bota2, 'none', [0,1])
    StyleDisplayNoneOrBlock_2(Bota2, 'block', [2])
    Bota2.selectedIndex = 2

  }
  if(Conector2.value+PulidoConector2.value=='LCA' && Conector1.value+PulidoConector1.value!='LCA'){
    NewPosConector1=Conector2.value+PulidoConector2.value+Bota2.value
    NewPosConector2=Conector1.value+PulidoConector1.value+Bota1.value
  }else if((Conector2.value+PulidoConector2.value=='LCU' && (Conector1.value+PulidoConector1.value!='LCA' && Conector1.value+PulidoConector1.value!='LCU') ))
  {
    NewPosConector1=Conector2.value+PulidoConector2.value+Bota2.value
    NewPosConector2=Conector1.value+PulidoConector1.value+Bota1.value
  }else if(Conector2.value+PulidoConector2.value=='LCP' && Conector1.value+PulidoConector1.value!='LCP'){
    NewPosConector1=Conector2.value+PulidoConector2.value+Bota2.value
    NewPosConector2=Conector1.value+PulidoConector1.value+Bota1.value
  }else if(Conector2.value+PulidoConector2.value=='SCA' && (Conector1.value+PulidoConector1.value!='SCA' && Conector1.value+PulidoConector1.value!='LCA' && Conector1.value+PulidoConector1.value!='LCU') ){
    NewPosConector1=Conector2.value+PulidoConector2.value+Bota2.value
    NewPosConector2=Conector1.value+PulidoConector1.value+Bota1.value
  }else{
    if((Bota1.value=='R' && Bota2.value=='M') && (Conector1.value+PulidoConector1.value==Conector2.value+PulidoConector2.value)){
      NewPosConector1=Conector1.value+PulidoConector1.value+Bota2.value
      NewPosConector2=Conector2.value+PulidoConector2.value+Bota1.value
    }else{
      NewPosConector1=Conector1.value+PulidoConector1.value+Bota1.value
      NewPosConector2=Conector2.value+PulidoConector2.value+Bota2.value
    }
  }

  if (Longitud.value > 0 && Longitud.value <= 999.9 && validateDecimalEntero(Longitud.value)) {
    NewLongitud = NumeroConCeros(Longitud.value, 4)
    CodigoGenerado = Marca+Familia+NewPosConector1+NewPosConector2+MultimodoTipoFibra.value+NumeroHilos.value+NewLongitud+TipoCubierta.value+Diametro.value
    // Agreación de codigo para la vista en el identificador
    showClave(CodigoGenerado)
    let data = {
      Action: 'calcular',
      ActionCalcularPrecioEspeciales : true, 
      Longitud: Longitud.value,
      TipoJumper: MultimodoTipoFibra.value == 9 ? 'SM' : 'MM', // Tipo de jumper de acuerdo al catalogo de bd Monomodo
      Conector_1: Conector1.value,
      Conector_2: Conector2.value,
      Fibra : MultimodoTipoFibra.value,
      Pulido_1 : PulidoConector1.value,
      Pulido_2 : PulidoConector2.value,
      Cubierta : TipoCubierta.value,
      NumeroHilos : NumeroHilos.value,
      Bota_1 : Bota1.value,
      Bota_2 : Bota2.value,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
     await CalcularPrecio("../../models/Productos/Jumpers/Especiales/CalcularPrecioEspeciales.Route.php", data)
    let Fibraselected = MultimodoTipoFibra.options[MultimodoTipoFibra.selectedIndex].text
    let TipoCubiertaselected=TipoCubierta.options[TipoCubierta.selectedIndex].text
    let Hiloselected=NumeroHilos.options[NumeroHilos.selectedIndex].text
    let Diametroselected=Diametro.options[Diametro.selectedIndex].text
    let Bota1selected=Bota1.options[Bota1.selectedIndex].text
    let Bota2selected=Bota2.options[Bota2.selectedIndex].text
    
    let descripcion = "Jumper Bota Especial "+Conector1.value+PulidoConector1.value+' '+Bota1selected+'-'+Conector2.value+PulidoConector2.value+' '+Bota2selected+" "+Fibraselected+" "+TipoCubiertaselected+" "+Hiloselected+" de "+Diametroselected+" de "+Longitud.value+" metro(s) "
    NombreProductoConfigurable(CodigoGenerado, descripcion)
    DescPrdConf.innerHTML=descripcion
  }else{
    CodigoGenerado='';
    showClave(CodigoGenerado)
    DescPrdConf.innerHTML=''
  }
  ChangeListImgProducto('OPJUESP',Marca+Familia+NewPosConector1+NewPosConector2+MultimodoTipoFibra.value+NumeroHilos.value)
  if(MultimodoTipoFibra.value == 9 ){ 
    ListProductoDescription('OPJUESP/SM')
    ListProductoAdicional('OPJUESP/SM')
  } else{
    ListProductoDescription('OPJUESP/MM')
    ListProductoAdicional('OPJUESP/MM')
  }
  agregarFichaTecnicaConfigurable('OPJUESP')
  agregarCertificadoConfigurable(CodigoGenerado)
  existJumper_(CodigoGenerado)
}

var JumpersArmados = async function(){
  let Longitud = document.getElementById('Longitud')
  JumperValidacionLongitud(Longitud, 3)
  // conectores 
  let Conector1 = document.getElementById('Conector1')
  let Conector2 = document.getElementById('Conector2')
  // pulidos
  let PulidoConector1 = document.getElementById('PulidoConector1')
  let PulidoConector2 = document.getElementById('PulidoConector2')
  // Tipo de fibra
  let MultimodoTipoFibra = document.getElementById('MultimodoTipoFibra')

  // Elementos no necesarios 
  let MonomodoTipoFibraSelect = document.getElementById('MonomodoTipoFibraSelect')
  let TipoCubierta = document.getElementById('TipoCubierta')
  let NumeroHilos = document.getElementById('NumeroHilos')
  let Diametro = document.getElementById('Diametro')

  // obtención posición opciones select 
  let PosicionConector1 = Conector1.options[Conector1.selectedIndex].getAttribute('position')
  let PosicionConector2 = Conector2.options[Conector2.selectedIndex].getAttribute('position')
  let PosicionPulidoConector1 = PulidoConector1.options[PulidoConector1.selectedIndex].getAttribute('position')
  let PosicionPulidoConector2 = PulidoConector2.options[PulidoConector2.selectedIndex].getAttribute('position')

  let CodigoGenerado = ""

    StyleDisplayNoneOrBlock(MonomodoTipoFibraSelect, 'none')

    StyleDisplayNoneOrBlock_2(NumeroHilos, 'none', [1])
    StyleDisplayNoneOrBlock_2(TipoCubierta, 'none', [0,1,2])
    StyleDisplayNoneOrBlock_2(Diametro, 'none', [0,1])

    TipoCubierta.selectedIndex = 3
    Diametro.selectedIndex = 2
    NumeroHilos.selectedIndex = 0

    RemoveOptionSelect(Conector1, 4)
    RemoveOptionSelect(Conector2, 4)

    StyleDisplayNoneOrBlock_2(MultimodoTipoFibra, 'none', [1])
    StyleDisplayNoneOrBlock_2(PulidoConector1, 'block', [0,1,2])
    StyleDisplayNoneOrBlock_2(PulidoConector2, 'block', [0,1,2])

    // Tipo de fibra monomodo
    if(MultimodoTipoFibra.value == '09'){
      PulidoConector1.value == 'P' ? PulidoConector1.selectedIndex = 0 : ''
      PulidoConector2.value == 'P' ? PulidoConector2.selectedIndex = 0 : ''

      PulidoConector1[2].style.display = "none"
      PulidoConector2[2].style.display = "none"

      if(Conector1.value == 'ST'){
        PulidoConector1[0].style.display = "none"
        PulidoConector1.value == 'A' ? PulidoConector1.selectedIndex = 1  : ''
      }

      if(Conector2.value == 'ST'){
        PulidoConector2[0].style.display = "none"
        PulidoConector2.value == 'A' ? PulidoConector2.selectedIndex = 1  : ''
      }
    }else{
      PulidoConector1.value == 'P' ? PulidoConector1.selectedIndex = 0  : ''
      PulidoConector1[2].style.display = "block"
      PulidoConector1.selectedIndex = 2
      StyleDisplayNoneOrBlock_2(PulidoConector1, 'none', [0,1])

      PulidoConector2.value == 'P' ? PulidoConector2.selectedIndex = 0  : ''
      PulidoConector2[2].style.display = "block"
      PulidoConector2.selectedIndex = 2
      StyleDisplayNoneOrBlock_2(PulidoConector2, 'none', [0,1])
    }

    if (PosicionConector1 == PosicionConector2) {
      if (PosicionPulidoConector1 < PosicionPulidoConector2) {
        NewConector1 = PosicionConectorJumpers[PosicionConector1]
        NewConector2 = PosicionConectorJumpers[PosicionConector2]
        NewPulidoConector1 = PulidoConector1.value
        NewPulidoConector2 = PulidoConector2.value
      }else{
        NewConector1 = PosicionConectorJumpers[PosicionConector2]
        NewConector2 = PosicionConectorJumpers[PosicionConector1]
        NewPulidoConector1 = PulidoConector2.value
        NewPulidoConector2 = PulidoConector1.value
      }
    }else{
      if (PosicionConector1 < PosicionConector2) {
        NewConector1 = PosicionConectorJumpers[PosicionConector1]
        NewConector2 = PosicionConectorJumpers[PosicionConector2]
        NewPulidoConector1 = PulidoConector1.value
        NewPulidoConector2 = PulidoConector2.value
      }else{
        NewConector1 = PosicionConectorJumpers[PosicionConector2]
        NewConector2 = PosicionConectorJumpers[PosicionConector1]
        NewPulidoConector1 = PulidoConector2.value
        NewPulidoConector2 = PulidoConector1.value
      }
    }

    if (Longitud.value > 0 && Longitud.value <= 999) {
      NewLongitud = NumeroConCeros(Longitud.value, 4)
      CodigoGenerado = Marca+Familia+NewConector1+NewPulidoConector1+NewConector2+NewPulidoConector2+MultimodoTipoFibra.value+NumeroHilos.value+NewLongitud+TipoCubierta.value+Diametro.value
      // Agreación de codigo para la vista en el identificador
      showClave(CodigoGenerado)
      let data = {
        Action: 'calcular',
        ActionCalcularPrecio : true, 
        Longitud: Longitud.value,
        Tipo: MultimodoTipoFibra.value == '09' ? 'SM' : 'MM', // Tipo de jumper de acuerdo al catalogo de bd Monomodo
        Conector_1: NewConector1,
        Conector_2: NewConector2,
        Fibra : MultimodoTipoFibra.value,
        Pulido_1 : NewPulidoConector1,
        Pulido_2 : NewPulidoConector2,
        Cubierta : TipoCubierta.value,
        NumeroHilos : NumeroHilos.value,
        Codigo: CodigoGenerado,
        SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
      }
     await CalcularPrecio("../../models/Productos/Jumpers/CalcularPrecio.Route.php", data)

      let Fibraselected = MultimodoTipoFibra.options[MultimodoTipoFibra.selectedIndex].text
      let TipoCubiertaselected=TipoCubierta.options[TipoCubierta.selectedIndex].text
      let Hiloselected=NumeroHilos.options[NumeroHilos.selectedIndex].text
      let Diametroselected=Diametro.options[Diametro.selectedIndex].text
  
      let descripcion = "Jumper Armado "+Conector1.value+PulidoConector1.value+'-'+Conector2.value+PulidoConector2.value+" "+Fibraselected+" "+TipoCubiertaselected+" "+Hiloselected+" de "+Diametroselected+" de "+Longitud.value+" metro(s) "
      NombreProductoConfigurable(CodigoGenerado, descripcion)
      DescPrdConf.innerHTML=descripcion
    }

    ChangeListImgProducto('OPJURA3','OPJU'+NewConector1+NewPulidoConector1+NewConector2+NewPulidoConector2+MultimodoTipoFibra.value+NumeroHilos.value)
    ListImgProducto('OPJURA3')
    ListProductoDescription('OPJURA3')
    ListProductoAdicional('OPJURA3')
    agregarFichaTecnicaConfigurable('OPJURA3')
    agregarCertificadoConfigurable(CodigoGenerado)
    existJumper_(CodigoGenerado)
}


var JumpersUniboot = async function(){
  let Longitud = document.getElementById('Longitud')
  // conectores 
  let Conector1 = document.getElementById('Conector1')
  let Conector2 = document.getElementById('Conector2')
  // botas 
  let Bota1 = document.getElementById('Bota1')
  let Bota2 = document.getElementById('Bota2')
  // pulidos
  let PulidoConector1 = document.getElementById('Pulido1')
  let PulidoConector2 = document.getElementById('Pulido2')
  // Tipo de fibra
  let MultimodoTipoFibra = document.getElementById('MultimodoTipoFibra')

  // Elementos no necesarios 
  let TipoCubierta = document.getElementById('TipoCubierta')
  let NumeroHilos = document.getElementById('NumeroHilos')
  let Diametro = document.getElementById('Diametro')


  if(MultimodoTipoFibra.value=='9'){

    PulidoConector1.selectedIndex = 0
    PulidoConector2.selectedIndex = 0
     StyleDisplayNoneOrBlock_2(PulidoConector1, 'block', [0])
     StyleDisplayNoneOrBlock_2(PulidoConector1, 'none', [1]) 
     StyleDisplayNoneOrBlock_2(PulidoConector2, 'block', [0])
     StyleDisplayNoneOrBlock_2(PulidoConector2, 'none', [1]) 

     StyleDisplayNoneOrBlock_2(TipoCubierta, 'block', [0,1])
}else{
 
      PulidoConector1.selectedIndex = 1
      PulidoConector2.selectedIndex = 1
     StyleDisplayNoneOrBlock_2(PulidoConector1, 'block', [1])
     StyleDisplayNoneOrBlock_2(PulidoConector1, 'none', [0]) 
     StyleDisplayNoneOrBlock_2(PulidoConector2, 'block', [1])
     StyleDisplayNoneOrBlock_2(PulidoConector2, 'none', [0]) 
     TipoCubierta.selectedIndex = 0
     StyleDisplayNoneOrBlock_2(TipoCubierta, 'none', [1])
}

  if(TipoCubierta.value=='R'){

       Diametro.selectedIndex = 0
        StyleDisplayNoneOrBlock_2(Diametro, 'block', [0])
        StyleDisplayNoneOrBlock_2(Diametro, 'none', [1]) 

        Bota1.selectedIndex = 0
        Bota2.selectedIndex = 0
        StyleDisplayNoneOrBlock_2(Bota1, 'block', [0])
        StyleDisplayNoneOrBlock_2(Bota1, 'none', [1]) 
        StyleDisplayNoneOrBlock_2(Bota2, 'block', [0])
        StyleDisplayNoneOrBlock_2(Bota2, 'none', [1]) 

  }else{
    
        Diametro.selectedIndex = 1
        StyleDisplayNoneOrBlock_2(Diametro, 'block', [1])
        StyleDisplayNoneOrBlock_2(Diametro, 'none', [0]) 

        Bota1.selectedIndex = 1
        Bota2.selectedIndex = 1
        StyleDisplayNoneOrBlock_2(Bota1, 'block', [1])
        StyleDisplayNoneOrBlock_2(Bota1, 'none', [0]) 
        StyleDisplayNoneOrBlock_2(Bota2, 'block', [1])
        StyleDisplayNoneOrBlock_2(Bota2, 'none', [0]) 


  }
 
 
  

  if (Longitud.value > 0 && Longitud.value <= 999.9 && validateDecimalEntero(Longitud.value)) {
    NewLongitud = NumeroConCeros(Longitud.value, 4)
    CodigoGenerado = Marca+Familia+Conector1.value+PulidoConector1.value+Bota1.value+Conector2.value+PulidoConector2.value+Bota2.value+MultimodoTipoFibra.value+NumeroHilos.value+NewLongitud+TipoCubierta.value+Diametro.value
    // Agreación de codigo para la vista en el identificador
    showClave(CodigoGenerado)
    let data = {
      Action: 'calcular',
      ActionCalcularPrecioUniboot : true, 
      Longitud: Longitud.value,
      Conector_1: Conector1.value,
      Conector_2: Conector2.value,
      Fibra : MultimodoTipoFibra.value,
      Pulido_1 : PulidoConector1.value,
      Pulido_2 : PulidoConector2.value,
      Cubierta : TipoCubierta.value,
      NumeroHilos : NumeroHilos.value,
      Bota_1 : Bota1.value,
      Bota_2 : Bota2.value,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value,
      Diametros : Diametro.value
    }
    await CalcularPrecio("../../models/Productos/Jumpers/Uniboot/CalcularPrecioUniboot.Route.php", data)
    let Fibraselected = MultimodoTipoFibra.options[MultimodoTipoFibra.selectedIndex].text
    let TipoCubiertaselected=TipoCubierta.options[TipoCubierta.selectedIndex].text
    let Hiloselected=NumeroHilos.options[NumeroHilos.selectedIndex].text
    let Diametroselected=Diametro.options[Diametro.selectedIndex].text
    let Bota1selected=Bota1.options[Bota1.selectedIndex].text
    let Bota2selected=Bota2.options[Bota2.selectedIndex].text

    let DescConector1 = Conector1.options[Conector1.selectedIndex].getAttribute('DescConector')
    let DescConector2 = Conector2.options[Conector2.selectedIndex].getAttribute('DescConector')
    
    let descripcion = "Jumper "+DescConector1+PulidoConector1.value+' Uniboot '+Bota1selected+'-'+DescConector2+PulidoConector2.value+' Uniboot '+Bota2selected+" "+Fibraselected+" "+TipoCubiertaselected+" "+Hiloselected+" de "+Diametroselected+" de "+Longitud.value+" metro(s) "
    NombreProductoConfigurable(CodigoGenerado, descripcion)
    DescPrdConf.innerHTML=descripcion
  }else{
    CodigoGenerado='';
    showClave(CodigoGenerado)
    DescPrdConf.innerHTML=''
  }
  ListImgProducto('OPJULCxLCx'+MultimodoTipoFibra.value+'Dxxx'+TipoCubierta.value+'x')
  console.log('OPJULCxLCx'+MultimodoTipoFibra.value+'Dxxx'+TipoCubierta.value+'x')
  ListProductoDescription('OPJULCxLCx'+MultimodoTipoFibra.value+'Dxxx'+TipoCubierta.value+'x')
  agregarFichaTecnicaConfigurable('OPJULCxLCx'+MultimodoTipoFibra.value+'Dxxx'+TipoCubierta.value+'x')
  ListProductoAdicional('OPJULCxLCx'+MultimodoTipoFibra.value+'Dxxx'+TipoCubierta.value+'x')
  //ChangeListImgProducto('OPJULU',)
  /*
  if(MultimodoTipoFibra.value == 9 ){ 
    ListProductoDescription('OPJUESP/SM')
    ListProductoAdicional('OPJUESP/SM')
  } else{
    ListProductoDescription('OPJUESP/MM')
    ListProductoAdicional('OPJUESP/MM')
  }
  */
  //agregarFichaTecnicaConfigurable('OPJUESP')
  agregarCertificadoConfigurable(CodigoGenerado)
  existJumper_(CodigoGenerado)
}



var JumpersFibraOptica = function() {
  switch(Jumper.value){
    case 'JMul' : 
      JumpersMultimodo()
    break;
    case 'JMon' : 
      JumpersMonomodo()
    break;
    case 'JArm' : 
      JumpersArmados()
    break;
    case 'JMPO' : 
      JumpersMPO()
    break;
    case 'JMPOBO' : 
      JumpersMPOBreakOut()
    break;
    case 'JEsp' : 
      JumpersEspeciales()
    break;
    case 'JUni' : 
      JumpersUniboot()
    break;
    default:
      templateAlert("warning", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
  }  
}

JumpersFibraOptica()