<?php
/////// CONEXIÓN ////////////////////////////////////////////
$msql = "mysql:dbname=dwes;host=127.0.0.1";
$user = 'dwes';
$pass = 'abc123.';
try {
    $pdo = new PDO($msql, $user, $pass);
} catch (PDOException $exc) {
    echo "<p>Falló la conexión".$exc->getMessage()."</p>";
}
echo "<p>Conexión realizada con éxito</p>";

////// SELECCIONAR PRODUCTO /////////////////////////////////
if(isset($_POST['seleccionar_producto'])){
    $producto_seleccionado = $_POST['producto_seleccionado'];
}

/////// CONSULTA TODOS LOS PRODUCTOS ////////////////////////
$query_productos = "SELECT cod, nombre FROM producto";
$resultado_productos = $pdo ->query($query_productos);
$productos = $resultado_productos ->fetchAll(PDO::FETCH_ASSOC);

////// CONSULTA STOCK ///////////////////////////////////////
if(isset($producto_seleccionado)){
    $query_stock = "SELECT tienda.nombre AS tienda_nombre, "
                        ."tienda.cod AS cod_tienda, "
                        ."stock.unidades, "
                        ."producto.nombre AS nombre_producto "
                        ."FROM stock JOIN tienda JOIN producto "
                        ."ON stock.tienda = tienda.cod "
                        ."AND producto.cod = stock.producto "
                        ."where producto= :producto_seleccionado";
    $resultado_stock = $pdo -> prepare($query_stock);
    $resultado_stock -> execute(array(':producto_seleccionado' => $producto_seleccionado));
    $stock = $resultado_stock -> fetchAll(PDO::FETCH_ASSOC);
}



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!-- SI HEMOS DEFINIDO LA VARIABLE PRODUCTOS, NO ES NULL Y CONTIENE
             AL MENOS UN PRODUCTO, MOSTRAMOS EL SELECT CON TODOS LOS PRODUCTOS -->
        <?php if (isset($productos) && count($productos)>0):?>
        <h2>SELECCIONE UN PRODUCTO</h2>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
            <select name="producto_seleccionado" id="productos">
                <?php foreach ($productos as $p) : ?>
                <!-- Si se ha seleccionado un producto, saldrá el cod selected -->
                    <?php if(isset($producto_seleccionado) && $producto_seleccionado==$p['cod']): ?>
                    <option value="<?= $p['cod'] ?>" selected><?= $p['nombre'] ?></option>    
                    <?php else : ?>
                    <option value="<?= $p['cod'] ?>"><?= $p['nombre'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="seleccionar_producto" value="Seleccionar Producto">
        </form>
        <?php endif;?>
        <br>
        <?php if(isset($producto_seleccionado)):?>
        <h2>STOCK EN TIENDAS</h2>
            <?php if(isset($stock) && count($stock)):?>
        <table border="1">
                        <thead>
                            <tr>
                                <th colspan="2"><?= $stock[0]['nombre_producto'] ?></th>
                            </tr>
                        </thead>
                        <tbody>
                <?php foreach ($stock as $row) :?>
                            <tr>
                                <td><?= $row['tienda_nombre']; ?></td>
                                <td><?= $row['unidades']; ?></td>
                            </tr>
                <?php endforeach; ?>
                        </tbody>
                    </table>
            <?php endif; ?> 
        <?php endif; ?> 
    </body>
</html>
