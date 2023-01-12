<?php
require_once '../modelo/Cesta_compra.php';
require_once '../modelo/DB.php';
require_once '../modelo/Producto.php';
require_once 'funciones.php';

comprobar_sesion();

if(isset($_POST['cambiar_unidades'])){
    $unidades_cambiadas = $_POST['unidades_cambiadas'];
    $cod = $_POST['cod'];
    Cesta_compra::cambiar_unidades($cod, $unidades_cambiadas);
}

// Recuperar la cesta de la compra
$cesta = Cesta_compra::cargar_cesta();
$cesta_vacia = $cesta->is_vacia();

$total = $cesta->get_coste();
