<?php

include_once '../modelo/DB.php';
include_once '../modelo/Televisor.php';
include_once '../modelo/Producto.php';
require_once '../servicios/funciones.php';

comprobar_sesion();

$cod_familia = '';
$mensaje_excepcion = '';

// Recoger el rol de la sesión y comprobar si es admin
$rol = false;
if(isset($_SESSION['rol'])){
    $rol = $_SESSION['rol'];
}
if( !($rol && $rol=='admin') ) {
    // si no es admin, no puede ver esta página
    header('Location: ./listado_familias.php?rol=user');
}

// Obtener la familia
if (isset($_SESSION['cod_familia'])) {
    $cod_familia = $_SESSION['cod_familia'];
}

if (isset($_POST['detalle'])) {
    try {
        $cod = $_POST['cod_pro'];
        if ($cod_familia == 'TV') {
            $tv = DB::obtiene_tv($cod);
            $nombre = $tv->mostrar_nombre();
            $pulgadas = $tv->getPulgadas();
            $resolucion = $tv->getResolucion();
            $panel = $tv->getPanel();
            $precio = $tv->getPVP();
        } elseif ($cod_familia == 'ORDENA') {
            $ordenador = DB::obtiene_sobremesa($cod);
            $nombre = $ordenador->mostrar_nombre();
            $marca = $ordenador->getMarca();
            $modelo = $ordenador->getModelo();
            $procesador = $ordenador->getProcesador();
            $ram = $ordenador->getRam();
            $rom = $ordenador->getRom();
            $extras = $ordenador->getExtras();
            $precio = $ordenador->getPVP();
        }
    } catch (Exception $ex) {
        $mensaje_excepcion = $ex->getMessage();
    }
}
require_once '../vista/vista_detalle.php';
