<?php 

  /**
   * 
   */
  class PedidoB2B{
    public $PedidoKey;
    public $CardCode;
    protected $FechaActual;
    public $CFDIUser;
    public $TransferReference;
    public $TransportationCode;
    protected $SalesPersonCode;
    protected $GroupNumber;
    public $PaymentMethod;
    public $DocCurrency;
    public $ShipToCode;
    public $PayToCode;
    public $DocRate;
    public $ShipReferences;
    public $NumAtCard;
    public $Contacto;
    public $Telefono;
    public $Email;
    public $Email_ItemsStockBad;
    public $EstructuraPedidoB2B;
    public $GetTransportationCode;

    public function SetPedidoKey($PedidoKey){
      if (is_null($PedidoKey)) {
        throw new Exception('$PedidoKey no es valido');
      }
      $this->PedidoKey = $PedidoKey;
    }public function SetCardCode($CardCode){
      if (is_null($CardCode)) {
        throw new Exception('$CardCode no es valido');
      }
      $this->CardCode = $CardCode;
    }public function SetCFDIUser($CFDIUser){
      if (is_null($CFDIUser)) {
        throw new Exception('$CFDIUser no es valido');
      }
      $this->CFDIUser = $CFDIUser;
    }public function SetTransportationCode($TransportationCode){
      if (is_null($TransportationCode)) {
        throw new Exception('$TransportationCode no es valido');
      }
      $this->TransportationCode = $TransportationCode;
    }public function SetTransferReference($TransferReference){
      if (is_null($TransferReference)) {
        throw new Exception('$TransferReference no es valido');
      }
      $this->TransferReference = $TransferReference;
    }public function SetPaymentMethod($PaymentMethod){
      if (is_null($PaymentMethod)) {
        throw new Exception('$PaymentMethod no es valido');
      }
      $this->PaymentMethod = $PaymentMethod;
    }public function SetDocCurrency($DocCurrency){
      if (is_null($DocCurrency)) {
        throw new Exception('$DocCurrency no es valido');
      }
      $this->DocCurrency = $DocCurrency;
    }public function SetShipToCode($ShipToCode){
      if (is_null($ShipToCode)) {
        throw new Exception('$ShipToCode no es valido');
      }
      $this->ShipToCode = $ShipToCode;
    }public function SetPayToCode($PayToCode){
      if (is_null($PayToCode)) {
        throw new Exception('$PayToCode no es valido');
      }
      $this->PayToCode = $PayToCode;
    }public function SetDocRate($DocRate){
      if (is_null($DocRate)) {
        throw new Exception('$DocRate no es valido');
      }
      $this->DocRate = $DocRate;
    }public function SetShipReferences($ShipReferences){
      $this->ShipReferences = $ShipReferences;
    }public function SetNumAtCard($NumAtCard){
      $this->NumAtCard = $NumAtCard;
    }public function SetContacto($Contacto){
      if (is_null($Contacto)) {
        throw new Exception('$Contacto no es valido');
      }
      $this->Contacto = $Contacto;
    }public function SetTelefono($Telefono){
      if (is_null($Telefono)) {
        throw new Exception('$Telefono no es valido');
      }
      $this->Telefono = $Telefono;
    }public function SetEmail($Email){
      if (is_null($Email)) {
        throw new Exception('$Email no es valido');
      }
      $this->Email = $Email;
    }public function SetEmail_ItemsStockBad($Email_ItemsStockBad){
      if (is_null($Email_ItemsStockBad)) {
        throw new Exception('$Email_ItemsStockBad no es valido');
      }
      $this->Email_ItemsStockBad = $Email_ItemsStockBad;
    }

    public function GetPedidoKey(){
      return $this->PedidoKey;
    }public function GetCardCode(){
      return $this->CardCode;
    }public function GetCFDIUser(){
      return $this->CFDIUser;
    }public function GetTransportationCode(){
      return $this->GetTransportationCode;
    }public function GetTransferReference(){
      return $this->TransferReference;
    }public function GetPaymentMethod(){
      return $this->PaymentMethod;
    }public function GetDocCurrency(){
      return $this->DocCurrency;
    }public function GetShipToCode(){
      return $this->ShipToCode;
    }public function GetPayToCode(){
      return $this->PayToCode;
    }public function GetDocRate(){
      return $this->DocRate;
    }public function GetShipReferences(){
      return $this->ShipReferences;
    }public function GetNumAtCard(){
      return $this->NumAtCard;
    }public function GetContacto(){
      return $this->Contacto;
    }public function GetTelefono(){
      return $this->Telefono;
    }public function GetEmail(){
      return $this->Email;
    }public function GetEstructuraPedidoB2B(){
      return $this->EstructuraPedidoB2B;
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function createPedidoB2B($WebServiceSOAP, $ArticulosPedido){
      try {
        $this->FechaActual        = date('Y-m-d');
       // $this->TransportationCode = 1;
        $this->SalesPersonCode    = 176; // id persona de ventas prueba: 176 productivo: 
        $this->GroupNumber        = 2;

        $this->EstructuraPedidoB2B['CreatePedidoB2B']['Document'] = [
          "SalesQuotation" => [
            "DocNumEcommerce"     => $this->PedidoKey,
            "CardCode"            => $this->CardCode,
            "TaxDate"             => $this->FechaActual,
            "DocDueDate"          => $this->FechaActual,
            "DocDate"             => $this->FechaActual,
            "CFDIUser"            => $this->CFDIUser,
            "TransferReference"   => $this->TransferReference,
            "TransportationCode"  => $this->TransportationCode,
            "SalesPersonCode"     => $this->SalesPersonCode,  
            "GroupNumber"         => $this->GroupNumber,
            "PaymentMethod"       => $this->PaymentMethod,
            "DocCurrency"         => $this->DocCurrency,
            "ShipToCode"          => $this->ShipToCode,
            "PayToCode"           => $this->PayToCode,
            "DocRate"             => $this->DocRate,
            "ShipReferences"      => $this->ShipReferences,
            "NumAtCard"           => $this->NumAtCard,
            "ContactPerson" => [
              "Name"               => $this->Contacto,
              "Telphone"          => $this->Telefono,
              "Email"             => $this->Email,
            ],
            "Lines" => [
              "Items_"            => $ArticulosPedido 
            ]  
          ],
          "actionsWS" =>[
            "Email_ItemsStockBad" => $this->Email_ItemsStockBad
          ]
        ];
        $result = $WebServiceSOAP->ExecuteSoap("CreatePedidoB2B", $this->EstructuraPedidoB2B, false);
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }