
var EnviarAlta = function () {
  $("#botonenviar").hide();
  var fda = new FormData();
  fda.append("Action", "create");
  fda.append("ActionSolicitud", true);
  fda.append("name", $("#name").val());
  fda.append("date", $("#date").val());
  fda.append("NombreSolicitud", $("#NombreSolicitud").val());
  fda.append("Empresa", $("#Empresa").val());
  fda.append("Puesto", $("#Puesto").val());
  fda.append("Telefono", $("#Telefono").val());
  fda.append("CorreoEmpresarial", $("#CorreoEmpresarial").val());
  fda.append("CorrePersonal", $("#CorrePersonal").val());
  fda.append("Whatsapp", $("#Whatsapp").val());
  fda.append("CorreEjecutivo", $("#ejecutivo").val());
  var CorreEjecutivo = $("#ejecutivo").val();
  if (CorreEjecutivo != "") {
    $.ajax({
      url: "../../models/Solicitud/Cursos/Alta.Route.php",
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
          window.location.href = "Mensaje.php";
        } else {
          $("#botonenviar").show();
          templateAlert("danger", "", response.message, "topRight", "");
        }
      },
    });
  } else {
    $("#botonenviar").show();

    templateAlert("danger", "", "SELECCIONE UN EJECUTIVO", "topRight", "");
  }
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
