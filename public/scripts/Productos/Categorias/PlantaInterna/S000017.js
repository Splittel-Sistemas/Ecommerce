// [OP] OPTONICS
var Marca = "OP"
// [CP] CABLE PRECONECTORIZADOS
var Familia = "CP"
var Clave = document.getElementById('Clave');
var DescPrdConf = document.getElementById('DscProductoConfigurable')
// propierties
let TipoTermiacion      = document.getElementById("TipoTerminacion");
let ConectorLadoA       = document.getElementById("conec_lad_a");
let ConectorLadoB       = document.getElementById("conec_lad_b");
let TipoCubierta        = document.getElementById("TipoCubierta");
let TipoFibra           = document.getElementById("TipoFibra");
let NoHilos             = document.getElementById("NoHilos");
let Longitud            = document.getElementById("Longitud");
let NoHilos_label       = document.getElementById("NoHilos_label");
let Longitud_label      = document.getElementById("Longitud_label");
let Adicionales         = document.getElementById("Adicionales");

let CodigoGenerado = ""
var ContConectorLAMon   = 0
var ContConectorLBMon   = 0
var ContConectorLAMul   = 0
var ContConectorLBMul   = 0
var ContConectorLAMon1  = 0
var ContConectorLBMon1  = 0
var ContConectorLAMul1  = 0
var ContConectorLBMul1  = 0

var ContConectorLadoA_1 = 0
var ContConectorLadoA_2 = 0

var ConectoresPosicion = [
  'AR',
  'AT',
  'AU',
  'AX',
  'AY',
  'BA',
  'BI',
  'AS',
  'AV',
  'AW',
  'AZ',
  'AA',
  'AB',
  'AC',
  'AD',
  'AI',
  'AJ',
  'AL',
  'BJ',
  'AE',
  'AF',
  'AG',
  'AH',
  'AK'
]

/**
 * Calcular precio cables preconectorizados
 *
 * @param {Json} data
 *
 * @return {number} b - Bar
 */
function validateEntero(valor) {
  var patronEntero = /^\d*$/; 
  if (patronEntero.test(valor)) {
      return true;
  } else {
    //console.log('test'+valor.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1'))
    document.getElementById('Longitud').value=valor.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1')
  }
}


function validateNumero(Longitud){
  if (Longitud.value >= 1 && Longitud.value <= 999) {
      let s = Number(Longitud.value);
     if (s % 1 !== 0) { // tiene decimal
        // Limitar a un solo decimal
        let partes = Longitud.value.split('.');
        let entero = partes[0];
        let decimal = partes[1] ? partes[1].substring(0, 1) : "";

        // Reconstruir el número con un solo decimal
        s = Number(entero + '.' + decimal);

        // Formatear con 4 dígitos según tu función
        NewLongitud = NumeroConCeros(s, 4);

        // Opcional: actualizar el input para que solo tenga un decimal
        Longitud.value = entero + (decimal ? '.' + decimal : '');

    }else{
        let s=Number(Longitud.value)
        NewLongitud = NumeroConCeros2(s, 3)
       
      }
    }
    return NewLongitud;
}

