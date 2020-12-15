// Distribuidores Precargados

var Marca = "OP"
var Familia = "DI"
var Unidad = document.getElementById('Cable')
var NumeroAcopladoresMin = 1

var cont = 0
var DistribuidoresPrecargadosRack = function(AcopladoresMax, Montaje){
  let NumeroAcopladores = document.getElementById('NumeroAcopladores')
  let TipoAcoplador = document.getElementById('TipoAcoplador')
  let Puertos = document.getElementById('Puertos')
  let PuertoSelect = document.getElementById('PuertoSelect')
  let TipoMontaje = Montaje
  let NumeroAcopladoresMax = AcopladoresMax
  let NumeroAcopladoresIdText = document.getElementById('NumeroAcopladoresIdText')
  let Color = document.getElementById('Color')
  let ColorSelect = document.getElementById('ColorSelect')
  let CodigoGenerado = ''
  let NewColor = ""

  if (TipoAcoplador.value == "LCP" || TipoAcoplador.value == "SCP") {
    StyleDisplayNoneOrBlock(ColorSelect, "block")
    NewColor = Color.value
  }

  if (TipoAcoplador.value == "FCU" || TipoAcoplador.value == "FCP" || TipoAcoplador.value == "STU" 
   || TipoAcoplador.value == "STP" || TipoAcoplador.value == "LCU" || TipoAcoplador.value == "LCA"
   || TipoAcoplador.value == "SCU" || TipoAcoplador.value == "SCA" ) {
    StyleDisplayNoneOrBlock(ColorSelect, "none")
    //Puertos.selectedIndex = 1 
  }

    StyleDisplayNoneOrBlock_2(Puertos, 'block', [0,1,2])
    StyleDisplayNoneOrBlock(PuertoSelect, 'block')
    if (TipoAcoplador.value == 'LCU' || TipoAcoplador.value == 'LCA' || TipoAcoplador.value == 'LCP') {
      StyleDisplayNoneOrBlock_2(Puertos, 'none', [1])
      if(Puertos[1].selected==true){
        Puertos[0].selected=true;
      }
    }else if (TipoAcoplador.value == 'SCU' || TipoAcoplador.value == 'SCA' || TipoAcoplador.value == 'SCP') {
      StyleDisplayNoneOrBlock_2(Puertos, 'none', [2])
      if(Puertos[2].selected==true){
        Puertos[0].selected=true;
      }
    }else if (TipoAcoplador.value == 'FCU' || TipoAcoplador.value == 'FCP' || TipoAcoplador.value == 'STU' || TipoAcoplador.value == 'STP') {
      StyleDisplayNoneOrBlock_2(Puertos, 'none', [0,2])
      if(Puertos[2].selected==true || Puertos[0].selected==true){
        Puertos[1].selected=true;
      }
      NumeroAcopladoresMax = NumeroAcopladoresMax * 2;
    }
    
   
    NumeroAcopladoresIdText.innerHTML = 'Número de acopladores '+NumeroAcopladoresMin+'~'+NumeroAcopladoresMax+':'
    
    if (NumeroAcopladores.value >= NumeroAcopladoresMin && NumeroAcopladores.value <= NumeroAcopladoresMax) {
      CodigoGenerado = Marca+Familia+TipoMontaje+Unidad.value+NumeroConCeros2(NumeroAcopladores.value, 2)+TipoAcoplador.value+Puertos.value+NewColor
      
      let data = {
        Action: 'calcular',
        ActionCalcularPrecioPrecargados : true,
        Distribuidor: Unidad.value,
        Capacidad: NumeroAcopladoresMax,
        Acoplador: TipoAcoplador.value,
        Color: NewColor,
        Puertos: Puertos.value,
        NumeroAcopladores: NumeroAcopladores.value*1,
        SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
      }
      CalcularPrecio("../../models/Productos/Distribuidores/Precargados/PrecargadoCalcularPrecio.Route.php", data)
           
      let Puertosselected = Puertos.options[Puertos.selectedIndex].text
      if(ColorSelect.style.display=="block"){
         Colorselected = Color.options[Color.selectedIndex].text
      }else{
         Colorselected = ""
      }
      let descripcion = "Distribuidor precargado "+Unidad.value+" "+NumeroAcopladores.value+" Acoplador(es) "+Colorselected+" "+TipoAcoplador.value+" "+Puertosselected
      if(CodigoGenerado!=''){
        NombreProductoConfigurable(CodigoGenerado, descripcion)
      }
    }
    // Agregación de codigo para la vista en el identificador
    showClave(CodigoGenerado)
    ListImgProducto(Marca+Familia+TipoMontaje+Unidad.value)
    ListProductoDescription(Marca+Familia+TipoMontaje+Unidad.value)
    ListProductoAdicional(Marca+Familia+TipoMontaje+Unidad.value)
    agregarFichaTecnicaConfigurable(Marca+Familia+TipoMontaje+Unidad.value)
      agregarCertificadoConfigurable(CodigoGenerado)
}

var DistribuidoresPrecargados = function() {
  switch(Unidad.value){
    case '1U' : 
      DistribuidoresPrecargadosRack(18, 'RA')
    break;
    case 'E1U' : 
      DistribuidoresPrecargadosRack(18, 'RA')
    break;
    case '2U' : 
      DistribuidoresPrecargadosRack(36, 'RA')
    break;
    case '4U' : 
      DistribuidoresPrecargadosRack(72, 'RA')
    break;
    case '1W' : 
      DistribuidoresPrecargadosRack(6, 'PA')
    break;
    case '2W' : 
      DistribuidoresPrecargadosRack(12, 'PA')
    break;
    case 'E2W' : 
      DistribuidoresPrecargadosRack(24, 'PA')
    break;
    case '2WS' : 
      DistribuidoresPrecargadosRack(12, 'PA')
    break;
    default:
      templateAlert("warning", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
  }  
}

DistribuidoresPrecargados()