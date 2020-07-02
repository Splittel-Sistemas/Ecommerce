<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- <title> Contacto </title> -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Head.php'; ?>
	<script>
	  gtag('event', 'conversion', {'send_to': 'AW-1069545026/ixqYCIPh0MIBEMLs__0D'});
	</script>

  </head>
  <!-- Body-->
  <body>
    <!-- Header -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Header.php'; ?>
    <!-- Page Title-->
    <div style="margin-bottom: 0px;" class="page-title">
      <div class="container">
        <div class="column">
          <h1>Descarga de catálogo</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Descarga de catálogo</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
     <section class="fw-section " style="background-image: url(../../public/images/img_spl/catalogo/Descarga-catalogo.jpg); background-position: center top; background-size: 100% auto;"><span class="overlay" style="opacity: .3;"></span>
      <div class="col-lg-12 col-md-12 padding-bottom-2x padding-top-2x container text-center">
      <div class="row">
        <div class="col-lg-8 col-md-8">
        &nbsp;
        </div>
        <div class="col-lg-4 col-md-4">
        
          <h6 style="color: white;" class=" text-center text-normal ">Reg&iacute;strese y descargue su catálogo</h6>
          
          <form id="form-catalogo">
              <input class="form-control" type="hidden"  name="Action" id="Action" value="RegistroCatalogo">
              <input class="form-control" type="hidden"  name="ActionCursos" id="ActionCursos" value="true">
              <input class="form-control" type="hidden"  name="Descripcion" id="Descripcion" value="catalogo">
            <div class="row">
              <div class="col-sm-12 form-group">
                <input class="form-control catalogo" type="text" autocomplete="off" name="Empresa" id="Empresa" placeholder="Empresa" required="required">
              </div>
              <div class="col-sm-12 form-group">
                <input class="form-control catalogo" type="text" autocomplete="off" name="Nombre" id="Nombre" placeholder="Nombre" required>
              </div>
               <div class="col-sm-12 form-group">
                <input class="form-control catalogo" type="text" autocomplete="off" name="Telefono" id="Telefono" placeholder="Teléfono" required>                
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 form-group">
                <input class="form-control catalogo" type="email" autocomplete="off" name="Email" id="Email" placeholder="Correo" required>
              </div>
              <div class="col-sm-12 form-group">
                <input class="form-control catalogo" type="text" autocomplete="off" name="Giro" id="Giro" placeholder="Giro de la empresa" required>                
              </div>
            </div>
            
            <img class="btn btn-primary" desc="catalogo" onclick="EmailCatalogo(this)" src="../../public/images/img_spl/catalogo/boton_descarga1.png" />
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
          </form>
        </div>
        </div>
      </div>
    </section>
   
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Scripts.php'; ?>
  </body>
</html>