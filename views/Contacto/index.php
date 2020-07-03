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
    <?php 
      if (!class_exists("ContactoController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Contacto/Contacto.Controller.php';
      }
      $ContactoController = new ContactoController();
      $Contacto = $ContactoController->GetBy();
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Contacto</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Contacto</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-2x mb-2">
      <div class="row">
        <div class="col-md-12">
          <div class="display-3 text-muted opacity-75 mb-30">Centro de contacto</div>
        </div>
         <div class="col-md-6 ">
          <div class="card mb-30">
             <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3734.214127360639!2d-100.40539448532522!3d20.620127086221146!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d35ae461d52039%3A0x3e02826339c370c!2sFibremex+S.A.+de+C.V.!5e0!3m2!1ses!2smx!4v1510775709351" height="400px"  frameborder="0" style="border:0" allowfullscreen></iframe>
            <div class="card-body">
              <ul class="list-icon">
                <li><i class="icon-map-pin text-muted"></i><?php echo $Contacto->GetUbicacion();?></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-md-6">
        <hr class="margin-top-1x padding-top-2x">
        <h5><?php echo nl2br($Contacto->GetTexto()) ?></h5>
          <ul class="list-icon">
            <li> <i class="icon-phone text-muted"></i><?php echo $Contacto->GetTelefono();?></li>
            <li> <i class="icon-phone text-muted"></i><?php echo $Contacto->GetTelefono_1();?></li>
            <li> 
              <i class="icon-mail text-muted"></i>
              <a class="navi-link" href="mailto:<?php echo $Contacto->GetEmail();?>"><?php echo $Contacto->GetEmail();?></a>
            </li>
            <li> <i class="icon-clock text-muted"></i><?php echo $Contacto->GetHorario();?></li>
            <li> <i class="icon-globe text-muted"></i><?php echo $Contacto->GetPagina();?></li>
         <!--   <li> <i class="icon-phone text-muted"></i>+1 (080) 44 357 260</li>
            <li> <i class="icon-clock text-muted"></i>1 - 2 business days</li>
         -->
          </ul>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
  </body>
</html>
<?php 
  unset($Contacto); 
  unset($ContactoController);
?>