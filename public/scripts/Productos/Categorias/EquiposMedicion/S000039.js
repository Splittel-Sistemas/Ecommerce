// Bobina de lanzamiento

var Marca = "OP"
var Familia = "HES"

var Bobina = function(){
  let LongitudFibra = document.getElementById('LongitudFibra')
  let Conectarizacion_1 = document.getElementById('Conectarizacion_1')
  let Conectarizacion_2 = document.getElementById('Conectarizacion_2')
  let Diametro = document.getElementById('Diametro')
  let TipoFibra = document.getElementById('TipoFibra')

  if(TipoFibra.value=='29'){

    StyleDisplayNoneOrBlock_2(LongitudFibra, "none", [0])
	  StyleDisplayNoneOrBlock_2(LongitudFibra, "block", [1,2])

    StyleDisplayNoneOrBlock_2(Conectarizacion_1, "block", [0,1,2,3,4])
    StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [0,1,2,3,4])

    StyleDisplayNoneOrBlock_2(Conectarizacion_1, "none", [5,6,7])
    StyleDisplayNoneOrBlock_2(Conectarizacion_2, "none", [5,6,7])
    if(Conectarizacion_1.selectedIndex == 5 || Conectarizacion_1.selectedIndex == 6 || Conectarizacion_1.selectedIndex == 7 )
      {
        Conectarizacion_1[0].selected = true;
      }
      if(Conectarizacion_2.selectedIndex == 5 || Conectarizacion_2.selectedIndex == 6 || Conectarizacion_2.selectedIndex == 7 )
        {
          Conectarizacion_2[0].selected = true;
        }
    if(LongitudFibra.selectedIndex == 0 )
      {
        LongitudFibra[1].selected = true;
      }
      if (Conectarizacion_1.value == 'SCU') {
        StyleDisplayNoneOrBlock_2(Conectarizacion_2, "none", [0,1])
        StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [2,3,4])
        if(Conectarizacion_2.selectedIndex != 2 && Conectarizacion_2.selectedIndex != 3 && Conectarizacion_2.selectedIndex != 4 )
          {
            Conectarizacion_2[2].selected = true;
          }
      }else if(Conectarizacion_1.value == 'SCA'){
        StyleDisplayNoneOrBlock_2(Conectarizacion_2, "none", [0])
        StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [1,2,3,4])
        if(Conectarizacion_2.selectedIndex == 0  )
          {
            Conectarizacion_2[1].selected = true;
          }
      }else if(Conectarizacion_1.value == 'FCU'){
        StyleDisplayNoneOrBlock_2(Conectarizacion_2, "none", [0,1,2,4])
        StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [3])
        Conectarizacion_2[3].selected = true
      }else if(Conectarizacion_1.value == 'FCA'){
        StyleDisplayNoneOrBlock_2(Conectarizacion_2, "none", [0,1,2])
        StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [3,4])
        if(Conectarizacion_2.selectedIndex != 3 &&   Conectarizacion_2.selectedIndex != 4)
          {
            Conectarizacion_2[3].selected = true;
          }
      }else{
        StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [0,1,2,3,4])
        
      }
  }else{
    StyleDisplayNoneOrBlock_2(LongitudFibra, "none", [1,2])
	  StyleDisplayNoneOrBlock_2(LongitudFibra, "block", [0])

    StyleDisplayNoneOrBlock_2(Conectarizacion_1, "none", [0,1,2,3,4])
    StyleDisplayNoneOrBlock_2(Conectarizacion_2, "none", [0,1,2,3,4])
    StyleDisplayNoneOrBlock_2(Conectarizacion_1, "block", [5,6,7])
    if(LongitudFibra.selectedIndex != 0)
      {
        LongitudFibra[0].selected = true;
      }
    if(Conectarizacion_1.selectedIndex != 5 && Conectarizacion_1.selectedIndex != 6 && Conectarizacion_1.selectedIndex != 7)
      {
        Conectarizacion_1[5].selected = true;
      }
    if (Conectarizacion_1.value == 'LCP') {

      if(Conectarizacion_2.selectedIndex != 5 && Conectarizacion_2.selectedIndex != 6 && Conectarizacion_2.selectedIndex != 7)
        {
          Conectarizacion_2[5].selected = true;
        }
        StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [5,6,7])
    }else if(Conectarizacion_1.value == 'SCP'){
      StyleDisplayNoneOrBlock_2(Conectarizacion_2, "none", [5])
      StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [6,7])
      if(Conectarizacion_2.selectedIndex != 6 && Conectarizacion_2.selectedIndex != 7)
        {
          Conectarizacion_2[6].selected = true;
        }
    }else if(Conectarizacion_1.value == 'FCP'){
      StyleDisplayNoneOrBlock_2(Conectarizacion_2, "none", [5,6])
      StyleDisplayNoneOrBlock_2(Conectarizacion_2, "block", [7])
      Conectarizacion_2[7].selected = true
    }
  }

  

 
  
    CodigoGenerado = Marca+Familia+TipoFibra.value+LongitudFibra.value+Conectarizacion_1.value+Conectarizacion_2.value+Diametro.value
	ListImgProductoOnly('OPHES',TipoFibra.value+Conectarizacion_1.value+Conectarizacion_2.value)
    ListProductoDescription('OPHES'+TipoFibra.value)
    ListProductoAdicional('OPHES'+TipoFibra.value)
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