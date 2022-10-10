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
  if (!class_exists("ContactoController")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Contacto/Contacto.Controller.php';
  }
  $ContactoController = new ContactoController();
  $Contacto = $ContactoController->GetBy();
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
  <div class="container padding-top-3x padding-bottom-3x mb-2">
  <div class="steps flex-sm-nowrap mb-5">
      <a class="step process active" id="process-1" number="1" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" onclick="addViewCheckout(this)">
        <h4 class="step-title completado"><i class="icon-check-circle"></i>1. Datos Generales</h4>
      </a>
      <a class="step process " id="process-2" number="2" class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" onclick="addViewCheckout(this)">
        <h4 class="step-title">2. Referencias Comerciales</h4>
      </a>
      <a class="step process" id="process-3" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" number="3" onclick="addViewCheckout(this)">
        <h4 class="step-title">3. Datos del Credito</h4>
      </a>
      <a class="step process" id="process-4" number="4" class="nav-link" id="pills-documentos-tab" data-toggle="pill" data-target="#pills-documentos" type="button" role="tab" aria-controls="pills-documentos" aria-selected="false" onclick="addViewCheckout(this)">
        <h4 class="step-title">4. Documentacion</h4>
      </a>

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
                <div class="col-sm-12 col-md-2 form-group">
                </div>

                <div class="col-sm-12 col-md-4 form-group">
                  <div class="custom-control custom-radio ">
                    <input class="custom-control-input" type="radio" id="PERSONA-radio-2" value="MORAL" name="PERSONA" onclick="MORAL()" checked>
                    <label class="custom-control-label" for="PERSONA-radio-2">PERSONA MORAL</label>
                  </div>
                </div>
                <div class="col-sm-12 col-md-4 form-group">
                  <div class="custom-control custom-radio ">
                    <input class="custom-control-input" type="radio" id="PERSONA-radio-1" value="FISICA" name="PERSONA" onclick="FISICA()">
                    <label class="custom-control-label" for="PERSONA-radio-1">PERSONA FISICA</label>
                  </div>
                </div>


                <div class="col-sm-12 col-md-2 form-group">
                </div>

                <div class="col-sm-12 col-md-6 form-group">
                  <label>NOMBRE <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="NombreSolicitud" name="NombreSolicitud">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>CORREO <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="email" id="Correo" name="Correo">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>RAZON SOCIAL <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="RazonSocial" name="RazonSocial">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>DOMICILIO FISCAL: <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="DomicilioFiscal" name="DomicilioFiscal">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>COLONIA <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Colonia" name="Colonia">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>CIUDAD : <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Ciudad" name="Ciudad">
                </div>



                <div class="col-sm-12 col-md-6 form-group">
                  <label>C.P. <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="number" id="Cp" name="Cp" maxlength="4">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>FAX <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Fax" name="Fax">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>R.F.C. <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Rfc" name="Rfc">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>FECHA CONSTITUCION <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="date" id="FechaConstitucion" name="FechaConstitucion">
                </div>


                <div class="col-sm-12 col-md-6 form-group">
                  <label>CURP <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Curp" name="Curp">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>TELEFONO<strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Telefono" name="Telefono">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>Giro del Negocio <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Giro" name="Giro">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>Fecha de alta SHCP <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="date" id="FechaAlta" name="FechaAlta">
                </div>

                <div class="col-sm-12 form-group">
                  <label>JEFE DEL DEPTO. DE CUENTAS POR PAGAR, CORREO Y NÚMERO DE EXTENSIÓN <strong class="text-danger">*</strong></label>
                  <textarea class="form-control form-control-2" name="JefeDepto" id="JefeDepto" rows="4"></textarea>
                </div>

                <div class="col-sm-12 col-md-6 form-group">
                  <label>NOMBRE DEL DUEÑO BENEFICIARIO <strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="Beneficiario" name="Beneficiario">
                </div>
                <div class="col-sm-12 col-md-6 form-group">
                  <label>FORMA DE PAGO<strong class="text-danger">*</strong></label>
                  <input class="form-control form-control-2" type="text" id="FormaPago" name="FormaPago">
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
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
                <input class="form-control form-control-2" type="text" id="Telefono1" name="Telefono1">
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
                <input class="form-control form-control-2" type="text" id="Telefono2" name="Telefono2">
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
                <input class="form-control form-control-2" type="text" id="Telefono3" name="Telefono3">
              </div>

            </form>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
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
                  <input class="form-control form-control-2" type="text" id="Otro" name="Otro">
                </div>
                <div class="col-sm-12 form-group">
                  <label>OBSERVACIONES <strong class="text-danger">*</strong></label>
                  <textarea class="form-control form-control-2" name="Observaciones" id="Observaciones" rows="8"></textarea>
                </div>
                <!--  <div class="col-sm-12">
              <button type="button" class="btn btn-primary float-right" onclick="EnviarPregunta()">Enviar Pregunta</button>
            </div> -->
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- DOCUMENTACION -->
      <div class="tab-pane fade" id="pills-documentos" role="tabpanel" aria-labelledby="pills-documentos-tab">
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
                <div class="col-sm-12">
                  <button type="button" class="btn btn-primary float-right" onclick="EnviarSolicitud()">Enviar Solicitud</button>
                </div>
              </form>
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
  <script type="text/javascript" src="../../public/scripts/Ficrece/index.js?id=<?php echo rand() ?>"></script>
</body>

</html>
<?php
unset($Contacto);
unset($ContactoController);
?>