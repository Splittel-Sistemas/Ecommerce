 <!-- Navbar-->
 <div class="navbar">
    <div class="btn-group categories-btn">
      <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"><i class="icon-menu text-lg"></i>&nbsp;Categor&iacute;as</button>
      <div class="dropdown-menu mega-dropdown">
      <?php 
        $CategoriaController = new CategoriaController();
        $CategoriaController->filter = "WHERE activo='si'";
        $CategoriaController->order = "";
        $response = $CategoriaController->get();

          foreach ($response->records as $CategoriaCont => $Categoria):
            if ($CategoriaCont == 0 || ($CategoriaCont == 3) || ($CategoriaCont == 6)  ): ?>
        <div class="row">
        <?php endif ?>
          <div class="col-sm-3">
            <a class="d-block navi-link text-center mb-30" href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey; ?>&nom=<?php echo url_amigable($Categoria->Descripcion);?>">
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
        <li class="has-megamenu">
          <a href="#">Productos</a>
            <ul class="mega-menu">
            <li><span class="mega-menu-title">Categorías</span>
              <ul class="sub-menu">
              <?php 
                $CategoriaController = new CategoriaController();
                $CategoriaController->filter = "WHERE activo = 'si' ";
                $CategoriaController->order = "ORDER BY orden DESC";
                $response = $CategoriaController->get();

                  foreach ($response->records as $CategoriaCont => $Categoria): ?>
                <li>
                  <a class="d-inline-block m-1" href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey; ?>&nom=<?php echo url_amigable($Categoria->Descripcion);?>">
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
                $SubmenuController = new SubmenuController();
                $SubmenuController->filter = "WHERE nivel=2 AND activo='si' ";
                $SubmenuController->order = "ORDER BY RAND() LIMIT 12";
                $Subcategoria = $SubmenuController->get();
              // print_r($Subcategoria->records);
                if ($Subcategoria->count > 0){ 
                  foreach ($Subcategoria->records as $key => $Subcategoria_){
                ?>
                <li>
                  <a href="../Productos/categorias.php?id_sbct=<?php echo $Subcategoria_->Key;?>&nom=<?php echo url_amigable($Subcategoria_->Descripcion);?>" >
                  <?php echo $Subcategoria_->Descripcion;?>
                  </a>
                </li>
              <?php }
              }
              ?>
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
          <a href="../Soluciones/">Soluciones</a>
        </li>
        <!--
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
                <a  href="../Soluciones/<?php echo $Soluciones->SolucionesKey;?>-<?php echo url_amigable($Soluciones->Descripcion);?>"><?php echo $Soluciones->Descripcion;?></a>
              </li>
            <?php endforeach ?> 
            </ul>
        </li>
              -->
        <!--
        <li class="has-submenu <?php if(trim($path) == "Cursos"){?>active<?php }?>">
          <a href="#">Cursos</a>
          <ul class="sub-menu">
              <li><a href="../Cursos/enlinea.php">En línea</a></li> 
              <li><a href="../Cursos/cursos-fibra-optica.php">Presencial</a></li>
              <li><a href="../Cursos/webinar.php?pag=1">Webinar</a></li> 
          </ul>
        </li>
              -->
        <li class="has-megamenu">
          <a href="#">Capacitaciones</a>
            <ul class="mega-menu">
            <li><span class="mega-menu-title">FINTEC</span>
              <ul class="sub-menu">
                <li>
                  <a class="d-inline-block" href="../Capacitaciones/1-fintec">
                  <img style="width: 15%; height: 15%;" class="d-inline-block" src="../../public/images/img_spl/capacitaciones/1.jpg"/>
                  ¿Qué es Fintec?
                  </a>
                </li>
                <!--
                <li>
                  <a class="d-inline-block" href="../Capacitaciones/1-fintec#calendar">
                  <img style="width: 15%; height: 15%;" class="d-inline-block" src="../../public/images/img_spl/capacitaciones/2.jpg"/>
                  Calendario
                  </a>
                </li>
              -->
                <li>
                  <a class="d-inline-block m-1" href="../Capacitaciones/1-fintec">
                  <img class="d-inline-block" src="../../public/images/img_spl/capacitaciones/logo-fintec.jpg"/>
                
                  </a>
                </li>
              </ul>
            </li>
            <li><span class="mega-menu-title">INSIDER</span>
              <ul class="sub-menu">
                <li>
                  <a href="../Capacitaciones/2-insider" >
                  ¿Qué es Insider?
                  </a>
                </li>
                <?php 
                    if (!class_exists("CatalogoCapacitaciones")) {
                      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/Capacitaciones.php';
                      }
                      $CatalogoCursos = new CatalogoCapacitaciones();
                      $responseI = $CatalogoCursos->getEventsInsider("WHERE activo = 'si' ", "", false)->records;
                      //echo $Json= json_encode($response);
                ?>
                      <?php foreach ($responseI as $row ):  ?>
                        <li>
                        <a class="text-decoration-none" href="../Capacitaciones/2-Insider#I<?php echo $row->id;?>">  
                        <?php echo $row->titulo;?>
                      </a>
                      </li>
                      <?php endforeach ?>
              </ul>
            </li>
            <li>
              <span class="mega-menu-title">DEVELOP</span>
                  <ul class="sub-menu">
                  <li>
                  <a href="../Capacitaciones/3-develop" >
                  ¿Qué es Develop?
                  </a>
                </li>
                <?php 
                  if (!class_exists("CatalogoCursos")) {
                    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/Cursos.php';
                  }
                  $CatalogoCursos = new CatalogoCursos();
                  $responseD = $CatalogoCursos->get("", "", false);
                ?>
                    <?php if ($responseD->count > 0): ?>
                      <?php foreach ($responseD->records as $key => $row): ?>
                        <li>
                        <a class="text-decoration-none" href="../Cursos/<?php echo $row->id;?>-<?php echo url_amigable($row->nombre);?>">  
                        <?php echo $row->nombre;?>
                      </a>
                      </li>
                      <?php endforeach ?>
                    <?php endif ?> 
                  </ul>
            </li>
            <li>
              <span class="mega-menu-title">CERTIFICACIÓN OPTRONICS</span>
                  <ul class="sub-menu">
                  <li>
                    <a href="../Capacitaciones/4-partners" >
                    ¿Qué es?
                    </a>
                  </li>
                  <li>
                    <a href="../Capacitaciones/4-partners#banner2" >
                   Proceso para certificar una red
                    </a>
                  </li>
                  </ul>
            </li>
          </ul>
        </li>
        <li class="has-submenu">
          <a href="../Cuenta/index.php?menu=5">Pedidos en proceso</a> 
        </li>
        <li class="has-submenu">
          <a href="../Cuenta/index.php?menu=6">Histórico de pedidos </a> 
        </li>
        <li class="has-submenu">
          <a href="../Cuenta/index.php?menu=9">Datos de envío</a> 
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