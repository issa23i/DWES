<?php
// Recuperamos la información de la sesión
// Y comprobamos que el usuario se haya autentificado
require_once './funciones.php';
comprobarSesion();


// Recuperamos la cesta de la compra
$cesta = cargarCesta ();
$cesta_vacia = cestaVacia ($cesta);


// Comprobamos si se ha enviado el formulario de vaciar la cesta
$cesta_vacia = vaciarCesta ($cesta);

// Comprobamos si se ha enviado el formulario de añadir
$cesta = addProducto($cesta);
$cesta_vacia = cestaVacia ($cesta);

// Obtenemos los datos necesarios de la BD
$msql = "mysql:dbname=dwes2;host=127.0.0.1";
$user = 'dwes2';
$pass = 'abc123.';

try {
    $pdo = new PDO($msql, $user, $pass);
    //// RECOGER EL REQUEST Y CONSEGUIR EL PRODUCTO
    if (isset($_REQUEST['familia'])) {
        $familia = $_REQUEST['familia'];
        $query_listado_productos = "SELECT * FROM producto WHERE familia=:familia";
        $resultado_listado_productos = $pdo->prepare($query_listado_productos);
        $resultado_listado_productos->execute(array(':familia' => $familia));

        $productos = $resultado_listado_productos->fetchAll(PDO::FETCH_ASSOC);
    } else {
        header('Location: ./listado_familias.php');
    }
    
} catch (PDOException $exc) {
    $mensaje_conexion = "<p>Falló la conexión" . $exc->getMessage() . "</p>";
}
$mensaje_conexion = "<p>Conexión realizada con éxito</p>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Tienda Web: listado_productos.php -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Listado de productos</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>

    <body class="pagproductos">
    <header>
        <div class="alert alert-info"><?= $mensaje_conexion ?></div>
    </header>

    <div id="contenedor">
        <div id="encabezado">
            <h1>Listado de productos</h1>
        </div>

        <!-- Dividir en varios templates -->
        <div id="cesta">      
            <h3><img src='cesta.png' alt='Cesta' width='24' height='21'> Cesta</h3>
            <hr />
<?php
// Si la cesta está vacía, mostramos un mensaje
if($cesta_vacia): ?>
            <p>Cesta vacía</p>
<?php 
// Si no está vacía, mostrar su contenido
else: ?>
            <table class="table">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Unidades</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($cesta as $key => $value) : ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td><?= $value['nombre'] ?></td>
                            <td><?= $value['pvp'] ?></td>
                            <td><?= $value['unidades'] ?></td>
                        </tr>
    <?php endforeach; ?>
                    </tbody>
                </table>

<?php 
endif; ?>
            <form id='vaciar' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?vaciar=1&familia=$familia") ?>' method='post'>
                <input type='submit' name='vaciar' value='Vaciar Cesta'
<?php if ($cesta_vacia) print "disabled='true'"; ?>
                       />
            </form>
            <form id='comprar' action='cesta.php' method='post'>
                <input type='submit' name='comprar' value='Comprar'
<?php if ($cesta_vacia) print "disabled='true'"; ?>
                       />
            </form>
        </div>

        <div id="productos">
            <?php
            // Creamos un formulario por cada producto obtenido
            if (isset($productos) && count($productos) > 0):
                ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Añadir</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>PVP</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php foreach ($productos as $producto) : ?>
                        <tr>
                            <td>
                                <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?familia=".$producto['familia']) ?>' method='post'>
                                    <input type="submit" name="add" value="Añadir"/>
                                    <!-- campos necesarios para la cesta -->
                                    <input type="hidden" name="familia" value="<?= $producto['familia'] ?>"/>
                                    <input type="hidden" name="cod" value="<?= $producto['cod'] ?>"/>
                                    <input type="hidden" name="nombre" value="<?= $producto['nombre_corto'] ?>"/>
                                    <input type="hidden" name="pvp" value="<?= $producto['PVP'] ?>"/>
                                </form>
                            </td>
                            <td><?= $producto['cod'] ?></td>
                            <td><?= $producto['nombre_corto'] ?> </td>
                            <td><?= $producto['PVP'] ?></td>
                        </tr>
                <?php endforeach; ?>
                    </tbody>
                </table>

            <?php endif; ?>
        </div>

        <br class="divisor" />
        <div id="pie">
            <p><!-- Migas de pan -->
                <a href="<?=  htmlspecialchars('./listado_familias.php') ?>">Familias ></a>
                <a href="<?=  htmlspecialchars($_SERVER["PHP_SELF"]."?familia=$familia") ?>"><?= $familia ?> ></a>
            </p>
            <!-- Cerrar sesión -->
            <p><a href="<?=  htmlspecialchars('./logout.php') ?>">Cerrar Sesión</a></p> 
    
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
