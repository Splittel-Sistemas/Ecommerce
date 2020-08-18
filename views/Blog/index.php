<!DOCTYPE html>
<html lang="es">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php'; ?>
    <?php 
	date_default_timezone_set("America/Mexico_City");
	setlocale(LC_TIME, "spanish");
      if (!class_exists("Blog")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Blog/Blog.php';
      }
      $Blog = new Blog();
      $range1 = ($_GET['pag'] - 1) * $Blog->elem_totales_pagination;
      //$range2 = ($_GET['pag']) * $Blog->elem_totales_pagination;
	    $range2 = $Blog->elem_totales_pagination;
      $response = (object)$Blog->get("WHERE activo = 'si' ", "ORDER BY fecha DESC  LIMIT ".$range1.", ".$range2." ", false);
    ?>
        <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Blog Fibremex</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Blog</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1">
      <div class="isotope-grid cols-3 mb-4">
        <div class="gutter-sizer"></div>
        <div class="grid-sizer"></div>
        <?php if ($response->count > 0): ?>
          <?php $con1=1; $con2=1; ?>
          <?php foreach ($response->records as $key => $row): ?>
          <div class="grid-item">
            <div class="blog-post">
            <?php // if ( ((($con2 % 2)!=0) &&  (($con1 % 2)!=0) )  || ( (($con1 % 2)==0) && (($con2 % 2)==0) )): ?>
              <a class="post-thumb" href="detalle.php?id=<?php echo $row->BlogKey;?>&nom=<?php echo $row->BlogComillas;?>">
                <img src="../../public/images/img_spl/blog/<?php echo $row->BlogImg;?>" alt="<?php echo $row->BlogTitulo;?>">
              </a>
            <?php //endif ?>
              <div class="post-body">
                <ul class="post-meta">
                  <li>
                    <i class="icon-clock"></i>
                    <a href="detalle.php?id=<?php echo $row->BlogKey;?>&nom=<?php echo $row->BlogComillas;?>"><?php echo ucwords(strftime( '%B' , strtotime($row->BlogFecha))).' '.strftime(date("j, Y",strtotime($row->BlogFecha)));?></a>
                  </li>
                </ul>
                <h1 class="post-title">
                  <a href="detalle.php?id=<?php echo $row->BlogKey;?>&nom=<?php echo $row->BlogComillas;?>"><?php echo $row->BlogTitulo;?></a>
                </h1>
                <p><?php echo $row->BlogContenido;?> 
                  <a href='detalle.php?id=<?php echo $row->BlogKey;?>&nom=<?php echo $row->BlogComillas;?>'>Ver más</a>
                </p>
              </div>
            </div>
          </div>
          <?php 
          /*  
		  if($con2==3){
              $con1++;
              $con2==0;
            }
            $con2++; 
			*/
          ?>
          <?php endforeach ?>
        <?php endif ?>
      </div>
      <!-- Pagination-->
      <nav class="pagination">
        <div class="column">
          <ul class="pages">
            <?php 
              $total_elem_pag = $Blog->blogsPagination("", "", false);
              $j = 1;
              $total_elem_pag->page_pagination == $_GET['pag'] ? $url = "#" : $url = "index.php?pag=".($_GET['pag']+1);

              for ($i=0; $i < $total_elem_pag->page_pagination; $i++) { 
                  $j == $_GET['pag'] ? $active = 'active' : $active ='';

            ?>
            <li class="<?php echo $active; ?>"><a href="index.php?pag=<?php echo $j; ?>"><?php echo $j; ?></a></li>
            <?php 
              $j++;
             } 
            ?>

          </ul>
        </div>
        <div class="column text-right hidden-xs-down"><a class="btn btn-outline-secondary btn-sm" href="<?php echo $url; ?>">Siguiente&nbsp;<i class="icon-chevron-right"></i></a></div>
      </nav>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
  </body>
</html>

<?php 
  
  unset($Blog );
  unset($response);
  
 ?>