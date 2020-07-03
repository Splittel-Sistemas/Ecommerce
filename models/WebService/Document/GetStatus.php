<?php 

/**
 * 
 */
  @session_start();
  if (!class_exists("WebService")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/WebServiceSOAP.php';
  }if (!class_exists("Contacto")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Contacto/Contacto.php';
  }if (!class_exists("Personal")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/B2C/Cuenta/Personal.php';
  }if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
  }

  class GetStatus
  {
    public $DocNum;
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */ 

    public  function __construct(){
      $this->Tool = new Functions_tools();
    }

    public function get($return_json){
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

        $GetStatus['GetStatus'] = ['DocNum' => $this->DocNum];

        $result = $WebServiceSOAP->ExecuteSoap("GetStatus", $GetStatus, false);
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

    public static function controller(){
      $GetStatus = new GetStatus();
      $Action = $GetStatus->Tool->validate_isset('Action');
      switch ($Action) {
        case 'get':
          $GetStatus->DocNum = $GetStatus->Tool->validate_isset('DocNum');
          echo $GetStatus->get(true);
          break;
        default:
          echo $GetStatus->Tool->Message_return(true, "ertyui", null, true);
          break;
      }
    }

  }

  GetStatus::controller();