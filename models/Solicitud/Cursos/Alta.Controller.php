<?php

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Tools/Connection.php';
}
if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Tools/Functions_tools.php';
}
if (!class_exists("SolicitudCursos")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Solicitud/Cursos/Alta.Model.php';
}

if (!class_exists("TemplateFicrece")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Templates/Email/Alta.php';
  require_once $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Librerias/PHPMailer/class.phpmailer.php';
  require_once $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Librerias/PHPMailer/class.smtp.php';
}

/**
 * 
 */
class SolicitudCursosController
{

  protected $Connection;
  protected $Tool;

  public $filter;
  public $order;

  public function __construct()
  {
    $this->Connection = new Connection();
    $this->Tool = new Functions_tools();
  }

  public function Get()
  {
    try {
      if (!$this->Connection->conexion()->connect_error) {
        $SolicitudCModel = new SolicitudCursos();
        $SolicitudCModel->SetParameters($this->Connection, $this->Tool);
        $items = $SolicitudCModel->Get($this->filter, $this->order);
        unset($SolicitudCModel);
        return $this->Tool->Message_return(false, "", $items, false);
      }
    } catch (Exception $e) {
      throw $e;
    }
  }

  public function GetBy()
  {
    try {
      if (!$this->Connection->conexion()->connect_error) {
        $SolicitudCModel = new SolicitudCursos();
        $SolicitudCModel->SetParameters($this->Connection, $this->Tool);
        $SolicitudCModel->GetBy($this->filter, $this->order);
        return $SolicitudCModel;
      }
    } catch (Exception $e) {
      throw $e;
    }
  }


