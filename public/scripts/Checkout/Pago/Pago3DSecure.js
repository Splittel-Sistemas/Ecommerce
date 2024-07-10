OpenPay.setId(OpenPayConfig.setId);
OpenPay.setApiKey(OpenPayConfig.setApiKey);
OpenPay.setSandboxMode(OpenPayConfig.setSandboxMode);

var Success = function (response) {
  let tokenId = response.data.id;
  let deviceSessionId = OpenPay.deviceData.setup();
  let monedaPago = getChecked(".monedaPago");
  let metodoPago = "tarjeta";
  let paqueteria = document.getElementById("paqueteria");
  let check = document.getElementById('check')
  let transportationCodeAux = transportationCode
  let referencia = document.getElementById("referencia-pedido-resumen");
  let cfdiUser = document.getElementById("CFDIUser");
  let regimenfiscalAux = document.getElementById("RegimenFiscal");
  let requiereFactura = document.getElementById("RequiereFactura");
  let checkDatosEnvio = getChecked(".datosEnvio");
  let checkDatosFacturacion = getChecked(".datosFacturacion");
  checkDatosFacturacion = requiereFactura.checked ? checkDatosFacturacion : "";
  let regimenfiscal =requiereFactura.checked ? regimenfiscalAux.value : ""
  let data = {
    Action: "Pago3DSecure",
    ActionOpenPay: true,
    datosEnvio: checkDatosEnvio,
    datosFacturacion: checkDatosFacturacion,
    paqueteria: check.value + paqueteria.value,
    transportationCode: transportationCodeAux,
    monedaPago: monedaPago,
    metodoPago: metodoPago,
    tokenId: tokenId,
    deviceSessionId: deviceSessionId,
    CFDIUser: cfdiUser.value,
    referencia: referencia.value,
    RegimenFiscal: regimenfiscal,
  };

  // información pedido B2B

  if (document.getElementById("datosEnvio-correo-" + checkDatosEnvio)) {
    let contactoNombre = document.getElementById(
      "datosEnvio-nombre-" + checkDatosEnvio
    );
    let contactoTelefono = document.getElementById(
      "datosEnvio-telefono-" + checkDatosEnvio
    );
    let contactoCorreo = document.getElementById(
      "datosEnvio-correo-" + checkDatosEnvio
    );

    data["ContactoNombre"] = contactoNombre.value;
    data["ContactoTelefono"] = contactoTelefono.value;
    data["ContactoCorreo"] = contactoCorreo.value;
  } else {
    data["RequiereFactura"] = requiereFactura.checked;
  }

  ajax_(
    "../../models/OpenPay/OpenPay.Route.php",
    "POST",
    "JSON",
    data,
    function (response) {
      console.log(response);
      console.log(response.message);
      $('#Pago').show();

      if (response.error != true) {
        document.getElementById("modal-body-3d-secure").innerHTML = '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="'+response.openpay.url+'" allowfullscreen></iframe></div>'
        GlobalOpenModal("modal-3d-secure");
      } else {
          let msgs="";
        if(parseInt(response.message)>=1000 && parseInt(response.message)<=1005 ){
          msgs="Servicio no disponible";
        }else if(parseInt(response.message)==3001 || parseInt(response.message)==3004 || parseInt(response.message)==3005 || parseInt(response.message)==3007){
           msgs="La tarjeta fue rechazada";
        }else if(parseInt(response.message)>=3002){
           msgs="La tarjeta ha expirado";
        }else if(parseInt(response.message)>=3003){
           msgs="La tarjeta no tiene fondos suficientes";
        }else if(parseInt(response.message)>=3006){
           msgs="La operación no esta permitida para este cliente o esta transacción";
        }else if(parseInt(response.message)>=3008){
           msgs="La tarjeta no es soportada en transacciones en línea";
        }else if(parseInt(response.message)>=3009){
           msgs="La tarjeta fue reportada como perdida";
        }else if(parseInt(response.message)>=3010){
           msgs="El banco ha restringido la tarjeta";
        }else if(parseInt(response.message)>=3011){
           msgs="El banco ha solicitado que la tarjeta sea retenida. Contacte al banco.";
        }else if(parseInt(response.message)>=3012){
           msgs="Se requiere solicitar al banco autorización para realizar este pago";
        }else{
           msgs="La petición no pudo ser procesada";
        }

        Alerts(
          "AlertCart",
          "danger",
          //" Migramos a 3DS 2.0 para autenticar las ventas con tarjeta. Para evitar contracargos se rechazarán las tarjetas que no cumplan la migración. por verifique con su banco por favor"
           " ERROR:  " +msgs + ""
          );
      }
    }
  );
};

var Errorr = function (response) {
  console.log(response);
  let desc =
    response.data.description != undefined
      ? response.data.description
      : response.message;
  alert("ERROR [" + response.status + "] " + desc);
};

var PagarPedido3DSecure = function (Elem) {
  event.preventDefault();
  let CardNumber = CleanSpaces(document.getElementById("number").value);
  let HolderName = CleanSpaces(document.getElementById("name").value);
  let ExpirationMonth = CleanSpaces(document.getElementById("exp_month").value);
  let ExpirationYear = CleanSpaces(document.getElementById("exp_year").value);
  let Cvv2 = CleanSpaces(document.getElementById("cvc").value);
  $('#Pago').hide();
  if (OpenPay.card.validateCardNumber(CardNumber)) {
    if (OpenPay.card.validateCVC(Cvv2)) {
      if (OpenPay.card.validateExpiry(ExpirationMonth, ExpirationYear)) {
        if (document.getElementById("TotalValidacion").value <= 100000) {
          $(Elem).prop("disabled", true);
          OpenPay.token.create(
            {
              card_number: CardNumber,
              holder_name: HolderName,
              expiration_year: ExpirationYear,
              expiration_month: ExpirationMonth,
              cvv2: Cvv2,
            },
            Success,
            Errorr
          );
          
        } else {
          Alerts(
            "AlertCart",
            "warning",
            "Recuerda que no puedes superar los 100000 pesos"
          );
      $('#Pago').show();

        }
      } else {
        addViewCheckout(document.getElementById("process-3"));
        Alerts(
          "AlertPago",
          "warning",
          "¡<strong> Fecha de expiración </strong> no valida!"
        );
      $('#Pago').show();

      }
    } else {
      addViewCheckout(document.getElementById("process-3"));
      Alerts(
        "AlertPago",
        "warning",
        "¡El <strong> Código de seguridad </strong> no es valido!"
      );
      $('#Pago').show();

    }
  } else {
    addViewCheckout(document.getElementById("process-3"));
    Alerts(
      "AlertPago",
      "warning",
      "¡El <strong> número de tarjeta </strong> no es valida!"
    );
    $('#Pago').show();

  }
};

var Expiracion = function (Elem) {
  var str = Elem.value;
  var res = str.split("/");
  document.getElementById("exp_month").value = res[0];
  document.getElementById("exp_year").value = res[1];
};

$("#modal-3d-secure").on("hidden.bs.modal", function () {
  ajax_(
    "../../models/OpenPay/OpenPay.Route.php",
    "POST",
    "JSON",
    { Action: "ComprobarTransaccion3DSecure", ActionOpenPay: true },
    function (response) {
      if (response.completed) {
        window.parent.location.href = "../Cuenta/index.php?menu=4";
      } else {
        window.parent.location.href = "../Home/index.php";
      }
    }
  );
});
