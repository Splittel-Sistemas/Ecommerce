<?php
@session_start();
if (!class_exists('CuponesModel')) {
    include $_SERVER['DOCUMENT_ROOT'] . '/fibra-optica/models/Cupones/Cupones.Model.php';
}

class CuponesRouter
{
    public function AgregarCupon()
    {
        $respuesta = [];
        if (isset($_POST['codigo'])) {
            $id_pedido = isset($_SESSION['Ecommerce-PedidoKey']) ? $_SESSION['Ecommerce-PedidoKey'] : "";
            $cuponesModel = new CuponesModel();
            $respuesta = $cuponesModel->AplicarCupon($_POST['codigo'], $id_pedido);
            unset($cuponesModel);
        } else {
            $respuesta =  ['respuesta' => false, 'mensaje' => 'Faltan datos en la consulta.'];
        }
        return $respuesta;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cuponesRouter = new CuponesRouter();

    if (isset($_POST['accion'])) {
        switch ($_POST['accion']) {
            case 'agregar':
                echo json_encode($cuponesRouter->AgregarCupon());
                break;

            default:
                echo json_encode(['respuesta' => false, 'mensaje' => 'Acción no valida.']);
                break;
        }
    }

    unset($cuponesRouter);
}
