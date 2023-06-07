function validarArchivo(input) {
  const MAXIMO_TAMANIO_BYTES = 5000000; // 1MB = 1 millón de bytes
  var fileName = input.files[0].name;
  var fileNameWithoutExtension = fileName.split(".")[1];
  var fileExtension = fileName.split(".").pop();

  var allowedExtensions = /(jpg|jpeg|png|gif|pdf)$/i;
  if (!allowedExtensions.exec(fileNameWithoutExtension)) {
    templateAlert(
      "danger",
      "Error",
      "El nombre del archivo contiene caracteres no permitidos. Por favor, cambie de nombre al archivo",
      "topCenter",
      ""
    );
    input.value = "";
    input.classList.add("is-invalid");
  } else {
    const archivo = input.files[0];
    if (archivo.size > MAXIMO_TAMANIO_BYTES) {
      const tamanioEnMb = MAXIMO_TAMANIO_BYTES / 1000000;
      templateAlert(
        "danger",
        "",
        `El tamaño máximo es ${tamanioEnMb} MB`,
        "topCenter",
        ""
      );
      input.value = "";
      input.classList.add("is-invalid");
    } else {
      input.classList.add("is-valid");
    }
  }
}

var fileInputs = document.querySelectorAll("input[type='file']");
fileInputs.forEach(function (input) {
  input.addEventListener("change", function () {
    input.classList.remove("is-valid", "is-invalid");
    validarArchivo(input);
  });
});
var EnviarSolicitud = function () {
  $("#botonenviar").hide();
  var fda = new FormData();

  fda.append("NombreSolicitud", $("#NombreSolicitud").val());
  fda.append("Correo", $("#Correo").val());
  fda.append("RazonSocial", $("#RazonSocial").val());
  fda.append("DomicilioFiscal", $("#DomicilioFiscal").val());
  fda.append("Colonia", $("#Colonia").val());
  fda.append("Ciudad", $("#Ciudad").val());
  fda.append("Cp", $("#Cp").val());
  fda.append("Fax", $("#Fax").val());
  fda.append("Rfc", $("#Rfc").val());
  fda.append("FechaConstitucion", $("#FechaConstitucion").val());
  fda.append("Curp", $("#Curp").val());
  fda.append("Telefono", $("#Telefono").val());
  fda.append("Giro", $("#Giro").val());
  fda.append("FechaAlta", $("#FechaAlta").val());
  fda.append("JefeDepto", $("#JefeDepto").val());
  fda.append("Beneficiario", $("#Beneficiario").val());
  fda.append("FormaPago", $("#FormaPago").val());
  fda.append("Nombre1", $("#Nombre1").val());
  fda.append("Domicilio1", $("#Domicilio1").val());
  fda.append("Ciudad1", $("#Ciudad1").val());
  fda.append("Telefono1", $("#Telefono1").val());
  fda.append("Nombre2", $("#Nombre2").val());
  fda.append("Domicilio2", $("#Domicilio2").val());
  fda.append("Ciudad2", $("#Ciudad2").val());
  fda.append("Telefono2", $("#Telefono2").val());
  fda.append("Nombre3", $("#Nombre3").val());
  fda.append("Domicilio3", $("#Domicilio3").val());
  fda.append("Ciudad3", $("#Ciudad3").val());
  fda.append("Telefono3", $("#Telefono3").val());
  fda.append("MontoCredito", $("#MontoCredito").val());

  var checkRadio = document.querySelector('input[name="Plazo"]:checked');

  if (checkRadio.value != "otro") {
    fda.append("Plazo", checkRadio.value);
  } else {
    fda.append("Plazo", $("#Otro").val());
  }

  fda.append("Observaciones", $("#Observaciones").val());
  fda.append("Action", "create");
  fda.append("ActionSolicitud", true);
  var checkPERSONA = document.querySelector('input[name="PERSONA"]:checked');
  fda.append("PERSONA", checkPERSONA.value);

  if (checkPERSONA.value != "MORAL") {
    var file_data = "";
    fda.append("file", file_data);

    var file_data = "";
    fda.append("file2", file_data);
    fda.append("Nacionalidad", "");
    fda.append("LuNaci", "");
  } else {
    var file_data = $("#file").prop("files")[0];
    fda.append("file", file_data);

    var file_data = $("#file2").prop("files")[0];
    fda.append("file2", file_data);
    fda.append("Nacionalidad", $("#Nacionalidad").val());
    fda.append("LuNaci", $("#LuNaci").val());
  }

  var file_data = $("#file3").prop("files")[0];
  fda.append("file3", file_data);

  var file_data = $("#file4").prop("files")[0];
  fda.append("file4", file_data);
  var file_data = $("#file5").prop("files")[0];
  fda.append("file5", file_data);
  var file_data = $("#file6").prop("files")[0];
  fda.append("file6", file_data);
  var file_data = $("#file7").prop("files")[0];
  fda.append("file7", file_data);
  var file_data = $("#file8").prop("files")[0];
  fda.append("file8", file_data);
  var file_data = $("#file9").prop("files")[0];
  fda.append("file9", file_data);

  $.ajax({
    url: "../../models/Solicitud/Ficrece/Solicitud.Route.php",
    type: "post",
    data: fda,
    contentType: false,
    processData: false,
    dataType: "json",
    async: false,
    cache: false,
    success: function (response) {
      if (!response.error) {
        $("#botonenviar").show();

        templateAlert(
          "success",
          "Enviado",
          "La solicitud ha sido enviada",
          "center",
          ""
        );
        GlobalCloseModal("modal-ficrece");
        window.location.href = "Ficrece.php";
      } else {
        $("#botonenviar").show();

        templateAlert("danger", "", response.message, "topRight", "");
      }
    },
    error: function (xhr, status, error) {
      // Handle error cases
      console.error(xhr);
      console.error(status);
      console.error(error);
      templateAlert(
        "danger",
        "",
        "error al subir la solicitud contacte a su ejecutivo",
        "topRight",
        ""
      );
      $("#botonenviar").show();
    },
  });
};

