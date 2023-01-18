<?php
/**
 * Sesiones - sesiones_4.php
 */
require_once 'funciones.php';
comprobarSesion();
if(isset($_POST['enviar'])){
    $palabra = $_POST['palabra2'];
    $_SESSION['palabra2'] = $palabra;
}
comprobar_palabra2();