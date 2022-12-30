<?php
/**
 * Cookies - cookies_2.php
 */
$mensaje = '';
if (isset($_COOKIE['color_cookie'])) {
    $color = $_COOKIE['color_cookie'];
    switch ($color) {
        case 0:
            $mensaje = 'No ha elegido color';
            $estilo = 'no';
            break;
        case 1:
            $mensaje = 'Ha elegido el color Rojo';
            $estilo = 'rojo';
            break;
        case 2:
            $mensaje = 'Ha elegido el color Azul';
            $estilo = 'azul';
            break;
        case 3:
            $mensaje = 'Ha elegido el color Verde';
            $estilo = 'verde';
            break;
        default:
            break;
    }
}

?>


<!DOCTYPE html>
<head>
  <meta http-equiv=\"Content-Type\" content=\"text/html; charset="utf-8" />
  <title>Selección de colores (comprobación). Cookies.</title>
  <link href=\"examenUT4.css\" rel=\"stylesheet\" type=\"text/css\" title=\"Color\" />
  
  <style type="text/css">body, a { color: black; }
      .rojo{
          color:red;
      }
      .azul{
          color:blue;
      }
      .verde{
          color:green;
      }
  </style>
<?php

?>

</head>
<body>
<h1>Selección de colores (comprobación)</h1>
<p class="<?=$estilo?>" ><?=$mensaje ?></p>
<?php

?>

<p><a href="cookies_1.php">Volver a la selección de color</a></p>

</body>
</html>
