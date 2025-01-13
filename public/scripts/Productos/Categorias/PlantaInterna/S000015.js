// Pigtails

var Marca = "OP"
var Familia = "PI"
var Pigtail = document.getElementById('Cable')
var DescPrdConf = document.getElementById('DscProductoConfigurable')

var Pigtails = function(){
  let Longitud = document.getElementById('Longitud')
  if (Longitud.value.split('.')[1]) {
    if (Longitud.value.split('.')[1].length > 1) {
      return false;
    }
  }
  let TipoFibra = document.getElementById('TipoFibra')
  let TipoFibraselected = TipoFibra.options[TipoFibra.selectedIndex].text;
  let NumeroHilos = document.getElementById('NumeroHilos')
  let TipoPulido = document.getElementById('TipoPulido')
  let Diametro = document.getElementById('Diametro')
  let Diametroselected = Diametro.options[Diametro.selectedIndex].text;
  let Cubierta = 'RI'
  let Otro = "B"
  let CodigoGenerado = ""
  let LongitudMin = 0.1
  let LongitudMax = 10
  let LongitudIdText = document.getElementById('LongitudIdText')

    if(Pigtail.value=='ST'){
      //upc
      if (TipoFibra.value == '09') {
        StyleDisplayNoneOrBlock_2(TipoPulido, "none", [1,2])
        StyleDisplayNoneOrBlock_2(TipoPulido, "block", [0])
        if(TipoPulido[0].selected != true){
          TipoPulido[0].selected = true
        }
      }else{
        StyleDisplayNoneOrBlock_2(TipoPulido, "none", [0,1])
        StyleDisplayNoneOrBlock_2(TipoPulido, "block", [2])
        TipoPulido[2].selected = true
      }
    }else{
      if (TipoFibra.value == '09') {
        StyleDisplayNoneOrBlock_2(TipoPulido, "none", [2])
        StyleDisplayNoneOrBlock_2(TipoPulido, "block", [0,1])
        if(TipoPulido[2].selected == true){
          TipoPulido[0].selected = true
        }
      }else{
        StyleDisplayNoneOrBlock_2(TipoPulido, "none", [0,1])
        StyleDisplayNoneOrBlock_2(TipoPulido, "block", [2])
        TipoPulido[2].selected = true
      }
    } 
    TipoPulido = TipoPulido.value

    if (NumeroHilos.value == 'S12' || NumeroHilos.value == 'S06') {
      LongitudMin = 1
      LongitudMax = 10
      StyleDisplayNoneOrBlock_2(Diametro, "block", [0])
      StyleDisplayNoneOrBlock_2(Diametro, "none", [1])
      Diametro[0].selected = true
       
    }else{
      StyleDisplayNoneOrBlock_2(Diametro, "block", [0,1])
      
    }
    Diametroselected = Diametro.options[Diametro.selectedIndex].text;
    LongitudIdText.innerHTML = 'Longitud (m) '+LongitudMin+'~'+LongitudMax+':'
    Longitud1=Longitud.value 
    if (Longitud.value >= LongitudMin && Longitud.value <= LongitudMax) {
      Longitud = NumeroConCeros(Longitud.value, 4)
      if (NumeroHilos.value == 'D') {
        CodigoGenerado = Marca+Familia+Pigtail.value+TipoPulido+TipoFibra.value+NumeroHilos.value+Otro+Longitud+Cubierta+Diametro.value
      }else{
        if(TipoFibra.value==57 && NumeroHilos.value=='' && Diametro.value==2)
            Cubierta="ZH"
        
        CodigoGenerado = Marca+Familia+Pigtail.value+TipoPulido+TipoFibra.value+Otro+Longitud+Cubierta+Diametro.value+NumeroHilos.value
      }
    }
    
    ChangeListImgProducto(Marca+Familia+Pigtail.value,Marca+Familia+Pigtail.value+TipoPulido+TipoFibra.value+NumeroHilos.value)
    ListProductoDescription(Marca+Familia+Pigtail.value)
    ListProductoAdicional(Marca+Familia+Pigtail.value)
    showClave(CodigoGenerado)

    let descripcion = "Pigtail "+Pigtail.value+TipoPulido+" "+TipoFibraselected+" "+NumeroHilos.value+" de "+Longitud1+" metro(s) de "+Diametroselected
    NombreProductoConfigurable(CodigoGenerado, descripcion)
    DescPrdConf.innerHTML=descripcion
    let data = {
      Action: 'calcular',
      ActionCalcularPrecioPigtail: true,
      Longitud : Longitud1,
      NumeroHilos : NumeroHilos.value,
      Conector : Pigtail.value,
      Fibra : TipoFibra.value,
      Diametro : Diametro.value,
      Pulido : TipoPulido,
      Codigo: CodigoGenerado,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    CalcularPrecio("../../models/Productos/Pigtails/CalcularPrecioPigtail.Route.php", data)
    agregarFichaTecnicaConfigurable(Marca+Familia+Pigtail.value+TipoPulido+TipoFibra.value+Otro)
    agregarCertificadoConfigurable(CodigoGenerado)
}

Pigtails()