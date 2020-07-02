<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Head.php'; ?>
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Header.php'; ?>
    <?php 
      if (!class_exists("Glosario")) {
        include $_SERVER["DOCUMENT_ROOT"].'/store/models/Biblioteca/Glosario.php';
      }
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Glosario</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Glosario</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
      <div class="row">
        <div class="col-lg-3 col-md-4 order-md-1 col-4">
          <!-- Side Menu-->
          <div class="padding-top-3x hidden-md-up"></div>
          <div class="card rounded-bottom-0" data-filter-list="#components-list">
            
          </div>
          <nav class="list-group" id="components-list">
          <?php 
            $Glosario = new Glosario();
            $response = $Glosario->getRangos("", "GROUP BY rango", false);
            $rango = isset($_GET['r']) ? $_GET['r'] : "";
          ?>
          <?php foreach ($response->records as $key => $row): ?>
            <a class="list-group-item list-group-item-action <?php if($row->GlosarioRango == $rango){?>active <?php }?>" href="../Biblioteca/glosario.php?r=<?php echo $row->GlosarioRango;?>">
              <?php echo $row->GlosarioRango;?>
            </a>
          <?php endforeach ?>
          </nav>
        </div>
        <div class="col-lg-9 col-md-8 order-md-2 col-8">
          <div class="accordion" id="accordion1" role="tablist">
          <?php 
            // $Glosario = new Glosario();
            $response = $Glosario->get("WHERE rango = '".$rango."' ", "", false);
          ?>

          <?php if ($response->count > 0): ?>
            <?php foreach ($response->records as $cont => $row): ?>
            <div class="card">
              <div class="card-header" role="tab">
                <h6><a class="collapsed" href="#collapse<?php echo $cont;?>" data-toggle="collapse"><?php echo $row->GlosarioTermino;?></a></h6>
              </div>
              <div class="collapse" id="collapse<?php echo $cont;?>" data-parent="#accordion1" role="tabpanel">
                <div class="card-body"><p style="text-align: justify;"><?php echo nl2br($row->GlosarioDescripcion);?></p></div>
              </div>
            </div>
            <?php endforeach ?>
          <?php endif ?>
          </div>
        </div>
      </div>
    </div>  
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Scripts.php'; ?>
  </body>
</html>

<?php 
  
  unset($Glosario);
  unset($response);
  
 ?>