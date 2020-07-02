<?php
    /**
     * [0]      Informacion encontrada
     * [20]     Error al conectar con SAP B1
     * [100]    Informacion no encontrada
     * [400]    Error de sistema, webService
     */
    @session_start();
    if(isset($_SESSION['Ecommerce-ClienteKey'])){
        if (!class_exists("GetBussinesPartner")) {
            include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/BussinesPartner/GetBussinesPartner.php';
        }
        $GetBussinesPartner = new GetBussinesPartner();
        try {
            $responseGetBussinesPartner = $GetBussinesPartner->get(false);
            $ErrorCode = $responseGetBussinesPartner->GetBussinesPartnerResult->ErrorCode;
            $ErrorDescription = $responseGetBussinesPartner->GetBussinesPartnerResult->ErrorDescription;
            $responseGetBussinesPartner = $responseGetBussinesPartner->GetBussinesPartnerResult->Record;
        } 
        catch (SoapFault $fault) {
            $ErrorCode = -100;
        }
        if($ErrorCode == 0){
?>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4">
            <!-- Widget Contacts-->
            <section class="widget">
                <h3 class="widget-title">Cliente</h3>
                <p><?php echo $responseGetBussinesPartner->CardName;?></p>
                </section>
            </div>
            <div class="col-lg-4">
            <!-- Widget Links-->
            <section class="widget">
                <h3 class="widget-title">E-mail</h3>
                <p><?php echo $responseGetBussinesPartner->E_Mail;?></p>
                </section>
            </div>
            <div class="col-lg-4">
            <!-- Widget Search-->
            <section class="widget">
                <h3 class="widget-title">Teléfono</h3>
                <p><?php echo $responseGetBussinesPartner->Phone2;?></p>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
            <!-- Widget Contacts-->
            <section class="widget">
                <h3 class="widget-title">D&iacute;as de cr&eacute;dito</h3>
                <p><?php echo $responseGetBussinesPartner->ExtraDays?></p>
                </section>
            </div>
            <div class="col-lg-4">
            <!-- Widget Contacts-->
            <section class="widget">
                <h3 class="widget-title">L&iacute;mite de cr&eacute;dito</h3>
                <p>$<?php echo number_format((float)$responseGetBussinesPartner->CreditLine,2). ' ' .$responseGetBussinesPartner->Currency;?> </p>
                </section>
            </div>
            <div class="col-lg-4">
            <!-- Widget Contacts-->
            <section class="widget">
                <?php if ((float)$responseGetBussinesPartner->Balance < 0): ?>                    
                <h3 class="widget-title">Saldo a favor</h3>
                <?php else: ?>
                <h3 class="widget-title">Saldo</h3>
                <?php endif ?>
                <p>$<?php echo number_format((float)$responseGetBussinesPartner->Balance,2). ' ' .$responseGetBussinesPartner->Currency;?></p>
            </section>
            </div>
            </div>
        <div class="row">
            <div class="col-lg-4">
            <!-- Widget Contacts-->
            <section class="widget">
                <h3 class="widget-title">Envío de facturas</h3>
                <p><?php echo $responseGetBussinesPartner->E_MailL_invoice;?></p>
                </section>
            </div>
            <div class="col-lg-4">
            <!-- Widget Contacts-->
            <section class="widget">
                <h3 class="widget-title">Envío edo. de cuenta</h3>
                <p style="overflow-wrap: break-word;" ><?php echo nl2br($responseGetBussinesPartner->E_MailL_account);?></p>
                </section>
            </div>
            <div class="col-lg-4">
            <!-- Widget Contacts-->
            <section class="widget">
                <h3 class="widget-title">Segmento</h3>
                <p><?php echo $responseGetBussinesPartner->Section;?></p>
                </section>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-4">
            <!-- Widget Contacts-->
            <section class="widget">
                <h3 class="widget-title">Ejecutivo</h3>
                <p><?php echo $responseGetBussinesPartner->SlpName;?></p>
                </section>
            </div>
            <div class="col-lg-4">
            <!-- Widget Contacts-->
            <section class="widget">
                <h3 class="widget-title">E-mail ejecutivo</h3>
                <p><?php echo $responseGetBussinesPartner->Email_employeSales;?></p>
                </section>
            </div>
            </div>
            <div class="row">
            <div class="col-lg-4">
            <!-- Widget Contacts-->
            <section class="widget">
                <h3 class="widget-title">Cta. Monex USD</h3>
                <p><?php echo $responseGetBussinesPartner->MonexUSD;?></p>
                </section>
            </div>
            <div class="col-lg-4">
            <!-- Widget Contacts-->
            <section class="widget">
                <h3 class="widget-title">Cta. Monex MXP</h3>
                <p><?php echo $responseGetBussinesPartner->MonexMXP;?></p>
                </section>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <h6 class="text-muted text-lg text-uppercase">Cambiar contraseña</h6>
        <hr class="margin-bottom-1x">
        <form class="row" id="form-change-password">
          <input class="form-control" type="hidden" id="Action" name="Action" value="changePassword">
          <div class="col-md-6">
              <div class="form-group">
                <input class="form-control form-control-sm" type="password" id="PersonalPassword" name="PersonalPassword" placeholder="Contraseña" autocomplete="off" required>
              </div>
              
          </div>
          <div class="col-md-6">
              <div class="form-group">
                <input class="form-control form-control-sm" type="password" id="PersonalPasswordConfirm" name="PersonalPasswordConfirm" placeholder="Confirmar Contraseña" autocomplete="off" required>
              </div>
          </div>
            <button type="button" class="btn btn-primary btn-sm" onclick="changePassword()"><i class="icon-mail"></i>&nbsp;Enviar</button>
        </form>
    </div>
<?php
        }
        else if($ErrorCode == 100){
?>
    <div class="alert alert-warning alert-dismissible fade show text-center margin-bottom-1x">
        <span class="alert-close" data-dismiss="alert"></span>
        <i class="icon-alert-triangle"></i>&nbsp;&nbsp;<span class="text-medium">Alerta:</span> <?php echo $ErrorDescription; ?>
    </div>
<?php
        }
        else if($ErrorCode == 20 || $ErrorCode == 400 || $ErrorCode == -100){
            include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/ErrorProcessWS.php';
        }
        unset($GetBussinesPartner);
        unset($responseGetBussinesPartner);
    }else{
        include $_SERVER["DOCUMENT_ROOT"].'/store/views/Partials/SessionExpired.php';
    }
?>