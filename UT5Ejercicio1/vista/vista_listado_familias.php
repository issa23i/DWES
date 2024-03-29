<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado Familias</title>
        <link rel="stylesheet" href="../styles/tienda.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body class="pagproductos">

        <div id="contenedor">
            <div id="encabezado">
                <h1>Listado de familias</h1>
            </div>
            
        <div class="alert alert-info"><?= $mensaje ?></div>

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

            <!--Lista de vínculos con la forma listado_productos.php?categoria=-->
            <div id="productos">
<?php if (isset($listado_familias) && count($listado_familias) > 0): ?>
                    <table class="table">
                        <tbody>
    <?php foreach ($listado_familias as $familia): ?>
                                <tr>
                                    <td>
                                        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'])  ?>" method='post'>
                                            <label for="set_cod_familia"><?= $familia->getNombre()?></label>
                                        </td>
                                        <td>
                                            <input type="hidden" name="cod_familia" value="<?= $familia->getCod()?>" />
                                            <input type="submit" name="set_cod_familia" value="Seleccionar" />
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
                <!-- Migas de pan -->
                <p><a href="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Familias ></a></p> 
                <!-- Cerrar sesión -->
                <p><a href="<?= htmlspecialchars('../controlador/logout.php') ?>">Cerrar Sesión</a></p> 


            </div>
        </div>

        <div class="excepciones alert alert-info"><?= $mensaje_excepcion ?></div>
    </body>
</html>
