<?php $link = $_SESSION['Ecommerce-ClienteTipo'] == 'B2B' ? '../../Cuenta/index.php?menu=4' : '../../Cuenta/index.php?menu=3'; ?>
<div class="card text-center">
	<div class="card-body padding-top-2x">
	<p><img src="../../public/images/img_spl/iconos/check.jpg" width="200px" height="200px" /></p>
		<h3 class="card-title">¡Gracias por su orden!</h3>          
		<p class="card-text">Su pedido se ha realizado y se procesará lo antes posible.</p>
		<p class="card-text"> 
			<u>Para ver los detalles de su compra:</u>
		</p>
		<div class="padding-top-1x padding-bottom-1x">
			<a class="btn btn-outline-primary" onclick="ViewCuenta()"><i class="icon-user"></i>&nbsp;Ir a mi cuenta</a>
		</div>
	</div>
</div>

<script>
  var ViewCuenta = function(Elem){
    window.parent.location.href = <?php echo $link ?>
  } 
</script>