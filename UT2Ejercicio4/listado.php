<?php

/// CONEXIÓN ///////////////////////////////////////////
$cadena_conexion = 'mysql:dbname=dwes;host=127.0.0.1';
$usuario = 'dwes';
$clave = 'abc123.';
try {
    $pdo = new PDO($cadena_conexion, $usuario, $clave);
} catch (PDOException $e) {
    echo '<div class="alert alert-danger">Error, no se ha podido realizar la conexión: '.$e->getMessage().'</div>';
}
$conexion = new PDO($cadena_conexion, $usuario, $clave);

echo '<div class="alert alert-info">Conexión realizada con éxito</div>';


// SI SE HA DEFINIDO POR GET LA VARIABLE UPDATE
if(isset($_REQUEST['update'])){
    // SE HA REALIZADO UN UPDATE EN actualizar.php
    if($_REQUEST['update']==1){
        echo '<div class="alert alert-success" role="alert">Actualización realizada correctamente</div>';
    }

    // SE HA CANCELADO UN UPDATE O ERROR EN actualizar.php 
    if($_REQUEST['update']==0){
        echo '<div class="alert alert-danger" role="alert">Actualización cancelada</div>';
    }
}


// familia
if(isset($_POST["enviar_familia"])){
    $cod_familia = $_POST["familia_selecionada"];
}

/// CONSULTA PRODUCTOS ////////////////////////////////
$consulta_productos = "SELECT cod AS cod_pro,nombre,nombre_corto,descripcion, PVP FROM producto WHERE familia= :familia";
$prepare_productos = $conexion->prepare($consulta_productos);
if(isset($cod_familia)){
     $prepare_productos -> execute(array(':familia' => $cod_familia));
     $productos = $prepare_productos->fetchAll(PDO::FETCH_ASSOC);
     //echo var_dump($productos);
}



//// CONSULTA FAMILIA //////////////////////////////////
$consulta_familia = "SELECT cod, nombre FROM familia";
$pdo_statement = $conexion -> query($consulta_familia);

if($pdo_statement){
    $familias = $pdo_statement -> fetchAll(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LISTADO</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <header>
            <h3>FAMILIAS</h3>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                <select name="familia_selecionada" class="form-select">
                    <?php foreach ($familias as $familia): ?>
                        <?php if(isset($cod_familia) && ($cod_familia == $familia['cod'])):?>
                    <option value="<?=$familia['cod'];?>" selected ><?=$familia['nombre'];?></option>
                        <?php endif; ?>
                    <option value="<?=$familia['cod'];?>"><?=$familia['nombre'];?></option>             
                    <?php endforeach;?>
                </select>
                <input type="submit" name="enviar_familia" value="Enviar"  class="btn btn-primary">
            </form>
        </header>
        <main>
            <div>
                <?php if(isset($cod_familia)): ?>
                    <?php if(isset($productos) && (count($productos))): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>NOMBRE CORTO</th> <th>PVP</th>
                        </tr>
                    </thead>
                        <?php foreach ($productos as $producto):?>
                    <tbody>
                        <tr>
                            <form method="post" action="<?= htmlspecialchars("editar.php/") ?>">
                                <input type="hidden" name="cod_pro" value="<?=$producto['cod_pro']?>">
                                <input type="hidden" name="nombre" value="<?=$producto['nombre']?>">
                                <input type="hidden" name="descripcion" value="<?=$producto['descripcion']?>">
                                <td><input type="text" name="nombre_corto" value="<?=$producto['nombre_corto']?>" class="form-control"></td>
                                <td><input type="text" name="PVP" value="<?=$producto['PVP']?>" class="form-control"></td>
                                <td><input type="submit" name="editar" value="Editar" class="form-control"></td>
                            </form>
                          <?php endforeach; ?>
                        </tr>
                        
                    </tbody>
                </table>
                    <?php endif;?>
                <?php endif;?>
            </div>
        </main>
        <footer>
            
        </footer>
    </body>
</html>
