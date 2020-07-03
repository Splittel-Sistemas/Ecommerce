<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("PrecioConector")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Productos/Jumpers/PrecioConector.Model.php';
}

  /**
   * 
   */
  class PrecioConectorController{
    
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
          $PrecioConectorModel = new PrecioConector(); 
          $PrecioConectorModel->SetParameters($this->Connection, $this->Tool);
          $items = $PrecioConectorModel->Get($this->filter, $this->order);
          unset($PrecioConectorModel);
          return $this->Tool->Message_return(false, "", $items, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function GetBy(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $PrecioConectorModel = new PrecioConector(); 
          $PrecioConectorModel->SetParameters($this->Connection, $this->Tool);
          $items = $PrecioConectorModel->GetBy($this->filter, $this->order);
          return $PrecioConectorModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Create(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $PrecioConectorModel = new PrecioConector(); 
          $PrecioConectorModel->SetParameters($this->Connection, $this->Tool);
          $PrecioConectorModel->SetKey($_POST['Key']);
          $PrecioConectorModel->SetPrecio($_POST['Precio']);
          $PrecioConectorModel->SetConectorKey($_POST['Conector']);
          $PrecioConectorModel->SetTipoJumperKey($_POST['Tipo']);
          $PrecioConectorModel->SetPulidoKey($_POST['Pulido']);
          return $PrecioConectorModel->Add();
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

  }
