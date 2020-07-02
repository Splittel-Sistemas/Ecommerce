<?php 

/**
 * 
 */
  @session_start();
  if (!class_exists("WebService")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/WebServiceSOAP.php';
  }if (!class_exists("Contacto_")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Contacto/Contacto.Controller.php';
  }

  class UpdatePasswordController
  {
    protected $Sociedad = "FIBREMEX";
    public $CardCode;
    public $Password;
    
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */ 
    public function update(){
      try {
        $ContactoController = new ContactoController();
        $ContactoController->filter = "";
        $ContactoController->order = "";
        $Contacto = $ContactoController->get(false)->records[0];



        $WebServiceSOAP = new WebService(
          "http://".$Contacto->Webservice."/WS_BussinesPartner.asmx?WSDL", 
          "", 
          "", 
          $this->Sociedad, 
          "http://fibremex.com.mx/"
        );

        $UpdatePassword['UpdatePassword'] = [
          'CardCode' => $this->CardCode,
          'Password' => $this->Password,
          'Sociedad' => $this->Sociedad
        ];

        $result = $WebServiceSOAP->ExecuteSoap("UpdatePassword", $UpdatePassword, false);

        unset($WebServiceSOAP);
        unset($ContactoController);

        return $result;
      } catch (SoapFault $fault) {
        echo $fault;
      }

    }
    
  }