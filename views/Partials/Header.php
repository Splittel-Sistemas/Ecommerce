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
  # si existe la sesión tipo de cliente y es B2B
  if (isset($_SESSION['Ecommerce-ClienteTipo']) && $_SESSION['Ecommerce-ClienteTipo'] == "B2B") {
    if (!class_exists("GetExtraDaysController")) {
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/BusinessPartner/GetExtraDays.Controller.php';
    }if (!class_exists("GetSegmentController")) {
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/BusinessPartner/GetSegment.Controller.php';
    }
    if (!isset($_SESSION['Ecommerce-WS-GetExtraDays']) || $_SESSION['Ecommerce-WS-GetExtraDays'] == 'N/D') {
      try {
        # obtención dias extra credito que tiene actualmente cliente
        $GetExtraDaysController = new GetExtraDaysController();
        $resultGetExtraDaysController = $GetExtraDaysController->get();
        $resultGetExtraDaysController = $resultGetExtraDaysController->GetExtraDaysResult;
        $ErrorCode = $resultGetExtraDaysController->ErrorCode;
        $_SESSION['Ecommerce-WS-GetExtraDays'] = $ErrorCode == 0 ? $resultGetExtraDaysController->Value : 'N/D';
        // print_r($resultGetExtraDaysController);
      } catch (Exception $e) {
        unset($_SESSION['Ecommerce-WS-GetExtraDays']);
        $ErrorCode = -100;
      }
    }

    if ($_SESSION['Ecommerce-ClienteDescuento'] == 0 ||  $_SESSION['Ecommerce-ClienteDescuento'] == 'N/D' ||  !isset($_SESSION['Ecommerce-ClienteEjecutivo'])) {
      try {
        # obtención dias extra credito que tiene actualmente cliente
        $GetSegmentController = new GetSegmentController();
        $resultGetSegmentController = $GetSegmentController->get();
        $resultGetSegment = $resultGetSegmentController->GetSegmentResult->Diccionary->Diccionary;
        $ErrorCode = $resultGetSegmentController->GetSegmentResult->ErrorCode;
        if($ErrorCode == 0){
          $_SESSION['Ecommerce-ClienteDescuento'] = (float)$resultGetSegment[0]->Value;
          $_SESSION['Ecommerce-ClienteEjecutivo'] = $resultGetSegment[1]->Value;
        }else{
          $_SESSION['Ecommerce-ClienteDescuento'] = 'N/D';
          unset($_SESSION['Ecommerce-ClienteEjecutivo']);
        }
        // print_r($resultGetSegmentController);
      } catch (Exception $e) {
        unset($_SESSION['Ecommerce-ClienteDescuento']);
        unset($_SESSION['Ecommerce-ClienteEjecutivo']);
        $ErrorCode = -100;
      }
    }
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
      $ErrorCode = -100;
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
              $CategoriaController->filter = "";
              $CategoriaController->order = "";
              $response = $CategoriaController->get();

                foreach ($response->records as $CategoriaCont => $Categoria):
                  if ($CategoriaCont == 0 || ($CategoriaCont == 3) || ($CategoriaCont == 6) ): ?>
              <div class="row">
              <?php endif ?>
                <div class="col-sm-3">
                  <a class="d-block navi-link text-center mb-30" href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey; ?>">
                    <img class="d-block" src="../../public/images/img_spl/categorias/<?php echo $Categoria->Img; ?>">
                    <span class="text-gray-dark"><?php echo $Categoria->Descripcion; ?></span>
                  </a>
                </div>
              <?php if ($CategoriaCont == 2 || $CategoriaCont == 5 || $CategoriaCont == 8 || $response->count-1 == $CategoriaCont ): ?>
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
      <div class="toolbar-item hidden-on-mobile">
      <?php if(isset($_SESSION['Ecommerce-ClienteNombre'])){ ?> 
        <a href="../Cuenta/index.php?menu=1">
      <?php }else{ ?>
        <a href="../Login/"> 
      <?php } ?>
          <div>
            <i class="icon-user"></i><span class="text-label"></span> <?php echo isset($_SESSION['Ecommerce-ClienteNombre']) ? $_SESSION['Ecommerce-ClienteNombre'] : 'Iniciar sesión' ?>
          </div>
        </a>
        <div class="toolbar-dropdown cart-dropdown text-center px-3">
          <?php if(!isset($_SESSION['Ecommerce-ClienteNombre'])): ?>
          <p class="text-xs mb-3 pt-2">Inicie sesión en su cuenta o registre una nueva para tener control total sobre sus pedidos.</p>
          <a class="btn btn-primary btn-sm btn-block" href="../Login/">Iniciar Sesión</a>
          <p class="text-xs text-muted mb-2">¿Nuevo Cliente?&nbsp;<a href="../Login/registro.php">Registrar</a></p>
          <?php else: ?>
            <a class="list-group-item" href="../Cuenta/index.php?menu=1"><i class="icon-user"></i>Mi cuenta</a>
            <a class="btn btn-outline-primary btn-sm btn-block" href="../Login/logout.php">Salir</a>
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
        <?php if(isset($_SESSION["Ecommerce-ClienteEmail"])){ ?> 
          <a href="../Cuenta/index.php?menu=1">
        <?php }else{ ?>
          <a href="../Login"> 
          <?php } ?>
            <div>
              <i class="icon-user"></i><span class="text-label"><?php echo isset($_SESSION['Ecommerce-ClienteNombre']) ? $_SESSION['Ecommerce-ClienteNombre'] : 'Iniciar sesión' ?></span>
            </div>
          </a>
        </div>
        <?php if(isset($_SESSION["Ecommerce-ClienteEmail"])){ ?> 
        <div class="toolbar-item">
          <a href="../Login/logout.php">
            <div>
              <i class="icon-log-out"></i><span class="text-label">Salir</span>
            </div>
          </a>
        </div>
        <?php } ?>
      </div>
      <!-- Slideable (Mobile) Menu-->
      <?php 
        // obtener url actual
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[REQUEST_URI]";
        // obtener archivo de ejecucion
        $path  = basename($actual_link).PHP_EOL;
       ?>
      <nav class="slideable-menu">
        <ul class="menu" data-initial-height="385">
          <li class="has-children <?php if(trim($path) == "Home"){?>active<?php }?>">
            <span><a href="../Home/">Home</a></span>
          </li>
          <li class="has-children <?php if(trim($path) == "Nosotros"){?>active<?php }?>">
            <span><a href="../Nosotros/">Nosotros</a></span>
          </li>
          <li class="has-children">
            <span>
              <a href="javascript:void(0);">Productos</a><span class="sub-menu-toggle"></span>
            </span>
            <ul class="slideable-submenu">
            <?php 
              $CategoriaController = new CategoriaController();
              $CategoriaController->filter = "";
              $CategoriaController->order = "";
              $response = $CategoriaController->get();

                foreach ($response->records as $CategoriaCont => $Categoria): ?>
              <li>
                <a class="d-inline-block m-1" href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey; ?>">
                <img style="width: 12%; height: 12%;" class="d-inline-block" src="../../public/images/img_spl/categorias/<?php echo $Categoria->Img; ?>"/>
                <?php echo $Categoria->Descripcion;?>
                </a>
              </li>
            <?php endforeach ?>
            </ul>
          </li>
          <li class="has-children">
            <span>
              <a href="#">Soluciones</a><span class="sub-menu-toggle"></span>
            </span>
            <ul class="slideable-submenu">
            <?php 
              $SolucionesController = new SolucionesController();
              $SolucionesController->filter = "WHERE activo = 'si' ";
              $SolucionesController->order = "";
              $responseSoluciones = $SolucionesController->get(false); 

              foreach ($responseSoluciones->records as $Soluciones): ?>
              <li>
                <a href="../Soluciones/index.php?id=<?php echo $Soluciones->SolucionesKey;?>"><?php echo $Soluciones->Descripcion;?></a>
              </li>
              <?php endforeach ?> 
            </ul>
          </li>
          <li class="has-children <?php if(trim($path) == "Cursos"){?>active<?php }?>">
            <span><a href="#">Cursos</a><span class="sub-menu-toggle"></span></span>
            <ul class="slideable-submenu">
             <!-- <li><a href="../Cursos/enlinea.php">En línea</a></li> -->
              <li><a href="../Cursos/cursos.php">Presencial</a></li>
               <li><a href="../Cursos/webinar.php?pag=1">Webinar</a></li> 
          </ul>
          </li>
          <li class="has-children"><span>
            <a href="#">Biblioteca Técnica</a><span class="sub-menu-toggle"></span></span>
            <ul class="slideable-submenu">
              <li><a href="../Biblioteca/catalogo.php">Catálogo</a></li>
              <li><a href="../Biblioteca/videos.php">Videos</a></li>
              <li><a href="../Biblioteca/infografias.php">Infografías</a></li>
              <li><a href="../Biblioteca/glosario.php?r=A-E">Glosarío</a></li>
              <li><a href="../Biblioteca/informacion_tecnica.php?id=A1">Info. Técnica</a></li>
              <li><a href="../Biblioteca/fichas_tecnicas.php?id=A1">Hojas Técnicas</a></li>  
              <!-- <li><a href="../Biblioteca/cursos.php">Cursos</a></li> -->
            </ul>
          </li>
          <li class="has-children <?php  if(trim(explode("=", $path)[0]) == "index.php?pag"){?>active<?php }?>"><span><a href="../Blog/index.php?pag=1">Blog</a></span>
          </li> 
          <li class="has-children"><span>
            <a href="#">Contacto</a><span class="sub-menu-toggle"></span></span>
            <ul class="slideable-submenu">
              <li><a href="../Login/solicitud.php">Pre-registro para empresas</a></li>
              <li><a href="../Login/registro.php">Darme de alta como cliente</a></li>
              <?php 
                if (isset($_SESSION['Ecommerce-ClienteKey']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
                  header('Location: ../Home');
                }else{
              ?>
              <li><a href="../PuntoAPunto">Programa de puntos</a></li> 
                <?php } ?>
              <li><a href="../Contacto">Dirección y teléfono</a></li> 
            </ul>
          </li>
          <!--
          <li class="has-children <?php if(trim($path) == "Catalogo"){?>active<?php }?>"><span><a href="../Catalogo/">Cat&aacute;logo</a></span>
          </li>   
          -->         
        </ul>
      </nav>
    </div>
  </div>
  <!-- Navbar-->
  <div class="navbar">
    <div class="btn-group categories-btn">
      <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"><i class="icon-menu text-lg"></i>&nbsp;Categorias</button>
      <div class="dropdown-menu mega-dropdown">
      <?php 
        $CategoriaController = new CategoriaController();
        $CategoriaController->filter = "";
        $CategoriaController->order = "";
        $response = $CategoriaController->get();

          foreach ($response->records as $CategoriaCont => $Categoria):
            if ($CategoriaCont == 0 || ($CategoriaCont == 3) || ($CategoriaCont == 6)  ): ?>
        <div class="row">
        <?php endif ?>
          <div class="col-sm-3">
            <a class="d-block navi-link text-center mb-30" href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey; ?>">
              <img class="d-block" src="../../public/images/img_spl/categorias/<?php echo $Categoria->Img; ?>">
              <span class="text-gray-dark"><?php echo $Categoria->Descripcion; ?></span>
            </a>
          </div>
        <?php if ($CategoriaCont == 2 || $CategoriaCont == 5 || $CategoriaCont == 8 || $response->count-1 == $CategoriaCont ): ?>
        </div>
        <?php endif ?>
      <?php endforeach ?> 
      </div>
    </div>
    <nav class="site-menu">
      <ul>
        <li class="has-submenu <?php if(trim($path) == "Home"){?>active<?php }?>">
          <a href="../Home/">Home </a> 
        </li>
        <li class="has-submenu <?php if(trim($path) == "Nosotros"){?>active<?php }?>">
          <a href="../Nosotros/">Nosotros</a>
        </li>
        <li class="has-megamenu">
          <a href="#">Productos</a>
            <ul class="mega-menu">
            <li><span class="mega-menu-title">Categorías</span>
              <ul class="sub-menu">
              <?php 
                $CategoriaController = new CategoriaController();
                $CategoriaController->filter = "";
                $CategoriaController->order = "";
                $response = $CategoriaController->get();

                  foreach ($response->records as $CategoriaCont => $Categoria): ?>
                <li>
                  <a class="d-inline-block m-1" href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey; ?>">
                  <img style="width: 12%; height: 12%;" class="d-inline-block" src="../../public/images/img_spl/categorias/<?php echo $Categoria->Img; ?>"/>
                  <?php echo $Categoria->Descripcion;?>
                  </a>
                </li>
              <?php endforeach ?>
              </ul>
            </li>
            <li><span class="mega-menu-title">Top Subcategorías</span>
              <ul class="sub-menu">
              <?php 
                $SubcategoriasController = new SubcategoriasController();
                $SubcategoriasController->filter = "WHERE activo = 'si' ";
                $SubcategoriasController->order = "ORDER BY RAND() LIMIT 8";
                $response = $SubcategoriasController->get(false);

                  foreach ($response->records as $SubcategoriasCont => $Subcategorias): ?>
                <li>
                  <a <?php if($Subcategorias->Subnivel=='NO'){ ?> href="../Productos/categorias.php?id_sbct=<?php echo $Subcategorias->SubcategoriasKey;?>&sbn=no" <?php }?> <?php if($Subcategorias->Subnivel=='SI'){ ?> href="../Productos/categorias.php?id_sbct=<?php echo $Subcategorias->SubcategoriasKey;?>&sbn=si" <?php }?>><?php echo $Subcategorias->Descripcion;?>
                    
                  </a>
                </li>
              <?php endforeach ?>
              </ul>
            </li>
            <li>
              <?php 
                $ContactoController = new ContactoController();
                $Contacto = $ContactoController->GetBy();
              ?>
              <span class="mega-menu-title">Ubicación</span>
              <div class="card mb-3">
                <div class="card-body">
                  <ul class="list-icon">
                    <li> 
                      <i class="icon-map-pin text-muted"></i><?php echo $Contacto->GetUbicacion(); ?>
                    </li>
                    <li> 
                      <i class="icon-phone text-muted"></i><?php echo $Contacto->GetTelefono(); ?>
                    </li>
                    <li class="mb-0">
                      <i class="icon-mail text-muted"></i>
                      <a class="navi-link" href="mailto: <?php echo $Contacto->GetEmail(); ?>"> 
                        <?php echo $Contacto->GetEmail(); ?>
                      </a>
                    </li>
                    <li> 
                      <i class="icon-clock text-muted"></i><?php echo $Contacto->GetHorario(); ?></li>
                  </ul>
                </div>
              </div>
            </li>
            <li>
            <a class="card border-0 bg-secondary rounded-0" href="../Catalogo/">
            <img class="d-block mx-auto" alt="Catalogo" src="../../public/images/img_spl/adicionales/descarga_catalogo.jpg"/></a>
            </li>
          </ul>
        </li>
        <li class="has-submenu <?php if(trim($path) == "Soluciones"){?>active<?php }?>">
          <a href="#">Soluciones</a> 
            <ul class="sub-menu">
            <?php 
              $SolucionesController = new SolucionesController();
              $SolucionesController->filter = "WHERE activo = 'si' ";
              $SolucionesController->order = "";
              $responseSoluciones = $SolucionesController->get(false); 

              foreach ($responseSoluciones->records as $Soluciones): ?>
              <li>
                <a href="../Soluciones/index.php?id=<?php echo $Soluciones->SolucionesKey;?>"><?php echo $Soluciones->Descripcion;?></a>
              </li>
            <?php endforeach ?> 
            </ul>
        </li>
        <li class="has-submenu <?php if(trim($path) == "Cursos"){?>active<?php }?>">
          <a href="#">Cursos</a>
          <ul class="sub-menu">
             <!-- <li><a href="../Cursos/enlinea.php">En línea</a></li> -->
              <li><a href="../Cursos/cursos.php">Presencial</a></li>
              <li><a href="../Cursos/webinar.php?pag=1">Webinar</a></li> 
          </ul>
        </li>
        <li class="has-submenu <?php if(trim($path) == "Biblioteca"){?>active<?php }?>"><a href="#">Biblioteca Técnica</a>
         <ul class="sub-menu">
              <li><a href="../Biblioteca/catalogo.php">Catálogo</a></li>
              <li><a href="../Biblioteca/videos.php">Videos</a></li>
              <li><a href="../Biblioteca/infografias.php">Infografías</a></li>
              <li><a href="../Biblioteca/glosario.php?r=A-E">Glosarío</a></li>
              <li><a href="../Biblioteca/informacion_tecnica.php?id=A1">Info. Técnica</a></li>
              <li><a href="../Biblioteca/fichas_tecnicas.php?id=A1">Hojas Técnicas</a></li>  
              <!-- <li><a href="../Biblioteca/cursos.php">Cursos</a></li> -->
            </ul>
        </li>
        <li class="has-submenu <?php  if(trim(explode("=", $path)[0]) == "index.php?pag"){?>active<?php }?>"><a href="../Blog/index.php?pag=1">Blog </a></li>

        <li class="has-submenu"><a href="#">Contacto</a>
          <ul class="sub-menu">
            <li><a href="../Login/solicitud.php">Pre-registro para empresas</a></li>
            <li><a href="../Login/registro.php">Darme de alta como cliente</a></li>
            <?php 
              if (isset($_SESSION['Ecommerce-ClienteKey']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
            ?>
            <li><a href="../PuntoAPunto">Programa de puntos</a></li> 
              <?php } ?>
            <li><a href="../Contacto">Dirección y teléfono</a></li> 
          </ul>
        </li>

        <!--
        <li class="has-submenu <?php if(trim($path) == "Catalogo"){?>active<?php }?>"><a href="../Catalogo/">Cat&aacute;logo</a></li>
        -->
      </ul>
    </nav>
    <!-- Toolbar ( Put toolbar here only if you enable sticky navbar )-->
    <div class="toolbar">
      <div class="toolbar-inner">
        <div class="toolbar-item"><a href="javascript:void(0);">
        <div><span class="text-label "><strong>TIPO DE CAMBIO</strong><br />1 USD = <?php echo $_SESSION['Ecommerce-WS-CurrencyRate'];?> MXP</span></div></a></div>
        <div class="toolbar-item" id="ListResumenProductosCarritoMovil">
          <?php include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/views/Carrito/Resumen/index.php'; ?>
        </div>
      </div>
    </div>
  </div>
</header>
<div id="customizer-backdrop" class="customizer-backdrop"></div>

<!-- Liberación memoria objetos -->
<?php 
unset($Categoria);
unset($response);
unset($Soluciones);
unset($responseSoluciones);
unset($Subcategoria);
unset($responseSucategoria);
unset($GetCurrencyRate);
unset($ResponseGetCurrencyRate);
?>