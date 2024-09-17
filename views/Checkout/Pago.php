<div class="row">
  <div class="col-md-12 alert alert-warning alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span>

 

    <div class=" col-md-12 ">
      <p class="credit d-flex justify-content-center">Transacciones realizadas vía:</p>
    </div>
    <div class=" col-md-12">
      <div class="credit d-flex justify-content-center">
        <img class="img-responsive" src="../../public/images/OpenPay/openpay.png">
      </div>
    </div>
    <div class=" col-md-12">
      <div class="credit d-flex justify-content-center">
        <p>SOLO SE ACEPTAN TRANSFERENCIAS EN MXN</p>

      </div>
      <div class="credit d-flex justify-content-center">

        <p>Open Pay, la plataforma online confiable para realizar tu pago con Fibremex</p>
      </div>
    </div>
  </div>
</div>
<h4 class="text-center text-md-left">Moneda de facturación</h4>
<hr class="padding-bottom-1x">
<div class="d-flex justify-content-center">
  <div class="custom-control custom-radio custom-control-inline">
    <input class="custom-control-input monedaPago" type="radio" id="monedaPagoUSD" name="monedaPago" value="USD" cliente="<?php echo $_SESSION['Ecommerce-ClienteTipo'] ?>" onchange="facturacionBb2MXP(this)" checked="checked">
    <label class="custom-control-label" for="monedaPagoUSD">USD</label>
  </div>
  <div class="custom-control custom-radio custom-control-inline">
    <input class="custom-control-input monedaPago" type="radio" id="monedaPagoMXN" name="monedaPago" value="MXP" cliente="<?php echo $_SESSION['Ecommerce-ClienteTipo'] ?>" onchange="facturacionBb2MXP(this)" disabled>
    <label class="custom-control-label" for="monedaPagoMXN">MXP</label>
  </div>
</div>

