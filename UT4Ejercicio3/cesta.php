<?php
// Recuperamos la información de la sesión
// Y comprobamos que el usuario se haya autentificado
require_once './funciones.php';
comprobarSesion();

// Recuperamos la cesta de la compra
if (isset($_SESSION['cesta'])) {
    $cesta = $_SESSION['cesta'];
    if (count($cesta) > 0) {
        $cesta_vacia = false;
    } else {
        $cesta_vacia = true;
    }
} else {
    $cesta_vacia = true;
}
$total = 0;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cesta</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="tienda.css" rel="stylesheet" type="text/css">
    </head>
    <body>
    <body class="pagproductos">
        

        <div id="contenedor">
            <div id="encabezado">
                <h1>Cesta</h1>

            </div>


            <div id="pagar">
<?php
// Si la cesta está vacía, mostramos un mensaje
if ($cesta_vacia):
    ?>
                    <p>Cesta vacía</p>
                    <?php
// Si no está vacía, mostrar su contenido
                else:
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th colspan="2">Precio</th>
                                <th>Unidades</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php foreach ($cesta as $key => $value) : ?>
                                <tr>
                                    <td><?= $key ?></td>
                                    <td><?= $value['nombre'] ?></td>
                                    <td><?= $value['pvp'] ?></td>
                                    <td>x</td>
                                    <td><?= $value['unidades'] ?></td>
                                </tr>
        <?php $total = $total + ($value['unidades'] * $value['pvp']); ?>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                    <br class="divisor" />
                    <p>Precio total: <?= $total ?> </p>

<?php endif; ?>
            </div>
            <div >
                    <form  action='<?php echo htmlspecialchars("./logout.php"); ?>' method='post'>
                        <input type='submit' name='logout' value='Cerrar Sesión'
<?php if ($cesta_vacia) print "disabled='true'"; ?>
                               />
                    </form>
                    <form  action=<?= htmlspecialchars('./pagar.php'); ?> method='post'>
                        <input type='submit' name='pagar' value='Pagar'
<?php if ($cesta_vacia) print "disabled='true'"; ?>
                               />
                    </form>
            </div>

            <br class="divisor" />
            <div id="pie">
                
                <p><!-- Migas de pan -->
                    <a href="<?=  htmlspecialchars('./listado_familias.php') ?>">Familias ></a>
                    <a href="<?=  htmlspecialchars($_SERVER["PHP_SELF"]) ?>"> Cesta ></a>
                </p>
                <!-- Cerrar sesión -->
                <p><a href="<?=  htmlspecialchars('./logout.php') ?>">Cerrar Sesión</a></p> 


            </div>
        </div>
    </body>
</html>
