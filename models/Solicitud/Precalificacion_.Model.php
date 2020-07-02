<?php
	class Precalificacion_{

		protected $Connection;
		protected $Tool;
		
		public $Key;
		public $Check;
		public $SubdefinicionesKey;
		public $PrecalificacionKey;
		
		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
		}
		
		public function SetKey($Key){
			$this->Key = $Key;
		}public function SetCheck($Check){
			$this->Check = $Check;
		}public function SetSubdefinicionesKey($SubdefinicionesKey){
			$this->SubdefinicionesKey = $SubdefinicionesKey;
		}public function SetPrecalificacionKey($PrecalificacionKey){
			$this->PrecalificacionKey = $PrecalificacionKey;
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
        $SQLSTATEMENT = "SELECT * FROM listar_solicitud_precalificacion_checks ".$filter." ".$order;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = array(); 
        while ($row = $result->fetch_object()) {
          $Precalificacion_ = new Precalificacion_();
          $Precalificacion_->Check         								= $row->t23_f001;
          $Precalificacion_->SubdefinicionesKey   				= $row->t91_pk01;
          $Precalificacion_->SubdefinicionesDescripcion   = $row->t91_f001;
          $Precalificacion_->PrecalificacionKey           = $row->t22_pk01;
          $data[] = $Precalificacion_;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

		public function Add(){
			try {
				$result = $this->Connection->Exec_store_procedure_json("CALL SolicitudPrecalificacionCheckCrear(
					'".$this->Check."',
					'".$this->SubdefinicionesKey."',
					'".$this->PrecalificacionKey."',
				@Result);", "@Result");
				return $result;
			} catch (Exception $e) {
				throw $e;
			}
		}
	
	}