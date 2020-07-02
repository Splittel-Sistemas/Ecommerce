<?php 

@session_start();
if (!class_exists("Connection")) {
	include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
	include $_SERVER["DOCUMENT_ROOT"].'/store/models/Tools/Functions_tools.php';
}if (!class_exists("PrecioCable")) {
	include $_SERVER["DOCUMENT_ROOT"].'/store/models/Productos/Jumpers/PrecioCable.Model.php';
}

	/**
	 * 
	 */
	class PrecioCableController{
		
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
					$PrecioCableModel = new PrecioCable(); 
					$PrecioCableModel->SetParameters($this->Connection, $this->Tool);
					$items = $PrecioCableModel->Get($this->filter, $this->order);
					unset($PrecioCableModel);
					return $this->Tool->Message_return(false, "", $items, false);
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

		public function GetBy(){
			try {
				if (!$this->Connection->conexion()->connect_error) {
					$PrecioCableModel = new PrecioCable(); 
					$PrecioCableModel->SetParameters($this->Connection, $this->Tool);
					$items = $PrecioCableModel->GetBy($this->filter, $this->order);
					return $PrecioCableModel;
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

		public function Create(){
			try {
				if (!$this->Connection->conexion()->connect_error) {
					$PrecioCableModel = new PrecioCable(); 
					$PrecioCableModel->SetParameters($this->Connection, $this->Tool);
					$PrecioCableModel->SetKey($_POST['Key']);
					$PrecioCableModel->SetPrecio($_POST['Precio']);
					$PrecioCableModel->SetTipoJumperKey($_POST['Tipo']);
					$PrecioCableModel->SetTipoFibraKey($_POST['Fibra']);
					$PrecioCableModel->SetCubiertaKey($_POST['Cubierta']);
					return $PrecioCableModel->Add();
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

	}
