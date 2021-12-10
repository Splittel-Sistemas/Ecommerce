<?php
  $contenido = [
    [],
    [
      'descripcion' => 'Datos Generales', 
      'icon' => 'icon-user', 
      'file' => '/fibra-optica/views/Cuenta/B2C/Generales/index.php'
    ],
    [
      'descripcion' => 'Dashboard 360', 
      'icon' => 'icon-bar-chart-2', 
      'file' => '/fibra-optica/views/Cuenta/B2C/Dashboard/dashboard_360.php'
    ],
    [
      'descripcion' => 'Cotizaciones', 
      'icon' => 'icon-file-text', 
      'file' => '/fibra-optica/views/Cuenta/B2C/Cotizaciones/index.php'
    ],
    [
      'descripcion' => 'Pendientes de autorización', 
      'icon' => 'icon-file-text', 
      'file' => '/fibra-optica/views/Cuenta/B2C/Pendientes/index.php'
    ],
    [
      'descripcion' => 'Pedidos', 
      'icon' => 'icon-folder', 
      'file' => '/fibra-optica/views/Cuenta/B2C/Pedidos/index.php'
    ],
    [
      'descripcion' => 'Datos de Envío', 
      'icon' => 'icon-map-pin', 
      'file' => '/fibra-optica/views/Cuenta/B2C/DatosEnvio/index.php'
    ],
    [
      'descripcion' => 'Datos de Facturación', 
      'icon' => 'icon-globe', 
      'file' => '/fibra-optica/views/Cuenta/B2C/DatosFacturacion/index.php'
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
     
       
     
      