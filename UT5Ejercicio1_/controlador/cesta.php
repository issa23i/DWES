<?php
require_once '../servicios/Cesta_compra.php';
require_once '../modelo/DB.php';
require_once '../modelo/Producto.php';
require_once '../servicios/funciones.php';

comprobar_sesion();

if(isset($_POST['cambiar_unidades'])){
    $unidades_cambiadas = $_POST['unidades_cambiadas'];
    $cod = $_POST['cod'];
    Cesta_compra::cambiar_unidades($cod, $unidades_cambiadas);
}

// Recuperar la cesta de la compra
$cesta_compra = Cesta_compra::cargar_cesta();
$cesta_vacia = $cesta_compra->is_vacia();

$productos = $cesta_compra->get_productos();
$total = $cesta_compra->get_coste();
