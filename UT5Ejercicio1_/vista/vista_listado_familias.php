<?php require_once '../controlador/listado_familias.php';?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Listado Familias</title>
        <link rel="stylesheet" href="../styles/tienda.css"/>
    </head>
     <body class="pagproductos">
    <header>
        <div class="alert alert-info"><?= $mensaje_conexion ?></div>
       </header>

    <div id="contenedor">
        <div id="encabezado">
            <h1>Listado de familias</h1>
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
            <form id='vaciar' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]."?vaciar=1") ?>' method='post'>
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

        <!--Lista de vínculos con la forma listado_productos.php?categoria=-->
        <div id="productos">
<?php if (isset($listado_familias) && count($listado_familias) > 0): ?>
            <table class="table">
                    <tbody>
    <?php foreach ($listado_familias as $familia): ?>
                        <tr>
                            <td><a href="../vista/vista_listado_productos.php?familia=<?= $familia->getCod() ?>" target="target"><?= $familia->getNombre() ?></a></td>
                        </tr>
    <?php endforeach; ?>
                    </tbody>
                </table>

    <?php endif; ?>
        </div>

        <br class="divisor" />
        <div id="pie">
        <!-- Migas de pan -->
        <p><a href="<?=  htmlspecialchars($_SERVER["PHP_SELF"]) ?>">Familias ></a></p> 
        <!-- Cerrar sesión -->
        <p><a href="<?=  htmlspecialchars('vista_logout.php') ?>">Cerrar Sesión</a></p> 
    

        </div>
    </div>
</body>
</html>
