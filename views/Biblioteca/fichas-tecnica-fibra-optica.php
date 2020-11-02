<html lang="es">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
    <style>
      a::after{
          float:left;
          text-indet:0;
          content: none !important;
      }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>
    <?php 
     if (!class_exists("CatalogoProductos")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/Productos.php';
      }if (!class_exists("CatalogoFichasTecnicas")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Catalogos/FichasTecnicas.php';
      }
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Hojas técnicas</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Hojas técnicas</li>
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
            $CategoriaController->filter = "WHERE activo='si' AND menu2='si' ";
            $CategoriaController->order = "";
            $ResultCategoria = $CategoriaController->get();

            foreach ($ResultCategoria->records as $key => $Categoria){ 
          ?>
            <a class="list-group-item list-group-item-action <?php if($Categoria->CodigoKey == $CategoriaKey){?>active <?php }?>" href="fichas-tecnicas-fibra-optica.php?id=<?php echo $Categoria->CodigoKey;?>">
              <?php echo $Categoria->Descripcion;?>
            </a>
          <?php } ?>    
          </nav>
        </div>
      
        <div class="col-lg-9 col-md-8 order-md-2">
          <div class="accordion" id="accordion1" role="tablist">
          <?php 
            
            $CatalogoProductos = new CatalogoProductos();
            $CatalogoFichasTecnicas = new CatalogoFichasTecnicas();
            $response = $CatalogoProductos->get("WHERE categoria='".$CategoriaKey."' AND activo='si' ", "", false);
			//print_r($response);
           ?>
          <?php if ($response->count > 0): ?>
		  <div class="table-responsive-sm">
           <table id="example" class="table text-center table-borderless table-condensed table-hover" style="width:100%">
           <thead><th></th></thead>
            <tbody>
            <?php foreach ($response->records as $key => $row): ?>
            <?php  
              $rutaFichaTecnica = $CatalogoFichasTecnicas->productoFicha("WHERE id_ficha = '".$row->info_tecnica."' ", "", false)->records[0]->ruta;
              $FichaTecnica = "../../public/images/img_spl/".$rutaFichaTecnica.".pdf";
            ?>
           
            <?php if (file_exists(($FichaTecnica))): ?>
            <tr>
                <td>
                    <div class="card">
                      <div class="card-header" role="tab">
                        <h6><a class="product-thumb" href="javascript:void(0);" onclick="window.open('<?php echo $FichaTecnica;?>', '_blank')" data-toggle="collapse"><?php echo $row->desc_producto;?><i style="font-weight: bold;" class="icon-download float-right"></i></a></h6>
                      </div>
                    </div>
                </td>
            </tr>
            <?php endif ?>
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
  
  unset($CatalogoProductos);
  unset($CatalogoFichasTecnicas);
  unset($Categorias);
  unset($response);
  
 ?>