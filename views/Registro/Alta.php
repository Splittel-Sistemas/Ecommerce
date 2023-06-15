<!DOCTYPE html>
<html lang="es">

<head>

  <!-- <title> Contacto </title> -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Head.php'; ?>
</head>
<!-- Body-->

<body>
  <!-- Header -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Header.php'; ?>
  <?php

  ?>





  <style>
    .form-control-2 {

      border-top: none;
      border-left: none;
      border-right: none;
      border-color: #BF202F;
    }
  </style>
  <script>
    function check() {
      document.getElementById("divs").removeAttribute('style');
    }

    function check2() {
      document.getElementById("divs").setAttribute('style', 'display:none');
    }


    function MORAL() {
      document.getElementById("documento1").removeAttribute('style');
      document.getElementById("documento2").removeAttribute('style');

    }

    function FISICA() {
      document.getElementById("documento1").setAttribute('style', 'display:none');
      document.getElementById("documento2").setAttribute('style', 'display:none');

    }
  </script>
  <div class="container padding-top-1x padding-bottom-3x mb-2">
    <div class="row ">
      <div class="col-1 padding-bottom-1x text-center">
      </div>
      <div class="col-10 padding-bottom-1x text-center">
        <img class="rounded" src="../../public/images/img_spl/ficrece/BannerFibre.jpg">
      </div>

    </div>
    <div class="steps flex-sm-nowrap mb-5">
      <a class="step process active" id="process-1" number="1" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" onclick="addViewCheckout(this)">
        <h4 class="step-title completado">
         FORMATO DE ALTA
        </h4>
      </a>
     

    </div>
   
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
        <div class="row no-gutters">
          <div class="col-md-12" id="notify" data-offset-top="-1">
            <div class=" px-3 justify-content-center align-items-center">
              <form class="row">
                <div class="col-sm-12 col-md-12 form-group">
                  <h1>1.- DATOS FISCALES</h1>
                </div>




                <div class="col-sm-12 col-md-6 form-group">
                  <label>RAZON SOCIAL <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="RazonSocial" name="RazonSocial">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>RFC<strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Rfc" name="Rfc">
                </div>

                <div class="col-sm-12 col-md-6 form-group">
                  <label>DIRECCIÓN FISCAL (Estado/entidad federativa) <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="DomicilioFiscal" name="DomicilioFiscal">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <input type="hidden" id="ejecutivo" value="marketing.directo@splittel.com">


                </div>
                <br>
                <br> <br>
                <br>
                <br>
                <br>
                <div class="col-sm-12 col-md-12 form-group">
                  <h1>2.- DATOS DE CONTACTO</h1>
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>NOMBRE COMPLETO <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="NombreSolicitud" name="NombreSolicitud">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>DEPARTAMENTO <strong class="text-danger"></strong></label>
                  <input class="form-control form-control-2" type="email" id="Departamento" name="Departamento">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>TÍTULO <strong class="text-danger"></strong></label>
                  <input class="form-control form-control-2" type="text" id="Titulo" name="Titulo" maxlength="4">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>TELÉFONO <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Telefono" name="Telefono" onkeyup="this.value=Numeros(this.value)">
                </div>

                <div class="col-sm-12 col-md-6 form-group">
                  <label>CORREO ELECTRÓNICO <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="email" id="Correo" name="Correo">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  
                </div>
                <br>
                <br> <br>
                <br>
                <br>
                <br>
                <div class="col-sm-12 col-md-12 form-group">
                  <h1>3.- DOMICILIO (Únicamente dirección de oficina)</h1>
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>CALLE <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Calle" name="Calle">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>NÚMERO INT. / EXT.<strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="NumeroInt" name="NumeroInt" ">
                </div>
                <div class=" col-sm-12 col-md-6 form-group">
                  <label>COLONIA <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Colonia" name="Colonia">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>CIUDAD / MUNICIPIO<strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Cuidad" name="Cuidad">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>CÓDIGO POSTAL<strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="CP" name="CP" onkeyup="this.value=Numeros(this.value)">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>ESTADO<strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Estado" name="Estado">
                </div>
                <br>
                <br> <br>
                <br>
                <br>
                <br>
                <div class="col-sm-12 col-md-12 form-group">
                  <h1>4.- DATOS ADICIONALES</h1>
                  <p>GIRO DE LA EMPRESA. (Marque el giro principal de la empresa, ej: Integrador, Distribuidor, Consultor, Constructora, etc.)</p>
                </div>
                <div class="col-sm-12 col-md-12 form-group text-center">

                  <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                    <input class="custom-control-input" type="checkbox" name="checks[]" value="Integrador" id="Integrador">
                    <label class="custom-control-label" for="Integrador">Integrador</label>
                  </div>
                  <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                    <input class="custom-control-input" type="checkbox" name="checks[]" value="Distribuidor" id="Distribuidor">
                    <label class="custom-control-label" for="Distribuidor">Distribuidor</label>
                  </div>
                  <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                    <input class="custom-control-input" type="checkbox" name="checks[]" value="Fabricante" id="Fabricante">
                    <label class="custom-control-label" for="Fabricante">Fabricante</label>
                  </div>
                  <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                    <input class="custom-control-input" type="checkbox" name="checks[]" value="ISP" id="ISP">
                    <label class="custom-control-label" for="ISP">ISP</label>
                  </div>

                </div>
                <br>
                <div class="col-sm-12 col-md-12 form-group text-center">

                  <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                    <input class="custom-control-input" type="checkbox" name="checks[]" value="Constructora" id="Constructora">
                    <label class="custom-control-label" for="Constructora">Constructora</label>
                  </div>
                  <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                    <input class="custom-control-input" type="checkbox" name="checks[]" value="Gobierno" id="Gobierno">
                    <label class="custom-control-label" for="Gobierno">Gobierno</label>
                  </div>
                  <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                    <input class="custom-control-input" type="checkbox" name="checks[]" value="Usuario" id="Usuario">
                    <label class="custom-control-label" for="Usuario">Usuario</label>
                  </div>
                  <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                    <input class="custom-control-input" type="checkbox" name="checks[]" value="Carrier" id="Carrier">
                    <label class="custom-control-label" for="Carrier">Carrier</label>
                  </div>

                </div>
                <br>
                <div class="col-sm-12 col-md-12 form-group text-center">

                  <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                    <input class="custom-control-input" type="checkbox" name="checks[]" value="Consultor" id="Consultor">
                    <label class="custom-control-label" for="Consultor">Consultor</label>
                  </div>
                  <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                    <input class="custom-control-input" type="checkbox" name="checks[]" value="Educación" id="Educación">
                    <label class="custom-control-label" for="Educación">Educación</label>
                  </div>
                  <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                    <input class="custom-control-input" type="checkbox" name="checks[]" value="CFE" id="CFE">
                    <label class="custom-control-label" for="CFE">CFE</label>
                  </div>
                  <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                    <input class="custom-control-input" type="checkbox" name="checks[]" value="Otro" id="Otro">
                    <label class="custom-control-label" for="Otro">Otro</label>
                  </div>

                </div>

                <div class="col-sm-12 col-md-6 form-group">
                  <label>NOMBRE COMERCIAL<strong class="text-danger"></strong></label>
                  <input class="form-control form-control-2" type="text" id="NombreComercial" name="NombreComercial">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>PÁGINA WEB<strong class="text-danger"></strong></label>
                  <input class="form-control form-control-2" type="text" id="Web" name="Web">
                </div>
                <br>
                <br> <br>
                <br>
                <br>
                <br>
                <div class="col-sm-12 col-md-12 form-group">
                  <h1>5.- ANEXOS</h1>
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>Constancia de situación fiscal en PDF.<strong class="text-danger"></strong></label>
                  <input class="form-control form-control-2" type="file" id="file" accept="application/pdf">
                </div>
                <div class="col-sm-12 col-md-6 form-group">

                </div>
                <div class="col-sm-12 col-md-12 form-group text-center">
                  <button type="button" id="botonenviar" class="btn btn-primary " onclick="EnviarAlta()">Enviar Solicitud</button>
                </div>
                <br>
                <br>
                <div class="col-sm-12 col-md-12 form-group text-center">
                  <h1>
                    <b>AVISO DE CONFIDENCIALIDAD</b>

                  </h1>
                  <br>
                  <p>Splittel Holding S. de R.L. de C.V. con domicilio en Parque Tecnológico Innovación Querétaro, Lateral de la carretera Estatal 431, km.2+200, Int.28,
                    C.P.76246. Es responsable del tratamiento de sus datos personales, los cuales utilizará para los siguientes fines: Proveer los servicios y productos que
                    usted ha solicitado, compartir con usted material informativo y publicitario y evaluar la calidad de nuestros servicios. Para mayor información acerca del
                    tratamiento y de los derechos que puede hacer valer, usted puede acceder al aviso de privacidad completo a través de Ley de privacidad</p>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
      
    </div>

  </div>
  </div>


  <!-- Footer -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Footer.php'; ?>
  <!-- scripts JS -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Scripts.php'; ?>
  <!--  -->
  <script type="text/javascript" src="../../public/scripts/registro/alta.js?id=<?php echo rand() ?>"></script>
</body>

</html>
<?php
unset($Contacto);
unset($ContactoController);
?>