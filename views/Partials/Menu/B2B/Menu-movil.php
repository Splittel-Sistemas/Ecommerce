<nav class="slideable-menu">
        <ul class="menu" data-initial-height="385">
          <li class="has-children <?php if(trim($path) == "Home"){?>active<?php }?>">
            <span><a href="../Home/">Home</a></span>
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
                <a  href="../Soluciones/<?php echo $Soluciones->SolucionesKey;?>-<?php echo url_amigable($Soluciones->Descripcion);?>"><?php echo $Soluciones->Descripcion;?></a>
              </li>
              <?php endforeach ?> 
            </ul>
          </li>
              -->
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
            <span><a href="#">Capacitaciones</a></span>
          </li>
          <li class="has-children">
            <span><a href="../Cuenta/index.php?menu=5">Pedidos en proceso</a></span>
          </li>
          <li class="has-children">
            <span><a href="../Cuenta/index.php?menu=6">Histórico de pedidos </a></span>
          </li>
          <li class="has-children">
            <span><a href="../Cuenta/index.php?menu=9">Datos de envío</a></span>
          </li>       
        </ul>
      </nav>