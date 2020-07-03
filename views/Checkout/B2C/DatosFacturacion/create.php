<div class="row no-gutters">
	<div class="col-md-12" id="notify" data-offset-top="-1">
		<div class=" py-5 px-3 justify-content-center align-items-center">
			<div style="max-width: 500px;">
				<div id="alert-datos-facturacion"></div>
				<!-- <div class="h1 text-normal mb-3 text-center">Registro</div> -->
				<h3 class="margin-bottom-1x text-center">Datos de facturación</h3>
				<!-- <p>El registro solo te llevara algunos minutos para obtener el control de tus ordenes.</p> -->
				<?php 
				 	if (!class_exists('DatosFacturacionController')) {
						include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cuenta/B2C/DatosFacturacion.Controller.php';
					}
					$DatosFacturacionController = new DatosFacturacionController();
					$DatosFacturacionController->filter = isset($_POST['DatosFacturacionKey']) ? "WHERE id = '".$_POST['DatosFacturacionKey']."' " : "WHERE id = 0 "; 
					$key = isset($_POST['DatosFacturacionKey']) ? $_POST['DatosFacturacionKey'] : 0; 
					$DatosFacturacion = $DatosFacturacionController->getBy();
				 ?>
				<form id="form-datos-facturacion">
					<input type="hidden" id="Action" name="Action" value="create">
					<input type="hidden" id="ActionDatosFacturacion" name="ActionDatosFacturacion" value="true">
					<input type="hidden" id="DatosFacturacionKey" name="DatosFacturacionKey" value="<?php echo $key ?>">
						<div class="form-group">
							<input class="form-control form-control-pill" type="text" id="RazonSocial" name="RazonSocial" placeholder="Razón social" value="<?php echo $DatosFacturacion->GetRazonSocial() ?>" autocomplete="off">
						</div>
						<div class="form-group">
							<input class="form-control form-control-pill" type="text" id="Tipo" name="Tipo" placeholder="Tipo" value="<?php echo $DatosFacturacion->GetTipo() ?>" autocomplete="off">
						</div>
						<div class="form-group">
							<input class="form-control form-control-pill" type="text" id="RFC" name="RFC" placeholder="RFC" value="<?php echo $DatosFacturacion->GetRFC() ?>" autocomplete="off">
						</div>
						<div class="form-group">
							<input class="form-control form-control-pill" type="text" id="Calle" name="Calle" placeholder="Calle" value="<?php echo $DatosFacturacion->GetCalle() ?>" autocomplete="off">
						</div>
						<div class="form-group">
							<input class="form-control form-control-pill" type="text" id="NumeroExterior" name="NumeroExterior" placeholder="Numero exterior" value="<?php echo $DatosFacturacion->GetNumeroExterior() ?>" autocomplete="off">
						</div>
						<div class="form-group">
							<input class="form-control form-control-pill" type="text" id="NumeroInterior" name="NumeroInterior" placeholder="Numero interior" value="<?php echo $DatosFacturacion->GetNumeroInterior() ?>" autocomplete="off">
						</div>
						<div class="form-group">
							<input class="form-control form-control-pill" type="text" id="CodigoPostal" name="CodigoPostal" placeholder="Codigo postal" value="<?php echo $DatosFacturacion->GetCodigoPostal() ?>" autocomplete="off">
						</div>
						<div class="form-group">
							<select class="form-control form-control-pill" id="Estado" name="Estado" onchange="showMunicipios(this, 'Municipio')">
							<?php 
								if (!class_exists('Estados')) {
									include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Estados.php';
								}
								$Estado = new Estados();
								foreach ($Estado->CountryWithCitys['Mexico'] as $Ciudad) {
									$Seleted = $Ciudad['value'] == $DatosFacturacion->GetEstado() ? 'selected' : '';
							?>
								<option value="<?php echo $Ciudad['value'] ?>" <?php echo $Seleted ?>><?php echo $Ciudad['label'] ?></option>
										
							<?php }  ?>
							</select>
						</div>
						<div class="form-group">
							<select class="form-control form-control-pill" id="Municipio" name="Municipio">
								
							</select>
						</div>
						<div class="form-group">
							<input class="form-control form-control-pill" type="text" id="Delegacion" name="Delegacion" placeholder="Colonia" value="<?php echo $DatosFacturacion->GetDelegacion() ?>" autocomplete="off">
						</div>
						<div class="form-group">
							<textarea  class="form-control form-control-pill" name="Colonia" id="Colonia" rows="3" placeholder="Referencia"><?php echo $DatosFacturacion->GetColonia() ?></textarea>
						</div>
					<button type="button" class="btn btn-primary btn-block float-right" onclick="nuevoRegistroDatosFacturacion()"><i class="icon-send"></i>&nbsp;Enviar</button>
				</form>
			</div>
		</div>
	</div>
</div>