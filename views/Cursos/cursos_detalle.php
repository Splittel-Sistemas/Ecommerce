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
      if (!class_exists("CatalogoCursos")) {
        include $_SERVER["DOCUMENT_ROOT"].'/store/models/Catalogos/Cursos.php';
      }
      $CatalogoCursos = new CatalogoCursos();
      $response = $CatalogoCursos->get("WHERE activo = 'si' AND id = '".$_GET['id']."' ", "", false)->records[0];
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1><?php echo $response->titulo;?></h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li><a href="cursos.php">Cursos</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li><?php echo $response->nombre;?></li>
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
            <li><i class="icon-clock"></i><a href="#"><?php echo ucwords(strftime( '%B' , strtotime($response->fecha))).' '.strftime(date("j, Y",strtotime($response->fecha)));?></a></li>
          </ul>
          <!-- Gallery-->
          <div class="gallery-wrapper">
            <div class="gallery-item"><a href="../../public/images/img_spl/cursos/<?php echo $response->img_principal;?>" data-size="1000x353">
            <img src="../../public/images/img_spl/cursos/<?php echo $response->img_principal;?>" alt="<?php echo $response->titulo;?>"></a><span class="caption"><?php echo $response->titulo;?></span></div>
          </div>
          <div class="gallery-wrapper">
            <div class="row">
              <div class="col-md-4 col-sm-6 col-4">
                <div class="gallery-item"><a href="../../public/images/img_spl/cursos/<?php echo $response->img_min1?>" data-size="900x600"><img src="../../public/images/img_spl/cursos/<?php echo $response->img_min1?>" alt="<?php echo $response->nombre;?>"></a><span class="caption"><?php echo $response->titulo;?></span></div>
              </div>
              <div class="col-md-4 col-sm-6 col-4">
                <div class="gallery-item"><a href="../../public/images/img_spl/cursos/<?php echo $response->img_min2?>" data-size="900x600"><img src="../../public/images/img_spl/cursos/<?php echo $response->img_min2;?>" alt="<?php echo $response->nombre;?>"></a><span class="caption"><?php echo $response->titulo;?></span></div>
              </div>
              <div class="col-md-4 col-sm-6 col-4">
                <div class="gallery-item"><a href="../../public/images/img_spl/cursos/<?php echo $response->img_min3?>" data-size="900x600"><img src="../../public/images/img_spl/cursos/<?php echo $response->img_min3;?>" alt="<?php echo $response->nombre;?>"></a><span class="caption"><?php echo $response->titulo;?></span></div>
              </div>
            </div>
          </div>
          <h2 class="pt-4"><?php echo $response->titulo?></h2>
          <p style="text-align: justify;"><?php
                echo nl2br($response->texto1);
            ?></p>
          
          <div class="row pt-3 pb-2">
            <div class="col-xl-10 offset-xl-1">
              <blockquote class="margin-top-1x margin-bottom-1x">
                <p><?php echo nl2br($response->comillas)?></p>
                
              </blockquote>
            </div>
          </div>
          <br />
          <br />
          <p style="text-align: justify;"><?php
                echo nl2br($response->texto2);
            ?></p>
          <br />
          <br />
          <p style="text-align: center;">
            <a style="text-decoration: none; color: black;" href="../../public/images/img_spl/cursos/temario/<?php echo $response->temario;?>.pdf" target="_blank">
                <img src="../../public/images/img_spl/adicionales/temario.png" /><br/>
                <b>DESCARGAR TEMARIO</b>
            </a>
          </p>
          
          <h6 class="text-muted text-center text-normal text-uppercase margin-top-3x">&iquest;EST&Aacute;S INTERESADO EN EL CURSO? </h6>
          <h6 class="text-muted text-center text-normal ">Deja tus datos y a la brevedad nos comunicaremos contigo para porporcionarte m&aacute;s informaci&oacute;n</h6>
          <hr class="margin-bottom-1x margin-top-2x">
          <form id="form-cursos">
            <input class="form-control" type="hidden" name="ActionCursos" id="ActionCursos" value="true">
            <input class="form-control" type="hidden" name="Action" id="Action" value="RegistroCursos">
            <input class="form-control" type="hidden" name="Descripcion" id="Descripcion" value="cursos">
            <input class="form-control" type="hidden" name="NombreCurso" id="NombreCurso" value="<?php echo $response->titulo;?>">
            <div class="row">
              <div class="col-sm-6 form-group">
                <label for="validationCustom04">Nombre</label>
                <input class="form-control cursos" type="text"  name="Nombre" id="Nombre" required>
              </div>
              <div class="col-sm-6 form-group">
                <label for="validationCustom05">Empresa</label>
                <input class="form-control cursos" type="text"  name="Empresa" id="Empresa" required>
                
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group">
                <label>Email</label>
                <input class="form-control cursos" type="email" name="Email" id="Email" required>
              </div>
              <div class="col-sm-6 form-group">
                <label>Telefono</label>
                <input class="form-control cursos" type="text" name="Telefono" id="Telefono" required>                
              </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="EmailCursos(this)">Enviar</button>
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
          </form>
          
          <!-- Post Tags + Share-->
          <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 pb-4">
            <div class="pb-2"></div>
            <div class="pb-2"><span class="d-inline-block align-middle text-sm text-muted">Share post:&nbsp;&nbsp;&nbsp;</span>
            <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a>
            <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-twitter" href="https://twitter.com/share?ref_src=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>"><i class="socicon-twitter"></i></a>
          <!--  <a class="social-button shape-rounded sb-instagram" href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="socicon-instagram"></i></a> -->
            
            </div>
          </div>
          <!-- Post Navigation-->
          <?php 
            $CatalogoCursos = new CatalogoCursos();
            $first_cur = $CatalogoCursos->get("", "ORDER BY id ASC LIMIT 1 ", false)->records[0];
            $first_cur = $first_cur->id;
            $first_cur == $_GET['id'] ? $first_cur = '#' : $first_cur = "cursos_detalle.php?id=".($_GET['id'] - 1);

            $CatalogoCursos = new CatalogoCursos();
            $final_cur = $CatalogoCursos->get("", "ORDER BY id DESC LIMIT 1 ", false)->records[0];
            $final_cur = $final_cur->id;
            $final_cur == $_GET['id'] ? $final_cur = '#' : $final_cur = "cursos_detalle.php?id=".($_GET['id'] + 1);
           ?>
          <div class="entry-navigation">
            <div class="column text-left"><a class="btn btn-outline-secondary btn-sm" href="<?php echo $first_cur; ?>"><i class="icon-arrow-left"></i>&nbsp;Prev</a></div>
            <div class="column"><a class="btn btn-outline-secondary view-all" href="cursos.php" data-toggle="tooltip" data-placement="top" title="Todos"><i class="icon-menu"></i></a></div>
            <div class="column text-right"><a class="btn btn-outline-secondary btn-sm" href="<?php echo $final_cur; ?>">Next&nbsp;<i class="icon-arrow-right"></i></a></div>
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
  
  unset($CatalogoCursos);
  unset($response);
  unset($first_cur);
  unset($final_cur);
  
 ?>