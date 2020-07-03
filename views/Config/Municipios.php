<?php 
  if (!class_exists('Municipios')) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Municipios.php';
  }
  $Municipio = new Municipios();
  $Selected = "";

 foreach ($Municipio->Municipios[$_POST['CiudadKey']] as $key => $Municipio):   
  if (!empty($_POST['MunicipioDescripcion'])) {
    $Selected = $Municipio == $_POST['MunicipioDescripcion'] ? "selected" : "" ;
  }
?>
  <option value="<?php echo $Municipio ?>" <?php echo $Selected ?>> <?php echo $Municipio ?> </option>
<?php endforeach ?>

