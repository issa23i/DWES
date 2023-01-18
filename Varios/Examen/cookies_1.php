<?php
/**
 * Cookies - cookies_1.php
*/
$mensaje='';
if(isset($_REQUEST['color'])){
    $color = $_REQUEST['color'];
    setcookie("color_cookie", $color, time()+7200);
    switch ($color) {
        case 0:
            $mensaje = 'No ha elegido color';
            break;
        case 1:
            $mensaje = 'Ha elegido el color Rojo';
            break;
        case 2:
            $mensaje = 'Ha elegido el color Azul';
            break;
        case 3:
            $mensaje = 'Ha elegido el color Verde';
            break;
        default:
            break;
    }
}


?>
<!DOCTYPE html>
<html>
<head>
  <title>Selección de colores (selección). Cookies.</title>
  <link href="examenUT4.css" rel="stylesheet" type="text/css" title="Color">
</head>
<body>
<h1>Selección de colores</h1>

<?php

?>
<p><?=$mensaje ?></p>
<p><a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?color=1">Rojo</a>
    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?color=2">Azul</a>
    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?color=3">Verde</a>
    <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?color=0">Ninguno</a>
</p>
<p><a href="cookies_2.php">Ir a otra página para comprobar la cookie</a></p>
</body>
</html>
