<?php
// Recuperamos la información de la sesión y la eliminamos
// Y comprobamos que el usuario se haya autentificado
require_once 'funciones.php';
comprobar_sesion();
if(isset($_SESSION['cesta'])){
    $_SESSION['cesta'] = array();
}

    
die("Gracias por su compra.<br />Quiere <a href='../vista/vista_listado_familias.php'>comenzar de nuevo</a>?");
