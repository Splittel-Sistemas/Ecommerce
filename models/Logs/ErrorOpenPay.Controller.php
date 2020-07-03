<?php 

	@session_start();
	if (!class_exists("Connection")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
	}if (!class_exists("Functions_tools")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
	}if (!class_exists("ErrorOpenPay")) {
    include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Logs/ErrorOpenPay.Model.php';
  }

	/**
	 * 
	 */
	class ErrorOpenPayController{
		
		protected $Connection;
		protected $Tool;

		public $filter;
		public $order;

		public function __construct(){
			$this->Connection = new Connection();
			$this->Tool = new Functions_tools();
		}

		public function GetBy(){
			try {
				if (!$this->Connection->conexion()->connect_error) {
					$ErrorOpenPay = new ErrorOpenPay();
          $ErrorOpenPay->SetParameters($this->Connection, $this->Tool);
          $ErrorOpenPay->getBy($this->filter, $this->order);

          return $ErrorOpenPay;
				}else{
          throw new Exception("No hay datos maestros por favor contacta con tu ejecutivo!", 1);
        }
			} catch (Exception $e) {
				throw $e;
			}
		}

	}