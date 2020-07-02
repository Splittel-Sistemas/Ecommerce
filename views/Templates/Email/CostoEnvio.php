<?php
	if (!class_exists("TemplatePrincipal")) {
		include $_SERVER["DOCUMENT_ROOT"].'/store/views/Templates/Principal.php';
	}if (!class_exists('DetalleController')) {
		include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Detalle.Controller.php';
	}if (!class_exists('PedidoController')) {
		include $_SERVER['DOCUMENT_ROOT'].'/store/models/Pedido/Pedido.Controller.php';
	}

	class TemplateCostoEnvio{
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
															<p align="center">El cliente '.$_SESSION['Ecommerce-ClienteNombre'].' ha solictado costo de envio para su pedido '.$_SESSION["Ecommerce-PedidoKey"].'</p><br>
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
																		$descripcion = !empty($data->ProductoDescripcion) ? $data->ProductoDescripcion : $data->ProductoConfigurableNombre;
																		$html .= '<tr style="width:100%;">
																			<td style="margin-bottom: 10px; text-align: left; max-width:20%;">'. $data->DetalleCodigo .'</td>
																			<td style="margin-bottom: 10px; text-align: left; max-width:50%;">'. $descripcion .'</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;">'. $data->DetalleCantidad .'</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;"> $'.$data->DetalleSubtotal .'</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;">USD</td>
																		</tr>';
																	}

																	$PedidoController = new PedidoController;
																	$PedidoController->filter = "WHERE id = ".$_SESSION["Ecommerce-PedidoKey"]." ";
																	$PedidoController->order = "";
																	# obtención de subtotal iva y total del pedido actual
																	$Pedido = $PedidoController->getBy();
																	
																	$pedidoSubtotal = $Pedido->GetSubTotal();
																	$pedidoIva = $Pedido->GetIva();
																	$pedidoTotal = $Pedido->GetTotal(); 


															$html .= '<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:50%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Subtotal</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $'.$pedidoSubtotal .' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">USD</td>
																				</tr>
																				<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:50%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Iva</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $'.$pedidoIva .' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">USD</td>
																				</tr>
																				<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:50%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Total</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $'.$pedidoTotal .' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">USD</td>
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
															<br>
																<p align="center"><a href="http://192.168.2.29:2622"> Iniciar sesión con tu usuario de splitnet </a></p>
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

