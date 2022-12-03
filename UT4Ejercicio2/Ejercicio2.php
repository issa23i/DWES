<?php
$lenguajes = ['spanish', 'english', 'valenciano'];

if (isset($_POST['enviar'])) {
    $lenguaje = $_POST['lenguaje'];
    setcookie('lenguaje', $lenguaje, time() + 3600 * 24);
} else {
    if(isset($_COOKIE['lenguaje'])){
        $lenguaje = $_COOKIE['lenguaje'];
    } else {
        $lenguaje = $lenguajes[2];
    }
}

if (isset($lenguaje)) {
        if ($lenguaje == $lenguajes[1]) {
            echo 'Welcome!';
        } elseif ($lenguaje == $lenguajes[0]){
            echo '¡Bienvenido!';
        } elseif ($lenguaje == $lenguajes[2]){
            echo 'Benvingut!';
        }
    }
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
            <select name="lenguaje">
                <option value="<?= $lenguajes[0] ?>">ESPAÑOL</option>
                <option value="<?= $lenguajes[1] ?>">INGLES</option>
            </select>
            <input type="submit" name="enviar" value="Enviar">
        </form>
    </body>
</html>
