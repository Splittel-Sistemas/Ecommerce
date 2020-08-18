<?php 

@session_start();
if (!class_exists("Connection")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Connection.php';
}if (!class_exists("Functions_tools")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Tools/Functions_tools.php';
}if (!class_exists("Mensaje")) {
  include $_SERVER["DOCUMENT_ROOT"].'/fibra-optica/models/Solicitud/Consultecnico/Mensaje.Model.php';
}

  /**
   * 
   */
  class MensajeController{
    
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
          $MensajeModel = new Mensaje(); 
          $MensajeModel->SetParameters($this->Connection, $this->Tool);
          $MensajeModel->GetBy($this->filter, $this->order);
          return $MensajeModel;
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Get(){
      try {
        if (!$this->Connection->conexion()->connect_error) {
          $MensajeModel = new Mensaje(); 
          $MensajeModel->SetParameters($this->Connection, $this->Tool);
          $Result = $MensajeModel->Get($this->filter, $this->order);
          unset($MensajeModel);
          return $this->Tool->Message_return(false, "", $Result, false);
        }
      } catch (Exception $e) {
        throw $e;
      }
    }

    public function Create(){
			try {
				if (!$this->Connection->conexion()->connect_error) {
					$MensajeModel = new Mensaje(); 
					$MensajeModel->SetParameters($this->Connection, $this->Tool);
					$MensajeModel->SetMensaje($this->Tool->Clear_data_for_sql($_POST['Mensaje']));
					$MensajeModel->SetEstatus("CLIENTE");
					$MensajeModel->SetPreguntaKey($_POST['PreguntaKey']);
					return $MensajeModel->Add();
				}
			} catch (Exception $e) {
				throw $e;
			}
		}

  }
