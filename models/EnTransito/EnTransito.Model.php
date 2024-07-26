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
      $SQLSTATEMENT = "SELECT tipo,codigo,SUM(cantidad) cantidad, SUM(disponible) disponible, fecha FROM t57_transito " . $filter . " " . $order . " GROUP BY fecha, tipo ORDER BY fecha ";
      // echo $SQLSTATEMENT;
      $results = $this->Connection->QueryReturn($SQLSTATEMENT);
      $data = [];
      $resta=0;
      $fecha_inicio="0000-00-00";
      $fecha_fin="0000-00-00";
      
      while ($rows = $results->fetch_object()) {
        $Categoria = new EnTransito();
          /**En caso de que 2 pedidos lleguen tengan fecha de entrega el mismo día, se suman y nada más aparecen como 1 pedido */
          if($fecha_fin!=$rows->fecha){
          /**Iniciamos la fecha fin esto es un tope para ir sacando los datos de tal fecha_inicio a fecha_fin */
          $fecha_fin=$rows->fecha;
          /**Consulta para traer la suma de los pedidos que hay en 1 mismo dia */
          $sql_2="SELECT SUM(cantidad) as suma FROM t57_transito WHERE codigo='$rows->codigo' AND tipo IN ('PO') AND fecha='$fecha_fin' ORDER BY fecha";
          $consulta_2=$this->Connection->QueryReturn($sql_2);
          $row22=$consulta_2->fetch_array(MYSQLI_BOTH);
          /**Consulta para traer la suma de las ordenes de la fecha inicio a la fecha fin*/
          $sql_1="SELECT SUM(cantidad) as suma FROM t57_transito WHERE codigo='$rows->codigo' AND tipo IN ('OR') AND ( fecha>='$fecha_inicio')  AND ( fecha<='$fecha_fin') ";
          $consulta_1=$this->Connection->QueryReturn($sql_1);
          $row21=$consulta_1->fetch_array(MYSQLI_BOTH);
          /**El total que va quedando se saca de restar la suma de ordenes menos la suma de los pedidos*/
           $total_queda=$row22['suma']-$row21['suma']-$resta;
         
          /**En caso de que el total sea negativo, se guarad en una variable para descontarlo del siguiente pedido*/
          if($total_queda<0){
              $resta=$total_queda*(-1);
          }else{$resta=0;}
          /**Si el total  que queda es menor a 0 no se imprime en la tabla*/
          if($total_queda>=0){
            $Categoria->Tipo     =   $rows->tipo;
            $Categoria->Codigo   =   $rows->codigo;
            $Categoria->Fecha   =   $rows->fecha;
            $Categoria->Cantidad   =   $total_queda;
            $data[] = $Categoria;
          }
      $fecha_inicio=$rows->fecha;
      $fecha_inicio=date('Y-m-d', strtotime($fecha_inicio . ' +1 day'));

      }

    }

        
      unset($Categoria);
      return $data;
    } catch (Exception $e) {
      throw $e;
    }
  }

}
