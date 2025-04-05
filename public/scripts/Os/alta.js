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
    var desc = cells[2].querySelector("textarea").value;

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
  fda.append("Empresa", $("#company").val());
  fda.append("Estado", $("#state").val());
  fda.append("Contacto", $("#fullname").val());
  fda.append("Correo", $("#email").val());
  fda.append("Telefono", $("#phone").val());
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
  fda.append("paqueteria", $("#paqueteria").val());
  fda.append("guia", $("#guia").val());

  var fda1 = new FormData();
  fda1.append("company", $("#company").val());
  fda1.append("state", $("#state").val());
  fda1.append("firstname", $("#fullname").val());
  fda1.append("email", $("#email").val());
  fda1.append("phone", $("#phone").val());
  var CorreEjecutivo = $("#ejecutivo").val();
  fda1.append("CorreoEjecutivo", CorreEjecutivo);
  
  fda1.append("checks", valoresCheck);
  /*  var observaciones = tinymce.get("observaciones").getContent(); */
  fda1.append("Marca", $("#Marca").val());
  fda1.append("Modelo", $("#Modelo").val());
  fda1.append("serie", $("#serie").val());
  fda1.append("observaciones", $("#observaciones").val());
  fda1.append("accesorios", $("#valoresAccesorios").val());
  fda1.append("paqueteria", $("#paqueteria").val());
  fda1.append("guia", $("#guia").val());

  // Obtén la tabla por su ID

  if (CorreEjecutivo != "") {
    $.ajax({
      url: "../../models/Solicitud/Os/Alta.Route.php",
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
          const jsonData = { fields: {}, skipValidation: false };

          fda1.forEach((value, key) => {
              jsonData.fields[key] = value; // Agregar cada dato dentro de "fields"
          });
          // Convertir a cadena JSON (si es necesario)
          const jsonString = JSON.stringify(jsonData);
          console.log(jsonString);
          let formattedJson = {
            fields: Object.entries(jsonData.fields).map(([key, value]) => ({
                name: key,
                value: value
            })),
            skipValidation: jsonData.skipValidation
        };
        
        console.log(JSON.stringify(formattedJson, null, 2)); 
        let jsonFormated = JSON.stringify(formattedJson, null, 2);

          $.ajax({
            url: 'https://api.hsforms.com/submissions/v3/integration/submit/24007482/780e893e-afce-4de1-ad5d-fee12e262c05',
            type: 'POST',
            data: jsonFormated,
            contentType: 'application/json',
            async:false,
            success: function(response1) {
                console.log('Success:', response1);
                window.location.href = "Mensaje.php";
            },
            error: function(xhr, status, error) {
                console.log('Error HubSpot:', error+' - status: '+status+' -xhr: '+JSON.stringify(xhr));
                window.location.href = "Mensaje.php";
            }
        });
          
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
