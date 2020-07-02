<?php 
  @session_start();
  if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Connection.php';
  }if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Tools/Functions_tools.php';
  }if (!class_exists('MiniBanner')) {
    include $_SERVER['DOCUMENT_ROOT'].'/store/models/Home/MiniBanner.Model.php';
  }

/**
 * 
 */
class MiniBannerController{
  
  protected $Connection;
  protected $Tool;

  public function __construct(){
    $this->Connection = new Connection();
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
      if (!$this->Connection->conexion()->connect_error) {
        $MiniBannerModel = new MiniBanner();
        $MiniBannerModel->SetParameters($this->Connection, $this->Tool);
        $data = $MiniBannerModel->GetMiniBanners($this->filter, $this->order);
        return $this->Tool->Message_return(false,  "Datos obtenidos exitosamente!", $data, false);
      }else{
        throw new Exception("");
      }
    } catch (Exception $e) {
     throw $e; 
    }
  }

}