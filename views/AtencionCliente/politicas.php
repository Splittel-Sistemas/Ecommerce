<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>
     <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Envíos y entregas</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Envíos y entregas</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-1x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-lg-10">
          <!-- Gallery-->
          <div class="gallery-wrapper">
            <div class="gallery-item">
            <?php
              switch ($_GET['idc']) {
                case 1:
                  echo '<img src="../../public/images/img_spl/politicas/envios_entregas.jpg" alt="Envios y entregas">';
                  break;
                case 2:
                  echo '<img src="../../public/images/img_spl/politicas/devoluciones.jpg" alt="Devoluciones">';
                  break;
                case 3:
                  echo '<img src="../../public/images/img_spl/politicas/garantias.jpg" alt="Garantias">';
                  break;
                case 4:
                  echo '<img src="../../public/images/img_spl/politicas/condiciones_comerciales.jpg" alt="Condiciones comerciales">';
                  break;  
                case 5:
                  echo '<img src="../../public/images/img_spl/politicas/rastreo.jpg" alt="Rastreo">';
                  break;  
                  case 6:
                    echo '<img src="../../public/images/img_spl/politicas/condiciones_comerciales.jpg" alt="Condiciones comerciales">';
                    break;         
                default:
                  echo "No se encontro la opción solicitada";
                  break;
              }
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
                      
    <div class="container padding-bottom-2x mb-2">
      <div class="row justify-content-center">      
        <!-- Sidebar          -->
        <div class="col-lg-3 col-5">
          <nav class="list-group">
          <!--   <a class="list-group-item <?php if(isset($_GET['idc']) && $_GET['idc']==5){ echo "active";}?>" href="../AtencionCliente/politicas.php?idc=5"><i class="icon-clipboard"></i>Rastreo de pedidos</a>
            <a class="list-group-item <?php if(isset($_GET['idc']) && $_GET['idc']==1){ echo "active";}?>" href="../AtencionCliente/politicas.php?idc=1"><i class="icon-truck"></i>Envíos y entregas</a>
            <a class="list-group-item <?php if(isset($_GET['idc']) && $_GET['idc']==2){ echo "active";}?>" href="../AtencionCliente/politicas.php?idc=2"><i class="icon-refresh-ccw"></i>Devoluciones</a>
            <a class="list-group-item <?php if(isset($_GET['idc']) && $_GET['idc']==3){ echo "active";}?>" href="../AtencionCliente/politicas.php?idc=3"><i class="icon-book-open"></i>Garantías</a> -->
<!--             <a class="list-group-item <?php if(isset($_GET['idc']) && $_GET['idc']==4){ echo "active";}?>" href="../AtencionCliente/politicas.php?idc=4"><i class="icon-users"></i>Condiciones comerciales</a>
 -->            <a class="list-group-item <?php if(isset($_GET['idc']) && $_GET['idc']==6){ echo "active";}?>" href="../AtencionCliente/politicas.php?idc=6"><i class="icon-users"></i>Terminos y Condiciones comerciales</a>

          </nav>
        </div>
        <!-- Categories-->
        <div class="col-lg-7 col-7" id="content_cuenta">
         <?php
            switch ($_GET['idc']) {
              case 1:
                include('Politicas/envios_entregas.php');
                break;
              case 2:
                include('Politicas/devoluciones.php');
                break;
              case 3:
                include('Politicas/garantias.php');
                break;
              case 4:
                include('Politicas/condiciones_comerciales.php');
                break; 
              case 5:
                include('Politicas/rastreo_pedidos.php');
                break;    
                case 6:
                  include('Politicas/Terminos_condiciones.php');
                  break;             
              default:
                echo "No se encontro la opción solicitada";
                break;
            }
          ?>
        </div>        
      </div>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
  </body>
</html>