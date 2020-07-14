<!-- --------------------------------------------- Datos de envió ----------------------------------------- -->

<h4 class="text-center text-md-left">Datos de envió</h4>
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
 ?>
<span class="text-primary float-right mb-3 cursor-point" onclick="mostrarFormDatosEnvio()"><i class="icon-plus-circle"></i>&nbsp;Nuevo</span>
 <div class="table-responsive shopping-cart">
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
        if (!class_exists('PedidoController')) {
          include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
        }
        if(isset($_SESSION["Ecommerce-PedidoKey"])){
          $PedidoController = new PedidoController;
          $PedidoController->filter = "WHERE id = ".$_SESSION["Ecommerce-PedidoKey"]." ";
          $PedidoController->order = "";
          # obtención de subtotal iva y total del pedido actual
          $Pedido = $PedidoController->getBy();
          $pedidoDatosEnvio = $Pedido->GetDatosEnvioKey();          
        }
        
        $disabled = '';
        $table_td_color = '';
        foreach ($ResultDatosEnvioController->records as $key => $DatosEnvio): 
          $check = $key == 0 ? 'checked': '';
          foreach ($Estado->CountryWithCitys['Mexico'] as $col => $Ciudad) {
            if ($Ciudad['value'] == $DatosEnvio->Estado) {
              $EstadoDescripcion = $Ciudad['label'];
              break;
            }
          }
      ?>
      <tr class="<?php echo $table_td_color;?>">
        <td>
          <div class="custom-control custom-radio">
            <input class="custom-control-input datosEnvio" type="radio" id="radio-<?php echo $DatosEnvio->DatosEnvioKey;?>" name="radioDatosEnvio" value="<?php echo $DatosEnvio->DatosEnvioKey;?>" <?php echo $check ?> <?php echo $disabled ?>>
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

<!-- --------------------------------------------- Datos de Facturación ----------------------------------------- -->

<h4 class="text-center text-md-left">Datos de Facturación</h4>
<hr class="padding-bottom-1x">

  <span class="text-primary float-right mb-3 cursor-point" onclick="mostrarFormDatosFacturacion()"><i class="icon-plus-circle"></i>&nbsp;Nuevo</span>

<?php 
  if (!class_exists("CFDIUserController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/CFDIUser.Controller.php';
  }
  $CFDIUserController = new CFDIUserController();
  $ResultCFDIUserController = $CFDIUserController->get();
  if($_SESSION['Ecommerce-ClienteTipo'] == 'B2C'){
 ?>
    <div class="row mt-2 mb-3">
      <div class="col-12 col-md-6">
        <div class="custom-control custom-checkbox">
          <input class="custom-control-input" type="checkbox" id="RequiereFactura" name="RequiereFactura" onchange="showCFDIUser(this)">
          <label class="custom-control-label" for="RequiereFactura">Requiere Factura</label>
        </div>
      </div>
      <div class="col-12 col-md-6 float-right" id="CFDIUserB2C" style="display: none;">
        <label class="text-center text-md-left">Uso de CFDI</label>
        <select class="form-control form-control-sm" id="CFDIUser" name="CFDIUser">
          <?php foreach ($ResultCFDIUserController->records as $key => $CFDIUser): ?>
          <option value="<?php echo $CFDIUser->Clave ?>"><?php echo $CFDIUser->Descripcion ?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <?php }else{ ?>
    <div class="row mt-2 mb-3">
      <div class="col-12 offset-md-6 col-md-6 float-right">
        <label class="text-center text-md-left">Uso de CFDI</label>
        <select class="form-control form-control-sm" id="CFDIUser" name="CFDIUser">
          <?php foreach ($ResultCFDIUserController->records as $key => $CFDIUser): ?>
          <option value="<?php echo $CFDIUser->Clave ?>"><?php echo $CFDIUser->Descripcion ?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>
    <?php } ?>
<?php 
  if (!class_exists("DatosFacturacionController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Cuenta/B2C/DatosFacturacion.Controller.php';
  }

  $DatosFacturacionController = new DatosFacturacionController();
  $DatosFacturacionController->filter = "WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." ";
  $DatosFacturacionController->order = "";
  $ResultDatosFacturacionController = $DatosFacturacionController->get();  
 ?>

 <div class="table-responsive shopping-cart">
  <table class="table" id="tableDatosFacturación">
    <thead>
      <tr>
        <th></th>
        <th>Razón social</th>
        <th class="text-center">Código Postal</th>
        <th class="text-center">RFC</th>
        <th class="text-center">Tipo de facturación</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($ResultDatosFacturacionController->records as $key => $DatosFacturacion): 
          foreach ($Estado->CountryWithCitys['Mexico'] as $col => $Ciudad) {
            if ($Ciudad['value'] == $DatosFacturacion->Estado) {
              $EstadoDescripcion = $Ciudad['label'];
              break;
            }
          }
          $check = $key == 0 ? 'checked': '';
      ?>
      <tr>
        <td>
          <div class="custom-control custom-radio">
            <input class="custom-control-input datosFacturacion" type="radio" id="radio-<?php echo $DatosFacturacion->DatosFacturacionKey;?>" name="radioDatosFacturacion" value="<?php echo $DatosFacturacion->DatosFacturacionKey;?>" <?php echo $check ?>>
            <label class="custom-control-label" for="radio-<?php echo $DatosFacturacion->DatosFacturacionKey;?>"></label>
          </div>
        </td>
        <td>
          <span class="text-gray-dark" id="datosFacturacion-razonSocial-<?php echo $DatosFacturacion->DatosFacturacionKey;?>"> <?php echo $DatosFacturacion->RazonSocial;?></span><br>
          <span class="text-muted text-sm" id="datosFacturacion-direccion-<?php echo $DatosFacturacion->DatosFacturacionKey;?>"> 
            <?php echo $DatosEnvio->Calle." No Ext. ".$DatosEnvio->NumeroExterior. " Col. ".$DatosEnvio->Colonia;?>
          </span>
          <span class="text-muted text-sm" id="datosFacturacion-estado-<?php echo $DatosFacturacion->DatosFacturacionKey;?>"> 
            <?php echo $DatosFacturacion->Ciudad.", ".$EstadoDescripcion;?>
          </span>
        </td>
        <td class="text-center" id="datosFacturacion-codigoPostal-<?php echo $DatosFacturacion->DatosFacturacionKey;?>"> <?php echo $DatosFacturacion->CodigoPostal ?> </td>
        <td class="text-center" id="datosFacturacion-RFC-<?php echo $DatosFacturacion->DatosFacturacionKey;?>"> <?php echo $DatosFacturacion->RFC; ?> </td>
        <td class="text-center" id="datosFacturacion-tipoFacturacion-<?php echo $DatosFacturacion->DatosFacturacionKey;?>"> <?php echo $DatosFacturacion->Tipo ?> </td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>

 <div class="d-flex justify-content-between paddin-top-1x mt-4">
  <a class="btn btn-outline-secondary" href="../Carrito/" >
    <i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Regresar carrito</span>
  </a>
  <a class="btn btn-primary" number="2" onclick="addViewCheckout(this)">
    <span class="hidden-xs-down">Referencias paquetería&nbsp;</span><i class="icon-arrow-right"></i>
  </a>
</div>    

<?php 
  unset($Estado);
  unset($DatosEnvioController);
  unset($ResultDatosEnvioController);
  unset($DatosFacturacionController);
  unset($ResultDatosFacturacionController);
 ?>