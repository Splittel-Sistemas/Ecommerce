<?php 

  include '../Librerias/TCPDF/tcpdf.php';
  /**
   * @autor: Ing. Jesus Herrera
   */
  class MYTCPDF {
    private $Obj_PDF;
    
    public function __construct(){
      try {
        $this->Obj_PDF  = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      } catch (Exception $e) {
        throw $e;
      }
    }

    // 
    public function connection(){
      return $this->Obj_PDF;
    }

    // 
    public function Output($url, $mode){
      ob_end_clean();
      return $this->Obj_PDF->Output($url, $mode);
    }
  }