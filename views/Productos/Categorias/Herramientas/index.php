<?php


    switch ($_GET['codigo']) {
        case 'C78':
            include 'Simple.php';
            break;
        case 'C79':
            include 'ProteccionUV.php';
            break;
        case 'C80':
            include 'FondoReflectivo.php';
            break;
        case 'C81':
            include 'Bandera.php';
            break;
        case 'C82':
            include 'Etiqueta.php';
            break;
        case 'C83':
            include 'Autolaminado.php';
            break;
        default:
            
            break;
    }