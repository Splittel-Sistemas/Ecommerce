<?php
@session_start();
if ($_SESSION['Ecommerce_ClienteIngreso'] == 1 || $_SESSION['Ecommerce-ClienteTipo'] == 'B2C') {
  header("Location: ./solicitud.php");
} else {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <?php
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Head.php';
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Login/seguridad.php';
    ?>
  </head>
  <!-- Body-->

  <body>
    <!-- Page Content-->
    <div class="row no-gutters">
      <div class="col-md-6 fh-section" style="background-image: url(../../public/images/Otros/2.jpg);"><span class="overlay"></span>
        <div class="d-flex flex-column fh-section py-5 px-3 justify-content-between">
          <div class="w-100 text-center" id="dataInterna" primero="<?php echo $_SESSION['AuthUser']; ?>" segundo="<?php echo $_SESSION['AuthPassword']; ?>">
          </div>
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
      <div class="col-md-6 fh-section" id="notify" data-offset-top="-1">
        <div class="d-flex flex-column fh-section py-5 px-3 justify-content-center align-items-center">
          <div class="text-center" style="max-width: 500px;">
            <div class="h1 text-normal mb-3">Bienvenido</div>
            <h6 class="text-muted mb-4">Por seguridad es necesario cambiar tu contraseña</h6>
            <form id="form-change-password">
              <div class="form-group">
                <input class="form-control form-control-sm" type="password" id="PersonalPassword" name="PersonalPassword" placeholder="Contraseña" autocomplete="off" required>
              </div>
              <div class="form-group">
                <input class="form-control form-control-sm" type="password" id="PersonalPasswordConfirm" name="PersonalPasswordConfirm" placeholder="Confirmar Contraseña" autocomplete="off" required>
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input class="custom-control-input" type="checkbox" id="PersonalTerminos" name="PersonalTerminos">
                  <input class="custom-control-input" type="hidden" id="ClienteTipo" nvalue="<?= $_SESSION['Ecommerce-ClienteTipo'] ?>">
                  <label class="custom-control-label" for="PersonalTerminos"><a href="../AtencionCliente/politicas_privacidad.php" class="text-sm text-muted" target="_blank">Al actualizar contraseña aceptas lo terminos y condiciones.</a></label>
                </div>
              </div>
              <button class="btn btn-primary btn-sm float-right" type="button" onclick="changePassword()"><i class="icon-mail"></i>&nbsp;Enviar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Partials/Scripts.php'; ?>
    <!--  -->
    <script type="text/javascript" src="../../public/scripts/Login/index.js?id=" <?php echo rand(); ?>></script>
  </body>

  </html>
<?php } ?>