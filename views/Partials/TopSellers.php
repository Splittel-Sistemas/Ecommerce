<?php
if (!class_exists("Connection")) {
    include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Tools/Connection.php';
}

function url_amigable($texto)
{
    $texto = mb_strtolower((string)($texto ?? ''), 'UTF-8');
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $texto);
    $texto = preg_replace('/[^a-z0-9]+/', '-', $texto);
    return trim($texto, '-');
}

$connection = new Connection();
$mysqli = $connection->conexion();

$arrayProductos = [];

$ultimosProductosVendidos = $mysqli->query("SELECT
        CASE
            WHEN cd.code_configurable IS NOT NULL
                AND cd.code_configurable <> ''
            THEN 'config'
            ELSE 'fijo'
        END AS tipo,
        CASE
            WHEN cd.code_configurable IS NOT NULL
                AND cd.code_configurable <> ''
            THEN cd.code_configurable
            ELSE cd.codigo
        END AS codigo,
        CASE
            WHEN cd.code_configurable IS NOT NULL
                AND cd.code_configurable <> ''
            THEN msn.desc_subcategoria
            ELSE cp.desc_producto
        END AS descripcion,
        CASE
            WHEN cd.code_configurable IS NOT NULL
                AND cd.code_configurable <> ''
            THEN msn.folder_name
            ELSE cp.img_principal
        END AS imagen,
        COUNT(*) AS cantidad
    FROM cotizacion_encabezado ce
    INNER JOIN cotizacion_detalle cd
        ON ce.id = cd.id_cotizacion
        AND cd.activo = 'si'
    LEFT JOIN catalogo_productos cp
        ON cp.codigo = cd.codigo
    LEFT JOIN menu_subcategorias_n1 msn
        ON msn.codigo = cd.code_configurable
    WHERE
        ce.estatus = 'C'
        AND ce.fecha >= CURDATE() - INTERVAL 30 DAY
        AND ce.fecha < CURDATE() + INTERVAL 1 DAY
    GROUP BY
        codigo,
        descripcion
    ORDER BY cantidad DESC");

while ($fila = $ultimosProductosVendidos->fetch_assoc()) {
    if ($fila['tipo'] == 'fijo') {
        $img = file_exists("../../public/images/img_spl/productos/" . $fila['codigo'] . "/thumbnail/" . $fila['imagen'])
            ? "../../public/images/img_spl/productos/" . $fila['codigo'] . "/thumbnail/" . $fila['imagen']
            : "../../public/images/img_spl/notfound.png";

        $arrayProductos[] = [
            'url' => '/fibra-optica/views/Productos/fijos.php?id_prd=' . urlencode($fila['codigo']) . '&nom=' . url_amigable($fila['descripcion']),
            'img' => $img,
            'descripcion' => $fila['descripcion'],
            'cardcode' => $fila['codigo']
        ];
    } else {
        $url = "/fibra-optica/views/Productos/configurables.php?codigo=" . $fila['codigo'];
        $img = file_exists("../../public/images/img_spl/subsubcategorias/" . $fila['imagen'] . ".jpg")
            ? "../../public/images/img_spl/subsubcategorias/" . $fila['imagen'] . ".jpg"
            : "../../public/images/img_spl/notfound.png";

        $arrayProductos[] = [
            'url' => $url,
            'img' => $img,
            'descripcion' => $fila['descripcion'],
            'cardcode' => 'Configuralo'
        ];
    }
}
?>

<div class="row">
    <div class="col-12">
        <!-- PANEL DE RESULTADOS -->
        <div id="panelResultados" class="live-search-panel" style="display:block;">
            <!-- PESTAÑAS -->
            <div class="live-search-tabs">
                <ul class="nav nav-tabs" id="tabsResultados" role="tablist">
                    <li class="nav-item active">
                        <a class="nav-link active" data-toggle="tab" href="#resProductos" role="tab">
                            <i class="fas fa-box"></i> Productos Mas Vendidos <span><?php echo count($arrayProductos); ?></span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- CONTENIDO -->
            <div class="tab-content live-search-content">
                <!-- PRODUCTOS -->
                <div class="tab-pane fade show active" id="resProductos" role="tabpanel">
                    <div class="result-list">
                        <?php
                        foreach ($arrayProductos as $obj) {
                        ?>
                            <a href="<?php echo $obj['url']; ?>" style="text-decoration: none;">
                                <div class="result-item">
                                    <div class="result-image">
                                        <img src="<?php echo $obj['img']; ?>" alt="">
                                    </div>
                                    <div class="result-description">
                                        <h6><?php echo $obj['descripcion']; ?></h6>
                                        <p><?php echo $obj['cardcode']; ?></p>
                                    </div>
                                    <div class="result-arrow">&gt;</div>
                                </div>
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            </div>

            <!-- PIE -->
            <div class="live-search-footer">
                <span><?php echo count($arrayProductos); ?> resultados</span>
            </div>
        </div>
    </div>
</div>