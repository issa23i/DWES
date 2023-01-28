<!DOCTYPE html>
<html lang="es">
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
            <div id="cesta">  
                <h3><img src='../images/cesta.png' alt='Cesta' width='24' height='21'> Cesta</h3>
                <hr />
                                    
                
            </div>

            <div id="productos">

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
