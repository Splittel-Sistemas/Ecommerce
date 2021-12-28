<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
     <!-- Plugin CSS -->
     <link rel="stylesheet" href="/fibra-optica/public/plugins/easy-pagination/jquery.paginate.css">
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1 class="font-weight-bold">Catálogos Interactivos 2022</h1>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-2x mb-2" id="list-catalog">

      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-sm-4 margin-bottom-1x">
              <form class="input-group form-group" method="get"><span class="input-group-btn">
                  <button type="button"><i class="icon-search"></i></button></span>
                  <input class="form-control search" type="search" placeholder="Componentes de busqueda">
              </form>
            </div>
          </div>  
        </div>
      </div>

      <div class="row list mt-3" id="pagination-catalog">
        <?php 
          if (!class_exists('CatalogController')) {
            include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/catalog/Catalog.Controller.php';
          }
          $catalogController = new CatalogController();
          $resultCatalogController = $catalogController->Get();
          foreach ($resultCatalogController as $key => $catalog) {
        ?>
        <div class="col-md-3 col-sm-6">
          <div class="card mb-3 dinamic_height_catalog">
            <img class="card-img-top" src="/fibra-optica/public/images/image/catalog/<?php echo $catalog->LinkImg ?>" alt="Card image">
            <div class="card-body text-center">
              <h6 class="card-title font-weight-bold mb-1 title" style="display : none"><?php echo $catalog->Title ?></h6>
              <a class="btn btn-outline-primary btn-sm" href="<?php echo $catalog->LinkCatalog ?>" target="_blank">VER ONLINE</a>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>

    <!-- Plugin JS -->
    <script src="/fibra-optica/public/plugins/easy-pagination/jquery.paginate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.0/list.min.js"></script>

    <script>
      function Initial(){
        if(document.getElementById("list-catalog")){
          var options = {
            valueNames: ['title']
          };

          var userList = new List('list-catalog', options);

          if(document.getElementById('pagination-catalog')){
            $('#pagination-catalog').paginate({
              perPage: 12,   
            });
          }
        }
      }
      Initial()
    </script>
  </body>
</html>

<?php 
  
  unset($Catalogo);
  unset($response);
  unset($Historia);
  unset($responseHistoriaresponseHistoria);
  
 ?>