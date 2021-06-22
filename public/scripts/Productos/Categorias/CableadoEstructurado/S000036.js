// Categoria 6A

var Marca = "OP"
var Familia = "CA"
var Estructurados = "PCC6A"
var Categoria="CAT6A"
var DirectorioImgProducto = Marca+Familia+Estructurados
var DescPrdConf = document.getElementById('DscProductoConfigurable')

var Categoria6AUTP1 = function(){
  var Estructurados = "PCC6AU"
  let Longitud = document.getElementById('Longitud')
  let Color = document.getElementById('Color')
  let LongitudIdText = document.getElementById('LongitudIdText')
  let UnidadMedida = "P" // Pies
  let CodigoGenerado = ""
  let LongitudMin = 1
  let LongitudMax = 210
 // StyleDisplayNoneOrBlock_2(Color, 'none', [1,2])
    LongitudIdText.innerHTML = 'Longitud (pies) '+LongitudMin+'~'+LongitudMax+':'

    if (Longitud.value >= LongitudMin && Longitud.value <= LongitudMax) {
      CodigoGenerado = Marca+Familia+Estructurados+NumeroConCeros2(Longitud.value, 2)+UnidadMedida+Color.value
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
    let DirectorioImgProducto = Marca+Familia+Estructurados
    let ImgProducto = DirectorioImgProducto+Color.value
    ListProductoDescription('OPCAPCC6AU')
    ListProductoAdicional('OPCAPCC6AU')
    ChangeListImgProducto(DirectorioImgProducto, ImgProducto)
    
    showClave(CodigoGenerado)
    existCodeSapPatchCord(CodigoGenerado)
    
    let x = Color.selectedIndex;
    let y = Color.options;
    let ColorText = y[x].text    

    let descripcion = "PatchCord Cat6A UTP "+Longitud.value+" pie(s) color "+ColorText
    //console.log(descripcion)
    NombreProductoConfigurable(CodigoGenerado, descripcion)
    DescPrdConf.innerHTML=descripcion
    agregarFichaTecnicaConfigurable(Marca+Familia+Estructurados)
    agregarCertificadoConfigurable(CodigoGenerado)
}


var Categoria6AUTP = function(){
  let Longitud = document.getElementById('Longitud_1')
  let Color = document.getElementById('Color')
  let UnidadMedida = "P" // Pies
  let CodigoGenerado = ""
    StyleDisplayNoneOrBlock_2(Color, "none", [1, 2])

      CodigoGenerado = Marca+Familia+Estructurados+Longitud.value+UnidadMedida+Color.value
    // Agregación de codigo para la vista en el identificador
    let ImgProducto = DirectorioImgProducto+Color.value
    let Url = Marca+Familia+"PCC6A"
    ListProductoDescription(Url)
    ListProductoAdicional(Url)
    ChangeListImgProducto(DirectorioImgProducto, ImgProducto)
    showClave(CodigoGenerado)
    existCodeSapPatchCord(CodigoGenerado)
}

var Categoria6ALED = function(){
  let Longitud = document.getElementById('Longitud_1')
  let LongitudInput = document.getElementById('LongitudInput')
  let Color = document.getElementById('Color')
  let Longitud_1IdText = document.getElementById('Longitud_1IdText')
  let UnidadMedida = "P" // Pies
  let Tipo = "SR" // Pies
  let CodigoGenerado = ""
    StyleDisplayNoneOrBlock(LongitudInput,'none')
    StyleDisplayNoneOrBlock_2(Color, "none", [1, 2, 3])
    Longitud[3].style.display = 'none'
    Longitud_1IdText.innerHTML = "Longitud"

    CodigoGenerado = Marca+Familia+Estructurados+Longitud.value+Color.value+Tipo
    // Agregación de codigo para la vista en el identificador
    let ImgProducto = Marca+Familia+"PCC6"+Color.value+Tipo
    let Url = Marca+Familia+"PCC6A"+Tipo
    ListProductoDescription(Url)
    ListProductoAdicional(Url)
    ChangeListImgProducto(DirectorioImgProducto+Tipo, ImgProducto)
    showClave(CodigoGenerado)
    existCodeSapPatchCord(CodigoGenerado)
}

var Categoria6AUTP34AWG = function(){
  let LongitudSelect = document.getElementById('LongitudSelect')
  let Longitud = document.getElementById('Longitud_1')
  let Color = document.getElementById('Color')
  let LongitudIdText = document.getElementById('LongitudIdText')
  let CodigoGenerado = ""
  let LongitudMin = 1
  let LongitudMax = 10
  let Otro = "FA"
    StyleDisplayNoneOrBlock(LongitudInput,'none')
    // StyleDisplayNoneOrBlock_2(Color, "none", [1, 2, 3])
    StyleDisplayNoneOrBlock_2(Color, "none", [1, 2])
    Longitud[3].style.display = 'none'

    Longitud_1IdText.innerHTML = "Longitud"
    
    CodigoGenerado = Marca+Familia+Estructurados+NumeroConCeros(Longitud.value, 4)+Color.value+Otro
    // Agregación de codigo para la vista en el identificador
    let ImgProducto = DirectorioImgProducto+Otro+Color.value
    let Url = Marca+Familia+"PCC6A"+Otro
    ListProductoDescription(Url)
    ListProductoAdicional(Url)
    ChangeListImgProducto(DirectorioImgProducto+Otro, ImgProducto)
    showClave(CodigoGenerado)
    existCodeSapPatchCord(CodigoGenerado)
}

var Categoria6ASTP32AWG = function(){
  let LongitudSelect = document.getElementById('LongitudSelect')
  let Longitud = document.getElementById('Longitud_1')
  let Color = document.getElementById('Color')
  let LongitudIdText = document.getElementById('LongitudIdText')
  let CodigoGenerado = ""
  let LongitudMin = 1
  let LongitudMax = 5
  let Otro = "FB"
   StyleDisplayNoneOrBlock(LongitudInput,'none')
    // StyleDisplayNoneOrBlock_2(Color, "none", [1, 2, 3])
    StyleDisplayNoneOrBlock_2(Color, "none", [1, 2])
    Longitud[3].style.display = 'none'

    Longitud_1IdText.innerHTML = "Longitud"

    CodigoGenerado = Marca+Familia+Estructurados+NumeroConCeros(Longitud.value, 4)+Color.value+Otro

    // Agregación de codigo para la vista en el identificador
    let ImgProducto = DirectorioImgProducto+Otro+Color.value
    let Url = Marca+Familia+"PCC6A"+Otro
    ListProductoDescription(Url)
    ListProductoAdicional(Url)
    ChangeListImgProducto(DirectorioImgProducto+Otro, ImgProducto)
    showClave(CodigoGenerado)
    existCodeSapPatchCord(CodigoGenerado)
}


var Categoria6AUTP28AWG = function(){
  let LongitudSelect = document.getElementById('LongitudSelect')
  let Longitud = document.getElementById('Longitud_1')
  let Color = document.getElementById('Color')
  let LongitudIdText = document.getElementById('LongitudIdText')
  let CodigoGenerado = ""
  let LongitudMin = 1
  let LongitudMax = 15
  let Otro = "SA"
    StyleDisplayNoneOrBlock(LongitudInput,'none')
    // StyleDisplayNoneOrBlock_2(Color, "none", [1, 2, 3])
    StyleDisplayNoneOrBlock_2(Color, "none", [1, 2])
    Longitud[3].style.display = 'none'

    Longitud_1IdText.innerHTML = "Longitud"

    CodigoGenerado = Marca+Familia+Estructurados+NumeroConCeros(Longitud.value, 4)+Color.value+Otro

    // Agregación de codigo para la vista en el identificador
    let ImgProducto = DirectorioImgProducto+Otro+Color.value
    let Url = Marca+Familia+"PCC6A"+Otro
    ListProductoDescription(Url)
    ListProductoAdicional(Url)
    ChangeListImgProducto(DirectorioImgProducto+Otro, ImgProducto)
    showClave(CodigoGenerado)
    existCodeSapPatchCord(CodigoGenerado)
}

var Categoria6AUTP30AWG = function(){
  let LongitudSelect = document.getElementById('LongitudSelect')
  let Longitud = document.getElementById('Longitud_1')
  let Color = document.getElementById('Color')
  let LongitudIdText = document.getElementById('LongitudIdText')
  let CodigoGenerado = ""
  let LongitudMin = 1
  let LongitudMax = 7
  let Otro = "SB"
    StyleDisplayNoneOrBlock(LongitudInput,'none')
    // StyleDisplayNoneOrBlock_2(Color, "none", [1, 2, 3])
    StyleDisplayNoneOrBlock_2(Color, "none", [1, 2])
    Longitud[3].style.display = 'none'

    Longitud_1IdText.innerHTML = "Longitud"

    CodigoGenerado = Marca+Familia+Estructurados+NumeroConCeros(Longitud.value, 4)+Color.value+Otro

    // Agregación de codigo para la vista en el identificador
    let ImgProducto = DirectorioImgProducto+Otro+Color.value
    let Url = Marca+Familia+"PCC6A"+Otro
    ListProductoDescription(Url)
    ListProductoAdicional(Url)
    ChangeListImgProducto(DirectorioImgProducto+Otro, ImgProducto)
    showClave(CodigoGenerado)
    existCodeSapPatchCord(CodigoGenerado)
}

var Categoria6AUTP32AWG = function(){
  let LongitudSelect = document.getElementById('LongitudSelect')
  let Longitud = document.getElementById('Longitud_1')
  let Color = document.getElementById('Color')
  let LongitudIdText = document.getElementById('LongitudIdText')
  let CodigoGenerado = ""
  let LongitudMin = 1
  let LongitudMax = 15
  let Otro = "SC"
    StyleDisplayNoneOrBlock(LongitudInput,'none')
    // StyleDisplayNoneOrBlock_2(Color, "none", [1, 2, 3])
    StyleDisplayNoneOrBlock_2(Color, "none", [1, 2])
    Longitud[3].style.display = 'none'

    Longitud_1IdText.innerHTML = "Longitud"

    CodigoGenerado = Marca+Familia+Estructurados+NumeroConCeros(Longitud.value, 4)+Color.value+Otro
    // Agregación de codigo para la vista en el identificador
    let ImgProducto = DirectorioImgProducto+Otro+Color.value
    let Url = Marca+Familia+"PCC6A"+Otro
    ListProductoDescription(Url)
    ListProductoAdicional(Url)
    ChangeListImgProducto(DirectorioImgProducto+Otro, ImgProducto)
    showClave(CodigoGenerado)
    existCodeSapPatchCord(CodigoGenerado)
}

var Categoria6AUTPARME = function(){
  let Longitud = document.getElementById('Longitud_1')
  let LongitudInput = document.getElementById('LongitudInput')
  let Color = document.getElementById('Color')
  let Tipo = "SD" // Pies
  let CodigoGenerado = ""
    StyleDisplayNoneOrBlock(LongitudInput,'none')
    StyleDisplayNoneOrBlock_2(Longitud, "none", [2, 3, 4])

    CodigoGenerado = Marca+Familia+Estructurados+NumeroConCeros(Longitud.value, 4)+Color.value+Tipo
    // Agregación de codigo para la vista en el identificador
    let ImgProducto = DirectorioImgProducto+Color.value+Tipo
      let Url = Marca+Familia+"PCC6A"+Tipo
    ListProductoDescription(Url)
    ListProductoAdicional(Url)
    ChangeListImgProducto(DirectorioImgProducto+Color.value+Tipo, ImgProducto)
    showClave(CodigoGenerado)
    existCodeSapPatchCord(CodigoGenerado)
}

var Categoria6A = function() {
  switch(Cable.value){
    case 'PCC6A-1' : 
      Categoria6AUTP()
    break;
    case 'PCC6A-2' : 
      Categoria6ALED()
    break; 
    case 'PCC6A-3' : 
      Categoria6AUTP34AWG()
    break; 
    case 'PCC6A-4' : 
      Categoria6ASTP32AWG()
    break; 
    case 'PCC6A-5' : 
      Categoria6AUTP28AWG()
    break; 
    case 'PCC6A-6' : 
      Categoria6AUTP30AWG()
    break; 
    case 'PCC6A-7' : 
      Categoria6AUTP32AWG()
    break; 
    case 'PCC6A-8' : 
      Categoria6AUTPARME()
    break; 
    case 'PCC6A-9' : 
      Categoria6AUTP1()
    break; 
    default:
      templateAlert("danger", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
      console.log("No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo")
  }
}

Categoria6A()
