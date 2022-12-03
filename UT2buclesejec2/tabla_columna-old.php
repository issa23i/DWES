<?php
/**
 * Escribe un programa con dos páginas que muestre una tabla 
 * de una columna:
  a) En la primera página se solicita el número de filas mediante un
  formulario.
  ▪ No se deben admitir números decimales ni negativos.
  ▪ Sólo se deben admitir enteros positivos inferiores o iguales a 200
  y superiores a 0.
  b) En la segunda página se muestra la tabla (con un límite de 200
  filas).
  ▪ Para generar la tabla es suficiente un único bucle.
 */
include 'formulario_columna.php';
$numeroFila = ' ';
$pintarTabla = false;
$mensaje = "ERROR, no se pudo pintar la tabla";
if (isset($_POST['enviar'])) {
    $numeroFila = $_REQUEST['filas'];
    $numeroColumna = $_REQUEST['columnas'];
    // flags
    if (($numeroFila == '') || ($numeroFila == null)) {
        $mensaje = 'Número de filas nulo, introduzca un número';
    } elseif (($numeroFila <= 0) || ($numeroFila > 200)) {
        $mensaje = 'El Número de filas debe estar entre 1 y 200';
    } elseif (!(ctype_digit($numeroFila))) {
        $mensaje = 'El Número de filas debe ser un númeero entero';
    } else {
        $pintarTabla = true;
    }
}
?>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>
            Tabla de una columna.

        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="php-ejercicios.css" title="Color">
    </head>
    <body><!-- comment -->
        <?php if($pintarTabla): ?>
        <table border="1px">
            <?php for($i = 1;
            $i <= $numeroFila;
            $i++): ?>
            <?php print "<tr><td>celda $i </td></tr>";?>
                
        <?php endfor; ?>
        </table>
        <?php endif; ?>
        <?php echo "<a href=\"$_SERVER[PHP_SELF]\">Recargar</a>" ?>
    </body>
</html>




