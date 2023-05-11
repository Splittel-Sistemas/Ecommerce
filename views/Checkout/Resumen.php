<div class="col-md-12">
  <div class="alert alert-warning alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span>
    <strong>Solo se envian pedidos completos</strong>
    <br>
    <p>
      Si tienes alguna duda, contáctanos: 800 134 26 90
    </p>
  </div>
</div>

<h4 class="padding-bottom-1x text-center text-md-left">Revisa tu orden</h4>

<div class="row mt-3 mb-3">
  <div class="col-12 col-sm-3">
    <?php
    @session_start();
    if (isset($_SESSION['Ecommerce-ClienteTipo']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2C') :
    ?>
      <label>Nombre del pedido</label>
    <?php else : ?>
      <label>Número de referencia del cliente</label>
    <?php endif ?>
    <input class="form-control" type="text" name="referencia-pedido-resumen" id="referencia-pedido-resumen">
  </div>
</div>

<?php if ($_POST["monedaPago"] == "USD") : ?>
  <?php include 'Resumen/Dolares.php'; ?>
<?php else : ?>
  <?php include 'Resumen/PesosMexicanos.php'; ?>
<?php endif ?>

<div class="row padding-top-1x mt-3">
  <div class="col-12 col-sm-3">
    <h5>Datos de envió:</h5>
    <ul class="list-unstyled">
      <li><span class="text-muted">Cliente: </span><?php echo $_SESSION['Ecommerce-ClienteNombre'] ?></li>
      <li><span class="text-muted">Dirección: </span> <span id="resumen-datosEnvio-direccion"></span></li>
      <li><span class="text-muted">Teléfono: </span> <span id="resumen-datosEnvio-telefono"></span></li>
        <br>
      <?php 	if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2B') { ?>
      <li><h5>Datos de Contacto:</h5></li>
      <li><span class="text-muted">Contacto: </span> <span id="resumen-datosEnvio-nombre"></span></li>
      <li><span class="text-muted">Correo: </span> <span id="resumen-datosEnvio-correo"></span></li>
      <li><span class="text-muted">Teléfono: </span> <span id="resumen-datosEnvio-telefono2"></span></li>
      <?php } ?>

    </ul>
  </div>
  <?php if ($_POST['requiereFactura'] == 'true') { ?>
    <div class="col-12 col-sm-3">
      <h5>Datos de Facturación:</h5>
      <ul class="list-unstyled">
        <li><span class="text-muted">Cliente: </span><?php echo $_SESSION['Ecommerce-ClienteNombre'] ?></li>
        <li><span class="text-muted">Dirección: </span> <span id="resumen-datosFacturacion-direccion"></span></li>
        <li><span class="text-muted">RFC: </span> <span id="resumen-datosFacturacion-RFC"></span></li>
      </ul>
    </div>
  <?php } ?>
  <div class="col-12 col-sm-3">
    <h5>Paquetería:</h5>
    <ul class="list-unstyled">
      <li id="resumen-paqueteria"></li>
    </ul>
  </div>
  <div class="col-12 col-sm-3">
    <h5>Método de pago:</h5>
    <ul class="list-unstyled">
      <li id="resumen-metodo-pago"></li>
    </ul>
    <h5>Moneda de pago:</h5>
    <ul class="list-unstyled">
      <li><span id="resumen-moneda-pago"></span></li>
    </ul>
  </div>
</div>
<div class="d-flex justify-content-between paddin-top-1x mt-4">
  <a class="btn btn-outline-secondary" number="3" onclick="addViewCheckout(this)">
    <i class="icon-arrow-left"></i><span class="hidden-xs-down">Pago&nbsp;</span>
  </a>
  <?php if ($_POST['Credito'] == 'true') { ?>
    <a class="btn btn-primary" onclick="PagarPedidoCredito(this)">
      <span class="hidden-xs-down">Pagar&nbsp;</span><i class="icon-arrow-right"></i>
    </a>
  <?php } else if ($_POST['Banco'] == 'true') { ?>
    <a class="btn btn-primary" onclick="PagarPedidoBanco(this)">
      <span class="hidden-xs-down">Pagar&nbsp;</span><i class="icon-arrow-right"></i>
    </a>
  <?php } else { ?>
    <a class="btn btn-primary" id="Pago" onclick="PagarPedido3DSecure(this);">
      <span class="hidden-xs-down">Pagar&nbsp;</span><i class="icon-arrow-right"></i>
    </a>
  <?php }

  unset($Tool);
  unset($DetalleController);
  unset($ResultDetalleController);

  ?>
</div>