var cable_IE = function(){
  
  let Aux_ConectorLadoA = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('data-conector')
  let Aux_ConectorLadoB = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('data-conector')


  //StyleDisplayNoneOrBlock_2(TipoCubierta, 'none', [2]);
  let PosicionConector1 = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('position')
  let PosicionConector2 = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('position')
  // alert(TipoTermiacion.value);
  if(TipoTermiacion.value == '9UM'){
      ContConectorLAMul1 = 0
      ContConectorLBMul1 = 0
      ContConectorLAMon1 = 0
      ContConectorLBMon1 = 0
      if(NoHilos.value>=2 && NoHilos.value<=24){
        Adicionales[1].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [1]);
      }
      if(NoHilos.value>24){
        Adicionales[0].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [1,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [0]);
      }
    if (TipoFibra.value == "09") {
      ContConectorLAMul = 0
      ContConectorLBMul = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [0,1,2,3,4,5,6]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [1,2,3,4,5,6,7]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]);
      
      ContConectorLAMon == 0 ? ConectorLadoA.selectedIndex = 0 : "";
      ContConectorLBMon == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMon++
      ContConectorLBMon++

    }else{
      ContConectorLAMon = 0
      ContConectorLBMon = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [7,8,9,10]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [8,9,10,11]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,12,13,14,15,16,17,18,19,20,21,22,23,24]);

      ContConectorLAMul == 0 ? ConectorLadoA.selectedIndex = 7 : "";
      ContConectorLBMul == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMul++
      ContConectorLBMul++
    }
    if (parseInt(PosicionConector1) < parseInt(PosicionConector2)) {
      NewConector1 = ConectorLadoA.value
      NewConector2 = ConectorLadoB.value
    }else{
      NewConector1 = ConectorLadoB.value
      NewConector2 = ConectorLadoA.value
    }

    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 2 - 48";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 1 - 999";

  
   
    NewLongitud=validateNumero(Longitud)
    

    if(ValidInputRange(NoHilos,2,48) && ValidInputRange(Longitud,1,999)){
      CodigoGenerado=Marca + Familia + "IE" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
      + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
      showClave(CodigoGenerado);
    }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
    
  }else if(TipoTermiacion.value == '2MM'){
      ContConectorLAMul = 0
      ContConectorLBMul = 0
      ContConectorLAMon = 0
      ContConectorLBMon = 0
      if( NoHilos.value >= 6 && NoHilos.value <= 12 ){
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,1,2]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [3]);
          Adicionales[3].selected=true
       
      }else if(NoHilos.value >= 1 && NoHilos.value <= 5 ){
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [1]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,2,3]);
          Adicionales[1].selected=true
      }
    if (TipoFibra.value == "09") {
      ContConectorLAMul1 = 0
      ContConectorLBMul1 = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [11,12,13,14,15,16,17,18]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,7,8,9,10,19,20,21,22,23]);
      // activar elementos lado b
      if(ConectorLadoA.selectedIndex == 13){
        if(ConectorLadoB.selectedIndex != 14 && ConectorLadoB.selectedIndex != 0){
          ConectorLadoB.selectedIndex = 0
        }else{
          ContConectorLAMon1 == 0 ? ConectorLadoA.selectedIndex = 11 : "";
          ContConectorLBMon1 == 0 ? ConectorLadoB.selectedIndex = 0 : "";
        }
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block',[14]);
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,8,9,10,11,12,13,15,16,17,18,19,20,21,22,23,24]);
      }else{
        if(ConectorLadoB.selectedIndex == 14 ){
          ConectorLadoB.selectedIndex = 0
        }else{
          ContConectorLAMon1 == 0 ? ConectorLadoA.selectedIndex = 11 : "";
          ContConectorLBMon1 == 0 ? ConectorLadoB.selectedIndex = 0 : "";
        }
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block',[12,13,15,16,17,18,19]);
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,8,9,10,11,14,20,21,22,23,24]);
      }
      //ContConectorLAMon1 == 0 ? ConectorLadoA.selectedIndex = 11 : "";
      //ContConectorLBMon1 == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMon1++
      ContConectorLBMon1++

    }else{
      ContConectorLAMon1 = 0
      ContConectorLBMon1 = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [19,20,21,22,23]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]);
      // activar elementos lado b

      if(ConectorLadoA.selectedIndex == 20){
        if(ConectorLadoB.selectedIndex != 21 && ConectorLadoB.selectedIndex != 0){
          ConectorLadoB.selectedIndex = 0
        }else{
          ContConectorLAMul1 == 0 ? ConectorLadoA.selectedIndex = 19 : "";
          ContConectorLBMul1 == 0 ? ConectorLadoB.selectedIndex = 0 : "";
        }
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [21]);
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,22,23,24]);
      
      }else{
        if(ConectorLadoB.selectedIndex == 21 ){
          ConectorLadoB.selectedIndex = 0
        }else{
          ContConectorLAMul1 == 0 ? ConectorLadoA.selectedIndex = 19 : "";
          ContConectorLBMul1 == 0 ? ConectorLadoB.selectedIndex = 0 : "";
        }
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [20,22,23,24]);
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,21]);
      
      }
      //StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [20,21,22,23,24]);
      //StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]);
      //ContConectorLAMul1 == 0 ? ConectorLadoA.selectedIndex = 19 : "";
      //ContConectorLBMul1 == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMul1++
      ContConectorLBMul1++
    }
    let x = 0
    if (parseInt(PosicionConector1) < parseInt(PosicionConector2)) {
      NewConector1 = ConectorLadoA.value
      NewConector2 = ConectorLadoB.value
      x = 1
    }else{
      NewConector1 = ConectorLadoB.value
      NewConector2 = ConectorLadoA.value
      x = 2
    }
    NewLongitud=validateNumero(Longitud)
    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 2 - 12";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 1 - 999";
    if(ValidInputRange(NoHilos,2,12) && ValidInputRange(Longitud,1,999)){
       CodigoGenerado=Marca + Familia + "IE" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
       + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
      showClave(CodigoGenerado);
      
    }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }
    let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    let ConectorLadoAselected = ConectorLadoA.options[ConectorLadoA.selectedIndex].text
    let ConectorLadoBselected = ConectorLadoB.options[ConectorLadoB.selectedIndex].text
    let Adicionalesselected = Adicionales.options[Adicionales.selectedIndex].text
    let descripcion_cable = "Cable preconectorizado Interior-Exterior "+TipoFibraselected+" "+TipoCubiertaselected+" "+ConectorLadoAselected+" a "+ConectorLadoBselected+" de "+NoHilos.value+" hilos de "+Longitud.value+" metro(s) "+Adicionalesselected
    if(CodigoGenerado!=''){
      NombreProductoConfigurable(CodigoGenerado, descripcion_cable)
      DescPrdConf.innerHTML=descripcion_cable
    }else{
        
      DescPrdConf.innerHTML=''
    }
    let BreakOut = Adicionales.value == "BO" || Adicionales.value == "BM" ? 1 : 0
      let data = {
      Action: 'calculo',
      BreakOut : BreakOut,
      ActionPrecioPreconectorizados: true,
      CablesPreconId: 2,
      CablesPreconNumeroHilos: NoHilos.value,
      CablesPreconLongitud: Longitud.value,
      CablesPreconTipoFibra: TipoFibra.value,
      Conector_1: Aux_ConectorLadoA,
      Conector_2: Aux_ConectorLadoB,
      Cubierta:TipoCubierta.value,
      Uso:'Interior',
      Codigo: CodigoGenerado,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    
    CalcularPrecio("../../models/Productos/CablePreconectorizado/CalcularPrecio.Route.php", data)
if(CodigoGenerado==''){
    BorrarPrecio();
  }
  let DirectorioImgProducto = Marca + Familia + "IE/fotos"
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(Marca + Familia + "IE")
  ListProductoAdicional(Marca + Familia + "IE")
  agregarFichaTecnicaConfigurable(Marca + Familia + "IE")
  agregarCertificadoConfigurable(CodigoGenerado)
}
var cable_CI = function(){
  let Aux_ConectorLadoA = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('data-conector')
  let Aux_ConectorLadoB = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('data-conector')
  //StyleDisplayNoneOrBlock_2(TipoCubierta, 'none', [2]);
  let PosicionConector1 = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('position')
  let PosicionConector2 = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('position')
  // alert(TipoTermiacion.value);
  if(TipoTermiacion.value == '9UM'){
      ContConectorLAMul1 = 0
      ContConectorLBMul1 = 0
      ContConectorLAMon1 = 0
      ContConectorLBMon1 = 0
      if(NoHilos.value>=2 && NoHilos.value<=24){
        Adicionales[1].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [1]);
      }
      if(NoHilos.value>24){
        Adicionales[0].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [1,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [0]);
      }
    if (TipoFibra.value == "09") {
      ContConectorLAMul = 0
      ContConectorLBMul = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [0,1,2,3,4,5,6]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [1,2,3,4,5,6,7]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]);
      
      ContConectorLAMon == 0 ? ConectorLadoA.selectedIndex = 0 : "";
      ContConectorLBMon == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMon++
      ContConectorLBMon++

    }else{
      ContConectorLAMon = 0
      ContConectorLBMon = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [7,8,9,10]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [8,9,10,11]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,12,13,14,15,16,17,18,19,20,21,22,23,24]);

      ContConectorLAMul == 0 ? ConectorLadoA.selectedIndex = 7 : "";
      ContConectorLBMul == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMul++
      ContConectorLBMul++
    }
    if (parseInt(PosicionConector1) < parseInt(PosicionConector2)) {
      NewConector1 = ConectorLadoA.value
      NewConector2 = ConectorLadoB.value
    }else{
      NewConector1 = ConectorLadoB.value
      NewConector2 = ConectorLadoA.value
    }
    NewLongitud=validateNumero(Longitud)
    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 2 - 48";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 1 - 999";
    if(ValidInputRange(NoHilos,2,48) && ValidInputRange(Longitud,1,999)){
    
      CodigoGenerado=Marca + Familia + "CI" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) + NewConector1 
      + NewConector2 + NewLongitud + Adicionales.value;
      showClave(CodigoGenerado);
      
    }else{
     
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }else if(TipoTermiacion.value == '2MM'){
      ContConectorLAMul = 0
      ContConectorLBMul = 0
      ContConectorLAMon = 0
      ContConectorLBMon = 0
      if( NoHilos.value >= 6 && NoHilos.value <= 12 ){
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,1,2]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [3]);
          Adicionales[3].selected=true
       
      }else if(NoHilos.value >= 1 && NoHilos.value <= 5 ){
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [1]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,2,3]);
          Adicionales[1].selected=true
      }
    if (TipoFibra.value == "09") {
      ContConectorLAMul1 = 0
      ContConectorLBMul1 = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [11,12,13,14,15,16,17,18]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,7,8,9,10,19,20,21,22,23]);
      // activar elementos lado b
      if(ConectorLadoA.selectedIndex == 13){
        if(ConectorLadoB.selectedIndex != 14 && ConectorLadoB.selectedIndex != 0){
          ConectorLadoB.selectedIndex = 0
        }else{
          ContConectorLAMon1 == 0 ? ConectorLadoA.selectedIndex = 11 : "";
          ContConectorLBMon1 == 0 ? ConectorLadoB.selectedIndex = 0 : "";
        }
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block',[14]);
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,8,9,10,11,12,13,15,16,17,18,19,20,21,22,23,24]);
      }else{
        if(ConectorLadoB.selectedIndex == 14 ){
          ConectorLadoB.selectedIndex = 0
        }else{
          ContConectorLAMon1 == 0 ? ConectorLadoA.selectedIndex = 11 : "";
          ContConectorLBMon1 == 0 ? ConectorLadoB.selectedIndex = 0 : "";
        }
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block',[12,13,15,16,17,18,19]);
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,8,9,10,11,14,20,21,22,23,24]);
      }

     // ContConectorLAMon1 == 0 ? ConectorLadoA.selectedIndex = 11 : "";
     // ContConectorLBMon1 == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMon1++
      ContConectorLBMon1++

    }else{
      ContConectorLAMon1 = 0
      ContConectorLBMon1 = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [19,20,21,22,23]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]);
      // activar elementos lado b}

      if(ConectorLadoA.selectedIndex == 20){
        if(ConectorLadoB.selectedIndex != 21 && ConectorLadoB.selectedIndex != 0){
          ConectorLadoB.selectedIndex = 0
        }else{
          ContConectorLAMul1 == 0 ? ConectorLadoA.selectedIndex = 19 : "";
          ContConectorLBMul1 == 0 ? ConectorLadoB.selectedIndex = 0 : "";
        }
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [21]);
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,22,23,24]);
      
      }else{
        if(ConectorLadoB.selectedIndex == 21 ){
          ConectorLadoB.selectedIndex = 0
        }else{
          ContConectorLAMul1 == 0 ? ConectorLadoA.selectedIndex = 19 : "";
          ContConectorLBMul1 == 0 ? ConectorLadoB.selectedIndex = 0 : "";
        }
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [20,22,23,24]);
        StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,21]);
      
      }
      //StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [20,21,22,23,24]);
      //StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19]);
      //ContConectorLAMul1 == 0 ? ConectorLadoA.selectedIndex = 19 : "";
      //ContConectorLBMul1 == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMul1++
      ContConectorLBMul1++
    }
    let x = 0
    if (parseInt(PosicionConector1) < parseInt(PosicionConector2)) {
      NewConector1 = ConectorLadoA.value
      NewConector2 = ConectorLadoB.value
      x = 1
    }else{
      NewConector1 = ConectorLadoB.value
      NewConector2 = ConectorLadoA.value
      x = 2
    }
    NewLongitud=validateNumero(Longitud)
    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 2 - 12";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 1 - 999";
    if(ValidInputRange(NoHilos,2,12) && ValidInputRange(Longitud,1,999)){
      
     CodigoGenerado=Marca + Familia + "CI" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
     + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
      showClave(CodigoGenerado);
     
    }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }

    let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    let ConectorLadoAselected = ConectorLadoA.options[ConectorLadoA.selectedIndex].text
    let ConectorLadoBselected = ConectorLadoB.options[ConectorLadoB.selectedIndex].text
    let Adicionalesselected = Adicionales.options[Adicionales.selectedIndex].text
    let descripcion_cable = "Cable preconectorizado de Distribucion "+TipoFibraselected+" "+TipoCubiertaselected+" "+ConectorLadoAselected+" a "+ConectorLadoBselected+" de "+NoHilos.value+" hilos de "+Longitud.value+" metro(s) "+Adicionalesselected
    if(CodigoGenerado!=''){
    NombreProductoConfigurable(CodigoGenerado, descripcion_cable)  
    DescPrdConf.innerHTML=descripcion_cable
    }else{
       
      DescPrdConf.innerHTML=''
      BorrarPrecio();
    }

    let BreakOut = Adicionales.value == "BO" || Adicionales.value == "BM" ? 1 : 0
    let data = {
      Action: 'calculo',
      BreakOut : BreakOut,
      ActionPrecioPreconectorizados: true,
      CablesPreconId: 1,
      CablesPreconNumeroHilos: NoHilos.value,
      CablesPreconLongitud: Longitud.value,
      CablesPreconTipoFibra: TipoFibra.value,
      Conector_1: Aux_ConectorLadoA,
      Conector_2: Aux_ConectorLadoB,
      Cubierta:TipoCubierta.value,
      Uso:'Interior',
      Codigo: CodigoGenerado,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
  
    CalcularPrecio("../../models/Productos/CablePreconectorizado/CalcularPrecio.Route.php", data)
   
  let DirectorioImgProducto = Marca + Familia + "CI/fotos"
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(Marca + Familia + "CI")
      ListProductoAdicional(Marca + Familia + "CI")
      agregarFichaTecnicaConfigurable(Marca + Familia + "CI")
      agregarCertificadoConfigurable(CodigoGenerado)
  //console.log(descripcion_cable)
}
var cable_SA = function(){
  let Aux_ConectorLadoA = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('data-conector')
  let Aux_ConectorLadoB = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('data-conector')
  let PosicionConector1 = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('position')
  let PosicionConector2 = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('position')
  // alert(TipoTermiacion.value);
  if(TipoTermiacion.value == '9UM'){
      ContConectorLAMul1 = 0
      ContConectorLBMul1 = 0
      ContConectorLAMon1 = 0
      ContConectorLBMon1 = 0
      if(NoHilos.value>=2 && NoHilos.value<=24){
        Adicionales[1].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [1]);
      }
      if(NoHilos.value>24){
        Adicionales[0].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [1,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [0]);
      }
    if (TipoFibra.value == "09") {
      ContConectorLAMul = 0
      ContConectorLBMul = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [0,1,2,3,4,5,6]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [1,2,3,4,5,6,7]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]);
      
      ContConectorLAMon == 0 ? ConectorLadoA.selectedIndex = 0 : "";
      ContConectorLBMon == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMon++
      ContConectorLBMon++

    }else{
      ContConectorLAMon = 0
      ContConectorLBMon = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [7,8,9,10]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [8,9,10,11]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,12,13,14,15,16,17,18,19,20,21,22,23,24]);

      ContConectorLAMul == 0 ? ConectorLadoA.selectedIndex = 7 : "";
      ContConectorLBMul == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMul++
      ContConectorLBMul++
    }
    if (parseInt(PosicionConector1) < parseInt(PosicionConector2)) {
      NewConector1 = ConectorLadoA.value
      NewConector2 = ConectorLadoB.value
    }else{
      NewConector1 = ConectorLadoB.value
      NewConector2 = ConectorLadoA.value
    }
 NewLongitud=validateNumero(Longitud)
    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 2 - 48";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 1 - 999";
    if(ValidInputRange(NoHilos,2,48) && ValidInputRange(Longitud,1,999)){
       CodigoGenerado=Marca + Familia + "SA" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
       + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
      showClave(CodigoGenerado);
    }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }
    let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    let ConectorLadoAselected = ConectorLadoA.options[ConectorLadoA.selectedIndex].text
    let ConectorLadoBselected = ConectorLadoB.options[ConectorLadoB.selectedIndex].text
    let Adicionalesselected = Adicionales.options[Adicionales.selectedIndex].text
    let descripcion_cable = "Cable preconectorizado ADSS"+TipoFibraselected+" "+TipoCubiertaselected+" "+ConectorLadoAselected+" a "+ConectorLadoBselected+" de "+NoHilos.value+" hilos de "+Longitud.value+" metro(s) "+Adicionalesselected
    if(CodigoGenerado!=''){
      NombreProductoConfigurable(CodigoGenerado, descripcion_cable)  
      DescPrdConf.innerHTML=descripcion_cable
    }else{
        
      DescPrdConf.innerHTML=''
    }
    let BreakOut = Adicionales.value == "BO" || Adicionales.value == "BM" ? 1 : 0
      let data = {
      Action: 'calculo',
      BreakOut : BreakOut,
      ActionPrecioPreconectorizados: true,
      CablesPreconId: 6,
      CablesPreconNumeroHilos: NoHilos.value,
      CablesPreconLongitud: Longitud.value,
      CablesPreconTipoFibra: TipoFibra.value,
      Conector_1: Aux_ConectorLadoA,
      Conector_2: Aux_ConectorLadoB,
      Cubierta:TipoCubierta.value,
      Uso:'Exterior',
      Codigo: CodigoGenerado,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    CalcularPrecio("../../models/Productos/CablePreconectorizado/CalcularPrecio.Route.php", data)
if(CodigoGenerado==''){
        BorrarPrecio();
      }

  let DirectorioImgProducto = Marca + Familia + "SA/fotos"
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(Marca + Familia + "SA")
      ListProductoAdicional(Marca + Familia + "SA")
      agregarFichaTecnicaConfigurable(Marca + Familia + "SA")
      agregarCertificadoConfigurable(CodigoGenerado)
}
var cable_D0 = function(){
  // alert(TipoTermiacion.value);
  let Aux_ConectorLadoA = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('data-conector')
  let Aux_ConectorLadoB = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('data-conector')
 
  Adicionales[1].selected=true
  StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0]);
  StyleDisplayNoneOrBlock_2(Adicionales, 'block', [1]);
