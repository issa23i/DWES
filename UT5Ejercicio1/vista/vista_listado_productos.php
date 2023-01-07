<?php require_once '../controlador/listado_productos.php';
require_once '../modelo/Televisor.php';?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado productos</title>
        <link rel="stylesheet" href="../styles/tienda.css"/>
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
            <h3><img src='../images/cesta.png' alt='Cesta' width='24' height='21'> Cesta</h3>
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
            <form id='vaciar' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?vaciar=1&familia=$cod_familia") ?>' method='post'>
                <input type='submit' name='vaciar' value='Vaciar Cesta'
<?php if ($cesta_vacia) print "disabled='true'"; ?>
                       />
            </form>
            <form id='comprar' action='vista_cesta.php' method='post'>
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
                                    <input type="hidden" name="nombre" value="<?= $producto->mostrar_nombre() ?>"/>
                                    <input type="hidden" name="pvp" value="<?= $producto->getPVP() ?>"/>
                                </form>
                            </td>
                            <td><?= $producto->getCodigo() ?></td>
                            <td><?= $producto->mostrar_nombre() ?> </td>
                            <td><?= $producto->getPVP() ?> </td>
                            <td>
                                <form action='<?= htmlspecialchars("vista_detalle.php?familia=$cod_familia") ?>' method='post'>
                                    <input type="hidden" name="cod_pro" value="<?= $producto->getCodigo() ?>"/>
                                    <!-- Si no es TV o ORDENA, el botón estará deshabilitado -->
                                    <input type="submit" name='detalle' value="Detalle"
                                    <?php if( $cod_familia!='TV' && $cod_familia!='ORDENA'): ?>
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
                <a href="<?=  htmlspecialchars('vista_listado_familias.php') ?>">Familias ></a>
                <a href="<?=  htmlspecialchars($_SERVER["PHP_SELF"]."?familia=$cod_familia") ?>"><?= $cod_familia ?> ></a>
            </p>
            <!-- Cerrar sesión -->
            <p><a href="<?=  htmlspecialchars('vista_logout.php') ?>">Cerrar Sesión</a></p> 
    
        </div>
    </div>
</body>
</html>
