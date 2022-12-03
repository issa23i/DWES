<?php
    // Recuperamos la información de la sesión y la eliminamos

    require_once './funciones.php';
comprobarSesion();
if(isset($_SESSION['usuario'])){
    $_SESSION = array();
    session_destroy();
    setcookie(session_name(), 123, time() -1000);
}
    // Redirige a la paǵina de login
header('Location: ./login.php');