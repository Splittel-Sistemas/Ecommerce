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
    [
      'descripcion' => 'Rechazados', 
      'icon' => 'icon-trash', 
      'file' => '/fibra-optica/views/Cuenta/B2B/Rechazados/index.php'
    ],
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
  
  $ListItemContenido =  $contenido[1];
?>

<!-- Page Content-->
<nav class="slideable-menu">
        <ul class="menu" data-initial-height="385">
        <?php 
        foreach($contenido as $key => $lista){ 
          if(!($key == 0)){
           
        ?>
          <li class="has-children">
            <span><a href="../Cuenta/index.php?menu=<?php echo $key ?>"><?php echo $lista['descripcion'] ?></a></span>
          </li>

        </a>

          <?php 
          }
        } 
      ?>
        </ul>
</nav>
     
       
     
      