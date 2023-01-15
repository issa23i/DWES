<?php

require_once '../servicios/funciones.php';
comprobar_sesion();
if (isset($_SESSION['usuario'])) {
    $_SESSION = array();
    session_destroy();
    setcookie(session_name(), 123, time() - 1000);
}
require_once '../vista/vista_logout.php';
// Redirige a la paǵina de login
header('Location: ../controlador/login.php');

