<?php
	class Relacionados_{
		public $Key;
		public $Codigo;
		public $Tipo;

		protected $Connection;
		protected $Tool;

		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
		}

		public function ListFijos($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM productos_relacionados ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];

        while ($row = $result->fetch_object()) {
          $Relacionado = new Relacionados_();
          $Relacionado->Key     =   $row->id_codigo;
          $Relacionado->Codigo  =   $row->codigo;
          $Relacionado->Tipo    =   $row->tipo;
          $data[] = $Relacionado;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

	}