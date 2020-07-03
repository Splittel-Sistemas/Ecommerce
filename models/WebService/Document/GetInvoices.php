<?php 

/**
 * 
 */
  @session_start();
  if (!class_exists("WebService")) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/WebServiceSOAP.php';
  }if (!class_exists("Contacto")) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Contacto/Contacto.php';
  }if (!class_exists("Personal")) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/B2C/Cuenta/Personal.php';
  }

  class GetInvoices
  {
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */ 
    public static function get($return_json){
      try {
        $Contacto = new Contacto();
        $EcommContacto_Webservice = $Contacto->show("WHERE id = 1 ",  "", false)->records[0]->ContactoWebservice;

        $Personal = new Personal();
        $PersonalCliente = (object)$Personal->get("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND activo='si' ", "", false)->records[0];

        $WebServiceSOAP = new WebService(
          "http://".$EcommContacto_Webservice."/WS_Document.asmx?WSDL", 
          $PersonalCliente->PersonalCardcode, 
          $PersonalCliente->PersonalPasswordEcommerce, 
          $PersonalCliente->PersonalSociedad, 
          "http://fibremex.com.mx/"
        );

        $result = $WebServiceSOAP->ExecuteSoap("GetInvoices", [], $return_json);
        // print_r($result);

        unset($WebServiceSOAP);
        unset($Contacto);
        unset($Personal);
        unset($PersonalCliente);

      return $return_json ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result;
      } catch (SoapFault $fault) {
        echo $fault;
      }

    }

  }

  // GetInvoices::get(true);