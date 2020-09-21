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
  setlocale(LC_ALL,''); // Lenguaje de fecha español
  class PedidoPDF{
    private $Obj_MYTCPDF; 
    private $Obj_PDF; 

    public function __construct(){
    //   $this->Obj_Functions = new Functions_tools();
    }
    /**
     * Configuración necesaria para construir el contrato determinado por usuario
     *
     * @return content pdf
     */
    public function configurationBuiltPDF(){
      try {
        $this->Obj_MYTCPDF = new MYTCPDF();

        $this->Obj_PDF = $this->Obj_MYTCPDF->connection();

        $this->Obj_PDF->SetCreator(PDF_CREATOR);
        // $this->Obj_PDF->SetAuthor('Nicola Asuni');
        $this->Obj_PDF->SetTitle('Cotización');

        // set default header data
        // $this->Obj_PDF->SetHeaderData('', 0, 'COTIZACIONES', '', array(5,4,4), array(220,53,69));
        // $this->Obj_PDF->setFooterData(array(5,4,4), array(220,53,69));

        // set header and footer fonts
        $this->Obj_PDF->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->Obj_PDF->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $this->Obj_PDF->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        // $this->Obj_PDF->SetMargins('25', PDF_MARGIN_TOP, '25');
        // $this->Obj_PDF->SetHeaderMargin(PDF_MARGIN_HEADER);
        // $this->Obj_PDF->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $this->Obj_PDF->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $this->Obj_PDF->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // 
        $this->Obj_PDF->SetFont('helvetica', '', 9);

        // add a page
        $this->Obj_PDF->AddPage();
        // output the HTML content
        $TemplatePedido = new TemplatePedido();
        $this->Obj_PDF->writeHTML($TemplatePedido->body(), true, false, true, false, '');

        $this->Obj_MYTCPDF->Output('Reporte.pdf','I');
        
      } catch (Exception $e) {
        return $this->Obj_Functions->Message_return(false,'Error!! conexión: '.$e, null,'', true);
      }
    }

    /**
     * Cuerpo contrato que se mostrara en el pdf
     *
     * @return html 
     */
    public function estructuraContratoDeterminado(){
      try {        
        $html = '  <head>
        <meta charset="utf-8">
        <title>Example 1</title>
        <style>
          th, td {
            padding: 15px;
            text-align: left;
          }
        </style>
      </head>
      <body>
        <header class="clearfix">
          <table>
            <tbody>
                <tr style="width:100%;">
                    <td style="text-align: left; max-width:10%;">
                            <img src="https://fibremex.com/fibra-optica/public/images/img_spl/logos/fibremex.png">
                    </td>

                    </td>
                </tr>
            </tbody>
            </table>
          <table>
            <tbody>
              <tr>
                <td class="service">
                <div id="project">
                    <div><span>Facturado a: </span> </div>
                    <div><span>RFC: </span> </div>
                    <div><span>Calle: </span> </div>
                    <div><span>Estado: </span> </div>
                    <div><span>CP: </span> </div>
                    <div><span>País:</span></div>
                </div>
                </td>
                <td class="service">
                <div id="company" class="clearfix">
                <div>No.Documento: '.$_SESSION["Ecommerce-PedidoKey"].' </div>
                <div>455 Foggy Heights,<br /> AZ 85004, US</div>
                <div>(602) 519-0450</div>
                <div><a href="mailto:company@example.com">company@example.com</a></div>
              </div>
                </td>
              </tr>
            </tbody>
          </table><br><br>
        </header>
          <table>
            <thead>
              <tr>
                <th style="text-align: left; padding: 15px;">Articulo</th>
                <th style="text-align: left; padding: 15px;">Descripción</th>
                <th style="text-align: center; padding: 15px;">Cantidad</th>
                <th style="text-align: center; padding: 15px;">Descuento</th>
                <th style="text-align: right; padding: 15px;">Precio Unitario</th>
                <th style="text-align: right; padding: 15px;">Total</th>
              </tr>
            </thead>
            <tbody>';
            $DetalleController = new DetalleController();
            $Obj = $DetalleController->GetDetallePedido();

            if($Obj->count > 0){
                foreach ($Obj->records as $key => $data) {
                    $detalleSubtotal = $data->DetalleSubtotal;
                    $descripcion = !empty($data->ProductoDescripcion) ? $data->ProductoDescripcion : $data->ProductoConfigurableNombre;
                    $html .= '<tr style="width:100%;">
                        <td style="margin-bottom: 10px; text-align: left; max-width:20%;">'. $data->DetalleCodigo .'</td>
                        <td style="margin-bottom: 10px; text-align: left; max-width:40%;">'. $descripcion .'</td>
                        <td style="margin-bottom: 10px; text-align: center; max-width:10%;">'. $data->DetalleCantidad .'</td>
                        <td style="margin-bottom: 10px; text-align: center; max-width:10%;">'.$data->Descuento .'</td>
                        <td style="margin-bottom: 10px; text-align: right; max-width:10%;">$ '. $data->ProductoPrecio .' USD</td>
                        <td style="margin-bottom: 10px; text-align: right; max-width:10%;">$ '. $detalleSubtotal .' USD</td>
                    </tr>';
                }

                $PedidoController = new PedidoController;
                $PedidoController->filter = "WHERE id = ".$_SESSION["Ecommerce-PedidoKey"]." ";
                $PedidoController->order = "";
                # obtención de subtotal iva y total del pedido actual
                $Pedido = $PedidoController->getBy();
                
                    $pedidoSubtotal = $Pedido->GetSubTotal();
                    $pedidoIva = $Pedido->GetIva();
                    $pedidoTotal = $Pedido->GetTotal(); 
               


        $html .= '<tr style="width:100%;">
                    <td style="margin-bottom: 2px; text-align: center; max-width:20%; padding: 15px;"></td>
                    <td style="margin-bottom: 2px; text-align: center; max-width:40%; padding: 15px;"></td>
                    <td style="margin-bottom: 2px; text-align: center; max-width:10%; padding: 15px;"></td>
                    <td style="margin-bottom: 2px; text-align: center; max-width:10%; padding: 15px;"></td>
                    <td style="margin-bottom: 2px; text-align: right; max-width:10%; padding: 15px;">Subtotal</td>
                    <td style="margin-bottom: 2px; text-align: right; max-width:10%; padding: 15px;"> $'.$pedidoSubtotal .' USD </td>
                </tr>
                <tr style="width:100%;">
                    <td style="margin-bottom: 2px; text-align: center; max-width:20%; padding: 15px;"></td>
                    <td style="margin-bottom: 2px; text-align: center; max-width:40%; padding: 15px;"></td>
                    <td style="margin-bottom: 2px; text-align: center; max-width:10%; padding: 15px;"></td>
                    <td style="margin-bottom: 2px; text-align: center; max-width:10%; padding: 15px;"></td>
                    <td style="margin-bottom: 2px; text-align: right; max-width:10%; padding: 15px;">Iva</td>
                    <td style="margin-bottom: 2px; text-align: right; max-width:10%; padding: 15px;"> $'.$pedidoIva .' USD </td>
                </tr>
                <tr style="width:100%;">
                    <td style="margin-bottom: 2px; text-align: center; max-width:20%; padding: 15px;"></td>
                    <td style="margin-bottom: 2px; text-align: center; max-width:40%; padding: 15px;"></td>
                    <td style="margin-bottom: 2px; text-align: center; max-width:10%; padding: 15px;"></td>
                    <td style="margin-bottom: 2px; text-align: center; max-width:10%; padding: 15px;"></td>
                    <td style="margin-bottom: 2px; text-align: right; max-width:10%; padding: 15px;">Total</td>
                    <td style="margin-bottom: 2px; text-align: right; max-width:10%; padding: 15px;"> $'.$pedidoTotal .' USD </td>
                </tr>';

            }
            unset($DetalleController);
            unset($Obj);
            unset($PedidoController);
            unset($Pedido);
            $html .= '</tbody>
             
          </table>
      </body>';
      return $html;

      } catch (Exception $e) {
        throw $e;
      }
    }
  }

$PedidoPDF = new PedidoPDF();
$Response = $PedidoPDF->configurationBuiltPDF();
print_r($Response);
