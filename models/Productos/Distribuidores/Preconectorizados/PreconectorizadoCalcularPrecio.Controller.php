<?php 

@session_start();
if (!class_exists("Connection")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("PreconectorizadoCalcularPrecio")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Distribuidores/Preconectorizados/PreconectorizadoCalcularPrecio.Model.php';
}

	/**
	 * 
	 */
	class PreconectorizadoCalcularPrecioController{
		
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
					$PreconectorizadoCalcularPrecioModel = new PreconectorizadoCalcularPrecio(); 
					$PreconectorizadoCalcularPrecioModel->SetParameters($this->Connection, $this->Tool);
					$PreconectorizadoCalcularPrecioModel->SetConector($_POST['Conector']);
					$PreconectorizadoCalcularPrecioModel->SetDistribuidor($_POST['Distribuidor']);
					$PreconectorizadoCalcularPrecioModel->SetCapacidad($_POST['Capacidad']);
					$PreconectorizadoCalcularPrecioModel->SetAcoplador($_POST['Acoplador']);
					$PreconectorizadoCalcularPrecioModel->SetTipoFibra($_POST['TipoFibra']);
					$PreconectorizadoCalcularPrecioModel->SetPuerto($_POST['Puerto']);
					$PreconectorizadoCalcularPrecioModel->SetNumeroAcopladores($_POST['NumeroAcopladores']);
					$PreconectorizadoCalcularPrecioModel->SetSubcategoriaN1Code($_POST['SubcategoriaN1Code']);
					$PreconectorizadoCalcularPrecioModel->SetClienteId(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
					return $PreconectorizadoCalcularPrecioModel->Calcular();
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

	}