var EnviarMensaje = function (Elem) {
  let Mensaje = document.getElementById(
    "Mensaje-" + Elem.getAttribute("preguntakey")
  );
  ajax_(
    "../../models/Solicitud/Ficrece/Mensaje.Route.php",
    "POST",
    "JSON",
    {
      Action: "create",
      ActionMensaje: true,
      Mensaje: Mensaje.value,
      PreguntaKey: Elem.getAttribute("preguntakey"),
    },
    function (response) {
      console.log(response);
      if (!response.error) {
        Mensaje.value = "";
        ListarMensajes(Elem.getAttribute("preguntakey"));
      }
    }
  );
};

// var Listar =  function(){
//     ajax_('../../views/Consultecnico/List.php', 'POST', 'HTML', {},
//     function(response){
//         document.getElementById('list-consultecnico').innerHTML = response
//     })
// }

// var ListarCategorias =  function(){
//     ajax_('../../views/Consultecnico/categorias.php', 'POST', 'HTML', {},
//     function(response){
//         document.getElementById('listar-categorias-consultecnico').innerHTML = response
//     })
// }

var ListarMensajes = function (PreguntaKey) {
  ajax_(
    "../../views/Consultecnico/ListarMensajes.php",
    "POST",
    "HTML",
    { pregunta: PreguntaKey },
    function (response) {
      document.getElementById(
        "listar-mensajes-pregunta-" + PreguntaKey
      ).innerHTML = response;
    }
  );
};
var addViewCheckout = function (Elem) {
  let number = Elem.getAttribute("number");

  $(".step-title").removeClass("completado").find("i:first").remove();
  $(".process").removeClass("active");
  /*  document.getElementById("process-" + number).classList.add("active"); */

  $(".process").each(function (index, el) {
    if (el.getAttribute("number") < number) {
      $(el).children("h4").addClass("completado");
    }
  });

  $(".completado").prepend('<i class="icon-check-circle"></i>');
  $(".PartialCheckout").css("display", "none");
};
function Numeros(string) {
  //Solo numeros
  var out = "";
  var filtro = "1234567890"; //Caracteres validos

  //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos
  for (var i = 0; i < string.length; i++)
    if (filtro.indexOf(string.charAt(i)) != -1)
      //Se añaden a la salida los caracteres validos
      out += string.charAt(i);

  //Retornar valor filtrado
  return out;
}
