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
      if (!class_exists("Blog")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Blog/Blog.php';
      }
      $Blog = new Blog();
      $response = (object)$Blog->get("WHERE id = '".$_GET['id']."' AND activo = 'si' ", "", false)->records[0];
     ?>
     <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>BLOG</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li><a href="index.php?pag=1">Blog</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li><?php echo $response->BlogTitulo;?></li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
      <div class="row justify-content-center">
        <!-- Content-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
          <!-- Post Meta-->
          <ul class="post-meta mb-4">
            <li><i class="icon-clock"></i><a href="#"><?php echo ucwords(strftime( '%B' , strtotime($response->BlogFecha))).' '.strftime(date("j, Y",strtotime($response->BlogFecha)));?></a></li>
          </ul>
          <!-- Gallery-->
          <div class="gallery-wrapper">
            <div class="">
              <a href="../../public/images/img_spl/blog/<?php echo $response->BlogImgLanding;?>" data-size="1000x353">
                <img src="../../public/images/img_spl/blog/<?php echo $response->BlogImgLanding;?>" alt="<?php echo $response->BlogTitulo;?>">
              </a><span class="caption"><?php echo $response->BlogTitulo;?></span>
            </div>
          </div>
          <h1 class="pt-4"><?php echo $response->BlogTituloLanding?></h1>
          <p style="text-align: justify;"><?php
                echo nl2br($response->BlogContenidoLanding);
            ?></p>
          
          <!-- Post Tags + Share-->
          <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 pb-4">
            <div class="pb-2"></div>
            <div class="pb-2">
            <span class="d-inline-block align-middle text-sm text-muted">Share post:&nbsp;&nbsp;&nbsp;</span>
            <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a>
            <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-twitter" href="https://twitter.com/share?ref_src=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>"><i class="socicon-twitter"></i></a>
            </div>
          </div>
          <!-- Post Navigation-->
          <?php 
            $Blog = new Blog();
            $first_blog = $Blog->get("", "ORDER BY id ASC LIMIT 1 ", false)->records[0];
            $first_blog = $first_blog->BlogKey;
            $first_blog == $_GET['id'] ? $first_blog = '#' : $first_blog = "detalle.php?id=".($_GET['id'] - 1);

            $Blog = new Blog();
            $final_blog = $Blog->get("", "ORDER BY id DESC LIMIT 1 ", false)->records[0];
            $final_blog = $final_blog->BlogKey;
            $final_blog == $_GET['id'] ? $final_blog = '#' : $final_blog = "detalle.php?id=".($_GET['id'] + 1);
           ?>
          <div class="entry-navigation">
            <div class="column text-left"><a class="btn btn-outline-secondary btn-sm" href="<?php echo $first_blog; ?>"><i class="icon-arrow-left"></i>&nbsp;Anterior</a></div>
            <div class="column"><a class="btn btn-outline-secondary view-all" href="../Blog/index.php?pag=1" data-toggle="tooltip" data-placement="top" title="Todos"><i class="icon-menu"></i></a></div>
            <div class="column text-right"><a class="btn btn-outline-secondary btn-sm" href="<?php echo $final_blog; ?>">Siguiente&nbsp;<i class="icon-arrow-right"></i></a></div>
          </div>
        </div>
      </div>
      
      <div id="ListReviews">
        <?php include 'Comentarios/List.php'; ?>
      </div>
      


          <!-- Comment Form-->
          <div class="row justify-content-center">
            <!-- Content-->
            <div class="col-xl-9 col-lg-8 order-lg-2">
          <h4 class="padding-top-2x padding-bottom-1x">Déjanos tu comentario</h4>
          <form id="form-comment" class="row" method="post">
          <input type="hidden" id="Action" name="Action" value="create">
          <input type="hidden" id="ActionComentarios" name="ActionComentarios" value="true">
          <input type="hidden" id="BlogKey" name="BlogKey" value="<?php echo $_GET['id']?>"/>
            <div class="col-12">
              <div class="form-group">
                <label for="comment-text">Comentario</label>
                <textarea name="Comment" class="form-control form-control-rounded" rows="7" id="comment-text" placeholder="Ingresa aqui tu comentario..." required></textarea>
              </div>
            </div>
            <div class="col-12 text-right">
              <button class="btn btn-primary" type="button" onclick="createReviewBlog()">Agregar</button>
            </div>
          </form>

          </div>
          </div>

        </div>

    </div>

<!-- Leave a Review-->
<div class="modal fade" id="modal-review">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <form id="form-reply">
          <div id="modal-body-review">
            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <script type="text/javascript" src="../../public/scripts/Blog/Comentarios.js?id=<?php echo rand() ?>"></script>
  </body>
</html>

<?php 
  
  unset($Blog);
  unset($response);
  unset($first_blog);
  unset($final_blog);
  
 ?>