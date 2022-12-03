<?php
// CONEXIÓN ///////////////////////////////////////////
$cadena_conexion = 'mysql:dbname=dwes;host=127.0.0.1';
$usuario = 'dwes';
$clave = 'abc123.';
try {
    
    $conexion = new PDO($cadena_conexion, $usuario, $clave);

echo '<div class="alert alert-info">Conexión realizada con éxito</div>';

// PRODUCTO
if(isset($_POST['editar'])){
    $cod_pro = $_POST['cod_pro'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $nombre_corto = $_POST['nombre_corto'];
    $PVP = $_POST['PVP'];    
 }   
    
} catch (PDOException $e) {
    echo 'Error, no se ha podido realizar la conexión: ' . $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>EDITAR</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <?php if (isset($cod_pro)): ?>
        <form action="<?= htmlspecialchars("../actualizar.php/") ?>" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>CODIGO</th>
                        <th>NOMBRE</th>
                        <th>DESCRIPCIÓN</th>
                        <th>PVP</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$cod_pro ?></td>
                        <td>
                            <input type="hidden" name="cod_pro" value="<?=$cod_pro ?>" class="form-control">
                            <input type="text" name="nombre" value="<?=$nombre ?>" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="descripcion" value="<?=$descripcion ?>" class="form-control">
                        </td>
                        <td>
                            <input type="text" name="PVP" value="<?=$PVP ?>" class="form-control">
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="nombre_corto" value="<?=$nombre_corto ?>">
            <input type="submit" name="actualizar" value="Actualizar"  class="btn btn-primary">
            <input type="submit" name="cancelar" value="Cancelar"  class="btn btn-primary">
        </form>
        <?php endif; ?>
    </body>
</html>
