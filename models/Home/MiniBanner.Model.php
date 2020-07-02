<?php 
  /**
   * 
   */
  class MiniBanner{


    public $Key;
    public $Descripcion;
    public $PathImg1;
    public $UrlImg1;
    public $Position;
    Public $TargetLink1;

    protected $Connection;
    protected $Tool;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }


    public function GetMiniBanners($filter, $order){
      try {
        $SQLSTATEMENT = "SELECT * FROM t39_FileSecciones ".$filter." ".$order;
        // echo $SQLSTATEMENT;
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];
        while($row = $result->fetch_object()){
          $Minibanner = new MiniBanner();
          $Minibanner->Key           = $row->t39_pk01;
          $Minibanner->Descripcion   = $row->t39_f002;
          $Minibanner->PathImg1      = $row->t39_f001;
          $Minibanner->UrlImg1       = $row->t39_f005;
          $Minibanner->Position      = $row->t39_f004;
          $Minibanner->TargetLink1   = $row->t39_f006 == '1' ? '_blank' : '_self';
          $data[] = $Minibanner;        
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }