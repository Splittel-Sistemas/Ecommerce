
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
    
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Recuperación de contraseña</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="../Home/">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li><a href="account-orders.html">Cuenta</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Recuperación de contraseña</li>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          <h2>¿Olvidaste tu contraseña?</h2>
          <p>Cambia tu contraseña en tres sencillos pasos. Esto ayuda a mantener segura su nueva contraseña.</p>
          <ol class="list-unstyled">
            <li><span class="text-primary text-medium">1. </span>Complete su dirección de correo electrónico a continuación.</li>
            <li><span class="text-primary text-medium">2. </span>Le enviaremos un código temporal por correo electrónico, el cual debera activar abriendo el enlace.</li>
            <li><span class="text-primary text-medium">3. </span>Use el código para iniciar sesion, en el primer inicio de sesion se solicitara cambiar su contraseña en nuestro sitio web.</li>
          </ol>
          <form class="card mt-4" id="RecoveryForm">
            <div class="card-body">
              <div class="form-group">
                <input type="hidden" id="Action" name="Action" value="recovery">
                <input type="hidden" id="ActionLogin" name="ActionLogin" value="true">
                <label for="email">Ingresa tu email</label>
                <input class="form-control" type="text" id="Email" name="Email" required>
                <br>
                Escriba la dirección de correo electrónico que utilizó para registrase, luego enviaremos un código de acceso temporal.</small>
              </div>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary float-right" onclick="Recovery(this)">Enviar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <!--  -->
    <script type="text/javascript" src="../../public/scripts/Login/login.js?id=<?php echo rand() ?>"></script>
  </body>
</html>