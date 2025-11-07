<div class="row">
  <div class="col-lg-12 col-md-8 order-md-2">
    <hr class="margin-bottom-1x">
    <ul class="nav nav-tabs justify-content-center" role="tablist">
      <li class="nav-item"><a class="nav-link active" href="#inf1" data-toggle="tab" role="tab">Descripción</a></li>
      <li class="nav-item"><a class="nav-link" href="#inf2" data-toggle="tab" role="tab">Información adicional</a></li>
      <li class="nav-item"><a class="nav-link" href="#inf3" data-toggle="tab" role="tab">Relacionados</a></li>
      <li class="nav-item"><a class="nav-link" href="#inf4" data-toggle="tab" role="tab">Comentarios</a></li>
      <?php
        $fichero_360 = "../../public/images/img_spl/productos/".$Obj->ProductoCodigo."/360/".$Obj->ProductoCodigo.".html";
        if (file_exists($fichero_360)) {
      ?>
      <li class="nav-item"><a class="nav-link" href="#inf5" data-toggle="tab" role="tab">360</a></li>
      <?php } ?>
    </ul>
    <div class="tab-content">
      <!-- Descripción -->
      <div class="tab-pane fade show active" id="inf1" role="tabpanel">
        <div class="gallery-wrapper isotope-grid cols-12 grid-no-gap" data-pswp-uid="2" style="position: relative; height: 376.666px;">
          <div class="gutter-sizer"></div>
          <div class="grid-sizer"></div>
          <?php
            $dirname = "../../public/images/img_spl/productos/".$Obj->ProductoCodigo."/descripcion/";
            $images = glob($dirname."*.jpg");
            foreach($images as $image) {
          ?>
          <div class="grid-item gallery-item" style="position: absolute; left: 0px; top: 0px;">
            <a href="<?php echo $image ?>" data-size="1000x667">
              <img src="<?php echo $image ?>" alt="Image">
            </a>        
          </div>
          <?php } ?>
        </div>
      </div>
      <!-- Información adicional -->
      <div class="tab-pane fade" id="inf2" role="tabpanel">       					
        <div class="gallery-wrapper" data-pswp-uid="2">
          <?php
            $dirname = "../../public/images/img_spl/productos/".$Obj->ProductoCodigo."/adicional/";
            $images = glob($dirname."*.jpg");
            foreach($images as $image) {
          ?>
          <div class="gallery-item">
            <a href="<?php echo $image ?>" data-size="1000x617">
              <img src="<?php echo $image ?>" alt="--">
            </a>
          </div>
          <?php } ?>  
        </div>
      </div>
      <!-- Relacionados -->
      <div class="tab-pane fade" id="inf3" role="tabpanel">
        <div class="table-responsive">
          <table class="table">
            <thead class="thead-default">
              <tr>
                <th class="text-center" style="width: 10%;">Imagen</th>
                <th class="text-center" style="width: 10%;">Clave</th>
                <th class="text-center" style="width: 50%;">Descripción</th>
              <?php if(isset($_SESSION['Ecommerce-ClienteNombre'])){?>
                <th class="text-center" style="width: 10%;">Precio</th>
                <th class="text-center" style="width: 10%;">Stock</th>
              <?php }?>
                <th class="text-center" style="width: 10%;">Agregar</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              if (!class_exists("RelacionadosController")) {
                include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Relacionados.Controller.php';
              }
              $RelacionadosController = new RelacionadosController();
              $RelacionadosController->filter = "WHERE tipo='fijo' AND id_codigo = '".$Obj->ProductoRelacionados."' ";
              $RelacionadosController->order = "";
              $ResultProductosRelacionados = $RelacionadosController->GetFijos();
              if($ResultProductosRelacionados->count > 0){
                foreach ($ResultProductosRelacionados->records as $key => $ProductoRelacionado) {
                  $ProductoController->filter = "WHERE codigo = '".$ProductoRelacionado->Codigo."' AND activo = 'si' ";
                  $Obj_ = $ProductoController->GetBy();
                  $imgUrl = file_exists("../../public/images/img_spl/productos/".$Obj_->Codigo."/thumbnail/".$Obj_->ImgPrincipal."") 
                            ? "../../public/images/img_spl/productos/".$Obj_->Codigo."/thumbnail/".$Obj_->ImgPrincipal."" 
                            : $_SESSION['Ecommerce-ImgNotFound1'];

            ?>
            <tr>
              <td scope="row" class="text-center align-middle">
                <a href="fijos.php?id_prd=<?php echo $Obj_->Codigo?>"><img  src="<?php echo $imgUrl; ?>" /></a>
              </td>
              <td class="text-center align-middle"><span class="styleClave"><?php echo $Obj_->Codigo; ?></span></td>
              <td class="text-center align-middle"><?php echo $Obj_->Descripcion; ?></td>
              <?php if(isset($_SESSION['Ecommerce-ClienteNombre'])){
                 if($_SESSION['CurrencySite']=='USD'){
                ?>
              <td class="text-center align-middle">$<?php echo bcdiv($Obj_->Precio-($Obj_->Precio*($Obj_->Descuento/100)),1,3); ?> USD</td>
              <?php 
                 }else{
                    $PL1=bcdiv($Obj_->Precio-($Obj_->Precio*($Obj_->Descuento/100)),1,3);
                  ?>
                   <td class="text-center align-middle">$<?php echo number_format(bcdiv(($PL1*$_SESSION['Ecommerce-WS-CurrencyRate']),1,3),3); ?> MXN</td>
                <?php
                }
                 ?>
                 <td class="text-center align-middle"><?php echo $Obj_->Existencia; ?></td>
              <?php
              }
              ?>
              <td class="text-center align-middle">
                <input type="hidden" name="ProductoCantidad-<?php echo $Obj_->Codigo;?>" id="ProductoCantidad-<?php echo $Obj_->Codigo;?>" value="1">
             
             
                <?php if(isset($_SESSION['Ecommerce-ClienteKey'])){ ?>
                     <button style="background-color: #bc2130;" class="btn btn-primary btn-block m-0" descuento="<?php echo $Obj_->Descuento ?>" codigo="<?php echo $Obj_->Codigo;?>" onclick="add(this)">
                  <i class="icon-shopping-cart"></i> 
                </button>                <?php }else{ ?>
                <a class="product-button" href="../Login/" >      <button style="background-color: #bc2130;" class="btn btn-primary btn-block m-0" descuento="<?php echo $Obj_->Descuento ?>" codigo="<?php echo $Obj_->Codigo;?>" >
                  <i class="icon-shopping-cart"></i> 
                </button> </a>
                <?php } ?>
             
             
              </td>
            </tr>
            <?php 
                }
              } 
            ?>
             <?php 
              if (!class_exists("RelacionadosController")) {
                include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Relacionados.Controller.php';
              }
              $RelacionadosController = new RelacionadosController();
              $RelacionadosController->filter = "WHERE tipo='conf' AND id_codigo = '".$Obj->ProductoRelacionados."' ";
              $RelacionadosController->order = "";
              $ResultProductosRelacionados = $RelacionadosController->GetFijos();
              
              if($ResultProductosRelacionados->count > 0){
                foreach ($ResultProductosRelacionados->records as $key => $ProductoRelacionado) {
                   $SubcategoriasN1Controller = new SubcategoriasN1Controller();
                    $SubcategoriasN1Controller->filter = "WHERE codigo = '".$ProductoRelacionado->Codigo."' AND activo='si' ";
                    $ResultSubcategoriasN1Controller = $SubcategoriasN1Controller->get();

                    if($ResultSubcategoriasN1Controller->count > 0){
                    foreach ($ResultSubcategoriasN1Controller->records as $key => $subcategoria) {
                      $ConfiguracionPath = $subcategoria->Configuracion == 1 
                      ? "../Productos/configurables.php?codigo=".$subcategoria->Configuracion." " : "#";

                      $imgUrl = file_exists(("../../public/images/img_spl/subsubcategorias/".$subcategoria->Descripcion.".jpg")) 
                      ? "../../public/images/img_spl/subsubcategorias/".$subcategoria->Descripcion.".jpg" 
                      : "../../public/images/img_spl/notfound1.png"; 

            ?>
            <tr>
              <td scope="row" class="text-center align-middle">
                <a href="configurables.php?codigo=<?php echo $subcategoria->Codigo?>"><img  src="<?php echo $imgUrl; ?>" /></a>
              </td>
              <td class="text-center align-middle"><span class="styleClave"><?php ?></span></td>
              <td class="text-center align-middle"><?php echo $subcategoria->Descripcion; ?></td>
              <?php if(isset($_SESSION['Ecommerce-ClienteNombre'])){
                ?>
                 <td class="text-center align-middle"></td>
                 <td class="text-center align-middle"></td>
              <?php
              }
              ?>
              <td class="text-center align-middle">
        
             
                <?php if(isset($_SESSION['Ecommerce-ClienteKey'])){ ?>
                     <button style="background-color: #bc2130;" class="btn btn-primary btn-block m-0" onclick="window.location.href='configurables.php?codigo=<?php echo $subcategoria->Codigo?>'">
                  Configúralo
                </button>                <?php }else{ ?>
                <a class="product-button" href="../Login/" >      <button style="background-color: #bc2130;" class="btn btn-primary btn-block m-0" descuento="<?php echo $Obj_->Descuento ?>" codigo="<?php echo $Obj_->Codigo;?>" >
                  <i class="icon-shopping-cart"></i> 
                </button> </a>
                <?php } ?>
             
             
              </td>
            </tr>
            <?php 
                    }
                  }
                }
              } 
            ?>
            </tbody>
          </table>
        </div>  
      </div>
      <!-- Comentarios -->
      <div class="tab-pane fade" id="inf4" role="tabpanel">
        <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Productos/Informacion/Comentarios/index.php'; ?>
      </div>
      <?php
        $fichero_360 = "../../public/images/img_spl/productos/".$Obj->ProductoCodigo."/360/".$Obj->ProductoCodigo.".html";
        if (file_exists($fichero_360)) {
        ?>
      <div class="tab-pane fade show " id="inf5" role="tabpanel">
        <iframe height="500px" src="<?php echo $fichero_360;?>"></iframe>              
      </div>
      <?php
      }
      ?>
    </div>
  </div>
</div>
