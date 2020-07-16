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
?>

<div class="alert alert-info alert-dismissible fade show text-center margin-bottom-1x">
  <span class="alert-close" data-dismiss="alert"></span><i class="icon-layers"></i>&nbsp;&nbsp;
  <span class='text-medium'>Total Puntos Disponibles: </span> <?php echo isset($_SESSION['Ecommerce-ClientePuntosDisponibles']) ? $_SESSION['Ecommerce-ClientePuntosDisponibles'] : 0 ?>
</div>

<div class="row">
  <?php foreach ($Result->records as $key => $Producto){ ?>
  <div class="col-lg-4 col-md-4 col-sm-4 col-12" >
    <div class="product-card mb-30 grid_1_4" >
      <a class="product-thumb">
        <?php 
          $imgUrl = file_exists("../../public/images/img_spl/puntoapunto/Productos/".$Producto->Descripcion.".jpg") ?  "../../public/images/img_spl/puntoapunto/Productos/".$Producto->Descripcion.".jpg" :"../../public/images/img_spl/notfound.png"; 
        ?>
        <img src="<?php echo $imgUrl; ?>" alt="<?php echo $Producto->Descripcion;?>">
      </a>
      <div class="product-card-body">
        <div class="product-category "><a><?php echo $Producto->Codigo?></a></div>
        <h3 class="product-title grid_1_3">
        <a><?php echo $Producto->Descripcion;?></a>
        
        </h3>
        <h4 class="product-price">
        <?php echo $Producto->Puntos; ?> PTS
        </h4>
      </div>
      <div class=" product-button-group">
        <?php if($_SESSION['Ecommerce-ClientePuntosDisponibles'] > $Producto->Puntos){ ?>
        <a class="product-button" href="#" descuento="0" codigo="<?php echo $Producto->Codigo;?>" puntos="<?php echo $Producto->Puntos;?>" existe="<?php echo $Producto->ExisteSap;?>" key="<?php echo $Producto->Key;?>" onclick="DatosEnvioPuntosModal(this)">
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