<h4 class="padding-top-1x text-center text-md-left">Método de pago</h4>
<hr class="padding-bottom-1x">
<div class="accordion" id="accordion" role="tablist">
  <div class="card">
    <div class="card-header" role="tab">
      <h6><a href="#card" data-toggle="collapse"><i class="icon-credit-card"></i> Pago con tarjeta mediante Openpay </a></h6>
    </div>
    <div class="collapse show" id="card" data-parent="#accordion" role="tabpanel">
      <div class="card-body">
        <div id="AlertPago"></div>
        <div class="row mb-4">
          <div class="col-md-12">
            <div class="alert alert-info alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-layers"></i>&nbsp;&nbsp;Monto máximo para pago con tarjeta: <strong>$100,000 MXN</strong>
              <br>
              <strong>
                Si tienes alguna duda, contáctanos: 800 134 26 90
              </strong>
            </div>
          </div>
        </div>
        <div class="row mb-4">
          <div class="col-12 col-md-8">
            <h4 class="text-center">Tarjetas de débito</h4>
            <div class="credit d-flex justify-content-center">
              <img class="img-responsive" src="../../public/images/OpenPay/cards2.png">
            </div>
          </div>
          <div class="col-12 col-md-4">
            <h4>Tarjetas de crédito</h4>
            <div class="debit">
              <img class="img-responsive" src="../../public/images/OpenPay/cards1.png">
            </div>
          </div>
        </div>
        <hr class="padding-bottom-1x">
        <div class="card-wrapper"></div>
        <form class="interactive-credit-card row">
          <div class="form-group col-12 col-sm-6">
            <input class="form-control" type="text" id="number" name="number" placeholder="Número de tarjeta" required>
          </div>
          <div class="form-group col-12 col-sm-6">
            <input class="form-control" type="text" id="name" name="name" placeholder="Nombre Completo" required>
          </div>
          <div class="form-group col-12 col-sm-6">
            <input class="form-control" type="text" id="expiry" name="expiry" placeholder="MM/YY" onkeyup="Expiracion(this)" required>
            <input class="form-control" type="hidden" id="exp_month" name="exp_month" data-openpay-card="expiration_month">
            <input class="form-control" type="hidden" id="exp_year" name="exp_year" data-openpay-card="expiration_year">
          </div>
          <div class="form-group col-12 col-sm-6">
            <input class="form-control" type="text" id="cvc" name="cvc" placeholder="CVC" required>
          </div>
          <?php
              if (!class_exists('DetalleController')) {
                include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Detalle.Controller.php';
              }
              if (!class_exists("ProductoController")) {
                include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
              }
              if (!class_exists("CategoriaController")) {
                include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Categorias/Categoria.Controller.php';
              }
              if (!class_exists("FamiliasMSIController")) {
                include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/FamiliasMSI/FamiliaMSI.Controller.php';
              }
              if (!class_exists('PedidoController')) {
                include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
              }
      
              $DetalleControllerMSI = new DetalleController();
              $ObjDetalleMSI = $DetalleControllerMSI->GetDetallePedido();
              $ProductoControllerMSI = new ProductoController();
              $CategoriaControllerMSI = new CategoriaController();
              $FamiliasControllerMSI = new FamiliasMSIController();
              $MontoControllerMSI = new FamiliasMSIController();
              $SegmentoControllerMSI = new FamiliasMSIController();
              //print_r($ObjDetalleMSI);
              // Monto minimo para MSI
              $MontoControllerMSI->filter = "";
              $MontoControllerMSI->order = "";
              $MontoMinimoMSI = $MontoControllerMSI->getMontoMinimo();
              $dataMontoMinimo=0;
              if($MontoMinimoMSI->count > 0){
                $dataMontoMinimo = $MontoMinimoMSI->records[0]->Monto;
              }
              $PedidoControllerMSI = new PedidoController;
              $PedidoControllerMSI->filter = "WHERE id = ".$_SESSION["Ecommerce-PedidoKey"]." ";
              $PedidoControllerMSI->order = "";
              $PedidoMSI = $PedidoControllerMSI->getBy();
              $pedidoSubtotalMSI = $PedidoMSI->GetSubTotal();
              // Revision de de categorias seleccionadas para MSI
              $AutMSI='';
              $CountAuxMSI=0;
              
              if($ObjDetalleMSI->count > 0){
                foreach ($ObjDetalleMSI->records as $key => $data) {			
                  if((!($data->ProductoCodigo == '') && $data->ProductoCodigoConfigurable == '') || (!($data->ProductoCodigo == '') && !($data->ProductoCodigoConfigurable == ''))){
                    $ProductoControllerMSI->filter = "WHERE codigo = '" . trim($data->ProductoCodigo). "'  ";
                    $ProductoControllerMSI->order = "";
                    $ObjProductoMSI = $ProductoControllerMSI->GetByProductosFijos();
                    $AutMSI = $ObjProductoMSI->ProductoSubcategoriaKey;
                 
                  }else if(!($data->DetalleCodigoConfigurable == '')){
                    $CategoriaControllerMSI->filter = "WHERE codigo = '" . trim($data->DetalleCodigoConfigurable) . "' ";
                    $CategoriaControllerMSI->order = "";
                    $ObjCategoriaMSI = $CategoriaControllerMSI->estructura();
                    $AutMSI = $ObjCategoriaMSI->SubcategoriaN1Key;
                  
                  }
                  
                  $FamiliasControllerMSI->filter = "WHERE familia = '" . trim($AutMSI) . "' AND (NOW() >= inicio AND NOW() <= fin) ";
                  $FamiliasControllerMSI->order = "";
                  
                  $ObjFamiliasMSI = $FamiliasControllerMSI->get();
                 
                  if($ObjFamiliasMSI->count == 0){
                    $CountAuxMSI++;
                  }
                  
              }
            }
            // Revision de de categorias seleccionadas para MSI
            $CountSegMSI=0;
            $SegmentoControllerMSI->filter = "WHERE segmento = '".$_SESSION['Ecommerce-ClienteSegmento']."' ";
            $SegmentoControllerMSI->order = "";
            $SegmentoMSI = $SegmentoControllerMSI->getSegmentos();
           
            if($SegmentoMSI->count > 0){
              $CountSegMSI++;
            }
         
          if($CountAuxMSI == 0 && ($MontoMinimoMSI->count > 0 && $dataMontoMinimo > 0 && $pedidoSubtotalMSI>=$dataMontoMinimo ) &&  $CountSegMSI>0){
          ?>
          <div class="form-group col-12 col-sm-6 text-center">
            <select class="form-control" id="msi" name="msi">
              <option value="" selected>Una sola exhibición</option>
              <option value="3">3 meses sin intereses</option>
              <!--<option value="6">6 meses sin intereses</option>-->
            </select>
          </div>
          <?php } ?>
        </form>
        <!-- Información OpenPay Necesaria -->
        <div class="row mt-4">

          <div class="col-md-6">
            <div class="row">
              <div class="col-12 col-md-6 offset-md-3">
                <p class="text-right">Transacciones realizadas vía:</p>
              </div>
              <div class="col-12 col-md-3">
                <div class="credit d-flex justify-content-end">
                  <img class="img-responsive" src="../../public/images/OpenPay/openpay.png">
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-12 col-md-2">
                <div class="credit d-flex justify-content-center">
                  <img class="img-responsive" src="../../public/images/OpenPay/security.png">
                </div>
              </div>
              <div class="col-12 col-md-6">
                <p>Tus pagos se realizan de forma segura con encriptación de 256 bits</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  -->
  <?php if (!isset($_SESSION["Ecommerce-OpenPay-3DSecure-Id"])) { ?>
    <div class="card" id="metodo-pago-banco" style="display: none; ">
      <div class="card-header" role="tab">
        <h6><a class="collapsed" href="#bank" data-toggle="collapse"><i class="icon-award"></i>Transferencia Interbancaria</a></h6>
      </div>
      <div class="collapse" id="bank" data-parent="#accordion" role="tabpanel">
        <div class="card-body">
          <div class="custom-control custom-checkbox d-block">
            <input class="custom-control-input" type="checkbox" id="pagoBanco" name="pagoBanco">
            <label class="custom-control-label" for="pagoBanco">Pago mediante transferencia interbancaria.</label>
          </div>
          <!-- Información OpenPay Necesaria -->
          <div class="row mt-4">
            <div class="col-md-6">
              <div class="row">
                <div class="col-12 col-md-6 offset-md-3">
                  <p class="text-right">Transacciones realizadas vía:</p>
                </div>
                <div class="col-12 col-md-3">
                  <div class="credit d-flex justify-content-end">
                    <img class="img-responsive" src="../../public/images/OpenPay/openpay.png">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="row">
                <div class="col-12 col-md-2">
                  <div class="credit d-flex justify-content-center">
                    <img class="img-responsive" src="../../public/images/OpenPay/security.png">
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <p>Tus pagos se realizan de forma segura con encriptación de 256 bits</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php } else { ?>
    <div class="custom-control custom-checkbox d-none">
      <input class="custom-control-input" type="checkbox" id="pagoBanco" name="pagoBanco">
      <label class="custom-control-label" for="pagoBanco">Pago mediante transferencia interbancaria.</label>
      <!-- Información OpenPay Necesaria -->
      <div class="row mt-4">
        <div class="col-md-6">
          <div class="row">
            <div class="col-12 col-md-6 offset-md-3">
              <p class="text-right">Transacciones realizadas vía:</p>
            </div>
            <div class="col-12 col-md-3">
              <div class="credit d-flex justify-content-end">
                <img class="img-responsive" src="../../public/images/OpenPay/openpay.png">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-12 col-md-2">
              <div class="credit d-flex justify-content-center">
                <img class="img-responsive" src="../../public/images/OpenPay/security.png">
              </div>
            </div>
            <div class="col-12 col-md-6">
              <p>Tus pagos se realizan de forma segura con encriptación de 256 bits</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--  -->
    <?php
  }
  if (isset($_SESSION['Ecommerce-ClienteTipo']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B') {
    if (!class_exists("GetBussinesPartnerController")) {
      include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/WebService/BusinessPartner/GetBussinesPartner.Controller.php';
    }
    if (!class_exists("ValidCreditController")) {
      include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/WebService/BusinessPartner/ValidCredit.Controller.php';
    }

    if (!class_exists("Functions_tools")) {
      include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Tools/Functions_tools.php';
    }
    /*
    try {
      $GetBussinesPartnerController = new GetBussinesPartnerController();
      $resultGetBussinesPartnerController = $GetBussinesPartnerController->get();
      $ErrorCode = $resultGetBussinesPartnerController->GetBussinesPartnerResult->ErrorCode;
      // print_r($resultGetBussinesPartnerController);
    } catch (Exception $e) {
      $ErrorCode = -100;
    }
    */
    /*
    try {
      $ValidCreditController = new ValidCreditController();
      $resultValidCreditController = $ValidCreditController->GetValidCredit(1999.99,$_POST["monedaPago"],$_SESSION['Ecommerce-WS-CurrencyRate']);
      $ErrorCode = $resultValidCreditController->ValidCreditResult->ErrorCode;
      $ErrorDescription = $resultValidCreditController->ValidCreditResult->ErrorDescription;
    } catch (Exception $e) {
      $ErrorCode = -100;
    }

    if ($ErrorCode == 0) {
      $clienteCredito = $resultGetBussinesPartnerController->GetBussinesPartnerResult->Record->CreditLine;
      */
    ?>
    <div id="CreditValid">
    </div>
    <!--
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
    -->
  <?php
   // }
  }
  unset($GetBussinesPartnerController);
  unset($resultGetBussinesPartnerController);
  unset($Tool);
  ?>

</div>

<div class="d-flex justify-content-between paddin-top-1x mt-4">
  <a class="btn btn-outline-secondary" number="2" onclick="addViewCheckout(this)">
    <i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Referencias paquetería</span>
  </a>
  <a class="btn btn-primary" number="4" onclick="addViewCheckout(this)">
    <span class="hidden-xs-down">Resumen&nbsp;</span><i class="icon-arrow-right"></i>
  </a>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-datos-generar-codigo-verificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body" id="modal-body-generar-codigo-verificacion">
        <div class="col-12 col-md-3">
          <button type="button" class="btn btn-outline-info" onclick="Generar()">Generar codigo de verificación</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-datos-verificar-codigo-verificacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body" id="modal-body-verificar-codigo-verificacion">
        <div class="col-12 mt-5 mb-3">
          <strong>
            <p>Por medida de seguridad se genero un token el cual ha sido enviado a su correo, por favor de ingresarlo.</p>
          </strong>
        </div>
        <div class="col-12">
          <label>Codigo de verificación</label>
          <input type="text" class="form-control" id="CodigoV" name="CodigoV">
        </div>
        <div class="col-12 mb-5">
          <button type="button" class="btn btn-warning btn-block" onclick="Verificar()">Validar codigo</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Cargando Espere</h5>
     
      </div>
      <div class="modal-body" id="exampleModalScrollablebody">
        <div class="row">
          <div class="col-md-8 offset-4">

      <div class="spinner-grow text-primary text-center" role="status"><span class="sr-only">Loading...</span> </div>

          </div>
        </div>
      </div>
    
    </div>
  </div>
</div>