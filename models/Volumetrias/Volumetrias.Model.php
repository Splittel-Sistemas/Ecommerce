<?php
  class Volumetria{
    public $VolumetriaKey;
    public $Codigo;
    public $Minimo;
    public $Maximo;
    public $Descuento;
    

    protected $Connection;
    protected $Tool;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }
   
 
        

    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM wisp_volumetria ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
          $Volumetria = new Volumetria();
          $Volumetria->VolumetriaKey        =   $row->id;
          $Volumetria->Codigo               =   $row->codigo;
          $Volumetria->Minimo               =   $row->min;
          $Volumetria->Maximo               =   $row->max;
          $Volumetria->Descuento            =   $row->descuento;
          $data[] = $Volumetria;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

  

  }