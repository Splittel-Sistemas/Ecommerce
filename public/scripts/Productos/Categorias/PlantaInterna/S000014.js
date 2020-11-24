// Jumpers

var Marca = "OP"
var Familia = "JU"
var Jumper = document.getElementById('Cable')

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
var contJumperMultimodo = 0;
var JumpersMultimodo = function(){
  let Longitud = document.getElementById('Longitud')
  validacionCantidad_(Longitud, 3)

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

  if (Conector1.value == 'MT' || Conector2.value == 'MT') {
    NumeroHilos.value = 'D'
    contJumperMultimodo == 0 ? Diametro.selectedIndex = 0 : '';
    contJumperMultimodo++
    StyleDisplayNoneOrBlock_2(Diametro, 'none', [2])
    StyleDisplayNoneOrBlock_2(NumeroHilos, 'none', [0])
    StyleDisplayNoneOrBlock_2(NumeroHilos, 'block', [1])
    // Diametro.selectedIndex = 0
    // MultimodoTipoFibra.selectedIndex = 0
    // StyleDisplayNoneOrBlock_2(MultimodoTipoFibra, 'none', [3])
  }else{
    contJumperMultimodo = 0
    // NumeroHilos.value = 'S'
    StyleDisplayNoneOrBlock_2(Diametro, 'block', [2])
    StyleDisplayNoneOrBlock_2(NumeroHilos, 'block', [0])
    // StyleDisplayNoneOrBlock_2(NumeroHilos, 'none', [1])
    // StyleDisplayNoneOrBlock_2(MultimodoTipoFibra, 'block', [3])
  }

  // if (Conector1.value == 'MT' || Conector2.value == 'MT') {
  //   // RemoveOptionSelect(TipoFibra, 3)
  //   RemoveOptionSelect(Diametro, 2)
  //   StyleDisplayNoneOrBlock(NumeroHilosSelect, "none")
  //   NumeroHilos.value = 'D'
  // }


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
    calcularPrecioJumper(data)
    
    let Fibraselected = MultimodoTipoFibra.options[MultimodoTipoFibra.selectedIndex].text
    let TipoCubiertaselected=TipoCubierta.options[TipoCubierta.selectedIndex].text
    let Hiloselected=NumeroHilos.options[NumeroHilos.selectedIndex].text
    let Diametroselected=Diametro.options[Diametro.selectedIndex].text

    let descripcion_mpo = "Jumper Multimodo "+Conector1.value+PulidoConector1.value+'-'+Conector2.value+PulidoConector2.value+" "+Fibraselected+" "+TipoCubiertaselected+" "+Hiloselected+" de "+Diametroselected+" de "+Longitud.value+" metro(s) "
    CableNombreCodigoConfigurable({ descripcion_jumper: descripcion_mpo, codigo: CodigoGenerado })

  }

  ChangeListImgProducto('OPJULCP','OPJU'+NewConector1+NewPulidoConector1+NewConector2+NewPulidoConector2+MultimodoTipoFibra.value+NumeroHilos.value)
  ListProductoDescription('OPJULCP')
  ListProductoAdicional('OPJULCP')
}

