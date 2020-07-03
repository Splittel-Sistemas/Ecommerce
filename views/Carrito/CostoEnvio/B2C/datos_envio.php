<!-- --------------------------------------------- Datos de envió ----------------------------------------- -->

<h4 class="text-center text-md-left">Seleccione Dirección de envió</h4>
<hr class="padding-bottom-1x">
<?php 
  if (!class_exists("DatosEnvioController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Cuenta/B2C/DatosEnvio.Controller.php';
  }if (!class_exists('Estados')) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Estados.php';
  } 

  $Estado = new Estados();
  
  $DatosEnvioController = new DatosEnvioController();
  $DatosEnvioController->filter = "WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." ";
  $DatosEnvioController->order = "";
  $ResultDatosEnvioController = $DatosEnvioController->get();
  if($ResultDatosEnvioController->count == 0){
 ?>
<span class="text-primary float-right mb-3 cursor-point"><i class="icon-plus-circle"></i>&nbsp;<a href="../Cuenta/index.php?menu=5"> Agregar Datos Envio </a></span>
<?php } ?>
 
 <div class="table-responsive">
  <table class="table" id="tableDatosEnvio">
    <thead>
      <tr>
        <th></th>
        <th>Dirección</th>
        <th class="text-center">Código Postal</th>
        <th class="text-center">Nombre</th>
        <th class="text-center">Teléfono</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($ResultDatosEnvioController->records as $key => $DatosEnvio): 
          foreach ($Estado->CountryWithCitys['Mexico'] as $col => $Ciudad) {
            if ($Ciudad['value'] == $DatosEnvio->Estado) {
              $EstadoDescripcion = $Ciudad['label'];
              break;
            }
          }
          $check = $key == 0 ? 'checked': '';
      ?>
      <tr>
        <td>
          <div class="custom-control custom-radio">
            <input class="custom-control-input datosEnvio" type="radio" id="radio-<?php echo $DatosEnvio->DatosEnvioKey;?>" name="radioDatosEnvio" value="<?php echo $DatosEnvio->DatosEnvioKey;?>" <?php echo $check ?>>
            <label class="custom-control-label" for="radio-<?php echo $DatosEnvio->DatosEnvioKey;?>"></label>
          </div>
        </td>
        <td>
          <span class="text-gray-dark"> <?php echo $DatosEnvio->Municipio.', '.$EstadoDescripcion;?></span><br>
          <span class="text-muted text-sm" id="datosEnvio-direccion-<?php echo $DatosEnvio->DatosEnvioKey;?>"> 
            <?php echo $DatosEnvio->Calle." No Ext. ".$DatosEnvio->NumeroExterior. " Col. ".$DatosEnvio->Colonia;?>
          </span>
        </td>
        <td class="text-center" id="datosEnvio-codigoPostal-<?php echo $DatosEnvio->DatosEnvioKey;?>"><?php echo $DatosEnvio->CodigoPostal ?></td>
        <td class="text-center" id="datosEnvio-nombre-<?php echo $DatosEnvio->DatosEnvioKey;?>"><?php echo $DatosEnvio->Nombre.' '.$DatosEnvio->Apellido ?></td>
        <td class="text-center" id="datosEnvio-telefono-<?php echo $DatosEnvio->DatosEnvioKey;?>"><?php echo $DatosEnvio->Telefono ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
<button type="button" class="btn btn-outline-primary" onclick="solicitar(this)">Solicitar</button>

<?php 
  unset($Estado);
  unset($DatosEnvioController);
  unset($ResultDatosEnvioController);
 ?>