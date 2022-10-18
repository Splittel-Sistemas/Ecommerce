var EnviarAlta = function () {
  let valoresCheck = [];

  var fda = new FormData();
  fda.append("Action", "create");
  fda.append("ActionSolicitud", true);
  fda.append("RazonSocial", $("#RazonSocial").val());
  fda.append("Rfc", $("#Rfc").val());
  fda.append("DomicilioFiscal", $("#DomicilioFiscal").val());
  fda.append("NombreSolicitud", $("#NombreSolicitud").val());
  fda.append("Departamento", $("#Departamento").val());
  fda.append("Titulo", $("#Titulo").val());
  fda.append("Telefono", $("#Telefono").val());
  fda.append("Correo", $("#Correo").val());
  let params = new URLSearchParams(location.search);
  var CorreEjecutivo = params.get("ejecutivo");
  fda.append("CorreEjecutivo", CorreEjecutivo);
  fda.append("NummeroInt", $("#NumeroInt").val());
  fda.append("Calle", $("#Calle").val());
  fda.append("Colonia", $("#Colonia").val());
  fda.append("Cuidad", $("#Cuidad").val());
  fda.append("CP", $("#CP").val());
  fda.append("Estado", $("#Estado").val());
  $("input[type=checkbox]:checked").each(function () {
    valoresCheck.push(this.value);
  });
  fda.append("NombreComercial", $("#NombreComercial").val());
  fda.append("Web", $("#Web").val());
  fda.append("valoresCheck", valoresCheck);

  var file_data = $("#file").prop("files")[0];
  fda.append("file", file_data);

  $.ajax({
    url: "../../models/Solicitud/Ficrece/Alta.Route.php",
    type: "post",
    data: fda,
    contentType: false,
    processData: false,
    dataType: "json",
    async: false,
    cache: false,
    success: function (response) {
      if (!response.error) {
        templateAlert(
          "success",
          "Enviado",
          "La solicitud ha sido enviada",
          "center",
          ""
        );
        GlobalCloseModal("modal-ficrece");
        window.location.href = "Mensaje.php";
      } else {
        templateAlert("danger", "", response.message, "topRight", "");
      }
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
