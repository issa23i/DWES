<?php

function comprobar_usuario($nombre_usuario, $pass_usuario) {
    $validado = false;
    try {
        // conexión
        $pdo = new PDO('mysql:host=localhost;dbname=dwes', 'root', 'notiene');
        $query = "SELECT * FROM usuarios WHERE usuario=:usuario AND password=:password";
        $result = $pdo->prepare($query);
        $result->execute(array(':usuario' => $nombre_usuario, ':password' => md5($pass_usuario)));
        $validado = $result->rowCount() > 0;

        // validar usuario
        if ($validado) {
            $mensaje_login = 'Usuario logueado correctamente';
        } else {
            $mensaje_login = 'Usuario o contraseña errónea, vuelva a intentarlo';
        }
        return $validado;
    } catch (Exception $ex) {
        $mensaje_conex = $ex->getMessage();
        echo $mensaje_conex;
    }
}

function comprobarSesion() {
    session_start();
    if (!isset($_SESSION['usuario'])) {
        
        header('Location:login.php?login=0');
    }
}

function comprobar_palabra1() {
    $palabra1 = $_SESSION['palabra1'];
    $palabra_ok = false;     
    if(ctype_alnum($palabra1) && (!ctype_space($palabra1))){
        $palabra_ok = true;
    }
    // si no ha escrito nada
    if($palabra1=''){
        header('Location:sesiones_1.php?palabra=0');
    // si es válida
    } else if($palabra_ok){
        header('Location:sesiones_3.php');
    }// si no es válida
}


function comprobar_palabra2() {
    $palabra1 = $_SESSION['palabra1'];
    $palabra2 = $_SESSION['palabra2'];
    echo $palabra2;
    $palabra_ok = false;     
    if( !( ctype_alnum($palabra2) && (!ctype_space($palabra2)) ) ){
        header('Location:sesiones_1.php?palabra=2');
    } else {
        $palabra_ok = true;
    }
    // si no ha escrito nada
    if($palabra2=''){
        header('Location:sesiones_1.php?palabra=0');
    // si es válida
    } else if($palabra_ok){
        //si no coincide con la primera
        if(! ($palabra2==$palabra1) ){
            header('Location:sesiones_1.php?palabra=1');
         //si coincide
        } else {
            header('Location:sesiones_5.php');
        }
    }// si no es válida
}

function mostrar_palabra() {
    return $_SESSION['palabra1'];
}

