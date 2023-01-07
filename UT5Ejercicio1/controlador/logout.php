<?php

require_once 'funciones.php';
comprobar_sesion();
if(isset($_SESSION['usuario'])){
    $_SESSION = array();
    session_destroy();
    setcookie(session_name(), 123, time() -1000);
}
// Redirige a la paǵina de login
header('Location: ../vista/vista_login.php');

