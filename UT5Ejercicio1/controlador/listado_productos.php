<?php

require_once '../servicios/Cesta_compra.php';
require_once '../modelo/DB.php';
require_once '../modelo/Producto.php';
require_once '../servicios/funciones.php';

comprobar_sesion();

// Recuperar la cesta de la compra
$cesta_compra = Cesta_compra::cargar_cesta();

// Comprobamos si se ha enviado el formulario de vaciar la cesta
if (isset($_POST['vaciar'])) {
    $cesta_compra->vaciar_cesta();
    $cesta_compra->guardar_cesta();
}


// comprobar si está vacía
$cesta_vacia = $cesta_compra->is_vacia();
$productos_cesta = $cesta_compra->get_productos();

$mensaje_excepcion = '';
$cod_familia = '';

// Obtener la lista de productos
if (isset($_REQUEST['familia'])) {
    $cod_familia = htmlspecialchars($_REQUEST['familia']);
    try {
        $productos = DB::obtiene_productos($cod_familia);
    } catch (Exception $exc) {
        $mensaje_excepcion = $exc->getMessage();
    }
}
require_once '../vista/vista_listado_productos.php';



