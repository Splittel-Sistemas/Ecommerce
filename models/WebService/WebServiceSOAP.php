<?php

if (!class_exists("EncrypData_")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/EncrypData.php';
}
class WebService{
    protected $WS_Usuario;
    protected $WS_Password;
    protected $WS_Sociedad;
    protected $WS_Host;
    protected $WS_Uri;
    public $soap_client;
    /**
     * Undocumented function
     *
     * @param [type] $WS_Host
     * @param [type] $WS_Usuario
     * @param [type] $WS_Password
     */
    public function __construct($WS_Host,$WS_Usuario,$WS_Password,$ClienteSociedad ,$WS_Uri){
        $this->WS_Host = $WS_Host;
        $this->WS_Usuario = $WS_Usuario;
        $this->WS_Password = $WS_Password;
        $this->WS_Sociedad = $ClienteSociedad;
        $this->WS_Uri = $WS_Uri;
    }
    /**
     * Undocumented function
     *
     * @param [type] $method
     * @param [type] $parameters
     * @return void
     */
    public function ExecuteSoap($method, $parameters, $json_result = true)
    {
        try {
            // ini_set('soap.wsdl_cache_enabled', 0);
            // ini_set('soap.wsdl_cache_ttl', 900);
            ini_set('default_socket_timeout', 120);
            // Encrypt information
            $encryp = new EncrypData_($this->WS_Usuario);
            // encryptar contrasena
            $this->WS_Password = $encryp->cadenaEncrypt($this->WS_Password);
            // instacia a soapClient
            $arrContextOptions = [
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    'crypto_method' => STREAM_CRYPTO_METHOD_TLS_CLIENT
                ]
            ];
            $options = [
                'soap_version' => SOAP_1_1,
                'exceptions' => true,
                'trace' => 1,
                'httpsocket' => NULL,
                'connection_timeout' => 5000,
                'keep_alive' => true,
                'cache_wsdl' => WSDL_CACHE_NONE,
                'compression' => SOAP_COMPRESSION_DEFLATE | SOAP_COMPRESSION_GZIP,
                'stream_context' => stream_context_create($arrContextOptions)
            ];
            $this->soap_client = new \SoapClient($this->WS_Host, $options);
            $headerbody = [
                'UserKey' => $this->WS_Usuario,
                'Password' => $this->WS_Password,
                'Society' => $this->WS_Sociedad
            ];
    
            // Create Soap Header.
            $header = new \SOAPHeader($this->WS_Uri, 'Usuario', $headerbody);
    
            // Set the Headers of Soap Client.
            $this->soap_client->__setSoapHeaders($header);
            $result = $this->soap_client->__soapCall($method, $parameters);
            unset($this->soap_client);
            unset($encryp);
            print_r(($json_result));
            return $json_result == true ? json_encode($result, JSON_UNESCAPED_UNICODE) : $result;
        } catch (\Throwable $ex) {
            throw $ex;
        }
    }
}