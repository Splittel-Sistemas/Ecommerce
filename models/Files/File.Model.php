<?php
	class File{
		protected $Key;
		protected $Nombre;
		protected $Url;
		protected $Tipo;
		protected $Relacion;
		
		public function SetParameters($conn, $Tool){
			$this->Connection = $conn;
			$this->Tool = $Tool;
		}

		public function SetKey($Key){
			$this->Key = $Key;
		}public function SetNombre($Nombre){
			$this->Nombre = $Nombre;
		}public function SetUrl($Url){
			$this->Url = $Url;
		}public function SetTipo($Tipo){
			$this->Tipo = $Tipo;
		}public function SetRelacion($Relacion){
			$this->Relacion = $Relacion;
		}
		
		public function Add(){
			try {
				$result = $this->Connection->Exec_store_procedure_json("CALL ArchivoAgregar(
					'".$this->Key."',
					'".$this->Nombre."',
					'".$this->Url."',
					'".$this->Tipo."',
					'".$this->Relacion."',
				@Result);", "@Result");
				return $result;
			} catch (Exception $e) {
				throw $e;
			}
		}

	}
