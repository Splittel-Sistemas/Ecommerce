// Categoria 6
var Categoria="CAT6"
var Marca = "OP"
var Familia = "CA"
var Estructurados = document.getElementById('Cable')

var Categoria6 = function(){
  let Longitud = document.getElementById('Longitud')
  let Color = document.getElementById('Color')
  let LongitudIdText = document.getElementById('LongitudIdText')
  let UnidadMedida = "P" // Pies
  let CodigoGenerado = ""
  let LongitudMin = 1
  let LongitudMax = 210
  StyleDisplayNoneOrBlock_2(Color, 'none', [1,2])
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
    agregarFichaTecnicaConfigurable(Marca+Familia+Estructurados.value)
    agregarCertificadoConfigurable(CodigoGenerado)
}

Categoria6()