<!-- Alert-->
<div id="alert-list-datosEnvio"></div>

<span class="text-primary float-right mb-3 cursor-point" onclick="mostrarFormDatosEnvio()"><i class="icon-plus-circle"></i>&nbsp;Nuevo</span>

<div class="table-responsive table-hover mb-0">
  <table class="table cell-border" id="table-datosEnvio">
    <thead>
      <tr>
        <th>#</th>
        <th>Persona de contacto</th>
        <th class="text-center">Estado</th>
        <th>Calle</th>
        <th class="text-center">Celular</th>
        <!-- <th class="text-center">Editar</th> -->
      </tr>
    </thead>
    <tbody>
      <?php 
        if (!class_exists('DatosEnvioController')) {
          include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cuenta/B2C/DatosEnvio.Controller.php';
        }if (!class_exists('Estados')) {
          include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Estados.php';
        } 

        $Estado = new Estados();

        $DatosEnvioController = new DatosEnvioController();
        $DatosEnvioController->filter = "WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." ";
        $DatosEnvioController->orderBy = "";
        $ResultDatosEnvioController = $DatosEnvioController->get();

        foreach ($ResultDatosEnvioController->records as $key => $DatosEnvio) {
          foreach ($Estado->CountryWithCitys['Mexico'] as $col => $Ciudad) {
            if ($Ciudad['value'] == $DatosEnvio->Estado) {
              $EstadoDescripcion = $Ciudad['label'];
              break;
            }
          }
       ?>
      <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $DatosEnvio->Nombre.' '.$DatosEnvio->Apellido ?></td>
        <td class="text-center"><?php echo $EstadoDescripcion ?></td>
        <td><?php echo $DatosEnvio->Calle ?></td>
        <td class="text-center"><?php echo $DatosEnvio->Celular ?></td>
        <!-- <td class="text-center">
          <span class="text-warning cursor-point" DatosEnvioKey="<?php #echo $DatosEnvio->DatosEnvioKey ?>" onclick="EditarFormDatosEnvio(this)"><i class="icon-edit"></i></span>
        </td> -->
      </tr>
     <?php } ?>
    </tbody>
  </table>
</div>