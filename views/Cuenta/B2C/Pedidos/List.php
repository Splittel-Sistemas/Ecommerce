<?php
  if (!class_exists('PedidoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
  }

  $PedidoController = new PedidoController();
  $PedidoController->filter = "WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND t05_f008 = 0 AND t12_f004 = 'completed' ";
  $PedidoController->order = "";
  $ResultPedido = $PedidoController->ListPedidoB2C_();
?>
<style>
@import url('//cdn.datatables.net/1.10.2/css/jquery.dataTables.css');
 td.details-control {
    background: url('http://www.datatables.net/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('http://www.datatables.net/examples/resources/details_close.png') no-repeat center center;
}
</style>
  <div class="table-responsive-sm">
    <table class="table table-hover text-center" id="pedidos">
      <thead class="">
        <tr>
          <th class="align-middle">Estatus</th>
          <th class="align-middle">#</th>
          <th class="align-middle">Pedido</th>
          <th class="align-middle">Fecha</th>
          <th class="align-middle">Subtotal</th>
          <th class="align-middle">Iva</th>
          <th class="align-middle">Total</th>
          <th class="align-middle">Moneda</th>
          <th class="align-middle">Número guía</th>
          <th class="align-middle">Ver</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($ResultPedido->records as $key => $Pedido) { ?>
        <tr data-child-value="<?php echo $key+1 ?>">
          <td class="align-middle details-control" DocNumEcommerce="<?php echo $Pedido->Key; ?>"></td>
          <td class="align-middle"><?php echo $key+1 ?></td>
          <td class="align-middle"><?php echo $Pedido->Key; ?></td>
          <td class="align-middle"><?php echo date('d-m-Y',strtotime($Pedido->Fecha)); ?></td>
          <?php if ($Pedido->MonedaPago == 'USD'): ?>            
          <td class="align-middle">$<?php echo $Pedido->SubTotal; ?></td>
          <td class="align-middle">$<?php echo $Pedido->Iva; ?></td>
          <td class="align-middle">$<?php echo $Pedido->Total; ?></td>
          <?php else: ?>
          <td class="align-middle">$<?php echo $Pedido->SubTotalMXP; ?></td>
          <td class="align-middle">$<?php echo $Pedido->IvaMXP; ?></td>
          <td class="align-middle">$<?php echo $Pedido->TotalMXP; ?></td>
          <?php endif ?>
          <td class="align-middle"><?php echo $Pedido->MonedaPago; ?></td>
          <?php 
            if(!empty($Pedido->Numeroguia)){ 
              $PaqueteriaKey = $Pedido->NombrePaqueteria == 'DHL' ? 12 : 14;
          ?>
          <td class="text-center align-middle">
            <a href="../Order/index.php?PaqueteriaKey=<?php echo $PaqueteriaKey?>&PedidoKey=<?php echo $Pedido->Key?> " class="text-danger" target="_blank">
                <i class="icon-map-pin"></i>
            </a>
          </td>
          <?php }else{ ?>
          <td class="text-center align-middle">--</td>
          <?php } ?>
          <td>
            <?php
            if($Pedido->FacturaKey!=''){
            ?>
            <a href="javascript:void(0);" onclick="javascript:window.open('../Cuenta/B2C/Pedidos/get_documents.php?DocEntry=<?php echo $Pedido->FacturaKey; ?>&TypeFile=PDF', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yno,top=200,left=200,width=300,height=200');">  
              <img src="../../public/images/img_spl/iconos/pdf.png" width="20px" height="20px" /> 
            </a>
            <?php
            if($Pedido->RequiereFactura=='true'){ ?>
            <a href="javascript:void(0);" onclick="javascript:window.open('../Cuenta/B2C/Pedidos/get_documents.php?DocEntry=<?php echo $Pedido->FacturaKey; ?>&TypeFile=XML', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yno,top=200,left=200,width=300,height=200');">  
              <img src="../../public/images/img_spl/iconos/xml.png" width="20px" height="20px" /> 
            </a>
            <?php
            }
            }else{
            echo "En proceso";
            }
            ?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <?php 

    unset($Documento);
    unset($response);

   ?>