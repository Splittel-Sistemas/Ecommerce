<?php 

	class PrecioConector{
		protected $Connection;
		protected $Tool;

		public $Key;
		public $Precio;
		public $ConectorKey;
		public $Conector;
		public $TipoJumperKey;
		public $TipoJumper;
		public $DescripcionTipoJumper;
		public $PulidoKey;
		public $Pulido;
		public $DescripcionPulido;
		
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetKey($Key){
      $this->Key = $Key;
    }public function SetPrecio($Precio){
      $this->Precio = $Precio;
    }public function SetConectorKey($ConectorKey){
      $this->ConectorKey = $ConectorKey;
    }public function SetTipoJumperKey($TipoJumperKey){
      $this->TipoJumperKey = $TipoJumperKey;
    }public function SetPulidoKey($PulidoKey){
      $this->PulidoKey = $PulidoKey;
    }
    
    public function GetKey(){
      return $this->Key;
    }public function GetPrecio(){
      return $this->Precio;
    }public function GetConectorKey(){
      return $this->ConectorKey;
    }public function GetConector(){
      return $this->Conector;
    }public function GetTipoJumperKey(){
      return $this->TipoJumperKey;
    }public function GetTipoJumper(){
      return $this->TipoJumper;
    }public function GetDescripcionTipoJumper(){
      return $this->DescripcionTipoJumper;
    }public function GetPulidoKey(){
      return $this->PulidoKey;
    }public function GetPulido(){
      return $this->Pulido;
    }public function GetDescripcionPulido(){
      return $this->DescripcionPulido;
    }

		 /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
    */
    public function Get($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_jumper_precio_conector ".$filter." ".$order;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
          $PrecioConector = new PrecioConector();
          $PrecioConector->Key     								=   $row->keyy;
          $PrecioConector->Precio       					=   $row->precio_conector;
          $PrecioConector->ConectorKey        		=   $row->t91_pk01;
          $PrecioConector->Conector           		=   $row->conector;
          $PrecioConector->TipoJumperKey         	=   $row->t91_pk01_;
          $PrecioConector->TipoJumper          		=   $row->tipojumper;
          $PrecioConector->DescripcionTipoJumper  =   $row->descripciontipojumper;
          $PrecioConector->PulidoKey      				=   $row->t91_pk01__;
          $PrecioConector->Pulido      						=   $row->pulido;
          $PrecioConector->DescripcionPulido			=   $row->descripcionpulido;
          $data[] = $PrecioConector;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetBy($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM listar_jumper_precio_conector ".$filter." ".$order;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = false;

        while ($row = $result->fetch_object()) {
          $this->Key     								=   $row->keyy;
          $this->Precio       					=   $row->precio_conector;
          $this->ConectorKey        		=   $row->t91_pk01;
          $this->Conector           		=   $row->conector;
          $this->TipoJumperKey         	=   $row->t91_pk01_;
          $this->TipoJumper          		=   $row->tipojumper;
          $this->DescripcionTipoJumper  =   $row->descripciontipojumper;
          $this->PulidoKey      				=   $row->t91_pk01__;
          $this->Pulido      						=   $row->pulido;
          $this->DescripcionPulido			=   $row->descripcionpulido;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Add(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL PrecioConectorCrear(
          ".$this->Key.",
          ".$this->Precio.",
          ".$this->ConectorKey.",
          ".$this->TipoJumperKey.",
          ".$this->PulidoKey.",
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
    }

	}
	