<?php
if (!class_exists("TemplatePrincipal")) {
  include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/views/Templates/Principal.php';
}

class TemplateFicrece
{
  /**
   * Estructura correo Curso
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function body($data)
  {
    try {
      $Principal = new TemplatePrincipal();
      $html = $Principal->Head() . '<body class="">
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
      return $html;
    } catch (Exception $e) {
      throw $e;
    }
  }
}
