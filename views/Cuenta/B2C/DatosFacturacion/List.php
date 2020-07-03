<!-- Alert-->
<div id="alert-list-datosFacturacion"></div>

<span class="text-primary float-right mb-3 cursor-point" onclick="mostrarFormDatosFacturacion()"><i class="icon-plus-circle"></i>&nbsp;Nuevo</span>

<div class="table-responsive table-hover mb-0">
  <table class="table cell-border" id="table-datosFacturacion">
    <thead>
      <tr>
        <th>#</th>
        <th>Razón social</th>
        <th class="text-center">Tipo</th>
        <th class="text-center">RFC</th>
        <th class="text-center">Editar</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        if (!class_exists('DatosFacturacionController')) {
          include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cuenta/B2C/DatosFacturacion.Controller.php';
        }

        $DatosFacturacionController = new DatosFacturacionController();
        $DatosFacturacionController->filter = "WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." ";
        $DatosFacturacionController->orderBy = "";
        $ResultDatosFacturacionController = $DatosFacturacionController->get();

        foreach ($ResultDatosFacturacionController->records as $key => $DatosFacturacion) {
       ?>
      <tr>
        <td><?php echo $key+1; ?></td>
        <td><?php echo $DatosFacturacion->RazonSocial ?></td>
        <td class="text-center"><?php echo $DatosFacturacion->Tipo ?></td>
        <td class="text-center"><?php echo $DatosFacturacion->RFC ?></td>
        <td class="text-center">
          <span class="text-warning cursor-point" DatosFacturacionKey="<?php echo $DatosFacturacion->DatosFacturacionKey ?>" onclick="editarFormDatosFacturacion(this)"><i class="icon-edit"></i></span>
        </td>
      </tr>
     <?php } ?>
    </tbody>
  </table>
</div>