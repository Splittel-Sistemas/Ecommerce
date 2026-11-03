<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
error_reporting(E_ALL);
ini_set('display_errors', '1');

echo '<pre>';

echo "Antes de session_start:\n";
var_dump(session_status());
var_dump(session_save_path());
var_dump(session_id());

echo "\nEjecutando session_start:\n";
$resultado = session_start();

var_dump($resultado);
var_dump(session_status());
var_dump(session_id());

echo "\nÚltimo error:\n";
var_dump(error_get_last());

echo "\nContenido de SESSION:\n";
var_dump($_SESSION ?? null);

echo '</pre>';

exit;
  if (!class_exists("Seguridad")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Seguridad/Seguridad.Controller.php';
  }if (!class_exists("WebService")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/WebService/WebServiceSOAP.php';
  }if (!class_exists("Contacto")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Contacto/Contacto.php';
  }if (!class_exists("Personal")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/B2C/Cuenta/Personal.php';
  }if (!class_exists("Functions_tools")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
  }

  class GetShipToAdressByAddressName{
    public $AddressName;
    public $Street;
    public $StreetNo;
    public $Block;
    public $ZipCode;
    public $State;
    public $County;
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */ 
    public function get(){
      try {
        @session_start();
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

        $GetShipToAdressByAddressName['GetShipToAdressByAddressName'] = [
          'AddressNam' => $this->AddressName
        ];
        $result = $WebServiceSOAP->ExecuteSoap("GetShipToAdressByAddressName", $GetShipToAdressByAddressName, false);
        // print_r($GetShipToAdressByAddressName);
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

  $SeguridadController = new SeguridadController();
	# Comprobación Autorización Ajax    
	if ($SeguridadController->decryptData() && isset($_POST['ActionEnvio'])) { 
    $Result = GetShipToAdressByAddressName::create();
    echo json_encode($Result);
  }
  unset($SeguridadController);
    /*$_POST['NombreDireccion'] = 'ENVIO DE CATALOGO 2020';
    $Result = GetShipToAdressByAddressName::create();
    print_r($Result->GetShipToAdressByAddressNameResult);
    print_r($Result->GetShipToAdressByAddressNameResult->Record);*/