if((ConectorLadoA.value=='BH'|| ConectorLadoA.value=='BG') && ConectorLadoB.value=='BL'){
  ConAuxLadoA=ConectorLadoB.value;
  ConAuxLadoB=ConectorLadoA.value;
}
else if(ConectorLadoA.value=='BG' && ConectorLadoB.value=='BH'){
  ConAuxLadoA=ConectorLadoB.value;
  ConAuxLadoB=ConectorLadoA.value;
}else{
  ConAuxLadoA=ConectorLadoA.value;
  ConAuxLadoB=ConectorLadoB.value;
}

  if(TipoTermiacion.value == '3MM'){
    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 1 - 1";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 1 - 999";
     NewLongitud=validateNumero(Longitud)
    if(ValidInputRange(NoHilos,1,1) && ValidInputRange(Longitud,1,999)){
      CodigoGenerado=Marca + Familia + "D0" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
      + ConAuxLadoA + ConAuxLadoB + NewLongitud + Adicionales.value;
      showClave(CodigoGenerado);
      //verificarCostoFigura0(Longitud.value,ConAuxLadoA,ConAuxLadoB)
      let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
      let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
      let ConectorLadoAselected = ConectorLadoA.options[ConectorLadoA.selectedIndex].text
      let ConectorLadoBselected = ConectorLadoB.options[ConectorLadoB.selectedIndex].text
      let Adicionalesselected = Adicionales.options[Adicionales.selectedIndex].text
      let descripcion_cable = "Cable preconectorizado Drop Figura 0 "+TipoFibraselected+" "+TipoCubiertaselected+" "+ConectorLadoAselected+" a "+ConectorLadoBselected+" de "+NoHilos.value+" hilos de "+Longitud.value+" metro(s) "+Adicionalesselected
      
      if(CodigoGenerado!=''){
       NombreProductoConfigurable(CodigoGenerado, descripcion_cable) 
       DescPrdConf.innerHTML=descripcion_cable 
      }else{
        
      DescPrdConf.innerHTML=''
    }
      
    }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }

  let BreakOut = Adicionales.value == "BO" || Adicionales.value == "BM" ? 1 : 0
    let data = {
    Action: 'calculo',
    BreakOut : BreakOut,
    ActionPrecioPreconectorizados: true,
    CablesPreconId: 10,
    CablesPreconNumeroHilos: NoHilos.value,
    CablesPreconLongitud: Longitud.value,
    CablesPreconTipoFibra: TipoFibra.value,
    Conector_1: Aux_ConectorLadoA,
    Conector_2: Aux_ConectorLadoB,
    Cubierta:TipoCubierta.value,
    Uso:'Interior',
    Codigo: CodigoGenerado,
    SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
  }
  CalcularPrecio("../../models/Productos/CablePreconectorizado/CalcularPrecio.Route.php", data)
