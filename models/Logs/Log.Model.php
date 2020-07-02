<?php 

class Log_{
    
    protected $Connection;
    protected $Tool;

    public $Title;
    public $ErrorCode;
    public $NumeroPedido;
    public $TypePedido;
    public $ErrorDescription;
    public $SendData;
    public $ResultWService;

    public function SetParameters($conn, $Tool){
        $this->Connection = $conn;
        $this->Tool = $Tool;
    }

    public function SetTitle($Title){
        $this->Title = $Title;
    }public function SetErrorCode($ErrorCode){
        $this->ErrorCode = $ErrorCode;
    }public function SetNumeroPedido($NumeroPedido){
        $this->NumeroPedido = $NumeroPedido;
    }public function SetTypePedido($TypePedido){
        $this->TypePedido = $TypePedido;
    }public function SetErrorDescription($ErrorDescription){
        $this->ErrorDescription = $ErrorDescription;
    }public function SetSendData($SendData){
        $this->SendData = $SendData;
    }public function SetResultWService($ResultWService){
        $this->ResultWService = $ResultWService;
    }

    /**
     * Creación de registro log
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function create(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $result = $this->Connection->Exec_store_procedure_json("CALL Log(
            '".$this->Title."',
            '".$this->ErrorCode."',
            ".$this->NumeroPedido.",
            '".$this->TypePedido."',
            '".$this->ErrorDescription."',
            '".$this->SendData."',
            '".$this->ResultWService."',
          @Result);", "@Result");     
          return $result; 
        } 
      } catch (Exception $e) {
        throw new Exception("No se pudo procesar la información");
      }   
    }

}