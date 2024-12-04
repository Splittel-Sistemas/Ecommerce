<?php 
  if ($_GET['codigo'] == 'C28') {
    include 'C28_Interior_exterior.php';    
  }elseif ($_GET['codigo'] == 'C29') {
    include 'C29_Distribucion.php';
  }elseif ($_GET['codigo'] == 'C30') {
    include 'C30_exteriorArmadoDielectrico.php';
  }elseif ($_GET['codigo'] == 'C31') {
    include 'C31_ExteriorDielectrico.php';
  }elseif ($_GET['codigo'] == 'C32') {
    include 'C32_ExteriorArmado.php';
  }elseif ($_GET['codigo'] == 'C33') {
    include 'C33_mini_figura8.php';
  }elseif ($_GET['codigo'] == 'C34') {
    include 'C34_ExteriorFigura8Armadura.php';
  }elseif ($_GET['codigo'] == 'C35') {
    include 'C35_Fig8SinArmadura.php';
  }elseif ($_GET['codigo'] == 'C36') {
    include 'C36_ADSS.php';
  }elseif ($_GET['codigo'] == 'C37') {
    include 'C37_DropFiguraCero.php';
  }elseif ($_GET['codigo'] == 'C104') {
    include 'C104_FTTA.php';
  }
?>
