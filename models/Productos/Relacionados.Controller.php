<?php 

@session_start();
if (!class_exists("Connection")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Relacionados_")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Relacionados.Model.php';
}

	/**
	 * 
	 */
	class RelacionadosController{
		
		protected $conn;
		protected $Tool;

		public $filter;
		public $order;

		public function __construct(){
			$this->conn = new Connection();
			$this->Tool = new Functions_tools();
		}

		public function GetFijos(){
			try {
				if (!$this->conn->conexion()->connect_error) {
					$RelacionadoModel = new Relacionados_(); 
					$RelacionadoModel->SetParameters($this->conn, $this->Tool);
					$items = $RelacionadoModel->ListFijos($this->filter, $this->order);
					unset($RelacionadoModel);
					return $this->Tool->Message_return(false, "", $items, false);
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

		public function Configurables(){
			try {
				if (!$this->conn->conexion()->connect_error) {
					$RelacionadoModel = new Relacionados_(); 
					$RelacionadoModel->SetParameters($this->conn, $this->Tool);
					$items = $RelacionadoModel->ListConfigurables($this->filter, $this->order);
					unset($RelacionadoModel);
					return $this->Tool->Message_return(false, "", $items, false);
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

	}