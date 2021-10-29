<?php
@session_start();
@header('Content-Type: charset=utf-8');
date_default_timezone_set('America/Mexico_City');
class Functions_tools
{
    /**
     * funcion para validar fechas
     *
     * @param [type] $date1
     * @param [type] $date2
     * @return boolean
     */
    public function isValidRangeHours($hour1, $hour2){
        $newHour = strtotime( date('H:i'));
        $hour1 = strtotime( date($date1));
        $hour2 = strtotime( date($date2));
        if($hour1 < $newHour){
            throw new Exception("El campo <strong></strong> debe de ser mayor a la fecha del día de hoy ");
        }
        if($hour2 < $newHour){
            throw new Exception("El campo <strong></strong> debe de ser mayor a la fecha del día de hoy ");
        }
        if($hour1 == $hour2){
            throw new Exception("El campo <strong></strong> es igual que El campo <strong></strong> ");
        }else if($hour1 >  $hour2){
            throw new Exception("El campo <strong></strong> es mayor que El campo <strong></strong> ");
        }
    }
    /**
     * funcion para validar fecha y tiempo(datatime)
     *
     * @param [type] $date1
     * @param [type] $date2
     * @return boolean
     */
    public function isValidRangeDates($date1, $date2){
        $newDate = strtotime( date('d-m-Y H:i:s'));
        $datetime1 = strtotime( date($date1['value']));
        $datetime2 = strtotime( date($date2['value']));
        if($datetime1 < $newDate){
            throw new Exception("El campo <strong>".$date1['label']."</strong> debe de ser mayor a la fecha del día de hoy");
        }
        if($datetime2 < $newDate){
            throw new Exception("El campo <strong>".$date2['label']."</strong> debe de ser mayor a la fecha del día de hoy");
        }
        if($datetime2 < $newDate){
            throw new Exception("El campo <strong>".$date1['label']."</strong> es igual que El campo <strong>".$date2['label']."</strong> ");
        }
        if($datetime1 == $datetime2){
            throw new Exception("El campo <strong>".$date1['label']."</strong> es igual que El campo <strong>".$date2['label']."</strong> ");
        }else if($datetime1 >  $datetime2){
            throw new Exception("El campo <strong>".$date1['label']."</strong> es mayor que El campo <strong>".$date2['label']."</strong> ");
        }
    }
    public function  activeSession(){
        if(isset($_SESSION['USER_ID'])){
            return true;
        }else{
            throw new Exception("Por favor inicia sesión");
        }
    }
    public function validate_isset($name){
        return isset($_REQUEST[$name]) && $_REQUEST[$name] != null ? $_REQUEST[$name] : "";
    }
    public function validate_isset_post($name){
        return isset($_POST[$name]) && $_POST[$name] != null ? $_POST[$name] : "";
    }
    public function Message_return($error,$message,$records,$return_json){
        $object          = new stdClass();
        $object->error   = ($records == null ? $error : count($records) == 0) ? true: false;
        $object->message = $this->validate_array($records, $message);
        $object->records = $records;
        $object->count  = $records == null ? 0 : count($records);
        return $return_json == true ? json_encode($object, JSON_UNESCAPED_UNICODE) : $object;
    }
    public function validate_array($records,$message){
        $message_r = "";
        if($records == null){
            if($message == null){
                $message_r = "No existen datos para mostrar";
            }else{
                $message_r = $message;
            }
        }else{
            if($message == null){
                $message_r = "Datos obtenidos exitosamente";
            }else{
                $message_r = $message;
            }
        }
        return $message_r;
    }
    public function Clear_data_for_sql($data){
        $data = str_replace("'","''",$data);

        return $data;
    }
    public function validDataString($post,$nameUser,$isRequided){
        $data = $this->validate_isset_post($post);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (is_string($data)) {
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
            }
        }
    }
    public function validEmail($post,$nameUser,$isRequided){
        $data = $this->validate_isset_post($post);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (preg_match ("/^[a-zA-Z0-9_\-\.~]{2,}@[a-zA-Z0-9_\-\.~]{2,}\.[a-zA-Z]{2,4}$/", $data)) { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
            }
        }
    }
    public function validEmail_($data,$nameUser,$isRequided){
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (preg_match ("/^[a-zA-Z0-9_\-\.~]{2,}@[a-zA-Z0-9_\-\.~]{2,}\.[a-zA-Z]{2,4}$/", $data)) { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
            }
        }
    }
    public function validCurp($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (preg_match ("/^[A-Z][A,E,I,O,U,X][A-Z]{2}[0-9]{2}[0-1][0-9][0-3][0-9][M,H][A-Z]{2}[B,C,D,F,G,H,J,K,L,M,N,Ñ,P,Q,R,S,T,V,W,X,Y,Z]{3}[0-9,A-Z][0-9]$/", $data)) { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
            }
        }
    }
    public function validPhoneNumber($post,$nameUser,$isRequided){
        $data = $this->validate_isset_post($post);
        if($isRequided){
            if($data == ""){
                throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
            }else{
                if (preg_match ("/^[0-9]{10}$/", $data)) { 
                    return $this->Clear_data_for_sql($data);
                } else {
                    throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido, debe de ser conformado por 10 digitos númericos'");
                }
            }
        }else{
            if($data != ""){
                if (preg_match ("/^[0-9]{10}$/", $data)) { 
                    return $this->Clear_data_for_sql($data);
                } else {
                    throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido, debe de ser conformado por 10 digitos númericos'");
                }
            }
        }
    }
    public function validRFC($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (preg_match ("/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/", $data)) { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
            }
        }
    }
    public function validRFC_($data,$nameUser,$isRequided){
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (preg_match ("/^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/", $data)) { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
            }
        }
    }
    public function validCodigoPostal_($data,$nameUser,$isRequided){
        if($isRequided){
            if($data == ""){
                throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
            }else{
                if (preg_match ("/^[0-9]{5}$/", $data)) { 
                    return $this->Clear_data_for_sql($data);
                } else {
                    throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
                }
            }
        }else{
            if($data != ""){
                if (preg_match ("/^[0-9]{5}$/", $data)) { 
                    return $this->Clear_data_for_sql($data);
                } else {
                    throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
                }
            }
        }
    }
    public function validCodigoPostal($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided){
            if($data == ""){
                throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
            }else{
                if (preg_match ("/^[0-9]{5}$/", $data)) { 
                    return $this->Clear_data_for_sql($data);
                } else {
                    throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
                }
            }
        }else{
            if($data != ""){
                if (preg_match ("/^[0-9]{5}$/", $data)) { 
                    return $this->Clear_data_for_sql($data);
                } else {
                    throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
                }
            }
        }
    }
    public function validSchedule($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (preg_match ("/^[A-Z]{3}\.[A-Z0-9]{2}$/", $data)) { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
            }
        }
    }
    public function validDate($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (preg_match ("/^[A-Z]{3}\.[A-Z0-9]{2}$/", $data)) { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
            }
        }
    }
    public function validNumber($get,$nameUser,$isRequided){
        $data = $this->validate_isset_post($get);
        if($isRequided && $data == ""){
            throw new Exception("El campo: <strong>".$nameUser."</strong> es requerido");
        }else{
            if (is_numeric($data) || $data == "") { 
                return $this->Clear_data_for_sql($data);
            } else {
                throw new Exception("El campo: <strong>".$nameUser."</strong> no es valido");
            }
        }
    }
    public function mes($index){
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        return $meses[$index];
    }
    public function Dias($index){
        $meses = array("Dom","Lun", "Mar", "Mier", "Jue", "Vie", "Sab");
        return $meses[$index];
    }
    /**
     * Creación nueva carpeta si es que no existe en la ruta asiganada
     *
     * @param string $directory
     *
     */
    public function createFolder($directory){
      if (!is_dir($directory)) {
        @mkdir($directory, 0007);
      }
    }

    /**
     * Autorización via ajax mediante usuario y contraseña desencriptados
     *
     * @return boolean
     */
    public function securityAjax(){
      if (!class_exists('EncrypData_')) {
        include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/WebService/EncrypData.php';
      }
        $EncrypData = new EncrypData_('prueba');

        if (isset($_SESSION['Ecommerce-ClienteKey'])) {
            if (!class_exists("Cliente")) {
              include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Cliente/Cliente.Model.php';
            }
            $ClienteModel = new Cliente(); 
            $Connection = new Connection();
            $Tool = new Connection();
            if (!$Connection->conexion()->connect_error) {
                $ClienteModel->SetParameters($Connection, $Tool);
                $ClienteExiste = $ClienteModel->GetBy("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." ");
                if ($ClienteExiste) {
                $Usuario = $_SESSION['Ecommerce-ClienteEmail'];
                $Password = $ClienteModel->GetPassword().'-'.$_SESSION['Ecommerce-ClienteTipo'].'-'.$ClienteModel->GetFechaIngreso();
                }else{
                throw new Exception("¡No se encuentra registrado aún!");
                }
            }
          }else{
            $Usuario = 'anonimo@fibremex.com.mx';
            $Password = 'Fibremex-Ecommerce-anonimo-'.date('Y-m-d');
          }

        $PHP_AUTH_USER = $EncrypData->cadenaDecrypt($_SERVER['PHP_AUTH_USER']);
        $PHP_AUTH_PW = $EncrypData->cadenaDecrypt($_SERVER['PHP_AUTH_PW']);
        
        return ($PHP_AUTH_USER == $Usuario) || ($PHP_AUTH_PW == $Password) ? true : false;
    }

    public function validateSession($name){
        if(!isset($name) || $name = null){
            throw new Exception("no existe o no contiene ningun valor ".$name." ");
        }
    }

    public function CalcularDescuento($discountProduct){
        try {
            $discountRate = 0; // inicializar porcentaje de descuento
            $discountClient = $_SESSION['Ecommerce-ClienteDescuento']; // descuento cliente b2b
            if($discountProduct != 0 && isset($_SESSION['Ecommerce-ClienteTipo']) && $_SESSION['Ecommerce-ClienteTipo'] == 'B2B'){
                $discountRate = $discountClient >= $discountProduct ? $discountProduct : $discountClient;
            }
            return $discountRate;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function validate_sin_stock($intentos){
        try {
            if(($intentos % 25) == 0 || $intentos == 0){
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function vaidateHttps(){
        try {
            $isHttps = 'http';
            if(isset($_SERVER['HTTPS'])){
                if ($_SERVER['HTTPS']) {
                    $isHttps = 'https';
                }
            }
            return $isHttps;
        } catch (Exception $e) {
          throw $e;
        }
    }
}