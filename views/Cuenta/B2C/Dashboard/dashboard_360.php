<?php 
  @session_start();
  if (!class_exists("ClienteController")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Cliente/Cliente.Controller.php';
  }
  $ClienteController = new ClienteController();
?>

<div class="col-lg-12">
  <div class="row">
    <!-- Primera Compra -->
    <div class="col-12 col-lg-4">
      <section class="widget">
        <h3 class="widget-title">Primera compra</h3>
        <?php 
          $ResultPrimeraCompra = $ClienteController->PrimeraCompra();
          if($ResultPrimeraCompra->count > 0){
        ?>
        <p class="float-right"><?php echo date("d-m-Y",strtotime($ResultPrimeraCompra->records[0]->Fecha));?></p>
        <?php } ?>
      </section>
    </div>
    <!-- Pedidos en el año -->
    <div class="col-12 col-lg-4">
      <section class="widget">
        <h3 class="widget-title">Pedidos en el año</h3>
        <?php
          $ResultPedidosRealizadosYear = $ClienteController->PedidosRealizadosYear(); 
          if($ResultPedidosRealizadosYear->count > 0){
        ?>
        <p class="float-right"><?php echo $ResultPedidosRealizadosYear->count;?></p>
        <?php } ?>
      </section>
    </div>
    <!-- Dia favorito de compra -->
    <div class="col-12 col-lg-4">
      <section class="widget">
        <h3 class="widget-title">Dia favorito de compra</h3>
        <?php
          $ResultDiaFavoritoCompra = $ClienteController->DiaFavoritoCompra(); 
          if($ResultDiaFavoritoCompra->count > 0){
        ?>
        <p class="float-right"><?php echo ucwords($ResultDiaFavoritoCompra->records[0]->Dia);?></p>
        <?php } ?>
      </section>
    </div>
  </div>
  <div class="row mt-5">
    <!-- Compra Anual -->
    <div class="col-12 col-lg-6">
      <section class="widget">
        <h3 class="widget-title">Compra Anual</h3>
        <?php 
          $ResultCompraAnual = $ClienteController->CompraAnual();
          if($ResultCompraAnual->count > 0){
        ?>
        <p class="float-right"><?php echo $ResultCompraAnual->records[0]->Total ?> USD</p>
        <?php } ?>
      </section>
    </div>
    <!-- Compra Mensual -->
    <div class="col-12 col-lg-6">
      <section class="widget">
        <h3 class="widget-title">Compra Mensual</h3>
        <?php
          $ResultCompraMensual = $ClienteController->CompraMensual(); 
          if($ResultCompraMensual->count > 0){
        ?>
        <p class="float-right"><?php echo $ResultCompraMensual->records[0]->Total ?> USD</p>
        <?php } ?>
      </section>
    </div>
  </div>
  <!-- Top 5 productos más comprados (Monto) -->
  <div class="row mt-5">
    <div class="col-lg-12 col-md-8 order-md-2">
      <h6 class="text-muted text-lg text-uppercase mt-2">Top 5 productos más comprados (Monto)</h6>
      <hr class="margin-bottom-1x">
      <?php 
        $array_colors=["bg-success","bg-info","bg-warning","bg-danger"];
        $ResultTop5ProductosMasCompradosMonto = $ClienteController->Top5ProductosMasCompradosMonto(); 

          if ($ResultTop5ProductosMasCompradosMonto->count > 0){ 
            $ProductosMasCompradosMontoMaximo = $ResultTop5ProductosMasCompradosMonto->records['ProductosMasCompradosMontoMaximo']->Total;
            foreach ($ResultTop5ProductosMasCompradosMonto->records['ProductosMasCompradosMonto'] as $key => $Top5ProductosMasCompradosMonto) {
              $ResultPorcentaje = ($Top5ProductosMasCompradosMonto->Total * 100) / $ProductosMasCompradosMontoMaximo;

          ?>
          <label class="text-gray-dark"><?php echo $Top5ProductosMasCompradosMonto->Codigo; ?> - $<?php echo $Top5ProductosMasCompradosMonto->Total; ?> USD </label>
          <div class="progress margin-bottom-1x">
            <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $array_colors[$key]?>" role="progressbar" style="width: <?php echo round($ResultPorcentaje);?>%;" aria-valuenow="<?php echo round($ResultPorcentaje)?>" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

      <?php } } ?>
    </div>
  </div> 
  <!-- Top 5 productos más comprados (Cantidad) -->
  <div class="row mt-5">
    <div class="col-lg-12 col-md-8 order-md-2">
      <h6 class="text-muted text-lg text-uppercase mt-2">Top 5 productos más comprados (Cantidad)</h6>
      <hr class="margin-bottom-1x">
      <?php 
        $array_colors=["bg-success","bg-info","bg-warning","bg-danger"];
        $ResultTop5ProductosMasCompradosCantidad = $ClienteController->Top5ProductosMasCompradosCantidad(); 

          if ($ResultTop5ProductosMasCompradosCantidad->count > 0){ 
            $ProductosMasCompradosCantidadMaximo = $ResultTop5ProductosMasCompradosCantidad->records['ProductosMasCompradosCantidadMaximo']->Total;
            foreach ($ResultTop5ProductosMasCompradosCantidad->records['ProductosMasCompradosCantidad'] as $key => $Top5ProductosMasCompradosCantidad) {
              $ResultPorcentaje = ($Top5ProductosMasCompradosCantidad->Total * 100) / $ProductosMasCompradosCantidadMaximo;

          ?>
          <label class="text-gray-dark"><?php echo $Top5ProductosMasCompradosCantidad->Codigo; ?> - <?php echo $Top5ProductosMasCompradosCantidad->Total; ?> Piezas </label>
          <div class="progress margin-bottom-1x">
            <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $array_colors[$key]?>" role="progressbar" style="width: <?php echo round($ResultPorcentaje);?>%;" aria-valuenow="<?php echo round($ResultPorcentaje)?>" aria-valuemin="0" aria-valuemax="100"></div>
          </div>

      <?php } } ?>
    </div>
  </div> 
</div>
<?php
  unset($ClienteController);
  unset($ResultPrimeraCompra);
  unset($ResultPedidosRealizadosYear);
  unset($ResultDiaFavoritoCompra);
  unset($ResultCompraAnual);
  unset($ResultCompraMensual);
  unset($ResultTop5ProductosMasCompradosMonto);
  unset($ResultTop5ProductosMasCompradosCantidad);