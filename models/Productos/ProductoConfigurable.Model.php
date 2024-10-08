<?php

	class ProductoConfigurable{
		public $Key;
		public $Codigo;
		public $CodigoConfigurable;
		public $Descripcion;

		protected $Connection;
    protected $Tool;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
		}
		
		public function SetCodigo($Codigo){
			$this->Codigo = $Codigo;
		}
		public function SetCodigoConfigurable($CodigoConfigurable){
			$this->CodigoConfigurable = $CodigoConfigurable;
		}
		public function SetDescripcion($Descripcion){
			$this->Descripcion = $Descripcion;
		}
		

		public function Add(){
      try {
        $result = $this->Connection->Exec_store_procedure_json("CALL ProductoConfigurableNombreCrear(
          '".$this->Codigo."',
          '".$this->CodigoConfigurable."',
          '".$this->Descripcion."',
        @Result);", "@Result");
        return $result;
      } catch (Exception $e) {
        throw $e;
      }
	}
	public function GetFicha(){
		try {
			$SQLSTATEMENT = "SELECT t1.ruta FROM u_producto_ficha_configurable t0, catalogo_fichas_tecnicas t1  
							WHERE t0.codigo='".$this->Codigo."'
							AND t0.id_ficha=t1.id_ficha";
			 //echo $SQLSTATEMENT;
			$result = $this->Connection->QueryReturn($SQLSTATEMENT);
			$data = [];
			//print_r($result);
			$row = $result->fetch_object();
			return $row;
		  } catch (Exception $e) {
			throw $e;
		  }
	  }

	  public function ExistCert($codigo){
		try {
		  $codigo1="";
		  $file="";
		  foreach(glob('../../public/images/img_spl/certificados/*.pdf') as $image) {
				  $path_parts = pathinfo($image);
				  $file=$path_parts['filename'];
				  if (preg_match("#$file#i",$codigo)) {
					 $codigo1=$image;
				  } else if(levenshtein($file, $codigo)==4){
					$codigo1=$image;
				}
			 }
			 $array = array('certificado' => $codigo1);
		 return $array;
	   
		} catch (Exception $e) {
		  throw $e;
		}
  
	  }
	}
	