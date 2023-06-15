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
              $CategoriaController->filter = "WHERE activo='si'";
              $CategoriaController->order = "";
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
         <!--  <li class="has-children <?php if(trim($path) == "Soluciones"){?>active<?php }?>">
            <span><a href="../Soluciones/">Soluciones</a></span>
          </li> -->

     

          <li class="has-children">
            <span><a href="#">Soluciones Top</a><span class="sub-menu-toggle"></span></span>
            <ul class="slideable-submenu">
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
          <!--
          <li class="has-children <?php if(trim($path) == "Cursos"){?>active<?php }?>">
            <span><a href="#">Cursos</a><span class="sub-menu-toggle"></span></span>
            <ul class="slideable-submenu">
              <li><a href="../Cursos/cursos-fibra-optica.php">Presencial</a></li>
               <li><a href="../Cursos/webinar.php?pag=1">Webinar</a></li> 
          </ul>
          </li>
              -->
          <li class="has-children">
            <span><a href="#">Capacitaciones</a><span class="sub-menu-toggle"></span></span>
            <ul class="slideable-submenu">
               <li><a href="../Capacitaciones/1-fintec">FINTEC</a></li>
               <li><a href="../Capacitaciones/2-insider">INSIDER</a></li> 
               <li><a href="../Capacitaciones/3-develop">DEVELOP</a></li> 
               <li><a href="../Capacitaciones/4-partners">CERTIFICACIÓN OPTRONICS</a></li> 
          </ul>
          </li>
          <li class="has-children"><span>
            <a href="#">Biblioteca Técnica</a><span class="sub-menu-toggle"></span></span>
            <ul class="slideable-submenu">
              <li><a href="../Biblioteca/catalogo-telecomunicaciones-fibra-optica.php">Catálogo</a></li>
              <li><a href="../Biblioteca/videos-tutoriales-fibra-optica.php">Videos</a></li>
              <li><a href="../Biblioteca/infografias-fibra-optica.php">Infografías</a></li>
              <li><a href="../Biblioteca/glosario-fibra-optica.php?r=A-E">Glosarío</a></li>
              <li><a href="../Biblioteca/informacion-tecnica-fibra-optica.php?id=A1">Info. Técnica</a></li>
              <li><a href="../Biblioteca/fichas-tecnicas-fibra-optica.php?id=A1">Hojas Técnicas</a></li>  
              <li><a href="../Consultecnico">Consultécnico</a></li>  
              <!-- <li><a href="../Biblioteca/cursos.php">Cursos</a></li> -->
            </ul>
          </li>
          <li class="has-children <?php  if(trim(explode("=", $path)[0]) == "index.php?pag"){?>active<?php }?>"><span><a href="../Blog/index.php?pag=1">Blog</a></span>
          </li> 
          <li class="has-children"><span>
            <a href="#">Contacto</a><span class="sub-menu-toggle"></span></span>
            <ul class="slideable-submenu">
              <li><a href="../Registro">Pre-registro para empresas</a></li>
              <li><a href="../Login/registro.php">Darme de alta como cliente</a></li>
              <?php 
                if (isset($_SESSION['Ecommerce-ClienteKey']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
                  // header('Location: ../Home');
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