var JumpersMonomodo = function(){
  let Longitud = document.getElementById('Longitud')
  validacionCantidad_(Longitud, 3)

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
    

      // PulidoConector1[0].style.display = "block"
      // PulidoConector2[0].style.display = "block"
    if (Conector2.value == "MU" || Conector2.value == "ST" ) {
      // StyleDisplayNoneOrBlock(PulidoConector1Select, 'none')
      PulidoConector2[0].style.display = "none"
      PulidoConector2.selectedIndex = 1
    }

    if (Conector1.value == "MU" || Conector1.value == "ST") {
      // StyleDisplayNoneOrBlock(PulidoConector2Select, 'none')
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
      calcularPrecioJumper(data)

      let Fibraselected = MonomodoTipoFibra.options[MonomodoTipoFibra.selectedIndex].text
      let TipoCubiertaselected=TipoCubierta.options[TipoCubierta.selectedIndex].text
      let Hiloselected=NumeroHilos.options[NumeroHilos.selectedIndex].text
      let Diametroselected=Diametro.options[Diametro.selectedIndex].text
  
      let descripcion_mpo = "Jumper Monomodo "+Conector1.value+PulidoConector1.value+'-'+Conector2.value+PulidoConector2.value+" "+Fibraselected+" "+TipoCubiertaselected+" "+Hiloselected+" de "+Diametroselected+" de "+Longitud.value+" metro(s) "
      CableNombreCodigoConfigurable({ descripcion_jumper: descripcion_mpo, codigo: CodigoGenerado })
  
    }

    ChangeListImgProducto('OPJULCU','OPJU'+NewConector1+NewPulidoConector1+NewConector2+NewPulidoConector2+MonomodoTipoFibra.value+NumeroHilos.value)
    ListProductoDescription('OPJULCU')
    ListProductoAdicional('OPJULCU')
}

var JumpersEspeciales = function(){
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
    calcularPrecioJumpersEspeciales(data)
    let Fibraselected = MultimodoTipoFibra.options[MultimodoTipoFibra.selectedIndex].text
    let TipoCubiertaselected=TipoCubierta.options[TipoCubierta.selectedIndex].text
    let Hiloselected=NumeroHilos.options[NumeroHilos.selectedIndex].text
    let Diametroselected=Diametro.options[Diametro.selectedIndex].text
    let Bota1selected=Bota1.options[Bota1.selectedIndex].text
    let Bota2selected=Bota2.options[Bota2.selectedIndex].text
    
    let descripcion_mpo = "Jumper Bota Especial "+Conector1.value+PulidoConector1.value+' '+Bota1selected+'-'+Conector2.value+PulidoConector2.value+' '+Bota2selected+" "+Fibraselected+" "+TipoCubiertaselected+" "+Hiloselected+" de "+Diametroselected+" de "+Longitud.value+" metro(s) "
    CableNombreCodigoConfigurable({ descripcion_jumper: descripcion_mpo, codigo: CodigoGenerado })
  }else{
    CodigoGenerado='';
    showClave(CodigoGenerado)
  }
  ChangeListImgProducto('OPJUESP',Marca+Familia+NewPosConector1+NewPosConector2+MultimodoTipoFibra.value+NumeroHilos.value)
  if(MultimodoTipoFibra.value == 9 ){ 
    ListProductoDescription('OPJUESP/SM')
    ListProductoAdicional('OPJUESP/SM')
  } else{
    ListProductoDescription('OPJUESP/MM')
    ListProductoAdicional('OPJUESP/MM')
  }
 
}

var JumpersArmados = function(){
  let Longitud = document.getElementById('Longitud')
  validacionCantidad_(Longitud, 3)
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
  // let NumeroHilos = 'S'
  // let TipoCubierta = 'RA'
  // Diametro = '3'

    StyleDisplayNoneOrBlock(MonomodoTipoFibraSelect, 'none')

    StyleDisplayNoneOrBlock_2(NumeroHilos, 'none', [1])
    StyleDisplayNoneOrBlock_2(TipoCubierta, 'none', [0,1,2])
    // StyleDisplayNoneOrBlock_2(TipoCubierta, 'none', [0])
    StyleDisplayNoneOrBlock_2(Diametro, 'none', [0,1])

    TipoCubierta.selectedIndex = 3
    // TipoCubierta.selectedIndex = 1
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
      calcularPrecioJumper(data)

      let Fibraselected = MultimodoTipoFibra.options[MultimodoTipoFibra.selectedIndex].text
      let TipoCubiertaselected=TipoCubierta.options[TipoCubierta.selectedIndex].text
      let Hiloselected=NumeroHilos.options[NumeroHilos.selectedIndex].text
      let Diametroselected=Diametro.options[Diametro.selectedIndex].text
  
      let descripcion_mpo = "Jumper Armado "+Conector1.value+PulidoConector1.value+'-'+Conector2.value+PulidoConector2.value+" "+Fibraselected+" "+TipoCubiertaselected+" "+Hiloselected+" de "+Diametroselected+" de "+Longitud.value+" metro(s) "
      CableNombreCodigoConfigurable({ descripcion_jumper: descripcion_mpo, codigo: CodigoGenerado })
  
    }

    ChangeListImgProducto('OPJURA3','OPJU'+NewConector1+NewPulidoConector1+NewConector2+NewPulidoConector2+MultimodoTipoFibra.value+NumeroHilos.value)
    ListImgProducto('OPJURA3')
    ListProductoDescription('OPJURA3')
    ListProductoAdicional('OPJURA3')
}

