/**
 * información para mostralo en la vista resumen checkout
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var datosViewResumenCheckoutPedido = function () {
  let lineaCredito = false;
  let metodoPago = "";
  let monedaPago = getChecked(".monedaPago");
  let requiereFactura = document.getElementById("RequiereFactura");
  let checkDatosEnvio = getChecked(".datosEnvio");
  let checkDatosFacturacion = getChecked(".datosFacturacion");
  let Paqueteria = document.getElementById("paqueteria");
  let pagoBanco = document.getElementById("pagoBanco");

  if (document.getElementById("lineaCredito")) {
    lineaCredito = document.getElementById("lineaCredito").checked;
  }

  ajax_(
    "../../views/Checkout/Resumen.php",
    "POST",
    "HTML",
    {
      Credito: lineaCredito,
      monedaPago: monedaPago,
      requiereFactura: requiereFactura.checked,
      Banco: pagoBanco.checked,
    },
    function (response) {
      document.getElementById("PartialCheckout-4").innerHTML = response;

      if (lineaCredito) {
        metodoPago = '<span class="text-muted">Pago a crédito </span>';
      } else if (pagoBanco.checked) {
        metodoPago = '<span class="text-muted">Pago Banco<span></span>';
      } else {
        let numeroTarjeta = CleanSpaces(
          document.getElementById("number").value
        );
        let ultimosDigitosTarjeta = numeroTarjeta.substr(-4);
        metodoPago =
          '<span class="text-muted">Tarjeta: </span>**** **** **** ' +
          ultimosDigitosTarjeta +
          "<span></span>";
      }

      document.getElementById("resumen-datosEnvio-direccion").innerHTML =
        document.getElementById(
          "datosEnvio-direccion-" + checkDatosEnvio
        ).innerHTML;
      document.getElementById("resumen-datosEnvio-telefono").innerHTML =
        document.getElementById(
          "datosEnvio-telefono-" + checkDatosEnvio
        ).innerHTML;

      document.getElementById("resumen-paqueteria").innerHTML =
        Paqueteria.value;

      if (requiereFactura.checked) {
        document.getElementById(
          "resumen-datosFacturacion-direccion"
        ).innerHTML = document.getElementById(
          "datosFacturacion-direccion-" + checkDatosFacturacion
        ).innerHTML;
        document.getElementById("resumen-datosFacturacion-RFC").innerHTML =
          document.getElementById(
            "datosFacturacion-RFC-" + checkDatosFacturacion
          ).innerHTML;
      }

      document.getElementById("resumen-metodo-pago").innerHTML = metodoPago;
      document.getElementById("resumen-moneda-pago").innerHTML = monedaPago;

      // popover()
    }
  );
};

// var popover = function(){
//   $('#example-popover').on('mouseenter', function() {
//       var myPopOverContent = 'Generar codigo de verificación, <button class="btn btn-sm btn-info" type="button"> ooo </button>';
//       $(this).data('container', 'body');
//       $(this).data('html', true);
//       $(this).data('toggle', 'popover');
//       $(this).data('placement', 'top');
//       $(this).data('content', myPopOverContent);
//       $(this).popover('show');
//   });
// }
/**
 * Incluir vista de acuerdo al proceso pedido checkout
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var addViewCheckout = function (Elem) {
  let number = Elem.getAttribute("number");

  if (!(number == 1)) {
    if ($(".datosEnvio").length == 0) {
      toastAlert(
        "danger",
        "",
        "Por favor seleccione la direccion de envio",
        "topRight",
        "icon-ban"
      );
      return false;
    }
    if ($(".datosEnvioNombre")[0]) {
      if ($(".datosEnvioNombre")[0].value == "") {
        toastAlert(
          "danger",
          "",
          "Por favor ingresa el nombre de contacto",
          "topRight",
          "icon-ban"
        );
        return false;
      }
    }
    /* if ($(".datosEnvioTelefono")[0]) {
      if ($(".datosEnvioTelefono")[0].value == "") {
        toastAlert(
          "danger",
          "",
          "Por favor ingresa el telefono de contacto",
          "topRight",
          "icon-ban"
        );
        return false;
      }
    } */
    if ($(".datosEnvioCorreo")[0]) {
      if ($(".datosEnvioCorreo")[0].value == "") {
        toastAlert(
          "danger",
          "",
          "Por favor ingresa el correo de contacto",
          "topRight",
          "icon-ban"
        );
        return false;
      }
    }
    if (
      document.getElementById("RequiereFactura").checked &&
      $(".datosFacturacion").length == 0
    ) {
      toastAlert(
        "danger",
        "",
        "Por favor ingresa los datos de facturación",
        "topRight",
        "icon-ban"
      );
      return false;
    }
  }

  if (!$('[name="radioDatosEnvio"]').is(":checked")) {
    toastAlert(
      "danger",
      "",
      "algún dato se encuentra incorrecto, favor de verificar sus en datos en Mi cuenta o bien con su ejecutivo",
      "topRight",
      "icon-ban"
    );
    return false;
  }

  $(".step-title").removeClass("completado").find("i:first").remove();
  $(".process").removeClass("active");
  document.getElementById("process-" + number).classList.add("active");

  $(".process").each(function (index, el) {
    if (el.getAttribute("number") < number) {
      $(el).children("h4").addClass("completado");
    }
  });

  $(".completado").prepend('<i class="icon-check-circle"></i>');
  $(".PartialCheckout").css("display", "none");
  document.getElementById("PartialCheckout-" + number).style.display = "block";
  if(number == 3){
    datosViewResumenCheckoutPedido();
    validateCreditAvailable();
  }

  if (number == 4) {
    datosViewResumenCheckoutPedido();
  }

};
/**
 * mostrar CFDIUser escenario B2C
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
document.getElementById("CFDIUser").value = "P01";
var showCFDIUser = function (Elem) {
  if (Elem.checked) {
    document.getElementById("CFDIUserB2C").style.display = "block";
    // document.getElementById('alert-datos-facturacion-b2c-requiere-factura').style.display = "block"
  } else {
    document.getElementById("CFDIUser").value = "P01";
    document.getElementById("CFDIUserB2C").style.display = "none";
    // document.getElementById('alert-datos-facturacion-b2c-requiere-factura').style.display = "none"
  }
};
/**
 * mostrar CFDIUser escenario B2C
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
var facturacionBb2MXP = function (Elem) {
  // metodo pago por linea de credito solo si es cliente B2B
  if (Elem.getAttribute("cliente") == "B2B") {
    if (Elem.value == "MXP") {
      if(document.getElementById("credito-cliente-b2b"))
        document.getElementById("credito-cliente-b2b").style.display = "none";
      if(document.getElementById("lineaCredito"))
        document.getElementById("lineaCredito").checked = false;
   
    } else {
      validateCreditAvailable(Elem)
      if(document.getElementById("credito-cliente-b2b"))
        document.getElementById("credito-cliente-b2b").style.display = "block";
    }
  }
  // metodo pago por banco
  if (Elem.value == "MXP") {
    document.getElementById("metodo-pago-banco").style.display = "block";
  } else {
    document.getElementById("metodo-pago-banco").style.display = "none";
    document.getElementById("pagoBanco").checked = false;
  }
};
/**
 * mostrar valida el credito disponible
 *
 * @param {Object} opt - Foo
 *
 * @return {number} b - Bar
 */
 var validateCreditAvailable = function () {

  let monedaPago = getChecked(".monedaPago");

  ajax_(
    "../../views/Checkout/Credito.php",
    "POST",
    "HTML",
    {
      monedaPago: monedaPago,
    },
    function (response) {
      document.getElementById("CreditValid").innerHTML = response;

    }
  );
};
