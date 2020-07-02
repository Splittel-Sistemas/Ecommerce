<?php 
  @session_start();
  ini_set('default_socket_timeout', 600);
  if(empty($_SERVER['DOCUMENT_ROOT'])){
    $_SERVER['DOCUMENT_ROOT'] = "/home/fibremex/public_html";
  }if (!class_exists("Email")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Email/Email.php';
  }if (!class_exists("EmailTest")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Email/EmailTest.php';
  }  if (!class_exists("Connection")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
  }if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
  }
  /**
   * 
   */
class Correos{

  public $Message;
  public $PedidoKey;
  public $Fecha;

  public function __construct(){
    $this->EmailTest = new EmailTest();
    $this->conn = new Connection();
  }

  public function getLogErroOpenPay(){
    try {
      $items = [];
      if (!$this->conn->conexion()->connect_error) {
        $SQLSTATEMENT = "SELECT * FROM t99_log WHERE t99_f007 = 'OP' ";
        // echo $SQLSTATEMENT;
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        while ($row = $result->fetch_object()) {
          $this->PedidoKey = $row->t99_f003;
          $this->Message = $row->t99_f004;
          $this->Fecha = $row->t99_f099;
          $this->emailErrorOpenPay();
        }
      }
    } catch (Exception $e) {
      throw new Exception("Error: ".$e->getMessage(), 1);
    }
  }

  public function emailErrorOpenPay(){
    $Email = new Email();
    $Email->MailerSubject = "Error Open pay";
    $Email->MailerBody = $this->bodyCorreoErrorsOpenPay();
    $Email->MailerListTo = ['javier.santana@splittel.com'];
    $Email->EmailSendEmail();
  }

  public function bodyCorreoErrorsOpenPay(){
   return $this->EmailTest->head().'<body class="">
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
                              <p align="center">¡Error Open Pay!</p>
                              <p><br></p>
                              <p align="center">Cotización: '.$this->PedidoKey.'</p>
                              <p><br></p>
                              <p align="center">Mensaje: '.$this->Message.'</p>
                              <p><br></p>
                              <p align="center">Fecha ocurrida: '.$this->Fecha.'</p>
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
            </html>';
  }
}

/*  $Correos = new Correos();
  $Correos->getLogErroOpenPay();*/