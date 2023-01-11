<?php
require_once '../modelo/Cesta_compra.php';
require_once '../modelo/DB.php';
require_once '../modelo/Producto.php';
require_once 'funciones.php';

comprobar_sesion();

// Comprobamos si se ha enviado el formulario de vaciar la cesta
if(isset($_POST['vaciar'])){
    Cesta_compra::vaciar_cesta();
}


// Recuperar la cesta de la compra
$cesta = Cesta_compra::cargar_cesta();
$cesta_vacia = Cesta_compra::is_vacia();


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



