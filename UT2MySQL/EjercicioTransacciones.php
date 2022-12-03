<?php /** EJERCICIO TRANSSACIONES *****************************/

// CONEXIÓN ////////////////////////////////////////////////////
$host = 'localhost';
$usuarioBD = 'dwes';
$password = 'abc123.';
$BD = 'dwes';



try{
    $PDO = new PDO("mysql:host=$host;dbname=$BD", $usuarioBD, $password);
    echo $PDO->getAttribute(constant("PDO::ATTR_CONNECTION_STATUS"));
} catch (Exception $e) {
    die("<p>Error de conexión: ".$e->getMessage()."</p>");
    $e->getMessage();
}

///// VARIABLES DEFINIDAS //////
$producto = '000096';
$tienda_origen = 1;
$tienda_destino = 3;

$query_update = "UPDATE `stock` SET `producto`= $producto,`tienda`= $tienda_origen,`unidades`= 1";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plantilla para Ejercicios Tema 3</title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <h2>TRASPASAR EXISTENCIAS</h2>
        <?=$tienda_origen?>
          
    </body>
</html>

