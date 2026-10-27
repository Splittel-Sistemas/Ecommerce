<?php
if (isset($_POST['codigo'])) {

    if (!class_exists("ProductoController")) {
        include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Producto.Controller.php';
    }

    $ProductoController = new ProductoController();
    $ProductoController->filter = "WHERE codigo = '" . $_POST['codigo'] . "' AND producto_activo = 'si' ";
    $ProductoController->order = "";
    $Obj = $ProductoController->GetByProductosFijos();

    if (!class_exists("RelacionadosController")) {
        include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Relacionados.Controller.php';
    }
    $RelacionadosController = new RelacionadosController();
    $RelacionadosController->filter = "WHERE tipo='fijo' AND id_codigo = '" . $Obj->ProductoRelacionados . "' ";
    $RelacionadosController->order = "";
    $ResultProductosRelacionados = $RelacionadosController->GetFijos();
    if ($ResultProductosRelacionados->count > 0) {
        foreach ($ResultProductosRelacionados->records as $key => $ProductoRelacionado) {
            $ProductoController->filter = "WHERE codigo = '" . $ProductoRelacionado->Codigo . "' AND activo = 'si' ";
            $Obj_ = $ProductoController->GetBy();
            $imgUrl = file_exists("../../public/images/img_spl/productos/" . $Obj_->Codigo . "/thumbnail/" . $Obj_->ImgPrincipal . "")
                ? "../../public/images/img_spl/productos/" . $Obj_->Codigo . "/thumbnail/" . $Obj_->ImgPrincipal . ""
                : $_SESSION['Ecommerce-ImgNotFound1'];

?>
            <tr>
                <td scope="row" class="text-center align-middle">
                    <a href="fijos.php?id_prd=<?php echo $Obj_->Codigo ?>"><img src="<?php echo $imgUrl; ?>" /></a>
                </td>
                <td class="text-center align-middle"><span class="styleClave"><?php echo $Obj_->Codigo; ?></span></td>
                <td class="text-center align-middle"><?php echo $Obj_->Descripcion; ?></td>
                <?php if (isset($_SESSION['Ecommerce-ClienteNombre'])) {
                    if ($_SESSION['CurrencySite'] == 'USD') {
                ?>
                        <td class="text-center align-middle">$<?php echo bcdiv($Obj_->Precio - ($Obj_->Precio * ($Obj_->Descuento / 100)), 1, 3); ?> USD</td>
                    <?php
                    } else {
                        $PL1 = bcdiv($Obj_->Precio - ($Obj_->Precio * ($Obj_->Descuento / 100)), 1, 3);
                    ?>
                        <td class="text-center align-middle">$<?php echo number_format(bcdiv(($PL1 * $_SESSION['Ecommerce-WS-CurrencyRate']), 1, 3), 3); ?> MXN</td>
                    <?php
                    }
                    ?>
                    <td class="text-center align-middle"><?php echo $Obj_->Existencia; ?></td>
                <?php
                }
                ?>
                <td class="text-center align-middle">
                    <input type="hidden" name="ProductoCantidad-<?php echo $Obj_->Codigo; ?>" id="ProductoCantidad-<?php echo $Obj_->Codigo; ?>" value="1">


                    <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
                        <button style="background-color: #bc2130;" class="btn btn-primary btn-block m-0" descuento="<?php echo $Obj_->Descuento ?>" codigo="<?php echo $Obj_->Codigo; ?>" onclick="add(this)">
                            <i class="icon-shopping-cart"></i>
                        </button> <?php } else { ?>
                        <a class="product-button" href="../Login/"> <button style="background-color: #bc2130;" class="btn btn-primary btn-block m-0" descuento="<?php echo $Obj_->Descuento ?>" codigo="<?php echo $Obj_->Codigo; ?>">
                                <i class="icon-shopping-cart"></i>
                            </button> </a>
                    <?php } ?>


                </td>
            </tr>
    <?php
        }
    }
    ?>
    <?php
    if (!class_exists("RelacionadosController")) {
        include $_SERVER["DOCUMENT_ROOT"] . '/fibra-optica/models/Productos/Relacionados.Controller.php';
    }
    $RelacionadosController = new RelacionadosController();
    $RelacionadosController->filter = "WHERE tipo='conf' AND id_codigo = '" . $Obj->ProductoRelacionados . "' ";
    $RelacionadosController->order = "";
    $ResultProductosRelacionados = $RelacionadosController->GetFijos();

    if ($ResultProductosRelacionados->count > 0) {
        foreach ($ResultProductosRelacionados->records as $key => $ProductoRelacionado) {
            $SubcategoriasN1Controller = new SubcategoriasN1Controller();
            $SubcategoriasN1Controller->filter = "WHERE codigo = '" . $ProductoRelacionado->Codigo . "' AND activo='si' ";
            $ResultSubcategoriasN1Controller = $SubcategoriasN1Controller->get();

            if ($ResultSubcategoriasN1Controller->count > 0) {
                foreach ($ResultSubcategoriasN1Controller->records as $key => $subcategoria) {
                    $ConfiguracionPath = $subcategoria->Configuracion == 1
                        ? "../Productos/configurables.php?codigo=" . $subcategoria->Configuracion . " " : "#";

                    $imgUrl = file_exists(("../../public/images/img_spl/subsubcategorias/" . $subcategoria->FolderName . ".jpg"))
                        ? "../../public/images/img_spl/subsubcategorias/" . $subcategoria->FolderName . ".jpg"
                        : "../../public/images/img_spl/notfound1.png";

    ?>
                    <tr>
                        <td scope="row" class="text-center align-middle">
                            <a href="configurables.php?codigo=<?php echo $subcategoria->Codigo ?>"><img src="<?php echo $imgUrl; ?>" /></a>
                        </td>
                        <td class="text-center align-middle"><span class="styleClave"><?php ?></span></td>
                        <td class="text-center align-middle"><?php echo $subcategoria->Descripcion; ?></td>
                        <?php if (isset($_SESSION['Ecommerce-ClienteNombre'])) {
                        ?>
                            <td class="text-center align-middle"></td>
                            <td class="text-center align-middle"></td>
                        <?php
                        }
                        ?>
                        <td class="text-center align-middle">


                            <?php if (isset($_SESSION['Ecommerce-ClienteKey'])) { ?>
                                <button style="background-color: #bc2130;" class="btn btn-primary btn-block m-0" onclick="window.location.href='configurables.php?codigo=<?php echo $subcategoria->Codigo ?>'">
                                    Configúralo
                                </button> <?php } else { ?>
                                <a class="product-button" href="../Login/"> <button style="background-color: #bc2130;" class="btn btn-primary btn-block m-0" descuento="<?php echo $Obj_->Descuento ?>" codigo="<?php echo $Obj_->Codigo; ?>">
                                        <i class="icon-shopping-cart"></i>
                                    </button> </a>
                            <?php } ?>


                        </td>
                    </tr>
    <?php
                }
            }
        }
    }
    ?>

<?php
} else {
}
?>