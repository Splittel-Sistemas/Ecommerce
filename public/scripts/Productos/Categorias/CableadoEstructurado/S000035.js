// Categoria 6
var Categoria="CAT6"
var Marca = "OP"
var Familia = "CA"
var Estructurados = document.getElementById('Cable')
var DescPrdConf = document.getElementById('DscProductoConfigurable')
function validateEntero(valor) {
  var patronEntero = /^\d*$/; 
  if (patronEntero.test(valor)) {
      return true;
  } else {
    //console.log('test'+valor.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1'))
    document.getElementById('Longitud').value=valor.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1')
  }
}
var Categoria6UTP = function(){
  let Longitud = document.getElementById('Longitud')
  validateEntero(Longitud.value)
  let Color = document.getElementById('Color')
  let LongitudIdText = document.getElementById('LongitudIdText')
  let UnidadMedida = "P" // Pies
  let CodigoGenerado = ""
  let LongitudMin = 1
  let LongitudMax = 210
 // StyleDisplayNoneOrBlock_2(Color, 'none', [1,2])
    LongitudIdText.innerHTML = 'Longitud (pies) '+LongitudMin+'~'+LongitudMax+':'

    if (Longitud.value >= LongitudMin && Longitud.value <= LongitudMax) {
      CodigoGenerado = Marca+Familia+Estructurados.value+NumeroConCeros2(Longitud.value, 2)+UnidadMedida+Color.value
      let data =  { 
        Action: 'calcular',
        ActionCalcularPrecioPatchCord: true,
        Longitud: Longitud.value,
        Categoria: Categoria,
        SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
      } 
      CalcularPrecioPatchCords("../../models/Productos/PatchCord/CalcularPrecioPatchCord.Route.php", data)
    }
    // Agregación de codigo para la vista en el identificador
    let DirectorioImgProducto = Marca+Familia+Estructurados.value
    let ImgProducto = DirectorioImgProducto+Color.value
    ListProductoDescription('OPCAPCC6')
    ListProductoAdicional('OPCAPCC6')
    ChangeListImgProducto(DirectorioImgProducto, ImgProducto)
    
    showClave(CodigoGenerado)
    existCodeSapPatchCord(CodigoGenerado)
    
    let x = Color.selectedIndex;
    let y = Color.options;
    let ColorText = y[x].text    

    let descripcion = "PatchCord Cat6 "+Longitud.value+" pie(s) color "+ColorText
    NombreProductoConfigurable(CodigoGenerado, descripcion)
    DescPrdConf.innerHTML=descripcion
    agregarFichaTecnicaConfigurable(Marca+Familia+Estructurados.value)
    agregarCertificadoConfigurable(CodigoGenerado)
}
var Categoria628AWG = function(){
  EstructuradosAlias='PCC6'
  Categoria='CAT628AWG'
  let Longitud = document.getElementById('Longitud')
  validateEntero(Longitud.value)
  let Color = document.getElementById('Color')
  let LongitudIdText = document.getElementById('LongitudIdText')
  let UnidadMedida = "P" // Pies
  let Cubierta = "SEZH" // Pies
  let CodigoGenerado = ""
  let LongitudMin = 1
  let LongitudMax = 49
  StyleDisplayNoneOrBlock_2(Color, "none", [1, 2, 3, 4, 5])
 // StyleDisplayNoneOrBlock_2(Color, 'none', [1,2])
    LongitudIdText.innerHTML = 'Longitud (pies) '+LongitudMin+'~'+LongitudMax+':'

    if (Longitud.value >= LongitudMin && Longitud.value <= LongitudMax) {
      CodigoGenerado = Marca+Familia+EstructuradosAlias+NumeroConCeros2(Longitud.value, 2)+UnidadMedida+Color.value+Cubierta
      let data =  { 
        Action: 'calcular',
        ActionCalcularPrecioPatchCord: true,
        Longitud: Longitud.value,
        Categoria: Categoria,
        SubcategoriaN1Code: document.getElementById("CodeConfigurable").value
      } 
      CalcularPrecioPatchCords("../../models/Productos/PatchCord/CalcularPrecioPatchCord.Route.php", data)
    }
    // Agregación de codigo para la vista en el identificador
    let DirectorioImgProducto = Marca+Familia+Estructurados.value
    let ImgProducto = DirectorioImgProducto+Color.value
    ListProductoDescription('OPCAPCC6-1')
    ListProductoAdicional('OPCAPCC6-1')
    ChangeListImgProducto(DirectorioImgProducto, ImgProducto)
    
    showClave(CodigoGenerado)
    existCodeSapPatchCord(CodigoGenerado)
    
    let x = Color.selectedIndex;
    let y = Color.options;
    let ColorText = y[x].text    

    let descripcion = "PatchCord Diametro Reducido 28 AWG Cat6 "+Longitud.value+" pie(s) color "+ColorText
    NombreProductoConfigurable(CodigoGenerado, descripcion)
    DescPrdConf.innerHTML=descripcion
    agregarFichaTecnicaConfigurable(Marca+Familia+Estructurados.value)
    agregarCertificadoConfigurable(CodigoGenerado)
}
var Categoria6 = function() {
  switch(Cable.value){
    case 'PCC6' : 
      Categoria6UTP()
    break;
    case 'PCC6-1' : 
      Categoria628AWG()
    break; 
   
    default:
      templateAlert("danger", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
      console.log("No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo")
  }
}
Categoria6()