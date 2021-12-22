<?php 
  @session_start();
  $url = isset($_GET['url']) && !empty($_GET['url']) ? $_GET['url'] : '';
  if(isset($_SESSION['Ecommerce-ClienteKey'])){
    if(empty($url))
        header('Location: ../Home');
      else
        header('Location: '.$url);
  }else{
    $ip='localhost';
    if (isset($_SERVER["HTTP_CLIENT_IP"]))
    {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
    {
      $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
    {
      $ip = $_SERVER["HTTP_X_FORWARDED"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
    {
      $ip = $_SERVER["HTTP_FORWARDED_FOR"];
    }
    elseif (isset($_SERVER["HTTP_FORWARDED"]))
    {
      $ip = $_SERVER["HTTP_FORWARDED"];
    }
    else
    {
      $ip = $_SERVER["REMOTE_ADDR"];
    }
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
      <div class="col-md-4 fh-section" id="notify" data-offset-top="-1">
        <div class="d-flex flex-column fh-section  px-3 justify-content-center align-items-center">
          <div style="max-width: 500px;">
         <!--
            <div class="row no-gutters mb-5">
							<div class="col-12">
								<div class="d-flex justify-content-center justify-content-md-start">
									<span class="align-middle"><a class="social-button shape-circle sb-facebook" href="solicitud.php" ><i class="icon-help-circle"></i></a>Pre-registro para empresas</span>
								</div>
							</div>
						</div>
          -->
            <div class="h1 text-normal mb-3 text-center">Iniciar Sesión</div>
            <form id="form-login">
              <input type="hidden" id="Action" name="Action" value="login">
              <input type="hidden" id="ActionLogin" name="ActionLogin" value="true">
              <input type="hidden" id="Ip" name="Ip" value="<?php echo $ip?>">
              <input type="hidden" id="url" name="url" value="<?php echo $url?>">
              <div class="form-group">
                <input class="form-control" type="email" id="Email" name="Email" placeholder="Correo" required>
              </div>
              <div class="form-group">
                <input class="form-control" type="password" id="Password" name="Password" placeholder="Password" required>
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="button" class="btn btn-outline-primary btn-block float-right" onclick="Login(this)"><i class="icon-log-in"></i>&nbsp; Ingresar</button>
                </div>
                
              </div>
              <!--
              <hr style="height:2px;" class="padding-bottom-1x"/>
              <h6 class="text-sm"> * Si no tienes usuario y contraseña, regístrate.</h6>
              <div class="row">
                <div class="col-12">
                  <a class="btn btn-outline-info btn-block float-right" href="../Login/registro.php"><i class="icon-user-plus"></i>&nbsp; Registro</a>
                </div>
               
              </div>
               -->
              <hr style="height:2px;" class="padding-bottom-1x"/>
              <h6 class="text-sm"> EMPRESAS ESPECIALIZADAS EN INSTALACIÓN DE REDES DE TELECOMUNICACIONES</h6>
              <h4 class="text-sm "> * Si ya es cliente y aún no cuenta con su número de cuenta o password para acceder, contacte con su ejecutivo de ventas.
                <br/><br/>
                Si es una empresa integradora especializada, le solicitamos realizar el prerregistro para poder obtener beneficios adicionales.
              </h4>
              
              <div class="row">
                
                <div class="col-12">
                  <a class="btn btn-outline-info btn-block float-right" href="../Login/solicitud.php"><i class="icon-user-plus"></i>&nbsp; Pre-registro empresas</a>
                </div>
                <div class="col-12 ">
                <a class="btn btn-outline-secondary btn-block float-right" href="../Home"><i class="icon-home"></i>&nbsp; Home</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8 fh-section" style="background-image: url(../../public/images/Otros/catalogo.jpg); background-position:100% 100%;">
        <span class="overlay" style="background-color: #000; opacity: .5;"></span>
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
    <script type="text/javascript" src="../../public/scripts/Login/login.js?id=<?php echo rand() ?>"></script>
  </body>
</html>
<?php } ?>