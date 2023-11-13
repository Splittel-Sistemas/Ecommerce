<?php 

  /**
   * 
   */
  class PedidoB2C{
    public $PedidoKey;
    public $CardCode;
    public $CardName;
    public $PartnerRFC;
    public $RequiereInvoice;
    public $ShipToInformaction;
    public $BillToInformaction;
    protected $FechaActual;
    public $CFDIUser;
    public $RegimenFiscal;
    public $TransferReference;
    public $TransportationCode;
    protected $SalesPersonCode;
    protected $GroupNumber;
    public $PaymentMethod;
    public $DocCurrency;
    public $ShipReferences;
    public $NumAtCard;
    public $Contacto;
    public $Telefono;
    public $Email;
    public $Email_ItemsStockBad;

    public $TipoPago;

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
    }public function SetCardName($CardName){
      if (is_null($CardName)) {
        throw new Exception('$CardName no es valido');
      }
      $this->CardName = $CardName;
    }public function SetPartnerRFC($PartnerRFC){
      if (is_null($PartnerRFC)) {
        throw new Exception('$PartnerRFC no es valido');
      }
      $this->PartnerRFC = $PartnerRFC;
    }public function SetRequiereInvoice($RequiereInvoice){
      if (is_null($RequiereInvoice)) {
        throw new Exception('$RequiereInvoice no es valido');
      }
      $this->RequiereInvoice = $RequiereInvoice;
    }public function SetShipToInformaction($ShipToInformaction){
      if (is_null($ShipToInformaction)) {
        throw new Exception('$ShipToInformaction no es valido');
      }
      $this->ShipToInformaction = $ShipToInformaction;
    }public function SetBillToInformaction($BillToInformaction){
      if (is_null($BillToInformaction)) {
        throw new Exception('$BillToInformaction no es valido');
      }
      $this->BillToInformaction = $BillToInformaction;
    }public function SetCFDIUser($CFDIUser){
      if (is_null($CFDIUser)) {
        throw new Exception('$CFDIUser no es valido');
      }
      $this->CFDIUser = $CFDIUser;
    }public function SetRegimenFiscal($RegimenFiscal){
      if (is_null($RegimenFiscal)) {
        throw new Exception('$RegimenFiscal no es valido');
      }
      $this->RegimenFiscal = $RegimenFiscal;
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
    public function SetTipoPago($TipoPago){
      $this->TipoPago = $TipoPago;
    }
    public function GetPedidoKey(){
      return $this->PedidoKey;
    }public function GetCardCode(){
      return $this->CardCode;
    }public function GetCardName(){
      return $this->CardName;
    }public function GetPartnerRFC(){
      return $this->PartnerRFC;
    }public function GetRequiereInvoice(){
      return $this->RequiereInvoice;
    }public function GetShipToInformaction(){
      return $this->ShipToInformaction;
    }public function GetBillToInformaction(){
      return $this->BillToInformaction;
    }public function GetCFDIUser(){
      return $this->CFDIUser;
    }public function GetRegimenFiscal(){
      return $this->RegimenFiscal;
    }public function GetTransportationCode(){
      return $this->GetTransportationCode;
    }public function GetTransferReference(){
      return $this->TransferReference;
    }public function GetPaymentMethod(){
      return $this->PaymentMethod;
    }public function GetDocCurrency(){
      return $this->DocCurrency;
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
    }public function GetEstructuraPedidoB2C(){
      return $this->EstructuraPedidoB2C;
    }public function SetDocRate($DocRate){
      if (is_null($DocRate)) {
        throw new Exception('$DocRate no es valido');
      }
      $this->DocRate = $DocRate;
    }
    public function GetTipoPago(){
      return $this->TipoPago;
    }
    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function createPedidoB2C($WebServiceSOAP, $ArticulosPedido){
      try {
        $this->FechaActual        = date('Y-m-d');
       // $this->TransportationCode = 1;
        $this->SalesPersonCode    = 176; // id persona de ventas prueba: 176 productivo: 
        $this->GroupNumber        = 2;
       if($this->TipoPago==='credit'){
        $TypePay='04';
       }elseif($this->TipoPago==='debit'){
        $TypePay='28';
       }else{
        $TypePay=$this->PaymentMethod;
       }


        $this->EstructuraPedidoB2C['CreatePedidoB2C'] = [
          "Invoice" => [
            "Partner" => [
              "CardCode"            => $this->CardCode, 
              "CardName"            => $this->CardName,
              "FederalTaxID"        => $this->PartnerRFC,
              "RequiereInvoice"     => $this->RequiereInvoice,
              "ShipToInformaction"  => $this->ShipToInformaction,
              "BillToInformaction"  => $this->BillToInformaction,
            ], 
            "Document" => [
              "DocNumEcommerce"     => $this->PedidoKey,
              "CardCode"            => $this->CardCode,
              "TaxDate"             => $this->FechaActual,
              "DocDueDate"          => $this->FechaActual,
              "DocDate"             => $this->FechaActual,
              "DocRate"             => $this->DocRate,
              "CFDIUser"            => $this->CFDIUser,
              "RegimenFiscal"       => $this->RegimenFiscal,
              "TransportationCode"  => $this->TransportationCode,
              "SalesPersonCode"     => $this->SalesPersonCode,
              "GroupNumber"         => $this->GroupNumber,
              "PaymentMethod"       => $this->PaymentMethod,
              "DocCurrency"         => $this->DocCurrency,
              "ShipReferences"      => $this->ShipReferences,
              "NumAtCard"           => $this->NumAtCard,
              "TransferReference"   => $this->TransferReference,
              "TipoPago"            => $TypePay,
              "ContactPerson" => [
                "Name"              => $this->Contacto,
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
          ]
        ];

        // print_r($this->EstructuraPedidoB2C);
        $result = $WebServiceSOAP->ExecuteSoap("CreatePedidoB2C", $this->EstructuraPedidoB2C, false);
        return $result;
      } catch (Exception $e) {
        // print_r($e);
        throw $e;
      }
    }

  }