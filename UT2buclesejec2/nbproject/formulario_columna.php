<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tabla de una columna (Formulario).
     </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tabla de una columna (Formulario)</h1>

  <form action="tabla_columna.php" method="post">
    <p>Escriba un número (0 &lt; número &le; 200) y mostraré una tabla de una columna
      y tantas filas como indique.
    </p>

    <p><label>Número de filas: <input type="number" name="filas" min="1" max="200" value="10"></label></p>

    <p>
      <input type="submit" value="Mostrar">
      <input type="reset" value="Borrar">
    </p>
  </form>
</body>
</html>

