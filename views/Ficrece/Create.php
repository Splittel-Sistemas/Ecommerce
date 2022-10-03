<style>
  .form-control {

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
</script>
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">DATOS GENERALES</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-toggle="pill" data-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">REFERENCIAS COMERCIALES</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-contact-tab" data-toggle="pill" data-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">DATOS DEL CRÉDITO</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-documentos-tab" data-toggle="pill" data-target="#pills-documentos" type="button" role="tab" aria-controls="pills-documentos" aria-selected="false">DOCUMENTACION</button>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <div class="row no-gutters">
      <div class="col-md-12" id="notify" data-offset-top="-1">
        <div class=" py-5 px-3 justify-content-center align-items-center">
          <form class="row">
            <div class="col-sm-12 col-md-6 form-group">
              <label>NOMBRE <strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="NombreSolicitud" name="NombreSolicitud">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>CORREO <strong class="text-danger">*</strong></label>
              <input class="form-control" type="email" id="Correo" name="Correo">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>RAZON SOCIAL <strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="RazonSocial" name="RazonSocial">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>DOMICILIO FISCAL: <strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="DomicilioFiscal" name="DomicilioFiscal">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>COLONIA <strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="Colonia" name="Colonia">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>CIUDAD : <strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="Ciudad" name="Ciudad">
            </div>



            <div class="col-sm-12 col-md-6 form-group">
              <label>C.P. <strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="Cp" name="Cp">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>FAX <strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="Fax" name="Fax">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>R.F.C. <strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="Rfc" name="Rfc">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>FECHA CONSTITUCION <strong class="text-danger">*</strong></label>
              <input class="form-control" type="date" id="FechaConstitucion" name="FechaConstitucion">
            </div>


            <div class="col-sm-12 col-md-6 form-group">
              <label>CURP <strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="Curp" name="Curp">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>TELEFONO<strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="Telefono" name="Telefono">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Giro del Negocio <strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="Giro" name="Giro">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>Fecha de alta SHCP <strong class="text-danger">*</strong></label>
              <input class="form-control" type="date" id="FechaAlta" name="FechaAlta">
            </div>

            <div class="col-sm-12 form-group">
              <label>JEFE DEL DEPTO. DE CUENTAS POR PAGAR, CORREO Y NÚMERO DE EXTENSIÓN <strong class="text-danger">*</strong></label>
              <textarea class="form-control" name="JefeDepto" id="JefeDepto" rows="8"></textarea>
            </div>

            <div class="col-sm-12 col-md-6 form-group">
              <label>NOMBRE DEL DUEÑO BENEFICIARIO <strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="Beneficiario" name="Beneficiario">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>FORMA DE PAGO<strong class="text-danger">*</strong></label>
              <input class="form-control" type="text" id="FormaPago" name="FormaPago">
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
            <input class="form-control" type="text" id="Nombre1" name="Nombre1">
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Domicilio <strong class="text-danger">*</strong></label>
            <input class="form-control" type="text" id="Domicilio1" name="Domicilio1">
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Ciudad <strong class="text-danger">*</strong></label>
            <input class="form-control" type="text" id="Ciudad1" name="Ciudad1">
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Telefono <strong class="text-danger">*</strong></label>
            <input class="form-control" type="text" id="Telefono1" name="Telefono1">
          </div>

        </form>
        <hr>

        <form class="row">
          <div class="col-sm-12 col-md-6 form-group">
            <label>Nombre <strong class="text-danger"></strong></label>
            <input class="form-control" type="text" id="Nombre2" name="Nombre2">
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Domicilio <strong class="text-danger"></strong></label>
            <input class="form-control" type="text" id="Domicilio2" name="Domicilio2">
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Ciudad <strong class="text-danger"></strong></label>
            <input class="form-control" type="text" id="Ciudad2" name="Ciudad2">
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Telefono <strong class="text-danger"></strong></label>
            <input class="form-control" type="text" id="Telefono2" name="Telefono2">
          </div>

        </form>
        <hr>
        <form class="row">
          <div class="col-sm-12 col-md-6 form-group">
            <label>Nombre <strong class="text-danger"></strong></label>
            <input class="form-control" type="text" id="Nombre3" name="Nombre3">
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Domicilio <strong class="text-danger"></strong></label>
            <input class="form-control" type="text" id="Domicilio3" name="Domicilio3">
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Ciudad <strong class="text-danger"></strong></label>
            <input class="form-control" type="text" id="Ciudad3" name="Ciudad3">
          </div>
          <div class="col-sm-12 col-md-6 form-group">
            <label>Telefono <strong class="text-danger"></strong></label>
            <input class="form-control" type="text" id="Telefono3" name="Telefono3">
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
              <input class="form-control" type="text" id="MontoCredito" name="MontoCredito">
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
              <input class="form-control" type="text" id="Otro" name="Otro">
            </div>
            <div class="col-sm-12 form-group">
              <label>OBSERVACIONES <strong class="text-danger">*</strong></label>
              <textarea class="form-control" name="Observaciones" id="Observaciones" rows="8"></textarea>
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
            <div class="col-sm-12 col-md-6 form-group">
              <label>1.- Escritura constitutiva y estatutos vigentes <strong class="text-danger">*</strong></label>
              <input class="form-control" type="file" id="file">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>2.- Poder del representante legal <strong class="text-danger">*</strong></label>
              <input class="form-control" type="file" id="file2">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>3.- Identificación oficial del representante legal <strong class="text-danger">*</strong></label>
              <input class="form-control" type="file" id="file3">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>4.- Alta en Hacienda y RFC <strong class="text-danger">*</strong></label>
              <input class="form-control" type="file" id="file4">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>5.- Comprobante de domicilio (No mayor a 3 meses) <strong class="text-danger">*</strong></label>
              <input class="form-control" type="file" id="file5">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>6.- Estados Financieros de los últimos 3 meses (Balance General y Estado de Resultados) desglosados por mes, para ver como cerro cada uno y firmados<strong class="text-danger">*</strong></label>
              <input class="form-control" type="file" id="file6">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>7.- Estados de Cuenta bancarios de los últimos 3 meses (Solo Carátula) con total de depositos y retiros visibles <strong class="text-danger">*</strong></label>
              <input class="form-control" type="file" id="file7">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>8.- Autorización para solicitar reportes de crédito ADM-FOR-520 Rev00 <strong class="text-danger">*</strong></label>
              <input class="form-control" type="file" id="file8">
            </div>
            <div class="col-sm-12 col-md-6 form-group">
              <label>9.- Opinión de cumplimiento<strong class="text-danger">*</strong></label>
              <input class="form-control" type="file" id="file9">
            </div>
            <div class="col-sm-12">
              <button type="button" class="btn btn-primary float-right" onclick="EnviarSolicitud()">Enviar Pregunta</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>