<?php
// Conexión
$host='127.0.0.1';
$user = 'dwes';
$password = 'abc123.';
$bd = 'dwes';

$mensaje='mensaje no editado';


// Recogemos el codigo del producto enviado o modificado
if (isset($_POST['cod_prod'])) {
    $cod_prod = $_POST['cod_prod'];
}

// CONEXION. Vemos si ha ocurrido un error
try {
    $conexion = new mysqli ($host, $user, $password, $bd);
} catch (Exception $ex) {
    die('<p>Error conexión: ' . $e->getMessage() . '</p>');
}

// Comprobamos si se ha pulsado el boton de modificar
if (isset($_POST['modificar'])) {
    // Recogemos valores
    $unidadesModificadas = $_POST['unidades'];
    $tiendasModificadas = $_POST['tiendas'];
        
    $consultaPreparada = $conexion->stmt_init();
    
    // SIN ETIQUETAS
    $query = "UPDATE stock SET unidades = ? WHERE producto = '";
    $query .= $cod_prod."' AND tienda = ?";
    
    /* CON ETIQUETAS
    $query = "UPDATE stock SET unidades = :unidades WHERE producto = '";
    $query .= $productoModificado."' AND tienda = :tienda"; */
    
    $consultaPreparada->prepare($query);
    
    for ($i = 0; $i < count($tiendasModificadas); $i++) {
        // EN MYSQLI SIN ETIQUETAS
        $consultaPreparada->bind_param('ii', $unidadesModificadas[$i], $tiendasModificadas[$i]);
        $consultaPreparada->execute();
        
        /* EN MYSQLI CON ETIQUETAS
        $consultaPreparada->bind_param(':unidades', $unidadesModificadas[$i]);
        $consultaPreparada->bind_param(':tienda', $tiendasModificadas[$i]); */
        
        /* EN PDO
        execute (array(':unidades'=> u, ':tienda'=>t)); */
    }
    
}

// CONSULTA DEL STOCK
// Comprobamos si se ha metido algun codigo
if ( isset($cod_prod) ) { 
    $consulta_stock="SELECT tienda.nombre, stock.unidades, tienda.cod as cod_tienda FROM stock"
          . " INNER JOIN tienda ON stock.tienda=tienda.cod "
          . "WHERE stock.producto='". $cod_prod. "'";
    
    $resultado_stock= $conexion->query($consulta_stock);
    
    if ($resultado_stock) {
        $stock=$resultado_stock->fetch_all(MYSQLI_ASSOC);
    }
        
}

// CONSULTA DE PRODUCTOS. Crea la consulta
$query='SELECT cod, nombre FROM producto';
$resultado=$conexion->query($query); 

// Si se conecta devuelve todas las filas, si no, mensaje de error
if ($resultado) {
    $productos=$resultado->fetch_all(MYSQLI_ASSOC);
    
    // Para sacar el nombre del producto a partir del codigo seleccionado
    foreach ($productos as $value) {
        if ($value['cod']==$cod_prod) {
            $nombre_producto_selec = $value['nombre'];
        }
    }
    
} else {
    $mensaje = "La consulta no se ha realizado correctamente";
}


?>

<html>
<head>
<meta http-equiv="content-type" content="text/html;
charset=UTF-8">
<title>Plantilla para Ejercicios Tema 3</title>
<link href="dwes.css" rel="stylesheet" type="text/css">
</head>
<body>
    <!-- <pre><?php // print_r($stock) ?></pre> -->
    
<div id="encabezado">
            <h1>Ejercicio: </h1>
            <form id="form_seleccion" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label>Productos</label>
                <select name="cod_prod">
                    
                    <?php foreach ($productos as $value): ?>
                    
                        <?php if ($cod_prod == $value['cod']): ?>
                            <option value="<?= $value['cod'] ?>" selected> <?= $value['nombre'] ?> </option>
                        <?php else: ?>
                            <option value="<?= $value['cod'] ?>"> <?= $value['nombre'] ?> </option>
                        <?php endif; ?>
                        
                    <?php endforeach; ?>
                                       
                </select>
                <input type="submit" name="enviar" value="Enviar"/>
            </form>
        </div>
        <div id="contenido">
            
            <?php if (isset($cod_prod) && count($stock) != 0): // Si tengo codigo enviado y no esta vacio ?>
            
            <h2>Stock del producto "<?= $nombre_producto_selec ?>" en las tiendas</h2>
            
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
               
                <?php foreach ($stock as $value): ?>
                
                <p>Tienda <?= $value['nombre'] ?>: <input type="text" name="unidades[]" value="<?= $value['unidades'] ?>"></p>
                  <input type="hidden" name="tiendas[]" value="<?= $value['cod_tienda'] ?>">
                <?php endforeach; ?>
                 <input type="hidden" name="cod_prod" value="<?= $cod_prod ?>">
                 <input type="submit" name="modificar" value="Modificar">
            </form>
            <?php elseif (isset($stock) && count($stock) == 0): ?>
            <p>No hay Stock del producto "<?= $nombre_producto_selec ?>" </p>
            <?php endif; ?>
                        
            <!-- Para recargar e ir al inicio -->
            <center>
                <br><br> <a href="index.php"><h1>Inicio</h1></a>
                <a href="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>"><h1>Recargar</h1></a> <br>
            </center>
            
        </div>
        <div id="pie">
        </div>
    


</body>
</html>
