<?php 
    @session_start();
    if (!class_exists("Connection")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
    }
    if (!class_exists("Functions_tools")) {
        include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
    }
    class LogSystem{
        public $Log_key = array(
            'value' => null,
            'SQl_field' => 't99_pk01'
        );
        public $Log_Error = array(
            'value' => null,
            'SQl_field' => 't99_f002'
        );
        public $Log_NumDoc = array(
            'value' => null,
            'SQl_field' => 't99_f003'
        );
        public $Log_Message = array(
            'value' => null,
            'SQl_field' => 't99_f004'
        );
        public $Log_Request = array(
            'value' => null,
            'SQl_field' => 't99_f005'
        );
        public $Log_Response = array(
            'value' => null,
            'SQl_field' => 't99_f006'
        );
        public $Log_Datetime = array(
            'value' => null,
            'SQl_field' => 't99_f099'
        );
        public $Log_typeEcommerce = array(
            'value' => null,
            'SQl_field' => 't99_f007'
        );
        private $ConnectionMysql;
        private $Tools;

        public function __construct(){
            $this->ConnectionMysql = new Connection();
            $this->Tools = new Functions_tools();
        }        

        public function List_Log($where, $order,$return_json){
            try{
                if(!$this->ConnectionMysql->conexion()->connect_error){
                    $SQLSTATEMENT = " SELECT * FROM t99_log ".$where." ".$order; 
                    // print_r($SQLSTATEMENT);
                    $result = $this->ConnectionMysql->QueryReturn($SQLSTATEMENT);
                    $items = array();
                    while ($fila = $result->fetch_assoc()) {
                        $obj = new LogSystem();
                        $obj->Log_key['value'] = $fila['t99_pk01'];
                        $obj->Log_Error['value'] = $fila['t99_f002'];
                        $obj->Log_NumDoc['value'] = $fila['t99_f003'];
                        $obj->Log_Message['value'] = $fila['t99_f004'];
                        $obj->Log_Request['value'] = $fila['t99_f005'];
                        $obj->Log_typeEcommerce['value'] = $fila['t99_f007'];
                        $obj->Log_Response['value'] = $fila['t99_f006'];
                        $obj->Log_Datetime['value'] = $fila['t99_f099'];

                        $items[] = $obj;
                        unset($obj);
                    }
                    return $this->Tools->Message_return(false,"Datos obtenidos",$items,$return_json);
                }else{
                    echo $this->Tools->Message_return(true,"Error!!, No existe conexión",null,$return_json);
                }
            }
            catch (Exception $e) {
                throw $e;
            }
        }
    }

?>