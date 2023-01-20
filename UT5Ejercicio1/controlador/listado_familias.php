<?php

require_once '../servicios/Cesta_compra.php';
require_once '../modelo/DB.php';
require_once '../modelo/Familia.php';
require_once '../servicios/funciones.php';
$mensaje_excepcion = '';
$mensaje='';

comprobar_sesion();

// Recuperar la cesta de la compra
$cesta_compra = Cesta_compra::cargar_cesta();

// si viene de la página detalle con rol='user', mostrar mensaje
if (isset($_GET['rol'])){
    $rol = $_GET['rol'];
    if($rol=='user'){
        $mensaje = 'No tiene permisos para visualizar detalles';
    }
}

/** si ha seleccionado una familia, se guarda en la sessión el
 * código de la familia y se redirige al listado productos
*/
if (isset($_POST['set_cod_familia'])){
    $cod_familia = $_POST['cod_familia'];
    $_SESSION['cod_familia'] = $cod_familia;
    header('Location:./listado_productos.php');
}

// Comprobamos si se ha enviado el formulario de vaciar la cesta
if (isset($_POST['vaciar'])) {
    $cesta_compra->vaciar_cesta();
    $cesta_compra->guardar_cesta($cesta_compra);
}

$cesta_vacia = $cesta_compra->is_vacia();
$productos_cesta = $cesta_compra->get_productos();

// Obtener el listado de familias
try {
    $listado_familias = DB::obtener_familias();
} catch (Exception $exc) {
    $mensaje_excepcion = $exc->getMessage();
}
require_once '../vista/vista_listado_familias.php';
