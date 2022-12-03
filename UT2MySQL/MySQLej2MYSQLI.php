<?php

$host = 'localhost';
$usuarioBD = 'dwes';
$password = 'abc123.';
$BD = 'dwes';

try{
    $mysqli = new mysqli($host, $usuarioBD, $password, $BD);
    echo $mysqli->host_info . "\n";
} catch (Exception $ex) {
    die("<p>Error conexión: ".$ex->getMessage()."</p>");
    $ex->getMessage();
}

$query = "SELECT cod, nombre FROM producto";
$productos = [];
$resultado = $mysqli->query($query);
if($resultado){
    $productos = $resultado.fetch_all();
}
$row = $resultado->fetch_array();
while ($row != null) {
//print "<p>Nombre: " . $row["nombre"];
$row = $resultado->fetch_array();
}

mysqli_close($mysqli);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01
    Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
              charset=UTF-8">
        <title>Plantilla para Ejercicios Tema 3</title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="encabezado">
            <h1>Ejercicio: </h1>
            <form id="form_seleccion" action="<?php
echo
$_SERVER['PHP_SELF'];
?>" method="post">
                <label for="productos">Productos</label>
                <select name="productos" id="productos"></select>
                <!--<!-- 
<?php /* $row = $resultado->fetch_array();
        while ($row != null) {
        //print "<p>Nombre: " . $row["nombre"];
?>
                <option value="<?=$row['cod']?>"><?=$row['name']?></option>
<?php
        $row = $resultado->fetch_array();
} */?>                comment -->
            </form>
        </div>
        <div id="contenido">
            <h2>Stock del producto en las tiendas</h2>
        </div>
        <div id="pie">
        </div>
    </body>
</html>