var JumpersMPO = function(){
  let Longitud = document.getElementById('Longitud')
  validacionCantidad_(Longitud, 3)

  let Conectarizacion = "A1"
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
  
  CantidadFibras[0].style.display = "none"
  CantidadFibras[1].selected = true
  TipoCubierta[0].style.display = "none"
  TipoCubierta[1].style.display = "none"
  TipoCubierta[2].selected = "selected"
  let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
  Familia = "J"

  if(Longitud.value > 100){
    validacionCantidad_(Longitud, 2)
  }
      
  if (Longitud.value > 0 && Longitud.value <= 100) {
    NewLongitud = NumeroConCeros2(Longitud.value, 3)
    CodigoGenerado = Marca+Familia+Conectarizacion+Conectarizacion+Polaridad.value+CantidadFibras.value+Diseno.value+TipoFibra.value+TipoCable+NewLongitud+TipoCubierta.value
    // Agreación de codigo para la vista en el identificador
    let descripcion_mpo = "Jumper MPO "+Polaridadselected+" de "+CantidadFibras.value+" hilos "+Disenoselected+" "+Fibraselected+" "+TipoCubiertaselected+" de "+Longitud.value+" metro(s) "
    CableNombreCodigoConfigurable({ descripcion_jumper: descripcion_mpo, codigo: CodigoGenerado })

    ChangeListImgProducto('OPJA1A1','OPJA1A1'+Polaridad.value+Diseno.value)
	  ListProductoDescription('OPJA1A1')
    ListProductoAdicional('OPJA1A1')
    let data = {
      Action: 'calcular',
      ActionCalcularPrecioMPO: true,
      Longitud: Longitud.value,
      Fibra: Fibraselected,
      CantidadFibras: CantidadFibras.value,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    calcularPrecioJumperMPO(data)
    showClave(CodigoGenerado)
  }
}

var JumpersMPOBreakOut = function(){
  let Longitud = document.getElementById('Longitud')
  validacionCantidad_(Longitud, 3)

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
    validacionCantidad_(Longitud, 2)
  }
      
  if (Longitud.value > 0 && Longitud.value <= 100) {
    NewLongitud = NumeroConCeros2(Longitud.value, 3)
    CodigoGenerado = Marca+Familia+ConectarizacionLadoA.value+Diseno.value+ConectarizacionLadoB.value+Polaridad.value+CantidadFibras.value+TipoFibra.value+TipoCable+NewLongitud+TipoCubierta.value+LongitudBreakOut.value
    // Agreación de codigo para la vista en el identificador
    let descripcion_mpo = "Jumper MPO-BreakOut "+Polaridadselected+" de "+CantidadFibras.value+" hilos "+Disenoselected+" "+Fibraselected+" "+TipoCubiertaselected+" de "+Longitud.value+" metro(s) "
    CableNombreCodigoConfigurable({ descripcion_jumper: descripcion_mpo, codigo: CodigoGenerado })
 
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
    calcularPrecioJumperMPOBreakOut(data)
  }
    showClave(CodigoGenerado)
}

var CableNombreCodigoConfigurable = function(data){
  if(document.getElementById('CodeConfigurable')){
    let descripcion = data.descripcion_jumper
    ajax_(
    '../../models/Productos/ProductoConfigurable.Route.php', 
    'post', 
    'json', 
    { 
      Action: 'create',
      Codigo: data.codigo,
      CodigoConfigurable: document.getElementById('CodeConfigurable').value,
      Descripcion: descripcion
    }, 
    function(response){
      console.log(response)
    })
  }
}

