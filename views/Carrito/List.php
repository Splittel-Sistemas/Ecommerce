<div class="table-responsive shopping-cart">
  <table class="table">
    <thead>
      <tr>
        <th>Producto</th>
        <th class="text-center">Cantidad</th>
        <th class="text-center">Stock</th>
        <th class="text-center">Subtotal</th>
        <th class="text-center">
          <a class=" btn-outline-danger" href="javascript:void(0);">
            Eliminar
          </a>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
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
        $cont = 0;
        $cont1 = 0;
        $requiereCostoEnvio = 0;
        $costo = 0;

        if($Obj->count > 0){
          foreach ($Obj->records as $key => $data) {			
            if(!($data->ProductoCodigo == '') && $data->ProductoCodigoConfigurable == ''){
              # Producto Fijo		
              $ImgUrl = file_exists("../../public/images/img_spl/productos/".$data->ProductoCodigo."/thumbnail/".$data->ProductoImgPrincipal."") 
                  ? "../../public/images/img_spl/productos/".$data->ProductoCodigo."/thumbnail/".$data->ProductoImgPrincipal."" 
                  : "../../public/images/img_spl/notfound.png";
                  if( $data->ProductoCostoEnvio == 'si'	){
                    $requiereCostoEnvio++;
                    $costo++;
                  }		
               
      ?>
          <!-- Producto -->
          <td>
            <div class="product-item">
              <a class="product-thumb" href="../Productos/fijos.php?id_prd=<?php echo $data->ProductoCodigo;?>">
                <img src="<?php echo $ImgUrl; ?>" alt="Product">
              </a>
              <div class="product-info">
                <h4 class="product-title">
                  <a href="../Productos/fijos.php?id_prd=<?php echo $data->ProductoCodigo;?>"><?php echo $data->ProductoDescripcion;?></a>
                </h4>
                <span><em>Clave:</em> <?php echo $data->ProductoCodigo;?></span>
              </div>
            </div>
          </td>
          <!-- Cantidad -->
          <td class="text-center">
            <div class="row">
              <div class="col-12 col-md-12">
                <?php 
                  $AlertStock = true;
                  if($data->ProductoExistencia == 0){ 
                    $StockClass = "h6 bg-danger text-white"; 
                    $AlertStock = false;
                    $cont++;
                  }else if($data->DetalleCantidad > $data->ProductoExistencia){ 
                    $StockClass = "h6 bg-warning text-white"; 
                    $cont1++;
                  }else{ 
                    $StockClass = "bg-secondary"; 
                  }

                  if ($AlertStock){ 
                ?>                    
                <div class="input-group form-group" >
                  <span class="input-group-btn">
                    <button type="button" validacion="ProductoValidar-<?php echo $data->ProductoCodigo; ?>" descuento="<?php echo $data->Descuento ?>" codigo="<?php echo $data->ProductoCodigo; ?>" onclick="AgregarArticulo(this)">
                      <i class="icon-refresh-ccw"></i>
                    </button>
                  </span>
                  <input type="text" class="form-control form-control-sm myclass" id="ProductoCantidad-<?php echo $data->ProductoCodigo; ?>" name="ProductoCantidad-<?php echo $data->ProductoCodigo; ?>" value="<?php echo $data->DetalleCantidad?>" onkeyup="validacionCantidad(this)" autocomplete="off">
                </div>
                <?php }else{ ?>
                  <ul class="list-unstyled"><li class="text-md text-danger">No hay existencia</li></ul>
                <?php } ?>
              </div>
            </div>
          </td>
          <!-- Stock -->
          <td class="text-center text-lg">
            <span style="position:relative;" class="text-center product-badge <?php echo $StockClass; ?> border-default text-body">
              <?php echo $data->ProductoExistencia;?>
            </span>
          </td>
          <!-- Subtotal -->
          <td class="text-center text-lg">
            $ <?php echo $data->DetalleSubtotal ?>
          </td>
          <!-- Eliminar -->
          <td class="text-center">
            <a class="remove-from-cart" href="#" data-toggle="tooltip" title="Eliminar producto">
              <i class="icon-x"  onclick="DeleteProducto(<?php echo $data->DetalleKey?>, '<?php echo $data->DetalleCodigo ?>')"></i>
            </a>
          </td>
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
          <!-- Producto -->
          <td>
            <div class="product-item">
              <a class="product-thumb" href="../Productos/configurables.php?codigo=<?php echo $data->ProductoCodigoConfigurable;?>">
                <img src="<?php echo $ImgUrl; ?>" alt="Product">
              </a>
              <div class="product-info">
                <h4 class="product-title">
                  <a  href="../Productos/configurables.php?codigo=<?php echo $data->ProductoCodigoConfigurable;?>"><?php echo $data->ProductoDescripcion;?></a>
                </h4>
                <span><em>Clave:</em> <?php echo $data->ProductoCodigo;?></span>
              </div>
            </div>
          </td>
          <!-- Cantidad -->
          <td class="text-center">
            <div class="row">
              <div class="col-12 col-md-12">
              <?php 
                  $AlertStock = true;
                  if($data->ProductoExistencia == 0){ 
                    $StockClass = "h6 bg-danger text-white"; 
                    $AlertStock = false;
                    $cont++;
                  }else if($data->DetalleCantidad > $data->ProductoExistencia){ 
                    $StockClass = "h6 bg-warning text-white"; 
                    $cont1++;
                  }else{ 
                    $StockClass = "bg-secondary"; 
                  }

                  if ($AlertStock){ 
                ?>                  
                <div class="input-group form-group" >
                  <span class="input-group-btn">
                    <button type="button" validacion="ProductoValidar-<?php echo $data->ProductoCodigo; ?>" descuento="<?php echo $data->Descuento ?>" codigo="<?php echo $data->ProductoCodigo; ?>" onclick="AgregarArticulo(this)">
                      <i class="icon-refresh-ccw"></i>
                    </button>
                  </span>
                  <input type="text" class="form-control form-control-sm myclass" id="ProductoCantidad-<?php echo $data->ProductoCodigo; ?>" name="ProductoCantidad-<?php echo $data->ProductoCodigo; ?>" value="<?php echo $data->DetalleCantidad?>" onkeyup="validacionCantidad(this)" autocomplete="off">
                </div>
                <?php }else{ ?>
                  <ul class="list-unstyled"><li class="text-md text-danger">No hay existencia</li></ul>
                <?php } ?>
              </div>
            </div>
          </td>
          <!-- Stock -->
          <td class="text-center text-lg">
            <span style="position:relative;" class="text-center product-badge <?php echo $StockClass; ?> border-default text-body">
              <?php echo $data->ProductoExistencia;?>
            </span>
          </td>
          <!-- Subtotal -->
          <td class="text-center text-lg">
            $ <?php echo $data->DetalleSubtotal ?>
          </td>
          <!-- Eliminar -->
          <td class="text-center">
            <a class="remove-from-cart" href="#" data-toggle="tooltip" title="Eliminar producto">
              <i class="icon-x"  onclick="DeleteProducto(<?php echo $data->DetalleKey?>, '<?php echo $data->DetalleCodigo ?>')"></i>
            </a>
          </td>
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
         <!-- Producto -->
         <td>
            <div class="product-item">
              <a class="product-thumb" href="../Productos/configurables.php?codigo=<?php echo $data->DetalleCodigoConfigurable;?>">
                <img src="<?php echo $ImgUrl; ?>" alt="Product">
              </a>
              <div class="product-info">
                <h4 class="product-title">
                  <a  href="../Productos/configurables.php?codigo=<?php echo $data->DetalleCodigoConfigurable;?>"><?php echo $data->ProductoConfigurableNombre;?></a>
                </h4>
                <span><em>Clave:</em> <?php echo $data->DetalleCodigo;?></span>
              </div>
            </div>
          </td>
           <!-- Cantidad -->
          <td class="text-center">
            <?php echo $data->DetalleCantidad?>
          </td>
          <!-- Producto especial en fabricación -->
          <td class="text-center text-lg">
            <ul class="list-unstyled"><li class="text-md text-success">Tiempo de fabricación. <?php echo $data->TiempoEntrega;?></li></ul>
          </td>
          <!-- Subtotal -->
          <td class="text-center text-lg">
            $ <?php echo $data->DetalleSubtotal ?>
          </td>
          <!-- Eliminar -->
          <td class="text-center">
            <a class="remove-from-cart" href="#" data-toggle="tooltip" title="Eliminar producto">
              <i class="icon-x"  onclick="DeleteProducto(<?php echo $data->DetalleKey?>, '<?php echo $data->DetalleCodigo ?>')"></i>
            </a>
          </td>

      <?php } ?>
      </tr>
      <?php }}else{ ?>

      <?php } ?>
    </tbody>
  </table>
