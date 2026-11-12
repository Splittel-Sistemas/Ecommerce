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

$arrayCategorias = [];
$arraySubCategorias = [];
$arrayProductos = [];
$arrayBlog = [];
$arrayCursos = [];
$arrayMasVendidos = [];

$connection = new Connection();
$mysqli = $connection->conexion();

$descripcionBusqueda = isset($_POST["Descripcion"]) ? mysqli_real_escape_string($mysqli, $_POST["Descripcion"]) : '';

if (trim($descripcionBusqueda) != '') {

    $likeFijo = "";
    $likeConfigurable = "";
    $likeSubCategoria = "";
    $likeCurso = "";
    $likeBlog = "";
    $palabrasClave = explode(" ", $descripcionBusqueda);
    foreach ($palabrasClave as $palabra) {
        if ($palabra != ""  && $palabra != "de" && $palabra != "DE" && $palabra != "O" && $palabra != "o" && $palabra != "para" && $palabra != "PARA" && $palabra != "con" && $palabra != "CON") {
            $likeFijo .= " OR desc_producto LIKE '%" . $palabra . "%'";
            $likeFijo .= " OR codigo LIKE '%" . $palabra . "%' ";
            $likeConfigurable .= " OR desc_subcategoria LIKE '%" . $palabra . "%'";
            $likeSubCategoria .= " OR descripcion LIKE '%" . $palabra . "%' ";
            $likeCurso .= " OR mce.title1 LIKE '%" . $palabra . "%'";
            $likeBlog .= " OR titulo LIKE '%" . $palabra . "%'";
        }
    }

    $subCategoria = $mysqli->query("SELECT * FROM menu_principal WHERE (id_categoria = '" . $descripcionBusqueda . "'" . $likeSubCategoria . ") AND nivel=2 AND activo='si' ");
    while ($fila = $subCategoria->fetch_assoc()) {
        $img = file_exists("../../public/images/img_spl/subcategorias/" . $fila['imagen'])
            ? "../../public/images/img_spl/subcategorias/" . $fila['imagen']
            : "../../public/images/img_spl/notfound.png";

        $arraySubCategorias[] = [
            'url' => "/fibra-optica/views/Productos/categorias.php?id_sbct=" . $fila['id'] . "&nom=" . url_amigable($fila['descripcion']),
            'img' => $img,
            'descripcion' => $fila['descripcion'],
            'cardcode' => $fila['id_categoria']
        ];
    }

    $productosConfigurables = $mysqli->query("SELECT codigo,folder_name,desc_subcategoria FROM menu_subcategorias_n1 WHERE (id_subcategoria = '" . $descripcionBusqueda . "'" . $likeConfigurable . ") AND activo='si'");
    while ($fila = $productosConfigurables->fetch_assoc()) {
        $url = "/fibra-optica/views/Productos/configurables.php?codigo=" . $fila['codigo'];
        $img = file_exists("../../public/images/img_spl/subsubcategorias/" . $fila['folder_name'] . ".jpg")
            ? "../../public/images/img_spl/subsubcategorias/" . $fila['folder_name'] . ".jpg"
            : "../../public/images/img_spl/notfound.png";

        $arraySubCategorias[] = [
            'url' => $url,
            'img' => $img,
            'descripcion' => $fila['desc_subcategoria'],
            'cardcode' => 'Configuralo'
        ];
    }

    $productosFijos = $mysqli->query("SELECT codigo,desc_producto,img_principal FROM catalogo_productos WHERE (codigo = '" . $descripcionBusqueda . "'" . $likeFijo . ") AND activo='si' AND (codigo_configurable='' OR configurablefijo='si' )");
    while ($fila = $productosFijos->fetch_assoc()) {
        $img = file_exists("../../public/images/img_spl/productos/" . $fila['codigo'] . "/thumbnail/" . $fila['img_principal'])
            ? "../../public/images/img_spl/productos/" . $fila['codigo'] . "/thumbnail/" . $fila['img_principal']
            : "../../public/images/img_spl/notfound.png";

        $arrayProductos[] = [
            'url' => '/fibra-optica/views/Productos/fijos.php?id_prd=' . urlencode($fila['codigo']) . '&nom=' . url_amigable($fila['desc_producto']),
            'img' => $img,
            'descripcion' => $fila['desc_producto'],
            'cardcode' => $fila['codigo']
        ];
    }

    $cursos = $mysqli->query("SELECT mce.id, mce.title, mce.title1, mce.link, mce.fecha, mc.img_general FROM menu_capacitaciones_eventos mce LEFT JOIN menu_cursos mc ON mce.id_curso = mc.id WHERE (title1 = '" . $descripcionBusqueda . "'" . $likeCurso . ") AND mce.activo = 'si' AND mce.start > CURDATE()");
    while ($fila = $cursos->fetch_assoc()) {
        $img = $fila['title'] == 'Develop' ? '../../public/images/img_spl/cursos/' . $fila['img_general'] : '../../public/images/img_spl/capacitaciones/Redlives_Banner1.jpg';
        $img = file_exists($img) ? $img : "../../public/images/img_spl/notfound.png";

        $arrayCursos[] = [
            'url' => $fila['link'],
            'img' => $img,
            'descripcion' => $fila['title1'],
            'cardcode' => $fila['fecha']
        ];
    }

    $blogs = $mysqli->query("SELECT id,img,fecha,comillas,titulo  FROM menu_blog WHERE (titulo = '" . $descripcionBusqueda . "'" . $likeBlog . ") AND activo = 'si' AND (pagina='Fibremex' OR pagina='ambas') ORDER BY fecha DESC");
    while ($fila = $blogs->fetch_assoc()) {
        $img = file_exists("../../public/images/img_spl/blog/" . $fila['img'])
            ? "../../public/images/img_spl/blog/" . $fila['img']
            : "../../public/images/img_spl/notfound.png";

        $formatter = new IntlDateFormatter(
            'es_MX',
            IntlDateFormatter::LONG,
            IntlDateFormatter::NONE,
            'America/Mexico_City'
        );

        $arrayBlog[] = [
            'url' => "/fibra-optica/views/Blog/detalle.php?id=" . $fila['id'] . "&nom=" . $fila['comillas'],
            'img' => $img,
            'descripcion' => $fila['titulo'],
            'cardcode' => $formatter->format(new DateTime($fila['fecha']))
        ];
    }
}

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

        $arrayMasVendidos[] = [
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

        $arrayMasVendidos[] = [
            'url' => $url,
            'img' => $img,
            'descripcion' => $fila['descripcion'],
            'cardcode' => 'Configuralo'
        ];
    }
}

