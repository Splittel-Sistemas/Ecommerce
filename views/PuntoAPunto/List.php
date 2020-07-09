<div class="row">
  <?php  
    if (!class_exists("PuntosProductosController")) {
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Puntos/PuntosProductos.Controller.php';
    } if (!class_exists('ClienteController')) {
      include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cliente/Cliente.Controller.php';
    }
    if(!isset($_SESSION['Ecommerce-ClientePuntosDisponibles'])){
      $ClienteController = new ClienteController();
      $ResultGetTotalPuntos = $ClienteController->GetTotalPuntos();
      $TotalPuntos = $ResultGetTotalPuntos->PuntosTotal;
      $ResultGetTotalPuntosCanjeados = $ClienteController->GetTotalPuntosCanjeados();
      $PuntosCanjeados = empty($ResultGetTotalPuntosCanjeados->PuntosTotal) ? 0 : $ResultGetTotalPuntosCanjeados->PuntosTotal;
      $_SESSION['Ecommerce-ClientePuntosDisponibles'] = $TotalPuntos - $PuntosCanjeados;
    }

    $PuntosProductosController = new PuntosProductosController();
    $Result = $PuntosProductosController->Get();
    foreach ($Result->records as $key => $Producto){
  ?>
  <div class="col-lg-4 col-md-4 col-sm-4 col-4" >
    <div class="product-card mb-30 grid_1_4" >
      <a class="product-thumb" href="../Productos/fijos.php?id_prd=<?php echo $Producto->Codigo;?>">
        <?php 
          $imgUrl = "../../public/images/img_spl/notfound.png"; 
        ?>
        <img src="<?php echo $imgUrl; ?>" alt="<?php echo $Producto->Descripcion;?>">
      </a>
      <div class="rating-stars">
        <?php 
          if (!class_exists('ComentariosController')) {
            include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Productos/Comentarios.Controller.php';
          }
          $ComentariosController = new ComentariosController();
          $ComentariosController->filter = "WHERE IdProducto = '".$Producto->Codigo."'";
          $Comentarios = $ComentariosController->Comentarios();
          
          if($Comentarios->count > 0){
            $RecordsComentarios = $Comentarios->records[0];
            $Promedio = (int)$RecordsComentarios->Promedio;
            for ($i=0; $i < 5; $i++) { 
              if ($i < $Promedio) {
        ?>
        <i class="icon-star filled"></i>
        <?php }else{ ?>
        <i class="icon-star"></i>
        <?php } } }else{ ?>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
          <i class="icon-star"></i>
        <?php } ?>
      </div>
      <div class="product-card-body">
        <div class="product-category "><a href="../Productos/fijos.php?id_prd=<?php echo $Producto->Codigo;?>"><?php echo $Producto->Codigo?></a></div>
        <h3 class="product-title grid_1_3">
        <a href="../Productos/fijos.php?id_prd=<?php echo $Producto->Codigo;?>"><?php echo $Producto->Descripcion;?></a>
        
        </h3>
        <h4 class="product-price">
        <?php echo $Producto->Puntos; ?> PTS
        </h4>
      </div>
      <div class=" product-button-group">
        <?php if($_SESSION['Ecommerce-ClientePuntosDisponibles'] > $Producto->Puntos){ ?>
        <a class="product-button" href="#" descuento="0" codigo="<?php echo $Producto->Codigo;?>" puntos="<?php echo $Producto->Puntos;?>" onclick="DatosEnvioPuntosModal(this)">
          <i class="icon-shopping-cart"></i><span>Canjear</span>
        </a>
        <?php }else{?>
        <a class="product-button" href="#" >
          <i class="icon-shopping-cart"></i><span>Puntos insuficientes</span>
        </a>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php } ?>
</div>