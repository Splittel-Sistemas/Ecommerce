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
    $Contacto = $ContactoController->get_Ejecutivos();
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

    <div class="container padding-top-1x padding-bottom-3x mb-2">
        <div class="row ">
            <div class="col-1 padding-bottom-1x text-center">
            </div>
            <div class="col-10 padding-bottom-1x text-center">
                <img class="rounded" src="../../public/images/img_spl/ficrece/BannerFibre.jpg">
            </div>

        </div>
        <div class="steps flex-sm-nowrap mb-5">
            <a class="step process active" id="process-1" number="1" data-toggle="pill" data-target="#pills-home" type="button " role="tab" aria-controls="pills-home" aria-selected="true" onclick="addViewCheckout(this)">
                <h4 class="step-title completado">
                    <!-- <i class="icon-check-circle"></i> -->REGISTRO A CURSOS PAGADOS
                </h4>
            </a>


        </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="row no-gutters">
                    <div class="col-md-12" id="notify" data-offset-top="-1">
                        <div class=" px-3 justify-content-center align-items-center">
                            <form class="row">
                                <div class="col-sm-12 col-md-6 form-group text-center">
                                    <h6 class="text-muted text-lg text-uppercase bg-primary text-white">1.- INFORMACIÓN
                                    </h6>

                                </div>

                                <div class="col-sm-12 col-md-6 form-group">

                                </div>


                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="text-uppercase">Nombre del curso: <strong class="text-danger">*</strong></label>
                                    <select class="form-control form-control-2" id="name" name="name" required>
                                        <option value="">Selecciona una opcion</option>
                                        <option value="Planta Interna de Fibra Óptica">Planta Interna de Fibra Óptica
                                        </option>
                                        <option value="Planta Externa de Fibra Óptica">Planta Externa de Fibra Óptica
                                        </option>
                                        <option value="Método de Soplado">Método de Soplado</option>
                                        <option value="Fibra hasta el Usuario Redes Ópticas Pasivas">Fibra hasta el
                                            Usuario Redes Ópticas Pasivas</option>
                                        <option value="Cableado Estructurado">Cableado Estructurado </option>
                                        <option value="Certificación Partners">Certificación Partners</option>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="text-uppercase">Fecha: <strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="date" id="date" name="date">
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
                                                <option value=<?= $data->email ?>><?= $data->nombre . " " . $data->apellidos ?>
                                                </option>
                                            <?php


                                            };

                                            ?>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-12 form-group text-center">
                                    <ul>
                                        <p>Favor de indicar datos personales del participante ya que se les realizará el
                                            envió de la confirmación a través del
                                            correo electrónico y de un whatsapp personalizado. <b>Tomar en cuenta que la
                                                información que se proporcione
                                                aparecerá tal cual en los documentos que avalan el curso.</b> </p>

                                    </ul>
                                </div>
                                <br>
                                <br> <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-sm-12 col-md-6 form-group text-center">
                                    <h6 class="text-muted text-lg text-uppercase bg-primary text-white">2.- DATOS
                                        PERSONALES</h6>

                                </div>

                                <div class="col-sm-12 col-md-6 form-group">

                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="text-uppercase">Título: <strong class="text-danger">*</strong></label>
                                    <select class="form-control form-control-2" id="Titulo" required onchange="titulo(this.value)">
                                        <option value="">Seleccione un Título</option>
                                        <option value="Lic.">Lic.</option>
                                        <option value="Ing."> Ing. </option>
                                        <option value="Arq."> Arq. </option>
                                        <option value="Tec."> Tec. </option>
                                        <option value="Otro"> Otro </option>
                                    </select>
                                    <!-- <input class="form-control form-control-2" type="text" id="Titulo" name="Titulo"> -->
                                </div>
                                <div class="col-sm-12 col-md-6 form-group" style="display: none;" id="divOtro">
                                    <label class="text-uppercase">Otro: <strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" name="Otro" id="Otro">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="text-uppercase">Nombre: <strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" id="NombreSolicitud" name="NombreSolicitud">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="text-uppercase"> APELLIDO PATERNO: <strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" id="Ap" name="Ap">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="text-uppercase">APELLIDO MATERNO: <strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" id="Am" name="Am">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="text-uppercase">Empresa: <strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" id="Empresa" name="Empresa">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="text-uppercase">Puesto: <strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" id="Puesto" name="Puesto">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="text-uppercase">Teléfono: <strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" id="Telefono" name="Telefono" onkeyup="this.value=Numeros(this.value)">
                                </div>

                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="text-uppercase">Correo Empresarial: <strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="email" id="CorreoEmpresarial" name="CorreoEmpresarial">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="text-uppercase">Correo Personal: <strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="email" id="CorrePersonal" name="CorrePersonal">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label class="text-uppercase">WhatsApp personal: <strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" id="Whatsapp" name="Whatsapp" onkeyup="this.value=Numeros(this.value)">
                                </div>
                                <div class="col-sm-12 col-md-12 form-group">
                                <label>Anexar OC (en caso de crédito), comprobante de pago o factura del curso<strong class="text-danger">*</strong></label>
                                <input class="form-control form-control-2" type="file" id="file" accept="application/pdf">
                                </div>

                                <div class="col-sm-12 col-md-6 form-group" style="display: none;" id="divespacio"> </div>
                                <div class="col-md-6 margin-top-2x text-left">

                                    <h6 class="text-muted text-lg text-uppercase bg-primary text-white text-center">
                                        POLÍTICA DE CURSOS SPLITTEL:</h6>
                                    <hr class="margin-bottom-1x">
                                    <ul class="text-left">
                                        <p> <strong class="text-danger"> 1.</strong> Antes de pagar y/o realizar la
                                            factura del servicio, es necesario consultar disponibilidad de lugares, ya
                                            que los cursos tienen cupo limitado.</p>
                                        <p><strong class="text-danger"> 2.</strong> Para asegurar el lugar del
                                            participante, es necesario enviar OC (en caso de crédito), ficha de pago o
                                            depósito y/o factura del servicio (curso), además del registro en página web
                                            con los datos del participante, de lo contrario no se realizará el registro
                                            y el lugar quedará libre para otros interesados.
                                        </p>

                                        <p><strong class="text-danger"> 3.</strong> No se harán reembolsos. En caso de
                                            cancelación de asistencia por parte del cliente, la misma deberá ser con un
                                            mínimo de 2 días hábiles de anticipación previa a la semana de cursos. Por
                                            lo que, se podrá reprogramar la fecha de asistencia en otro ciclo de cursos
                                            impartido en las instalaciones de la empresa, únicamente con previa
                                            confirmación (solo 1 vez en un plazo máximo de 3 meses). En caso de no haber
                                            confirmación para reprogramación antes de cumplirse el plazo máximo se dará
                                            por perdido el curso.</p>
                                        <p><strong class="text-danger"> 4.</strong>Curso de cortesía: éste debe ser
                                            autorizado por gerencia, con validación de cupo antes de
                                            confirmación al cliente, deberá tomarlo en el mes en curso en el que fue
                                            autorizado, en caso
                                            de requerir reprogramación, ésta será únicamente 1 vez y en el ciclo
                                            inmediato (validando
                                            disponibilidad al momento de la reprogramación). En caso de que el cliente
                                            no se presente
                                            y no se cuente con notificación de ausencia, se procederá con el cobro total
                                            del curso.</p>
                                    </ul>
                                </div>
                                <div class="col-md-6 margin-top-2x">
                                    <h6 class="text-muted text-lg text-uppercase">&nbsp; </h6>
                                    <hr class="margin-bottom-1x">
                                    <ul class="text-left">
                                        <p><strong class="text-danger"> 5.</strong> El registro por participante es de
                                            manera individual por lo que, deberá presentarse de manera presencial
                                            únicamente la persona inscrita; No se permitirá el acceso a las
                                            instalaciones a cualquier otra persona ajena a la empresa que contrata el
                                            servicio.</p>

                                        <p><strong class="text-danger"> 6.</strong> Cuando surja algún cambio de
                                            participante, será necesario notificar a su ejecutivo de ventas y al correo
                                            marketing.directo@splittel.com con un mínimo de 24 hrs de anticipación, de
                                            lo contrario no se asegura la entrada del nuevo participante a las
                                            instalaciones.</p>
                                        <p><strong class="text-danger"> 7.</strong>En el caso de que el participante no
                                            se presente el día del curso y no haya previa notificación,
                                            se dará por pérdido el curso y no habrá posibilidad de reprogramación.</p>
                                        <p><strong class="text-danger"> 8.</strong> Para el certificado de
                                            participación, se tomará en cuenta el nombre del asistente y el de la
                                            empresa (nombre comercial) que aparezca en el registro de la página web.
                                        </p>
                                        <p><strong class="text-danger"> 9.</strong> En caso de extravió y/o requerir
                                            duplicado del certificado de participación, se proporcionará
                                            gratis de forma digital y/o impresa las veces que sea requerido de acuerdo a
                                            la solicitud del
                                            cliente con los datos de emisión originales.</p>
                                        <p><strong class="text-danger"> 10.</strong>Para emitir el formato DC3 y
                                            certificado de participación, el asistente deberá llenar el
                                            formato antes de finalizar el curso y aprobarlo con una calificación mínima
                                            de 80/100 en
                                            examen final, el instructor firmará y entregará el certificado con validez
                                            ante la STPS 24
                                            horas después del curso.</p>

                                    </ul>
                                </div>
                                <br> <br>
                                <br>

                                <br>
                                <div class="col-sm-12 col-md-12 form-group text-center">
                                    <hr class="margin-bottom-1x">
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="apple" onchange="Politica(this)">
                                        <label class="custom-control-label" for="apple"> He leído y acepto </label>
                                    </div>
                                    <hr class="margin-bottom-1x">

                                    <button type="button" id="botonenviar" class="btn btn-primary " onclick="EnviarAlta()">Enviar</button>

                                </div>
                                <div class="col-md-8 margin-top-2x text-left">
                                    <h6 class="text-muted text-lg text-uppercase bg-primary text-white text-center">
                                        CONTACTO</h6>

                                    <hr class="margin-bottom-1x">
                                    <ul>
                                        <p>FIBREMEX S.A. DE C.V.
                                            Parque Tecnológico Innovación Querétaro, Carretera Estatal 431, km.2+200,
                                            Int. 28,
                                            C.P. 76246 Querétaro, Qro. Tel.: 800 800 00 11 Local : (442) 220 80 46
                                            Email: ventas@fibremex.com.mx</p>

                                    </ul>
                                </div>

                                <br>
                                <br>
                                <br> <br>
                                <br>
                                <br>
                                <br>
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
    <script type="text/javascript" src="../../public/scripts/cursos/alta.js?id=<?php echo rand() ?>"></script>
</body>

</html>
<?php
unset($Contacto);
unset($ContactoController);
?>