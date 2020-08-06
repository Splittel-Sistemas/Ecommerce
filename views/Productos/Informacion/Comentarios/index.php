<style type="text/css">
  .scroll{
    height: 700px; 
    overflow-y: auto;
  }
  .scroll::-webkit-scrollbar {
    width: 5px;     /* Tamaño del scroll en vertical */
    height: 8px;    /* Tamaño del scroll en horizontal */
  }

  .scroll::-webkit-scrollbar-thumb {
    background: #ffa000;
    border-radius: 4px;
  }
</style>
<?php 
  $IdProducto = isset($_GET['id_prd']) ? $_GET['id_prd'] : '';
  $IdCategoria = isset($_GET['codigo']) ? $_GET['codigo'] : '';
?>

<div id="ListReviews">
  <?php include 'List.php'; ?>
</div>