<?php

require_once '../modelo/Cesta_compra.php';
require_once '../modelo/DB.php';
require_once '../modelo/Familia.php';
require_once 'funciones.php';

comprobar_sesion();

// Recuperar la cesta de la compra
$cesta = Cesta_compra::cargar_cesta();

// Comprobamos si se ha enviado el formulario de vaciar la cesta
if(isset($_POST['vaciar'])){
    $cesta->vaciar_cesta();
    $cesta->guardar_cesta($cesta);
}


$cesta_vacia = $cesta->is_vacia();


// Obtener el listado de familias
try {
    $listado_familias = DB::obtener_familias();
} catch (Exception $exc) {
    $mensaje_conexion = $exc->getMessage();
}
$mensaje_conexion = "<p>Conexión realizada con éxito</p>";

