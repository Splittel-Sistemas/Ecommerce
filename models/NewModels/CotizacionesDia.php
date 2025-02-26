<?php
    @session_start();
    if(empty($_SERVER['DOCUMENT_ROOT'])){
        $_SERVER['DOCUMENT_ROOT'] = "/home/fibremex/public_html";
    }
    if (!class_exists("Connection")) {
        require_once $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
    }
    if (!class_exists("Email")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Email/EmailAux.php';
    }
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/NewModels/Usuario.Model.php';
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/NewModels/PedidoDetalle.Model.php';
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/NewModels/EmailTemplate.php';
    use Models\Usuario as UsuarioModel;
    use Models\Detalle as DetalleModel;
    use EmailTemplates\EmailTemplate as EmailTemplate;

    class Controller
    {
        protected $Connection;
        protected $UsuarioModel;
        protected $DetalleModel;
        protected $EmailTemplate;
        protected $Email;

        public function __construct(){
            $this->Connection = new Connection();
            $this->UsuarioModel = new UsuarioModel();
            $this->DetalleModel = new DetalleModel();
            $this->EmailTemplate = new EmailTemplate();
            $this->Email = new Email();
        }
        public function DoConnection($status){
            if($status == true){
                if ($this->Connection->conexion()->connect_error){
                    throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos", 1);
                }
            }else{
                $this->Connection->closeConnection();
                $this->Connection = new Connection();
            }
        }
        public function GetAddressEmail(){
            try{
                if (!$this->Connection->conexion()->connect_error){
                    $SQLSTATEMENT = "select * from t98_ProcesosEmail where t98_pk01 = 2 and t98_f005 = 1";
                    $result = $this->Connection->QueryReturn($SQLSTATEMENT);
                    $List_TO = "";
                    $List_CC = "";
                    $List_BCC = "";
                    while ($row = $result->fetch_object()) {
                        $List_TO = $row->t98_f002 == null ? "" : $row->t98_f002;
                        $List_CC = $row->t98_f003 == null ? "" : $row->t98_f003;
                        $List_BCC = $row->t98_f004 == null ? "" : $row->t98_f004;
                    }
                    return [$List_TO,$List_CC,$List_BCC];
                }
                return null;
            } catch (Exception $e) {
                throw new Exception("No se logró obtener los correos para el proceso No.2", 1);
            }
        }
        public function SendEmail(){
            try {
                $this->DoConnection(true);
                // seleccion dia a generar reporte
                $fechaReporte = date('Y-m-d',strtotime("-1 days"));
                $this->UsuarioModel->SetParameters($this->Connection);
                $resultUsuarioModel = $this->UsuarioModel->Get_bp_cotizaciones('C',$fechaReporte,$fechaReporte);
                $this->DoConnection(false);
                foreach ($resultUsuarioModel as $Customer) {
                    $this->DoConnection(true);
                    $this->DetalleModel->SetParameters($this->Connection);
                    $resultDetalleModel = $this->DetalleModel->Get_bp_cotizaciones('C',$fechaReporte,$fechaReporte,$Customer->id_cliente);
                    $sendEmail = False;
                    $DocumentLines = '
                        <table border="1">
                            <tr><th colspan="6">Productos cotizados</th></tr>
                            <tr><th>Codigo SAP</th><th>Descripción</th><th>Cantidad</th><th>Total(iva)</th><th>Cotización</th><th>Fecha</th></tr>';
                    foreach ($resultDetalleModel as $lines) {
                        $sendEmail = true;
                        $DocumentLines .= '
                            <tr>
                                <td>'.$lines->ItemCode.'</td>
                                <td>'.$lines->Description.'</td>
                                <td>'.$lines->Quantity.'</td>
                                <td> $'.number_format($lines->Total,2).'</td>
                                <td>'.$lines->IdCotizacion.'</td>
                                <td>'.$lines->Fecha.'</td>
                            </tr>';
                    }
                    $DocumentLines .= '</table>';
                    $Body = '
                        <tr><th style="text-align: left;">Cliente: </th><td>'.$Customer->Nombre.' '.$Customer->Apellidos.'</td></tr>
                        <tr><th style="text-align: left;">Telefono: </th><td>'.$Customer->Telefono.'</td></tr>
                        <tr><th style="text-align: left;">Email: </th><td>'.$Customer->Email.'</td></tr>
                        <tr><th style="text-align: left;">Codigo SAP: </th><td>'.($Customer->CardCode == null ? ' -- ' : $Customer->CardCode).'</td></tr>
                        <tr><th style="text-align: left;">Tipo cliente: </th><td>'.$Customer->tipoCliente.'</td></tr>
                    ';
                    
                    $bodyemail = $this->EmailTemplate->body('
                        <p>Reporte de productos cotizados del dia: '.$fechaReporte.'</p>
                        <br>
                        <table border="0">'.$Body.'</table>
                        <br>'.$DocumentLines);
                    // print_r($bodyemail);
                    if($sendEmail == true){
                        try 
                        {
                            $this->Email = new Email();
                            $this->Email->MailerSubject = "Ecommerce: reporte de cotizaciones";
                            $this->Email->MailerBody = $bodyemail;
                            $Correos = $this->GetAddressEmail();
                            print_r($Correos);
                            $this->Email->MailerListTo = explode(";",$Correos[0]);
                            $this->Email->MailerListCC = explode(";",$Correos[1]);
                            $this->Email->MailerListBCC = explode(";",$Correos[2]);
                            echo $lines->EmailEjecutivo;
                            if(!empty($lines->EmailEjecutivo)){
                                $this->Email->MailerListTo[] = $lines->EmailEjecutivo;
                            }
                            // Configurar la zona horaria de México
                            date_default_timezone_set('America/Mexico_City');

                            // Obtener la hora actual
                            $horaActual = date('G');
                            if($horaActual >= 8 && $horaActual <= 9){
                                if($this->Email->EmailSendEmail()){
                                    echo "Correo reporte del cliente: ".$Customer->Nombre." - Enviado <br>";
                                }else{
                                    echo "Correo reporte del cliente: ".$Customer->Nombre." - No enviado <br>";
                                }
                            }
                            unset($Email);
                        } 
                        catch (phpmailerException $e) 
                        {
                            throw $e;
                        }
                    }else{
                        echo "Correo reporte del cliente: ".$Customer->Nombre." - No enviado no existen artidas activas <br>";
                    }
                    
                }
                
                
            } catch (Exception $e) {
                throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos", 1);
            }
        }
        public function Get_bp_cotizaciones($date1,$date2)
        {
            try {
                $this->DoConnection(true);
                $fechaReporte = date('Y-m-d',strtotime("-6 days"));
                $this->UsuarioModel->SetParameters($this->Connection);
                $resultUsuarioModel = $this->UsuarioModel->Get_bp_cotizaciones('C',$date1,$date2);
                // print_r($resultUsuarioModel);
                $this->DoConnection(false);
                $Clientes = '';
                foreach ($resultUsuarioModel as $item) {
                    $Clientes .= '
                    <tr>
                        <th width="90">'.($item->CardCode == null ? ' -- ' : $item->CardCode).'</th>
                        <th>'.$item->Nombre.' '.$item->Apellidos.'</th>
                        <th>'.$item->Telefono.'</th>
                        <th>'.$item->Email.'</th>
                        <th>'.$item->tipoCliente.' - '.$item->id_cliente.'</th>
                    </tr>
                    <tr>
                        <td colspan="5"> 
                            <table>
                    ';
                    $this->DoConnection(true);
                    $this->DetalleModel->SetParameters($this->Connection);
                    $resultDetalleModel = $this->DetalleModel->Get_bp_cotizaciones('C',$date1,$date2,$item->id_cliente);
                    foreach ($resultDetalleModel as $lines) {
                        $Clientes .= '
                                <tr>
                                    <td>'.$lines->ItemCode.'</td>
                                    <td>'.$lines->Description.'</td>
                                    <td>'.$lines->Quantity.'</td>
                                    <td> $'.number_format($lines->Total,2).'</td>
                                    <td>'.$lines->IdCotizacion.'</td>
                                    <td>'.$lines->Fecha.'</td>
                                </tr>';
                    }
                    $Clientes .= '
                            </table>
                        </td>
                    </tr>';
                    // print_r($resultDetalleModel);
                    $this->DoConnection(false);
                    unset($resultDetalleModel);
                }
                $bodyemail = $this->EmailTemplate->body('<p>Reporte de productos cotizados del dia: '.$date1.'</p><br><table border="1">'.$Clientes.'</table>');
                print_r($bodyemail);
                    // $this->Email = new Email();
                    // $this->Email->MailerSubject = "Ecommerce";
                    // $this->Email->MailerBody = $bodyemail;
                    // $this->Email->MailerListTo = "015017000@upq.edu.mx";
                    // $this->Email->MailerListBCC = "luis.martinezh13@gmail.com";
                    // $this->Email->EmailSendEmail();
                    // unset($Email);

            } catch (Exception $e) {
                throw new Exception("No se pudo guardar la información solicitada, si el problema persiste por favor contactanos", 1);
            }
        }
    }
    $Controller = new Controller();
    $Controller->SendEmail();
    // if(isset($_GET['Test']) &&  $_GET['Test'] == "yes"){

    //     $Controller->Get_bp_cotizaciones($_GET['Date1'],$_GET['Date2']);
    // }else if(isset($_GET['Production']) &&  $_GET['Production'] == "yes"){
    //     $Controller->SendEmail();
    // }else{
    //     echo "parametro incorrecto";
    // }
    
    

?>