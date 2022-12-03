<?php
/////// CONEXIÓN ////////////////////////////////////////////
$msql = "mysql:dbname=dwes;host=127.0.0.1";
$user = 'dwes';
$pass = 'abc123.';
try {
    $pdo = new PDO($msql, $user, $pass);
} catch (PDOException $exc) {
    echo "<p>Falló la conexión" . $exc->getMessage() . "</p>";
}
echo "<p>Conexión realizada con éxito</p>";

//////// TRANSACCIÓN UNIDADES PRODUCTO 3DSNG //////
$query_3dsng = "SELECT stock.producto, stock.unidades, "
        . "tienda.nombre AS nombre_tienda, "
        . "stock.tienda AS cod_tienda, producto.nombre AS nombre_producto "
        . "FROM stock JOIN producto JOIN tienda "
        . "ON stock.producto = producto.cod "
        . "AND stock.tienda = tienda.cod "
        . "WHERE producto.nombre = '3dsng'";
$consulta = $pdo->query($query_3dsng);
$existencias = $consulta->fetchAll(PDO::FETCH_ASSOC);

///// UPDATE DE TIENDA CON EXISTENCIAS (QUITAR UNA) ////////////////////
$pdo->beginTransaction();
$update = "UPDATE stock SET unidades = :unidades WHERE producto = '000096' AND tienda = :cod_tienda";
$resultado_update = $pdo->prepare($update);
$insert = "INSERT INTO `stock`(`producto`, `tienda`, `unidades`) VALUES ('000096', 3 ,1)";
$resultado_insert = $pdo->prepare($insert);
if (isset($_POST['traspasar'])) {
    $exito = true;
    $unidades_actualizadas = $_POST['unidades'];
    $tiendas_actualizadas = $_POST['cod_tienda'];
    for ($i = 0; $i < count($tiendas_actualizadas); $i++) {
        $exito = $resultado_update->execute(array(":unidades" => $unidades_actualizadas[$i]
            , ':cod_tienda' => $tiendas_actualizadas[$i]));
        if (!$exito) {
            echo "No se pudo actualizar las existencias de la tienda $tiendas_actualizadas[$i]";
            $pdo->rollBack();
        }
    }
    // si se han actualizado las unidades en tienda 1, entonces pasar a tienda 3
    if ($exito) {
        $exito = $resultado_insert->execute();
        $pdo->commit();
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!-- Mostrar las existencias de 3dsng -->
<?php if (isset($existencias)): ?>


            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
                <p>Strock de producto <?= $existencias[0]['nombre_producto'] ?></p>
    <?php foreach ($existencias as $row) : ?>
                    <input type="hidden" name="cod_tienda[]" value="<?= $row['cod_tienda'] ?>">
                    <p><?= $row['nombre_tienda'] ?> : <input type="text" name="unidades[]" value="<?= $row['unidades'] ?>"></p>
    <?php endforeach; ?>
                <input type="submit" name="traspasar" value="Traspasar">
            </form>
<?php endif; ?>
    </body>
</html>
