<?php
   class Consultecnico{

    protected $Connection;
    protected $Tool;

    public $Key;
    public $Nombre;
    public $Apellido;
    public $Imagen;
    public $KeySplitnet;
   
    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }
  
    /**
     * Listar Pedido 
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function Get($filter){
      try {
        $SQLSTATEMENT = "SELECT * FROM t43_usuarios_internos ".$filter." ";
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
         //echo $SQLSTATEMENT;
         $data = [];

        while ($row = $result->fetch_object()) {
          $Consultecnico = new Consultecnico();
          $Consultecnico->Key            =   $row->id;
          $Consultecnico->Nombre         =   $row->nombre;
          $Consultecnico->Apellido       =   $row->apellido;
          $Consultecnico->Imagen         =   $row->imagen;
          $Consultecnico->KeySplitnet    =   $row->IdSplitnet;
          $data[] = $Consultecnico;
        }
        //print_r($data);
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

    
  
  }