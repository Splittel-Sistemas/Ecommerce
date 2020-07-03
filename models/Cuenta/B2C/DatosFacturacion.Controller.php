<?php 
  @session_start();
  if(!class_exists('Connection')){
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Connection.php';
  }if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Tools/Functions_tools.php';
  }if (!class_exists('DatosFacturacion')) {
    include $_SERVER['DOCUMENT_ROOT'].'/fibra-optica/models/Cuenta/B2C/DatosFacturacion.Model.php';
  }

  class DatosFacturacionController{
    private $conn;
    private $Tool;

    public $filter;
    public $orderBy;
    
    public function __construct(){
      $this->conn = new Connection();
      $this->Tool = new Functions_tools();
    }
    /**
     * 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function get(){
      try{
        if (!$this->conn->conexion()->connect_error) {
          $DatosFacturacion = new DatosFacturacion();
          $DatosFacturacion->SetParameters($this->conn, $this->Tool);
          $items = $DatosFacturacion->Get($this->filter, $this->orderBy);
          return $this->Tool->Message_return(false, "", $items, false);
        }else{
          throw new Exception("No se pueden obtener los datos maestros! por favor contactanos ");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }
     /**
     * 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function getBy(){
      try{
        if (!$this->conn->conexion()->connect_error) {
          $DatosFacturacion = new DatosFacturacion();
          $DatosFacturacion->SetParameters($this->conn, $this->Tool);
          $DatosFacturacion->GetBy($this->filter);
          return $DatosFacturacion;
        }else{
          throw new Exception("No se pueden obtener los datos maestros! por favor contactanos ");
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
    public function create(){
      try {
        if (!$this->conn->conexion()->connect_error) {
          $DatosFacturacion = new DatosFacturacion();
          $DatosFacturacion->SetParameters($this->conn, $this->Tool);
          $DatosFacturacion->SetDatosFacturacionKey($this->Tool->validate_isset_post('DatosFacturacionKey'));
          $DatosFacturacion->SetRazonSocial($this->Tool->validate_isset_post('RazonSocial'));
          $DatosFacturacion->SetTipo($this->Tool->validate_isset_post('Tipo'));
          $DatosFacturacion->SetRFC($this->Tool->validRFC('RFC', 'RFC', true));
          $DatosFacturacion->SetCalle($this->Tool->validate_isset_post('Calle'));
          $DatosFacturacion->SetNumeroExterior($this->Tool->validate_isset_post('NumeroExterior'));
          $DatosFacturacion->SetNumeroInterior($this->Tool->validate_isset_post('NumeroInterior'));
          $DatosFacturacion->SetCodigoPostal($this->Tool->validCodigoPostal('CodigoPostal', 'Codigo Postal', true));
          $DatosFacturacion->SetEstado($this->Tool->validate_isset_post('Estado'));
          $DatosFacturacion->SetCiudad($this->Tool->validate_isset_post('Municipio'));
          $DatosFacturacion->SetDelegacion($this->Tool->validate_isset_post('Delegacion'));
          $DatosFacturacion->SetColonia($this->Tool->validate_isset_post('Colonia'));
          $DatosFacturacion->SetActivo(1);
          $DatosFacturacion->SetClienteKey($_SESSION['Ecommerce-ClienteKey']);
          return $DatosFacturacion->create();
        }else{
          throw new Exception("No se pueden obtener los datos maestros! por favor contactanos ");
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }