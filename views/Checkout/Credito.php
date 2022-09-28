<?php
if (!class_exists('PedidoController')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
}
if (!class_exists("ValidCreditController")) {
      include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/WebService/BusinessPartner/ValidCredit.Controller.php';
}
if (!class_exists("Functions_tools")) {
      include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Tools/Functions_tools.php';
}
     if ($_POST["monedaPago"] == "USD"){
        if(isset($_SESSION["Ecommerce-PedidoKey"])){
            $PedidoController = new PedidoController;
            $PedidoController->filter = "WHERE id = ".$_SESSION["Ecommerce-PedidoKey"]." ";
            $PedidoController->order = "";
            # obtención de subtotal iva y total del pedido actual
            $Pedido = $PedidoController->getBy();
            $pedidoSubtotal = $Pedido->GetSubTotal();
            $pedidoIva = $Pedido->GetIva();
            $pedidoTotal_ = $Pedido->GetTotal(); 
            $pedidoTotal = $Pedido->PedidoTotalMXN;
           
        }
    }else{
        if(isset($_SESSION["Ecommerce-PedidoKey"])){
            $PedidoController = new PedidoController;
            $PedidoController->filter = "WHERE id = ".$_SESSION["Ecommerce-PedidoKey"]." ";
            $PedidoController->order = "";
            # obtención de subtotal iva y total del pedido actual
            $Pedido = $PedidoController->getBy();
            $pedidoSubtotal = $Pedido->SubtotalMXN;
            $pedidoIva = $Pedido->IvaMXN;
            $pedidoTotal_ = $Pedido->TotalMXN; 
          }
       }
    if(isset($_POST["monedaPago"]) && $pedidoTotal_!='' && $Pedido->TipoCambio){
    try {
        

        $ValidCreditController = new ValidCreditController();
        $resultValidCreditController = $ValidCreditController->GetValidCredit($pedidoTotal_,$_POST["monedaPago"],$Pedido->TipoCambio);
        $ErrorCode = $resultValidCreditController->ValidCreditResult->ErrorCode;
        $ErrorDescription = $resultValidCreditController->ValidCreditResult->ErrorDescription;
      } catch (Exception $e) {
        $ErrorCode = -100;
      }
  
      if ($ErrorCode == 0) {
        if (!class_exists("GetBussinesPartnerController")) {
            include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/WebService/BusinessPartner/GetBussinesPartner.Controller.php';
          }
         try {
            $GetBussinesPartnerController = new GetBussinesPartnerController();
            $resultGetBussinesPartnerController = $GetBussinesPartnerController->get();
            $ErrorCode = $resultGetBussinesPartnerController->GetBussinesPartnerResult->ErrorCode;
            // print_r($resultGetBussinesPartnerController);
          } catch (Exception $e) {
            $ErrorCode = -100;
          }
          if ($ErrorCode == 0) {
            $clienteCredito = $resultGetBussinesPartnerController->GetBussinesPartnerResult->Record->CreditLine;
?>
<div class="card" id="credito-cliente-b2b">
        <div class="card-header" role="tab">
            <h6><a class="collapsed" href="#linea" data-toggle="collapse"><i class="icon-award"></i>Línea de crédito</a></h6>
        </div>
        <div class="collapse" id="linea" data-parent="#accordion" role="tabpanel">
          <div class="card-body">
            <p>Crédito disponible<span class="text-medium">
                <?php
                $clienteCreditoDisponible = $clienteCredito;
                ?>
                $<?php echo $clienteCreditoDisponible; ?></span> USD.</p>
                <div class="custom-control custom-checkbox d-block">
                    <input class="custom-control-input" type="checkbox" id="lineaCredito" name="lineaCredito" onchange="LineaCreditoTipoCambio(this)">
                    <label class="custom-control-label" for="lineaCredito">Usar mi línea de crédito para pagar esta orden.</label>
                </div>
          </div>
        </div>
</div>
      <?php 
          }
      }
    }
      ?>