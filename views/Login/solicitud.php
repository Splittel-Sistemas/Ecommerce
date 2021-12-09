<!DOCTYPE html>
<html lang="es">
	<head>
		<?php 
			include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Login/seguridad.php';     
			include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php';    
		?>
		<!-- font-awesome CSS -->
		<link rel="stylesheet" type="text/css" href="../../public/plugins/font-awesome/css/fontawesome-all.min.css">
		<!-- fileinput-rtl.min CSS -->
		<link rel="stylesheet" type="text/css" href="../../public/plugins/file-input/css/fileinput.min.css">
	</head>
	<!-- Body-->
	<body>
		<!-- Page Content-->
		<div class="row no-gutters">
			<div class="col-md-12 fh-section" style="background-image: url(../../public/images/Otros/catalogo.jpg); height: 50vh !important;">
				<span class="overlay" style="background-color: #000; opacity: .7;"></span>
				<div class="d-flex flex-column fh-section py-5 px-3 justify-content-between" style="height: 50vh !important;">
					<div class="w-100 text-center">
					</div>
					<div class="w-100 text-center mt-5">
						<p class="text-white mb-2">01 800 800 0011</p><a class="navi-link-light" href="mailto:ventas@fibremex.com.mx">ventas@fibremex.com.mx</a>
						<div class="pt-3">
							<a class="social-button shape-circle sb-facebook sb-light-skin" href="https://www.facebook.com/Fibremex" target="_blank"><i class="socicon-facebook"></i></a>
							<a class="social-button shape-circle sb-twitter sb-light-skin" href="https://twitter.com/Fibremexx" target="_blank"><i class="socicon-twitter"></i></a>
							<a class="social-button shape-circle sb-instagram sb-light-skin" href="https://www.instagram.com/fibremex/" target="_blank"><i class="socicon-instagram"></i></a>
							<a class="social-button shape-circle sb-google-plus sb-light-skin" href="https://mx.linkedin.com/company/fibremex-s-a-de-c-v-" target="_blank"><i class="socicon-linkedin"></i></a>
							<a class="social-button shape-circle sb-google-plus sb-light-skin" href="https://www.youtube.com/channel/UCb-quhJT0AqywnRBw1n4jiA" target="_blank"><i class="socicon-youtube"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<div class="row mt-5 no-gutters" id="dataInterna" primero="<?php echo $_SESSION['AuthUser']; ?>" segundo="<?php echo $_SESSION['AuthPassword']; ?>">
			<div class="col-12 offset-lg-2 col-lg-8">
				<div class="card px-3 shadow p-3 mb-5 bg-white rounded">
					<div class="card-body">
						<div class="row no-gutters mb-3">
							<div class="col-12">
								<div class="d-flex justify-content-center justify-content-md-end">
									<span class="align-middle"><a class="social-button shape-circle sb-facebook" href="../Home" ><i class="icon-home"></i></a>Home</span>
								</div>
							</div>
						</div>
						<div class="h1 text-normal mb-5 text-center">Solicitud Precalificación</div>
						<form class="row" id="form-solicitud-precalificacion">
							<!-- Nombre de facturación (Física/ Moral): -->
							<div class="form-group col-12 col-sm-6">
								<input class="form-control form-control-pill" type="text" id="NombreFacturacion" name="NombreFacturacion" placeholder="Nombre de facturación (Física/ Moral):" autocomplete="off" required>
							</div>
							<!-- RFC -->
							<div class="form-group col-12 col-sm-6">
								<input class="form-control form-control-pill" type="text" id="RFC" name="RFC" placeholder="RFC" autocomplete="off" required style="text-transform: uppercase;">
							</div>
							<!-- Nombre Comercial -->
							<div class="form-group col-12 col-sm-6">
								<input class="form-control form-control-pill" type="text" id="NombreComercial" name="NombreComercial" placeholder="Nombre Comercial" autocomplete="off" required>
							</div>
							<!-- Dirección de facturación -->
							<div class="form-group col-12 col-sm-6">
								<input class="form-control form-control-pill" type="text" id="DireccionFacturacion" name="DireccionFacturacion" placeholder="Dirección de facturación" autocomplete="off" required>
							</div>
							<!-- Codigo Postal Facturación -->
							<div class="form-group col-12 col-sm-6">
								<input class="form-control form-control-pill" type="text" id="CodigoPostal" name="CodigoPostal" placeholder="Codigo Postal Facturación" autocomplete="off" required>
							</div>
							<!-- Correo electrónico -->
							<div class="form-group col-12 col-sm-6">
								<input class="form-control form-control-pill" type="email" id="Correo" name="Correo" placeholder="Correo electrónico" autocomplete="off" required>
							</div>
							<!-- Nombre del contacto, título y departamento: -->
							<div class="form-group col-12">
								<textarea class="form-control form-control-pill" id="Contacto"  name="Contacto" cols="30" rows="3" placeholder="Nombre del contacto, título y departamento:"></textarea>
							</div>
							<!-- Teléfono (s) de oficina/ móvil: -->
							<div class="form-group col-12 col-sm-6">
								<input class="form-control form-control-pill" type="text" id="TelefonoOficina" name="TelefonoOficina" placeholder="Teléfono (s) de oficina/ móvil:" autocomplete="off" required>
							</div>
							<!-- Teléfono (s) móvil: -->
							<div class="form-group col-12 col-sm-6">
								<input class="form-control form-control-pill" type="text" id="TelefonoMovil" name="TelefonoMovil" placeholder="Teléfono (s) móvil:" autocomplete="off" required>
							</div>
							<!-- Página Web -->
							<div class="form-group col-12 col-sm-6">
								<input class="form-control form-control-pill" type="text" id="PaginaWeb" name="PaginaWeb" placeholder="Página Web" autocomplete="off" required>
							</div>
							<!-- Dirección Oficina -->
							<div class="form-group col-12 col-sm-6">
								<input class="form-control form-control-pill" type="text" id="DireccionOficina" name="DireccionOficina" placeholder="Dirección Oficina" autocomplete="off" required>
							</div>
							<!-- Giró Empresa -->
							<div class="form-group col-12 col-sm-6">
								<label>Giró Empresa</label>
								<select class="form-control form-control-pill" id="GiroEmpresa" name="GiroEmpresa">
								<?php 
									if (!class_exists("SubdefinicionesController")) {
										include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Jumpers/Subdefiniciones.Controller.php';
									}
									$SubdefinicionesController = new SubdefinicionesController();
									$SubdefinicionesController->filter = "WHERE t90_pk01 = 7 ";
									$SubdefinicionesController->order = "";
									$ResultSubdefiniciones = $SubdefinicionesController->Get();

									foreach ($ResultSubdefiniciones->records as $Subdefiniciones) {
								?>
									<option value="<?php echo $Subdefiniciones->Key ?>"> <?php echo $Subdefiniciones->Descripcion ?> </option>
								<?php }  ?>
								</select>
							</div>
							 <!-- Presencia -->
							 <div class="form-group col-12 col-sm-6">
								<label>Presencia</label>
								<select class="form-control form-control-pill" id="Presencia" name="Presencia">
								<?php 
									$SubdefinicionesController = new SubdefinicionesController();
									$SubdefinicionesController->filter = "WHERE t90_pk01 = 11 ";
									$SubdefinicionesController->order = "";
									$ResultSubdefiniciones = $SubdefinicionesController->Get();

									foreach ($ResultSubdefiniciones->records as $Subdefiniciones) {
								?>
									<option value="<?php echo $Subdefiniciones->Key ?>"> <?php echo $Subdefiniciones->Descripcion ?> </option>
								<?php }  ?>
								</select>
							</div>
							<!-- Número de empleados -->
							<div class="form-group col-12 col-sm-6">
								<label>No. de empleados aproximado</label>
								<select class="form-control form-control-pill" id="NumeroEmpleados" name="NumeroEmpleados">
								<?php 
									$SubdefinicionesController = new SubdefinicionesController();
									$SubdefinicionesController->filter = "WHERE t90_pk01 = 12 ";
									$SubdefinicionesController->order = "";
									$ResultSubdefiniciones = $SubdefinicionesController->Get();

									foreach ($ResultSubdefiniciones->records as $Subdefiniciones) {
								?>
									<option value="<?php echo $Subdefiniciones->Key ?>"> <?php echo $Subdefiniciones->Descripcion ?> </option>
								<?php }  ?>
								</select>
							</div>
							<!-- Experiencia en el mercado -->
							<div class="form-group col-12 col-sm-6">
								<label>Experiencia en el mercado (años)</label>
								<select class="form-control form-control-pill" id="ExperienciaMercado" name="ExperienciaMercado">
								<?php 
									$SubdefinicionesController = new SubdefinicionesController();
									$SubdefinicionesController->filter = "WHERE t90_pk01 = 13 ";
									$SubdefinicionesController->order = "";
									$ResultSubdefiniciones = $SubdefinicionesController->Get();
									
									foreach ($ResultSubdefiniciones->records as $Subdefiniciones) {
										?>
									<option value="<?php echo $Subdefiniciones->Key ?>"> <?php echo $Subdefiniciones->Descripcion ?> </option>
								<?php }  ?>
								</select>
							</div>
							<!-- Integras soluciones como -->
							<div class="form-group col-12">
								<label>Integras soluciones como</label>
							</div>
							<?php 
									$SubdefinicionesController = new SubdefinicionesController();
									$SubdefinicionesController->filter = "WHERE t90_pk01 = 8 ";
									$SubdefinicionesController->order = "";
									$ResultSubdefiniciones = $SubdefinicionesController->Get();

									foreach ($ResultSubdefiniciones->records as $Subdefiniciones) {
										?>
							<div class="custom-control custom-checkbox col-12 col-sm-3">
								<input class="custom-control-input respuesta-integras-soluciones" type="checkbox" preguntakey="<?php echo $Subdefiniciones->Key ?>" preguntakey="<?php echo $Subdefiniciones->Key ?>" id="integras-soluciones-<?php echo $Subdefiniciones->Key ?>" value="1">
								<label class="custom-control-label" for="integras-soluciones-<?php echo $Subdefiniciones->Key ?>"><?php echo $Subdefiniciones->Descripcion ?></label>
							</div>
							<?php }  ?>
							<!-- Distribuyes/utilizas productos  -->
							<div class="form-group col-12">
								<label>Distribuyes/utilizas productos </label>
							</div>
							<?php 
									$SubdefinicionesController = new SubdefinicionesController();
									$SubdefinicionesController->filter = "WHERE t90_pk01 = 9 ";
									$SubdefinicionesController->order = "";
									$ResultSubdefiniciones = $SubdefinicionesController->Get();
									
									foreach ($ResultSubdefiniciones->records as $Subdefiniciones) {
								?>
							<div class="custom-control custom-checkbox col-12 col-sm-3">
								<input class="custom-control-input respuesta-productos" type="checkbox" preguntakey="<?php echo $Subdefiniciones->Key ?>" id="productos-<?php echo $Subdefiniciones->Key ?>" value="1">
								<label class="custom-control-label" for="productos-<?php echo $Subdefiniciones->Key ?>"><?php echo $Subdefiniciones->Descripcion ?></label>
							</div>
							<?php }  ?>
							<!-- Sector o tipo de clientes que atienden  -->
							<div class="form-group col-12">
								<label>Sector o tipo de clientes que atienden </label>
							</div>
							<?php 
									$SubdefinicionesController = new SubdefinicionesController();
									$SubdefinicionesController->filter = "WHERE t90_pk01 = 10 ";
									$SubdefinicionesController->order = "";
									$ResultSubdefiniciones = $SubdefinicionesController->Get();

									foreach ($ResultSubdefiniciones->records as $Subdefiniciones) {
								?>
							<div class="custom-control custom-checkbox col-12 col-sm-3">
								<input class="custom-control-input respuesta-tipo-clientes" type="checkbox" preguntakey="<?php echo $Subdefiniciones->Key ?>" id="tipo-clientes-<?php echo $Subdefiniciones->Key ?>" value="1">
								<label class="custom-control-label" for="tipo-clientes-<?php echo $Subdefiniciones->Key ?>"><?php echo $Subdefiniciones->Descripcion ?></label>
							</div>
							<?php }  ?>
							<!-- Proyectos Destacados o en puerta: -->
							<div class="form-group col-12 mt-3">
								<textarea class="form-control form-control-pill" id="Proyectos"  name="Proyectos" cols="30" rows="3" placeholder="Proyectos Destacados o en puerta:"></textarea>
							</div>
							<!-- Anexar constancia de situación fiscal (pdf o imagen)  -->
							<div class="form-group col-12 mt-3">
								<label>Anexar constancia de situación fiscal (pdf o imagen) </label>
							</div>
							<div class="col-sm-12">
								<div class="file-loading">
									<input type="file" id="situacion-fiscal" name="situacion-fiscal">
								</div>
							</div>
						</form>
							<div class="custom-control custom-checkbox col-12 mt-5" style=" display: flex; justify-content: center;">
								<input class="custom-control-input" type="checkbox" id="aviso-privacidad">
								<label class="custom-control-label" for="aviso-privacidad"><strong>	AVISO DE CONFIDENCIALIDAD</strong></label>
							</div>
						
						<p class="text-center">
						Splittel Holding S. de R.L. de C.V. con domicilio en Parque Tecnológico Innovación Querétaro, 
						Lateral de la carretera Estatal 431, km.2+200, Int.28, C.P.76246. 
						Es responsable del tratamiento de sus datos personales, 
						los cuales utilizará para los siguientes fines: Proveer los servicios y productos que usted ha solicitado, 
						compartir con usted material informativo y publicitario y evaluar la calidad de nuestros servicios. 
						Para mayor información acerca del tratamiento y de los derechos que puede hacer valer, 
						usted puede acceder al aviso de privacidad completo a través de <a href="https://www.fibremex.com/mailblast/MailBlast2014/cartaconfidencial/ley.pdf" target="_blank"> Ley de privacidad </a>.
						</p>
						<button type="button" class="btn btn-primary mt-5" onclick="Enviar()">Enviar</button>
					</div>
				</div>
			</div>
		</div>
		<!-- scripts JS -->
		<?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
		<!-- fileinput JS -->
		<script type="text/javascript" src="../../public/plugins/file-input/js/fileinput.min.js"></script>
		<!-- fileinput locales español JS -->
		<script type="text/javascript" src="../../public/plugins/file-input/js/locales/es.js"></script>
		<!-- fileinput theme bootstrap 4 JS  -->
		<script type="text/javascript" src="../../public/plugins/file-input/themes/explorer-fas/theme.min.js"></script>
		<!--  -->
		<script type="text/javascript" src="../../public/scripts/Login/solicitud_precalificacion.js?id=<?php echo rand() ?>"></script>
	</body>
</html>