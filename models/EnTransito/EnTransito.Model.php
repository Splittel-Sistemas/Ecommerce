<?php
class EnTransito
{
  public $Tipo;
  public $Codigo;
  public $Cantidad;
  public $Disponible;
  public $Fecha;

  protected $Connection;
  protected $Tool;

  private function StartObjects()
  {
    $this->conn = new Connection();
    $this->Tool = new Functions_tools();
  }

  public function SetParameters($conn, $Tool)
  {
    $this->Connection = $conn;
    $this->Tool = $Tool;
  }

  public function Get($filter, $order)
  {
    try {
      $SQLSTATEMENT = "SELECT tipo,codigo,SUM(cantidad) cantidad, SUM(disponible) disponible, fecha FROM t57_transito " . $filter . " " . $order . " GROUP BY fecha, tipo ORDER BY fecha ASC";
      // echo $SQLSTATEMENT;
      $results = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = [];
      $total_queda=0;
      $total_restan=0;
      while ($rows = $results->fetch_object()) {
        $Categoria = new EnTransito();

        $SQLSTATEMENTs = "SELECT tipo,codigo,SUM(cantidad) cantidad, SUM(disponible) disponible, fecha FROM t57_transito WHERE tipo IN ('OR') AND codigo IN ('".$rows->codigo."')  GROUP BY codigo, tipo";
        $result = $this->Connection->QueryReturn($SQLSTATEMENTs);
        if($row = $result->fetch_object()){
        $CantidadRows= ($row->cantidad) ? $row->cantidad : 0;
        }else{
          $CantidadRows=0;
        }

        $Categoria->Tipo     =   $rows->tipo;
        $Categoria->Codigo   =   $rows->codigo;
        $Categoria->Fecha   =   $rows->fecha;
        if($total_restan==0){
          if($rows->cantidad - $CantidadRows  > 0){
            $total_restan = $rows->cantidad-$CantidadRows;
            $Categoria->Cantidad   =   $total_restan;
          }else{
            $total_restan = $rows->cantidad-$CantidadRows;
            $Categoria->Cantidad   =   0;
          }
        }elseif($total_restan<0){
          if($rows->cantidad + $total_restan > 0){
            $total_restan = $rows->cantidad+$total_restan;
            $Categoria->Cantidad   =   $total_restan;
          }else{
            $total_restan = $rows->cantidad-$CantidadRows ;
            $Categoria->Cantidad   =   0;
          }
      }elseif($total_restan>0){
          $Categoria->Cantidad   =   $rows->cantidad;
          $total_restan =0;
      }
      
        $data[] = $Categoria;
       
      }
      unset($Categoria);
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }

}
