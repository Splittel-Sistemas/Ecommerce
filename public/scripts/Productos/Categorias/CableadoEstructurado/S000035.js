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
      verificarCosto(Longitud.value,Categoria)
    }else{
      verificarCosto('','')
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
    patchCordNombreCodigoConfigurable({ pies: Longitud.value, color: ColorText, codigo: CodigoGenerado })
}

var verificarCosto = function(PatchLongitud, PatchCategoria){
  if(PatchLongitud!='' && PatchCategoria!=''){
  document.getElementById('CostoProducto').value = "" 
  document.getElementById('Costo').innerHTML = "" 
  ajax_(
  '../../models/Productos/Precios/PatchCord.php', 
  'post', 
  'json', 
  { 
    Action: 'calculo',
    ActionPatchs: true,
    PatchLongitud: PatchLongitud,
    PatchCategoria: PatchCategoria
  }, 
  function(response){
    document.getElementById('CostoProducto').value = "" 
    document.getElementById('Costo').innerHTML = "" 
    document.getElementById('CostoProducto').value = response.records 
    document.getElementById('Costo').innerHTML = "$"+response.records.toFixed(3)   
  })
}else{
  document.getElementById('CostoProducto').value = "" 
      document.getElementById('Costo').innerHTML = "" 
}
}

var patchCordNombreCodigoConfigurable = function(data){
  if(document.getElementById('CodeConfigurable')){
    let descripcion = "PatchCord Cat6 "+data.pies+" pie(s) color "+data.color
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

Categoria6()