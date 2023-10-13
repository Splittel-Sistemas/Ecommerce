var Enviar = function () {
  /*  $("#botonenviar").hide(); */
  let valoresCheck = [];
  // Crear un array para almacenar los datos
  var json_lines_gar = [];

  // Obtener todas las filas de la tabla con la clase "rows"
  var rows = document.querySelectorAll("#tableId .rows tr");
  // Iterar sobre las filas
  rows.forEach(function (row) {
    var cells = row.querySelectorAll("td");
    var cantidad = cells[0].querySelector("input").value;
    var nserie = cells[1].querySelector("input").value;
    var desc = cells[2].querySelector("input").value;

    if (cantidad != "") {
      json_lines_gar.push({
        cantidad: cantidad,
        nserie: nserie,
        desc: desc,
      });
    }
  });
  var jsonStringdataArray = JSON.stringify(json_lines_gar);
  // En este punto, dataArray contendrá los datos de la tabla en forma de un array
  $("#valoresAccesorios").val(jsonStringdataArray);
  console.log(jsonStringdataArray);
  /* return false; */
  var fda = new FormData();
  fda.append("Action", "create");
  fda.append("ActionSolicitud", true);
  fda.append("Empresa", $("#Empresa").val());
  fda.append("Estado", $("#Estado").val());
  fda.append("Contacto", $("#Contacto").val());
  fda.append("Correo", $("#Correo").val());
  fda.append("Telefono", $("#Telefono").val());
  var CorreEjecutivo = $("#ejecutivo").val();
  fda.append("CorreEjecutivo", CorreEjecutivo);
  $("input[type=checkbox]:checked").each(function () {
    valoresCheck.push(this.value);
  });
  fda.append("valoresCheck", valoresCheck);
  /*  var observaciones = tinymce.get("observaciones").getContent(); */
  fda.append("Marca", $("#Marca").val());
  fda.append("Modelo", $("#Modelo").val());
  fda.append("serie", $("#serie").val());
  fda.append("observaciones", $("#observaciones").val());
  fda.append("accesorios", $("#valoresAccesorios").val());
  // Obtén la tabla por su ID

  if (CorreEjecutivo != "") {
    $.ajax({
      url: "../../models/Solicitud/OS/Alta.Route.php",
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
