<?php
/**
 * Sesiones - sesiones_5.php
 */

require_once 'funciones.php';
comprobarSesion();
$palabra_mostrar = mostrar_palabra();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Sesiones. Resultado
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="sesiones.css" title="Color">
</head>

<body>
  <h1>Confirmación (Resultado)</h1>

<p>Ha escrito y confirmado la palabra: <strong><?= $palabra_mostrar?></strong></p>

  <p><a href="borrar.php">Volver al principio.</a></p>


</body>
</html>