  public function Alta()
  {
    try {
      if (!$this->Connection->conexion()->connect_error) {
        $SolicitudCModel = new SolicitudCursos();

        $SolicitudCModel->SetParameters($this->Connection, $this->Tool);

        /*  print_r($_POST);
        exit; */


        $SolicitudCModel->Setname($_POST['name']);
        $SolicitudCModel->Setdate($_POST['date']);
        $SolicitudCModel->SetNombreSolicitud($_POST['NombreSolicitud']);
        $SolicitudCModel->SetTitulo($_POST['Titulo']);
        $SolicitudCModel->SetEmpresa($_POST['Empresa']);
        $SolicitudCModel->SetPuesto($_POST['Puesto']);
        $SolicitudCModel->SetTelefono($_POST['Telefono']);
        $SolicitudCModel->SetCorreoEmpresarial($_POST['CorreoEmpresarial']);
        $SolicitudCModel->SetCorrePersonal($_POST['CorrePersonal']);
        $SolicitudCModel->SetWhatsapp($_POST['Whatsapp']);




        $ResultSolicitud = $SolicitudCModel->Add();

        if (!$ResultSolicitud['error']) {

          $mensaje = ('<html>
          <head>
            <meta name="viewport" content="width=device-width" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <title>Ecommerce Grupo Splittel</title>
            <style>
                /* -------------------------------------
                    GLOBAL RESETS
                ------------------------------------- */
                
                /*All the styling goes here*/
                
                img {
                  border: none;
                  -ms-interpolation-mode: bicubic;
                  max-width: 100%; 
                }
                .banner-img{
                  width: 600px; 
                  height: 150px;
                }
                body {
                  background-color: #f6f6f6;
                  font-family: sans-serif;
                  -webkit-font-smoothing: antialiased;
                  font-size: 14px;
                  line-height: 1.4;
                  margin: 0;
                  padding: 0;
                  -ms-text-size-adjust: 100%;
                  -webkit-text-size-adjust: 100%; 
                }
          
                table {
                  border-collapse: separate;
                  mso-table-lspace: 0pt;
                  mso-table-rspace: 0pt;
                  width: 100%; }
                  table td {
                    font-family: sans-serif;
                    font-size: 14px;
                    vertical-align: top; 
                }
          
                /* -------------------------------------
                    BODY & CONTAINER
                ------------------------------------- */
          
                .body {
                  background-color: #f6f6f6;
                  width: 100%; 
                }
          
                /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
                .container {
                  display: block;
                  margin: 0 auto !important;
                  /* makes it centered */
                  max-width: 780px;
                  padding: 10px;
                  width: 780px; 
                }
          
                /* This should also be a block element, so that it will fill 100% of the .container */
                .content {
                  box-sizing: border-box;
                  display: block;
                  margin: 0 auto;
                  max-width: 880px;
                  padding: 10px; 
                }
          
                /* -------------------------------------
                    HEADER, FOOTER, MAIN
                ------------------------------------- */
                .main {
                  background: #ffffff;
                  border-radius: 3px;
                  width: 100%; 
                }
          
                .wrapper {
                  box-sizing: border-box;
                  padding: 20px; 
                }
          
                .content-block {
                  padding-bottom: 10px;
                  padding-top: 10px;
                }
          
                .footer {
                  clear: both;
                  margin-top: 10px;
                  text-align: center;
                  width: 100%; 
                }
                  .footer td,
                  .footer p,
                  .footer span,
                  .footer a {
                    color: #999999;
                    font-size: 12px;
                    text-align: center; 
                }
          
                /* -------------------------------------
                    TYPOGRAPHY
                ------------------------------------- */
                h1,
                h2,
                h3,
                h4 {
                  color: #000000;
                  font-family: sans-serif;
                  font-weight: 400;
                  line-height: 1.4;
                  margin: 0;
                  margin-bottom: 30px; 
                }
          
                h1 {
                  font-size: 35px;
                  font-weight: 300;
                  text-align: center;
                  text-transform: capitalize; 
                }
          
                p,
                ul,
                ol {
                  font-family: sans-serif;
                  font-size: 14px;
                  font-weight: normal;
                  margin: 0;
                  margin-bottom: 15px; 
                }
                  p li,
                  ul li,
                  ol li {
                    list-style-position: inside;
                    margin-left: 5px; 
                }
          
                a {
                  color: #3498db;
                  text-decoration: underline; 
                }
          
                /* -------------------------------------
                    BUTTONS
                ------------------------------------- */
                .btn {
                  box-sizing: border-box;
                  width: 100%; }
                  .btn > tbody > tr > td {
                    padding-bottom: 15px; }
                  .btn table {
                    width: 100%; 
                }
                  .btn table td {
                    background-color: #ffffff;
                    border-radius: 5px;
                    text-align: center; 
                }
                  .btn a {
                    background-color: #ffffff;
                    border: solid 1px #3498db;
                    border-radius: 5px;
                    box-sizing: border-box;
                    color: #3498db;
                    cursor: pointer;
                    display: inline-block;
                    font-size: 14px;
                    font-weight: bold;
                    margin: 0;
                    padding: 12px 25px;
                    text-decoration: none;
                    text-transform: capitalize; 
                }
          
                .btn-primary table td {
                  background-color: #ffffff; 
                }
          
                .btn-primary a {
                  background-color: #3498db;
                  border-color: #3498db;
                  color: #ffffff; 
                }
          
                /* -------------------------------------
                    OTHER STYLES THAT MIGHT BE USEFUL
                ------------------------------------- */
                .last {
                  margin-bottom: 0; 
                }
          
                .first {
                  margin-top: 0; 
                }
          
                .align-center {
                  text-align: center; 
                }
          
                .align-right {
                  text-align: right; 
                }
          
                .align-left {
                  text-align: left; 
                }
          
                .clear {
                  clear: both; 
                }
          
                .mt0 {
                  margin-top: 0; 
                }
          
                .mb0 {
                  margin-bottom: 0; 
                }
          
                .preheader {
                  color: transparent;
                  display: none;
                  height: 0;
                  max-height: 0;
                  max-width: 0;
                  opacity: 0;
                  overflow: hidden;
                  mso-hide: all;
                  visibility: hidden;
                  width: 0; 
                }
          
                .powered-by a {
                  text-decoration: none; 
                }
          
                hr {
                  border: 0;
                  border-bottom: 1px solid #f6f6f6;
                  margin: 20px 0; 
                }
          
                /* -------------------------------------
                    RESPONSIVE AND MOBILE FRIENDLY STYLES
                ------------------------------------- */
                @media only screen and (max-width: 620px) {
                  table[class=body] h1 {
                    font-size: 28px !important;
                    margin-bottom: 10px !important; 
                  }
                  table[class=body] p,
                  table[class=body] ul,
                  table[class=body] ol,
                  table[class=body] td,
                  table[class=body] span,
                  table[class=body] a {
                    font-size: 16px !important; 
                  }
                  table[class=body] .wrapper,
                  table[class=body] .article {
                    padding: 10px !important; 
                  }
                  table[class=body] .content {
                    padding: 0 !important; 
                  }
                  table[class=body] .container {
                    padding: 0 !important;
                    width: 100% !important; 
                  }
                  table[class=body] .main {
                    border-left-width: 0 !important;
                    border-radius: 0 !important;
                    border-right-width: 0 !important; 
                  }
                  table[class=body] .btn table {
                    width: 100% !important; 
                  }
                  table[class=body] .btn a {
                    width: 100% !important; 
                  }
                  table[class=body] .img-responsive {
                    height: auto !important;
                    max-width: 100% !important;
                    width: auto !important; 
                  }
                }
          
                /* -------------------------------------
                    PRESERVE THESE STYLES IN THE HEAD
                ------------------------------------- */
                @media all {
                  .ExternalClass {
                    width: 100%; 
                  }
                  .ExternalClass,
                  .ExternalClass p,
                  .ExternalClass span,
                  .ExternalClass font,
                  .ExternalClass td,
                  .ExternalClass div {
                    line-height: 100%; 
                  }
                  .apple-link a {
                    color: inherit !important;
                    font-family: inherit !important;
                    font-size: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important;
                    text-decoration: none !important; 
                  }
                  #MessageViewBody a {
                    color: inherit;
                    text-decoration: none;
                    font-size: inherit;
                    font-family: inherit;
                    font-weight: inherit;
                    line-height: inherit;
                  }
                  .btn-primary table td:hover {
                    /* background-color: #34495e !important;  */
                  }
                  .btn-primary a:hover {
                    background-color: #34495e !important;
                    border-color: #34495e !important; 
                    font-family: sans-serif;
                    font-size: 14px;
                    /* vertical-align: top;  */
                  } 
                  
                }
                .title{
                    background-color: gray;
                    border-radius: 5px;
                    text-align: center;
                  }
                .bloque-dere{
                  border-left-color: gray;
                  /* border-left-width: medium; */
                  /* border-top-style: dotted; */
                  border-left-style: solid;
                  border-left-width: 2px;
                }
                .alert {
                  padding: 8px 35px 8px 14px;
                  margin-bottom: 18px;
                  color: #c09853;
                  text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
                  background-color: #fcf8e3;
                  border: 1px solid #fbeed5;
                  -webkit-border-radius: 4px;
                  -moz-border-radius: 4px;
                  border-radius: 4px;
                }
                .alert-heading {
                  color: inherit;
                }
                .alert .close {
                  position: relative;
                  top: -2px;
                  right: -21px;
                  line-height: 18px;
                }
                .alert-success {
                  color: #468847;
                  background-color: #dff0d8;
                  border-color: #d6e9c6;
                }
                .alert-info {
                  color: #3a87ad;
                  background-color: #d9edf7;
                  border-color: #bce8f1;
                }
                .alert-warning {
                  color: #8a6d3b;
                  background-color: #fcf8e3;
                  border-color: #faebcc;
                }
                .alert-block {
                  padding-top: 14px;
                  padding-bottom: 14px;
                }
                .alert-block > p,
                .alert-block > ul {
                  margin-bottom: 0;
                }
                .alert-block p + p {
                  margin-top: 5px;
                }
                .img-check{
                  display: block;
                  margin-top: 50px; 
                  margin-bottom: 50px;
                  width: 50px; 
                  height: 50px;
                  text-align: center;
                }
            </style>
          </head><body class="">
          <span class="preheader">Ecommerce Grupo Splittel</span>
          
          <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
            <tr>
              <td>&nbsp;</td>
              <td class="container">
                <div class="content">

                  <!-- START CENTERED WHITE CONTAINER -->
                  <table role="presentation" class="main">

                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                      <td><img class="banner-img" width="800" src="http://www.fibremex.com/ecomfmx/public.jpg" alt=""></td>
                    </tr>
                    <tr>
                  
                 
                    <td class="wrapper">
                    <p align="center" style="margin-bottom:10px;"><strong>Nombre del curso: </strong>' . $_POST['name'] . '</p>
                    <p align="center" style="margin-bottom:10px;"><strong>Fecha: </strong>' . $_POST['date'] . '</p>
                    <p align="center" style="margin-bottom:10px;"><strong>EJECUTIVO: </strong>' . $_POST['CorreEjecutivo'] . '</p>
                    <p align="center" style="margin-bottom:10px;"><strong>Nombre y Título: </strong>' . $_POST['NombreSolicitud'] . '</p>
                    <p align="center" style="margin-bottom:10px;"><strong>Empresa: </strong>' . $_POST['Empresa'] . '</p>
                    <p align="center" style="margin-bottom:10px;"><strong>Puesto: </strong>' . $_POST['Puesto'] . '</p>
                    <p align="center" style="margin-bottom:10px;"><strong>Telefono: </strong>' . $_POST['Telefono'] . '</p>
                    <p align="center" style="margin-bottom:10px;"><strong>Correo Empresarial: </strong>' . $_POST['CorreoEmpresarial'] . '</p>
                    <p align="center" style="margin-bottom:10px;"><strong>Correo Personal: </strong>' . $_POST['CorrePersonal'] . '</p>
                    <p align="center" style="margin-bottom:10px;"><strong>WhatsApp personal : </strong>' . $_POST['Whatsapp'] . '</p>

                   

                      <p><br></p>
                      <p align="center">Este es un correo electrónico generado automáticamente</p>
                    </td>
                    </tr>

                  <!-- END MAIN CONTENT AREA -->
                  </table>
                  <!-- END CENTERED WHITE CONTAINER -->

                  <!-- START FOOTER -->
                  <div class="footer">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td class="content-block">
                          <span class="apple-link">Grupo Splittel</span>
                          <br> Parque Tecnológico Innovación Querétaro Lateral de la carretera Estatal 431, km.2+200, Int.28, 76246 Santiago de Querétaro, Qro.<a href="http://splittel.com">Grupo Splittel</a>.
                        </td>
                      </tr>
                      <tr>
                        <td class="content-block powered-by">
                          </a>
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!-- END FOOTER -->

                </div>
              </td>
              <td>&nbsp;</td>
            </tr>
          </table>
        </body>
      </html>');
          $host =           'mail.fibremex.com';
          $puerto =    '587';
          $email =  'notificaciones@fibremex.com';
          $password =   'D6.aWs!F@xwD';

          //Este bloque es importante
          $mail = new PHPMailer();
          $mail->IsSMTP();
          //$mail->SMTPDebug = 3; 
          $mail->SMTPAutoTLS = false;
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = false;
          $mail->Host = $host;
          $mail->Port = $puerto;
          $mail->CharSet = 'UTF-8';
          //Nuestra cuenta
          $mail->Username = $email;
          $mail->Password = $password; //Su password 

          $asunto    = 'CURSOS PAGADOS';
          $mail->Subject = $asunto;
          $mail->Body = $mensaje;
          //Mails
          $mail->From = 'notificaciones@fibremex.com';

          $mail->AddCC('marketing.directo@splittel.com'); // FROM 
          $eje = $_POST['CorreEjecutivo'];
          $mail->AddAddress("$eje");
          $mail->AddBCC('aaron.cuevas@fibremex.com.mx');
           $mail->AddBCC('ramon.olea@splittel.com'); //BCC COPIA OCULTA
         
      
          $mail->MsgHTML($mensaje);

          //Avisar si fue enviado o no y dirigir al index

          $mail->send();
        }

        return $ResultSolicitud;
      }
    } catch (Exception $e) {
      throw $e;
    }
  }
}
