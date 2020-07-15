<?php
	if (!class_exists("TemplatePrincipal")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Principal.php';
	}if (!class_exists("PuntosProductosController")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Puntos/PuntosProductos.Controller.php';
	}

	class TemplateCanjeoPuntos{
		/**
		 * Estructura correo para pedidos Ecommerce
		 *
		 * @param string $a Foo[Ecommerce-ClienteNombre]
		 *
		 * @return int $b Bar
		 */

		public function body($data){
			try {

				$PuntosProductosController = new PuntosProductosController();
				$PuntosProductosController->filter = "WHERE id = ".$data['Key']." ";
				$ResultPuntosProductos = $PuntosProductosController->GetBy();

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
															<p align="center">Información Producto</p><br>														
															<table role="presentation" border="0" cellpadding="0" cellspacing="0">
																<tbody>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Descripción</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$ResultPuntosProductos->Descripcion.'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Total de puntos</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$ResultPuntosProductos->Puntos.'</td>
																	</tr>
																</tbody>
															</table><br>	
														</td>
													</tr>
													<tr>
														<td class="wrapper">	
															<p align="center">Datos de envio</p><br>														
															<table role="presentation" border="0" cellpadding="0" cellspacing="0">
																<tbody>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Nombre</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$data['Nombre'].'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Correo</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$data['Correo'].'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Teléfono</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$data['Telefono'].'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Ciudad</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$data['Ciudad'].'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Calle</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$data['Calle'].'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Numero Exterior</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$data['NoExt'].'</td>
																	</tr>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: left; max-width:30%; font-weight: bold;">Colonia</td>
																		<td style="margin-bottom: 10px; text-align: left; max-width:70%;">'.$data['Colonia'].'</td>
																	</tr>
																</tbody>
															</table><br>	
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

