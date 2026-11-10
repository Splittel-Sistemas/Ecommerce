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

        foreach ($response->records as $CategoriaCont => $Categoria) :
          if ($CategoriaCont == 0 || ($CategoriaCont == 3) || ($CategoriaCont == 6)) : ?>
           <div class="row">
           <?php endif ?>
           <div class="col-sm-3">
             <a class="d-block navi-link text-center mb-30" href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey; ?>&nom=<?php echo url_amigable($Categoria->Descripcion); ?>">
               <img class="d-block" src="../../public/images/img_spl/categorias/<?php echo $Categoria->Img; ?>">
               <span class="text-gray-dark"><?php echo $Categoria->Descripcion; ?></span>
             </a>
           </div>
           <?php if ($CategoriaCont == 2 || $CategoriaCont == 5 || $CategoriaCont == 8 || $response->count - 1 == $CategoriaCont) : ?>
           </div>
         <?php endif ?>
       <?php endforeach ?>
     </div>
   </div>
   <nav class="site-menu">
     <ul>
       <li class="has-submenu <?php if (trim($path) == "Home") { ?>active<?php } ?>">
         <a href="../Home/">Home </a>
       </li>
       <li class="has-submenu <?php if (trim($path) == "Nosotros") { ?>active<?php } ?>">
         <a href="../Nosotros/">Nosotros</a>
       </li>
       <li class="has-submenu">
         <a href="#">Productos</a>
         <ul class="sub-menu">
           <?php
            $CategoriaController = new CategoriaController();
            $CategoriaController->filter = "WHERE activo = 'si' ";
            $CategoriaController->order = "ORDER BY orden DESC";
            $response = $CategoriaController->get();

            foreach ($response->records as $CategoriaCont => $Categoria):
            ?>

             <li>
               <a href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey; ?>&nom=<?php echo url_amigable($Categoria->Descripcion); ?>">
                 <?php echo $Categoria->Descripcion; ?>
               </a>
             </li>
           <?php endforeach ?>
         </ul>
       </li>

       <li class="has-submenu <?php if (trim($path) == "SolucionesTop") { ?>active<?php } ?>">
         <a href="#">Soluciones Top</a>
         <ul class="sub-menu">
           <?php
            $SolucionesTopController = new SolucionesTopController();
            $SolucionesTopController->filter = "WHERE activo = 'si' ";
            $SolucionesTopController->order = "";
            $responseSolucionesTop = $SolucionesTopController->Get();
            foreach ($responseSolucionesTop->records as $SolucionesTop  => $row) :
            ?>

             <li>
               <a href="../<?php echo $row->Ruta;  ?>"><?php echo $row->Nombre; ?></a>
             </li>
           <?php endforeach ?>
         </ul>
       </li>
       <li class="has-submenu <?php if (trim($path) == "Capacitaciones") { ?>active<?php } ?>">
         <a href="../Capacitaciones/1-fintec">Capacitaciones</a>
         <ul class="sub-menu">
           <li>
             <a href="../Capacitaciones/5-redlives-webinars">RedLives Webinars</a>
           </li>
           <li>
             <a href="../Capacitaciones/3-cursos-presenciales-fibra-optica">Certificaciones Técnicas</a>
           </li>
           <li>
             <a href="../Capacitaciones/4-partners">Certificación Optronics</a>
           </li>
         </ul>
       </li>

       <li class="has-submenu <?php if (trim($path) == "Biblioteca") { ?>active<?php } ?>"><a href="#">Biblioteca Técnica</a>
         <ul class="sub-menu">
           <li><a href="../Biblioteca/videos-tutoriales-fibra-optica.php">Videos</a></li>
           <li><a href="../Biblioteca/infografias-fibra-optica.php">Infografías</a></li>
           <li><a href="../Biblioteca/glosario-fibra-optica.php?r=A-E">Glosarío</a></li>
           <li><a href="../Biblioteca/informacion-tecnica-fibra-optica.php?id=A1">Info. Técnica</a></li>
           <li><a href="../Biblioteca/fichas-tecnicas-fibra-optica.php?id=A1">Hojas Técnicas</a></li>
           <li><a href="../Consultecnico">Consultécnico</a></li>
         </ul>
       </li>
       <li class="has-submenu <?php if (trim(explode("=", $path)[0]) == "index.php?pag") { ?>active<?php } ?>"><a href="../Blog/index.php?pag=1">Blog </a></li>

       <li class="has-submenu"><a href="#">Contacto</a>
         <ul class="sub-menu">
           <li><a href="https://eakai.share.hsforms.com/2e7F_6GvKQtWv49-QJpvdig" target="_blank">Pre-registro para empresas</a></li>
           <?php
            if (isset($_SESSION['Ecommerce-ClienteKey']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
            ?>
             <li><a href="../PuntoAPunto">Programa de puntos</a></li>
           <?php } ?>
           <li><a href="../Contacto">Dirección y teléfono</a></li>
         </ul>
       </li>
       <li class="has-submenu <?php if (basename($_SERVER['REQUEST_URI']) == "catalogo-telecomunicaciones-fibra-optica.php") { ?>active<?php } ?>"><a href="../Biblioteca/catalogo-telecomunicaciones-fibra-optica.php">Catálogo</a></li>
     </ul>
   </nav>
   <!-- Toolbar ( Put toolbar here only if you enable sticky navbar )-->
   <div class="toolbar">
     <div class="toolbar-inner">
       <div class="toolbar-item"><a href="javascript:void(0);">
           <div><span class="text-label "><strong>TIPO DE CAMBIO</strong><br />1 USD = <?php echo $_SESSION['Ecommerce-WS-CurrencyRate']; ?> MXP</span></div>
         </a></div>
       <div class="toolbar-item" id="ListResumenProductosCarritoMovil">
         <?php include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/views/Carrito/Resumen/index.php'; ?>
       </div>
     </div>
   </div>
 </div>