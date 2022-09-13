<?php
  $contenido = [
    [],
    [
      'descripcion' => 'Datos Generales', 
      'icon' => 'icon-user', 
      'file' => '/fibra-optica/views/Cuenta/B2B/Generales/datos_generales.php'
    ],
    [
      'descripcion' => 'Dashboard 360', 
      'icon' => 'icon-bar-chart-2', 
      'file' => '/fibra-optica/views/Cuenta/B2B/Dashboard/dashboard_360.php'
    ],
    [
      'descripcion' => 'Cotizaciones', 
      'icon' => 'icon-file-text', 
      'file' => '/fibra-optica/views/Cuenta/B2B/Cotizaciones/index.php'
    ],
    [
      'descripcion' => 'Pendientes de autorización', 
      'icon' => 'icon-edit-3', 
      'file' => '/fibra-optica/views/Cuenta/B2B/Pendientes/index.php'
    ],
    [
      'descripcion' => 'Pedidos en proceso', 
      'icon' => 'icon-activity', 
      'file' => '/fibra-optica/views/Cuenta/B2B/EnProceso/index.php'
    ],
    [
      'descripcion' => 'Histórico de pedidos', 
      'icon' => 'icon-folder', 
      'file' => '/fibra-optica/views/Cuenta/B2B/HistoricoPedidos/index.php'
    ],
  /*   [
      'descripcion' => 'Rechazados', 
      'icon' => 'icon-trash', 
      'file' => '/fibra-optica/views/Cuenta/B2B/Rechazados/index.php'
    ], */
    [
      'descripcion' => 'Pagos', 
      'icon' => 'icon-dollar-sign', 
      'file' => '/fibra-optica/views/Cuenta/B2B/Pagos/index.php'
    ],
    [
      'descripcion' => 'Datos de Envío', 
      'icon' => 'icon-map-pin', 
      'file' => '/fibra-optica/views/Cuenta/B2B/DatosEnvio/index.php'
    ],
    [
      'descripcion' => 'Datos de Facturación', 
      'icon' => 'icon-globe', 
      'file' => '/fibra-optica/views/Cuenta/B2B/DatosFacturacion/index.php'
    ],

  ];
  
  $ListItemContenido =  $contenido[$_GET['menu']];
?>

<!-- Page Content-->
<div class="page-title">
  <div class="container">
    <div class="column">
      <h1><?php echo $ListItemContenido['descripcion'] ?></h1>
    </div>
    <div class="column">
      <ul class="breadcrumbs">
        <li><a href="../Home/">Home</a>
        </li>
        <li class="separator">&nbsp;</li>
        <li><a href="#">Cuenta</a>
        </li>
        <li class="separator">&nbsp;</li>
        <li><?php echo $ListItemContenido['descripcion'] ?></li>
      </ul>
    </div>
  </div>
</div>
<!-- Page Content-->
<div class="container padding-bottom-3x mb-2">
  <div class="row">
    <div class="col-lg-4">
      <aside class="user-info-wrapper">
        <div class="user-cover" style="background-image: url(../../public/images/img/account/user-cover-img.jpg);">
        </div>
        <div class="user-info">
          <div class="user-avatar"><a class="edit-avatar" href="#"></a><img src="../../public/images/Otros/user.jpg" alt="User"></div>
          <div class="user-data">
            <!-- <h4 class="h5"><?php # echo $_SESSION['Ecommerce-ClienteNombre'] ?></h4><span>Joined February 06, 2017</span> -->
          </div>
        </div>
      </aside>
      <nav class="list-group">
      <?php 
        foreach($contenido as $key => $lista){ 
          if(!($key == 0)){
            $active =  $key == $_GET['menu'] ? 'active' : '';
      ?>
        <a href="../Cuenta/index.php?menu=<?php echo $key ?>" class="list-group-item menu-class <?php echo $active; ?>">
          <i class="<?php echo $lista['icon'] ?>"></i><?php echo $lista['descripcion'] ?>
        </a>
      <?php 
          }
        } 
      ?>
      </nav>
    </div>
    <div class="col-lg-8 mt-5">
      <?php include $_SERVER["DOCUMENT_ROOT"].$ListItemContenido['file']; ?>
    </div>
  </div>
</div>