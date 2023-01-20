<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

        <title>Detalle producto</title>
        <link rel="stylesheet" href="../styles/tienda.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <body class="pagproductos">
        <div id="contenedor">
            <div id="encabezado">
                <h1>Detalle de producto</h1>
            </div>
            <div id="productos">
                <?php if ($cod_familia == 'TV'): ?>
                    <table border="0">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Resolución</th>
                                <th>Pulgadas</th>
                                <th>Panel</th>
                                <th>PVP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $cod ?></td>
                                <td><?= $nombre ?></td>
                                <td><?= $resolucion ?></td>
                                <td><?= $pulgadas ?></td>
                                <td><?= $panel ?></td>
                                <td><?= $precio ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php elseif ($cod_familia == 'ORDENA'): ?>
                    <table border="0">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Procesador</th>
                                <th>Ram</th>
                                <th>Rom</th>
                                <th>Extras</th>
                                <th>PVP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $cod ?></td>
                                <td><?= $nombre ?></td>
                                <td><?= $marca ?></td>
                                <td><?= $modelo ?></td>
                                <td><?= $procesador ?></td>
                                <td><?= $ram ?></td>
                                <td><?= $rom ?></td>
                                <td><?= $extras ?></td>
                                <td><?= $precio ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <br class="divisor" />
            <div id="pie">
                <p><!-- Migas de pan -->
                    <a href="<?= htmlspecialchars('../controlador/listado_familias.php') ?>">Familias ></a>
                    <a href="<?= htmlspecialchars("../controlador/listado_productos.php") ?>"><?= $cod_familia ?> ></a>
                </p>
                <!-- Cerrar sesión -->
                <p><a href="<?= htmlspecialchars('../controlador/logout.php') ?>">Cerrar Sesión</a></p> 

            </div>
        </div>

        <div class="excepciones alert alert-info"><?= $mensaje_excepcion ?></div>
    </body>
</html>
