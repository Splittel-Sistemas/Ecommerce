<?php 

	/**
	 * 
	 */
  @session_start();
  if (!class_exists("WebService")) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/WebServiceSOAP.php';
  }if (!class_exists("Contacto")) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/store/models/Contacto/Contacto.php';
  }if (!class_exists("Personal")) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/store/models/B2C/Cuenta/Personal.php';
  }if (!class_exists("GetCurrencyRate")) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/Currency/GetCurrencyRate.php';
  }
  
	class ValidCredit{

    public $Importe;
    public $DocCur;
    public $TipoCambio;
		
		/**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */ 
    public function get($return_json){
      try {
        $Contacto = new Contacto();
        $EcommContacto_Webservice = $Contacto->show("WHERE id = 1 ",  "", false)->records[0]->ContactoWebservice;

        $Personal = new Personal();
        $PersonalCliente = (object)$Personal->get("WHERE id_cliente = ".$_SESSION['id_b2b_cliente']." AND activo='si' ", "", false)->records[0];
        
        $WebServiceSOAP = new WebService(
          "http://".$EcommContacto_Webservice."/WS_BussinesPartner.asmx?WSDL", 
          $PersonalCliente->PersonalCardcode, 
          $PersonalCliente->PersonalPasswordEcommerce, 
          $PersonalCliente->PersonalSociedad, 
          "http://fibremex.com.mx/"
        );

        $GetCurrencyRate = new GetCurrencyRate();
        $responseGetCurrencyRate = $GetCurrencyRate->get();

        $ValidCredit['ValidCredit'] = [
        	"CardCode" => $PersonalCliente->PersonalCardcode,
        	"importe" => $this->Importe,
        	"DocCur" => $this->DocCur, //tipo de moneda usd mxp
        	// "tipoCambio" => 
        ];

        $result = $WebServiceSOAP->ExecuteSoap("ValidCredit", $ValidCredit, $return_json);

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


 ?>