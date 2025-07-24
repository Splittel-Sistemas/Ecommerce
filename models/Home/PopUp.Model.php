<?php 

  /**
   * 
   */
  class PopUp{

    protected $ClienteKey;

    public $Key;
    public $UrlImg1;
    public $TargetLink1;
    public $Link1;
    public $FechaInicio;
    public $FechaFin;
    public $HoraInicio;
    public $HoraFin;
    public $NuevaPestana;

    protected $Connection;
    protected $Tool;

    public function SetParameters($conn, $Tool){
      $this->Connection = $conn;
      $this->Tool = $Tool;
    }

    
    public function GetPopUps(){
     
      try {
       // date_default_timezone_set('America/Mexico_City');
        $fechaActual = date('Y-m-d');
        $horaActual  = date('H:i:s');
        $SQLSTATEMENT = "SELECT *
                        FROM popup_principal
                        WHERE '".$fechaActual."' BETWEEN FechaInicio AND FechaFin
                        AND (
                            (LapsoDiainicio IS NOT NULL AND LapsoDiaFin IS NOT NULL AND '".$horaActual."' BETWEEN LapsoDiainicio AND LapsoDiaFin)
                            OR (LapsoDiainicio IS NULL OR LapsoDiaFin IS NULL)
                        )
                        ORDER BY 
                        (LapsoDiainicio IS NOT NULL AND LapsoDiaFin IS NOT NULL AND '".$horaActual."' BETWEEN LapsoDiainicio AND LapsoDiaFin) DESC;";
        //echo $SQLSTATEMENT;
       
        $result = $this->Connection->QueryReturn($SQLSTATEMENT);
        $data = [];
        while($row = $result->fetch_object()){
          $Slide = new Slide();
          $Slide->Key           = $row->id;
          $Slide->UrlImg1       = $row->RutaImagen;
          $Slide->Link1         = $row->Link;
          $Slide->FechaInicio   = $row->FechaInicio;
          $Slide->FechaFin      = $row->FechaFin;
          $Slide->HoraInicio    = $row->LapsoDiainicio;
          $Slide->HoraFin       = $row->LapsoDiaFin;
          $Slide->NuevaPestana   = $row->NuevaPestana == '1' ? '_blank' : '_self';
          $data[] = $Slide;        
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }