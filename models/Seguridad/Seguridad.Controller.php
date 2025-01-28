<?php 
	@session_start();
	if (!class_exists("Connection")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
	}if (!class_exists("Functions_tools")) {
		include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
	}if (!class_exists('EncrypData_')) {
		include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/EncrypData.php';
	}

	/**
	 * 
	 */
	class SeguridadController{
		public $Usuario;
		public $Password;

		protected $conn;
		protected $Tool;

		function __construct(){
			$this->conn = new Connection();
			$this->Tool = new Functions_tools();
		}

		public function encryptAjax($data){
			// Clave y vector de inicialización (IV)
			$cipher = "AES-256-CBC";
			$key = "*_#Spl123Fib321#OPt456Devs654#_*"; // Clave de 32 caracteres (256 bits)   
			$iv = substr(('Dev#Splitt3l#Eco'), 0, 16);
			$plaintext = $data;
			$encrypted = openssl_encrypt($plaintext, $cipher, $key, 0, $iv);
			return json_encode([
				"text" => base64_encode($encrypted),
				"cviv" => base64_encode($iv), // También codificamos el IV en Base64
				"GGG" => base64_encode($key)
			]);

		}

		/**
		 * Description
		 *
		 * @param string $a Foo
		 *
		 * @return int $b Bar
		*/
		public function information(){
	 		try {
	 			if (!$this->conn->conexion()->connect_error) {
					 $data = false;
					 $EncrypData = new EncrypData_('prueba');
					if (isset($_SESSION['Ecommerce-ClienteKey'])) {
						if (!class_exists("Cliente")) {
							include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Cliente/Cliente.Model.php';
						}
						$ClienteModel = new Cliente(); 
						$ClienteModel->SetParameters($this->conn, $this->Tool);
						$ClienteExiste = $ClienteModel->GetBy("WHERE id_cliente = ".$_SESSION['Ecommerce-ClienteKey']." ");
						if ($ClienteExiste) {
							$Usuario = $_SESSION['Ecommerce-ClienteEmail'];
							$Password = $ClienteModel->GetPassword().'-'.$_SESSION['Ecommerce-ClienteTipo'].'-'.$ClienteModel->GetFechaIngreso();
							$data = true;
						}else{
							throw new Exception("¡No se encuentra registrado aún!");
						}
					}else{
						$Usuario = 'anonimo@fibremex.com.mx';
						$Password = 'Fibremex-Ecommerce-anonimo-'.date('Y-m-d');
						$data = true;
					}
					$_SESSION['AuthUser']     = $EncrypData->cadenaEncrypt($Usuario);
    				$_SESSION['AuthPassword'] = $EncrypData->cadenaEncrypt($Password);
					return $data;
	 			}else{
					throw new Exception("No hay datos maestros, por favor de ponerte en contacto con tu ejecutivo");
				}
	 		} catch (Exception $e) {
	 			throw $e;
	 		}
		}
		/**
		 * Description
		 *
		 * @param string $a Foo
		 *
		 * @return int $b Bar
		 */
		public function encrypData(){
		 	try {
		 		$EncrypData = new EncrypData_('productivo');
			 	$Existe = $this->information();
			 	if (!$Existe) {
			 		throw new Exception('No se pudo obtener la información!');
			 	}
				return ['Usuario' => $EncrypData->cadenaEncrypt($this->Usuario), 'Password' => $EncrypData->cadenaEncrypt($this->Password) ];
		 	} catch (Exception $e) {
		 		$e->getMessage();
		 	}
		}
		/**
		 * Description
		 *
		 * @param string $a Foo
		 *
		 * @return int $b Bar
		 */
		public function decryptData(){
			try{
			 	$EncrypData = new EncrypData_('productivo');
			 	$Existe = $this->information();
			 	if (!$Existe) {
			 		throw new Exception('No se pudo obtener la información!');
			 	}
			 	$PHP_AUTH_USER = $EncrypData->cadenaDecrypt($_SERVER['PHP_AUTH_USER']);
			 	$PHP_AUTH_PW = $EncrypData->cadenaDecrypt($_SERVER['PHP_AUTH_PW']);
			 	return ($PHP_AUTH_USER == $this->Usuario) && ($PHP_AUTH_PW == $this->Password) ? true : false;
			} catch (Exception $e) {
		 		$e->getMessage();
		 	}
		}

	}