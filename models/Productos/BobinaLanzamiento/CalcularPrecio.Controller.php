<?php 

@session_start();
if (!class_exists("Connection")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("CalcularPrecio")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/BobinaLanzamiento/CalcularPrecio.Model.php';
}

	/**
	 * 
	 */
	class CalcularPrecioController{
		
		protected $Connection;
		protected $Tool;

		public $filter;
		public $order;

		public function __construct(){
			$this->Connection = new Connection();
			$this->Tool = new Functions_tools();
		}

		public function Calcular(){
			try {
				if (!$this->Connection->conexion()->connect_error) {
					$CalcularPrecioModel = new CalcularPrecio(); 
					$CalcularPrecioModel->SetParameters($this->Connection, $this->Tool);
					$CalcularPrecioModel->SetLongitud($_POST['Longitud']);
					$CalcularPrecioModel->SetFibra($_POST['Fibra']);
					$CalcularPrecioModel->SetConector_1($_POST['Conector_1']);
					$CalcularPrecioModel->SetConector_2($_POST['Conector_2']);
					$CalcularPrecioModel->SetSubcategoriaN1Code($_POST['SubcategoriaN1Code']);
					$CalcularPrecioModel->SetClienteId(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
					return $CalcularPrecioModel->Calcular();
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

	}
