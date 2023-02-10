<?php
require_once '../servicios/funciones.php';
require_once '../servicios/Cesta_compra.php';
comprobar_sesion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cod = $_POST['cod'];
    try {
        $cesta_compra = Cesta_compra::cargar_cesta();
    } catch (Exception $ex) {
        echo $ex . getMessage();
        echo $ex . getTrace();
    }
    $cesta_compra->eliminar_producto($cod);
    $cesta_compra->guardar_cesta();
}
