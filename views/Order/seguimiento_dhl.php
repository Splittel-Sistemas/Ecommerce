
    <?php 
      if (!class_exists('NumeroGuiaEstatusController')) {
        include $_SERVER['DOCUMENT_ROOT'].'/store/models/Paqueteria/DHL/NumeroGuiaEstatus.Controller.php';
      }
      $NumeroGuiaEstatusController = new NumeroGuiaEstatusController();
      $NumeroGuiaEstatusController->PedidoKey = $_GET['PedidoKey'];
      $Result = $NumeroGuiaEstatusController->GetPedidoEstatusPaqueteriaDHL();
      $Pedido = $Result->records['Pedido'];
      $UltimoEvento = $Result->records['UltimoEvento'];
    ?>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1">
      <div class="card mb-3">
        <div class="p-4 text-center text-white bg-dark rounded-top">
          <span class="text-uppercase">Número de orden - </span><span class="text-medium"><?php echo $Pedido->Numeroguia ?></span>
        </div>
        <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
          <div class="w-100 text-center py-1 px-2"><span class='text-medium'>Enviado a tráves de:</span> <?php echo $Pedido->NombrePaqueteria ?></div>
          <div class="w-100 text-center py-1 px-2"><span class='text-medium'>Estatus:</span> <?php echo isset($UltimoEvento->ServiceEvent->Description) ? $UltimoEvento->ServiceEvent->Description : '' ?></div>
          <div class="w-100 text-center py-1 px-2"><span class='text-medium'>Fecha Actual:</span> <?php echo date('d-m-Y') ?></div>
        </div>
        <div class="card-body">
          <div class="steps flex-sm-nowrap padding-top-1x padding-bottom-1x">
            <div class="step <?php echo count($Result->records['Evento']) >= 0 ? 'active' : '' ?>"><i class="icon-shopping-bag"></i>
              <h4 class="step-title">Orden Confirmada</h4>
            </div>
            <div class="step <?php echo count($Result->records['Evento']) > 0 ? 'active' : '' ?>"><i class="icon-truck"></i>
              <h4 class="step-title">Producto despachado</h4>
            </div>
            <div class="step <?php echo $Pedido->NumeroGuiaEstatus == 'OK' ? 'active' : '' ?>"><i class="icon-home"></i>
              <h4 class="step-title">Producto Entregado</h4>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="d-flex flex-wrap flex-md-nowrap justify-content-center justify-content-sm-between align-items-center">
        <div class="custom-control custom-checkbox mr-3">
          <input class="custom-control-input" type="checkbox" id="notify_me" checked>
          <label class="custom-control-label" for="notify_me">Notificarme cuando la orden fue entregada</label>
        </div>
        <div class="text-left text-sm-right"><a class="btn btn-primary btn-sm" href="orderDetails" data-toggle="modal" data-target="#orderDetails">View Order Details</a></div>
      </div> -->
      <div class="row mt-5">
        <div class="col-lg-12 col-md-8 order-md-2">
          <!-- <hr class="margin-bottom-1x"> -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link active" href="#inf1" data-toggle="tab" role="tab">Seguimiento</a></li>
          </ul>
          <div class="tab-content">
            <!-- Seguimiento -->
            <div class="tab-pane fade show active" id="inf1" role="tabpanel">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th class="text-center align-middle" scope="col">Fecha</th>
                      <th class="text-center align-middle" scope="col">Hora</th>
                      <th class="align-middle" scope="col">Descripción</th>
                      <th class="text-center align-middle" scope="col">Sucursal</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($Result->records['Evento'] as $key => $Evento) { ?>
                    <tr>
                      <td class="text-center align-middle"><?php echo $Evento->Date; ?></td>
                      <td class="text-center align-middle"><?php echo $Evento->Time; ?></td>
                      <td class="align-middle"><?php echo $Evento->ServiceEvent->Description; ?></td>
                      <td class="text-center align-middle"><?php echo $Evento->ServiceArea->Description; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>