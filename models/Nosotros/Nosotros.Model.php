<?php 

  /**
   * 
   */
  class Nosotros_{

    public $Titulo;
    public $ImgPrincipal;
    public $Img2;
    public $Img3;
    public $Img4;
    public $Subtitulo1;
    public $Texto1;
    public $Subtitulo2;
    public $Texto2;
    public $Subtitulo3;
    public $Texto3;
    public $Subtitulo4;
    public $Texto4;

    public function SetParameters($conn, $Tool){
      $this->conn = $conn;
      $this->Tool = $Tool;
    }

    public function GetTitulo(){
      return $this->Titulo;
    }public function GetImgPrincipal(){
      return $this->ImgPrincipal;
    }public function GetImg2(){
      return $this->Img2;
    }public function GetImg3(){
      return $this->Img3;
    }public function GetImg4(){
      return $this->Img4;
    }public function GetSubtitulo1(){
      return $this->Subtitulo1;
    }public function GetTexto1(){
      return $this->Texto1;
    }public function GetSubtitulo2(){
      return $this->Subtitulo2;
    }public function GetTexto2(){
      return $this->Texto2;
    }public function GetSubtitulo3(){
      return $this->Subtitulo3;
    }public function GetTexto3(){
      return $this->Texto3;
    }public function GetSubtitulo4(){
      return $this->Subtitulo4;
    }public function GetTexto4(){
      return $this->Texto4;
    }

    /**
     * Description
     *
     * @param string $a Foo
     *
     * @return int $b Bar
     */
    public function Get(){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_nosotros ";
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $data = array(); 
        while ($row = $result->fetch_object()) {
          $Nosotros = new Nosotros_();
          $Nosotros->Titulo         = $row->titulo;
          $Nosotros->ImgPrincipal   = $row->img_principal;
          $Nosotros->Img2           = $row->img2;
          $Nosotros->Img3           = $row->img3;
          $Nosotros->Img4           = $row->img4;
          $Nosotros->Subtitulo1     = $row->subtitulo1;
          $Nosotros->Texto1         = $row->texto1;
          $Nosotros->Subtitulo2     = $row->subtitulo2;
          $Nosotros->Texto2         = $row->texto2;
          $Nosotros->Subtitulo3     = $row->subtitulo3;
          $Nosotros->Texto3         = $row->texto3;
          $Nosotros->Subtitulo4     = $row->subtitulo4;
          $Nosotros->Texto4         = $row->texto4;
          $data[] = $Nosotros;
        }
        return $data;
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
    public function GetBy(){
      try {
        $SQLSTATEMENT = "SELECT * FROM menu_nosotros ";
        $result = $this->conn->QueryReturn($SQLSTATEMENT);
        $data = false; 
        while ($row = $result->fetch_object()) {
          $this->Titulo         = $row->titulo;
          $this->ImgPrincipal   = $row->img_principal;
          $this->Img2           = $row->img2;
          $this->Img3           = $row->img3;
          $this->Img4           = $row->img4;
          $this->Subtitulo1     = $row->subtitulo1;
          $this->Texto1         = $row->texto1;
          $this->Subtitulo2     = $row->subtitulo2;
          $this->Texto2         = $row->texto2;
          $this->Subtitulo3     = $row->subtitulo3;
          $this->Texto3         = $row->texto3;
          $this->Subtitulo4     = $row->subtitulo4;
          $this->Texto4         = $row->texto4;
          $data = true;
        }
        return $data;
      } catch (Exception $e) {
        throw $e;
      }
    }

  }