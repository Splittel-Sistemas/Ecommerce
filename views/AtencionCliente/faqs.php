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
          <h1>Preguntas frecuentes</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Preguntas frecuentes</li>
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
            <img src="../../public/images/img_spl/faqs/Banner-preguntas-frecuentes.jpg" alt="Preguntas frecuentes">
           
            </div>
          </div>
        </div>
      </div>
    </div>
                      
    <div class="container padding-bottom-2x mb-2">
      <div class="row justify-content-center">      
        <!-- Sidebar          -->
        <div class="col-lg-3 ">
          <nav class="list-group">
            <a class="list-group-item <?php if(isset($_GET['idc']) && $_GET['idc']==1){ echo "active";}?>" href="../AtencionCliente/faqs.php?idc=1"><i class="icon-book-open"></i>Garant&iacute;as</a>
            <a class="list-group-item <?php if(isset($_GET['idc']) && $_GET['idc']==2){ echo "active";}?>" href="../AtencionCliente/faqs.php?idc=2"><i class="icon-refresh-ccw"></i>Devoluciones</a>
            <a class="list-group-item <?php if(isset($_GET['idc']) && $_GET['idc']==3){ echo "active";}?>" href="../AtencionCliente/faqs.php?idc=3"><i class="icon-users"></i>Servicio</a>
            <a class="list-group-item <?php if(isset($_GET['idc']) && $_GET['idc']==4){ echo "active";}?>" href="../AtencionCliente/faqs.php?idc=4"><i class="icon-triangle"></i>Incidencias</a>
             </nav>
        </div>
        <!-- Categories-->
        <div class="col-lg-7 " id="content_cuenta">
         <?php
            switch ($_GET['idc']) {
              case 1:
                include('Faqs/garantias.php');
                break;
              case 2:
                include('Faqs/devoluciones.php');
                break;
              case 3:
                include('Faqs/servicio.php');
                break;
              case 4:
                include('Faqs/incidencias.php');
                break;          
              default:
                echo "No se encontro la opci�n solicitada";
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