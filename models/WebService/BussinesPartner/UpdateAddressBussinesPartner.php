<?php 

/**
 * 
 */
  @session_start();
  if (!class_exists("WebService")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/WebService/WebServiceSOAP.php';
  }if (!class_exists("Contacto")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Contacto/Contacto.php';
  }if (!class_exists("Personal")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/B2C/Cuenta/Personal.php';
  }if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
  }

  class UpdateAddressBussinesPartner
  {
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */ 
    public static function update(){
      try {
        $Contacto = new Contacto();
        $EcommContacto_Webservice = $Contacto->show("WHERE id = 1 ",  "", false)->records[0]->ContactoWebservice;

        $Personal = new Personal();
        $PersonalCliente = (object)$Personal->get("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." AND activo='si' ", "", false)->records[0];
     

        $WebServiceSOAP = new WebService(
          "http://".$EcommContacto_Webservice."/WS_BussinesPartner.asmx?WSDL", 
          $PersonalCliente->PersonalCardcode, 
          $PersonalCliente->PersonalPasswordEcommerce, 
          $PersonalCliente->PersonalSociedad, 
          "http://fibremex.com.mx/"
        );

        $UpdateAddressBussinesPartner['UpdateAddressBussinesPartner']['NewAddress'] = [
          'Street'      => $_POST['Calle'],
          'StreetNo'    => $_POST['NumeroExterior'],
          'Block'       => $_POST['Colonia'],
          'County'      => $_POST['Delegacion'],
          'ZipCode'     => $_POST['CodigoPostal'],
          'State'       => $_POST['Estado'],
          'City'        => $_POST['EstadoDescripcion'],
          'AddressName' => $_POST['NombreDireccion'],
          'AddressType' => $_POST['TipoDireccion'],
          'Default'     => false
        ];
        $result = $WebServiceSOAP->ExecuteSoap("UpdateAddressBussinesPartner", $UpdateAddressBussinesPartner, false);
        // print_r($UpdateAddressBussinesPartner);
        // print_r($result);
        unset($WebServiceSOAP);
        unset($Contacto);
        unset($Personal);

      return $result;
      } catch (SoapFault $fault) {
        echo $fault;
      }

    }

  }

  $Tool = new Functions_tools();
  # Comprobación Autorización Ajax    
  if (isset($_SERVER['PHP_AUTH_USER']) && $Tool->securityAjax() && isset($_POST['ActionEnvio'])) { 
    $Result = UpdateAddressBussinesPartner::update();
    echo json_encode($Result);
  }
  unset($Tool);