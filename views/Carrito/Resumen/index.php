<?php 
	if (!class_exists('DetalleController')) {
		include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Detalle.Controller.php';
	}if (!class_exists("SubcategoriasN1Controller")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Subcategorias/SubcategoriasN1.Controller.php';
	}if (!class_exists('PedidoController')) {
		include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
	}

	$DetalleController = new DetalleController();
	$Obj = $DetalleController->GetDetallePedido();		

	$total = 0;
	if(isset($_SESSION["Ecommerce-PedidoKey"])){
		$DetalleController->filter = "WHERE pedidokey = '".$_SESSION["Ecommerce-PedidoKey"]."' AND detalle_codigo = 'CTOENVIO' ";
		$DetalleController->order = "";
		$Obj_ = $DetalleController->GetByDetallePedido();	
		if(isset($Obj_->DetalleSubtotal)){
			$total = 1;
			$_SESSION['Ecommerce-CostoEnvio'] = 0;
		}
	}
?>

<a href="../Carrito/">
	<div>
		<span class="cart-icon"><i class="icon-shopping-cart"></i><span class="count-label"> <?php echo $Obj->count -$total ; ?> </span></span><span class="text-label">Carrito</span>
	</div>
</a>
<div class="toolbar-dropdown cart-dropdown widget-cart hidden-on-mobile tamano_carrito_resumen">
<?php 

if($Obj->count > 0){
	foreach ($Obj->records as $key => $data) {			
		$AlertStock = true;		
		$StockClass = "h6 bg-default"; 
		if(!($data->ProductoCodigo == '') && $data->ProductoCodigoConfigurable == ''){
			# Producto Fijo		
			$ImgUrl = file_exists("../../public/images/img_spl/productos/".$data->ProductoCodigo."/thumbnail/".$data->ProductoImgPrincipal."") 
									? "../../public/images/img_spl/productos/".$data->ProductoCodigo."/thumbnail/".$data->ProductoImgPrincipal."" 
									: "../../public/images/img_spl/notfound.png"	

?>
			<!-- Entry-->
			<div class="entry">
				<div class="entry-thumb">
					<a href="../Productos/fijos.php?id_prd=<?php echo $data->ProductoCodigo;?>">
						<img src="<?php echo $ImgUrl; ?>" alt="Product">
					</a>
				</div>
				<div class="entry-content">
					<h4 class="entry-title">
						<a href="../Productos/fijos.php?id_prd=<?php echo $data->ProductoCodigo;?>"><?php echo $data->ProductoDescripcion;?></a>
					</h4>
					<span class="entry-meta"><?php echo $data->DetalleCantidad;?> x $<?php echo $data->DetalleSubtotal;?></span>
				</div>
				<div class="entry-delete"><i class="icon-x"  onclick="DeleteProducto(<?php echo $data->DetalleKey?>, '<?php echo $data->DetalleCodigo ?>')"></i></div>
			</div>
<?php
		}else if(!($data->ProductoCodigo == '') && !($data->ProductoCodigoConfigurable == '')){
			# Producto Fijo-Configurable
			$SubcategoriasN1Controller = new SubcategoriasN1Controller();
			$SubcategoriasN1Controller->filter = "WHERE codigo = '".$data->ProductoCodigoConfigurable."' ";
			$SubcategoriaN1 = $SubcategoriasN1Controller->getBy();

			$ImgUrl = file_exists("../../public/images/img_spl/subsubcategorias/".$SubcategoriaN1->GetDescripcion().".jpg") 
			? "../../public/images/img_spl/subsubcategorias/".$SubcategoriaN1->GetDescripcion().".jpg" 
			: "../../public/images/img_spl/notfound.png" 
?>

			<!-- Entry-->
			<div class="entry">
				<div class="entry-thumb">
					<a href="../Productos/configurables.php?codigo=<?php echo $data->ProductoCodigoConfigurable;?>">
						<img src="<?php echo $ImgUrl; ?>" alt="Product">
					</a>
				</div>
				<div class="entry-content">
					<h4 class="entry-title">
						<a href="../Productos/configurables.php?codigo=<?php echo $data->ProductoCodigoConfigurable;?>"><?php echo $data->ProductoDescripcion;?></a>
					</h4>
					<span class="entry-meta"><?php echo $data->DetalleCantidad;?> x $<?php echo $data->DetalleSubtotal;?></span>
				</div>
				<div class="entry-delete"><i class="icon-x"  onclick="DeleteProducto(<?php echo $data->DetalleKey?>, '<?php echo $data->DetalleCodigo ?>')"></i></div>
			</div>

<?php 
		}else if(!($data->DetalleCodigoConfigurable == '')){
			# Producto Configurable
			$SubcategoriasN1Controller = new SubcategoriasN1Controller();
			$SubcategoriasN1Controller->filter = "WHERE codigo = '".$data->DetalleCodigoConfigurable."' ";
			$SubcategoriaN1 = $SubcategoriasN1Controller->getBy();

			$ImgUrl = file_exists("../../public/images/img_spl/subsubcategorias/".$SubcategoriaN1->GetDescripcion().".jpg") 
			? "../../public/images/img_spl/subsubcategorias/".$SubcategoriaN1->GetDescripcion().".jpg" 
			: "../../public/images/img_spl/notfound.png"
?>
		<!-- Entry-->
		<div class="entry">
			<div class="entry-thumb">
				<a href="../Productos/configurables.php?codigo=<?php echo $data->DetalleCodigoConfigurable;?>">
					<img src="<?php echo $ImgUrl; ?>" alt="Product">
				</a>
			</div>
			<div class="entry-content">
				<h4 class="entry-title">
					<a href="../Productos/configurables.php?codigo=<?php echo $data->DetalleCodigoConfigurable;?>"><?php echo $data->ProductoConfigurableNombre;?></a>
				</h4>
				<span class="entry-meta"><?php echo $data->DetalleCantidad;?> x $<?php echo $data->DetalleSubtotal;?></span>
			</div>
			<div class="entry-delete"><i class="icon-x"  onclick="DeleteProducto(<?php echo $data->DetalleKey?>, '<?php echo $data->DetalleCodigo ?>')"></i></div>
		</div>

<?php
		}
	}
}

	$pedidoSubtotal = 0;

	if(isset($_SESSION["Ecommerce-PedidoKey"])){
		$PedidoController = new PedidoController;
		$PedidoController->filter = "WHERE id = ".$_SESSION["Ecommerce-PedidoKey"]." ";
		$PedidoController->order = "";
		# obtención de subtotal iva y total del pedido actual
		$Pedido = $PedidoController->getBy();
		$pedidoSubtotal = $Pedido->GetSubTotal();
	}
?>
	<div class="text-right">
		<p class="text-gray-dark py-2 mb-0"><span class="text-muted">Subtotal:</span> &nbsp;<?php echo $pedidoSubtotal; ?></p>
	</div>
	<div class="d-flex">
		<div class="pr-2 w-50"><a class="btn btn-secondary btn-sm btn-block mb-0" href="../Carrito/">Ir al carrito</a></div>
		<?php if ($Obj->count > 0){ ?>
		<div class="pl-2 w-50"><a class="btn btn-primary btn-sm btn-block mb-0" href="../Checkout/">Pagar</a></div>
		<?php } ?> 
	</div>
</div>