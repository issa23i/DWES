<?php
require_once '../modelo/Cesta_compra.php';
require_once '../modelo/DB.php';
require_once '../modelo/Producto.php';
require_once 'funciones.php';

comprobar_sesion();

// Recuperar la cesta de la compra
$cesta = Cesta_compra::cargar_cesta();

// Comprobamos si se ha enviado el formulario de vaciar la cesta
if(isset($_POST['vaciar'])){
    $cesta->vaciar_cesta();
    $cesta->guardar_cesta($cesta);
}


// comprobar si está vacía
$cesta_vacia = $cesta->is_vacia();


$mensaje_conexion = '';
$cod_familia = '';

// Obtener la lista de productos
if(isset($_REQUEST['familia'])){
    $cod_familia = $_REQUEST['familia'];
    try {
        $productos = DB::obtiene_productos($cod_familia);
    } catch (Exception $exc) {
        $mensaje_conexion =  $exc->getMessage();
    }
}



