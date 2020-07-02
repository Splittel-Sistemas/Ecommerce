// Distribuidores Preconectorizados

var Marca = "OP"
var Ensamble = "EE"
var Familia = "DP"
var Unidad = document.getElementById('Cable')
var NumeroAcopladoresMin = 1
var Pig = 'P'

var cont = 0
var cont_1 = 0
var cont_2 = 0
var DistribuidoresPreconectorizados_ = function(AcopladoresMax){
  let NumeroAcopladores = document.getElementById('NumeroAcopladores')
  let TipoAcoplador = document.getElementById('TipoAcoplador')
  let Puertos = document.getElementById('Puertos')
  let PuertoSelect = document.getElementById('PuertoSelect')
  let NumeroAcopladoresMax = AcopladoresMax
  let NumeroAcopladoresIdText = document.getElementById('NumeroAcopladoresIdText')
  let TipoFibra = document.getElementById('TipoFibra')
  let TipoFibraDescripcion = TipoFibra.options[TipoFibra.selectedIndex].text
  let CodigoGenerado = ''

    StyleDisplayNoneOrBlock_2(Puertos, 'block', [0,1,2])
    StyleDisplayNoneOrBlock(PuertoSelect, 'block')
    if (TipoAcoplador.value == 'LCU' || TipoAcoplador.value == 'LCA' || TipoAcoplador.value == 'LCP') {
      StyleDisplayNoneOrBlock_2(Puertos, 'none', [0])
    }else if (TipoAcoplador.value == 'SCU' || TipoAcoplador.value == 'SCA' || TipoAcoplador.value == 'SCP') {
      StyleDisplayNoneOrBlock_2(Puertos, 'none', [2])
    }else if (TipoAcoplador.value == 'FCU' || TipoAcoplador.value == 'FCP' || TipoAcoplador.value == 'STU' || TipoAcoplador.value == 'STP') {
      StyleDisplayNoneOrBlock_2(Puertos, 'none', [1,2])
      
      NumeroAcopladoresMax = NumeroAcopladoresMax * 2;
    }

    if (TipoAcoplador.value == "FCU" || TipoAcoplador.value == "FCP" || TipoAcoplador.value == "STU" || TipoAcoplador.value == "STP") {
      Puertos.selectedIndex = 0 
      cont = 0
    }

    if (TipoAcoplador.value == "LCU" || TipoAcoplador.value == "LCA" || TipoAcoplador.value == "LCP") {
      cont == 0 ? Puertos.selectedIndex = 1 : "";
      cont++;
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

    NumeroAcopladoresIdText.innerHTML = 'Número de acopladores '+NumeroAcopladoresMin+'~'+NumeroAcopladoresMax+':'

    if (NumeroAcopladores.value >= NumeroAcopladoresMin && NumeroAcopladores.value <= NumeroAcopladoresMax) {
      CodigoGenerado = Marca+Ensamble+Familia+Unidad.value+NumeroConCeros2(NumeroAcopladores.value, 2)+TipoAcoplador.value+Puertos.value+TipoFibra.value+Pig
      // Obtener Precio
      let acoplador = TipoAcoplador.options[TipoAcoplador.selectedIndex].getAttribute('acoplador')
      let data = {
        Action: 'calcular',
        ActionCalcularPrecioPreconectorizados : true,
        Conector: TipoAcoplador.value,
        Distribuidor: Unidad.value,
        Capacidad: NumeroAcopladoresMax,
        Acoplador: acoplador,
        TipoFibra: TipoFibra.value,
        Puerto: Puertos.value,
        NumeroAcopladores: NumeroAcopladores.value
      }
      calcularPrecioPreconectorizados(data)
      // Registrar descripción 
      let DescripcionProducto = document.getElementById('descripcion-producto-configurable')
      let Descripcion = DescripcionProducto.getAttribute('descripcion')+" LCU dúplex de "+NumeroAcopladores.value+" acopladores y fibra "+TipoFibraDescripcion
      data = { Codigo: CodigoGenerado, Descripcion: Descripcion }
      NombreProductoConfigurable(data)
      
    }else{
      templateAlert("danger", "", "Número de acopladores no valido", "topRight", "icon-slash")
    }
    
    // Agregación de codigo para la vista en el identificador
    showClave(CodigoGenerado)
    Directorio = Marca+Ensamble+Familia+Unidad.value
    ListImgProducto(Directorio)
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
      document.getElementById('CostoProducto').value = response.precio 
      document.getElementById('Costo').innerHTML = "$"+response.precio
    }else{
      ProductoEspecial()
    }
  })
}

var DistribuidoresPreconectorizados = function() {
  switch(Unidad.value){
    case '1U' : 
      DistribuidoresPreconectorizados_(18)
    break;
    case '1E' : 
      DistribuidoresPreconectorizados_(18)
    break;
    case '2U' : 
      DistribuidoresPreconectorizados_(36)
    break;
    case '4U' : 
      DistribuidoresPreconectorizados_(72)
    break;
    case '1W' : 
      DistribuidoresPreconectorizados_(6)
    break;
    case '2W' : 
      DistribuidoresPreconectorizados_(12)
    break;
    case 'E2W' : 
      DistribuidoresPreconectorizados_(24)
    break;
    default:
      templateAlert("warning", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
  }  
}

DistribuidoresPreconectorizados()