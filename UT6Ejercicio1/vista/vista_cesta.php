<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cesta</title>
        <link rel="stylesheet" href="../styles/tienda.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
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
                            <?php foreach ($productos as $value) : ?>
                                <tr>
                                    <td><?= $value['producto']->getCodigo(); ?></td>
                                    <td><?= $value['producto']->mostrar_nombre(); ?></td>
                                    <td><?= $value['producto']->getPVP(); ?></td>
                                    <td> x </td>
                            <form action='<?= htmlspecialchars("../controlador/eliminar.php") ?>' method="post">
                                <td><input type="hidden" name="cod" value="<?= $value['producto']->getCodigo() ?>"/></td>
                                <td><input type="number" name="unidades_cambiadas" value="<?= $value['unidades'] ?>"/></td>
                                <td> <?= ($value['unidades'] * $value['producto']->getPVP()); ?> </td>
                                <td><input type='submit' name="cambiar_unidades" value="Cambiar"></td>
                                </tr>
                            </form>


                        <?php endforeach; ?>
                        </tbody>

                    </table>
                    <br class="divisor" />
                    <p>Precio total: <?= $total ?> </p>

                <?php endif; ?>
            </div>
            <div >
                <form  action='<?php echo htmlspecialchars("../controlador/logout.php"); ?>' method='post'>
                    <input type='submit' name='logout' value='Cerrar Sesión'
                    <?php if ($cesta_vacia) print "disabled='true'"; ?>
                           />
                </form>
                <form  action=<?= htmlspecialchars('../controlador/pagar.php'); ?> method='post'>
                    <input type='submit' name='pagar' value='Pagar'
                    <?php if ($cesta_vacia) print "disabled='true'"; ?>
                           />
                </form>
            </div>

            <br class="divisor" />
            <div id="pie">

                <p><!-- Migas de pan -->
                    <a href="<?= htmlspecialchars('../controlador/listado_familias.php') ?>">Familias ></a>
                    <a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>"> Cesta ></a>
                </p>
                <!-- Cerrar sesión -->
                <p><a href="<?= htmlspecialchars('vista_logout.php') ?>">Cerrar Sesión</a></p> 


            </div>
        </div>
    </body>
</html>