<!-- Site Footer-->
<footer class="site-footer" style="background-image: url(../../public/images/img/footer-bg.png);">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <!-- Categories-->
        <section class="widget widget-links widget-light-skin">
          <h3 class="widget-title">Categorías</h3>
          <div class="row">
          <?php 
            $CategoriaController = new CategoriaController();
            $CategoriaController->filter = "";
            $CategoriaController->order = "";
            $response = $CategoriaController->get();

              foreach ($response->records as $CategoriaCont => $Categoria):
                if ($CategoriaCont == 0 || ($CategoriaCont % 4) == 0 ): ?>
            <div class="col-md-6">
               <ul>
                <?php endif ?>
                <li>
                  <a href="../Productos/categorias.php?id_ct=<?php echo $Categoria->CodigoKey;?>"><?php echo $Categoria->Descripcion?></a>
                </li>
                <?php if ($CategoriaCont == 3 || $response->count-1 == $CategoriaCont ): ?>
               </ul>
            </div>
            <?php endif ?>
          <?php endforeach ?>     
          </div>
        </section>
      </div>
      <div class="col-lg-3 col-md-6">
        <!-- About Us-->
        <section class="widget widget-links widget-light-skin">
          <h3 class="widget-title">Atención al Cliente</h3>
          <ul>
            <li><a href="../AtencionCliente/servicio_cliente.php">Servicio al Cliente</a></li>
            <li><a href="../Contacto/">Contacto</a></li>
            <li><a href="../AtencionCliente/faqs.php?idc=1">Preguntas Frecuentes</a></li>
            <li><a href="../AtencionCliente/politicas_privacidad.php">Políticas de Privacidad</a></li>
          </ul>
        </section>
      </div>
      <div class="col-lg-3 col-md-6">
        <!-- Account / Shipping Info-->
        <section class="widget widget-links widget-light-skin">
          <?php 
            $ContactoController = new ContactoController();
            $Contacto = $ContactoController->GetBy();
          ?>
          <h3 class="widget-title">Ubicación</h3>
          <ul>
            <li><a href="../Contacto/"><?php echo $Contacto->GetUbicacion(); ?></a></li>
          </ul>
        </section>
      </div>
    </div>
    <hr class="hr-light mt-2 margin-bottom-2x hidden-md-down">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <!-- Contact Info-->
        <section class="widget widget-light-skin">
          <h3 class="widget-title">Contáctanos</h3>
          <p class="text-white">
            Llámanos:
            <a class="navi-link-light" href="tel:<?php echo $Contacto->GetTelefono(); ?>"><?php echo $Contacto->GetTelefono(); ?></a>
          </p> 
          <ul class="list-unstyled text-sm text-white">
            <li><?php echo $Contacto->GetHorario(); ?></li>
          </ul>
          <p><a class="navi-link-light" href="mailto:<?php echo $Contacto->GetEmail(); ?>"><?php echo $Contacto->GetEmail(); ?></a></p>
          </section>
      </div>
      <div class="col-lg-3 col-md-6">
        <!-- Mobile App Buttons-->
        <section class="widget widget-light-skin">
          <h3 class="widget-title">Redes Sociales</h3>
          <a class="social-button shape-circle sb-facebook sb-light-skin" href="https://www.facebook.com/Fibremex" target="_blank"><i class="socicon-facebook"></i></a>
          <a class="social-button shape-circle sb-twitter sb-light-skin" href="https://twitter.com/Fibremexx" target="_blank"><i class="socicon-twitter"></i></a>
          <a class="social-button shape-circle sb-instagram sb-light-skin" href="https://www.instagram.com/fibremex/" target="_blank"><i class="socicon-instagram"></i></a>
          <a class="social-button shape-circle sb-google-plus sb-light-skin" href="https://mx.linkedin.com/company/fibremex-s-a-de-c-v-" target="_blank"><i class="socicon-linkedin"></i></a>
          <a class="social-button shape-circle sb-google-plus sb-light-skin" href="https://www.youtube.com/channel/UCb-quhJT0AqywnRBw1n4jiA" target="_blank"><i class="socicon-youtube"></i></a>
        </section>
      </div>
      <div class="col-lg-6">
        <!-- Subscription-->
        <section class="widget widget-light-skin">
          <h3 class="widget-title">Registrate a nuestro boletín</h3>
          <form class="row" id="form-boletin">
            <div class="col-sm-9">
                <input class="form-control" type="hidden" name="Action" id="Action" value="RegistroBoletin">
                <input class="form-control" type="hidden" name="ActionCursos" id="ActionCursos" value="true">
                <input class="form-control" type="hidden" name="Descripcion" id="Descripcion" value="boletin">
              <div class="input-group input-light">
                <input class="form-control boletin" type="email" name="Correo" id="Correo" placeholder="Correo">
                <span class="input-group-addon"><i class="icon-mail"></i></span>
              </div>
              <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
              <div style="position: absolute; left: -5000px;" aria-hidden="true">
                <input type="text" name="b_c7103e2c981361a6639545bd5_1194bb7544" tabindex="-1">
              </div>
              <p class="form-text text-sm text-white opacity-50 pt-2">&nbsp;</p>
            </div>
            <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
            <div class="col-sm-3">
              <button type="button" class="btn btn-primary btn-block mt-0" 
              onclick="EmailBoletin(this)"
              >Subscribirse</button>
            </div>
          </form>
          <div class="pt-3"><img class="d-block" style="width: 195px;" alt="Cerdit Cards" src="../../public/images/OpenPay/cards1.png"></div>
        </section>
      </div>
    </div>
    <!-- Copyright-->
    <p class="footer-copyright">© Todos los derechos reservados. Hecho por Grupo Splittel</p>
   <!-- <p class="footer-copyright">© All rights reserved. Made with &nbsp;<i class="icon-heart text-danger"></i>&nbsp; by Grupo Splittel</p> -->
  </div>
</footer>
 <!-- Photoswipe container-->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="pswp__bg"></div>
  <div class="pswp__scroll-wrap">
    <div class="pswp__container">
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
    </div>
    <div class="pswp__ui pswp__ui--hidden">
      <div class="pswp__top-bar">
        <div class="pswp__counter"></div>
        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
        <button class="pswp__button pswp__button--share" title="Share"></button>
        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
        <div class="pswp__preloader">
          <div class="pswp__preloader__icn">
            <div class="pswp__preloader__cut">
              <div class="pswp__preloader__donut"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
        <div class="pswp__share-tooltip"></div>
      </div>
      <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
      <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
      <div class="pswp__caption">
        <div class="pswp__caption__center"></div>
      </div>
    </div>
  </div>
</div>
<!-- Back To Top Button-->
<a class="scroll-to-top-btn" href="#"><i class="icon-chevron-up"></i></a>
<!-- Backdrop-->
<div class="site-backdrop"></div>

<!-- Liberación memoria objetos -->
<?php 
  unset($Categoria);
  unset($response);
  unset($Contacto);
 ?>
