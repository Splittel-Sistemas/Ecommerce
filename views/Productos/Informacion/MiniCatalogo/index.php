<?php 
if (isset($_POST['DirectorioImgProducto'])) {            
  $dirname_min = "public/images/img_spl/productos/" . $_POST['DirectorioImgProducto'] . "/Mini Catalogo/";
    $images_min = glob("../../../../".$dirname_min."*.pdf");
    //var_dump($images_min);
    $total_minic = count($images_min);
    if ($total_minic > 0) {
      foreach ($images_min as $minic) {
        //echo $minic;
      ?>
        <button class="btn btn-outline-secondary btn-sm ">
          <a href="../../../../fibra-optica/public/images/img_spl/productos/<?php echo $_POST['DirectorioImgProducto'] ?>/Mini Catalogo/<?php echo basename($minic); ?>" target="_blank">
            <i class="icon-download"></i>&nbsp;Folleto
          </a>
        </button>
      <?php
      }
    }
  }
    ?>