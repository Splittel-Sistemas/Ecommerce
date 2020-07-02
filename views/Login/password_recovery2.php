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
      include $_SERVER["DOCUMENT_ROOT"].'/store/models/Librerias/Captcha/simple-php-captcha.php';
      $_SESSION['captcha'] = simple_php_captcha();
     ?>
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
            <li><span class="text-primary text-medium">2. </span>Le enviaremos un código temporal por correo electrónico.</li>
            <li><span class="text-primary text-medium">3. </span>Use el código para cambiar su contraseña en nuestro sitio web seguro.</li>
          </ol>
          <form class="card mt-4" onsubmit="return valida_captcha('<?php echo $_SESSION['captcha']['code']?>')">
            <div class="card-body">
              <div class="form-group">
                <input type="hidden" id="CodeCaptcha" name="CodeCaptcha" value="<?php echo $_SESSION['captcha']['code']?>">
                <label for="email">Ingresa tu email</label>
                <input class="form-control" type="text" id="email" required>
                <label for="captcha">Captcha</label>
                <input class="form-control" type="text" id="captcha" required><small class="form-text text-muted"><br>
                <img src="../../models/Librerias/Captcha/<?php echo $_SESSION['captcha']['image_src']; ?>" alt="CAPTCHA code"><br><br>
                Escriba la dirección de correo electrónico que utilizó cuando se registró y el CAPTCHA, Luego enviaremos un código por correo electrónico a esta dirección</small>
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary float-right" type="submit">Enviar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/Scripts.php'; ?>
    <!--  -->
    <script type="text/javascript" src="../../public/scripts/Login/index.js?id="<?php echo rand(); ?>></script>
  </body>
</html>