<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
    @session_start();
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Head.php'; ?>
  </head>
  <!-- Body-->
  <body>
    <?php 
      # Header
      include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Header.php';

      if (!class_exists("CategoriaController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Categorias/Categoria.Controller.php';
      }if (!class_exists("SubcategoriasController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Subcategorias/Subcategorias.Controller.php';
      }if (!class_exists("SubcategoriasN1Controller")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Subcategorias/SubcategoriasN1.Controller.php';
      }if (!class_exists("SubmenuController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Submenu/Submenu.Controller.php';
      }if (!class_exists("UnionSubmenuController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Submenu/UnionSubmenu.Controller.php';
      }if (!class_exists("ProductoController")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Producto.Controller.php';
      }
    ?>
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Nuestros productos</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li>
              <a href="../Home/">Home</a>
            </li>
            <?php 
              $CategoriaKey = "";
              $SubcategoriaKey = "";
              $SubcategoriaN1Key = "";

              if (isset($_GET['id_ct'])){
                $CategoriaKey = $_GET['id_ct'];
                
                $CategoriaController = new CategoriaController();
                $CategoriaController->filter = "WHERE id_codigo = '".$CategoriaKey."' AND activo='si' ";
                $CategoriaController->order = "";
                $Categoria = $CategoriaController->getBy();
            ?>
            <li class="separator">&nbsp;</li>
            <li><?php echo $Categoria->GetDescripcion();?></li>
            <?php 
              } 

              if(isset($_GET['id_sbct']) || isset($_GET['prd'])){ 
                if(isset($_GET['id_sbct'])){
                  $SubcategoriaKey = $_GET['id_sbct'];
                }elseif(isset($_GET['prd'])){
                  $SubcategoriaKey = $_GET['prd'];
                }
                if(isset($_GET['id_gpo'])){
                  $GpoKey = $_GET['id_gpo'];
                }


                $SubmenuController = new SubmenuController();
                $SubmenuController->filter = "WHERE id = '".$SubcategoriaKey."' AND nivel=2 AND activo='si' ";
                $SubmenuController->order = "";
                $Subcategoria = $SubmenuController->getBy();

                if(!isset($_GET['id_gpo'])){
                  $SubmenuController->filter = "WHERE id = '".$SubcategoriaKey."' AND activo='si' ";
                  $SubmenuController->order = "";
                  $Subcategoria1 = $SubmenuController->getBy();
                }else{
                  $SubmenuController->filter = "WHERE id = '".$GpoKey."' AND activo='si' ";
                  $SubmenuController->order = "";
                  $Subcategoria1 = $SubmenuController->getBy();
                }
               
                $CategoriaController = new CategoriaController();
                $CategoriaController->filter = "WHERE id_codigo = '".$Subcategoria->GetFamiliaKey()."' AND activo='si'";
                $CategoriaController->order = "";
                $Categoria_ = $CategoriaController->getBy();
            ?>
            <li class="separator">&nbsp;</li>
            <li><a href="../Productos/categorias.php?id_ct=<?php echo $Subcategoria->GetFamiliaKey(); ?>&nom=<?php echo url_amigable($Subcategoria->GetDescripcion());?>"><?php echo $Categoria_->GetDescripcion();?></a></li>
            <li class="separator">&nbsp;</li>
            <li><?php echo $Subcategoria1->GetDescripcion();?></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1">
      <div class="row">
        <div class="col-lg-12 order-lg-2">
        </div>
      </div>
      <div class="row">
        <!-- Products-->
        <div class="col-lg-9 order-lg-2">
          <?php if (isset($_GET['id_ct'])){ ?>
          <div class="row">
            <div class="alert alert-default alert-dismissible fade show margin-bottom-1x">
              <h1 class="post-title"><?php echo $Categoria->GetDescripcionLarga();?></h1>
            </div>
          </div>
          <?php } ?>
          <?php   if (isset($_GET['id_sbct'])){ ?>
           <!-- Promo banner-->
           <?php if(file_exists("../../public/images/img_spl/BannerSubcategoria/banner_".$_GET['id_sbct'].".jpg")){?>
           <div class="row">
          <a class="alert alert-default alert-dismissible fade show fw-section mb-30" href="javascript:void(0);">
        <!--  <span class="alert-close" data-dismiss="alert"></span> -->
           <div class="d-flex flex-wrap flex-md-nowrap justify-content-between align-items-center">
              <img class="d-block mx-auto mx-md-0" src="../../public/images/img_spl/BannerSubcategoria/banner_<?php echo $_GET['id_sbct'];?>.jpg" alt="">
            </div>
            </a>
          </div>
           <?php }
           //print_r($Subcategoria);
           ?>
          <div class="row">
            <a href="javascript:void(0);" class="alert alert-default alert-dismissible fade  show fw-section mb-30 margin-bottom-1x">
              <h1 class="post-title"><?php echo $Subcategoria1->GetDescripcionLarga();?></h1>
            </a>
          </div>
          <?php } ?>
          <!-- Products Grid-->
          <div class="row">
          <?php  
          if(isset($_GET['id_ct'])){
            $CategoriaKey = $_GET['id_ct']; 
            $SubmenuController = new SubmenuController();
                     $SubmenuController->filter = "WHERE id_categoria = '".$CategoriaKey."' AND nivel=2 AND activo='si' ";
                     $SubmenuController->order = "";
                     $ResultSubcategoria = $SubmenuController->get();
                     //print_r($ResultSubcategoria);
            if ($ResultSubcategoria->count > 0){ 
            foreach ($ResultSubcategoria->records as $key => $Subcategoria_){ 
              ?>
            <div class="col-md-4 col-sm-6 col-12">
              <div class="product-card mb-30">
                <a class="product-thumb"  href="categorias.php?id_sbct=<?php echo $Subcategoria_->Key;?>&nom=<?php echo url_amigable($Subcategoria_->Descripcion);?>" >
                 <?php 
                  $imgUrl = file_exists("../../public/images/img_spl/subcategorias/".$Subcategoria_->Imagen) 
                  ? "../../public/images/img_spl/subcategorias/".$Subcategoria_->Imagen 
                  : "../../public/images/img_spl/notfound.png"; 
                ?>
                 <img src="<?php echo $imgUrl; ?>" alt="<?php echo $Subcategoria_->Descripcion;?>"></a>
                <div class="product-card-body">                 
                  <h1 class="product-title"><a href="categorias.php?id_sbct=<?php echo $Subcategoria_->Key;?>&nom=<?php echo url_amigable($Subcategoria_->Descripcion);?>"><?php echo $Subcategoria_->Descripcion;?></a></h1>
                </div>
              </div>
            </div>
          <?php 
              }
            } 
          } 

          if(isset($_GET['id_sbct']) || isset($_GET['id_gpo']) ){
            

            $UnionSubmenuController = new UnionSubmenuController();
            $UnionSubmenuController->filter = "WHERE id_menu = '".$SubcategoriaKey."'";
            $UnionSubmenuController->order = "";
            $ResultUnionSubmenu = $UnionSubmenuController->get();
            
            if($ResultUnionSubmenu->count > 0 ){
              foreach ($ResultUnionSubmenu->records as $key => $Subcategorias_){

              $SubcategoriasN1Controller = new SubcategoriasN1Controller();
              if(isset($_GET['id_gpo'])){
                $SubcategoriaKeyGPO=$_GET['id_gpo'];
                $SubcategoriasN1Controller->filter = "WHERE id_subcategoria = '".$Subcategorias_->SubcategoriaKey."' AND activo='si' AND (grupo='".$SubcategoriaKeyGPO."') ";
              }else{
                $SubcategoriaKeyGPO='';
                $SubcategoriasN1Controller->filter = "WHERE id_subcategoria = '".$Subcategorias_->SubcategoriaKey."' AND activo='si' ";
              }
              
              $SubcategoriasN1Controller->order = "";
              
              $ResultSubcategoriasN1 = $SubcategoriasN1Controller->get();
              
              if($ResultSubcategoriasN1->count > 0 ){
                $SubcategoriaN1Key = $ResultSubcategoriasN1->records[0]->CategoriasKey;
                
                foreach ($ResultSubcategoriasN1->records as $key => $SubcategoriaN1){ 
                  $ConfiguracionPath = $SubcategoriaN1->Configuracion == 1 
                  ? "../Productos/configurables.php?codigo=".$SubcategoriaN1->Codigo."" : "#";

                  $imgUrl = file_exists(("../../public/images/img_spl/subsubcategorias/".$SubcategoriaN1->FolderName.".jpg")) 
                  ? "../../public/images/img_spl/subsubcategorias/".$SubcategoriaN1->FolderName.".jpg" 
                  : "../../public/images/img_spl/notfound1.png"; 
              ?>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="product-card mb-30">
                    <?php if ($SubcategoriaN1->Configuracion == 0){ ?>
                    <div class="product-badge bg-primary">Próximamente</div>
                    <?php } ?>
                    <a class="product-thumb" href="<?php echo $ConfiguracionPath ?>&nom=<?php echo url_amigable($SubcategoriaN1->Descripcion);?>">
                    <img src="<?php echo $imgUrl ?>" alt="<?php echo $SubcategoriaN1->Descripcion;?>"></a>
                    <div class="product-card-body">
                      <h1 class="product-title"><a href="<?php echo $ConfiguracionPath ?>&nom=<?php echo url_amigable($SubcategoriaN1->Descripcion);?>"><?php echo $SubcategoriaN1->Descripcion;?></a></h1>
                    </div>
                  </div>
                </div>
              <?php 
                  } 
                } 
              }
             }
            } 
            
            if (isset($_GET['id_sbct']) || isset($_GET['id_gpo'])){ 
              if(isset($_GET['id_gpo'])){
                $SubcategoriaKeyGPO=$_GET['id_gpo'];
              }else{
                $SubcategoriaKeyGPO='';
              }
              $UnionSubmenuController = new UnionSubmenuController();
              $UnionSubmenuController->filter = "WHERE id_menu = '".$SubcategoriaKey."' ";
              $UnionSubmenuController->order = "";
              $ResultUnionSubmenu = $UnionSubmenuController->get();
             
              if($ResultUnionSubmenu->count > 0 ){
                foreach ($ResultUnionSubmenu->records as $key => $Subcategorias_){

              $ProductoController = new ProductoController();
            
              if(isset($_GET['id_gpo'])){
                $SubcategoriaKeyGPO=$_GET['id_gpo'];
                $ProductoController->filter = "WHERE subcategoria='".$Subcategorias_->SubcategoriaKey."' AND producto_activo='si' AND (codigo_configurable='' OR configurablefijo='si' ) AND (grupo='".$SubcategoriaKeyGPO."' )";
              }else{
                $SubcategoriaKeyGPO='';
                $ProductoController->filter = "WHERE subcategoria='".$Subcategorias_->SubcategoriaKey."' AND producto_activo='si' AND (codigo_configurable='' OR configurablefijo='si' )";
              }
              
              $ProductoController->order = " ORDER BY leyenda DESC, desc_producto DESC ";
              $getProduct = $ProductoController->GetProductosFijos_();
              

              if ($getProduct->count > 0){ 
                $CategoriaKey = $getProduct->records[0]->ProductoCategoriaKey;

                $columnas = "col-lg-3 col-md-4 col-sm-6 col-12";
                include '../product/fixed/fixed.php';
                unset($getProduct);
              } 
            }
           }
          } 
          ?>
          </div>
        </div>
        <!-- Sidebar          -->
        <div class="col-lg-3 order-lg-1">
          <div class="sidebar-toggle position-left"><i class="icon-filter"></i></div>
          <aside class="sidebar sidebar-offcanvas position-left"><span class="sidebar-close"><i class="icon-x"></i></span>
            <!-- Widget Categories-->
            <section class="widget widget-categories">
              <h3 class="widget-title">Categorías</h3>              
              <ul>
              <?php 
                $CategoriaController->filter = "WHERE activo='si'";
                $CategoriaController->order = "";
                $ResultCategoria = $CategoriaController->get();
               
                foreach ($ResultCategoria ->records as $key => $Categoria){ 

                  if(isset($_GET['id_sbct'])){
                    $SubmenuController_ = new SubmenuController();
                    $SubmenuController_->filter = "WHERE id= '".$SubcategoriaKey."' AND nivel=2 AND activo='si' ";
                     $SubmenuController_->order = "";
                    $ResultSubcategoria_ = $SubmenuController_->get();
                    //print_r($ResultSubcategoria_);
                    if($ResultSubcategoria_->count > 0){
                      $RecordsSubcategoria_ = $ResultSubcategoria_->records[0];
                      $SubcategoriaN1Key_ = $RecordsSubcategoria_->FamiliaKey;
                     
                    }?>
                     <li class="has-children <?php if($Categoria->CodigoKey  == $SubcategoriaN1Key_){?>expanded<?php }?>">
                 <?php }else{  ?>
                     <li class="has-children <?php if($CategoriaKey  == $Categoria->CodigoKey){?>expanded<?php }?>">
                 <?php }
              ?>
                 <a <?php if($Categoria->CodigoKey=='A8'){?> href="categorias.php?id_ct=<?php echo $Categoria->CodigoKey?>" <?php  }else{?> href="#" <?php }?>><?php echo $Categoria->Descripcion;?></a><span></span>
                  <ul>
                  <?php 
                 
                     $SubmenuController = new SubmenuController();
                     $SubmenuController->filter = "WHERE id_categoria = '".$Categoria->CodigoKey."' AND nivel=2 AND activo='si' ";
                     $SubmenuController->order = "";
                     $ResultSubcategoria = $SubmenuController->get();
                     if ($ResultSubcategoria->count > 0){
                      foreach ($ResultSubcategoria->records as $key => $Submenu){
                      ?>
                      <li>
                        <a href="categorias.php?id_sbct=<?php echo $Submenu->Key;?>&nom=<?php echo url_amigable($Submenu->Descripcion);?>"><?php echo $Submenu->Descripcion;?></a>
                        <ul>
                        <?php 
                         $SubmenuController_ = new SubmenuController();
                         $SubmenuController_->filter = "WHERE id_principal = '".$Submenu->Key."' AND nivel=3 AND activo='si' ";
                         $SubmenuController_->order = "";
                         $ResultSubcategoria_ = $SubmenuController_->get();
                          if($ResultSubcategoria_->count > 0){
                            foreach ($ResultSubcategoria_->records as $key_ => $Subcategoria_){
                            ?>
                            <li>
                              <a href="categorias.php?id_sbct=<?php echo $Submenu->Key;?>&id_gpo=<?php echo $Subcategoria_->Key;?>&nom=<?php echo url_amigable($Subcategoria_->Descripcion);?>"><?php echo $Subcategoria_->Descripcion;?></a>
                            </li>
                            <?php }?>
                        <?php }?>
                        </ul>
                      </li>
                      <?php } ?>
                    <?php } ?>
                  </ul>
                </li>
                <?php } ?>              
              </ul>
            </section>            
          </aside>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Footer.php'; ?>
    <!-- scripts JS -->
    <?php include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Partials/Scripts.php'; ?>
    <script>
      altura('.featured_products_card')
      altura('.featured_products_content')
      altura('.featured_products_price')
      altura('.featured_products_card_1')
      altura('.featured_products_content_1')
      
      PositionAltura('.SameHeight')

    </script>
  </body>
</html>
<?php 
  unset($CategoriaController);
  unset($Categoria);
  unset($SubcategoriasController);
  unset($Subcategoria);
  unset($Categoria_);
  unset($ResultSubcategoria);
  unset($SubcategoriasN1Controller);
  unset($ResultSubcategoriasN1);
  unset($ProductoController);
  unset($ResultProducto_);
  unset($ResultCategoria);
?>