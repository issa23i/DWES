<?php

require_once '../servicios/funciones.php';
require_once '../servicios/Cesta_compra.php';
comprobar_sesion();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cod = $_POST['cod'];
    $unid = $_POST['unid'];
    try {
        $cesta = Cesta_compra::cargar_cesta();
    } catch (Exception $ex) {
        echo $ex . getMessage();
        echo $ex . getTrace();
    }
    $cesta->carga_articulo($cod, $unid);
    $cesta->guardar_cesta();
}