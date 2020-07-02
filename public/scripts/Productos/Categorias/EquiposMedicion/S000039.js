// Bobina de lanzamiento

var Marca = "OP"
var Familia = "HES"

var Bobina = function(){
  let LongitudFibra = document.getElementById('LongitudFibra')
  let Conectarizacion_1 = document.getElementById('Conectarizacion_1')
  let Conectarizacion_2 = document.getElementById('Conectarizacion_2')
  let Diametro = document.getElementById('Diametro')
  if (Conectarizacion_1.value == 'SCU') {
	  StyleDisplayNoneOrBlock_2(Conectarizacion_2, "none", [0,1])
	  StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [2,3,4])
  }else if(Conectarizacion_1.value == 'SCA'){
	  StyleDisplayNoneOrBlock_2(Conectarizacion_2, "none", [0])
	  StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [1,2,3,4])
  }else if(Conectarizacion_1.value == 'FCU'){
	  StyleDisplayNoneOrBlock_2(Conectarizacion_2, "none", [0,1,2,4])
	  StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [3])
	  Conectarizacion_2[3].selected = true
  }else if(Conectarizacion_1.value == 'FCA'){
	  StyleDisplayNoneOrBlock_2(Conectarizacion_2, "none", [0,1,2])
	  StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [3,4])
  }else{
		StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [0,1,2,3,4])
  }
  
    CodigoGenerado = Marca+Familia+LongitudFibra.value+Conectarizacion_1.value+Conectarizacion_2.value+Diametro.value
	ListImgProductoOnly('OPHES29',Conectarizacion_1.value+Conectarizacion_2.value)
    ListProductoDescription('OPHES29')
    ListProductoAdicional('OPHES29')
    showClave(CodigoGenerado)
    existEcommerce_(CodigoGenerado)

}

var BobinaLanzamiento = function() {
  switch(Cable.value){
    case 'BO-L' : 
      Bobina()
    break;
    default:
      templateAlert("danger", "", "No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo", "topRight", "icon-slash")
      console.log("No se encontro la opción solitada por favor pide ayuda, a tú ejecutivo")
  }
}

BobinaLanzamiento()