if(CodigoGenerado==''){
        BorrarPrecio();
      }


  let DirectorioImgProducto = Marca + Familia + "D0/fotos"
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(Marca + Familia + "D0")
  ListProductoAdicional(Marca + Familia + "D0")
  agregarFichaTecnicaConfigurable(Marca + Familia + "D0"+ TipoFibra.value)
  agregarCertificadoConfigurable(CodigoGenerado)
}
var cable_S8 = function(){
  let Aux_ConectorLadoA = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('data-conector')
  let Aux_ConectorLadoB = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('data-conector')
  StyleDisplayNoneOrBlock_2(TipoFibra, 'none', [3,4]);
  let PosicionConector1 = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('position')
  let PosicionConector2 = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('position')
  // alert(TipoTermiacion.value);
  if(TipoTermiacion.value == '9UM'){
      ContConectorLAMul1 = 0
      ContConectorLBMul1 = 0
      ContConectorLAMon1 = 0
      ContConectorLBMon1 = 0
      if(NoHilos.value>=2 && NoHilos.value<=24){
        Adicionales[1].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [1]);
      }
      if(NoHilos.value>24){
        Adicionales[0].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [1,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [0]);
      }
    if (TipoFibra.value == "09") {
      ContConectorLAMul = 0
      ContConectorLBMul = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [0,1,2,3,4,5,6]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [1,2,3,4,5,6,7]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]);
      
      ContConectorLAMon == 0 ? ConectorLadoA.selectedIndex = 0 : "";
      ContConectorLBMon == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMon++
      ContConectorLBMon++

    }else{
      ContConectorLAMon = 0
      ContConectorLBMon = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [7,8,9,10]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [8,9,10,11]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,12,13,14,15,16,17,18,19,20,21,22,23,24]);

      ContConectorLAMul == 0 ? ConectorLadoA.selectedIndex = 7 : "";
      ContConectorLBMul == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMul++
      ContConectorLBMul++
    }
    if (parseInt(PosicionConector1) < parseInt(PosicionConector2)) {
      NewConector1 = ConectorLadoA.value
      NewConector2 = ConectorLadoB.value
    }else{
      NewConector1 = ConectorLadoB.value
      NewConector2 = ConectorLadoA.value
    }
    if (TipoFibra.value == "09") {
      // mostrar rango de hilos valido
      NoHilos_label.innerHTML = " 2 - 48";
      // mostrar longitud valida
      Longitud_label.innerHTML = " 1 - 999";
       NewLongitud=validateNumero(Longitud)
      if(ValidInputRange(NoHilos,2,48) && ValidInputRange(Longitud,1,999)){
        CodigoGenerado=Marca + Familia + "S8" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
        + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
        showClave(CodigoGenerado);
      }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
    }
    if (TipoFibra.value == "62") {
      // mostrar rango de hilos valido
      NoHilos_label.innerHTML = " 2 - 12";
      // mostrar longitud valida
      Longitud_label.innerHTML = " 1 - 999";
      NewLongitud=validateNumero(Longitud)
      if(ValidInputRange(NoHilos,2,12) && ValidInputRange(Longitud,1,999)){
        CodigoGenerado=Marca + Familia + "S8" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
        + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
        showClave(CodigoGenerado);
      }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
    }
    if (TipoFibra.value == "50") {
      // mostrar rango de hilos valido
      NoHilos_label.innerHTML = " 2 - 24";
      // mostrar longitud valida
      Longitud_label.innerHTML = " 1 - 999";
      NewLongitud=validateNumero(Longitud)
      if(ValidInputRange(NoHilos,2,24) && ValidInputRange(Longitud,1,999)){
        CodigoGenerado=Marca + Familia + "S8" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
        + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
        showClave(CodigoGenerado);
      }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
    }
  }
    let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    let ConectorLadoAselected = ConectorLadoA.options[ConectorLadoA.selectedIndex].text
    let ConectorLadoBselected = ConectorLadoB.options[ConectorLadoB.selectedIndex].text
    let Adicionalesselected = Adicionales.options[Adicionales.selectedIndex].text
    let descripcion_cable = "Cable preconectorizado figura 8 sin armadura "+TipoFibraselected+" "+TipoCubiertaselected+" "+ConectorLadoAselected+" a "+ConectorLadoBselected+" de "+NoHilos.value+" hilos de "+Longitud.value+" metro(s) "+Adicionalesselected
    if(CodigoGenerado!=''){
       NombreProductoConfigurable(CodigoGenerado, descripcion_cable)  
       DescPrdConf.innerHTML=descripcion_cable
    }else{
        
      DescPrdConf.innerHTML=''
    }
    let BreakOut = Adicionales.value == "BO" || Adicionales.value == "BM" ? 1 : 0
      let data = {
      Action: 'calculo',
      BreakOut : BreakOut,
      ActionPrecioPreconectorizados: true,
      CablesPreconId: 9,
      CablesPreconNumeroHilos: NoHilos.value,
      CablesPreconLongitud: Longitud.value,
      CablesPreconTipoFibra: TipoFibra.value,
      Conector_1: Aux_ConectorLadoA,
      Conector_2: Aux_ConectorLadoB,
      Cubierta:TipoCubierta.value,
      Uso:'Exterior',
      Codigo: CodigoGenerado,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    CalcularPrecio("../../models/Productos/CablePreconectorizado/CalcularPrecio.Route.php", data)
if(CodigoGenerado==''){
        BorrarPrecio();
      }

  let DirectorioImgProducto = Marca + Familia + "S8/fotos"
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(Marca + Familia + "S8")
  ListProductoAdicional(Marca + Familia + "S8")
  agregarFichaTecnicaConfigurable(Marca + Familia + "S8")
  agregarCertificadoConfigurable(CodigoGenerado)
}
var cable_M8 = function(){
  let Aux_ConectorLadoA = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('data-conector')
  let Aux_ConectorLadoB = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('data-conector')
  StyleDisplayNoneOrBlock_2(TipoFibra, 'none', [4]);
  let PosicionConector1 = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('position')
  let PosicionConector2 = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('position')
  // alert(TipoTermiacion.value);
  if(TipoTermiacion.value == '9UM'){
      ContConectorLAMul1 = 0
      ContConectorLBMul1 = 0
      ContConectorLAMon1 = 0
      ContConectorLBMon1 = 0
      if(NoHilos.value>=2 && NoHilos.value<=24){
        Adicionales[1].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [1]);
      }
      if(NoHilos.value>24){
        Adicionales[0].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [1,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [0]);
      }
    if (TipoFibra.value == "09") {
      ContConectorLAMul = 0
      ContConectorLBMul = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [0,1,2,3,4,5,6]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [1,2,3,4,5,6,7]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]);
      
      ContConectorLAMon == 0 ? ConectorLadoA.selectedIndex = 0 : "";
      ContConectorLBMon == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMon++
      ContConectorLBMon++

    }else{
      ContConectorLAMon = 0
      ContConectorLBMon = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [7,8,9,10]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [8,9,10,11]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,12,13,14,15,16,17,18,19,20,21,22,23,24]);

      ContConectorLAMul == 0 ? ConectorLadoA.selectedIndex = 7 : "";
      ContConectorLBMul == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMul++
      ContConectorLBMul++
    }
    if (parseInt(PosicionConector1) < parseInt(PosicionConector2)) {
      NewConector1 = ConectorLadoA.value
      NewConector2 = ConectorLadoB.value
    }else{
      NewConector1 = ConectorLadoB.value
      NewConector2 = ConectorLadoA.value
    }

    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 2 - 12";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 1 - 999";
    NewLongitud=validateNumero(Longitud)
    if(ValidInputRange(NoHilos,2,12) && ValidInputRange(Longitud,1,999)){
       CodigoGenerado=Marca + Familia + "M8" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
       + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
      showClave(CodigoGenerado);
    }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }
    let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    let ConectorLadoAselected = ConectorLadoA.options[ConectorLadoA.selectedIndex].text
    let ConectorLadoBselected = ConectorLadoB.options[ConectorLadoB.selectedIndex].text
    let Adicionalesselected = Adicionales.options[Adicionales.selectedIndex].text
    let descripcion_cable = "Cable preconectorizado Exterior Mini-Figura 8 "+TipoFibraselected+" "+TipoCubiertaselected+" "+ConectorLadoAselected+" a "+ConectorLadoBselected+" de "+NoHilos.value+" hilos de "+Longitud.value+" metro(s) "+Adicionalesselected
    if(CodigoGenerado!=''){
      NombreProductoConfigurable(CodigoGenerado, descripcion_cable)  
      DescPrdConf.innerHTML=descripcion_cable
    }else{
        
      DescPrdConf.innerHTML=''
    }
    let BreakOut = Adicionales.value == "BO" || Adicionales.value == "BM" ? 1 : 0
      let data = {
      Action: 'calculo',
      BreakOut : BreakOut,
      ActionPrecioPreconectorizados: true,
      CablesPreconId: 8,
      CablesPreconNumeroHilos: NoHilos.value,
      CablesPreconLongitud: Longitud.value,
      CablesPreconTipoFibra: TipoFibra.value,
      Conector_1: Aux_ConectorLadoA,
      Conector_2: Aux_ConectorLadoB,
      Cubierta:TipoCubierta.value,
      Uso:'Exterior',
      Codigo: CodigoGenerado,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    CalcularPrecio("../../models/Productos/CablePreconectorizado/CalcularPrecio.Route.php", data)
if(CodigoGenerado==''){
    BorrarPrecio();
  }

  let DirectorioImgProducto = Marca + Familia + "M8/fotos"
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(Marca + Familia + "M8")
  ListProductoAdicional(Marca + Familia + "M8")
  agregarFichaTecnicaConfigurable(Marca + Familia + "M8")
  agregarCertificadoConfigurable(CodigoGenerado)
}
var cable_DI = function(){
  let Aux_ConectorLadoA = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('data-conector')
  let Aux_ConectorLadoB = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('data-conector')
  let PosicionConector1 = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('position')
  let PosicionConector2 = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('position')
  // alert(TipoTermiacion.value);
  if(TipoTermiacion.value == '9UM'){
      ContConectorLAMul1 = 0
      ContConectorLBMul1 = 0
      ContConectorLAMon1 = 0
      ContConectorLBMon1 = 0
      if(NoHilos.value>=2 && NoHilos.value<=24){
        Adicionales[1].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [1]);
      }
      if(NoHilos.value>24){
        Adicionales[0].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [1,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [0]);
      }
    if (TipoFibra.value == "09") {
      ContConectorLAMul = 0
      ContConectorLBMul = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [0,1,2,3,4,5,6]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [1,2,3,4,5,6,7]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]);
      
      ContConectorLAMon == 0 ? ConectorLadoA.selectedIndex = 0 : "";
      ContConectorLBMon == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMon++
      ContConectorLBMon++

    }else{
      ContConectorLAMon = 0
      ContConectorLBMon = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [7,8,9,10]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [8,9,10,11]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,12,13,14,15,16,17,18,19,20,21,22,23,24]);

      ContConectorLAMul == 0 ? ConectorLadoA.selectedIndex = 7 : "";
      ContConectorLBMul == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMul++
      ContConectorLBMul++
    }
    if (parseInt(PosicionConector1) < parseInt(PosicionConector2)) {
      NewConector1 = ConectorLadoA.value
      NewConector2 = ConectorLadoB.value
    }else{
      NewConector1 = ConectorLadoB.value
      NewConector2 = ConectorLadoA.value
    }

    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 2 - 48";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 1 - 999";
     NewLongitud=validateNumero(Longitud)
    if(ValidInputRange(NoHilos,2,48) && ValidInputRange(Longitud,1,999)){
      CodigoGenerado=Marca + Familia + "DI" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
      + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
      showClave(CodigoGenerado);
    }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }
    let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    let ConectorLadoAselected = ConectorLadoA.options[ConectorLadoA.selectedIndex].text
    let ConectorLadoBselected = ConectorLadoB.options[ConectorLadoB.selectedIndex].text
    let Adicionalesselected = Adicionales.options[Adicionales.selectedIndex].text
    let descripcion_cable = "Cable preconectorizado Exterior Dielectrico "+TipoFibraselected+" "+TipoCubiertaselected+" "+ConectorLadoAselected+" a "+ConectorLadoBselected+" de "+NoHilos.value+" hilos de "+Longitud.value+" metro(s) "+Adicionalesselected
    if(CodigoGenerado!=''){
      NombreProductoConfigurable(CodigoGenerado, descripcion_cable)  
      DescPrdConf.innerHTML=descripcion_cable
    }else{
        
      DescPrdConf.innerHTML=''
    }

    let BreakOut = Adicionales.value == "BO" || Adicionales.value == "BM" ? 1 : 0
      let data = {
      Action: 'calculo',
      BreakOut : BreakOut,
      ActionPrecioPreconectorizados: true,
      CablesPreconId: 5,
      CablesPreconNumeroHilos: NoHilos.value,
      CablesPreconLongitud: Longitud.value,
      CablesPreconTipoFibra: TipoFibra.value,
      Conector_1: Aux_ConectorLadoA,
      Conector_2: Aux_ConectorLadoB,
      Cubierta:TipoCubierta.value,
      Uso:'Exterior',
      Codigo: CodigoGenerado,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    CalcularPrecio("../../models/Productos/CablePreconectorizado/CalcularPrecio.Route.php", data)
if(CodigoGenerado==''){
        BorrarPrecio();
      }
  let DirectorioImgProducto = Marca + Familia + "DI/fotos"
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(Marca + Familia + "DI")
  ListProductoAdicional(Marca + Familia + "DI")

  agregarFichaTecnicaConfigurable(Marca + Familia + "DI")
  agregarCertificadoConfigurable(CodigoGenerado)
}
var cable_AR = function(){
  let Aux_ConectorLadoA = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('data-conector')
  let Aux_ConectorLadoB = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('data-conector')
  let PosicionConector1 = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('position')
  let PosicionConector2 = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('position')
  // alert(TipoTermiacion.value);
  if(TipoTermiacion.value == '9UM'){
      ContConectorLAMul1 = 0
      ContConectorLBMul1 = 0
      ContConectorLAMon1 = 0
      ContConectorLBMon1 = 0
      if(NoHilos.value>=2 && NoHilos.value<=24){
        Adicionales[1].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [1]);
      }
      if(NoHilos.value>24){
        Adicionales[0].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [1,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [0]);
      }
    if (TipoFibra.value == "09") {
      ContConectorLAMul = 0
      ContConectorLBMul = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [0,1,2,3,4,5,6]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [1,2,3,4,5,6,7]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]);
      
      ContConectorLAMon == 0 ? ConectorLadoA.selectedIndex = 0 : "";
      ContConectorLBMon == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMon++
      ContConectorLBMon++

    }else{
      ContConectorLAMon = 0
      ContConectorLBMon = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [7,8,9,10]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [8,9,10,11]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,12,13,14,15,16,17,18,19,20,21,22,23,24]);

      ContConectorLAMul == 0 ? ConectorLadoA.selectedIndex = 7 : "";
      ContConectorLBMul == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMul++
      ContConectorLBMul++
    }
    if (parseInt(PosicionConector1) < parseInt(PosicionConector2)) {
      NewConector1 = ConectorLadoA.value
      NewConector2 = ConectorLadoB.value
    }else{
      NewConector1 = ConectorLadoB.value
      NewConector2 = ConectorLadoA.value
    }

    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 2 - 48";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 1 - 999";
     NewLongitud=validateNumero(Longitud)
    if(ValidInputRange(NoHilos,2,48) && ValidInputRange(Longitud,1,999)){
      CodigoGenerado=Marca + Familia + "AR" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
      + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
      showClave(CodigoGenerado);
    }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }
    let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    let ConectorLadoAselected = ConectorLadoA.options[ConectorLadoA.selectedIndex].text
    let ConectorLadoBselected = ConectorLadoB.options[ConectorLadoB.selectedIndex].text
    let Adicionalesselected = Adicionales.options[Adicionales.selectedIndex].text
    let descripcion_cable = "Cable preconectorizado Exterior Armado "+TipoFibraselected+" "+TipoCubiertaselected+" "+ConectorLadoAselected+" a "+ConectorLadoBselected+" de "+NoHilos.value+" hilos de "+Longitud.value+" metro(s) "+Adicionalesselected
    if(CodigoGenerado!=''){
      NombreProductoConfigurable(CodigoGenerado, descripcion_cable)  
      DescPrdConf.innerHTML=descripcion_cable
    }else{
        
      DescPrdConf.innerHTML=''
    }

    let BreakOut = Adicionales.value == "BO" || Adicionales.value == "BM" ? 1 : 0
      let data = {
      Action: 'calculo',
      BreakOut : BreakOut,
      ActionPrecioPreconectorizados: true,
      CablesPreconId: 4,
      CablesPreconNumeroHilos: NoHilos.value,
      CablesPreconLongitud: Longitud.value,
      CablesPreconTipoFibra: TipoFibra.value,
      Conector_1: Aux_ConectorLadoA,
      Conector_2: Aux_ConectorLadoB,
      Cubierta:TipoCubierta.value,
      Uso:'Exterior',
      Codigo: CodigoGenerado,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    CalcularPrecio("../../models/Productos/CablePreconectorizado/CalcularPrecio.Route.php", data)
if(CodigoGenerado==''){
        BorrarPrecio();
      }
  let DirectorioImgProducto = Marca + Familia + "AR/fotos"
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(Marca + Familia + "AR")
  ListProductoAdicional(Marca + Familia + "AR")
  agregarFichaTecnicaConfigurable(Marca + Familia + "AR")
  agregarCertificadoConfigurable(CodigoGenerado)
}

