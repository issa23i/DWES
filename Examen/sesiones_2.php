<?php
/**
 * Sesiones - sesiones_2.php
 */
require_once 'funciones.php';
comprobarSesion();
if(isset($_POST['enviar'])){
    $palabra = $_POST['palabra1'];
    $_SESSION['palabra1'] = $palabra;
    if($palabra==''){
        header('Location:sesiones_1.php?palabra=0');
    }
} 
comprobar_palabra1();