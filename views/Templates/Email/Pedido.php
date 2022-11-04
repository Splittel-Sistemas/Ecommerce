<?php
if (!class_exists("TemplatePrincipal")) {
	include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Templates/Principal.php';
}
if (!class_exists('DetalleController')) {
	include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Pedido/Detalle.Controller.php';
}
if (!class_exists('PedidoController')) {
	include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Pedido/Pedido.Controller.php';
}
if (!class_exists("DatosEnvioController")) {
	include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Cuenta/B2C/DatosEnvio.Controller.php';
}
if (!class_exists("DatosFacturacionController")) {
	include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Cuenta/B2C/DatosFacturacion.Controller.php';
}
if (!class_exists("GetShipToAdressController")) {
	include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/WebService/BusinessPartner/GetShipToAdress.Controller.php';
}
if (!class_exists("GetBillToAdressController")) {
	include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/WebService/BusinessPartner/GetBillToAdress.Controller.php';
}

class TemplatePedido
{
	/**
	 * Estructura correo para pedidos Ecommerce
	 *
	 * @param string $a Foo
	 *
	 * @return int $b Bar
	 */
	public function body()
	{
		try {
			$Principal = new TemplatePrincipal();
			$html = $Principal->Head() . '<body class="">
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
																		<th style="margin-bottom: 20px; text-align: left; max-width:30%;">Descripción</th>
																		<th style="margin-bottom: 20px; text-align: left; max-width:20%;">Tiempo de Fabricacion</th>

																		<th style="margin-bottom: 20px; max-width:10%;">Cantidad</th>
																		<th style="margin-bottom: 20px; max-width:10%;">Subtotal</th>
																		<th style="margin-bottom: 20px; max-width:10%;">Moneda</th>
																	</tr>
																</thead>
																<tbody>';
			$DetalleController = new DetalleController();
			$Obj = $DetalleController->GetDetallePedido();


			if ($Obj->count > 0) {
				foreach ($Obj->records as $key => $data) {
					$detalleSubtotal = $data->PedidoMonedaPago == "USD" ? $data->DetalleSubtotal : $data->DetalleSubtotalMXN;
					$descripcion = !empty($data->ProductoDescripcion) ? $data->ProductoDescripcion : $data->ProductoConfigurableNombre;
					$tiempo = !($data->DetalleCodigoConfigurable == '') ? $data->TiempoEntrega : 'NA';

					$html .= '<tr style="width:100%;">
																			<td style="margin-bottom: 10px; text-align: left; max-width:20%;">' . $data->DetalleCodigo . '</td>
																			<td style="margin-bottom: 10px; text-align: left; max-width:30%;">' . $descripcion . '</td>
																			<td style="margin-bottom: 10px; text-align: left; max-width:20%;">' . $tiempo . '</td>

																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;">' . $data->DetalleCantidad . '</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;"> $' . $detalleSubtotal . '</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;">' . $data->PedidoMonedaPago . '</td>
																		</tr>';
				}

				$PedidoController = new PedidoController;
				$PedidoController->filter = "WHERE id = " . $_SESSION["Ecommerce-PedidoKey"] . " ";
				$PedidoController->order = "";
				# obtención de subtotal iva y total del pedido actual
				$Pedido = $PedidoController->getBy();

				if ($Pedido->MonedaPago == "USD") {
					$pedidoSubtotal = $Pedido->GetSubTotal();
					$pedidoIva = $Pedido->GetIva();
					$pedidoTotal = $Pedido->GetTotal();
				} else {
					$pedidoSubtotal = $Pedido->GetSubTotalMXN();
					$pedidoIva = $Pedido->GetIvaMXN();
					$pedidoTotal = $Pedido->GetTotalMXN();
				}


				$html .= '<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:30%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>

																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Subtotal</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $' . $pedidoSubtotal . ' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">' . $Pedido->GetMonedaPago() . '</td>
																				</tr>
																				<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:30%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>

																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Iva</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $' . $pedidoIva . ' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">' . $Pedido->GetMonedaPago() . '</td>
																				</tr>
																				<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:30%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>

																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Total</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $' . $pedidoTotal . ' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">' . $Pedido->GetMonedaPago() . '</td>
																				</tr>';
			}

			$html .= '</tbody>
															</table>

															<br>
															<br>
															<br>
														<table role="presentation" border="0" cellpadding="0" cellspacing="0">
															 <thead>
																<tr style="width:100%;">
																	<th style="margin-bottom: 20px; text-align: left; max-width:20%;">Datos de envió:</th>
																	';
			if ($Pedido->DatosFacturacionKey == '') {

				$html .= '';
			} else {
				$html .= '<th style="margin-bottom: 20px; text-align: left; max-width:50%;">Datos de Facturación:</th>';
			};

			$html .= '<th style="margin-bottom: 20px; max-width:20%;">Paquetería</th>
																	
																</tr>
															</thead>
															<tbody>';

			unset($DetalleController);
			unset($Obj);
			unset($PedidoController);
			unset($Pedido);
			$DetalleController = new DetalleController();
			$Obj = $DetalleController->GetDetallePedido();

			if ($Obj->count > 0) {
				foreach ($Obj->records as $key => $data) {
					$detalleSubtotal = $data->PedidoMonedaPago == "USD" ? $data->DetalleSubtotal : $data->DetalleSubtotalMXN;
					$descripcion = !empty($data->ProductoDescripcion) ? $data->ProductoDescripcion : $data->ProductoConfigurableNombre;
				}

				$PedidoController = new PedidoController;
				$PedidoController->filter = "WHERE id = " . $_SESSION["Ecommerce-PedidoKey"] . " ";
				$PedidoController->order = "";
				$DatosFacturacionController = new DatosFacturacionController();
				$DatosFacturacionController->filter = "WHERE id_cliente = " . $_SESSION['Ecommerce-ClienteKey'] . " LIMIT 1 ";
				$DatosFacturacionController->order = "";
				$ResultDatosFacturacionController = $DatosFacturacionController->get();
				# obtención de subtotal iva y total del pedido actual
				$Pedido = $PedidoController->getBy();
				/* if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2C') {

					$nombrefactura = $Pedido->DatosFacturacionKey != '' ? '<td style="margin-bottom: 2px; text-align: left max-width:10%;">Cliente: </span>' . $_SESSION['Ecommerce-ClienteNombre'] . '</td>' : '';

				}else{

					$nombrefactura = $Pedido->DatosFacturacionKey != '' ? '<td style="margin-bottom: 2px; text-align: left max-width:10%;">Cliente: </span>' . $_SESSION['Ecommerce-ClienteNombre'] . '</td>' : '';

				} */


				$pedidoCostoEnvio = $Pedido->GetEnvio();
				$pedidoDatosEnvio = $Pedido->GetDatosEnvioKey();

				$DatosEnvioController = new DatosEnvioController();
				$DatosEnvioController->filter = "WHERE id_cliente = " . $_SESSION['Ecommerce-ClienteKey'] . " LIMIT 1 ";
				$DatosEnvioController->order = "";
				$ResultDatosEnvioController = $DatosEnvioController->get();
				/* DATOS DE ENVIO DE SAP */
				try {
					$GetShipToAdressController = new GetShipToAdressController();

					$resultGetShipToAdressController = $GetShipToAdressController->get();
					$ErrorCode = $resultGetShipToAdressController->GetShipToAdressResult->ErrorCode;
					//print_r($resultGetShipToAdressController);
				} catch (Exception $e) {
					$ErrorCode = -100;
				}
				if ($resultGetShipToAdressController->GetShipToAdressResult->Count == 1) {
					$listGetShipToAdress[] = $resultGetShipToAdressController->GetShipToAdressResult->Records->BussinessPartnerAdresses;
				} else {
					$listGetShipToAdress = $resultGetShipToAdressController->GetShipToAdressResult->Records->BussinessPartnerAdresses;
				}
				/* FIN DATOS DE ENVIO SAP */

				/* DATOS DE FACTURACION SAP */


				try {
					$GetBillToAdressController = new GetBillToAdressController();
					$resultGetBillToAdressController = $GetBillToAdressController->get();
					$ErrorCode = $resultGetBillToAdressController->GetBillToAdressResult->ErrorCode;
					// print_r($resultGetBillToAdressController);
				} catch (Exception $e) {
					$ErrorCode = -100;
				}


				if ($resultGetBillToAdressController->GetBillToAdressResult->Count == 1) {
					$listGetBillToAdress[] = $resultGetBillToAdressController->GetBillToAdressResult->Records->BussinessPartnerAdresses;
				} else {
					$listGetBillToAdress = $resultGetBillToAdressController->GetBillToAdressResult->Records->BussinessPartnerAdresses;
				}

				/* FIN DATOS DE FACTURACION*/
				if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2C') {

					$nombrefactura = $Pedido->DatosFacturacionKey != '' ? '<td style="margin-bottom: 2px; text-align: left max-width:10%;">Cliente: </span>' . $_SESSION['Ecommerce-ClienteNombre'] . '</td>' : '';
					$nombre = '<td style="margin-bottom: 2px; text-align: left max-width:10%;">Cliente: </span>' . $_SESSION['Ecommerce-ClienteNombre'] . '</td>';
				} else {
					foreach ($listGetBillToAdress as $key => $GetBillToAdress) {
						$nombrefactura = $Pedido->DatosFacturacionKey != '' ? '<td style="margin-bottom: 2px; text-align: left max-width:20%;">Cliente: ' . $GetBillToAdress->CardName . '</span></td>' : '';
						$nombre = '<td style="margin-bottom: 2px; text-align: left max-width:20%;">Cliente: ' . $GetBillToAdress->CardName . '</span></td>';
					}
				}
				$html .= '				<tr style="width:100%;">
																' . $nombre . '

														' . $nombrefactura . '
														<td style=" text-align: left"  rowspan="6">' . $Pedido->Paqueteria . '</span></td>


														
														</tr>
														<tr style="width:100%;">';

				/* datos de envio */
				if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2C') {


					foreach ($ResultDatosEnvioController->records as $key => $DatosEnvio) {
						$html .= '<td style="margin-bottom: 2px; text-align: left max-width:20%;">Dirección: ' . $DatosEnvio->Calle . " No Ext. " . $DatosEnvio->NumeroExterior . " Col. " . $DatosEnvio->Colonia . '</span></td>';
					}
				} else {

					foreach ($listGetShipToAdress as $key => $GetShipToAdress) {
						if ($GetShipToAdress->Address == $pedidoDatosEnvio) {
							$html .= '<td style="margin-bottom: 2px; text-align: left max-width:20%;">Dirección: ' . $GetShipToAdress->Address . ' No Ext. ' . $pedidoDatosEnvio . ' Col. ' . $GetShipToAdress->Block . '</span></td>';
						}
					}
				};

				/* datos de facturacion */
				if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2C') {


					if ($Pedido->DatosFacturacionKey != '') {


						foreach ($ResultDatosFacturacionController->records as $key => $DatosFacturacion) {
							$html .= '<td style="margin-bottom: 2px; text-align: left max-width:20%;">Dirección: fact' . $DatosFacturacion->Calle . " No Ext. " . $DatosFacturacion->NumeroExterior . " Col. " . $DatosFacturacion->Colonia . '</span></td>';
						}
					} else {
						$html .= '<td style="margin-bottom: 2px; text-align: left max-width:20%;">td>';
					};
				} else {
					if ($Pedido->DatosFacturacionKey != '') {

						foreach ($listGetBillToAdress as $key => $GetBillToAdress) {
							$html .= '<td style="margin-bottom: 2px; text-align: left max-width:20%;">Dirección: fact ' . $GetBillToAdress->Street . ' No Ext. ' . $GetBillToAdress->StreetNo . ' Col. ' . $GetBillToAdress->Block . '</span></td>';
						}
					} else {
						$html .= '<td style="margin-bottom: 2px; text-align: left max-width:20%;">td>';
					};
				};
				$html .= '	
														


														
														

														
														</tr>
														<tr style="width:100%;">
														';

