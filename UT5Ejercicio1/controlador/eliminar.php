<?php

require_once '../servicios/Cesta_compra.php';
require_once '../modelo/DB.php';
require_once '../modelo/Producto.php';
require_once '../servicios/funciones.php';

comprobar_sesion();

if (isset($_POST['cambiar_unidades'])) {
    $unidades_cambiadas = $_POST['unidades_cambiadas'];
    $cod = $_POST['cod'];
    // cesta compra get,update,put
    $cesta_compra = Cesta_compra::cargar_cesta();
    $cesta_compra->cambiar_unidades($cod, $unidades_cambiadas);
    $cesta_compra->guardar_cesta($cesta_compra);
}

// Recuperar la cesta de la compra
$cesta_compra = Cesta_compra::cargar_cesta();

header('Location: ../controlador/cesta.php');

