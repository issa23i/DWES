<?php

require_once '../modelo/DB.php';

$mensaje = '';
$mensaje_excepcion = '';

if (isset($_POST['enviar'])) {
    $flag_nombre = false;
    $flag_clave = false;
    $nombre_usuario = $_POST['usuario'];
    $clave_usuario = $_POST['password'];

    try {
        if (DB::verifica_cliente($nombre_usuario, $clave_usuario)) {

            ///// CREAR SESIÓN
            session_start();
            $_SESSION['usuario'] = $nombre_usuario;

            /// REDIRIGIR
            header("Location: ../controlador/listado_familias.php");
        }
    } catch (Exception $ex) {
        $mensaje_excepcion = $ex->getMessage();
    }
}
if (isset($nombre_usuario) && isset($clave_usuario)) {
    // Si falló el login
    if (!$flag_nombre || !$flag_clave) {
        $mensaje = 'Usuario o clave incorrecta';
    } else {
        $mensaje = 'Login Correcto';
    }
}

require_once '../vista/vista_login.php';
?>

