<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado productos</title>
        <link rel="stylesheet" href="../styles/tienda.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body class="pagproductos">
        <div id="contenedor">
            <div id="encabezado">
                <h1>Listado de productos</h1>
            </div>

            <!-- Dividir en varios templates -->
            <div id="cesta">      
                <h3><img src='../images/cesta.png' alt='Cesta' width='24' height='21'> Cesta</h3>
                <hr />
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
                                <th>Precio</th>
                                <th>Unidades</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php foreach ($productos_cesta as $value) : ?>
                                <tr>
                                    <td><?= $value['producto']->getCodigo(); ?></td>
                                    <td><?= $value['producto']->mostrar_nombre(); ?></td>
                                    <td><?= $value['producto']->getPVP(); ?></td>
                                    <td><?= $value['unidades']; ?></td>
                                </tr>
    <?php endforeach; ?>
                        </tbody>
                    </table>

<?php endif; ?>
                <form id='vaciar' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?vaciar=1") ?>' method='post'>
                    <input type='submit' name='vaciar' value='Vaciar Cesta'
<?php if ($cesta_vacia) print "disabled='true'"; ?>
                           />
                </form>
                <form id='comprar' action='../controlador/cesta.php' method='post'>
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
                                <th>detalle</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php foreach ($productos as $producto) : ?>
                                <tr>
                                    <td>
                                        <form action='<?php echo htmlspecialchars("../controlador/anadir.php") ?>' method='post'>
                                            <input type="text" name="unidades"/>
                                            <input type="submit" name="add" value="Añadir"/>
                                            <!-- campos necesarios para la cesta -->
                                            <input type="hidden" name="familia" value="<?= $producto->getFamilia() ?>"/>
                                            <input type="hidden" name="cod" value="<?= $producto->getCodigo() ?>"/>
                                        </form>
                                    </td>
                                    <td><?= $producto->getCodigo() ?></td>
                                    <td><?= $producto->mostrar_nombre() ?> </td>
                                    <td><?= $producto->getPVP() ?> </td>
                                    <td>
                                        <form action='<?= htmlspecialchars("../controlador/detalle.php") ?>' method='post'>
                                            <input type="hidden" name="cod_pro" value="<?= $producto->getCodigo() ?>"/>
                                            <!-- Si no es TV o ORDENA, el botón estará deshabilitado -->
                                            <input type="submit" name='detalle' value="Detalle"
                                                   <?php if ($cod_familia != 'TV' && $cod_familia != 'ORDENA'): ?>
                                                       disabled='true'
        <?php endif; ?>/>
                                        </form>
                                    </td>
                                </tr>
    <?php endforeach; ?>
                        </tbody>
                    </table>

<?php endif; ?>
            </div>

            <br class="divisor" />
            <div id="pie">
                <p><!-- Migas de pan -->
                    <a href="<?= htmlspecialchars('../controlador/listado_familias.php') ?>">Familias ></a>
                    <a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>"><?= $cod_familia ?> ></a>
                </p>
                <!-- Cerrar sesión -->
                <p><a href="<?= htmlspecialchars('../controlador/logout.php') ?>">Cerrar Sesión</a></p> 

            </div>
        </div>

        <div class="excepciones alert alert-info"><?= $mensaje_excepcion ?></div>
        <script src="../js/cargarDatos.js"></script>
    </body>
</html>
