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
          <h1>Consultécnico</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="index.html">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Consultécnico</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1">
      <div class="row">
        <!-- Blog Posts-->
        <div class="col-lg-9 order-lg-2">
          <?php #include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Consultecnico/Create.php'; ?>
          <div class="row">
            <div class="col-12">
              <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-consultecnico">Nueva Pregunta</button>
            </div>
          </div>
          <div class="mt-4" id="list-consultecnico">
            <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Consultecnico/List.php'; ?>
          </div>
        </div>
        <!-- Sidebar          -->
        <div class="col-lg-3 order-lg-1">
          <div class="sidebar-toggle position-left"><i class="icon-filter"></i></div>
          <aside class="sidebar sidebar-offcanvas position-left"><span class="sidebar-close"><i class="icon-x"></i></span>
            <!-- Widget Categories-->
            <section class="widget widget-categories">
              <h3 class="widget-title">Categorias</h3>
              <ul id="listar-categorias-consultecnico">
               <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Consultecnico/categorias.php'; ?>
              </ul>
            </section>
            
            <!-- Widget Featured Posts-->
            <section class="widget widget-featured-posts">
              <h3 class="widget-title">Blogs recientes</h3>
              <!-- Entry-->
              <?php 
                if (!class_exists("Blog")) {
                  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Blog/Blog.php';
                }
                $Blog = new Blog();
                $response = (object)$Blog->get("WHERE activo = 'si' ", "ORDER BY fecha DESC  LIMIT 4 ", false);
                foreach ($response->records as $key => $row) {
              ?>
              <div class="entry">
                <div class="entry-thumb"><a href="../Blog/detalle.php?id=<?php echo $row->BlogKey;?>&nom=<?php echo $row->BlogComillas;?>"><img src="../../public/images/img_spl/blog/<?php echo $row->BlogImg;?>" alt="Post"></a></div>
                <div class="entry-content">
                  <h4 class="entry-title"><a href="../Blog/detalle.php?id=<?php echo $row->BlogKey;?>&nom=<?php echo $row->BlogComillas;?>"><?php echo $row->BlogTitulo;?></a></h4><span class="entry-meta"><?php echo ucwords(strftime( '%B' , strtotime($row->BlogFecha))).' '.strftime(date("j, Y",strtotime($row->BlogFecha)));?></span>
                </div>
              </div>
              <?php } ?> 
            </section>
          </aside>
        </div>
      </div>

      <!-- Leave a Review-->
      <div class="modal fade" id="modal-consultecnico">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-body-consultecnico">
              <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Consultecnico/Create.php'; ?>
            </div>
          </div>
        </div>
      </div>

    </div>


    
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <!--  -->
    <script type="text/javascript" src="../../public/scripts/Consultecnico/index.js?id=<?php echo rand() ?>"></script>
  </body>
</html>
<?php 
  unset($Contacto); 
  unset($ContactoController);
?>