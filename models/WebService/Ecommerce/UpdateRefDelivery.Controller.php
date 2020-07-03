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

  class UpdateRefDeliveryController{

    protected $conn;
    protected $Tool;

    public $NumEcommerce;
    public $ClienteKey;
    public $DateDelivery;
    public $Received;

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
    public function create(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $ClienteModel = new Cliente(); 
          $ClienteModel->SetParameters($this->conn, $this->Tool);
          $ClienteExiste = $ClienteModel->GetBy("WHERE id_cliente = ".$this->ClienteKey." ");
          if ($ClienteExiste) {
            $ContactoModel = new Contacto_();
            $ContactoModel->SetParameters($this->conn, $this->Tool);
            $ContactoExiste = $ContactoModel->GetBy();
            if ($ContactoExiste) {
              $WebServiceSOAP = new WebService(
                "http://".$ContactoModel->GetWebservice()."/WS_Ecommerce.asmx?WSDL", 
                $ClienteModel->GetCardCode(), 
                $ClienteModel->GetPasswordB2b(), 
                $ClienteModel->GetSociedad(), 
                "http://fibremex.com.mx/"
              );

              $UpdateRefDelivery['UpdateRefDelivery'] = [
                "NumEcommerce" => $this->NumEcommerce,
                "ClienteKey" => $this->ClienteKey,
                "DateDelivery" => $this->DateDelivery,
                "Received" => $this->Received
              ];
              // print_r($UpdateRefDelivery);
              $result = $WebServiceSOAP->ExecuteSoap("UpdateRefDelivery", $UpdateRefDelivery, false);
              // print_r($result);
              unset($WebServiceSOAP);
              unset($ContactoModel);
              unset($ContactoExiste);
              unset($ClienteModel);
              unset($ClienteExiste);

              return $result;
            }else{
              unset($ContactoModel);
              unset($ContactoExiste);
              unset($ClienteModel);
              unset($ClienteExiste);
              throw new Exception("No se encuentra información acerca del contacto!");
            }
          }else{
            unset($ClienteModel);
            unset($ClienteExiste);
            throw new Exception("No se encuentra información acerca del cliente!");
          }
        }else{
          throw new Exception("No hay datos maestros! por favor contacta con tu ejecutivo");
        }
      }catch (Exception $e){
        echo $e->getMessage();
      }
    }

  }