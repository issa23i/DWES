<?php

// recuperar sesión
function comprobarSesion() {
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header("Location: ./login.php");
    }
}

// cargar cesta
function cargarCesta() {
    // Recuperamos la cesta de la compra
    if (isset($_SESSION['cesta'])) {
        $cesta = $_SESSION['cesta'];
    } else {
        $cesta = [];
        guardarCesta($cesta);
    }
    return $cesta;
}

// es cesta vacía
function cestaVacia($cesta) {
    if (count($cesta) > 0) {
        $cesta_vacia = false;
    } else {
        $cesta_vacia = true;
    }
    return $cesta_vacia;
}

// vaciar cesta
function vaciarCesta(&$cesta) {
    $cesta_vacia = false;
    if (isset($_REQUEST['vaciar'])) {
        $cesta = [];
        guardarCesta($cesta);
        $cesta_vacia = true;
    }
    return $cesta_vacia;
}

// añadir producto
function addProducto(&$cesta) {
    if (isset($_POST['add'])) {
        $cod = $_POST['cod'];
        $nombre = $_POST['nombre'];
        $pvp = $_POST['pvp'];
        $familia = $_POST['familia'];
        $unidades = 1;
        $producto = ['cod' => $cod,
            'nombre' => $nombre,
            'pvp' => $pvp,
            'unidades' => $unidades,
            'familia' => $familia];
        // Comprobamos si el producto existe ya en la cesta
        if (array_key_exists($cod, $cesta)) {
            //sumamos a las unidades
            $cesta[$cod]['unidades']++;
            $unidades = $cesta[$cod]['unidades'];
            // actualizamos la sesión
            guardarCesta($cesta);
        } else {
            // Actualizar cesta
            $cesta[$cod] = ['nombre' => $nombre,
                'pvp' => $pvp,
                'unidades' => $unidades,
                'familia' => $familia];
            // actualizar sesión
            guardarCesta($cesta);
        }
    }
    return $cesta;
}

// guardar cesta
function guardarCesta($cesta) {
    $_SESSION['cesta'] = $cesta;
}

// cambiar unidades
function cambiarUnidades(&$cesta) {
    if (isset($_POST['cambiar_unidades'])) {
        $cod = $_POST['cod'];
        $unidades_cambiadas = $_POST['unidades_cambiadas'];
        if($unidades_cambiadas == 0){
            unset($cesta[$cod]);
        } else {
           $cesta[$cod]['unidades'] = $unidades_cambiadas; 
        }
        guardarCesta($cesta);
    }
}

?>
