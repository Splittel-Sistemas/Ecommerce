// Categoría 5e
var Categoria="CAT5E"
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
var Categoria5e = function(){
  let Longitud = document.getElementById('Longitud')
  validateEntero(Longitud.value)
  let Color = document.getElementById('Color')
  let LongitudIdText = document.getElementById('LongitudIdText')
  let UnidadMedida = "P" // Pies
  let CodigoGenerado = ""
  let LongitudMin = 1
  let LongitudMax = 210
  StyleDisplayNoneOrBlock_2(Color, 'none', [2])
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
    ChangeListImgProducto(DirectorioImgProducto, ImgProducto)
	  
    ListProductoDescription('OPCAPCC5')
    ListProductoAdicional('OPCAPCC5')
    showClave(CodigoGenerado)
    existCodeSapPatchCord(CodigoGenerado)

    let x = Color.selectedIndex;
    let y = Color.options;
    let ColorText = y[x].text    

    let descripcion = "PatchCord Cat5e "+Longitud.value+" pie(s) color "+ColorText
    NombreProductoConfigurable(CodigoGenerado, descripcion)
    DescPrdConf.innerHTML=descripcion
    agregarFichaTecnicaConfigurable(Marca+Familia+Estructurados.value)
    agregarCertificadoConfigurable(CodigoGenerado)
}

Categoria5e()