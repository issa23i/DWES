<?php /** EJERCICIO TRANSSACIONES *****************************/

// CONEXIÓN ////////////////////////////////////////////////////
$host = 'localhost';
$usuarioBD = 'dwes';
$password = 'abc123.';
$BD = 'dwes';



try{
    $mysqli = new mysqli($host, $usuarioBD, $password, $BD);
    echo $mysqli->host_info . "\n";
} catch (Exception $e) {
    die("<p>Error de conexión: ".$e->getMessage()."</p>");
    $e->getMessage();
}

/// PRODUCTO SELECCIONADO ///////////////////////////////////
if(isset($_POST["producto_seleccionado"])){
    $cod_producto_seleccionado = $_POST['producto_seleccionado'];
}


/// TRANSFERIR EXISTENCIAS //////////////////////////////////
// SI SE HA ENVIADO SELECT DE TIENDAS
if(isset($_POST["tiendas_seleccionadas"])){
    $tienda_seleccionada_origen = $_POST["tienda_seleccionada_origen"];
    $tienda_seleccionada_destino = $_POST["tienda_seleccionada_destino"];
    
    
    // !!!!!!!!!!!! errOR !!!!!!!
    /** AQUÍ NECESITO SABER LAS UNIDADES !!!
    var_dump($tiendas);
    // Unidades que tiene la tienda origen
    foreach ($tiendas as $tienda) {
        if($tienda_seleccionada_origen == $tienda['cod_tienda']){
            $unidades = $tienda['unidades'];
            echo "Unidades $unidades -----";
        }
    }
     */
}

// PRODUCTOS ///////////////////////////////////////////////////
$query='SELECT cod, nombre FROM producto';
$mysqli_resultado=$mysqli->query($query);
// SI LA CONSULTA HA OBTENIDO UN RESULTADO Y ESTE TIENE AL MENOS UNA FILA
if($mysqli_resultado && $mysqli_resultado->num_rows>0){
    $productos = $mysqli_resultado->fetch_all(MYSQLI_ASSOC);
}

/// PREPARE /////////////////////////////////////////////
    $query_cod_pro = "SELECT tienda.nombre AS tienda_nombre, "
                        ."tienda.cod AS cod_tienda, "
                        ."stock.unidades, "
                        ."producto.nombre AS nombre_producto "
                        ."FROM stock JOIN tienda JOIN producto "
                        ."ON stock.tienda = tienda.cod "
                        ."AND producto.cod = stock.producto "
                        ."where producto= ?";


///// COD_PRODUCTO_SELECCIONADO //////////////////////////////////
if(isset($cod_producto_seleccionado)){
    /// CONSULTA TIENDA, UNIDADES DE UN PRODUCTO
    
    /// MANEJO DE ERRORES
    if(!($sentencia = $mysqli->prepare($query_cod_pro))){
        echo "<p>Falló la preparación de la consulta: ( "
                .$mysqli->errno ." ) " 
                . $mysqli->error ."</p>";
    }
    if(!($sentencia->bind_param("s", $cod_producto_seleccionado))){
        echo "<p>Falló la vinculación de parámetros: ( "
                .$sentencia->errno ." ) " 
                . $sentencia->error ."</p>";
    }
    if(!($sentencia->execute())){
         echo "<p>Falló la ejecución de la consulta: ( "
                .$sentencia->errno ." ) " 
                . $sentencia->error ."</p>";
    }
    if(!($stock = $sentencia->get_result())){
        echo "<p>Falló la obtención del conjunto de resultados: ( "
                .$sentencia->errno ." ) " 
                . $sentencia->error ."</p>";
    }    
    
    // NOMBRE PRODUCTO
    if($stock->num_rows>0){
            $fila = $stock->fetch_assoc();
            $nombre_producto = $fila["nombre_producto"];
            echo $nombre_producto;
    // si no hay existencias
    }else{
        foreach ($productos as $producto) {
                if (array_search($cod_producto_seleccionado, $producto)){
                $nombre_producto = $producto['nombre'];
                echo $nombre_producto;
            }
        }
    }
    // ARRAY TIENDAS
    $tiendas = $stock->fetch_all(MYSQLI_ASSOC);
}


//
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
        <pre><?php// if(isset($stock)){ var_dump($tiendas);}?></pre>
        <!-- PRIMER SELECT TODOS LOS PRODUCTOS -->
        <div id="encabezado" class="p-3">
            <h1>Ejercicio: </h1>
            <form id="form_seleccion" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
                <select name="producto_seleccionado" class="form-select form-select-lg mb-3" aria-label=".form-s">
                    <?php foreach ($productos as $producto): ?>
                        <?php if($cod_producto_seleccionado == $producto['cod']): ?>
                        <option value="<?=$producto['cod']?>" selected><?=$producto['nombre']?></option>
                        <?php else: ?>
                        <option value="<?=$producto['cod']?>"><?=$producto['nombre']?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <input type="submit" name="enviar_select" value="Enviar" class="btn btn-outline-dark">
            </form>
        </div>
        <!-- SEGUNDO SELECCIONAR LAS TIENDAS -->
        <div id="contenido" class="p-3">
            <!-- Si se ha seleccionado un producto y hay existencias -->
            <?php if(isset($cod_producto_seleccionado) && isset($stock) && $stock->num_rows>0): ?>
                <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
                    <h2>Traspasar existencias entre tiendas</h2>
                    <div class="row">
                        <div>
                            <h3>Tienda origen</h3>
                            <select name="tienda_seleccionada_origen" class="form-select form-select-lg mb-3" aria-label=".form-s">
                                <?php foreach ($tiendas as $tienda): ?>
                                <!-- Si ya se ha seleccionado el producto, opción selected -->
                                <?php if(isset($tienda_seleccionada_origen) && $tienda_seleccionada_origen == $tienda['cod_tienda']): ?>
                                <option value="<?=$tienda['cod_tienda']?>" selected><?=$tienda['tienda_nombre']?></option>
                                <?php else: ?>
                                <option value="<?=$tienda['cod_tienda']?>"><?=$tienda['tienda_nombre']?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <h3>Tienda destino</h3>
                            <select name="tienda_seleccionada_destino" class="form-select form-select-lg mb-3" aria-label=".form-s">
                                <?php foreach ($tiendas as $tienda): ?>
                                <!-- Si ya se ha seleccionado la tienda, opción selected -->
                                <?php if(isset($tienda_seleccionada_destino) && $tienda_seleccionada_destino == $tienda['cod_tienda']): ?>
                                <option value="<?=$tienda['cod_tienda']?>" selected><?=$tienda['tienda_nombre']?></option>
                                <?php else: ?>
                                    <option value="<?=$tienda['cod_tienda']?>"><?=$tienda['tienda_nombre']?></option>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div> 
                <input type="submit" name="tiendas_seleccionadas" value="Seleccionar tiendas" class="btn btn-outline-dark">
                        
                        <!-- variable producto_seleccionado oculto -->
                        <input type="hidden" name="producto_seleccionado" value="<?=$cod_producto_seleccionado?>">
                        
                </form>

                <div>
                    
                    
                </div>
            </div>
                <!-- No hay existencias -->
                <?php else: ?>
            
            <h5>No hay existencias de <?=$nombre_producto?></h5>
            
                
            <?php endif; ?>
        </div>
    </body>
</html>

