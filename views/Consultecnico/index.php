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
          <h1>Blog Left Sidebar</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="index.html">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Blog Left Sidebar</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1">
      <div class="row">
        <!-- Blog Posts-->
        <div class="col-lg-9 order-lg-2">
          <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Consultecnico/Create.php'; ?>
        </div>
        <!-- Sidebar          -->
        <div class="col-lg-3 order-lg-1">
          <div class="sidebar-toggle position-left"><i class="icon-filter"></i></div>
          <aside class="sidebar sidebar-offcanvas position-left"><span class="sidebar-close"><i class="icon-x"></i></span>
            <!-- Widget Categories-->
            <section class="widget widget-categories">
              <h3 class="widget-title">Top Categories</h3>
              <ul>
                <li><a href="#">Editor's Choice</a><span>(24)</span></li>
                <li><a href="#">Electronics</a><span>(12)</span></li>
                <li><a href="#">Industrial Design</a><span>(5)</span></li>
                <li><a href="#">Secure Payments Online</a><span>(2)</span></li>
                <li><a href="#">Smart Gadgets</a><span>(19)</span></li>
                <li><a href="#">Online Shopping</a><span>(7)</span></li>
              </ul>
            </section>
            <!-- Widget Featured Posts-->
            <section class="widget widget-featured-posts">
              <h3 class="widget-title">Featured Posts</h3>
              <!-- Entry-->
              <div class="entry">
                <div class="entry-thumb"><a href="blog-single-rs.html"><img src="img/blog/widget/01.jpg" alt="Post"></a></div>
                <div class="entry-content">
                  <h4 class="entry-title"><a href="blog-single-rs.html">Factors Behind Wearable Gadgets Popularity</a></h4><span class="entry-meta">by Olivia Reyes</span>
                </div>
              </div>
              <!-- Entry-->
              <div class="entry">
                <div class="entry-thumb"><a href="blog-single-rs.html"><img src="img/blog/widget/02.jpg" alt="Post"></a></div>
                <div class="entry-content">
                  <h4 class="entry-title"><a href="blog-single-rs.html">Smartphones in Every Day Life </a></h4><span class="entry-meta">by Logan Coleman</span>
                </div>
              </div>
              <!-- Entry-->
              <div class="entry">
                <div class="entry-thumb"><a href="blog-single-rs.html"><img src="img/blog/widget/03.jpg" alt="Post"></a></div>
                <div class="entry-content">
                  <h4 class="entry-title"><a href="blog-single-rs.html">Retro Cameras are Trending. Why so Popular?</a></h4><span class="entry-meta">by Cynthia Gomez</span>
                </div>
              </div>
              <!-- Entry-->
              <div class="entry">
                <div class="entry-thumb"><a href="blog-single-rs.html"><img src="img/blog/widget/05.jpg" alt="Post"></a></div>
                <div class="entry-content">
                  <h4 class="entry-title"><a href="blog-single-rs.html">Smart Homes Become Even More Smart</a></h4><span class="entry-meta">by Cedric Diggory</span>
                </div>
              </div>
            </section>
          </aside>
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