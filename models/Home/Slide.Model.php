<?php 

  /**
   * 
   */
  class Slide{

    protected $ClienteKey;

    public $Key;
    public $Descripcion;
    public $PathImg1;
    public $PathImg2;
    public $UrlImg1;
    public $UrlImg2;
    public $Position;

    protected $Connection;
    protected $Tool;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    public function SetClienteKey($ClienteKey){
      $this->ClienteKey = $ClienteKey;
    }

    public function GetSlidesByCliente(){
      try {
        $SQLSTATEMENT = "CALL Ecom_HomeAnuncio_(".$this->ClienteKey.");";
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];
        while($row = $result->fetch_object()){
          $Slide = new Slide();
          $Slide->Key           = $row->id;
          $Slide->Descripcion   = $row->Description;
          $Slide->PathImg1      = $row->PathImg1;
          $Slide->PathImg2      = $row->PathImg2;
          $Slide->UrlImg1       = $row->UrlImg1;
          $Slide->UrlImg2       = $row->UrlImg2;
          $Slide->Position      = $row->Position;
          $Slide->TargetLink1   = $row->TargetBlank1 == 'si' ? '_blank' : '_self';
          $Slide->TargetLink2   = $row->TargetBlank2 == 'si' ? '_blank' : '_self';
          $data[] = $Slide;        
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }