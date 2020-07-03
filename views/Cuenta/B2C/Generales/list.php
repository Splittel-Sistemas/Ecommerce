<?php 
	if (!class_exists('ClienteController')) {
		include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cliente/Cliente.Controller.php';
	}

	$ClienteController = new ClienteController();
	$ClienteController->filter = "WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." ";
	$Cliente = $ClienteController->getBy();

?>

<div class="col-lg-12">
	<div class="row">
		<div class="col-lg-4">
			<!-- Widget Contacts-->
			<section class="widget">
				<h3 class="widget-title">Cliente</h3>
				<p><?php echo $Cliente->GetNombre().' '.$Cliente->GetApellidos();?></p>
				</section>
		</div>
		<div class="col-lg-4">
			<!-- Widget Links-->
			<section class="widget">
				<h3 class="widget-title">Email</h3>
				<p><?php echo $Cliente->GetEmail();?></p>
				</section>
		</div>
		<div class="col-lg-4">
			<!-- Widget Search-->
			<section class="widget">
				<h3 class="widget-title">Télefono</h3>
				<p><?php echo $Cliente->GetTelefono();?></p>
				</section>
		</div>
	</div>
</div>

<div class="col-lg-12">
	<h6 class="text-muted text-lg text-uppercase">Cambiar contraseña</h6>
	<hr class="margin-bottom-1x">
	<form class="row" id="form-change-password">
		<input class="form-control" type="hidden" id="Action" name="Action" value="changePassword">
		<div class="col-md-6">
			<div class="form-group">
				<input class="form-control form-control-sm" type="password" id="PersonalPassword" name="PersonalPassword" placeholder="Contraseña" autocomplete="off" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<input class="form-control form-control-sm" type="password" id="PersonalPasswordConfirm" name="PersonalPasswordConfirm" placeholder="Confirmar Contraseña" autocomplete="off" required>
			</div>
		</div>
		<button type="button" class="btn btn-primary btn-sm" onclick="changePassword()"><i class="icon-mail"></i>&nbsp;Enviar</button>
	</form>
</div>