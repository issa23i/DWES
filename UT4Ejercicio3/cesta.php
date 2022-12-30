<?php
// Recuperamos la información de la sesión
// Y comprobamos que el usuario se haya autentificado
require_once './funciones.php';
comprobarSesion();

// Recuperamos la cesta de la compra
$cesta = cargarCesta ();
$cesta_vacia = cestaVacia ($cesta);

// Si se han actualizado las unidades
cambiarUnidades($cesta);
$cesta_vacia = cestaVacia ($cesta);
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
                                <th colspan="3">Unidades</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php foreach ($cesta as $key => $value) : ?>
                                <tr>
                                    <td><?= $key ?></td>
                                    <td><?= $value['nombre'] ?></td>
                                    <td><?= $value['pvp'] ?></td>
                                    <td> x </td>
                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                                    <td><input type="hidden" name="cod" value="<?= $key ?>"/></td>
                                    <td><input type="number" name="unidades_cambiadas" value="<?= $value['unidades'] ?>"/></td>
                                    <td> <?=($value['unidades'] * $value['pvp']); ?> </td>
                                    <td><input type='submit' name="cambiar_unidades" value="Cambiar"></td>
                                </tr>
                        </form>

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