</div>

<div class="shopping-cart-footer">
  <div class="column">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning alert-dismissible fade show text-center margin-bottom-1x">
            </span><i class="icon-alert-triangle"></i>&nbsp;&nbsp;
            Postes, registros, monotubo y tritubo requieren costo de envio.
            <?php 
          $_SESSION['requiereCostoEnvio'] = $requiereCostoEnvio;
            if((isset($_SESSION['Ecommerce-CostoEnvio']) && $_SESSION['Ecommerce-CostoEnvio'] == 2) && $requiereCostoEnvio > 0){ 
              if(isset($_SESSION['Ecommerce-ClienteKey'])){
                if(isset($_SESSION['Ecommerce-ClienteTipo']) && $_SESSION['Ecommerce-ClienteTipo'] == "B2C"){
          ?>
            <a href="#" onclick="elegirDatosEnvioB2C()">
                <?php }else{ ?>
                  <a href="#" onclick="elegirDatosEnvioB2B()">
                <?php } ?>
              <span class="text-medium"> Solicitar costo de envio </span>
            </a>
          <?php }else{ ?>
            <a href="../Login/index.php?costo=1">
            <span class="text-medium"> Solicitar costo de envio </span>
            </a>
          <?php } ?>
          <?php }else if(isset($_SESSION['Ecommerce-CostoEnvio']) && $_SESSION['Ecommerce-CostoEnvio'] == 1){ ?>
            <span class="text-muted">Costo Envio: </span> <span class="text-info">solicitado</span> 
          <?php } ?>
          </div>
        </div>
        <div class="col-4">
          
        </div>
    </div>
  </div>
  <div class="column text-lg">
    <?php
      $pedidoSubtotal = 0;
      $pedidoIva = 0;
      $pedidoTotal = 0; 

      if(isset($_SESSION["Ecommerce-PedidoKey"])){
        $PedidoController = new PedidoController;
        $PedidoController->filter = "WHERE id = ".$_SESSION["Ecommerce-PedidoKey"]." ";
        $PedidoController->order = "";
        # obtención de subtotal iva y total del pedido actual
        $Pedido = $PedidoController->getBy();
        $pedidoSubtotal = $Pedido->GetSubTotal();
        $pedidoIva = $Pedido->GetIva();
        $pedidoTotal = $Pedido->GetTotal(); 
      }
      $_SESSION['Ecommerce-PedidoTotal'] = $pedidoTotal;
    ?>
    <?php 
      if(isset($_SESSION['Ecommerce-CostoEnvio']) && $_SESSION['Ecommerce-CostoEnvio'] == 0){ 
        $DetalleController = new DetalleController();
        $DetalleController->filter = "WHERE pedidokey = '".$_SESSION["Ecommerce-PedidoKey"]."' AND detalle_codigo = 'CTOENVIO' ";
        $DetalleController->order = "";
        $Obj = $DetalleController->GetByDetallePedido();
    ?>
    <span class="text-muted">Costo Envio:&nbsp; </span><span class="text-gray-dark">$ <?php echo $Obj->DetalleSubtotal ?> USD</span><br>
    <?php } ?>
    <span class="text-muted">Subtotal:&nbsp; </span><span class="text-gray-dark">$ <?php echo $pedidoSubtotal ?> USD</span><br>
    <span class="text-muted">Iva:&nbsp; </span><span class="text-gray-dark">$ <?php echo $pedidoIva ?> USD</span><br>
    <span class="text-muted">Total:&nbsp; </span><span class="text-gray-dark">$ <?php echo $pedidoTotal ?> USD</span>

  </div>
</div>
<div class="shopping-cart-footer">
  <div class="column">
    <button class="btn btn-primary" costo="<?php echo $_SESSION['Ecommerce-CostoEnvio'] ?>" requiere="<?php echo $costo ?>" subtotal="<?php echo $pedidoSubtotal ?>" existencia="<?php echo $cont; ?>" existencia1="<?php echo $cont1; ?>" onclick="FinishPedido(this)">
      Terminar Pedido
    </button>
  </div>
</div>