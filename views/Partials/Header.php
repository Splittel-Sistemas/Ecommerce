<?php 
  @session_start();
  if (!class_exists("CategoriaController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Categorias/Categoria.Controller.php';
  }if (!class_exists("SolucionesController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Soluciones/Soluciones.Controller.php';
  }if (!class_exists("SubcategoriasController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Subcategorias/Subcategorias.Controller.php';
  }if (!class_exists("ContactoControlller")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Contacto/Contacto.Controller.php';
  }
  if (!class_exists("SubmenuController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Submenu/Submenu.Controller.php';
  }
  # si no existe la $_SESSION['Ecommerce-WS-CurrencyRate']
  if (!isset($_SESSION['Ecommerce-WS-CurrencyRate']) || $_SESSION['Ecommerce-WS-CurrencyRate'] == 'N/D') {
    if (!class_exists("GetCurrencyRateController")) {
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/Currency/GetCurrencyRate.Controller.php';
    }
    try {
      # obtención tipo de cambio 
      $GetCurrencyRateController = new GetCurrencyRateController();
      $resultGetCurrencyRateController = $GetCurrencyRateController->get();
      // print_r($resultGetCurrencyRateController);
      $resultGetCurrencyRateController = $resultGetCurrencyRateController->GetCurrencyRateResult;
      $ErrorCode = $resultGetCurrencyRateController->ErrorCode;
      $_SESSION['Ecommerce-WS-CurrencyRate'] = $ErrorCode == 0 ? $resultGetCurrencyRateController->Record->Rate : 'N/D';
    } catch (Exception $e) {
      unset($_SESSION['Ecommerce-WS-CurrencyRate']);
      $Message = "No se pudo obtener tipo de cambio";
      $ErrorCode = -703;
    }
  }

 ?>
<!-- Header-->
<!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
<header class="site-header navbar-sticky">
  <!-- Topbar-->
  <div class="topbar d-flex justify-content-between">
    <!-- Logo-->
    <div class="site-branding d-flex">
      <a class="site-logo align-self-center" href="../Home/"><img src="../../public/images/img/logo/logo.png" alt="Fibremex"></a>
    </div>
    

    <!-- Search / Categories-->
    <div class="search-box-wrap d-flex">
      <div class="search-box-inner align-self-center">
        <div class="search-box d-flex">
          <div class="btn-group categories-btn">
            <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"><i class="icon-menu text-lg"></i>&nbsp;Categor&iacute;as</button>
            <div class="dropdown-menu mega-dropdown">
            <?php 
              $CategoriaController = new CategoriaController();
              $CategoriaController->filter = "WHERE activo='si'";
              $CategoriaController->order = "";
              $response = $CategoriaController->get();

                foreach ($response->records as $CategoriaCont => $Categoria):
                  if ($CategoriaCont == 0 || ($CategoriaCont == 4)  ): ?>
              <div class="row">
              <?php endif ?>
                <div class="col-sm-3">
                  <a class="d-block navi-link text-center mb-30" href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey; ?>&nom=<?php echo url_amigable($Categoria->Descripcion);?>">
                    <img class="d-block" src="../../public/images/img_spl/categorias/<?php echo $Categoria->Img; ?>">
                    <span class="text-gray-dark"><?php echo $Categoria->Descripcion; ?></span>
                  </a>
                </div>
              <?php if ($CategoriaCont == 3 || $CategoriaCont == 7 ): ?>
              </div>
              <?php endif ?>
              <?php endforeach ?>
            </div>
          </div>
          <form class="input-group"><span class="input-group-btn">
          <button type="submit"><i class="icon-search"></i></button></span>
          <input class="form-control search" movil="0" id="search-0" type="search" placeholder="Buscar producto..." autocomplete="off" onkeyup="Buscador(this)">
          <div class="row" style="position: absolute; z-index: 100">
            <div class="col-md-12 margin-bottom-2x">
              <nav class="list-group lista-productos" id="lista-productos-0">

              </nav>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
    <!-- Toolbar-->
    <div class="toolbar d-flex">
      <div class="toolbar-item visible-on-mobile mobile-menu-toggle"><a href="#">
          <div><i class="icon-menu"></i><span class="text-label">Menu</span></div></a></div>
      <div class="toolbar-item hidden-on-mobile col-md-6">
        <a href="javascript:void(0);">
          <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Login/seguridad.php';  ?>
          <div id="dataInterna" primero="<?php echo $_SESSION['AuthUser']; ?>" segundo="<?php echo $_SESSION['AuthPassword']; ?>">
            <span class="text-label">
              <strong>TIPO DE CAMBIO</strong><br />1 USD = <?php echo $_SESSION['Ecommerce-WS-CurrencyRate'];?> MXP 
            </span>
          </div>
        </a>
      </div>

      <?php 
        $ContactoController = new ContactoController();
        $Contacto = $ContactoController->GetBy();
        if(isset($_SESSION['Ecommerce-ClienteTipo']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B' ){
          $mailAssigment = $_SESSION['Ecommerce-ClienteEjecutivo'];
        }else{
          $mailAssigment = "sac@fibremex.com.mx";
        }
      ?>

      <div class="toolbar-item hidden-on-mobile">
        <?php if(isset($_SESSION['Ecommerce-ClienteNombre'])){ ?> 
        <a href="../Cuenta/index.php?menu=1">
        <?php }else{ ?>
        <a href="../Login/"> 
        <?php } ?>
          <div>
            <i class="icon-user"></i><span class="text-label"></span> <?php echo isset($_SESSION['Ecommerce-ClienteNombre']) ? utf8_encode($_SESSION['Ecommerce-ClienteNombre'] ): 'Iniciar sesión' ?>
          </div>
        </a>
        <div class="toolbar-dropdown cart-dropdown widget-cart hidden-on-mobile">
          <!-- Entry-->
          <div class="entry">
            <div class="entry-thumb"> <a href="tel:<?php echo '01 800 '.$Contacto->GetTelefono(); ?>" style="text-decoration: none; font-size: 20px;"> <i class="icon-phone"></i> </a> </div>
            <div class="entry-content">
              <h4 class="entry-title"> <a href="javascript:void()">Teléfono</a> </h4>
              <a class="entry-meta" style="text-decoration: none;" href="tel:<?php echo '01 800 '.$Contacto->GetTelefono(); ?>"><?php echo '01 800 '.$Contacto->GetTelefono(); ?></a>
            </div>
          </div>
          <!-- Entry-->
          <div class="entry">
            <div class="entry-thumb"> <a href="mailto:<?php echo $mailAssigment; ?>" style="text-decoration: none; font-size: 20px;"> <i class="icon-mail"></i> </a> </div>
            <div class="entry-content">
              <h4 class="entry-title"> <a href="javascript:void()">Mail</a> </h4>
              <a class="entry-meta" style="text-decoration: none;" href="mailto:<?php echo $mailAssigment; ?>"><?php echo $mailAssigment; ?></a>
            </div>
          </div>
          <!-- Entry-->
          <div class="entry">
            <div class="entry-thumb"> <a href="/fibra-optica/views/Consultecnico" style="text-decoration: none; font-size: 20px;"> <i class="icon-link"></i> </a> </div>
            <div class="entry-content">
            <h4 class="entry-title"> <a onclick="window.open('/fibra-optica/views/Consultecnico','_self');" href="javascript:void(0)">Ir a Consultecnico</a> </h4>
            </div>
          </div>
          <?php if(!isset($_SESSION['Ecommerce-ClienteNombre'])): ?>
          <p class="text-xs mb-3 pt-2">Inicie sesión en su cuenta o registre una nueva para tener control total sobre sus pedidos.</p>
          <a class="btn btn-primary btn-sm btn-block" href="../Login/">Iniciar Sesión</a>
         <!-- <p class="text-xs text-muted mb-2">¿Nuevo Cliente?&nbsp;<a href="../Login/registro.php">Registrar</a></p> -->
          <?php else: ?>
          <!-- Entry-->
          <div class="entry">
            <div class="entry-thumb"> <a href="fibra-optica/views/Cuenta/index.php?menu=1" style="text-decoration: none; font-size: 20px;"> <i class="icon-user"></i> </a> </div>
            <div class="entry-content">
            <h4 class="entry-title"> <a onclick="window.open('/fibra-optica/views/Cuenta/index.php?menu=1','_self');" href="javascript:void(0)">Ir a mi cuenta</a> </h4>
            </div>
          </div>
           <!-- Entry-->
           <div class="entry">
            <div class="entry-thumb"> <a href="/fibra-optica/views/Login/logout.php" style="text-decoration: none; font-size: 20px;"> <i class="icon-power"></i> </a> </div>
            <div class="entry-content">
            <h4 class="entry-title"> <a onclick="window.open('/fibra-optica/views/Login/logout.php','_self');" href="javascript:void(0)">Salir</a> </h4>
            </div>
          </div>
          <?php endif ?>
        </div>
      </div>
      
      <div id="ListResumenProductosCarrito" class="toolbar-item" >
        <?php include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/Carrito/Resumen/index.php'; ?>     
      </div>
    </div>
    <!-- Mobile Menu-->
    <div class="mobile-menu">
      <!-- Search Box-->
      <div class="mobile-search">
        <form class="input-group" method="get"><span class="input-group-btn">
          <button type="submit"><i class="icon-search"></i></button></span>
          <input class="form-control search" movil="1" name="search" id="search-1" type="search" placeholder="Buscar producto..." autocomplete="off" onkeyup="BuscarProductos(this)">
          <div class="row" style="position: absolute; z-index: 100">
              <div class="col-md-12 margin-bottom-2x">
                <nav class="list-group lista-productos" id="lista-productos-1">

                </nav>
              </div>
            </div>
        </form>
      </div>
      <!-- Toolbar-->
      <div class="toolbar">
        <div class="toolbar-item">
          <a href="javascript:void(0);">
            <div>
              <div>
                <span class="text-label">
                  <strong>TIPO DE CAMBIO</strong><br />1 USD = <?php echo $_SESSION['Ecommerce-WS-CurrencyRate'];?> MXP
                </span>
              </div>
            </div>
          </a>
        </div>
        
        <div class="toolbar-item">
        <?php if(isset($_SESSION['Ecommerce-ClienteNombre'])){ ?> 
        <a href="javascript:void()">
        <?php }else{ ?>
        <a href="javascript:void()"> 
        <?php } ?>
          <div>
            <i class="icon-user"></i><span class="text-label"></span> <?php echo isset($_SESSION['Ecommerce-ClienteNombre']) ? $_SESSION['Ecommerce-ClienteNombre'] : 'Iniciar sesión' ?>
          </div>
        </a>
        <div class="toolbar-dropdown cart-dropdown widget-cart">
          <!-- Entry-->
          <div class="entry">
            <div class="entry-thumb"> <a href="tel:<?php echo '01 800 '.$Contacto->GetTelefono(); ?>" style="text-decoration: none; font-size: 20px;"> <i class="icon-phone"></i> </a> </div>
            <div class="entry-content">
              <h4 class="entry-title"> <a href="javascript:void()">Telefono</a> </h4>
              <a class="entry-meta" style="text-decoration: none;" href="tel:<?php echo '01 800 '.$Contacto->GetTelefono(); ?>"><?php echo '01 800 '.$Contacto->GetTelefono(); ?></a>
            </div>
          </div>
          <!-- Entry-->
          <div class="entry">
            <div class="entry-thumb"> <a href="mailto:<?php echo $mailAssigment; ?>" style="text-decoration: none; font-size: 20px;"> <i class="icon-mail"></i> </a> </div>
            <div class="entry-content">
              <h4 class="entry-title"> <a href="javascript:void()">Mail</a> </h4>
              <a class="entry-meta" style="text-decoration: none;" href="mailto:<?php echo $mailAssigment; ?>"><?php echo $mailAssigment; ?></a>
            </div>
          </div>
          <!-- Entry-->
          <div class="entry">
            <div class="entry-thumb"> <a href="/fibra-optica/views/Consultecnico" style="text-decoration: none; font-size: 20px;"> <i class="icon-link"></i> </a> </div>
            <div class="entry-content">
              <h4 class="entry-title"> <a onclick="window.open('/fibra-optica/views/Consultecnico','_self');" href="javascript:void(0)">Ir a Consultecnico</a> </h4>
            <!--  <a class="entry-meta" style="text-decoration: none;" href="/fibra-optica/views/Consultecnico">Ir a consultecnico</a>  -->
            </div>
          </div>
          <?php if(!isset($_SESSION['Ecommerce-ClienteNombre'])): ?>
          <p class="text-xs mb-3 pt-2">Inicie sesión en su cuenta o registre una nueva para tener control total sobre sus pedidos.</p>
          <a class="btn btn-primary btn-sm btn-block" href="../Login/">Iniciar Sesión</a>
          <!-- <p class="text-xs text-muted mb-2">¿Nuevo Cliente?&nbsp;<a href="../Login/registro.php">Registrar</a></p>  -->
          <?php else: ?>
          <!-- Entry-->
          <div class="entry">
            <div class="entry-thumb"> <a href="fibra-optica/views/Cuenta/index.php?menu=1" style="text-decoration: none; font-size: 20px;"> <i class="icon-user"></i> </a> </div>
            <div class="entry-content">
              <h4 class="entry-title"> <a onclick="window.open('/fibra-optica/views/Cuenta/index.php?menu=1','_self');" href="javascript:void(0)">Ir a mi cuenta</a> </h4>
              <!--<a class="entry-meta" style="text-decoration: none;" href="/fibra-optica/views/Cuenta/index.php?menu=1">Ir a mi cuenta</a>  -->
            </div>
          </div>
           <!-- Entry-->
           <div class="entry">
            <div class="entry-thumb"> <a href="/fibra-optica/views/Login/logout.php" style="text-decoration: none; font-size: 20px;"> <i class="icon-power"></i> </a> </div>
            <div class="entry-content">
              <h4 class="entry-title"> <a onclick="window.open('/fibra-optica/views/Login/logout.php','_self');" href="javascript:void(0)">Salir</a> </h4>
              <!-- <a class="entry-meta" style="text-decoration: none;" href="/fibra-optica/views/Login/logout.php">salir</a>  -->
            </div>
          </div>
          <?php endif ?>
        </div>
      </div>

      </div>
      
      <!-- Slideable (Mobile) Menu-->
      <?php 
        // obtener url actual
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[REQUEST_URI]";
        // obtener archivo de ejecucion
        $path  = basename($actual_link).PHP_EOL;
       ?>
      
        <!--Menu movil-->
        <?php
      if (isset($_SESSION['Ecommerce-ClienteTipo']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/Partials/Menu/B2B/Menu-movil.php'; 
      }else{
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/Partials/Menu/B2C/Menu-movil.php'; 
      }
    ?>
    </div>

    
  </div>

<!-- Menu normal  -->
  
<?php
      if (isset($_SESSION['Ecommerce-ClienteTipo']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/Partials/Menu/B2B/Menu.php'; 
      }else{
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/Partials/Menu/B2C/Menu.php'; 
      }
    ?>


</header>
<div id="customizer-backdrop" class="customizer-backdrop"></div>

<!-- Liberación memoria objetos -->
<?php 
function url_amigable($url_tmp) {
  ##webdebe.com
  //Convertimos a minúsculas y UTF8
  $url_utf8 = mb_strtolower($url_tmp, 'UTF-8');

  //Reemplazamos espacios por guion
  $find = array(' ', '&', '\r\n', '\n', '+');
  $url_utf8 = str_replace ($find, '-', $url_utf8);

  $url_utf8 = strtr(utf8_decode($url_utf8),
      utf8_decode('_àáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'),
      '-aaaaaaaceeeeiiiionoooooouuuuyy');

  //Ya que usamos TRANSLIT en el comando iconv, tenemos que limpiar los simbolos que quedaron
  $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
  $repl = array('', '-', '');
  $url = preg_replace ($find, $repl, $url_utf8);

  return $url;
}
unset($Categoria);
unset($response);
unset($Soluciones);
unset($responseSoluciones);
unset($Subcategoria);
unset($Subcategoria_);
unset($responseSucategoria);
unset($GetCurrencyRate);
unset($ResponseGetCurrencyRate);
?>