/**
 * Calcular precio jumper monomodo, multimodo y armado
 *
 * @param {Json} data
 *
 * @return {number} b - Bar
 */
var calcularPrecioJumper = function(data) {
  ajax_('../../models/Productos/Jumpers/CalcularPrecio.Route.php', 'POST', 'JSON', data, 
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
/**
 * Calcular precio Jumper MPO
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var calcularPrecioJumperMPO = function(data) {
  ajax_('../../models/Productos/Jumpers/MPO/CalcularPrecioMPO.Route.php', 'POST', 'JSON', data, 
  function(response){
    if (!response.error) {
      document.getElementById('CostoProducto').value = '' 
      document.getElementById('Costo').innerHTML = "$"
      $('#span-leyenda').remove()
      StyleDisplayNoneOrBlock(document.getElementById('btn-configurable'), 'block')
      StyleDisplayNoneOrBlock(document.getElementById('div-quantity'), 'block')
      document.getElementById('CostoProducto').value = response.precioNormal 
      document.getElementById('Costo').innerHTML = "$"+response.precio
    }else{
      document.getElementById('CostoProducto').value = '' 
      document.getElementById('Costo').innerHTML = "$"
      ProductoEspecial()
    }
  })
}
/**
 * Calcular precio Jumper MPO Break-Out
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var calcularPrecioJumperMPOBreakOut = function(data) {
  ajax_('../../models/Productos/Jumpers/MPOBreakOut/CalcularPrecioMPOBreakOut.Route.php', 'POST', 'JSON', data, 
  function(response){
    if (!response.error) {
      document.getElementById('CostoProducto').value = '' 
      document.getElementById('Costo').innerHTML = "$"
      $('#span-leyenda').remove()
      StyleDisplayNoneOrBlock(document.getElementById('btn-configurable'), 'block')
      StyleDisplayNoneOrBlock(document.getElementById('div-quantity'), 'block')
      document.getElementById('CostoProducto').value = response.precioNormal 
      document.getElementById('Costo').innerHTML = "$"+response.precio
    }else{
      document.getElementById('CostoProducto').value = '' 
      document.getElementById('Costo').innerHTML = "$"
      ProductoEspecial()
    }
  })
}

/**
 * Calcular precio Jumpers Especiales
 *
 * @param {Object} Elem
 *
 * @return {number} b - Bar
 */
var calcularPrecioJumpersEspeciales = function(data) {
  ajax_('../../models/Productos/Jumpers/Especiales/CalcularPrecioEspeciales.Route.php', 'POST', 'JSON', data, 
  function(response){
    if (!response.error) {
      document.getElementById('CostoProducto').value = '' 
      document.getElementById('Costo').innerHTML = "$"
      $('#span-leyenda').remove()
      StyleDisplayNoneOrBlock(document.getElementById('btn-configurable'), 'block')
      StyleDisplayNoneOrBlock(document.getElementById('div-quantity'), 'block')
      document.getElementById('CostoProducto').value = response.precioNormal 
      document.getElementById('Costo').innerHTML = "$"+response.precio
    }else{
      document.getElementById('CostoProducto').value = '' 
      document.getElementById('Costo').innerHTML = "$"
      ProductoEspecial()
    }
  })
}

var verificarCosto = function(TipoFibra,CableLongitud,CantidadFibras){
  ajax_(
  '../../models/Productos/Precios/Mpo.php', 
  'post', 
  'json', 
  { 
    Action: 'calculo',
    ActionMpo: true,
    TipoFibra: TipoFibra,
    CableLongitud: CableLongitud,
    CantidadFibras: CantidadFibras
  }, 
  function(response){
    document.getElementById('CostoProducto').value = response.recordsNormal 
    document.getElementById('Costo').innerHTML = "$"+response.records.toFixed(3)
  })
}

var contremove = 0
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
    default:
      templateAlert("warning", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
  }  
}

JumpersFibraOptica()