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

            //validacion de monto maximo

            $maximo = $datosCupon['gasto_maximo'];

            if ($PedidoModel->Total > $maximo) {
                $mysqli->rollback();
                return ['respuesta' => false, "mensaje" => "Este cupon solo se puede aplicar a una compra maxima de $" . number_format($maximo, 2) . " (USD)."];
            }

            $PedidoDetalle = new Detalle_();
            $PedidoDetalle->SetParameters($this->Connection, $this->Tool);
            $PedidoDetalle = $PedidoDetalle->ListDetallePedido("WHERE pedidokey = '" . $id_pedido . "' AND detalle_activo = 'si'", "");
            $seRealizoAjuste = false;

            if (count($PedidoDetalle) > 0) {
                foreach ($PedidoDetalle as $indice => $item) {
                    $productovalido = false;

                    if ($item->DetalleCodigoConfigurable == "") {
                        $sql_result = $mysqli->query("SELECT * FROM Admin_producto_categoria_subcategoria WHERE codigo = '" . $item->DetalleCodigo . "' AND activo = 'si'");
                    } else {
                        $sql_result = $mysqli->query("SELECT * FROM menu_subcategorias_n1 WHERE codigo = '" . $item->DetalleCodigoConfigurable . "' AND activo = 'si'");
                    }
                    if ($sql_result->num_rows > 0) {
                        $fila = $sql_result->fetch_assoc();
                        $categoriaProducto = $fila['id_subcategoria'];

                        if ($item->DetalleCodigoConfigurable == "") {
                            if ($item->ProductoDescuento != -1) {
                                continue;
                            }
                        } else {
                            if ($fila['descuento'] != -1) {
                                continue;
                            }
                        }

                        $relacionesCupon = [
                            'ProductosValidos' => [],
                            'ProductosNoValidos' => [],
                            'CategoriasValidas' => [],
                            'CategoriasNoValidas' => [],
                            'ClientesValidos' => [],
                            'ClientesNoValidos' => []
                        ];

                        $sql_result = $mysqli->query("SELECT * FROM relaciones_cupones WHERE id_cupon = " . $id_cupon);
                        if ($sql_result->num_rows > 0) {
                            while ($fila = $sql_result->fetch_assoc()) {
                                switch ($fila['tipo']) {
                                    case 1:
                                        $relacionesCupon['ProductosValidos'][] = $fila['valor'];
                                        break;
                                    case 2:
                                        $relacionesCupon['ProductosNoValidos'][] = $fila['valor'];
                                        break;
                                    case 3:
                                        $relacionesCupon['CategoriasValidas'][] = $fila['valor'];
                                        break;
                                    case 4:
                                        $relacionesCupon['CategoriasNoValidas'][] = $fila['valor'];
                                        break;
                                    case 5:
                                        $relacionesCupon['ClientesValidos'][] = $fila['valor'];
                                        break;
                                    case 5:
                                        $relacionesCupon['ClientesNoValidos'][] = $fila['valor'];
                                        break;
                                }
                            }
                        }

                        $productosPasaComoValido = (count($relacionesCupon['ProductosValidos']) > 0) ? in_array($item->DetalleCodigo, $relacionesCupon['ProductosValidos']) : true;
                        $productosPasaComoNoValido = (count($relacionesCupon['ProductosNoValidos']) > 0) ? in_array($item->DetalleCodigo, $relacionesCupon['ProductosNoValidos']) : false;

                        $categoriaPasaComoValido = (count($relacionesCupon['CategoriasValidas']) > 0) ? in_array($categoriaProducto, $relacionesCupon['CategoriasValidas']) : true;
                        $categoriaPasaComoNoValido = (count($relacionesCupon['CategoriasNoValidas']) > 0) ? in_array($categoriaProducto, $relacionesCupon['CategoriasNoValidas']) : false;

                        $clientePasaComoValido = (count($relacionesCupon['ClientesValidos']) > 0) ? in_array($item->ClienteKey, $relacionesCupon['ClientesValidos']) : true;
                        $clientePasaComoNoValido = (count($relacionesCupon['ClientesNoValidos']) > 0) ? in_array($item->ClienteKey, $relacionesCupon['ClientesNoValidos']) : false;

                        if ($clientePasaComoValido && !$clientePasaComoNoValido) {
                            if ($categoriaPasaComoValido && !$categoriaPasaComoNoValido) {
                                $productovalido = true;
                                if ($productosPasaComoNoValido) {
                                    $productovalido = false;
                                }
                            } else {
                                if ($productosPasaComoValido && !$productosPasaComoNoValido) {
                                    $productovalido = true;
                                }
                            }
                        }
                    }

                    if ($productovalido) {

                        $descuentoAplicado = 0;
                        if ($PedidoDetalle[$indice]->DetalleDescuento >= $datosCupon['importe']) {
                            $descuentoAplicado = $PedidoDetalle[$indice]->DetalleDescuento + $datosCupon['importe_extra'];
                        } else {
                            $descuentoAplicado = $datosCupon['importe'];
                        }

                        if ($descuentoAplicado > 100) {
                            $mysqli->rollback();
                            return ['respuesta' => false, "mensaje" => "Existe un error con su cupon, por favor contactar con su ejecutivo."];
                        }

                        $subTotal = $PedidoDetalle[$indice]->DetalleSubtotalSinDescuento * (1 - ($descuentoAplicado / 100));
                        $total = $subTotal + $PedidoDetalle[$indice]->DetalleIva;

                        $sql_result = $mysqli->query("UPDATE cotizacion_detalle SET subtotal = " . $subTotal . ", total = " . $total . " WHERE id_cotizacion = " . $id_pedido . " AND codigo = '" . $item->DetalleCodigo . "' AND activo ='si'");
                        if ($sql_result) {
                            $seRealizoAjuste = true;
                        }

                        $sql_result = $mysqli->query("INSERT INTO relacion_cupones_compra (id_cupon, id_pedido, id_producto, descuento, usado) VALUES(" . $id_cupon . ", " . $id_pedido . ", '" . $PedidoDetalle[$indice]->DetalleCodigo . "', " . $descuentoAplicado . ", 0)");

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
