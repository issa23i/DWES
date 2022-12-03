<?php
require_once 'funciones.php';

comprobarSession();
if($_POST['borrar_visitas']){
    unset($_SESSION['visitas']);
    $_SESSION['visitas']=[];
}

header('Location:./index.php?borrar=true');
