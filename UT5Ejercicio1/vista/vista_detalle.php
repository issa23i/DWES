<?php
require_once '../controlador/detalle.php';
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        
        <title>Detalle producto</title>
        <link rel="stylesheet" href="../styles/tienda.css"/>
    </head>
    <body class="pagproductos">
        <div id="contenedor">
            <div id="encabezado">
                <h1>Detalle de producto</h1>
            </div>
            <div id="productos">
                <?php if($cod_familia=='TV'): ?>
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
                <?php elseif($cod_familia=='ORDENA'): ?>
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
                <a href="<?=  htmlspecialchars('vista_listado_familias.php') ?>">Familias ></a>
                <a href="<?=  htmlspecialchars("vista_listado_productos.php"."?familia=$cod_familia") ?>"><?= $cod_familia ?> ></a>
            </p>
            <!-- Cerrar sesión -->
            <p><a href="<?=  htmlspecialchars('vista_logout.php') ?>">Cerrar Sesión</a></p> 
    
        </div>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
