<?php 
  @session_start();
  if(isset($_SESSION['Ecommerce-ClienteKey'])){
    header('Location: ../Home');
  }else{
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php 
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Login/seguridad.php';     
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php';     
    ?>
  </head>
  <!-- Body-->
  <body>
    <!-- Page Content-->
    <div class="row no-gutters" id="dataInterna" primero="<?php echo $_SESSION['AuthUser']; ?>" segundo="<?php echo $_SESSION['AuthPassword']; ?>">
      <div class="col-md-4 fh-section" style="background-image: url(../../public/images/Otros/catalogo.jpg);">
      <span class="overlay" style="background-color: #000; opacity: .7;"></span>
      <div class="d-flex flex-column fh-section py-5 px-3 justify-content-between">
        <div class="w-100 text-center"></div>
        <div class="w-100 text-center">
          <p class="text-white mb-2">01 800 800 0011</p><a class="navi-link-light" href="mailto:ventas@fibremex.com.mx">ventas@fibremex.com.mx</a>
          <div class="pt-3">
            <a class="social-button shape-circle sb-facebook sb-light-skin" href="https://www.facebook.com/Fibremex" target="_blank"><i class="socicon-facebook"></i></a>
            <a class="social-button shape-circle sb-twitter sb-light-skin" href="https://twitter.com/Fibremexx" target="_blank"><i class="socicon-twitter"></i></a>
            <a class="social-button shape-circle sb-instagram sb-light-skin" href="https://www.instagram.com/fibremex/" target="_blank"><i class="socicon-instagram"></i></a>
            <a class="social-button shape-circle sb-google-plus sb-light-skin" href="https://mx.linkedin.com/company/fibremex-s-a-de-c-v-" target="_blank"><i class="socicon-linkedin"></i></a>
            <a class="social-button shape-circle sb-google-plus sb-light-skin" href="https://www.youtube.com/channel/UCb-quhJT0AqywnRBw1n4jiA" target="_blank"><i class="socicon-youtube"></i></a>
          </div>
        </div>
      </div>
    </div>
      <div class="col-md-4 fh-section" id="notify" data-offset-top="-1">
        <div class="d-flex flex-column fh-section py-5 px-3 justify-content-center align-items-center">
          <div style="max-width: 500px;">
            <!-- <div class="h1 text-normal mb-3 text-center">Registro</div> -->
            <h3 class="margin-bottom-1x text-center">¿Aún no tienes cuenta? Registrate</h3>
            <p>El registro solo te llevara algunos minutos para obtener el control de tus pedidos.</p>
            <form id="form-registro-b2b">
              <input type="hidden" id="Action" name="Action" value="createb2b">
              <input type="hidden" id="ActionCliente" name="ActionCliente" value="true">
              <div class="form-group">
                <input class="form-control form-control-pill" type="text" id="Nombre" name="Nombre" placeholder="Nombre" required autocomplete="off">
              </div>
              <div class="form-group">
                <input class="form-control form-control-pill" type="text" id="Apellidos" name="Apellidos" placeholder="Apellidos" required autocomplete="off">
              </div>
              <div class="form-group">
                <input class="form-control form-control-pill" type="text" id="Telefono" name="Telefono" placeholder="Teléfono o celular" required autocomplete="off">
              </div>
              <div class="form-group">
                <input class="form-control form-control-pill" type="text" id="Correo" name="Correo" placeholder="Correo" required autocomplete="off">
              </div>
              <div class="form-group">
                <input class="form-control form-control-pill" type="password" id="Password" name="Password" placeholder="Contraseña" required autocomplete="new-password"> 
              </div>
              <div class="form-group">
                <input class="form-control form-control-pill" type="password" id="ConfirmarPassword" name="ConfirmarPassword" placeholder="Confirmar Contraseña" required autocomplete="new-password">
              </div>
              <div class="form-group">
                <input class="form-control form-control-pill" type="text" id="CardCode" name="CardCode" placeholder="Cardcode" required autocomplete="off">
              </div>
              <div class="form-group">
                <input class="form-control form-control-pill" type="text" id="Sociedad" name="Sociedad" placeholder="Sociedad" required autocomplete="off">
              </div>
              <div class="form-group">
                <input class="form-control form-control-pill" type="text" id="PasswordB2B" name="PasswordB2B" placeholder="Password b2b" required autocomplete="off">
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="button" class="btn btn-outline-primary btn-block float-right" onclick="Registro(this)"><i class="icon-user-plus"></i>&nbsp; Registrar</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4 fh-section" style="background-image: url(../../public/images/Otros/catalogo.jpg);">
        <span class="overlay" style="background-color: #000; opacity: .7;"></span>
        <div class="d-flex flex-column fh-section py-5 px-3 justify-content-between">
          <div class="w-100 text-center"></div>
          <div class="w-100 text-center">
            <p class="text-white mb-2">01 800 800 0011</p><a class="navi-link-light" href="mailto:ventas@fibremex.com.mx">ventas@fibremex.com.mx</a>
            <div class="pt-3">
              <a class="social-button shape-circle sb-facebook sb-light-skin" href="https://www.facebook.com/Fibremex" target="_blank"><i class="socicon-facebook"></i></a>
              <a class="social-button shape-circle sb-twitter sb-light-skin" href="https://twitter.com/Fibremexx" target="_blank"><i class="socicon-twitter"></i></a>
              <a class="social-button shape-circle sb-instagram sb-light-skin" href="https://www.instagram.com/fibremex/" target="_blank"><i class="socicon-instagram"></i></a>
              <a class="social-button shape-circle sb-google-plus sb-light-skin" href="https://mx.linkedin.com/company/fibremex-s-a-de-c-v-" target="_blank"><i class="socicon-linkedin"></i></a>
              <a class="social-button shape-circle sb-google-plus sb-light-skin" href="https://www.youtube.com/channel/UCb-quhJT0AqywnRBw1n4jiA" target="_blank"><i class="socicon-youtube"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <!--  -->
    <script>
        var Registro = function() {
        ajax_('../../models/Cliente/Cliente.Route.php', 'POST', 'JSON', $('#form-registro-b2b').serialize(), 
        function(response){
            console.log(response)
        })
        }
    </script>
  </body>
</html>
<?php } ?>