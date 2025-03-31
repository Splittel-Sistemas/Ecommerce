<!DOCTYPE html>
<html lang="es">

<head>

    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Head.php'; ?>
    <!--  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Start of HubSpot Embed Code -->
    <script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/24007482.js"></script>
    <!-- End of HubSpot Embed Code —>

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

    <div class="container ">
        <div class="row ">
            <div class="col-1  text-center">
            </div>
            <div class="col-10 text-center">
                <img class="rounded" src="../../public/images/img_spl/ficrece/BannerFibre.jpg">
            </div>

        </div>
        <div class="steps flex-sm-nowrap mb-5">
            <a class="step process active" id="process-1" number="1" data-toggle="pill" data-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true" onclick="addViewCheckout(this)">
                <h4 class="step-title completado">
                    </i>RECEPCIÓN DE EQUIPO
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
                                    <h3>1.- INFORMACION DEL CLIENTE.</h3>
                                </div>




                                <div class="col-sm-12 col-md-6 form-group">
                                    <label>Nombre de la empresa: <strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" id="Empresa" name="Empresa">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label>Estado:<strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" id="Estado" name="Estado">
                                </div>

                                <div class="col-sm-12 col-md-6 form-group">
                                    <label>Contacto:<strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" id="Contacto" name="Contacto">
                                </div>

                                <div class="col-sm-12 col-md-6 form-group">
                                    <label>Correo:<strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="email" id="Correo" name="Correo">
                                </div>

                                <div class="col-sm-12 col-md-6 form-group">
                                    <label>Teléfono:<strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" id="Telefono" name="Telefono" onkeyup="this.value=Numeros(this.value)">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label for="validationCustom06">Ejecutivo <strong class="text-danger">*</strong></label>
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
                                <br>
                                <br> <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-sm-12 col-md-12 form-group">
                                    <h3>2.- SERVICIO A SOLICITAR:<strong class="text-danger">*</strong></h3>
                                </div>
                                <div class="col-sm-12 col-md-12 form-group text-center">

                                    <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                                        <input class="custom-control-input" type="checkbox" name="checks[]" value="Mantenimiento" id="Mantenimiento">
                                        <label class="custom-control-label" for="Mantenimiento">Mantenimiento</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                                        <input class="custom-control-input" type="checkbox" name="checks[]" value="Reparación" id="Reparación">
                                        <label class="custom-control-label" for="Reparación">Reparación </label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                                        <input class="custom-control-input" type="checkbox" name="checks[]" value="Calibración" id="Calibración">
                                        <label class="custom-control-label" for="Calibración">Calibración</label>
                                    </div>
                                    <div class="custom-control custom-checkbox custom-control-inline  col-md-2">
                                        <input class="custom-control-input" type="checkbox" name="checks[]" value="Garantía" id="Garantía">
                                        <label class="custom-control-label" for="Garantía">Garantía</label>
                                    </div>

                                </div>

                                <div class="col-sm-12 col-md-12 form-group pt-3">
                                    <h3>3.- DATOS DEL EQUIPO:</h3>
                                </div><br>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label>Marca<strong class="text-danger">*</strong></label>
                                    <input class="form-control form-control-2" type="text" id="Marca" name="Marca">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label>Modelo <strong class="text-danger"></strong></label>
                                    <input class="form-control form-control-2" type="text" id="Modelo" name="Modelo">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label>Número de serie <strong class="text-danger"></strong></label>
                                    <input class="form-control form-control-2" type="text" id="serie" name="serie" maxlength="150">
                                </div>

                                <div class="col-sm-12 col-md-12 form-group  pt-3">
                                    <h3>4.- OBSERVACIONES PARA EL SERVICIO (detallar lo más posible)<strong class="text-danger">*</strong> </h3>
                                </div>
                                <div class="col-sm-12 col-md-12 form-group">
                                    <textarea class="form-control form-control-2" name="observaciones" id="observaciones" rows="1"></textarea>

                                </div>


                                <div class="col-sm-12 col-md-12 form-group  pt-3">
                                    <h3>5.- ACCESORIOS (favor de especificar accesorios que acompañan al equipo) </h3>
                                </div>
                                
                                <div class="col-sm-12 col-md-12 form-group text-center">
                                    <table id="tableId" class="display table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Cantidad</th>
                                                <th>No. Serie</th>
                                                <th>Descripción</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="rows">
                                            <tr>
                                                <td><input id="cantidad" type="text" class="form-control" /></td>
                                                <td><input id="nserie" type="text" class="form-control" /></td>
                                                <td><textarea name="" id="desc"  rows="3" class="form-control" ></textarea></td>
                                                <td></td>

                                            </tr>
                                            <!-- Puedes agregar más filas aquí -->
                                        </tbody>
                                    </table>
                                    <input name="valoresAccesorios" type="hidden" class="form-control" id="valoresAccesorios" />
                                </div>
                                <div class="col-sm-12 col-md-12 form-group text-center">
                                <button type="button" class=" btn btn-info bg-gradient-success btn-sm add_form_field">AGREGAR ACCESORIOS</button>
                                </div>
                                
                                <div class="col-sm-12 col-md-12 form-group pt-3">
                                    <h3>REGISTRO DE RECEPCION DE EQUIPO (ASEGURAMIENTO DE LA CALIDAD):</h3>
                                </div><br>
                               
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label>Paquetería <strong class="text-danger"></strong></label>
                                    <input class="form-control form-control-2" type="text" id="paqueteria" name="paqueteria">
                                </div>
                                <div class="col-sm-12 col-md-6 form-group">
                                    <label>Numero de guía<strong class="text-danger"></strong></label>
                                    <input class="form-control form-control-2" type="text" id="guia" name="guia" >
                                </div>


                                <div class="col-sm-12 col-md-12 form-group text-center">
                                    <button type="button" id="botonenviar" class="btn btn-primary " onclick="Enviar()">Enviar Solicitud</button>
                                </div>

                                <br>
                                <div class="col-sm-12 col-md-6 form-group ">

                                    <p><strong>&nbsp;</strong></p>
                                    <p class="text-center"><strong>INSTRUCCIONES DE ENVÍO:</strong></p>
                                    <ul>
                                        <li>Mandar el equipo empaquetado apropiadamente para evitar daños durante su
                                            transporte.</li>

                                    </ul>
                                </div>

                                <div class="col-sm-12 col-md-6 form-group ">

                                    <p><strong>&nbsp;</strong></p>
                                    <p><strong>&nbsp;</strong></p>

                                    <table >
                                        <tbody>
                                            <tr>

                                                <td>
                                                    <p>FIBREMEX SA DE CV&nbsp; / OPTRONICS SA DE CV</p>
                                                    <p>PARQUE TECNOLOGICO INNOVACION QUERETARO</p>
                                                    <p>Lateral de la carretera Estatal 431 km., 2+200, Int 28, El
                                                        Marqués, Qro. 76246</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <p><strong><br></strong></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>
    <script>
    $(document).ready(function() {
        var table =     $('#tableId').DataTable({
                paging: false, // Deshabilita la paginación
                searching: false, // Deshabilita la búsqueda
                info: false, // Deshabilita la información de registros
                lengthChange: false, // Deshabilita el control de longitud
                buttons: [], // Deshabilita todos los botones
                ordering: false, // Deshabilita el ordenamiento
            });
      var i = 1
      // Evento para el botón de agregar fila
      $(".add_form_field").click(function(e) {
        e.preventDefault();

        // ... Código existente para agregar nueva fila ...
        // Agregar la fila a DataTables
        table.row.add([
          // Contenido de las celdas en la nueva fila
          ' <td><input id="cantidad' + i + '" class="form-control " type="text"    /></td>',
          '<td ><input id="nserie' + i + '" class="form-control " type="text" /></td>',
          ' <td><textarea name="" id="desc' + i + '"  rows="3" class="form-control" ></textarea></td>',

          // ...
          '<button type="button" class="btn btn-danger btn-sm eliminar">Eliminar</button>'

        ], ).draw();


        i++;

      });

      // Evento para el botón de eliminar fila
      $("#tableId tbody").on("click", ".eliminar", function() {
        // Obtener el índice de la fila que se eliminará
        var rowIndex = table.row($(this).parents("tr")).index();

        // Eliminar la fila de DataTables
        table.row(rowIndex).remove().draw();
      });


    });

   
  </script>

    <script>
      
    </script>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Scripts.php'; ?>

    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="../../public/scripts/Os/alta.js?id=<?php echo rand() ?>"></script>
</body>

</html>
<?php
unset($Contacto);
unset($ContactoController);
?>