var cable_AD = function(){
  let Aux_ConectorLadoA = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('data-conector')
  let Aux_ConectorLadoB = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('data-conector')
  VideoProductosCofigurables('https://www.youtube.com/embed/odGihvIVljU?autoplay=1')
  let PosicionConector1 = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('position')
  let PosicionConector2 = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('position')
  // alert(TipoTermiacion.value);
  if(TipoTermiacion.value == '9UM'){
      ContConectorLAMul1 = 0
      ContConectorLBMul1 = 0
      ContConectorLAMon1 = 0
      ContConectorLBMon1 = 0
      if(NoHilos.value>=2 && NoHilos.value<=24){
        Adicionales[1].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [1]);
      }
      if(NoHilos.value>24){
        Adicionales[0].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [1,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [0]);
      }
    if (TipoFibra.value == "09") {
      ContConectorLAMul = 0
      ContConectorLBMul = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [0,1,2,3,4,5,6]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [1,2,3,4,5,6,7]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]);
      
      ContConectorLAMon == 0 ? ConectorLadoA.selectedIndex = 0 : "";
      ContConectorLBMon == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMon++
      ContConectorLBMon++

    }else{
      ContConectorLAMon = 0
      ContConectorLBMon = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [7,8,9,10]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [8,9,10,11]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,12,13,14,15,16,17,18,19,20,21,22,23,24]);

      ContConectorLAMul == 0 ? ConectorLadoA.selectedIndex = 7 : "";
      ContConectorLBMul == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMul++
      ContConectorLBMul++
    }
    if (parseInt(PosicionConector1) < parseInt(PosicionConector2)) {
      NewConector1 = ConectorLadoA.value
      NewConector2 = ConectorLadoB.value
    }else{
      NewConector1 = ConectorLadoB.value
      NewConector2 = ConectorLadoA.value
    }

    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 2 - 48";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 1 - 999";
    NewLongitud=validateNumero(Longitud)
    if(ValidInputRange(NoHilos,2,48) && ValidInputRange(Longitud,1,999)){
      CodigoGenerado=Marca + Familia + "AD" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
      + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
      showClave(CodigoGenerado);
    }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }
    let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    let ConectorLadoAselected = ConectorLadoA.options[ConectorLadoA.selectedIndex].text
    let ConectorLadoBselected = ConectorLadoB.options[ConectorLadoB.selectedIndex].text
    let Adicionalesselected = Adicionales.options[Adicionales.selectedIndex].text
    let descripcion_cable = "Cable preconectorizado Exterior Armado Dielectrico "+TipoFibraselected+" "+TipoCubiertaselected+" "+ConectorLadoAselected+" a "+ConectorLadoBselected+" de "+NoHilos.value+" hilos de "+Longitud.value+" metro(s) "+Adicionalesselected
    if(CodigoGenerado!=''){
        NombreProductoConfigurable(CodigoGenerado, descripcion_cable)  
        DescPrdConf.innerHTML=descripcion_cable
    }else{
        
      DescPrdConf.innerHTML=''
    }

    let BreakOut = Adicionales.value == "BO" || Adicionales.value == "BM" ? 1 : 0
      let data = {
      Action: 'calculo',
      BreakOut : BreakOut,
      ActionPrecioPreconectorizados: true,
      CablesPreconId: 3,
      CablesPreconNumeroHilos: NoHilos.value,
      CablesPreconLongitud: Longitud.value,
      CablesPreconTipoFibra: TipoFibra.value,
      Conector_1: Aux_ConectorLadoA,
      Conector_2: Aux_ConectorLadoB,
      Cubierta:TipoCubierta.value,
      Uso:'Exterior',
      Codigo: CodigoGenerado,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    CalcularPrecio("../../models/Productos/CablePreconectorizado/CalcularPrecio.Route.php", data)
if(CodigoGenerado==''){
        BorrarPrecio();
      }
  let DirectorioImgProducto = Marca + Familia + "AD/fotos"
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(Marca + Familia + "AD")
  ListProductoAdicional(Marca + Familia + "AD")

  agregarFichaTecnicaConfigurable(Marca + Familia + "AD")
  agregarCertificadoConfigurable(CodigoGenerado)
}
var cable_F8 = function(){
  let Aux_ConectorLadoA = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('data-conector')
  let Aux_ConectorLadoB = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('data-conector')
  StyleDisplayNoneOrBlock_2(TipoFibra, 'none', [4]);
  let PosicionConector1 = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('position')
  let PosicionConector2 = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('position')
  // alert(TipoTermiacion.value);
  if(TipoTermiacion.value == '9UM'){
      ContConectorLAMul1 = 0
      ContConectorLBMul1 = 0
      ContConectorLAMon1 = 0
      ContConectorLBMon1 = 0
      if(NoHilos.value>=2 && NoHilos.value<=24){
        Adicionales[1].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [0,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [1]);
      }
      if(NoHilos.value>24){
        Adicionales[0].selected=true
        StyleDisplayNoneOrBlock_2(Adicionales, 'none', [1,2,3]);
        StyleDisplayNoneOrBlock_2(Adicionales, 'block', [0]);
      }
    if (TipoFibra.value == "09") {
      ContConectorLAMul = 0
      ContConectorLBMul = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [0,1,2,3,4,5,6]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [1,2,3,4,5,6,7]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]);
      
      ContConectorLAMon == 0 ? ConectorLadoA.selectedIndex = 0 : "";
      ContConectorLBMon == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMon++
      ContConectorLBMon++

    }else{
      ContConectorLAMon = 0
      ContConectorLBMon = 0
      // activar elementos lado a
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'block', [7,8,9,10]);
      StyleDisplayNoneOrBlock_2(ConectorLadoA, 'none', [0,1,2,3,4,5,6,11,12,13,14,15,16,17,18,19,20,21,22,23]);
      // activar elementos lado b
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [8,9,10,11]);
      StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [1,2,3,4,5,6,7,12,13,14,15,16,17,18,19,20,21,22,23,24]);

      ContConectorLAMul == 0 ? ConectorLadoA.selectedIndex = 7 : "";
      ContConectorLBMul == 0 ? ConectorLadoB.selectedIndex = 0 : "";
      ContConectorLAMul++
      ContConectorLBMul++
    }
    if (parseInt(PosicionConector1) < parseInt(PosicionConector2)) {
      NewConector1 = ConectorLadoA.value
      NewConector2 = ConectorLadoB.value
    }else{
      NewConector1 = ConectorLadoB.value
      NewConector2 = ConectorLadoA.value
    }
    if (TipoFibra.value == "09") {
      // mostrar rango de hilos valido
      NoHilos_label.innerHTML = " 2 - 48";
      // mostrar longitud valida
      Longitud_label.innerHTML = " 1 - 999";
      NewLongitud=validateNumero(Longitud)
      if(ValidInputRange(NoHilos,2,48) && ValidInputRange(Longitud,1,999)){
         CodigoGenerado=Marca + Familia + "F8" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
         + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
        showClave(CodigoGenerado);
      }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }else{
    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 2 - 24";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 1 - 999";
     NewLongitud=validateNumero(Longitud)
    if(ValidInputRange(NoHilos,2,24) && ValidInputRange(Longitud,1,999)){
       CodigoGenerado=Marca + Familia + "F8" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
       + NewConector1 + NewConector2 + NewLongitud + Adicionales.value;
      showClave(CodigoGenerado);
    }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }

  }
    let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
    let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
    let ConectorLadoAselected = ConectorLadoA.options[ConectorLadoA.selectedIndex].text
    let ConectorLadoBselected = ConectorLadoB.options[ConectorLadoB.selectedIndex].text
    let Adicionalesselected = Adicionales.options[Adicionales.selectedIndex].text
    let descripcion = "Cable preconectorizado Figura 8 con armadura "+TipoFibraselected+" "+TipoCubiertaselected+" "+ConectorLadoAselected+" a "+ConectorLadoBselected+" de "+NoHilos.value+" hilos de "+Longitud.value+" metro(s) "+Adicionalesselected
    if(CodigoGenerado!=''){
      NombreProductoConfigurable(CodigoGenerado, descripcion)
      DescPrdConf.innerHTML=descripcion
    }else{
        
      DescPrdConf.innerHTML=''
    }
    let BreakOut = Adicionales.value == "BO" || Adicionales.value == "BM" ? 1 : 0
      let data = {
      Action: 'calculo',
      BreakOut : BreakOut,
      ActionPrecioPreconectorizados: true,
      CablesPreconId: 7,
      CablesPreconNumeroHilos: NoHilos.value,
      CablesPreconLongitud: Longitud.value,
      CablesPreconTipoFibra: TipoFibra.value,
      Conector_1: Aux_ConectorLadoA,
      Conector_2: Aux_ConectorLadoB,
      Cubierta:TipoCubierta.value,
      Uso:'Exterior',
      Codigo: CodigoGenerado,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    CalcularPrecio("../../models/Productos/CablePreconectorizado/CalcularPrecio.Route.php", data)
if(CodigoGenerado==''){
        BorrarPrecio();
      }
  let DirectorioImgProducto = Marca + Familia + "F8/fotos"
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(Marca + Familia + "F8")
      ListProductoAdicional(Marca + Familia + "F8")
      agregarFichaTecnicaConfigurable(Marca + Familia + "F8")
      agregarCertificadoConfigurable(CodigoGenerado)
}

