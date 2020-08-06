<style>
  .video-btn>a {
    background-image: url("../../public/images/btn.jpg");
    background-size: 50px 50px;
  }
  #new-btn-video::after{
    background-color: transparent;
    box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
    background-image: url("");
  }
  #new-btn-video::before{
    background-color: transparent;
    box-shadow: 0px 0px 0px 0px rgba(0,0,0,0.75);
    background-image: url("");
  }
</style>
<div class="row">
  <div class="col-md-3 align-center">
    <div class="rating-stars">
      <i class="icon-star"></i>
      <i class="icon-star"></i>
      <i class="icon-star"></i>
      <i class="icon-star"></i>
      <i class="icon-star"></i>
    </div> 
  </div>
  <div class="col-md-3 d-flex justify-content-end">
    <div class="mt-2 mb-2"><span class="text-muted">Compartir:&nbsp;&nbsp;</span>
      <div class="d-inline-block">
        <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="socicon-facebook"></i></a>
        <a onclick="window.open(this.href, this.target, ' width=600, height=600, menubar=no');return false;" class="social-button shape-rounded sb-twitter" href="https://twitter.com/share?ref_src=<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];?>"><i class="socicon-twitter"></i></a>
      </div>
    </div>
  </div> 
</div> 

<div class="row">
  <!-- Poduct Gallery-->
  <div class="col-md-6">
    <div class="product-gallery">
      <div class="gallery-wrapper">
        <div class="gallery-item video-btn text-center">
        <?php
          $fichero = "../../public/images/img_spl/productos/".$Obj->ProductoCodigoWhitOutSlash."/video/video.txt";
          if (file_exists($fichero)) {
            $ruta = file_get_contents($fichero, FILE_USE_INCLUDE_PATH);
        ?>
          <a href="#" data-toggle="modal" data-target="#modal-360"></a>
        <?php
          }
          ?>
        </div>
      </div>

      <div class="product-carousel owl-carousel gallery-wrapper">
      <?php
        $dirname = "../../public/images/img_spl/productos/".$Obj->ProductoCodigoWhitOutSlash."/";
        $images = glob($dirname."*.jpg");
        foreach($images as $key => $image) {
      ?>
        <div class="gallery-item" data-hash="<?php echo $key;?>">
        <a href="<?php echo $image ?>" data-size="1000x667">
        <img src="<?php echo $image ?>" alt="Product"></a></div>
      <?php
        }
      ?> 
      </div>
      <ul class="product-thumbnails">
      <?php
        foreach($images as $key => $image) {
      ?>
        <li <?php if($key==0){?> class="active" <?php }?> >
        <a href="#<?php echo $key;?>"><img src="<?php echo $image ?>" alt="Product"></a>
        </li>
      <?php
        }
      ?>
      </ul>
    </div>
  </div>
  <!-- Product Info-->
  <div class="col-md-6">
    <div class="padding-top-2x mt-2 hidden-md-up"></div>
    <h2 class="mb-3"><?php echo $Obj->ProductoDescripcion;?></h2>
    <span class="h3 d-block"><img src="../../public/images/img_spl/marcas/<?php echo $Obj->MarcaDesripcion;?>.jpg" width="30%" height="30%"/></span>
    <?php if($Obj->Descuento > 0){ ?>
    <span class="h4 d-block">
      Precio:
      <b class="text-primary">
        $<?php echo bcdiv($Obj->ProductoPrecio-($Obj->ProductoPrecio*($Obj->Descuento/100)),1,3); ?> USD 
      </b>
      <br>
      <del class="text-muted">$<?php echo $Obj->ProductoPrecio ?></del>&nbsp;
    </span>
    <?php }else{ ?>
      <span class="h4 d-block">
        $<?php echo $Obj->ProductoPrecio; ?> USD 
      </span>
    <?php } ?>  
    
    <div class="row">
      <div class="col-md-3">
        <div class="pt-1 mb-4"><span class=" product-badge bg-secondary border-default text-body">Stock: <?php echo $Obj->ProductoExistencia;?></span></div>
      </div>
      <div class="col-md-5">
        <div class="pt-1 mb-4"><span class="text-medium">CLAVE:</span> <span class="styleClave"><?php echo $Obj->ProductoCodigo;?></span></div>
      </div>
      <div class="col-md-4">
        <span onclick="showFormCreate()"><div class="rating-stars"><i class="icon-star filled"></i></div> <span class="text-info"> Calificar este producto</span> </span>
      </div>
    </div>

    <br/> <p class="text-muted text-justify"><?php echo $Obj->DescripcionLarga;?></p>
    
    <div class="row align-items-end pb-4">
      <div class="col-sm-4">
        <div class="form-group mb-0">
          <input type="text" class="form-control myclass" name="ProductoCantidad-<?php echo $Obj->ProductoCodigo;?>" id="ProductoCantidad-<?php echo $Obj->ProductoCodigo;?>" onkeyup="validacionCantidad(this)" placeholder="Cantidad" value="1">
        </div>
      </div>
      <div class="col-sm-4">
        <div class="pt-4 hidden-sm-up"></div>
        <button style="background-color: #bc2130" class="btn btn-primary btn-block m-0" descuento="<?php echo $Obj->Descuento ?>" codigo="<?php echo $Obj->ProductoCodigo;?>" onclick="AgregarArticulo(this)">
        <i class="icon-bag"></i> Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>

