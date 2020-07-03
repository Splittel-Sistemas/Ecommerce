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
          <h1>Rastreo de orden</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="index.html">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Rastreo de orden</li>
          </ul>
        </div>
      </div>
    </div>
    <?php 
      if($_GET['PaqueteriaKey'] == 14 || $_GET['PaqueteriaKey'] == 15 || $_GET['PaqueteriaKey'] == 16){
        include 'seguimiento_paquete_express.php';
      }else{
        include 'seguimiento_dhl.php';
      } 
    ?>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <!--  -->
    <script type="text/javascript" src="../../public/scripts/Login/index.js?id=<?php echo rand() ?>"></script>
    <script type="text/javascript" src="../../public/scripts/Login/login.js?id=<?php echo rand() ?>"></script>
  </body>
</html>