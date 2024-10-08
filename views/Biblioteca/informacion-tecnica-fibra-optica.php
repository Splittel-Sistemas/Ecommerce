<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Información técnica</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Información técnica</li>
          </ul>
        </div>
      </div>
    </div>
   
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
      <div class="row">
        <div class="col-lg-3 col-md-4 order-md-1">
          <!-- Side Menu-->
          <div class="padding-top-3x hidden-md-up"></div>
          <div class="card rounded-bottom-0" data-filter-list="#components-list">
            
          </div>
          <nav class="list-group" id="components-list">
          <?php 
            if (!class_exists("CategoriaController")) {
              include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Categorias/Categoria.Controller.php';
            } 
            $CategoriaKey = isset($_GET['id']) ? $_GET['id'] : "";
            $CategoriaController = new CategoriaController();
            $CategoriaController->filter = "WHERE activo='si' AND menu1='si' ";
            $CategoriaController->order = "";
            $ResultCategoria = $CategoriaController->get();

            foreach ($ResultCategoria->records as $key => $Categoria){ 
          ?>
            <a class="list-group-item list-group-item-action <?php if($Categoria->CodigoKey == $CategoriaKey){?>active <?php }?>" href="informacion-tecnica-fibra-optica.php?id=<?php echo $Categoria->CodigoKey;?>">
              <?php echo $Categoria->Descripcion;?>
            </a>
          <?php } ?>  
          </nav>
        </div>
        <div class="col-lg-9 col-md-8 order-md-2">
          <div class="accordion" id="accordion1" role="tablist">
          <?php
            if (!class_exists("CatalogoInformacionTecnica")) {
              include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/InformacionTecnica.php';
            } 
            $CatalogoInformacionTecnica = new CatalogoInformacionTecnica();
            $response = $CatalogoInformacionTecnica->get("WHERE id_categoria = '".$CategoriaKey."' ", "", false);
           ?>
           <?php if ($response->count > 0): ?>
            <div class="table-responsive-sm">
           <table id="example" class="table text-center table-borderless table-condensed table-hover" style="width:100%">
           <thead><th></th></thead>
            <tbody>
            <?php foreach ($response->records as $key => $row): ?>
            <tr>
                <td>
                    <div class="card">
                      <div class="card-header" role="tab">
                        <h6><a class="collapsed" href="#collapse<?php echo $key;?>" data-toggle="collapse"><?php echo $row->titulo;?></a></h6>
                      </div>
                      <div class="collapse" id="collapse<?php echo $key;?>" data-parent="#accordion1" role="tabpanel">
                        <div class="card-body"><p style="text-align: justify;"><?php echo nl2br($row->descripcion);?></p></div>
                      </div>
                    </div>
                </td>
            </tr>
            <?php endforeach ?>
            </tbody> 
            </table>
			</div>
           <?php endif ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <!--  -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script>
      GlobalInitialDatatable_('example')
    </script>
  </body>
</html>

<?php 
  
  unset($Categorias);
  unset($response);
  unset($CatalogoInformacionTecnica);
  
 ?>