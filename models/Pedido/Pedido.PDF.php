<?php 
      @session_start();
    if(!class_exists("MYTCPDF")){ 
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/MYTCPDF.php'; 
    }if (!class_exists('DetalleController')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Detalle.Controller.php';
    }if (!class_exists('PedidoController')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Pedido/Pedido.Controller.php';
    }if (!class_exists("TemplatePedido")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/views/Templates/Email/Pedido.php';
    }
    @header('Content-Type: charset=utf-8');
    @setlocale(LC_ALL,''); // Lenguaje de fecha español

    class PedidoPDF{
        private $Obj_MYTCPDF; 
        private $Obj_PDF; 

        public function configurationBuiltPDF(){
            try {
                $this->Obj_MYTCPDF = new MYTCPDF();

                $this->Obj_PDF = $this->Obj_MYTCPDF->connection();

                $this->Obj_PDF->SetCreator(PDF_CREATOR);
                $this->Obj_PDF->SetTitle('Cotización');
                $this->Obj_PDF->setPrintHeader(false);

                // set header and footer fonts
                $this->Obj_PDF->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                $this->Obj_PDF->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

                // set default monospaced font
                $this->Obj_PDF->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

                $this->Obj_PDF->SetFont('helvetica', '', 9);

                // add a page
                $this->Obj_PDF->AddPage();
                // output the HTML content
                $this->Obj_PDF->writeHTML($this->estructuraContratoDeterminado(), true, false, true, false, '');

                $this->Obj_MYTCPDF->Output('cotizacion-pedido-'.$_GET['pedidokey'].'.pdf','I');
                
            } catch (Exception $e) {
                return $this->Obj_Functions->Message_return(false,'Error!! conexión: '.$e, null,'', true);
            }
        }

        public function estructuraContratoDeterminado(){
            try {     
                
                $companyRFC = "FIB000411840";
                $companyRegimen = "601- General de Ley Personas Morales";
                $companyLugarExp = 76246;
                $PedidoKey = $_GET['pedidokey'];
                
                $html = '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                    <style>
                        .table {
                            width: 100%;
                            max-width: 100%;
                            margin-bottom: 1rem;
                            
                        }
                        table {
                            border-collapse: collapse;
                        }
                        .table thead th {
                            vertical-align: bottom;
                        }
                        .table td, .table th {
                            padding: .75rem;
                            vertical-align: top;
                        }
                        th {
                            text-align: inherit;
                            font-weight: bold;
                        }
                        thead {
                            display: table-header-group;
                            vertical-align: middle;
                            border-color: inherit;
                        }
                        tr {
                            display: table-row;
                            vertical-align: inherit;
                            border-color: inherit;
                        }
                        .img-thumbnail {
                            padding: .25rem;
                            background-color: #fff;
                            border: 1px solid #dee2e6;
                            border-radius: .25rem;
                            max-width: 100%;
                            height: auto;
                        }
                        .th-border{
                            border-bottom: 2px solid #dee2e6;
                        }
                        .text-center{
                            text-align: center;
                        }
                        .text-end{
                            text-align: right;
                        }
                        .align-middle{
                            vertical-align: middle!important;
                        }
                    </style>
                </head>
                    <body>
                        <br><table class="table" cellspacing="3" cellpadding="3">
                            <tbody>
                                <tr style="width: 100%;">
                                    <td style="max-width: 50%;">
                                        <img class="img-thumbnail" src="../../public/images/img_spl/logos/fibremex.png" width="200" height="70" alt="">
                                    </td>
                                    <td style="max-width: 50%;">
                                        <table class="" cellspacing="3" cellpadding="3">
                                            <tbody>
                                                <tr>
                                                    <th>RFC: </th>
                                                    <td>'.$companyRFC.'</td>
                                                </tr>
                                                <tr>
                                                    <th>Regimen Fiscal: </th>
                                                    <td>'.$companyRegimen.'</td>
                                                </tr>
                                                <tr>
                                                    <th>Lugar de epedición: </th>
                                                    <td>'.$companyLugarExp.'</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table><br><br>
                
                        <table class="table" cellspacing="3" cellpadding="3">
                            <tbody>
                                <tr style="width: 100%;">
                                    <td style="max-width: 50%;">
                                        <table class="table" cellspacing="3" cellpadding="3">
                                            <tbody>
                                                <tr>
                                                    <th>Facturado a: </th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>RFC: </th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>Cp: </th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th>Condiciones: </th>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td style="max-width: 50%;">
                                        <table class="table" cellspacing="3" cellpadding="3">
                                            <tbody>
                                                <tr>
                                                    <th> No. documento: </th>
                                                    <td>'.$PedidoKey.'</td>
                                                </tr>
                                                <tr>
                                                    <th>Fecha y hora de emisión: </th>
                                                    <td>'.date('d-m-Y H:i').'</td>
                                                </tr>
                                                <tr>
                                                    <th>Moneda: </th>
                                                    <td>USD</td>
                                                </tr>';
                                                if(isset($_SESSION['Ecommerce-ClienteTipo']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B' ){
                                                $html.='<tr>
                                                    <th>Descuento: </th>
                                                    <td>'.$_SESSION['Ecommerce-ClienteDescuento'].'%</td>
                                                </tr>';
                                                }
                                            $html.= '</tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table><br><br>
                
                        <table class="table" cellspacing="3" cellpadding="3">
                            <thead>
                                <tr>
                                    <th class="th-border" width="100">Artículo</th>
                                    <th class="th-border" width="150">Descripción</th>
                                    <th class="th-border text-center" width="60">Cantidad</th>
                                    <th class="th-border text-center" width="70">%Descuento</th>
                                    <th class="th-border text-center" width="70">Precio unitario</th>
                                    <th class="th-border text-center" width="70">Total</th>
                                </tr>
                            </thead>
                            <tbody>';
                            $DetalleController = new DetalleController();
                            $Obj = $DetalleController->GetDetallePedido_("WHERE pedidokey = '".$PedidoKey."' AND detalle_activo = 'si' ");

                            if($Obj->count > 0){
                                foreach ($Obj->records as $key => $data) {
                            $detalleSubtotal = $data->DetalleSubtotal;
                            $descripcion = !empty($data->ProductoDescripcion) ? $data->ProductoDescripcion : $data->ProductoConfigurableNombre;
                            $html .= '
                                <tr>
                                    <td class="align-middle th-border" width="100">'. $data->DetalleCodigo .'</td>
                                    <td class="align-middle th-border" width="150">'. $descripcion .'</td>
                                    <td class="align-middle th-border text-center" width="60">'. $data->DetalleCantidad .'</td>
                                    <td class="align-middle th-border text-center" width="70">'.$data->DetalleDescuento .'</td>
                                    <td class="align-middle th-border text-center" width="70">$ '. $data->DetallePrecioUnidad .'</td>
                                    <td class="align-middle th-border text-center" width="70">$ '. $detalleSubtotal .'</td>
                                </tr>';
                            }
            
                            $PedidoController = new PedidoController;
                            $PedidoController->filter = "WHERE id = ".$PedidoKey." ";
                            $PedidoController->order = "";
                            # obtención de subtotal iva y total del pedido actual
                            $Pedido = $PedidoController->getBy();
                            
                                $pedidoSubtotal = $Pedido->GetSubTotal();
                                $pedidoIva = $Pedido->GetIva();
                                $pedidoTotal = $Pedido->GetTotal(); 

                            $html .= '
                                <tr>
                                    <td colspan="4"></td>
                                    <th class="text-end">Subtotal: </th>
                                    <td class="text-center">$'.$pedidoSubtotal .'</td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <th class="text-end">Iva</th>
                                    <td class="text-center">$'.$pedidoIva .'</td>
                                </tr>
                                <tr>
                                    <td colspan="4"></td>
                                    <th class="text-end">Total: </th>
                                    <td class="text-center">$'.$pedidoTotal .'</td>
                                </tr>';

                            }
                            unset($DetalleController);
                            unset($Obj);
                            unset($PedidoController);
                            unset($Pedido);
                            $html .= '
                            </tbody>
                        </table>
                    </body>
                </html>';
                return $html;

            } catch (Exception $e) {
                throw $e;
            }
        }
    
  }

$PedidoPDF = new PedidoPDF();
$Response = $PedidoPDF->configurationBuiltPDF();
print_r($Response);
