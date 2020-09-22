<?php 

/**
 * 
 */
  @session_start();
  if (!class_exists("Connection")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
  }if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists("WebService")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/WebServiceSOAP.php';
  }if (!class_exists("Contacto_")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Contacto/Contacto.Model.php';
  }if (!class_exists("Cliente")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Cliente/Cliente.Model.php';
  }

  class GetCurrencyRateController{

    protected $conn;
    protected $Tool;
    protected $Sociedad = 'FIBREMEX';

    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */ 
    public function get(){
      try {
        if (!$this->conn->conexion()->connect_error) {
            $ContactoModel = new Contacto_();
            $ContactoModel->SetParameters($this->conn, $this->Tool);
            $ContactoExiste = $ContactoModel->GetBy();
            if ($ContactoExiste) {
              $WebServiceSOAP = new WebService(
                "http://".$ContactoModel->GetWebservice()."/WS_Currency.asmx?WSDL", 
                "", 
                "", 
                $this->Sociedad, 
                "http://fibremex.com.mx/"
              );

              $GetCurrencyRate['GetCurrencyRate'] = [
                'Currency' => 'USD',
                'refDate' => date('Y-m-d')
              ];

              $result = $WebServiceSOAP->ExecuteSoap("GetCurrencyRate", $GetCurrencyRate, false);

              unset($WebServiceSOAP);
              unset($ContactoModel);
              unset($ContactoExiste);

              return $result;
            }else{
              unset($ContactoModel);
              unset($ContactoExiste);
              throw new Exception("No se encuentra información acerca del contacto!");
            }
        }else{
          throw new Exception("No hay datos maestros! por favor contacta con tu ejecutivo");
        }
      }catch (Exception $e){
        throw $e;
      }
    }

  }