<div class="d-flex flex-wrap justify-content-between">
      <div class="mt-2 mb-2">
      <?php
        if(!empty($Obj->FichaRuta)){
          $FichaTecnica = '../../public/images/img_spl/'.$Obj->FichaRuta.'.pdf';
          if(file_exists($FichaTecnica) ) {
            
      ?>
        <button class="btn btn-outline-secondary btn-sm "> 
          <a href="<?php echo $FichaTecnica;?>" target="_blank">
            <i class="icon-download"></i>&nbsp;Ficha Técnica
          </a>
        </button> 
            
      <?php
          }
        }

        $dirname_min = "../../public/images/img_spl/productos/".$Obj->ProductoCodigo."/Mini Catalogo/";
        $images_min = glob($dirname_min."*.pdf");
        $total_minic=count($images_min);
        if($total_minic>0){
          foreach($images_min as $minic) {
      ?>
        <button class="btn btn-outline-secondary btn-sm ">
          <a href="<?php echo $minic;?>" target="_blank">
            <i class="icon-download"></i>&nbsp;Mini Catálogo
          </a>
        </button>
      <?php 
          }
        }

        $dirname_man = "../../public/images/img_spl/productos/".$Obj->ProductoCodigo."/manual/";
        $images_man = glob($dirname_man."*.pdf");
        $total_man=count($images_man);
        if($total_man>0){
          foreach($images_man as $man) {
      ?>
        <button class="btn btn-outline-secondary btn-sm ">
          <a href="<?php echo $man;?>" target="_blank">
            <i class="icon-download"></i>&nbsp;Manual
          </a>
        </button>
      <?php 
          }
        }          
      ?>   
      <?php
              $fichero = "../../public/images/img_spl/productos/".$Obj->ProductoCodigoWhitOutSlash."/video/video.txt";
              if (file_exists($fichero)) {
                $ruta = file_get_contents($fichero, FILE_USE_INCLUDE_PATH);
              
                   
          ?>  
          <button class="btn btn-outline-secondary btn-sm ">
          <div style="padding-top: 0px; padding-right: 0px; 
          padding-left: 0px; border: 0px; border-radius: 0px;" class="product-gallery" >
              <div class="gallery-wrapper">
              <div  class="gallery-item text-center">
               <a id="new-btn-video" 
               href="#" data-toggle="tooltip" data-type="video" 
               data-video="&lt;div class=&quot;wrapper&quot;&gt;&lt;div class=&quot;video-wrapper&quot;&gt;&lt;iframe class=&quot;pswp__video&quot; width=&quot;960&quot; height=&quot;640&quot; src=&quot;<?php echo $ruta;?>&quot; allow=&quot;autoplay&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;&lt;/div&gt;&lt;/div&gt;" 
               >
                <i class="icon-download"></i>Video
              </a>
              </div>
              </div>
            </div>
            </button>
            <?php } ?>
      </div>
    </div>

  

    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Productos/Informacion/Comentarios/comentarios-modal.php'; ?>