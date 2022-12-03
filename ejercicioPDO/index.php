<?php
/// CONEXIÓN ///////////////////////////////////////////
$cadena_conexion = 'mysql:dbname=dwes;host=127.0.0.1';
$usuario = 'dwes';
$clave = 'abc123.';
try {
    $pdo = new PDO($cadena_conexion, $usuario, $clave);
} catch (PDOException $e) {
    echo 'Error, no se ha podido realizar la conexión: ' . $e->getMessage();
}
$conexion = new PDO($cadena_conexion, $usuario, $clave);

echo "Conexión realizada con éxito<br>";

/// PRODUCTO SELECCIONADO ///////////////////////////////////
if (isset($_POST["producto_seleccionado"])) {
    $cod_producto_seleccionado = $_POST['producto_seleccionado'];
}

/// MODIFICAR UNIDADES ///////////////////////////////////
if (isset($_POST['enviar_modificaciones'])) {
    $tiendas_modificado = $_POST['tiendas_modificado'];
    $nuevas_unidades = $_POST['nuevas_unidades'];

    // UPDATE QUERY STRING
    $query_update = 'UPDATE stock SET unidades = :new_unidades WHERE tienda= :tienda AND producto=:codigo_producto;';

    for ($i = 0; $i < count($tiendas_modificado); $i++) {
        // PREPARE
        $update = $conexion->prepare($query_update);
        // EXECUTE
        $update->execute(array(':new_unidades' => $nuevas_unidades[$i], ':tienda' => $tiendas_modificado[$i], ':codigo_producto' => $cod_producto_seleccionado));
    }
}

/// CONSULTA PRODUCTOS //////////////////////////////////
$query_productos = "SELECT cod, nombre FROM producto";
$pdo_statement = $conexion->query($query_productos);

//// SI CONEXIÓN, ARRAY PRODUCTOS ////////////////////////
if ($pdo_statement) {
    $productos = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
}


/// PREPARE /////////////////////////////////////////////
$query_cod_pro = "SELECT tienda.nombre AS tienda_nombre, "
        . "tienda.cod AS cod_tienda, "
        . "stock.unidades, "
        . "producto.nombre AS nombre_producto "
        . "FROM stock JOIN tienda JOIN producto "
        . "ON stock.tienda = tienda.cod "
        . "AND producto.cod = stock.producto "
        . "where producto= :cod_prod";
$consulta_cod_pro = $conexion->prepare($query_cod_pro);

///// COD_PRODUCTO_SELECCIONADO //////////////////////////////////
if (isset($cod_producto_seleccionado)) {
    /// CONSULTA TIENDA, UNIDADES DE UN PRODUCTO ////////////
    $consulta_cod_pro->execute(array(':cod_prod' => $cod_producto_seleccionado));
    $tiendas = $consulta_cod_pro->fetchAll(PDO::FETCH_ASSOC);
    // nombre producto
    if (count($tiendas) > 0) {
        $nombre_producto = $tiendas[0]['nombre_producto'];
        // si no hay existencias
    } else {
        foreach ($productos as $producto) {
            if (array_search($cod_producto_seleccionado, $producto)) {
                $nombre_producto = $producto['nombre'];
            }
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01
    Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;
              charset=UTF-8">
        <title>Plantilla para Ejercicios Tema 3</title>
        <link href="dwes.css" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div id="encabezado" class="p-3">
            <h1>Ejercicio: </h1>
            <form id="form_seleccion" action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <select name="producto_seleccionado" class="form-select form-select-lg mb-3" aria-label=".form-s">
<?php foreach ($productos as $producto): ?>
    <?php if ($cod_producto_seleccionado == $producto['cod']): ?>
                            <option value="<?= $producto['cod'] ?>" selected><?= $producto['nombre'] ?></option>
                        <?php else: ?>
                            <option value="<?= $producto['cod'] ?>"><?= $producto['nombre'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <input type="submit" name="enviar_select" value="Enviar" class="btn btn-outline-dark">
                </select>
            </form>
        </div>
        <div id="contenido" class="p-3">
            <!-- Si se ha seleccionado un producto -->
<?php if (isset($cod_producto_seleccionado)): ?>
                <!-- Si hay existencias -->
                <?php if (isset($tiendas) && count($tiendas) > 0): ?>
                    <h2>Stock del producto en las tiendas</h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="3"><?= $nombre_producto ?></th>
                            </tr>
                            <tr>
                                <th>CÓDIGO TIENDA</th><th>NOMBRE TIENDA</th><th>UNIDADES</th>
                            </tr>
                        </thead>
                        <tbody>
        <?php foreach ($tiendas as $row): ?>
                                <tr>
                                    <td><?= $row['cod_tienda'] ?></td>
                                    <td><?= $row['tienda_nombre'] ?></td>
                                    <td><?= $row['unidades'] ?></td>
                                </tr>
        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- No hay existencias -->
    <?php else: ?>

                    <h5>No hay existencias de <?= $nombre_producto ?></h5>

    <?php endif; ?>
<?php endif; ?>
        </div>
        <div id="pie" class="p-3">
            <!-- Si hay existencias -->
<?php if (isset($cod_producto_seleccionado) && isset($tiendas) && count($tiendas) > 0): ?>
                <h4><?= strtoupper($nombre_producto) ?></h4>
                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <?php foreach ($tiendas as $row): ?>
                        <p>
                            <label for="nuevas_unidades"><?= strtoupper($row['tienda_nombre']) ?></label>
                            <input type="hidden" name="tiendas_modificado[]" value="<?= $row['cod_tienda'] ?>">
                            <input type="text" name="nuevas_unidades[]" value="<?= $row['unidades'] ?>" >
                        </p>
    <?php endforeach; ?>
                    <input type="hidden" name="producto_seleccionado" value="<?= $cod_producto_seleccionado ?>">
                    <input type="submit" name="enviar_modificaciones" value="Modificar" class="btn btn-outline-dark">   
                </form>
<?php endif; ?>
        </div>
    </body>
</html>