var cable_FT = function(){
  // alert(TipoTermiacion.value);
  let Aux_ConectorLadoA = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('data-conector')
  let Aux_ConectorLadoB = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('data-conector')
 
 
  ConAuxLadoA=ConectorLadoA.value;
  ConAuxLadoB=ConectorLadoB.value;

  if(TipoTermiacion.value == '2MM'){
    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 2 - 2";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 2 - 999";
    NewLongitud=validateNumero(Longitud)
    if(ValidInputRange(NoHilos,2,2) && ValidInputRange(Longitud,3,999)){
      CodigoGenerado=Marca + Familia + "HW" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
      + ConAuxLadoA + ConAuxLadoB + NewLongitud + Adicionales.value;
      showClave(CodigoGenerado);
      //verificarCostoFigura0(Longitud.value,ConAuxLadoA,ConAuxLadoB)
      let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
      let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
      let ConectorLadoAselected = ConectorLadoA.options[ConectorLadoA.selectedIndex].text
      let ConectorLadoBselected = ConectorLadoB.options[ConectorLadoB.selectedIndex].text
      let Adicionalesselected = Adicionales.options[Adicionales.selectedIndex].text
      let descripcion_cable = "Cable preconectorizado FTTA "+TipoFibraselected+" "+TipoCubiertaselected+" "+ConectorLadoAselected+"-"+ConectorLadoBselected+" de "+NoHilos.value+" hilos de "+Longitud.value+" metro(s) "+Adicionalesselected
      
      if(CodigoGenerado!=''){
       NombreProductoConfigurable(CodigoGenerado, descripcion_cable) 
       DescPrdConf.innerHTML=descripcion_cable 
      }else{
        
      DescPrdConf.innerHTML=''
    }
      
    }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }

  let BreakOut = Adicionales.value == "BO" || Adicionales.value == "BM" ? 1 : 0
    let data = {
    Action: 'calculo',
    BreakOut : BreakOut,
    ActionPrecioPreconectorizados: true,
    CablesPreconId: 10,
    CablesPreconNumeroHilos: NoHilos.value,
    CablesPreconLongitud: Longitud.value,
    CablesPreconTipoFibra: TipoFibra.value,
    Conector_1: Aux_ConectorLadoA,
    Conector_2: Aux_ConectorLadoB,
    Cubierta:TipoCubierta.value,
    Uso:'Interior',
    Codigo: CodigoGenerado,
    SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
  }
  CalcularPrecio("../../models/Productos/CablePreconectorizado/CalcularPrecio.Route.php", data)

if(CodigoGenerado==''){
        BorrarPrecio();
      }

  let DirectorioImgProducto = Marca + Familia + "FT/fotos/" + Aux_ConectorLadoB 
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(Marca + Familia + "FT")
  ListProductoAdicional(Marca + Familia + "FT")
  agregarFichaTecnicaConfigurable(Marca + Familia + "FT")
  agregarCertificadoConfigurable(CodigoGenerado)
}

