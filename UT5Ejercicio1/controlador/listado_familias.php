<?php

require_once '../modelo/Cesta_compra.php';
require_once '../modelo/DB.php';
require_once '../modelo/Familia.php';
require_once 'funciones.php';

comprobar_sesion();


// Comprobamos si se ha enviado el formulario de vaciar la cesta
if(isset($_POST['vaciar'])){
    Cesta_compra::vaciar_cesta();
}

// Recuperar la cesta de la compra
$cesta = Cesta_compra::cargar_cesta();
$cesta_vacia = Cesta_compra::is_vacia();


// Obtener el listado de familias
try {
    $listado_familias = DB::obtener_familias();
} catch (Exception $exc) {
    $mensaje_conexion = $exc->getMessage();
}
$mensaje_conexion = "<p>Conexión realizada con éxito</p>";

