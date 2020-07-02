<?php   
    /**
     * [0]      Informacion obtenida
     * [20]     Error al conectar con SAP DI API
     * [50]     Error al autentificarse con SAP DI API
     * [400]    Error del sistema
     */
    @session_start();
    if(isset($_SESSION['Ecommerce-ClienteKey'])){
        if (!class_exists("GetDataDasboard360")) {
            include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/BussinesPartner/GetDataDasboard360.php';
        }
        $GetDataDasboard360 = new GetDataDasboard360();
        try {
            $DataDasboard360 = $GetDataDasboard360->get(false)->GetDataDasboard360Result;
            $ErrorCode = $DataDasboard360->ErrorCode;
        } catch (SoapFault $fault) {
            $ErrorCode = -100;
        }
        if($ErrorCode == 0){
            $DataDasboard360 = $DataDasboard360->Record;
            // print_r($DataDasboard360);
            $array_colors=["bg-success","","bg-info","bg-warning","bg-danger"];
            if(sizeof($DataDasboard360->TopItemsByPrice->DocumentLine) == 1){
                $LinesDoc_Price [] = $DataDasboard360->TopItemsByPrice->DocumentLine;
            }else{
                $LinesDoc_Price = $DataDasboard360->TopItemsByPrice->DocumentLine;
            }
            if(sizeof($DataDasboard360->TopItemsByQuantity->DocumentLine) == 1){
                $LinesDoc_Quantity [] = $DataDasboard360->TopItemsByQuantity->DocumentLine;
            }else{
                $LinesDoc_Quantity = $DataDasboard360->TopItemsByQuantity->DocumentLine;
            }

            ?>
<div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4">
                <section class="widget">
                    <h3 class="widget-title">D&iacute;as de cr&eacute;dito</h3>
                    <p><?php echo $DataDasboard360->ExtraDays?></p>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="widget">
                    <h3 class="widget-title">L&iacute;mite de cr&eacute;dito</h3>
                    <p>$<?php echo number_format((float)$DataDasboard360->CreditLine,2);?> <?php echo $DataDasboard360->Currency ?></p>
                </section>
            </div>
        <div class="col-lg-4">
            <section class="widget">
            <?php if ((float)$DataDasboard360->Balance < 0): ?>                    
            <h3 class="widget-title">Saldo a favor</h3>
            <?php else: ?>
            <h3 class="widget-title">Saldo</h3>
            <?php endif ?>
            <p>$<?php echo number_format((float)$DataDasboard360->Balance,2);?> <?php echo $DataDasboard360->Currency ?></p>
            </section>
        </div>

        </div>
        <div class="row">
            <div class="col-lg-4">
                <section class="widget">
                <h3 class="widget-title">Primera compra</h3>
                <p><?php echo date("d-m-Y",strtotime($DataDasboard360->FirstPurchase));?></p>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="widget">
                <h3 class="widget-title">Pedidos en el a&ntilde;o</h3>
                <p><?php echo $DataDasboard360->OrdersInYear?></p>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="widget">
                <h3 class="widget-title">Día favorito de compra</h3>
                <p><?php echo $DataDasboard360->DavoriteDayPurchase?></p>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <section class="widget">
                <h3 class="widget-title">Compra anual</h3>
                <p>$<?php echo number_format((float)$DataDasboard360->TotalAnnualPurchase,2);?> <?php echo $DataDasboard360->Currency ?></p>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="widget">
                <h3 class="widget-title">Compra mensual</h3>
                <p>$<?php echo number_format((float)$DataDasboard360->TotalMonthlyPurchase,2);?> <?php echo $DataDasboard360->Currency ?></p>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-8 order-md-2">
            <h6 class="text-muted text-lg text-uppercase mt-2">Top 5 productos m&aacute;s comprados (Monto)</h6>
            <hr class="margin-bottom-1x">
<?php 
                $pct = 100; 
                $aux = 0;
                $max = 0;
            foreach ( $LinesDoc_Price as $prdcto){
                if($aux>0){ 
                    $pct=(((float)$prdcto->Price*100)/$max);
                } 
?>
                <label class="text-gray-dark"><?php echo $prdcto->Dscription; ?> - $<?php echo number_format((float)$prdcto->Price,2); ?> <?php echo $DataDasboard360->Currency ?></label>
                <div class="progress margin-bottom-1x">
                    <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $array_colors[$aux]?>" role="progressbar" style="width: <?php echo $pct;?>%;" aria-valuenow="<?php echo $pct;?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
<?php
                if($aux==0){
                    $max=(float)$prdcto->Price;
                }
                $aux++;
            }
?>
        </div>
        </div> 
        <div class="row">
        <div class="col-lg-12 col-md-8 order-md-2">
            <h6 class="text-muted text-lg text-uppercase mt-2">Top 5 productos m&aacute;s comprados (Cantidad)</h6>
            <hr class="margin-bottom-1x">
<?php 
                $pct=100; 
                $aux=0;
                $max = 0;
            foreach ($LinesDoc_Quantity as $prdcto){
                if($aux>0){ 
                    $pct=(((float)$prdcto->Quantity*100)/$max);
                } 
?>
                <label class="text-gray-dark"><?php echo $prdcto->Dscription; ?> - <?php echo number_format((float)$prdcto->Quantity,2); ?> piezas</label>
                <div class="progress margin-bottom-1x">
                <div class="progress-bar progress-bar-striped progress-bar-animated <?php echo $array_colors[$aux]?>" role="progressbar" style="width: <?php echo $pct;?>%;" aria-valuenow="<?php echo $pct;?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
<?php
                if($aux==0){
                    $max=(float)$prdcto->Quantity;
                }
                $aux++;
            }
?>
        </div>
        </div> 
</div>
        
<?php

        }else{
            include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/ErrorProcessWS.php';
        }
        unset($GetDataDasboard360);
    }else{
        include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/SessionExpired.php';
    }
?>