var cable_DB0 = function(){
  // alert(TipoTermiacion.value);
  let Aux_ConectorLadoA = ConectorLadoA.options[ConectorLadoA.selectedIndex].getAttribute('data-conector')
  let Aux_ConectorLadoB = ConectorLadoB.options[ConectorLadoB.selectedIndex].getAttribute('data-conector')
 


  ConAuxLadoA=ConectorLadoA.value;
  ConAuxLadoB=ConectorLadoB.value;
  console.log(ConectorLadoA.value)
  if(ConectorLadoA.value=='BQ'){
    StyleDisplayNoneOrBlock_2(ConectorLadoB, 'none', [0]);
    if(ConectorLadoB.selectedIndex == 0)
        ConectorLadoB.selectedIndex = 1
  }else{
    StyleDisplayNoneOrBlock_2(ConectorLadoB, 'block', [0]);
  }


let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text
      let TipoCubiertaselected = TipoCubierta.options[TipoCubierta.selectedIndex].text
      let ConectorLadoAselected = ConectorLadoA.options[ConectorLadoA.selectedIndex].text
      let ConectorLadoBselected = ConectorLadoB.options[ConectorLadoB.selectedIndex].text
  if(TipoTermiacion.value == '3MM'){
    // mostrar rango de hilos valido
    NoHilos_label.innerHTML = " 1 - 1";
    // mostrar longitud valida
    Longitud_label.innerHTML = " 1 - 999";
    NewLongitud=validateNumero(Longitud)
    if(ValidInputRange(NoHilos,1,1) && ValidInputRange(Longitud,1,999)){
      CodigoGenerado=Marca + Familia + "D0" + TipoFibra.value + TipoCubierta.value + NumeroConCeros2(NoHilos.value,2) 
      + ConAuxLadoA + ConAuxLadoB + NewLongitud;
      showClave(CodigoGenerado);
      //verificarCostoFigura0(Longitud.value,ConAuxLadoA,ConAuxLadoB)
      
      let descripcion_cable = "Cable preconectorizado Drop Figura 0 "+TipoFibraselected+" "+TipoCubiertaselected+" "+ConectorLadoAselected+" a "+ConectorLadoBselected+" de "+NoHilos.value+" hilo(s) de "+Longitud.value+" metro(s) "
      
      if(CodigoGenerado!=''){
       NombreProductoConfigurable(CodigoGenerado, descripcion_cable) 
       DescPrdConf.innerHTML=descripcion_cable 
      }else{
        
      DescPrdConf.innerHTML=''
    }
      
    }else{
        CodigoGenerado='';
        showClave(CodigoGenerado);
      }
  }

  let BreakOut =  0
    let data = {
    Action: 'calculo',
    BreakOut : BreakOut,
    ActionPrecioPreconectorizados: true,
    CablesPreconId: 10,
    CablesPreconNumeroHilos: NoHilos.value,
    CablesPreconLongitud: Longitud.value,
    CablesPreconTipoFibra: TipoFibra.value,
    Conector_1: Aux_ConectorLadoA,
    Conector_2: Aux_ConectorLadoB,
    Cubierta:TipoCubierta.value,
    Uso:'Interior',
    Codigo: CodigoGenerado,
    SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
  }
  CalcularPrecio("../../models/Productos/CablePreconectorizado/CalcularPrecio.Route.php", data)

  if(CodigoGenerado==''){
    BorrarPrecio();
  }

  let DirectorioImgProducto = Marca + Familia + "DB0/fotos/"+ConectorLadoAselected+ConectorLadoBselected
  
  ListImgProducto(DirectorioImgProducto)
  ListProductoDescription(Marca + Familia + "DB0")
  ListProductoAdicional(Marca + Familia + "DB0")
  agregarFichaTecnicaConfigurable(Marca + Familia + "DB0")
  agregarCertificadoConfigurable(CodigoGenerado)
}

var interior_exterior_cable = function() {
    let Cable = document.getElementById('Cable')
    switch(Cable.value){
      case 'IE' : // Cable Interior Exterior
        cable_IE()
        break;
      case 'CI' : // Cable Distribución
        cable_CI()
        break;
      case 'SA' : // Cable ADDS
        cable_SA()
        break;
      case 'D0' : // Cable Drop Figura 0
        cable_D0()
        break;
      case 'S8' : // Cable figura 8 sin armadura
        cable_S8()
        break;
      case 'M8' : // Cable Exterior  mini figura 8
        cable_M8()
        break;
      case 'DI' : // Cable Exterior Dielectrico
        cable_DI()
        break;
      case 'AR' : // Cable Exterior Armado
        cable_AR()
        break;
      case 'AD' : // Cable Exterior Armado Dielectrico
        cable_AD()
        break;
      case 'F8' : // Cable Exterior Figura 8 con armadura
        cable_F8()
        break;
       case 'FT' : // Cable FTTA
        cable_FT()
        break;
        case 'DB0' : // Cable Drop Figura 0 bala
        cable_DB0()
        break;
      default:
        templateAlert("warning", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
        console.log("No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo")
    }
  }
  
  interior_exterior_cable()