$connection->closeConnection();
?>

<div class="row">
    <div class="col-12">
        <!-- PANEL DE RESULTADOS -->
        <div id="panelResultados" class="live-search-panel" style="display:block;">
            <!-- PESTAÑAS -->
            <div class="live-search-tabs">
                <ul class="nav nav-tabs" id="tabsResultados" role="tablist">
                    <li class="nav-item <?php echo ($descripcionBusqueda == '') ? '' : 'active' ?>">
                        <a class="nav-link <?php echo ($descripcionBusqueda == '') ? '' : 'active' ?>" data-toggle="tab" href="#resProductos" role="tab">
                            <i class="fas fa-box"></i> Productos <span><?php echo count($arrayProductos); ?></span>
                        </a>
                    </li>
                    <li class="nav-item <?php echo ($descripcionBusqueda == '') ? 'active' : '' ?>">
                        <a class="nav-link <?php echo ($descripcionBusqueda == '') ? 'active' : '' ?>" data-toggle="tab" href="#resProductosTop" role="tab">
                            <i class="fas fa-box"></i> Mas Vendidos <span><?php echo count($arrayMasVendidos); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#resSubCategorias" role="tab">
                            <i class="fas fa-box"></i> Categorias <span><?php echo count($arraySubCategorias); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#resCursos" role="tab">
                            <i class="fas fa-box"></i> Cursos <span><?php echo count($arrayCursos); ?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#resBlog" role="tab">
                            <i class="fas fa-box"></i> Blog <span><?php echo count($arrayBlog); ?></span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- CONTENIDO -->
            <div class="tab-content live-search-content">
                <!-- PRODUCTOS -->
                <div class="tab-pane <?php echo ($descripcionBusqueda == '') ? '' : 'fade show active' ?>" id="resProductos" role="tabpanel">
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

                <!-- MAS VENDIDOS -->
                <div class="tab-pane <?php echo ($descripcionBusqueda == '') ? 'fade show active' : '' ?>" id="resProductosTop" role="tabpanel">
                    <div class="result-list">
                        <?php
                        foreach ($arrayMasVendidos as $obj) {
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

                <!-- SUBCATEGORIAS -->
                <div class="tab-pane" id="resSubCategorias" role="tabpanel">
                    <div class="result-list">
                        <?php
                        foreach ($arraySubCategorias as $obj) {
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

                <!-- CURSOS -->
                <div class="tab-pane" id="resCursos" role="tabpanel">
                    <div class="result-list">
                        <?php
                        foreach ($arrayCursos as $obj) {
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

                <!-- BLOGS -->
                <div class="tab-pane" id="resBlog" role="tabpanel">
                    <div class="result-list">
                        <?php
                        foreach ($arrayBlog as $obj) {
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
                <span><?php echo count($arrayMasVendidos) + count($arrayCategorias) + count($arraySubCategorias) + count($arrayProductos) + count($arrayBlog) + count($arrayCursos); ?> resultados</span>
            </div>
        </div>
    </div>
</div>