// Cable de Servico

var Marca = "OP"
var Familia = "EECS"
var TipoFibra = "09"
var TipoCable = "FD"
var Con = "SCA"
var Clave = document.getElementById('Clave')

var CableServicio412 = function(){
  let Longitud = document.getElementById('Longitud')
  validacionCantidad_(Longitud, 2)

  let NumeroHilos = document.getElementById('NumeroHilos')
  let Diametro = document.getElementById('Diametro')
  let Diametroselected = Diametro.options[Diametro.selectedIndex].text;
  let Conector = document.getElementById('Conector')
  let Conectorselected = Conector.options[Conector.selectedIndex].text;
  let NewLongitud = Longitud.value >= 3 && Longitud.value <= 9 ? "0"+Longitud.value*10 : Longitud.value*10
  let CodigoGenerado = ""
  document.getElementById('CostoProducto').value = "" 
  document.getElementById('Costo').innerHTML = "$ "
  // Agregación de codigo para la vista en el identificador
  if(Longitud.value <= 99 && Longitud.value >= 3){
    CodigoGenerado = Marca+Familia+TipoFibra+NumeroHilos.value+TipoCable+Con+NewLongitud+Diametro.value
    ListImgProducto('OPEECS')
    ListProductoDescription('OPEECS')
    ListProductoAdicional('OPEECS')

    let descripcion = "Cable de servicio monomodo de "+NumeroHilos.value+" hilos "+Conectorselected+" de "+Longitud.value+" metro(s) de "+Diametroselected
    NombreProductoConfigurable(CodigoGenerado, descripcion)

    let data = { 
      Action: 'calcular', 
      ActionCalcularPrecioCableServicio: true,
      Longitud: Longitud.value,
      NumeroHilos: NumeroHilos.value,
      SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
    }
    CalcularPrecio("../../models/Productos/CableServicio/CalcularPrecioCableServicio.Route.php", data)
  }
  showClave(CodigoGenerado)
} 

var CableServicio = function() {
  let Cable = document.getElementById('Cable')
  switch(Cable.value){
    case 'CASERV412' : 
      CableServicio412()
    break;
    default:
      templateAlert("warning", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
      console.log("No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo")
  }
}

CableServicio()