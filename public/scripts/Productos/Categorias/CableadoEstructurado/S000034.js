// Categoría 5e
var Categoria="CAT5E"
var Marca = "OP"
var Familia = "CA"
var Estructurados = document.getElementById('Cable')

var Categoria5e = function(){
  let Longitud = document.getElementById('Longitud')
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
      calcularPrecioPatchcord(data)
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
    patchCordNombreCodigoConfigurable({ pies: Longitud.value, color: ColorText, codigo: CodigoGenerado })
}
/**
 * 
 *
 * @param {Json} data
 *
 * @return {number} b - Bar
 */
var calcularPrecioPatchcord = function(data) {
  ajax_('../../models/Productos/PatchCord/CalcularPrecioPatchCord.Route.php', 'POST', 'JSON', data, 
  function(response){
    if (!response.error) {
      $('#span-leyenda').remove()
      document.getElementById('CostoProducto').value = response.precio 
      document.getElementById('Costo').innerHTML = "$"+response.precio
    }else{
      ProductoEspecial()
    }
  })
}

var patchCordNombreCodigoConfigurable = function(data){
  if(document.getElementById('CodeConfigurable')){
    let descripcion = "PatchCord Cat5e "+data.pies+" pie(s) color "+data.color
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


Categoria5e()