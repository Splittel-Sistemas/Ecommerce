<div id="AlertCart">
  
</div>
<div class="table-responsive shopping-cart">
  <table class="table">
    <thead>
      <tr>
        <th>Producto</th>
        <th class="text-center"> </th>

        <th class="text-center">Cantidad</th>
        <th class="text-center">Subtotal</th>
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

        if($Obj->count > 0){
          foreach ($Obj->records as $key => $data) {			
            if(!($data->ProductoCodigo == '') && $data->ProductoCodigoConfigurable == ''){
              # Producto Fijo		
              $ImgUrl = file_exists("../../public/images/img_spl/productos/".$data->ProductoCodigo."/thumbnail/".$data->ProductoImgPrincipal."") 
                  ? "../../public/images/img_spl/productos/".$data->ProductoCodigo."/thumbnail/".$data->ProductoImgPrincipal."" 
                  : "../../public/images/img_spl/notfound.png"				
      ?>
          <!-- Producto -->
          <td>
            <div class="product-item">
              <a class="product-thumb" href="#">
                <img src="<?php echo $ImgUrl; ?>" alt="Product">
              </a>
              <div class="product-info">
                <h4 class="product-title">
                  <a href="#"><?php echo $data->ProductoDescripcion;?></a>
                </h4>
                <span><em>Clave:</em> <?php echo $data->ProductoCodigo;?></span>
              </div>
            </div>
          </td>
          <td></td>
          <!-- Cantidad -->
          <td class="text-center text-lg">
            <?php echo $data->DetalleCantidad ?>
          </td>
          <!-- Subtotal -->
          <td class="text-center text-lg">
            $ <?php echo $data->DetalleSubtotal ?> USD
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
              <a class="product-thumb" href="#">
                <img src="<?php echo $ImgUrl; ?>" alt="Product">
              </a>
              <div class="product-info">
                <h4 class="product-title">
                  <a  href="#"><?php echo $data->ProductoDescripcion;?></a>
                </h4>
                <span><em>Clave:</em> <?php echo $data->ProductoCodigo;?></span>
              </div>
            </div>
          </td>
          <td class="text-center text-lg">
           
          </td>
          <!-- Cantidad -->
          <td class="text-center text-lg">
            <?php echo $data->DetalleCantidad ?>
          </td>
          <!-- Subtotal -->
          <td class="text-center text-lg">
            $ <?php echo $data->DetalleSubtotal ?> USD
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
              <a class="product-thumb" href="#">
                <img src="<?php echo $ImgUrl; ?>" alt="Product">
              </a>
              <div class="product-info">
                <h4 class="product-title">
                  <a  href="#"><?php echo $data->ProductoConfigurableNombre;?></a>
                </h4>
                <span><em>Clave:</em> <?php echo $data->DetalleCodigo;?></span>
              </div>
            </div>
          </td>

          <td class="text-center text-lg">
            <ul class="list-unstyled"><li class="text-md text-success">Tiempo de fabricación. <?php echo $data->TiempoEntrega;?></li></ul>
          </td>
          <!-- Cantidad -->
          <td class="text-center text-lg">
            <?php echo $data->DetalleCantidad ?>
          </td>
          <!-- Subtotal -->
          <td class="text-center text-lg">
            $ <?php echo $data->DetalleSubtotal ?> USD
          </td>

      <?php } ?>
      </tr>
      <?php }}else{ ?>

      <?php } ?>
    </tbody>
  </table>
</div>

<div class="shopping-cart-footer">
  <div class="column text-lg">
    <?php
      $pedidoSubtotal = 0;
      $pedidoIva = 0;
      $pedidoTotal = 0; 
      $pedidoTotalMXN = 0; 

      if(isset($_SESSION["Ecommerce-PedidoKey"])){
        $PedidoController = new PedidoController;
        $PedidoController->filter = "WHERE id = ".$_SESSION["Ecommerce-PedidoKey"]." ";
        $PedidoController->order = "";
        # obtención de subtotal iva y total del pedido actual
        $Pedido = $PedidoController->getBy();
        $pedidoSubtotal = $Pedido->GetSubTotal();
        $pedidoIva = $Pedido->GetIva();
        $pedidoTotal = $Pedido->GetTotal(); 
        $pedidoTotalMXN = $Pedido->PedidoTotalMXN;
      }
      $_SESSION['Ecommerce-PedidoTotal'] = $pedidoTotalMXN;

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
    <input type="hidden" name="TotalValidacion" id="TotalValidacion" value="<?php echo $pedidoTotalMXN ;?>">

  </div>
</div>