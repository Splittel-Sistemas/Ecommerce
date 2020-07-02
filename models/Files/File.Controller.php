<?php 
	@session_start();
	if (!class_exists('Connection')) {
		include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Connection.php';
	}if (!class_exists('Functions_tools')) {
		include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
	}

	class FileController{
		
		protected $Connection;
		protected $Tool;

		public function __construct(){
			$this->Connection = new Connection();
			$this->Tool = new Functions_tools();
		}
		/**
		 * Description
		 *
		 * @param string $a Foo
		 *
		 * @return int $b Bar
		 */
		public function Create(){
			try {
				if (!$this->Connection->conexion()->connect_error) {
					$File_ = $_FILES['Archivo'];
					$Url = '../../public/archivos/situacionfiscal';

					$File = new File();
					$File->SetParameters($this->Connection, $this->Tool);
					$File->SetKey(0);
					$File->SetNombre($File_['name']);
					$File->SetUrl($_POST['Url']);
					$File->SetTipo($_POST['Tipo']);
					$File->SetRelacion($_POST['Relacion']);
					return $File->Add();
				}else{
					throw new Exception("No se pueden obtener los datos maestros! por favor contactanos ");
				}
			} catch (Exception $e) {
				throw $e;
			}
		}
	}