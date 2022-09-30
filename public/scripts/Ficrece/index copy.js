var EnviarSolicitud = function () {
  let NombreSolicitud = document.getElementById("NombreSolicitud");
  let Correo = document.getElementById("Correo");
  let RazonSocial = document.getElementById("RazonSocial");
  let DomicilioFiscal = document.getElementById("DomicilioFiscal");
  let Colonia = document.getElementById("Colonia");
  let Ciudad = document.getElementById("Ciudad");
  let Cp = document.getElementById("Cp");
  let Fax = document.getElementById("Fax");
  let Rfc = document.getElementById("Rfc");
  let FechaConstitucion = document.getElementById("FechaConstitucion");
  let Curp = document.getElementById("Curp");
  let Telefono = document.getElementById("Telefono");
  let Giro = document.getElementById("Giro");
  let FechaAlta = document.getElementById("FechaAlta");
  let JefeDepto = document.getElementById("JefeDepto");
  let Beneficiario = document.getElementById("Beneficiario");
  let FormaPago = document.getElementById("FormaPago");
  let Nombre1 = document.getElementById("Nombre1");
  let Domicilio1 = document.getElementById("Domicilio1");
  let Ciudad1 = document.getElementById("Ciudad1");
  let Telefono1 = document.getElementById("Telefono1");
  let Nombre2 = document.getElementById("Nombre2");
  let Domicilio2 = document.getElementById("Domicilio2");
  let Ciudad2 = document.getElementById("Ciudad2");
  let Telefono2 = document.getElementById("Telefono2");
  let Nombre3 = document.getElementById("Nombre3");
  let Domicilio3 = document.getElementById("Domicilio3");
  let Ciudad3 = document.getElementById("Ciudad3");
  let Telefono3 = document.getElementById("Telefono3");
  let MontoCredito = document.getElementById("MontoCredito");
  /* let Plazo = document.getElementById("Plazo"); */
  let Plazo = document.getElementById("Otro");
  let Observaciones = document.getElementById("Observaciones");

  ajax_(
    "../../models/Solicitud/Ficrece/Solicitud.Route.php",
    "POST",
    "JSON",
    {
      Action: "create",
      ActionSolicitud: true,
      NombreSolicitud: NombreSolicitud.value,
      Correo: Correo.value,

      RazonSocial: RazonSocial.value,
      DomicilioFiscal: DomicilioFiscal.value,
      Colonia: Colonia.value,
      Ciudad: Ciudad.value,
      Cp: Cp.value,
      Fax: Fax.value,
      Rfc: Rfc.value,
      FechaConstitucion: FechaConstitucion.value,
      Curp: Curp.value,
      Telefono: Telefono.value,
      Giro: Giro.value,
      FechaAlta: FechaAlta.value,
      JefeDepto: JefeDepto.value,
      Beneficiario: Beneficiario.value,
      FormaPago: FormaPago.value,
      Nombre1: Nombre1.value,
      Domicilio1: Domicilio1.value,
      Ciudad1: Ciudad1.value,
      Telefono1: Telefono1.value,
      Nombre2: Nombre2.value,
      Domicilio2: Domicilio2.value,
      Ciudad2: Ciudad2.value,
      Telefono2: Telefono2.value,
      Nombre3: Nombre3.value,
      Domicilio3: Domicilio3.value,
      Ciudad3: Ciudad3.value,
      Telefono3: Telefono3.value,
      MontoCredito: MontoCredito.value,
      Plazo: Plazo.value,
      Observaciones: Observaciones.value,
    },
    function (response) {
       if (!response.error) {
         var fda = new FormData(); 
       /*  templateAlert(
            "success",
            "Enviado",
            "La solicitud ha sido enviada",
            "center",
            ""
          );
          GlobalCloseModal("modal-ficrece");
          window.location.href = "index.php?";
        */
         fda.append("descripcion", $("#descripcion").val());
            
              fda.append("monto", $("#monto").val());
              

        var file_data = $("#Doc1").prop("files")[0];
        fda.append("file", file_data);

        $.ajax({
          url: "../../models/Solicitud/Ficrece/Solicitud.Route.php",
          type: "post",
          data: fda,
          contentType: false,
          processData: false,
          dataType: "json",
          async: false,
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
              window.location.href = "index.php?";
            } else {
              templateAlert("danger", "", response.message, "topRight", "");
            }
          },
        });
      } else {
        templateAlert("danger", "", response.message, "topRight", "");
      }
    }
  );
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
