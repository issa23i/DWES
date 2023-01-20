<?php

require_once '../modelo/DB.php';

$mensaje = '';
$mensaje_excepcion = '';

if (isset($_REQUEST['login'])){
    $mensaje = 'Debe iniciar sesión';
} elseif (isset ($_REQUEST['logout'])){
    $mensaje = 'Sesión cerrada correctamente';
}

if (isset($_POST['enviar'])) {
    $nombre_usuario = $_POST['usuario'];
    $clave_usuario = $_POST['password'];

    try {
        $rol = DB::verifica_cliente($nombre_usuario, $clave_usuario);
        if ($rol) {
            ///// CREAR SESIÓN
            session_start();
            $_SESSION['usuario'] = $nombre_usuario;
            $_SESSION['rol'] = $rol;
            /// REDIRIGIR
            header("Location: ../controlador/listado_familias.php");
        }
    } catch (Exception $ex) {
        $mensaje_excepcion = $ex->getMessage();
    }
}
if (isset($nombre_usuario) && isset($clave_usuario)) {
    // Si se enviaron los datos del login,
    // pero si ha llegado aquí (no ha sido redirigido con header)
    // muestra que hubo un error en el login
    $mensaje = 'Usuario o clave incorrecta';
}

require_once '../vista/vista_login.php';
?>

