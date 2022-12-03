<?php
/// CONEXIÓN ///////////////////////////////////////////
$cadena_conexion = 'mysql:dbname=dwes;host=127.0.0.1';
$usuario = 'dwes';
$clave = 'abc123.';
try {
    $pdo = new PDO($cadena_conexion, $usuario, $clave);

    // ACTUALIZAR PRODUCTO
    if (isset($_POST['actualizar'])) {
        $cod_pro = $_POST['cod_pro'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $nombre_corto = $_POST['nombre_corto'];
        $PVP = $_POST['PVP'];

        $update = "UPDATE producto SET nombre = :nombre, descripcion = :descripcion, PVP = :PVP WHERE cod = '" . $cod_pro . "' ";
        $prepare_producto = $pdo->prepare($update);

        // QUITAR COMMIT POR DEFECTO
        $pdo->beginTransaction();

        $prepare_producto->execute(array(':nombre' => $nombre,
            ':descripcion' => $descripcion,// BOOLEANO
            ':PVP' => $PVP));
        $filas = $prepare_producto->rowCount();
        // COMMIT SI SE REALIZA EL UPDATE, ROLLBACK SI ERROR
        if ($filas>0) {
            $pdo->commit();
        } else {
            $pdo->rollBack();
            // VOLVER A LISTADO SI NO SE COMPLETÓ EL UPDATE
            header("Location: ../listado.php?update=0");
        }

        // REDIRIGIR 
        header("Location: ../listado.php?update=$filas");
    }

// VOVER A LISTADO SI CANCELA
    if (isset($_POST['cancelar'])) {
        // redirigir a listado-php
        header("Location: ../listado.php?update=0");
    }
} catch (PDOException $e) {
    echo 'Error, no se ha podido realizar la conexión: ' . $e->getMessage();
}
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
    </body>
</html>
