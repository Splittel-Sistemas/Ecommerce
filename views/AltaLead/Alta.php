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
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Contacto/Ejecutivos.Controller.php';
  $ContactoController = new EjecutivosController();
  $Contacto = $ContactoController->get_Ejecutivos1();
  if (isset($_GET['ejecutivo'])) {
    $EjecutivoController = new EjecutivosController();
    $EjecutivoController->filter = "AND email ='" . $_GET['ejecutivo'] . " '";
    $Ejecutivo = $EjecutivoController->getBy();
  }
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
          <!-- <i class="icon-check-circle"></i> -->FORMATO DE ALTA
        </h4>
      </a>
      <!--      <a class="step process " id="process-2" number="2" class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="addViewCheckout(this)">
        <h4 class="step-title">2. Referencias Comerciales</h4>
      </a>
      <a class="step process" id="process-3" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" number="3" onclick="addViewCheckout(this)">
        <h4 class="step-title">3. Datos del Crédito</h4>
      </a>
      <a class="step process" id="process-4" number="4" class="nav-link" id="pills-documentos-tab" data-toggle="pill" data-target="#pills-documentos" type="button" role="tab" aria-controls="pills-documentos" aria-selected="false" onclick="addViewCheckout(this)">
        <h4 class="step-title">4. Documentación</h4>
      </a> -->

    </div>
    <!--  <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
      <li class="nav-item " role="presentation">
        <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">1. DATOS GENERALES</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">2. REFERENCIAS COMERCIALES</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">3. DATOS DEL CRÉDITO</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="pills-documentos-tab" data-toggle="pill" data-target="#pills-documentos" type="button" role="tab" aria-controls="pills-documentos" aria-selected="false">4. DOCUMENTACION</button>
      </li>
    </ul> -->
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
                  <label for="validationCustom06">EJECUTIVO <strong class="text-danger">*</strong></label>
                  <select class="form-control form-control-2" id="ejecutivo" required>
                    <option value=<?= isset($_GET['ejecutivo']) ? $Ejecutivo->email  : ''; ?>>
                      <?php
                      if (isset($_GET['ejecutivo']) && $_GET['ejecutivo'] == $Ejecutivo->email) {
                        echo $Ejecutivo->nombre . " " . $Ejecutivo->apellidos;
                      } else {
                        echo 'Seleccione un Ejecutivo';
                      };

                      ?>

                    </option>
                    <?php foreach ($Contacto->records as $key => $data) { ?>
                      <?php
                      if (isset($_GET['ejecutivo']) && $_GET['ejecutivo'] == $data->email) {
                        
                      } else {
                      ?>
                        <option value=<?= $data->email ?>><?= $data->nombre . " " . $data->apellidos ?></option>
                      <?php


                      };

                      ?>
                    <?php } ?>
                  </select>
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
                  <label>WHATSAPP <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Whats" name="Whats" onkeyup="this.value=Numeros(this.value)">
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
      <!-- <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
        <div class="col-md-12" id="notify" data-offset-top="-1">
          <div class=" py-5 px-3 justify-content-center align-items-center">
            <form class="row">
              <div class="col-sm-12 col-md-6 form-group">
                <label>Nombre <strong class="text-danger">*</strong></label>
                <input class="form-control form-control-2" type="text" id="Nombre1" name="Nombre1">
              </div>
              <div class="col-sm-12 col-md-6 form-group">
                <label>Domicilio <strong class="text-danger">*</strong></label>
                <input class="form-control form-control-2" type="text" id="Domicilio1" name="Domicilio1">
              </div>
              <div class="col-sm-12 col-md-6 form-group">
                <label>Ciudad <strong class="text-danger">*</strong></label>
                <input class="form-control form-control-2" type="text" id="Ciudad1" name="Ciudad1">
              </div>
              <div class="col-sm-12 col-md-6 form-group">
                <label>Telefono <strong class="text-danger">*</strong></label>
                <input class="form-control form-control-2" type="tel" id="Telefono1" name="Telefono1" onkeyup="this.value=Numeros(this.value)">
              </div>

            </form>

            <form class="row">
              <div class="col-sm-12 col-md-6 form-group">
                <label>Nombre <strong class="text-danger"></strong></label>
                <input class="form-control form-control-2" type="text" id="Nombre2" name="Nombre2">
              </div>
              <div class="col-sm-12 col-md-6 form-group">
                <label>Domicilio <strong class="text-danger"></strong></label>
                <input class="form-control form-control-2" type="text" id="Domicilio2" name="Domicilio2">
              </div>
              <div class="col-sm-12 col-md-6 form-group">
                <label>Ciudad <strong class="text-danger"></strong></label>
                <input class="form-control form-control-2" type="text" id="Ciudad2" name="Ciudad2">
              </div>
              <div class="col-sm-12 col-md-6 form-group">
                <label>Telefono <strong class="text-danger"></strong></label>
                <input class="form-control form-control-2" type="text" id="Telefono2" name="Telefono2" onkeyup="this.value=Numeros(this.value)">
              </div>

            </form>
            <form class="row">
              <div class="col-sm-12 col-md-6 form-group">
                <label>Nombre <strong class="text-danger"></strong></label>
                <input class="form-control form-control-2" type="text" id="Nombre3" name="Nombre3">
              </div>
              <div class="col-sm-12 col-md-6 form-group">
                <label>Domicilio <strong class="text-danger"></strong></label>
                <input class="form-control form-control-2" type="text" id="Domicilio3" name="Domicilio3">
              </div>
              <div class="col-sm-12 col-md-6 form-group">
                <label>Ciudad <strong class="text-danger"></strong></label>
                <input class="form-control form-control-2" type="text" id="Ciudad3" name="Ciudad3">
              </div>
              <div class="col-sm-12 col-md-6 form-group">
                <label>Telefono <strong class="text-danger"></strong></label>
                <input class="form-control form-control-2" type="text" id="Telefono3" name="Telefono3" onkeyup="this.value=Numeros(this.value)">
              </div>

            </form>
          </div>
        </div>
      </div> -->
      <!--    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
        <div class="row no-gutters">
          <div class="col-md-12" id="notify" data-offset-top="-1">
            <div class=" py-5 px-3 justify-content-center align-items-center">
              <form class="row">
                <div class="col-sm-12 col-md-6 form-group">
                  <label>MONTO DEL CRÉDITO SOLICITADO <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="number" id="MontoCredito" name="MontoCredito">
                  <small>indica la cantidad en dolares americanos</small>
                </div>
                <div class="col-sm-12 col-md-6 form-group text-center">
                  <label>PLAZO DE CRÉDITO SOLICITADO <strong class="text-danger">*</strong></label>

                  <div class="custom-control custom-radio ">
                    <input class="custom-control-input" type="radio" id="ex-radio-1" value="21" name="Plazo" onclick="check2()" checked>
                    <label class="custom-control-label" for="ex-radio-1">21 DIAS</label>
                  </div>
                  <div class="custom-control custom-radio ">
                    <input class="custom-control-input" type="radio" id="ex-radio-2" value="30" name="Plazo" onclick="check2()">
                    <label class="custom-control-label" for="ex-radio-2">30 DIAS</label>
                  </div>

                  <div class="custom-control custom-radio ">
                    <input class="custom-control-input" type="radio" id="ex-radio-3" value="otro" name="Plazo" onclick="check()">
                    <label class="custom-control-label" for="ex-radio-3">OTRO</label>
                  </div>
                </div>

                <div class="col-sm-12 col-md-6 form-group" id="divs" style="display:none">
                  <label>OTRO <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Otro" name="Otro" onkeyup="this.value=Numeros(this.value)">
                </div>
                <div class="col-sm-12 form-group">
                  <label>OBSERVACIONES <strong class="text-danger">*</strong></label>
                  <textarea class="form-control form-control-2" name="Observaciones" id="Observaciones" rows="8"></textarea>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div> -->
      <!-- DOCUMENTACION -->
      <!-- <div class="tab-pane fade" id="pills-documentos" role="tabpanel" aria-labelledby="pills-documentos-tab">
        <div class="row no-gutters">
          <div class="col-md-12" id="notify" data-offset-top="-1">
            <div class=" py-5 px-3 justify-content-center align-items-center">
              <form class="row">
                <div class="col-sm-12 col-md-6 form-group" id="documento1">
                  <label>1.- Escritura constitutiva y estatutos vigentes <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="file" id="file">
                </div>
                <div class="col-sm-12 col-md-6 form-group" id="documento2">
                  <label>2.- Poder del representante legal <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="file" id="file2">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>3.- Identificación oficial del representante legal <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="file" id="file3">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>4.- Alta en Hacienda y RFC <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="file" id="file4">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>5.- Comprobante de domicilio (No mayor a 3 meses) <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="file" id="file5">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>6.- Estados Financieros de los últimos 3 meses (Balance General y Estado de Resultados) desglosados por mes, para ver como cerro cada uno y firmados<strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="file" id="file6">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>7.- Estados de Cuenta bancarios de los últimos 3 meses (Solo Carátula) con total de depositos y retiros visibles <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="file" id="file7">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>8.- Autorización para solicitar reportes de crédito ADM-FOR-520 Rev00 <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="file" id="file8">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>9.- Opinión de cumplimiento<strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="file" id="file9">
                </div>
                
              </form>
            </div>
          </div>
        </div> -->
    </div>

  </div>
  </div>


  <!-- Footer -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Footer.php'; ?>
  <!-- scripts JS -->
  <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Scripts.php'; ?>
  <!--  -->
  <script type="text/javascript" src="../../public/scripts/altalead/alta.js?id=<?php echo rand() ?>"></script>
</body>

</html>
<?php
unset($Contacto);
unset($ContactoController);
?>