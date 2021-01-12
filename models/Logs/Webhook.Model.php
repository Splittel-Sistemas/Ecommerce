<?php 


  /**
   * 
   */
  class Webhook{

    public $Key;
    public $Titulo;
    public $PedidoKey;
    public $PedidoTipo;
    public $Estatus;
    public $Data;
    public $Metodo;
    
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetKey($Key){
      if(is_null($Key)){
        throw new Exception('$Key No puede ser un valor nulo');
      }
      $this->Key = $Key;
    }public function SetTitulo($Titulo){
      $this->Titulo = $Titulo;
    }public function SetPedidoKey($PedidoKey){
      if(is_null($PedidoKey)){
        throw new Exception('$PedidoKey No puede ser un valor nulo');
      }
      $this->PedidoKey = $PedidoKey;
    }public function SetPedidoTipo($PedidoTipo){
      $this->PedidoTipo = $PedidoTipo;
    }public function SetEstatus($Estatus){
      $this->Estatus = $Estatus;
    }public function SetData($Data){
      if(is_null($Data)){
        throw new Exception('$Data No puede ser un valor nulo');
      }
      $this->Data = $Data;
    }public function SetMetodo($Metodo){
      if(is_null($Metodo)){
        throw new Exception('$Metodo No puede ser un valor nulo');
      }
      $this->Metodo = $Metodo;
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function getAll(){
      try {
        $SQLSTATEMENT = "SELECT * FROM t12_open_pay_webhook_log";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];
        while ($row = $result->fetch_object()) {
          $WebhookEventos = new WebhookEventos();
          $WebhookEventos->Key	 				= $row->t13_pk01;
          $WebhookEventos->Titulo	 			= $row->t13_f001;
          $WebhookEventos->PedidoKey	 	= $row->t13_f002;
          $WebhookEventos->PedidoTipo		= $row->t13_f003;
          $WebhookEventos->Estatus			= $row->t13_f004;
          $WebhookEventos->Data					= $row->t13_f005;
          $WebhookEventos->Metodo				= $row->t13_f006;
          $data[] = $WebhookEventos;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
       }
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM t12_open_pay_webhook_log ".$filter." ".$order;
        echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;
        while ($row = $result->fetch_object()) {
          $this->Key	 				= $row->t13_pk01;
          $this->Titulo	 			= $row->t13_f001;
          $this->PedidoKey	 	= $row->t13_f002;
          $this->PedidoTipo		= $row->t13_f003;
          $this->Estatus			= $row->t13_f004;
          $this->Data					= $row->t13_f005;
          $this->Metodo				= $row->t13_f006;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
       }
    }

    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
    */
    public function create(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL LogWebhook(
          '".$this->Titulo."',
          ".$this->PedidoKey.",
          '".$this->PedidoTipo."',
          '".$this->Estatus."',
          '".$this->Data."',
          '".$this->Metodo."',
          @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
       }
    }

     /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
    */
    public function update(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL WebhookEnviarCorreo(
          ".$this->PedidoKey.",
          '".$this->Estatus."',
          @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
       }
    }
  }