<?php 

/**
 * 
 */
  @session_start();
  ini_set('default_socket_timeout', 6000);
  if (!class_exists("WebService")) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/WebServiceSOAP.php';
  }if (!class_exists("Contacto")) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/store/models/Contacto/Contacto.php';
  }if (!class_exists("Personal")) {
    require_once $_SERVER["DOCUMENT_ROOT"].'/store/models/B2C/Cuenta/Personal.php';
  }

  class GetBillToAdress
  {
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
        if ($_SESSION['Ecommerce-ClienteTipo'] == "B2B") {
          $PersonalCliente = (object)$Personal->get("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND activo='si' ", "", false)->records[0];
        }else{
          $PersonalCliente = (object)$Personal->getB2C("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND activo='si' ", "", false)->records[0];
        }

        $WebServiceSOAP = new WebService(
          "http://".$EcommContacto_Webservice."/WS_BussinesPartner.asmx?WSDL", 
          $PersonalCliente->PersonalCardcode, 
          $PersonalCliente->PersonalPasswordEcommerce, 
          $PersonalCliente->PersonalSociedad, 
          "http://fibremex.com.mx/"
        );

        $GetBillToAdress['GetBillToAdress'] = ['CardCode' => $PersonalCliente->PersonalCardcode];

        $result = $WebServiceSOAP->ExecuteSoap("GetBillToAdress", $GetBillToAdress, $return_json);

        unset($WebServiceSOAP);
        unset($Contacto);
        unset($Personal);
        unset($PersonalCliente);

      return $return_json ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result;
      } catch (SoapFault $fault) {
        echo $fault;
      }

    }
    public function Run(){
      $PersonalCliente = $this->GetInfoCliente();
      $EcommContacto_Webservice = $this->GetInfoWebService();
      return $this->ExcuteService(false,$PersonalCliente,$EcommContacto_Webservice );
    }
    private function ExcuteService($return_json,$PersonalCliente,$EcommContacto_Webservice){
      try {
        $WebServiceSOAP = new WebService(
          "http://".$EcommContacto_Webservice."/WS_BussinesPartner.asmx?WSDL", 
          $PersonalCliente->PersonalCardcode, 
          $PersonalCliente->PersonalPasswordEcommerce, 
          $PersonalCliente->PersonalSociedad, 
          "http://fibremex.com.mx/"
        );
        $GetBillToAdress['GetBillToAdress'] = ['CardCode' => $PersonalCliente->PersonalCardcode];
        $result = $WebServiceSOAP->ExecuteSoap("GetBillToAdress", $GetBillToAdress, $return_json);
        while($result->GetBillToAdressResult->ErrorCode == 20){
            $result = $WebServiceSOAP->ExecuteSoap("GetBillToAdress", $GetBillToAdress, $return_json);
        }
        unset($WebServiceSOAP);
        return $result;
      } catch (SoapFault $fault) {
        $this->ExcuteService($return_json,$PersonalCliente,$EcommContacto_Webservice);
      }
      
    }
    private function GetInfoWebService(){
        $Contacto = new Contacto();
        $EcommContacto_Webservice = $Contacto->show("WHERE id = 1 ",  "", false)->records[0]->ContactoWebservice;
        unset($Contacto);
        return $EcommContacto_Webservice;
    }
    private function GetInfoCliente(){
      $Personal = new Personal();
      if ($_SESSION['Ecommerce-ClienteTipo'] == "B2B") {
        $PersonalCliente = (object)$Personal->get("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND activo='si' ", "", false)->records[0];
      }else{
        $PersonalCliente = (object)$Personal->getB2C("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND activo='si' ", "", false)->records[0];
      }
      unset($Personal);
      return $PersonalCliente;
    }
    // public function Example(){
      
    //   require_once $_SERVER["DOCUMENT_ROOT"].'/store/models/Librerias/nusoap/lib/nusoap.php';
    //   require_once $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/EncrypData.php';
      
    //   $cliente = new nusoap_client('http://201.116.205.21:64616/WS_BussinesPartner.asmx?WSDL');
    //   $cliente->namespaces['fib'] = 'http://fibremex.com.mx/';
    //   //print_r($cliente);
    //   $PersonalCliente = $this->GetInfoCliente();
    //   $EcommContacto_Webservice = $this->GetInfoWebService();
      
    //   // encryptar contrasena
    //   $WS_Usuario = $PersonalCliente->PersonalCardcode;
    //   $encryp = new EncrypData_($WS_Usuario);
    //   $WS_Password = $encryp->cadenaEncrypt($PersonalCliente->PersonalPasswordEcommerce);
    //   $WS_Sociedad = $PersonalCliente->PersonalSociedad;
    //   $headerbody = array('Usuario' => array('UserKey'=>$WS_Usuario , 'Password'=>$WS_Password,'Society' => $WS_Sociedad)); 
    //   $cliente->setHeaders($headerbody);
    //   // print_r($cliente);
    //   $resultado = $cliente->call('GetBillToAdress',$EcommContacto_Webservice);
    //   if ($cliente->fault) {
    //     echo '<h2>Fault</h2><pre>';
    //     print_r($result);
    //     echo '</pre>';
    //   } else {
    //     // Check for errors
    //     $err = $cliente->getError();
    //     if ($err) {
    //       // Display the error
    //       echo '<h2>Error</h2><pre>' . $err . '</pre>';
    //     } else {
    //       // Display the result
    //       echo '<h2>Result</h2><pre>';
    //       print_r($result);
    //       echo '</pre>';
    //     }
    //   }
    //   print_r($resultado);
    // }

  }