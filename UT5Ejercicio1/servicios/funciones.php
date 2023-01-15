<?php

// comprobar sesión

function comprobar_sesion(){
    session_start();
    if( ! isset($_SESSION['usuario'])){
        header("Location: ../controlador/login.php");
    }
}
