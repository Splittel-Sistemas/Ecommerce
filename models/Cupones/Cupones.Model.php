<?php
if (!class_exists('Connection')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Tools/Connection.php';
}

if (!class_exists('Functions_tools')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Tools/Functions_tools.php';
}

if (!class_exists('Detalle_')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Pedido/Detalle.Model.php';
}

if (!class_exists('Pedido_')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Pedido/Pedido.Model.php';
}

class CuponesModel
{
    protected $Connection;
    protected $Tool;

    public function __construct()
    {
        $this->Connection = new Connection();
        $this->Tool = new Functions_tools();
    }

    public function AplicarCupon($codigo_cupon, $id_pedido)
    {
        $mysqli = $this->Connection->conexion();
        try {
            if (!($mysqli instanceof mysqli)) {
                throw new Exception("Error de conexión.", 1);
            }

            $mysqli->begin_transaction();

            //verificacion de cupon existente, activo y vigente

            $sql_result = $mysqli->query("SELECT * FROM cupones WHERE codigo = '" . $codigo_cupon . "' AND estado = 1 AND vigencia >= CURDATE()");
            if ($sql_result->num_rows == 0) {
                $mysqli->rollback();
                return ['respuesta' => false, "mensaje" => "El cupon no fue encontrado o ya no esta activo."];
            }

            $datosCupon = $sql_result->fetch_assoc();

            //verificacion si cupon ya fue usado en el pedido actual

            $id_cupon = $datosCupon['id'];

            $sql_result = $mysqli->query("SELECT * FROM relacion_cupones_compra WHERE id_pedido = " . $id_pedido);

            if ($sql_result->num_rows > 0) {
                $mysqli->rollback();
                return ['respuesta' => false, "mensaje" => "El cupon ya fue utilizado en este pedido o ya fue utilizado un cupon en este pedido."];
            }

            //verificacion si cupon ya fue usado por el cliente

            $sql_result = $mysqli->query("SELECT * FROM cotizacion_encabezado ce INNER JOIN relacion_cupones_compra rcc ON ce.id = rcc.id_pedido WHERE ce.id_cliente = (SELECT id_cliente FROM cotizacion_encabezado WHERE id = " . $id_pedido . " LIMIT 1) AND rcc.id_cupon = " . $id_cupon . " AND rcc.usado = 1 GROUP BY ce.id;");

            if ($sql_result->num_rows > 0) {
                $mysqli->rollback();
                return ['respuesta' => false, "mensaje" => "El cupon ya fue utilizado con anterioridad."];
            }

            //validacion usos del cupon
            $limiteUsoCupon = $datosCupon['limite_uso_cupon'];

            if ($limiteUsoCupon != 0) {
                $sql_result = $mysqli->query("SELECT COUNT(*) AS usos FROM (SELECT * FROM relacion_cupones_compra WHERE usado = 1 GROUP BY id_pedido, id_cupon) T1");

                if ($sql_result) {
                    $fila = $sql_result->fetch_assoc();

                    if ($fila['usos'] >= $limiteUsoCupon) {
                        $mysqli->rollback();
                        return ['respuesta' => false, "mensaje" => "Se a sobrepasado el uso del cupon."];
                    }
                } else {
                    $mysqli->rollback();
                    return ['respuesta' => false, "mensaje" => "Error al validar usos del cupon."];
                }
            }

            //validacion de monto minimo

            $PedidoModel = new Pedido_();
            $PedidoModel->SetParameters($this->Connection, $this->Tool);
            $PedidoExiste = $PedidoModel->GetBy("where id = '" . $id_pedido . "' ");

            if (!$PedidoExiste) {
                $mysqli->rollback();
                return ['respuesta' => false, "mensaje" => "Ocurrio un error al obtener el pedido."];
            }

            $minimo = $datosCupon['gasto_minimo'];

            if ($minimo > $PedidoModel->Total) {
                $mysqli->rollback();
                return ['respuesta' => false, "mensaje" => "Este cupon requiere una compra minima mayor."];
            }

            $PedidoDetalle = new Detalle_();
            $PedidoDetalle->SetParameters($this->Connection, $this->Tool);
            $PedidoDetalle = $PedidoDetalle->ListDetallePedido("WHERE pedidokey = '" . $id_pedido . "' AND detalle_activo = 'si'", "");
            $seRealizoAjuste = false;

            if (count($PedidoDetalle) > 0) {
                foreach ($PedidoDetalle as $indice => $item) {
                    $sql_result = $mysqli->query("CALL verificar_uso_cupon(" . $id_cupon . ",'" . $item->ProductoCodigo . "','" . $item->ClienteKey . "')");
                    if (($sql_result instanceof mysqli_result) && $sql_result->num_rows > 0) {
                        $fila = $sql_result->fetch_assoc();

                        //liberacion de mysqli
                        while ($mysqli->more_results() && $mysqli->next_result()) {
                            if ($temp = $mysqli->store_result()) {
                                $temp->free();
                            }
                        }

                        $descuentoAplicado = 0;
                        if ($PedidoDetalle[$indice]->DetalleDescuento <= $fila['importe']) {
                            $descuentoAplicado = $PedidoDetalle[$indice]->DetalleDescuento + $fila['importe_extra'];
                        } else {
                            $descuentoAplicado = $fila['importe'];
                        }

                        if ($descuentoAplicado > 100) {
                            $mysqli->rollback();
                            return ['respuesta' => false, "mensaje" => "Existe un error con su cupon, por favor contactar con su ejecutivo."];
                        }

                        $subTotal = $PedidoDetalle[$indice]->DetalleSubtotalSinDescuento * (1 - ($descuentoAplicado / 100));
                        $total = $subTotal + $PedidoDetalle[$indice]->DetalleIva;

                        $sql_result = $mysqli->query("UPDATE cotizacion_detalle SET subtotal = " . $subTotal . ", total = " . $total . " WHERE id_cotizacion = " . $id_pedido . " AND codigo = '" . $item->ProductoCodigo . "' AND activo ='si'");
                        if ($sql_result) {
                            $seRealizoAjuste = true;
                        }

                        $sql_result = $mysqli->query("INSERT INTO relacion_cupones_compra (id_cupon, id_pedido, id_producto, descuento, usado) VALUES(" . $id_cupon . ", " . $id_pedido . ", '" . $PedidoDetalle[$indice]->ProductoCodigo . "', " . $descuentoAplicado . ", 0)");

                        if (!$sql_result) {
                            $mysqli->rollback();
                            return ['respuesta' => false, "mensaje" => "Error al aplicar el cupon."];
                        }
                    }
                }
            }

            if ($seRealizoAjuste) {
                $sql_result = $mysqli->query("UPDATE cotizacion_encabezado SET	
                        subtotal = (SELECT SUM(subtotal) FROM cotizacion_detalle WHERE id_cotizacion = " . $id_pedido . " AND activo = 'si'),
                        iva = (SELECT SUM(iva) FROM cotizacion_detalle WHERE id_cotizacion = " . $id_pedido . " AND activo = 'si'),
                        total = (SELECT SUM(Total) FROM cotizacion_detalle WHERE id_cotizacion = " . $id_pedido . " AND activo = 'si')
                    WHERE id = " . $id_pedido);

                if (!$sql_result) {
                    $mysqli->rollback();
                    return ['respuesta' => false, "mensaje" => "Ocurrio un error al actualizar el pedido."];
                } else {
                    $mysqli->commit();
                    return ['respuesta' => true, "mensaje" => "Cupon aplicado correctamente."];
                }
            } else {
                $mysqli->rollback();
                return ['respuesta' => false, "mensaje" => "Este cupon no es aplicable a su compra."];
            }
        } catch (Exception $ex) {
            if ($mysqli instanceof mysqli) {
                $mysqli->rollback();
            }
            return ['respuesta' => false, "mensaje" => "Error inesperado al utilizar el cupon."];
        } finally {
            if ($mysqli instanceof mysqli) {
                $mysqli->close();
            }
        }
    }

    public function EliminarCuponesPedido($id_pedido)
    {
        $mysqli = $this->Connection->conexion();
        try {
            if (!($mysqli instanceof mysqli)) {
                throw new Exception("Error de conexión.", 1);
            }
            $mysqli->query("DELETE FROM relacion_cupones_compra WHERE id_pedido = " . $id_pedido . " AND usado = 0");
        } catch (Exception $ex) {
            //
        } finally {
            if ($mysqli instanceof mysqli) {
                $mysqli->close();
            }
        }
    }

    public function ObtenerDescuentoProductoPedido($id_pedido, $id_producto)
    {
        $mysqli = $this->Connection->conexion();
        try {
            if (!($mysqli instanceof mysqli)) {
                throw new Exception("Error de conexión.", 1);
            }
            $sql_result = $mysqli->query("SELECT descuento FROM relacion_cupones_compra WHERE id_pedido = " . $id_pedido . " AND id_producto = '" . $id_producto . "'");
            if ($sql_result && $sql_result->num_rows > 0) {
                $fila = $sql_result->fetch_assoc();
                return $fila['descuento'];
            } else {
                return 0;
            }
        } catch (Exception $ex) {
            return 0;
        } finally {
            if ($mysqli instanceof mysqli) {
                $mysqli->close();
            }
        }
    }

    public function MarcarUsarCupon($id_pedido)
    {
        $mysqli = $this->Connection->conexion();
        try {
            if (!($mysqli instanceof mysqli)) {
                throw new Exception("Error de conexión.", 1);
            }
            $mysqli->query("UPDATE relacion_cupones_compra SET usado = 1 WHERE id_pedido = " . $id_pedido);
        } catch (Exception $ex) {
            return 0;
        } finally {
            if ($mysqli instanceof mysqli) {
                $mysqli->close();
            }
        }
    }
}
