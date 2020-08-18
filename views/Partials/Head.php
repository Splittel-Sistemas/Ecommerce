<!-- SEO Meta Tags-->
<title>Fibremex | Líderes en Fibra Óptica y Telecomunicaciones de México</title>
<meta name="Description" content="Distribuidor de productos para la instalación de redes de Fibra Óptica, Telecomunicaciones y Cableado Estructurado en México." />
<meta name="keywords" content="fibra óptica, telecomunicaciones, fibra óptica multimodo, fibra óptica monomodo, fibras opticas, redes, cableado estructurado, fibras opticas en mexico, fibra óptica">
<meta name="DC.title" content="fibremex" />
<meta name="geo.region" content="MX-QUE" />
<meta name="geo.placename" content="Querétaro" />
<meta name="geo.position" content="20.619458;-100.402572" />
<meta name="ICBM" content="20.619458, -100.402572" />
<meta name="author" content="TI - Grupo Splittel">
<meta charset="UTF-8">
<!-- Mobile Specific Meta Tag-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<!-- Favicon and Apple Icons-->
<link rel="icon" type="image/x-icon" href="../../public/Icons/fibremex.ico">
<!--
<link rel="icon" type="image/png" href="../../public/Icons/favicon.png">
<link rel="apple-touch-icon" href="../touch-icon-iphone.png">
<link rel="apple-touch-icon" sizes="152x152" href="../touch-icon-ipad.png">
<link rel="apple-touch-icon" sizes="180x180" href="../touch-icon-iphone-retina.png">
<link rel="apple-touch-icon" sizes="167x167" href="../touch-icon-ipad-retina.png">
-->
<!-- Vendor Styles including: Bootstrap, Font Icons, public, etc.-->
<link rel="stylesheet" media="screen" href="../../public/plantilla/css/vendor.min.css">
<!-- Main Template Styles-->
<link id="mainStyles" rel="stylesheet" media="screen" href="../../public/plantilla/css/styles-BF202F.min.css">
<link  rel="stylesheet" media="screen" href="../../public/plantilla/customizer/customizer.min.css">
<link rel="stylesheet" type="text/css" href="../../public/plugins/tingle/tingle.css">

<!-- Hotjar Tracking Code for www.fibremex.com -->

<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1950599,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>


<?php 
	@session_start();
	$_SESSION['Ecommerce-ClienteDescuento'] = isset($_SESSION['Ecommerce-ClienteDescuento']) && $_SESSION['Ecommerce-ClienteDescuento'] > 0 ? $_SESSION['Ecommerce-ClienteDescuento'] : 0;
?>
<style>
	.featured_products_card_1{
		height: 400.55px !important;
	}
  .grecaptcha-badge { 
    bottom:65px !important; 
}
</style>

<style type="text/css">
  .scroll_1{
    height: 300px; 
    overflow-y: auto;
  }
  .scroll_1::-webkit-scrollbar {
    width: 7px;     /* Tamaño del scroll en vertical */
    height: 8px;    /* Tamaño del scroll en horizontal */
  }

  .scroll_1::-webkit-scrollbar-thumb {
    background: #bd151d;
    border-radius: 4px;
  }
  .cursor-point{
    cursor: pointer;
  }
  .scroll-to-top-btn{
    left: 16px !important; 
  }
</style>

<?php 
  @session_start();
  $_SESSION['Ecommerce-ImgNotFound1'] = "../../public/images/img_spl/notfound1.png";
  $_SESSION['Ecommerce-ImgNotFound'] = "../../public/images/img_spl/notfound.png";
  $_SESSION['Ecommerce-CostoEnvio']  = !isset($_SESSION['Ecommerce-CostoEnvio']) || $_SESSION['Ecommerce-CostoEnvio'] > 1 ? 2 : $_SESSION['Ecommerce-CostoEnvio'];

  // if (!class_exists("Seguridad")) {
  //   include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Seguridad/Seguridad.Controller.php';
  // }

  // $SeguridadController = new SeguridadController();
  // $data = $SeguridadController->encrypData();
?>
<!-- <div id="credencialesaccess" primero="<?php #echo $data['Usuario'] ?>" segundo="<?php #echo $data['Password'] ?>"></div> -->
