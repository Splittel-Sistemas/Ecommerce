<?php
	if (!class_exists("TemplatePrincipal")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Principal.php';
	}if (!class_exists('DetalleController')) {
		include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Detalle.Controller.php';
	}if (!class_exists('PedidoController')) {
		include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
	}

	class TemplatePedido{
		/**
		 * Estructura correo para pedidos Ecommerce
		 *
		 * @param string $a Foo
		 *
		 * @return int $b Bar
		 */
		public function body(){
			try {
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
															<p align="center">¡Gracias por su orden!</p><br>
															
															<table role="presentation" border="0" cellpadding="0" cellspacing="0">
																<tbody>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: center; max-width:33%;"></td>
																		<td style="margin-bottom: 10px; text-align: center; max-width:33%;"><img src="http://www.fibremex.com/ecomfmx/check.jpg" width="50" height="50"></td>
																	</tr>
																</tbody>
															</table><br>
															<table role="presentation" border="0" cellpadding="0" cellspacing="0">
																 <thead>
																	<tr style="width:100%;">
																		<th style="margin-bottom: 20px; text-align: left; max-width:20%;">Código</th>
																		<th style="margin-bottom: 20px; text-align: left; max-width:50%;">Descripción</th>
																		<th style="margin-bottom: 20px; max-width:10%;">Cantidad</th>
																		<th style="margin-bottom: 20px; max-width:10%;">Subtotal</th>
																		<th style="margin-bottom: 20px; max-width:10%;">Moneda</th>
																	</tr>
																</thead>
																<tbody>';
																$DetalleController = new DetalleController();
																$Obj = $DetalleController->GetDetallePedido();

																if($Obj->count > 0){
																	foreach ($Obj->records as $key => $data) {
																		$detalleSubtotal = $data->PedidoMonedaPago == "USD" ? $data->DetalleSubtotal : $data->DetalleSubtotalMXN;
																		$descripcion = !empty($data->ProductoDescripcion) ? $data->ProductoDescripcion : $data->ProductoConfigurableNombre;
																		$html .= '<tr style="width:100%;">
																			<td style="margin-bottom: 10px; text-align: left; max-width:20%;">'. $data->DetalleCodigo .'</td>
																			<td style="margin-bottom: 10px; text-align: left; max-width:50%;">'. $descripcion .'</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;">'. $data->DetalleCantidad .'</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;"> $'.$detalleSubtotal .'</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;">'. $data->PedidoMonedaPago .'</td>
																		</tr>';
																	}

																	$PedidoController = new PedidoController;
																	$PedidoController->filter = "WHERE id = ".$_SESSION["Ecommerce-PedidoKey"]." ";
																	$PedidoController->order = "";
																	# obtención de subtotal iva y total del pedido actual
																	$Pedido = $PedidoController->getBy();
																	
																	if($Pedido->MonedaPago == "USD"){
																		$pedidoSubtotal = $Pedido->GetSubTotal();
																		$pedidoIva = $Pedido->GetIva();
																		$pedidoTotal = $Pedido->GetTotal(); 
																	}else{
																		$pedidoSubtotal = $Pedido->GetSubTotalMXN();
																		$pedidoIva = $Pedido->GetIvaMXN();
																		$pedidoTotal = $Pedido->GetTotalMXN(); 
																	}


															$html .= '<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:50%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Subtotal</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $'.$pedidoSubtotal .' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">'. $Pedido->GetMonedaPago() .'</td>
																				</tr>
																				<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:50%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Iva</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $'.$pedidoIva .' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">'. $Pedido->GetMonedaPago() .'</td>
																				</tr>
																				<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:50%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Total</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $'.$pedidoTotal .' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">'. $Pedido->GetMonedaPago() .'</td>
																				</tr>';
								 
																}
																unset($DetalleController);
																unset($Obj);
																unset($PedidoController);
																unset($Pedido);
																$html .= '</tbody>
															</table>
															<br>
																						<div class="row padding-top-1x mt-3">
							<div class="col-12 col-sm-3">
								<h5>Datos de envió:</h5>
								<ul class="list-unstyled">
								<li><span class="text-muted">Cliente: </span>'. $_SESSION['Ecommerce-ClienteNombre'] .'</li>
								<li><span class="text-muted">Dirección: </span> <span id="resumen-datosEnvio-direccion"></span></li>
								<li><span class="text-muted">Teléfono: </span> <span id="resumen-datosEnvio-telefono"></span></li>
								</ul>
							</div>


								<div class="col-12 col-sm-3">
								<h5>Datos de Facturación:</h5>
								<ul class="list-unstyled">
									<li><span class="text-muted">Cliente: </span>'. $_SESSION['Ecommerce-ClienteNombre'] .'</li>
									<li><span class="text-muted">Dirección: </span> <span id="resumen-datosFacturacion-direccion"></span></li>
									<li><span class="text-muted">RFC: </span> <span id="resumen-datosFacturacion-RFC"></span></li>
								</ul>
								</div>

							<div class="col-12 col-sm-3">
								<h5>Paquetería:</h5>
								<ul class="list-unstyled">
								<li id="resumen-paqueteria"></li>
								</ul>
							</div>
							<div class="col-12 col-sm-3">
								<h5>Método de pago:</h5>
								<ul class="list-unstyled">
								<li id="resumen-metodo-pago"></li>
								</ul>
								<h5>Moneda de pago:</h5>
								<ul class="list-unstyled">
								<li><span id="resumen-moneda-pago"></span></li>
								</ul>
							</div>
							</div>
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

		/**
		 * Estructura correo para pedidos Ecommerce
		 *
		 * @param string $a Foo
		 *
		 * @return int $b Bar
		 */
		public function EcommercePedidoPagoBanco($PedidoKey){
			try {
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
															<p align="center">¡Gracias por su orden!</p><br>
															
															<table role="presentation" border="0" cellpadding="0" cellspacing="0">
																<tbody>
																	<tr style="width:100%;">
																		<td style="margin-bottom: 10px; text-align: center; max-width:33%;"></td>
																		<td style="margin-bottom: 10px; text-align: center; max-width:33%;"><img src="http://www.fibremex.com/ecomfmx/check.jpg" width="50" height="50"></td>
																	</tr>
																</tbody>
															</table><br>
															<table role="presentation" border="0" cellpadding="0" cellspacing="0">
																 <thead>
																	<tr style="width:100%;">
																		<th style="margin-bottom: 20px; text-align: left; max-width:20%;">Código</th>
																		<th style="margin-bottom: 20px; text-align: left; max-width:50%;">Descripción</th>
																		<th style="margin-bottom: 20px; max-width:10%;">Cantidad</th>
																		<th style="margin-bottom: 20px; max-width:10%;">Subtotal</th>
																		<th style="margin-bottom: 20px; max-width:10%;">Moneda</th>
																	</tr>
																</thead>
																<tbody>';
																$DetalleController = new DetalleController();
																$Obj = $DetalleController->GetDetallePedido_("WHERE pedidokey = '".$PedidoKey."' AND detalle_activo = 'si'");

																if($Obj->count > 0){
																	foreach ($Obj->records as $key => $data) {
																		$detalleSubtotal = $data->PedidoMonedaPago == "USD" ? $data->DetalleSubtotal : $data->DetalleSubtotalMXN;
																		$descripcion = !empty($data->ProductoDescripcion) ? $data->ProductoDescripcion : $data->ProductoConfigurableNombre;
																		$html .= '<tr style="width:100%;">
																			<td style="margin-bottom: 10px; text-align: left; max-width:20%;">'. $data->DetalleCodigo .'</td>
																			<td style="margin-bottom: 10px; text-align: left; max-width:50%;">'. $descripcion .'</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;">'. $data->DetalleCantidad .'</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;"> $'.$detalleSubtotal .'</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;">'. $data->PedidoMonedaPago .'</td>
																		</tr>';
																	}

																	$PedidoController = new PedidoController;
																	$PedidoController->filter = "WHERE id = '".$PedidoKey."' ";
																	$PedidoController->order = "";
																	# obtención de subtotal iva y total del pedido actual
																	$Pedido = $PedidoController->getBy();
																	
																	if($Pedido->MonedaPago == "USD"){
																		$pedidoSubtotal = $Pedido->GetSubTotal();
																		$pedidoIva = $Pedido->GetIva();
																		$pedidoTotal = $Pedido->GetTotal(); 
																	}else{
																		$pedidoSubtotal = $Pedido->GetSubTotalMXN();
																		$pedidoIva = $Pedido->GetIvaMXN();
																		$pedidoTotal = $Pedido->GetTotalMXN(); 
																	}


															$html .= '<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:50%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Subtotal</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $'.$pedidoSubtotal .' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">'. $Pedido->GetMonedaPago() .'</td>
																				</tr>
																				<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:50%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Iva</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $'.$pedidoIva .' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">'. $Pedido->GetMonedaPago() .'</td>
																				</tr>
																				<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:50%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Total</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $'.$pedidoTotal .' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">'. $Pedido->GetMonedaPago() .'</td>
																				</tr>';
								 
																}
																unset($DetalleController);
																unset($Obj);
																unset($PedidoController);
																unset($Pedido);
																$html .= '</tbody>
															</table>
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

