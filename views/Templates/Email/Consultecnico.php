<?php
  if (!class_exists("TemplatePrincipal")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Principal.php';
  }

  class TemplateConsultecnico{
    /**
     * Estructura correo Curso
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function body($data){
      try {
        $comment="";
        $Principal = new TemplatePrincipal();
        if(isset($data['Comentario']) && $data['Comentario']!=""){
          $comment='<p align="center" style="margin-bottom:10px;"><strong>Comentario: </strong>'.$data['Comentario'].'</p>';
        }
        $html = $Principal->Head().'<body class="">
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
                              <p align="center" style="margin-bottom:10px;"><strong>Pregunta: </strong>'.$data['Pregunta'].'</p>
                              <p align="center" style="margin-bottom:10px;"><strong>Categoría: </strong>'.$data['Categoria'].'</p>
                              '.$comment.'
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

