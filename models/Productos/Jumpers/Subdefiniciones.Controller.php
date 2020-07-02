<?php 

@session_start();
if (!class_exists("Connection")) {
	include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
	include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists("Subdefiniciones")) {
	include $_SERVER["DOCUMENT_ROOT"].'/store/models/Productos/Jumpers/Subdefiniciones.Model.php';
}

	/**
	 * 
	 */
	class SubdefinicionesController{

		protected $Connection;
		protected $Tool;

		public $filter;
		public $order;

		public function __construct(){
			$this->Connection = new Connection();
			$this->Tool = new Functions_tools();
		}

		public function Get(){
			try {
				if (!$this->Connection->conexion()->connect_error) {
					$SubdefinicionesModel = new Subdefiniciones(); 
					$SubdefinicionesModel->SetParameters($this->Connection, $this->Tool);
					$items = $SubdefinicionesModel->Get($this->filter, $this->order);
					unset($SubdefinicionesModel);
					return $this->Tool->Message_return(false, "", $items, false);
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

	}
