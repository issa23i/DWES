<?php
require_once '../servicios/Cesta_compra.php';
require_once '../modelo/DB.php';
require_once '../modelo/Producto.php';
require_once '../servicios/funciones.php';

comprobar_sesion();

// Comprobamos si se ha enviado el formulario de añadir
if (isset($_POST['add'])) {
    $cod = $_POST['cod'];
    $unidades = $_POST['unidades'];
    $cesta_compra = Cesta_compra::cargar_cesta();
    $cesta_compra->guardar_cesta($cesta_compra);
    // añadir unidades
    try {
        $cesta_compra->carga_articulo($cod, $unidades);
    } catch (Exception $exc) {
        echo $exc->getMessage();
        echo "<br>";
        echo $exc->getTraceAsString();
    }


    $cesta_compra->guardar_cesta($cesta_compra);

    // obtener el código de familia
    $cod_familia = $cesta_compra->get_familia($cod);

    // redirigir a vista listado productos
    header("Location: ../controlador/listado_productos.php?familia=$cod_familia");
}