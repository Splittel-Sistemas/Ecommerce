<?php 
/**
 * 
 */
  @session_start();
  if (!class_exists("WebService")) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/WebServiceSOAP.php';
  }
  if (!class_exists("Contacto")) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Contacto/Contacto.php';
  }

  class GetStockByLote
  {
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */ 
    public function get($ItemCode,$return_json){
      try {
        $Contacto = new Contacto();
        $EcommContacto_Webservice = $Contacto->show("WHERE id = 1 ",  "", false)->records[0]->ContactoWebservice;
        $WebServiceSOAP = new WebService(
          "http://".$EcommContacto_Webservice."/WS_Ecommerce.asmx?WSDL", 
          "", 
          "", 
          "", 
          "http://fibremex.com.mx/"
        );

        $StockPorLotes['StockPorLotes'] = ['ItemCode' => $ItemCode];
        $result = $WebServiceSOAP->ExecuteSoap("StockPorLotes", $StockPorLotes, false);
        
        if($result){
            echo json_encode($result,true);
        }

        unset($WebServiceSOAP);

      
      } catch (SoapFault $fault) {
        echo $fault;
      }

    }

  }
if(isset($_POST['Codigo']) && $_POST['Codigo']!=''){
    $getStock = new GetStockByLote(); 
    echo $getStock->get($_POST['Codigo'],true);
}
?>