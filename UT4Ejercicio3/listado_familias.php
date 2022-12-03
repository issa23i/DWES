<?php
// Recuperamos la información de la sesión
// Y comprobamos que el usuario se haya autentificado
require_once './funciones.php';
comprobarSesion();

$msql = "mysql:dbname=dwes2;host=127.0.0.1";
$user = 'dwes2';
$pass = 'abc123.';

// Recuperamos la cesta de la compra
    if(isset($_SESSION['cesta'])){
        $cesta = $_SESSION['cesta'];
        if(count($cesta)>0){
            $cesta_vacia = false;
            
        } else {
            $cesta_vacia = true;
        }
    } else {
        $cesta_vacia = true;
    }
    
    // Comprobamos si se ha enviado el formulario de vaciar la cesta
    if (isset($_REQUEST['vaciar'])){
        $cesta = [];
        $_SESSION['cesta'] = $cesta;
        $cesta_vacia= true;
        $mensaje = "Cesta vaciada con éxito";
    } else {
        $mensaje = '';
    }
    
    
try {
    $pdo = new PDO($msql, $user, $pass);
    
    // Obtenemos los datos necesarios de la BD
    $query_listado_familias = 'SELECT cod, nombre FROM familia';
    $resultado_listaddo_familias = $pdo->query($query_listado_familias);
    $listado_familias = $resultado_listaddo_familias->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $exc) {
    $mensaje_conexion = "<p>Falló la conexión" . $exc->getMessage() . "</p>";
}
$mensaje_conexion = "<p>Conexión realizada con éxito</p>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Tienda Web: listado_familias.php -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Listado de familias</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>

    <body class="pagproductos">
    <header>
        <div class="alert alert-info"><?= $mensaje_conexion ?></div>
        <div class="alert alert-info"><?= $mensaje ?></div>
        <!-- Migas de pan -->
        <p><a href="<?=  htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Familias ></a></p> 
    </header>

    <div id="contenedor">
        <div id="encabezado">
            <h1>Listado de familias</h1>
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
            <form id='vaciar' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?vaciar=1") ?>' method='post'>
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

        <!--Lista de vínculos con la forma listado_productos.php?categoria=-->
        <div id="productos">
<?php if (isset($listado_familias) && count($listado_familias) > 0): ?>
            <table class="table">
                    <tbody>
    <?php foreach ($listado_familias as $familia): ?>
                        <tr>
                            <td><a href="./listado_productos.php?familia=<?= $familia['cod'] ?>" target="target"><?= $familia['nombre'] ?></a></td>
                        </tr>
    <?php endforeach; ?>
                    </tbody>
                </table>

    <?php endif; ?>
        </div>

        <br class="divisor" />
        <div id="pie">


        </div>
    </div>
    
</body>
</html>
