<?php
/**
 * Sesiones - sesiones_3.php
 */
require_once 'funciones.php';
comprobarSesion();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Formulario de confirmación (Formulario 2).
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="sesiones.css" title="Color">
</head>

<body>
  <h1>Formulario de confirmación (Formulario 2)</h1>

  <form action="sesiones_4.php" method="post">
    <p>Repita la palabra que acaba de escribir:</p>
    <p><label>Escriba de nuevo: <input type="text" name="palabra2" size="30" maxlength="30"></label></p>
<?php


?>
    <p>
        <input type="submit" name="enviar" value="Siguiente">
      <input type="reset" value="Borrar">
    </p>
  </form>
</body>
</html>