				if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2C') {

					foreach ($ResultDatosEnvioController->records as $key => $DatosEnvio) {
						$html .= '<td style="margin-bottom: 2px; text-align: left max-width:10%;">Teléfono: ' . $DatosEnvio->Telefono . '</span></td>';
					}
				} else {

					$html .= '<td style="margin-bottom: 2px; text-align: left max-width:10%;"> </span></td>';
				};




				/* factuacion */
				if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2C') {


					if ($Pedido->DatosFacturacionKey != '') {


						foreach ($ResultDatosFacturacionController->records as $key => $DatosFacturacion) {
							$html .= '<td style="margin-bottom: 2px; text-align: left max-width:20%;">RFC: ' . $DatosFacturacion->RFC . '</span></td>';
						}
					} else {
						$html .= '';
					};
				} else {
					if ($Pedido->DatosFacturacionKey != '') {
						foreach ($listGetBillToAdress as $key => $GetBillToAdress) {
							$html .= '<td style="margin-bottom: 2px; text-align: left max-width:20%;">RFC: ' . $GetBillToAdress->FederalTaxID . '</span></td>';
						}
					} else {
						$html .= '';
					};
				};
				$DatosEnvioController = new DatosEnvioController();
				$DatosEnvioController->filter = "WHERE id_cliente = " . $_SESSION['Ecommerce-ClienteKey'] . " LIMIT 1 ";
				$DatosEnvioController->order = "";
				$ResultDatosCorreo = $DatosEnvioController->getEmailEjecutivo();

				/* fin fcturacion */
				$html .= '	
														
														
														</tr>
													
													
												
													';
			}
			$html .= '</tbody>
														</table>


															<div style="text-align:right">
															<div style="float: right">
															</div>
															</div>
															<p><br></p>
															<p align="center">Este es un correo electrónico generado automáticamente</p>
															<br>
															<p align="center">Si tienes alguna duda, contáctanos: 800 134 26 90</p>
															';
			if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {

				foreach ($ResultDatosCorreo->records as $key => $DatosEnvio) {
					$html .= '<p align="center">Ejecutivo: ' . $DatosEnvio->email_ejecutivo . '</p>';
				}
			} else if ($_SESSION['Ecommerce-ClienteTipo'] == 'B2C') {

				$html .= '<p align="center">Ejecutivo: andrea.alejo@splittel.com</p>';
			} else {

				foreach ($ResultDatosCorreo->records as $key => $DatosEnvio) {
					if ($DatosEnvio->email_ejecutivo == '' || $DatosEnvio->email_ejecutivo == null) {
						$html .= '<p align="center">Ejecutivo: andrea.alejo@splittel.com</p>';
					} else {
						$html .= '<p align="center">Ejecutivo: ' . $DatosEnvio->email_ejecutivo . '</p>';
					}
				}
			}

			$html .= '
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
	public function EcommercePedidoPagoBanco($PedidoKey)
	{
		try {
			$Principal = new TemplatePrincipal();
			$html = $Principal->Head() . '<body class="">
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
			$Obj = $DetalleController->GetDetallePedido_("WHERE pedidokey = '" . $PedidoKey . "' AND detalle_activo = 'si'");

			if ($Obj->count > 0) {
				foreach ($Obj->records as $key => $data) {
					$detalleSubtotal = $data->PedidoMonedaPago == "USD" ? $data->DetalleSubtotal : $data->DetalleSubtotalMXN;
					$descripcion = !empty($data->ProductoDescripcion) ? $data->ProductoDescripcion : $data->ProductoConfigurableNombre;
					$html .= '<tr style="width:100%;">
																			<td style="margin-bottom: 10px; text-align: left; max-width:20%;">' . $data->DetalleCodigo . '</td>
																			<td style="margin-bottom: 10px; text-align: left; max-width:50%;">' . $descripcion . '</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;">' . $data->DetalleCantidad . '</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;"> $' . $detalleSubtotal . '</td>
																			<td style="margin-bottom: 10px; text-align: center; max-width:10%;">' . $data->PedidoMonedaPago . '</td>
																		</tr>';
				}

				$PedidoController = new PedidoController;
				$PedidoController->filter = "WHERE id = '" . $PedidoKey . "' ";
				$PedidoController->order = "";
				# obtención de subtotal iva y total del pedido actual
				$Pedido = $PedidoController->getBy();

				if ($Pedido->MonedaPago == "USD") {
					$pedidoSubtotal = $Pedido->GetSubTotal();
					$pedidoIva = $Pedido->GetIva();
					$pedidoTotal = $Pedido->GetTotal();
				} else {
					$pedidoSubtotal = $Pedido->GetSubTotalMXN();
					$pedidoIva = $Pedido->GetIvaMXN();
					$pedidoTotal = $Pedido->GetTotalMXN();
				}


				$html .= '<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:50%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Subtotal</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $' . $pedidoSubtotal . ' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">' . $Pedido->GetMonedaPago() . '</td>
																				</tr>
																				<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:50%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Iva</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $' . $pedidoIva . ' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">' . $Pedido->GetMonedaPago() . '</td>
																				</tr>
																				<tr style="width:100%;">
																					<td style="margin-bottom: 2px; text-align: center; max-width:20%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:50%;"></td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">Total</td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;"> $' . $pedidoTotal . ' </td>
																					<td style="margin-bottom: 2px; text-align: center; max-width:10%;">' . $Pedido->GetMonedaPago() . '</td>
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
