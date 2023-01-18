<?php
/**
 * Sesiones - sesiones_1.php
 */
require_once 'funciones.php';
comprobarSesion();

if(isset($_REQUEST['palabra'])){
    $palabra_uno = $_REQUEST['palabra'];
    if($palabra_uno==0){
        $aviso = 'No ha escrito nada';
    } elseif ($palabra_uno==1){
        $aviso = 'No ha escrito la misma palabra. Comience de nuevo';
    } elseif ($palabra_uno==2){
        $aviso = 'No ha escrito una sola palabra con letras y números';
    }
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Formulario de confirmación (Formulario 1).
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="sesiones.css" title="Color">
</head>

<body>
  <h1>Formulario de confirmación (Formulario 1)</h1>

  <form action="sesiones_2.php" method="post">
    <p>Escriba una palabra (con letras mayúsculas, letras minúsculas y números):</p>

<p><label>Palabra: <input type="text" name="palabra1" size="20" maxlength="20"></label> </p>
<?php if(isset($aviso)){
			echo "<p class=aviso>$aviso</p>";
}?>
    <p>
      <input type="submit" name='enviar' value="Siguiente">
      <input type="reset" value="Borrar">
    </p>
  </form>
</body>
</html>
