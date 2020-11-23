<?php 

@session_start();
if (!class_exists("Connection")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("PrecargadoCalcularPrecio")) {
	include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Distribuidores/Precargados/PrecargadoCalcularPrecio.Model.php';
}

	/**
	 * 
	 */
	class PrecargadoCalcularPrecioController{
		
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
					$PrecargadoCalcularPrecioModel = new PrecargadoCalcularPrecio(); 
					$PrecargadoCalcularPrecioModel->SetParameters($this->Connection, $this->Tool);
					$PrecargadoCalcularPrecioModel->SetDistribuidor($_POST['Distribuidor']);
					$PrecargadoCalcularPrecioModel->SetCapacidad($_POST['Capacidad']);
					$PrecargadoCalcularPrecioModel->SetAcoplador($_POST['Acoplador']);
					$PrecargadoCalcularPrecioModel->SetColor($_POST['Color']);
					$PrecargadoCalcularPrecioModel->SetPuertos($_POST['Puertos']);
					$PrecargadoCalcularPrecioModel->SetNumeroAcopladores($_POST['NumeroAcopladores']);
					$PrecargadoCalcularPrecioModel->SetSubcategoriaN1Code($_POST['SubcategoriaN1Code']);
					$PrecargadoCalcularPrecioModel->SetClienteId(isset($_SESSION['Ecommerce-ClienteKey']) ? $_SESSION['Ecommerce-ClienteKey'] : 0);
					return $PrecargadoCalcularPrecioModel->Calcular();
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

	}
