<?php
	if (!class_exists("TemplatePrincipal")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Principal.php';
	}if (!class_exists("PrecalificacionController")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Login/Solicitud/Precalificacion.Controller.php';
	}if (!class_exists("Precalificacion_")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Login/Solicitud/Precalificacion_.Model.php';
	}

	class TemplatePrecalificacion{
		/**
		 * Estructura correo para pedidos Ecommerce
		 *
		 * @param string $a Foo
		 *
		 * @return int $b Bar
		 */
		protected $Key;

		public function SetKey($Key){
			$this->Key = $Key;
		}

		public function body(){
			try {

				$PrecalificacionController = new PrecalificacionController();
				$PrecalificacionController->filter = "WHERE t22_pk01 = ".$this->Key." ";
				$PrecalificacionController->order = "";
				$Precalificacion = $PrecalificacionController->GetBy_();

				$Principal = new TemplatePrincipal();
				$html = $Principal->Head().'<body class="">
								<span class="preheader">Ecommerce Grupo Splittel</span>
								
								<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
									<tr>
										<td>&nbsp;</td>
										<td class="container">
											<div class="content">

												<!-- START CENTERED WHITE CONTAINER -->
												<table role="presentation" class="main">

													<!-- START MAIN CONTENT AREA -->
													<tr>
														<td><img class="banner-img" width="800" src="http://www.fibremex.com/ecomfmx/public.jpg" alt=""></td>
													</tr>
													<tr>
														<td class="wrapper">															
															<table role="presentation" border="0" cellpadding="0" cellspacing="0">
																<tbody>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Nombre de la empresa</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$Precalificacion->NombreFacturacion.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Contacto</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$Precalificacion->NombreComercial.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Telefono</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$Precalificacion->RFC.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Giro</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$Precalificacion->DireccionFacturacion.'</td>
																	</tr>
																	<!--
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Código Postal</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.''/*$Precalificacion->CodigoPostal*/.'</td>
																	</tr>
																	-->
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Correo eléctronico</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$Precalificacion->Correo.'</td>
																	</tr>
																	<!--
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Nombre del contacto, título y departamento</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$Precalificacion->Contacto.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Télefono (s) de oficina</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$Precalificacion->TelefonoOficina.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Télefono (s) movil</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$Precalificacion->TelefonoMovil.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Página web</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$Precalificacion->PaginaWeb.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Dirección de oficina</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$Precalificacion->DireccionOficina.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Giró Empresa</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.''/*$Precalificacion->GiroEmpresaDescripcion*/.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Presencia</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.''/*$Precalificacion->PresenciaDescripcion*/.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">No. de empleados aproximado</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.''/*$Precalificacion->NumeroEmpleadosDescripcion*/.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Experiencia en el mercado (años)</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.''/*$Precalificacion->ExperienciaMercadoDescripcion*/.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Proyectos</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$Precalificacion->Proyectos.'</td>
																	</tr>	
																	-->
																</tbody>
															</table><br>	
															<!--
															<p style="font-weight: bold;">Integras soluciones como</p><br>										
															<table role="presentation" border="0" cellpadding="0" cellspacing="0">
																<tbody>';

																$PrecalificacionController = new PrecalificacionController();
																$PrecalificacionController->filter = "WHERE t22_pk01 = ".$this->Key." AND t90_pk01 = 8 ";
																$PrecalificacionController->order = "";
																$ResultPrecalificacion = $PrecalificacionController->GetChecks();

																foreach ($ResultPrecalificacion->records as $key => $Precalificacion) {
																	$checked = $Precalificacion->Check == 1 ? 'checked' : '';																	
																	$html .= '<tr style="width:100%;">
																			<td style="margin-bottom: 10px; text-align: left; max-width:25%;">
																				<input type="checkbox" id="'.$Precalificacion->SubdefinicionesKey.'" name="'.$Precalificacion->SubdefinicionesKey.'" '.$checked.'>
																				<label for="'.$Precalificacion->SubdefinicionesKey.'">'.$Precalificacion->SubdefinicionesDescripcion.'</label><br>
																			</td>
																			</td>
																		</tr>';
																}
																$html .= '</tbody>
															</table><br>
															-->
															<!--
															<p style="font-weight: bold;">Distribuyes/utilizas productos</p><br>										
															<table role="presentation" border="0" cellpadding="0" cellspacing="0">
															<tbody>';

															$PrecalificacionController = new PrecalificacionController();
															$PrecalificacionController->filter = "WHERE t22_pk01 = ".$this->Key." AND t90_pk01 = 9 ";
															$PrecalificacionController->order = "";
															$ResultPrecalificacion = $PrecalificacionController->GetChecks();

															foreach ($ResultPrecalificacion->records as $key => $Precalificacion) {
																$checked = $Precalificacion->Check == 1 ? 'checked' : '';																	
																$html .= '<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:25%;">
																			<input type="checkbox" id="'.$Precalificacion->SubdefinicionesKey.'" name="'.$Precalificacion->SubdefinicionesKey.'" '.$checked.'>
																			<label for="'.$Precalificacion->SubdefinicionesKey.'">'.$Precalificacion->SubdefinicionesDescripcion.'</label><br>
																		</td>
																		</td>
																	</tr>';
															}
															$html .= '</tbody>
															</table><br>
															-->
															<!--
															<p style="font-weight: bold;">Sector o tipo de clientes que atienden</p><br>										
															<table role="presentation" border="0" cellpadding="0" cellspacing="0">
															<tbody>';

															$PrecalificacionController = new PrecalificacionController();
															$PrecalificacionController->filter = "WHERE t22_pk01 = ".$this->Key." AND t90_pk01 = 10 ";
															$PrecalificacionController->order = "";
															$ResultPrecalificacion = $PrecalificacionController->GetChecks();

															foreach ($ResultPrecalificacion->records as $key => $Precalificacion) {
																$checked = $Precalificacion->Check == 1 ? 'checked' : '';																	
																$html .= '<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:25%;">
																			<input type="checkbox" id="'.$Precalificacion->SubdefinicionesKey.'" name="'.$Precalificacion->SubdefinicionesKey.'" '.$checked.'>
																			<label for="'.$Precalificacion->SubdefinicionesKey.'">'.$Precalificacion->SubdefinicionesDescripcion.'</label><br>
																		</td>
																		</td>
																	</tr>';
															}
															$html .= '</tbody>
															</table><br>
															-->
															<div style="text-align:right">
															<div style="float: right">
															</div>
															</div>
															<p><br></p>
															<p align="center">Este es un correo electrónico generado automáticamente</p>
														</td>
													</tr>

												<!-- END MAIN CONTENT AREA -->
												</table>
												<!-- END CENTERED WHITE CONTAINER -->

												<!-- START FOOTER -->
												<div class="footer">
													<table role="presentation" border="0" cellpadding="0" cellspacing="0">
														<tr>
															<td class="content-block">
																<span class="apple-link">Grupo Splittel</span>
																<br> Parque Tecnológico Innovación Querétaro Lateral de la carretera Estatal 431, km.2+200, Int.28, 76246 Santiago de Querétaro, Qro.<a href="http://splittel.com">Grupo Splittel</a>.
															</td>
														</tr>
														<tr>
															<td class="content-block powered-by">
																</a>
															</td>
														</tr>
													</table>
												</div>
												<!-- END FOOTER -->

											</div>
										</td>
										<td>&nbsp;</td>
									</tr>
								</table>
							</body>
						</html>';
				return $html;
			} catch (Exception $e) {
				throw $e;
			}
		}

	}

