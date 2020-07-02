<?php 
  @session_start();
  if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Connection.php';
  }if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
  }if (!class_exists('Nosotros')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Nosotros/Nosotros.Model.php';
  }

/**
 * 
 */
class NosotrosController{
  
 protected $conn;
  protected $Tool;

  public function __construct(){
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }
  /**
   * Description
   *
   * @param string $a Foo
   *
   * @return int $b Bar
   */
  public function get(){
    try {
      if (!$this->conn->conexion()->connect_error) {
        $NosotrosModel = new Nosotros_();
        $NosotrosModel->SetParameters($this->conn, $this->Tool);
        $items = $NosotrosModel->Get();
        return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $items, false);
      }else{
        throw new Exception("");
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
  public function getBy(){
    try {
      if (!$this->conn->conexion()->connect_error) {
        $NosotrosModel = new Nosotros_();
        $NosotrosModel->SetParameters($this->conn, $this->Tool);
        $Result = $NosotrosModel->GetBy();
        if($Result){
          return $NosotrosModel;
        }else{
          throw new Exception("No hay datos!");
          
        }
      }else{
        throw new Exception("");
      }
    } catch (Exception $e) {
     throw $e; 
    }
  }

}